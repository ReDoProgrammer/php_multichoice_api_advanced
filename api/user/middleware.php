<?php
include_once('../../token.php');
class Middleware
{
    /*
    Class này giả lập 1 middleware để kiểm duyệt tính năng đăng nhập
    liên quan tới jwt 
    */
    private $secret_key = "8bb4c78151619ff5aed88dc94bf363b5ad03ba8b";


    public function encode($id, $fullname, $email, $is_admin)
    {      

        $payload = [
            'id' => $id,
            'fullname' => $fullname,
            'email' => $email,
            'is_admin' => $is_admin
        ];
        $token = Token::Sign($payload, $this->secret_key, 10000); //mã hóa jwt
        return $token;
    }

    public function decode($allHeader)
    {
        try {
            $user = null;
            if ($allHeader && isset($allHeader['Authorization'])) {
                $token = $allHeader['Authorization'];

                $user = Token::Verify($token, $this->secret_key);

                if (!$user) {
                    echo json_encode([
                        'code' => 401,
                        'message' => 'Lỗi xác thực tài khoản!'
                    ]);
                    return null;
                }

               
                return $user;
            } else {
                echo json_encode([
                    'code' => 401,
                    'message' => 'Lỗi xác thực tài khoản!'
                ]);
                return null;
            }
        } catch (Exception $e) {
            echo json_encode([
                'code' => 500,
                'message' => $e->getMessage()
            ]);
            return null;
        }
    }
}
?>