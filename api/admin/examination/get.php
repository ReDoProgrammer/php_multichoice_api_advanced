<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');

//kiểm tra phương thức truy vấn phải GET hay không
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $allHeader = getallheaders();
    $jwt = new Middleware;
    $user = $jwt->decode($allHeader);

    if ($user) {
        
        $data = json_decode(file_get_contents("php://input", true));
        $user_id = $data?$data->user_id:$_GET['user_id'];

        $filter = "user_id = '{$user_id}'";

        //lấy 10 bài thi gần đây nhất
        $obj->select('results', "id,exam_date,mark", null,$filter,"id DESC",null,10);
        $exams = $obj->getResult();

        
        if($exams){
            echo json_encode([
                'code' => 200,
                'message' => 'Lấy danh sách lịch sử thi thành công!',
                'exams'=>$exams              
            ]);
        }else{
            echo json_encode([
                'code' => 404,
                'message' => 'Không tìm thấy lịch sử bài thi!'               
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