<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');

/*
    GET,POST, DELETE, PUT
*/


if ($_SERVER["REQUEST_METHOD"] == "POST") { //kiểm tra có phương thức post hay không

    //lấy dữ liệu được truyền qua phương thức post từ frontend
    $data = json_decode(file_get_contents("php://input", true));

    $username = $data->username;
    $password = $data->password;

  
    
    $obj->select('accounts', '*', null, "username='{$username}'", null, null);
    $result = $obj->getResult();



    //duyệt dữ liệu nhận được bằng vòng lặp
    if ($result) {
        foreach ($result as $row) {
            $id = $row['id'];
            $fullname = $row['fullname'];
            $email = $row['email'];
            $is_admin = $row['is_admin'];

            //so sánh mật khẩu
            if (!password_verify($password, $row['password'])) {
                echo json_encode([
                    'code' => 401,
                    'message' => 'Mật khẩu không chính xác!'
                ]);
                return;
            }


            //kiểm tra quyền admin
            if ($is_admin == 0) {
                echo json_encode([
                    'code' => 403,
                    'message' => 'Bạn không có quyền truy cập module này!'
                ]);
                return;
            }


            $jwt = new Middleware;
            $token = $jwt->encode($id,$fullname,$email,$is_admin);

            echo json_encode([
                'code' => 200,
                'message' => 'Đăng nhập admin thành công!',
                "token"=>$token
            ]);

        }
    } else {
        echo json_encode([
            'code' => 404,
            'message' => 'Tài khoản không chính xác!'
        ]);
    }


} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}
?>