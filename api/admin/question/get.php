<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');

//kiểm tra phương thức truy vấn phải POST hay không
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $allHeader = getallheaders();
    $jwt = new Middleware;
    $user = $jwt->decode($allHeader);

    if ($user) {
        $data = json_decode(file_get_contents("php://input", true));
        if(!isset($data->page) &&  !isset($_GET['page'])){
            echo json_encode([
                'code' => 400,
                'message' => 'Vui lòng cung cấp thông tin cho biến page (trang dữ liệu)!'
            ]);
            return;
        }

        if(!isset($data->pageSize) &&  !isset($_GET['pageSize'])){
            echo json_encode([
                'code' => 400,
                'message' => 'Vui lòng cung cấp thông tin cho biến pageSize( số dòng dữ liệu )!'
            ]);
            return;
        }

        if(!isset($data->search) && !isset($_GET['search'])){
            echo json_encode([
                'code' => 400,
                'message' => 'Vui lòng cung cấp thông tin cho biến search( từ khóa tìm kiếm, mặc định là "")!'
            ]);
            return;
        }

        $group_id  = isset($data->group_id)?$data->group_id:0;
        


        $page = $data ? $data->page : $_GET['page'];
        $pageSize = $data ? $data->pageSize : $_GET['pageSize'];
        $search = $data ? $data->search : $_GET['search'];

        $skip = ($page - 1) * $pageSize;

        $filter = "(title like '%{$search}%'
              OR option_a like '%{$search}%'
              OR option_b like '%{$search}%'
              OR option_c like '%{$search}%'
              OR option_d like '%{$search}%'
              OR answer like '%{$search}%')";

        $filter .= $group_id>0?" AND questions.group_id = {$group_id}":"";

        $join ="INNER JOIN Groups ON questions.group_id = groups.id";

        $order = "group_id";

        $obj->select('questions', "groups.name AS `group`,questions.id,questions.title", $join, $filter, $order, $skip, $pageSize);
        $questions = $obj->getResult();

        $obj->total('questions', "*", $join, $filter);
        $totalRows = (int) ($obj->getResult()[0]['Total']);
        $pages = $totalRows % $pageSize == 0 ? $totalRows / $pageSize : floor($totalRows / $pageSize) + 1; //tính số trang
        if ($questions) {
            echo json_encode([
                'code' => 200,
                'message' => 'Lấy danh sách câu hỏi thành công!',
                'questions' => $questions,
                'pages' => $pages
            ]);
        }
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}