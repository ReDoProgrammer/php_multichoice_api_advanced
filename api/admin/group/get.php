<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');

//kiểm tra phương thức truy vấn phải POST hay không
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $allHeader = getallheaders();
    $jwt = new Middleware;
    $user = $jwt->decode($allHeader);

    if ($user) {
        $data = json_decode(file_get_contents("php://input", true));
      

        $obj->select('groups', "*", null, null, null, null, null);
        $groups = $obj->getResult();
      
        if ($groups) {
            echo json_encode([
                'code' => 200,
                'message' => 'Lấy danh sách nhóm câu hỏi thành công!',
                'groups' => $groups               
            ]);
        }
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}