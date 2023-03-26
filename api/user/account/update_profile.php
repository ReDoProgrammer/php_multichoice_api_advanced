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

            $fullname = $data->fullname;
            $phone = $data->phone;
            $email = $data->email;
            $address = $data->address;
            $password = $data->password;
            

            $id = $user['id'];
            $obj->select('accounts', '*', null, "id='{$id}'", null, null);
            $result = $obj->getResult();
            if ($result) {
                //so sánh mật khẩu
                if (!password_verify($password, $result[0]['password'])) {
                    echo json_encode([
                        'code' => 409,
                        'message' => 'Mật khẩu hiện tại không chính xác!'
                    ]);
                    return;
                }
               
                $obj->update("accounts",[
                    "fullname"=>$fullname,
                    "phone"=>$phone,
                    "email"=>$email,
                    "address"=>$address
                ],"id='{$id}'");
                if($obj->getResult()){
                    echo json_encode([
                        'code' => 200,
                        'message' => 'Cập nhật profile thành công!'
                    ]);
                }else{
                    echo json_encode([
                        'code' => 404,
                        'message' => 'Tài khoản không tìm thấy!'
                    ]);
                }
            }else{
                echo json_encode([
                    'code' => 404,
                    'message' => 'Tài khoản không tìm thấy!'
                ]);
            }
        } else {
            echo json_encode([
                'code' => 401,
                'message' => 'Lỗi xác thực tài khoản!'
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
