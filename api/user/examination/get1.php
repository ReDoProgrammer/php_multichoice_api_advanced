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

        $pageSize = $data ? $data->pageSize : $_GET['pageSize'];
        $page = $data ? $data->page : $_GET['page'];
        $skip = ($page - 1) * $pageSize;
        $id = $user['id'];
        $filter = "user_id = '{$id}'";

        $obj->select('results', "*", null, $filter, "id DESC", $skip, $pageSize);
        $exams = $obj->getResult();

        $obj->total('results', "*", null, $filter);
        $totalRows = (int) ($obj->getResult()[0]['Total']);
        $pages = $totalRows % $pageSize == 0 ? $totalRows / $pageSize : floor($totalRows / $pageSize) + 1; //tính số trang

        if ($exams) {
            echo json_encode([
                'code' => 200,
                'message' => 'Lấy lịch sử thi thành công!',
                'exams' => $exams,
                'pages' => $pages
            ]);
        } else {
            echo json_encode([
                'code' => 404,
                'message' => 'Không tìm thấy kết quả phù hợp!'
            ]);
        }
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}
