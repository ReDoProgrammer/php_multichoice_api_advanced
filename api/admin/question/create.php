<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');
$target_dir = "../../../upload/questions/";
//kiểm tra phương thức truy vấn phải POST hay không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $allHeader = getallheaders();
        $jwt = new Middleware;
        $user = $jwt->decode($allHeader);




        if ($user) {

            $data = json_decode(file_get_contents("php://input", true));

            //Validate input
            if(empty($_POST['title']) && empty($data->title)){
                echo json_encode([
                    'code' => 400,
                    'message' => 'Vui lòng nhập tiêu đề câu hỏi!'
                ]);
                return;
            }

            if(empty($_POST['option_a']) && empty($data->option_a)){
                echo json_encode([
                    'code' => 400,
                    'message' => 'Vui lòng nhập đáp án A!'
                ]);
                return;
            }
            if(empty($_POST['option_b']) && empty($data->option_b)){
                echo json_encode([
                    'code' => 400,
                    'message' => 'Vui lòng nhập đáp án B!'
                ]);
                return;
            }
            if(empty($_POST['option_c']) && empty($data->option_c)){
                echo json_encode([
                    'code' => 400,
                    'message' => 'Vui lòng nhập đáp án C!'
                ]);
                return;
            }
            if(empty($_POST['option_d']) && empty($data->option_d)){
                echo json_encode([
                    'code' => 400,
                    'message' => 'Vui lòng nhập đáp án D!'
                ]);
                return;
            }

            if(empty($_POST['answer']) && empty($data->answer)){
                echo json_encode([
                    'code' => 400,
                    'message' => 'Vui lòng chọn đáp án đúng!'
                ]);
                return;
            }

            if(empty($_POST['group_id']) && empty($data->group_id)){
                echo json_encode([
                    'code' => 400,
                    'message' => 'Vui lòng nhập nhóm câu hỏi!'
                ]);
                return;
            }
            //End validating inputs

            $title = $data ? $data->title : $_POST['title'];
            $option_a = $data ? $data->option_a : $_POST['option_a'];
            $option_b = $data ? $data->option_b : $_POST['option_b'];
            $option_c = $data ? $data->option_c : $_POST['option_c'];
            $option_d = $data ? $data->option_d : $_POST['option_d'];
            $answer = $data ? $data->answer : $_POST['answer'];
            $group_id = $data ? $data->group_id : $_POST['group_id'];
            $imageUrl = "";

           

            if ($_FILES) {  //neu co hinh anh            
                $image = $data ? $data->image : $_FILES['image'];
                if ($image['size'] > 0) {
                    $target_file = $target_dir . $image['name'];

                    if (file_exists($target_file)) {
                        echo json_encode([
                            'code' => 409,
                            'message' => 'Hình ảnh này đã có trên hệ thống!'
                        ]);
                        return;
                    }

                    if ($image["size"] > 200000) {
                        echo json_encode([
                            'code' => 409,
                            'message' => 'Kích thước hình ảnh quá lớn!'
                        ]);
                        return;
                    }
                    $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    // Allow certain file formats
                    if (
                        $imageType != "jpg" && $imageType != "png" && $imageType != "jpeg"
                        && $imageType != "gif"
                    ) {
                        echo json_encode([
                            'code' => 409,
                            'message' => 'Định dạng hình ảnh không hợp lệ!'
                        ]);
                        return;
                    }

                    move_uploaded_file($image['tmp_name'], $target_file);
                    $imageUrl = "/upload/questions/".$image['name'];                   
                }
            }


            $obj->insert('questions', [
                "title" => $title,
                "option_a" => $option_a,
                "option_b" => $option_b,
                "option_c" => $option_c,
                "option_d" => $option_d,
                "answer" => $answer,
                "group_id"=>$group_id,
                "img"=>$imageUrl,
                "created_by"=>$user['id']
            ]);
            $question = $obj->getResult();
            if ($question) {
                echo json_encode([
                    'code' => 201,
                    'message' => 'Thêm câu hỏi mới thành công!'
                ]);
            } else {
                echo json_encode([
                    'code' => 500,
                    'message' => 'Thêm câu hỏi thất bại!'
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
