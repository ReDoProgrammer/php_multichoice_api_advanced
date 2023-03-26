<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');


if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    try {
        $allHeader = getallheaders();
        $jwt = new Middleware;
        $user = $jwt->decode($allHeader);

        if ($user) {
            $data = json_decode(file_get_contents("php://input", true));
            $id = $data->id;
            $title=$data->title;
            $option_a = $data->option_a;
            $option_b = $data->option_b;
            $option_c = $data->option_c;
            $option_d = $data->option_d;
            $answer = $data->answer;
            $obj->update('questions', [
                "title"=>$title,
                "option_a"=>$option_a,
                "option_b"=>$option_b,
                "option_c"=>$option_c,
                "option_d"=>$option_d,
                "answer"=>$answer
            ], "id={$id}");
            $question = $obj->getResult();
            if ($question) {
                echo json_encode([
                    'code' => 200,
                    'message' => 'Cập nhật câu hỏi thành công!'                    
                ]);
            } else {
                echo json_encode([
                    'code' => 500,
                    'message' => 'Cập nhật câu hỏi thất bại!'
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
?>