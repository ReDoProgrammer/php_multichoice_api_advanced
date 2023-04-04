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
            if (!isset($data->input) && !isset($_POST['input'])) {
                echo json_encode([
                    'code' => 400,
                    'message' => 'Vui lòng nhập tham số đầu vào input!',
                    'example' => '[{"level":1,"noq":10},{"level":2,"noq":5}]'
                ]);
                return;
            }
            $request = isset($data['input']) ? $data['input'] : $_POST['input'];


            $someArray = json_decode($request, true);
            $questions = [];

            foreach ($someArray as $item) {
                $level = $item['level'];
                $noq = $item['noq'];
                $questions = array_merge($questions, json_decode($obj->call_proc("GetQuestions", array($level, $noq))));
            }
            if (count($questions) > 0) {
                echo json_encode([
                    'code' => 200,
                    'message' => 'Lấy đề thi thành công!',
                    'questions' => $questions
                ]);
                return;
            }

            echo json_encode([
                'code' => 404,
                'message' => 'Không tạo được đề thi phù hợp!'
            ]);


        } catch (\Throwable $th) {
            echo json_encode([
                'code' => 500,
                'message' => 'Lỗi tạo đề thi'. $th->getMessage()
            ]);
        }
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}