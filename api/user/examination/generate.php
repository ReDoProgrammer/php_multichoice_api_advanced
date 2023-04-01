<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');

//kiểm tra phương thức truy vấn phải POST hay không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $allHeader = getallheaders();
    $jwt = new Middleware;
    $user = $jwt->decode($allHeader);

    if ($user) {   

        $data = json_decode(file_get_contents("php://input", true));
        if(!isset($data->noq) && !isset($_POST['noq'])){
            echo json_encode([
                'code' => 400,
                'message' => 'Vui lòng nhập số lượng câu hỏi (noq)!'
            ]);
            return;
        }
        if(!isset($data->level) && !isset($_POST['level'])){
            echo json_encode([
                'code' => 400,
                'message' => 'Vui lòng nhập mức độ khó (level)!'
            ]);
            return;
        }

        $noq = $data?$data->noq:$_POST['noq'];//number of question 
        $level = $data?$data->level:$_POST['level'];// hardness level of questions  
        $array = array(1,10);
        $result = $obj->call_proc("GetQuestions",$array);
        print_r($result);
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}
?>