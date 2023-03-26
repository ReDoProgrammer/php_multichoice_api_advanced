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
        $noq = $data->noq;//number of question số câu hỏi
          
        $obj->select('questions', "*", null,null,"RAND()",null, $noq);
        $questions = $obj->getResult();     
        
        if($questions){
            echo json_encode([
                'code' => 200,
                'message' => 'Lấy đề thi thành công!',
                'questions'=>$questions               
            ]);
        }
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}
?>