<?php
include_once('../../common.php'); // include file thiết lập chung
include_once('../middleware.php');


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $allHeader = getallheaders();
        $jwt = new Middleware;
        $user = $jwt->decode($allHeader);

        if ($user) {
            $pageSize =0;
            $page = 0;
            $search = "";
            $data = json_decode(file_get_contents("php://input", true));
            if($data){
                $page = $data->page;
                $search = $data->search;
                $pageSize = $data->pageSize;
            }else{
                $page = $_GET['page'];
                $search = $_GET['search'];
                $pageSize = $_GET['pageSize'];
            }

           
            $skip = ($page - 1) * $pageSize;

            $filter = "username like '%{$search}%'
                 OR fullname like '%{$search}%'
                 OR phone like '%{$search}%'
                 OR email like '%{$search}%'    
                 AND is_admin = 0            
            ";

            $obj->select('accounts', "id,username,fullname,email,phone,address", null, $filter, null, $skip, $pageSize);
            $accounts = $obj->getResult();

            $obj->total('accounts', "*", null, $filter);
            $totalRows = (int) ($obj->getResult()[0]['Total']);
            $pages = $totalRows % $pageSize == 0 ? $totalRows / $pageSize : floor($totalRows / $pageSize) + 1; //tính số trang
            if ($accounts) {
                echo json_encode([
                    'code' => 200,
                    'message' => 'Lấy danh sách tài khoản thành công!',
                    'accounts' => $accounts,
                    'pages' => $pages
                ]);
            }

        } else {
            echo json_encode([
                'code' => 404,
                'message' => 'Không tìm thấy tài khoản phù hợp!'
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            'code' => 500,
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'code' => 403,
        'message' => 'Truy cập bị từ chối!'
    ]);
}
?>