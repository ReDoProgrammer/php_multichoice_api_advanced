<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allHeader = getallheaders();
    $jwt = new Middleware;
    $user = $jwt->decode($allHeader);

    if ($user) {
        //lấy các giá trị được truyền từ frontend thông qua phương thức post
        $data = json_decode(file_get_contents("php://input", true));
        $username = $data->username;
        $password =$data->password;
        $fullname = $data->fullname;
        $phone = $data->phone;
        $email = $data->email;
        $address =$data->address;

        //mã hóa mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        /*
        Ràng buộc dữ liệu đầu vào
        Kiểm tra: username, email xem có tồn tại trong csdl hay chưa
        Nếu đã tồn tại thì không insert 
        */
        $obj->select("accounts", "username,email", null, "username='{$username}'",null, null, null);
        $validation = $obj->getResult();

        //Kiểm tra tồn tại username
        if ($validation && $validation[0]["username"] == $username) {
            echo json_encode([
                'code' => 409,
                'message' => 'Tài khoản này đã tồn tại trong hệ thống!'
            ]);
        } else {  
            //kiểm tra tồn tại email
            if ($validation && $validation[0]["email"] == $email) {
                echo json_encode([
                    'code' => 409,
                    'message' => 'Email này đã tồn tại trong hệ thống!'
                ]);
            } else { //không trùng username hoặc email
                //thực hiện insert dữ liệu vào table account trong csdl
                $obj->insert('accounts', [
                    "username" => $username,
                    "password" => $hashedPassword,
                    "fullname" => $fullname,
                    "email" => $email,
                    "phone" => $phone,
                    "address" => $address
                ]);

                $data = $obj->getResult();
                if ($data[0] == 1) {
                    echo json_encode([
                        'code' => 201,
                        'message' => 'Thêm mới tài khoản thành công!'
                    ]);
                } else {
                    echo json_encode([
                        'code' => 500,
                        'message' => 'Thêm mới tài khoản thất bại!'
                    ]);
                }
            }

        }
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}
?>