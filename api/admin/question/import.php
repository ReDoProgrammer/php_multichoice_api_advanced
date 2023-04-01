<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');
require_once '../../../vendor/autoload.php';

use \Shuchkin\SimpleXLSX;

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

                if ($xlsx = SimpleXLSX::parse($file['tmp_name'])) {
                    $importedQuestions  = array();
                    for ($i = 1; $i < count($xlsx->rows()); $i++) {
                        $index = $xlsx->rows()[$i][0];
                        $title = $xlsx->rows()[$i][1];
                        $option_a = $xlsx->rows()[$i][2];
                        $option_b = $xlsx->rows()[$i][3];
                        $option_c = $xlsx->rows()[$i][4];
                        $option_d = $xlsx->rows()[$i][5];
                        $answer = strtoupper(trim($xlsx->rows()[$i][6]));
                        $group_id = (int) $xlsx->rows()[$i][7];
                        $image = $xlsx->rows()[$i][8];


                             

                        //validate data
                        if (
                            strlen(trim($title)) > 0
                            && strlen(trim($option_a)) > 0 && strlen(trim($option_b)) > 0 && strlen(trim($option_c)) > 0 && strlen(trim($option_d)) > 0
                            && (strlen(trim($answer)) == 1 && ($answer == 'A' || $answer == 'B' || $answer == 'C' || $answer == 'D'))
                            && ($group_id >= 1 && $group_id <= 4)
                        ) {

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
                            $check =$obj->getResult();
                            if($check){
                                // Thêm một phần tử mới vào mảng
                                array_push($importedQuestions, array(
                                    'index'=>$index,
                                    'title' => $title,
                                    'option_a' => $option_a,
                                    'option_b' => $option_b,
                                    'option_c' => $option_c,
                                    'option_d' => $option_d,
                                    'answer' => $answer,
                                    'group_id' => $group_id
                                ));
                            }
                        }
                    }

                    if (count($importedQuestions) > 0) {
                        echo json_encode([
                            'status' => 201,
                            'message' => 'Nhập danh sách câu hỏi thành công!',
                            'questions' => $importedQuestions,
                            'size'=>count($importedQuestions)
                        ]);
                    } else {
                        echo json_encode([
                            'status' => 400,
                            'message' => 'Nhập danh sách câu hỏi thất bại. Vui lòng kiểm tra lại cấu trúc file!'
                        ]);
                    }
                } else {
                    echo json_encode([
                        'status' => 400,
                        'message' => 'Nhập danh sách câu hỏi thất bại. Vui lòng kiểm tra lại cấu trúc file!'
                    ]);
                }
            }else {
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
