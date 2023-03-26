<?php
//set header để truy xuất dữ liệu dạng json
header('Access-Control-Alloow-Origin:*');
header('Access-Control-Allow-Method:POST');
header('Content-Type:application/json');

//include file database
include_once('../../../database/Database.php');
$obj = new Database();
?>

