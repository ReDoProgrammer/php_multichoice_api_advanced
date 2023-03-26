<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $allHeader = getallheaders();
        $jwt = new Middleware;
        $user = $jwt->decode($allHeader);

        if ($user) {
            $id = $user['id'];
            $obj->select('accounts', "username,fullname,phone,email,address", null, "id='{$id}'", null, null, null);
            $accounts = $obj->getResult();
            
            if ($accounts) {
                echo json_encode([
                    'code' => 200,
                    'message' => 'Lấy thông tin chi tiết tài khoản thành công.',
                    'account' => $accounts[0]
                ]);
            } else {
                echo json_encode([
                    'code' => 404,
                    'message' => 'Không tìm thấy tài khoản phù hợp.'
                ]);
            }
        } else {
            echo json_encode([
                'code' => 404,
                'message' => 'Không tìm thấy tài khoản phù hợp!'
            ]);
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
