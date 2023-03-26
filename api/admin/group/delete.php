<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');


if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    try {
        $allHeader = getallheaders();
        $jwt = new Middleware;
        $user = $jwt->decode($allHeader);

        if ($user) {
            $data = json_decode(file_get_contents("php://input", true));
            $id = $data->id;
           
            $obj->delete('groups',"id={$id}");

            $group = $obj->getResult();
            if ($group) {
                echo json_encode([
                    'code' => 200,
                    'message' => 'Xóa nhóm câu hỏi thành công!'                    
                ]);
            } else {
                echo json_encode([
                    'code' => 500,
                    'message' => 'Xóa nhóm câu hỏi thất bại!'
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