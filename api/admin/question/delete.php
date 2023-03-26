<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');


if ($_SERVER["REQUEST_METHOD"] == "DELETE" || $_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $allHeader = getallheaders();
        $jwt = new Middleware;
        $user = $jwt->decode($allHeader);

        if ($user) {
            $data = json_decode(file_get_contents("php://input", true));
            if(empty($_POST['id']) && empty($data->id)){
                echo json_encode([
                    'code' => 400,
                    'message' => 'Vui lòng nhập id của câu hỏi!'
                ]);
                return;
            }


            $id = $data?$data->id:$_POST['id'];

            $obj->select("questions","*",null,"id = {$id}",null,null,null);

            $result = $obj->getResult();

            if(!$result){
                echo json_encode([
                    'code' => 404,
                    'message' => 'Không tìm thấy câu hỏi phù hợp!'
                ]);
                return;
            }

           
           
            $obj->delete('questions',"id={$id}");
            $question = $obj->getResult();
            if ($question) {
                if(strlen($result[0]["img"])){
                    unlink('../../..'.$result[0]["img"]);
                }  
                echo json_encode([
                    'code' => 200,
                    'message' => 'Xóa câu hỏi thành công!'                    
                ]);
            } else {
                echo json_encode([
                    'code' => 500,
                    'message' => 'Xóa câu hỏi thất bại!'
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