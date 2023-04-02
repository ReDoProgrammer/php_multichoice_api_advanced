<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');

//kiểm tra phương thức truy vấn phải POST hay không
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $allHeader = getallheaders();
    $jwt = new Middleware;
    $user = $jwt->decode($allHeader);

    if ($user) {
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $request = isset($data['input']) ? $data['input'] : $_POST['input'];

            $someArray = json_decode($request, true);
            $questions = [];
            foreach ($someArray as $item) {
                $level = $item['level'];
                $noq = $item['noq'];
                $questions =array_merge($questions,json_decode($obj->call_proc("GetQuestions",array($level,$noq))));               
            }
            echo json_encode([
                'code' => 200,
                'message' => 'Lấy đề thi thành công!',
                'questions'=>$questions
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                'code' => 500,
                'message' => `Lỗi tạo đề thi {$th->getMessage()}!`              
            ]);
        }
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}
