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
        $id = $data?$data->id:$_GET['id'];

        $filter = "id = '{$id}'";

        $obj->select('results', "result", null,$filter,null,null, null);
        $examinations = $obj->getResult();
       
        if($examinations){
            echo json_encode([
                'code' => 200,
                'message' => 'Lấy chi tiết kết quả bài thi thành công!',
                'results'=>$examinations[0]['result']               
            ]);
        }else{
            echo json_encode([
                'code' => 404,
                'message' => 'Không tìm thấy kết quả bài thi phù hợp!'                           
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