<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');

//kiểm tra phương thức truy vấn phải POST hay không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $allHeader = getallheaders();
        $jwt = new Middleware;
        $user = $jwt->decode($allHeader);

        if ($user) {
            $data = json_decode(file_get_contents("php://input", true));

            $result = $data->result;//kết quả bài thi
            $mark = $data->mark;
            $user_id = $user['id'];

            $obj->insert("results",[
                "user_id"=>$user_id,
                "result"=>json_encode($result),
                "mark"=>$mark
            ]);

            if($obj->getResult()){
                echo json_encode([
                    'code' => 201,
                    'message' => 'Lưu kết quả bài thi thành công!'
                ]);
            }else{
                echo json_encode([
                    'code' => 500,
                    'message' => 'Lưu kết quả bài thi thất bại!'
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