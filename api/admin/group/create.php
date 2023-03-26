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
            $name = $data?$data->name:$_POST['name'];
            $mark = $data?$data->mark:$_POST['mark'];

            $obj->insert('groups',[
                'name'=>$name,
                'mark'=>$mark
            ]);
            $group = $obj->getResult();
            if ($group) {
                echo json_encode([
                    'code' => 201,
                    'message' => 'Thêm nhóm câu hỏi thành công!'
                ]);
            } else {
                echo json_encode([
                    'code' => 500,
                    'message' => 'Thêm nhóm câu hỏi thất bại!'
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
