<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');
require_once '../../../vendor/autoload.php';

use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

$target_dir = "../../../upload/questions/";
//kiểm tra phương thức truy vấn phải POST hay không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $allHeader = getallheaders();
        $jwt = new Middleware;
        $user = $jwt->decode($allHeader);

        if ($user) {

            $data = json_decode(file_get_contents("php://input", true));
            if (isset($_FILES) && isset($_FILES['file'])) {  //file excel    
                $file = $_FILES['file'];
                $filePath =  $file['tmp_name'];
                $spreadsheet = IOFactory::load($filePath);




                $worksheet = $spreadsheet->getActiveSheet();
                $worksheetArray = $worksheet->toArray();
                array_shift($worksheetArray);

                foreach ($worksheetArray as $key => $value) {

                    $worksheet = $spreadsheet->getActiveSheet();
                    $drawing = $worksheet->getDrawingCollection()[$key];

                    $zipReader = fopen($drawing->getPath(), 'r');
                    $imageContents = '';
                    while (!feof($zipReader)) {
                        $imageContents .= fread($zipReader, 1024);
                    }
                    fclose($zipReader);
                    $extension = $drawing->getExtension();
                    print_r($extension);
                   
                }




















                // Lấy sheet đầu tiên từ tệp Excel
                $worksheet = $spreadsheet->getActiveSheet();

                // Lấy số dòng cuối cùng trong sheet
                $lastRow = $worksheet->getHighestDataRow();

                // Duyệt qua từng dòng trong sheet
                for ($row = 2; $row <= $lastRow; $row++) {
                    // Lấy giá trị của cột chứa dữ liệu string
                    $title = $worksheet->getCell('B' . $row)->getCalculatedValue();
                    $option_a = $worksheet->getCell('C' . $row)->getCalculatedValue();
                    $option_b = $worksheet->getCell('D' . $row)->getCalculatedValue();
                    $option_c = $worksheet->getCell('E' . $row)->getCalculatedValue();
                    $option_d = $worksheet->getCell('F' . $row)->getCalculatedValue();
                    $answer = $worksheet->getCell('G' . $row)->getCalculatedValue();
                    $group_id = $worksheet->getCell('H' . $row)->getValue();





                    $cell = $worksheet->getCell('I' . $row);
                    $dataType = $cell->getDataType();

                    if ($dataType === \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_INLINE) {
                        // Đây là một hình ảnh
                        $drawing = $cell->getDrawing();
                        $imageData = $drawing->getImageResourceAsString();

                        print_r("Hinh anh:" . $imageData . "\n");
                    } else {
                        // Đây là một chuỗi văn bản
                        $text = "text:" . $cell->getValue() . $row . "\n";
                        print_r($text);
                    }
                }


                // if ($xlsx = SimpleXLSX::parse($file['tmp_name'])) {
                //     $importedQuestions  = array();
                //     for ($i = 1; $i < count($row); $i++) {
                //         $index = $row[0];
                //         $title = $row[1];
                //         $option_a = $row[2];
                //         $option_b = $row[3];
                //         $option_c = $row[4];
                //         $option_d = $row[5];
                //         $answer = strtoupper(trim($row[6]));
                //         $group_id = (int) $row[7];
                //         $image = $row[8];




                //         //validate data
                //         if (
                //             strlen(trim($title)) > 0
                //             && strlen(trim($option_a)) > 0 && strlen(trim($option_b)) > 0 && strlen(trim($option_c)) > 0 && strlen(trim($option_d)) > 0
                //             && (strlen(trim($answer)) == 1 && ($answer == 'A' || $answer == 'B' || $answer == 'C' || $answer == 'D'))
                //             && ($group_id >= 1 && $group_id <= 4)
                //         ) {

                //             $obj->insert('questions', [
                //                 'title' => $title,
                //                 'option_a' => $option_a,
                //                 'option_b' => $option_b,
                //                 'option_c' => $option_c,
                //                 'option_d' => $option_d,
                //                 'answer' => $answer,
                //                 'group_id' => $group_id,
                //                 'created_by' => $user['id']
                //             ]);
                //             $check =$obj->getResult();
                //             if($check){
                //                 // Thêm một phần tử mới vào mảng
                //                 array_push($importedQuestions, array(
                //                     'index'=>$index,
                //                     'title' => $title,
                //                     'option_a' => $option_a,
                //                     'option_b' => $option_b,
                //                     'option_c' => $option_c,
                //                     'option_d' => $option_d,
                //                     'answer' => $answer,
                //                     'group_id' => $group_id
                //                 ));
                //             }
                //         }
                //     }

                //     if (count($importedQuestions) > 0) {
                //         echo json_encode([
                //             'status' => 201,
                //             'message' => 'Nhập danh sách câu hỏi thành công!',
                //             'questions' => $importedQuestions,
                //             'size'=>count($importedQuestions)
                //         ]);
                //     } else {
                //         echo json_encode([
                //             'status' => 400,
                //             'message' => 'Nhập danh sách câu hỏi thất bại. Vui lòng kiểm tra lại cấu trúc file!'
                //         ]);
                //     }
                // } else {
                //     echo json_encode([
                //         'status' => 400,
                //         'message' => 'Nhập danh sách câu hỏi thất bại. Vui lòng kiểm tra lại cấu trúc file!'
                //     ]);
                // }
            } else {
                echo json_encode([
                    'status' => 400,
                    'message' => 'Nhập danh sách câu hỏi thất bại. Vui lòng chọn file excel chứa danh sách câu hỏi!'
                ]);
            }
        }
    } catch (Exception $e) {
        echo json_encode([
            'code' => 500,
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}
