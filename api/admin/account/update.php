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
            $fullname= $data->fullname;
            $password = $data->password;
            $phone = $data->phone;
            $email = $data->email;
            $address=$data->address;


            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


            $obj->update('accounts', [
                "fullname"=>$fullname,
                "password"=>$hashedPassword,
                "phone"=>$phone,
                "email"=>$email,
                "address"=>$address               
            ], "id={$id}");
            $account = $obj->getResult();
            if ($account) {
                echo json_encode([
                    'code' => 200,
                    'message' => 'Cập nhật tài khoản thành công!'                    
                ]);
            } else {
                echo json_encode([
                    'code' => 500,
                    'message' => 'Cập nhật tài khoản thất bại!'
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