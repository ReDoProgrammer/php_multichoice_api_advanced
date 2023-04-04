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
            if (isset($_FILES) && isset($_FILES['file'])) { //file excel    
                $file = $_FILES['file'];
                $filePath = $file['tmp_name'];
                $spreadsheet = IOFactory::load($filePath);


                // Lấy sheet đầu tiên từ tệp Excel
                $worksheet = $spreadsheet->getActiveSheet();

                // Lấy số dòng cuối cùng trong sheet
                $lastRow = $worksheet->getHighestDataRow();

                $importedQuestions = array();

                // Duyệt qua từng dòng trong sheet
                for ($row = 2; $row <= $lastRow; $row++) {
                    // Lấy giá trị của cột chứa dữ liệu string
                    $index = $worksheet->getCell('A' . $row)->getCalculatedValue();
                    $title = $worksheet->getCell('B' . $row)->getCalculatedValue();
                    $option_a = $worksheet->getCell('C' . $row)->getCalculatedValue();
                    $option_b = $worksheet->getCell('D' . $row)->getCalculatedValue();
                    $option_c = $worksheet->getCell('E' . $row)->getCalculatedValue();
                    $option_d = $worksheet->getCell('F' . $row)->getCalculatedValue();
                    $answer = $worksheet->getCell('G' . $row)->getCalculatedValue();
                    $group_id = $worksheet->getCell('H' . $row)->getCalculatedValue();


                    $obj->insert('questions', [
                        'title' => $title,
                        'option_a' => $option_a,
                        'option_b' => $option_b,
                        'option_c' => $option_c,
                        'option_d' => $option_d,
                        'answer' => $answer,
                        'group_id' => $group_id,
                        'created_by' => $user['id']
                    ]);
                    $check = $obj->getResult();
                    if ($check) {
                        // Thêm một phần tử mới vào mảng
                        array_push(
                            $importedQuestions,
                            array(
                                'index' => $index,
                                'title' => $title,
                                'option_a' => $option_a,
                                'option_b' => $option_b,
                                'option_c' => $option_c,
                                'option_d' => $option_d,
                                'answer' => $answer,
                                'group_id' => $group_id
                            )
                        );
                    }
                }
                echo json_encode([
                    'status' => 201,
                    'message' => 'Nhập danh sách câu hỏi thành công!',
                    'questions' => $importedQuestions
                ]);
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