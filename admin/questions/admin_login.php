<?php
	include('../connect.php');

    //khai bao 2 bien de luu gia tri cua username va password duoc truyen tu view qua phuong thuc post
	$username = $_POST['username'];
	$password = $_POST['password'];


    //tim kiem tai khoan phu hop voi username va password va co quyen admin la true
	$sql = "select * from taikhoan where username = '".$username."' and password = '".$password."' and is_admin = 1";

	$rs = $conn->prepare($sql);
	$rs->execute();	
	$result = $rs->fetch();

	
	echo json_encode($result,JSON_UNESCAPED_UNICODE);
?>