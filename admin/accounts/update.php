<?php
	include('../../connect.php');

	
	try {
		//lấy các giá trị đã được truyền từ view	
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fullname = $_POST['fullname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$address = $_POST['address'];

		$sql = "update taikhoan "; 
		$sql = $sql."set fullname ='".$fullname."',";
		$sql = $sql."password ='".$password."',";
		$sql = $sql."phone ='".$phone."',";
		$sql = $sql."email ='".$email."',";
		$sql = $sql."address ='".$address."' ";		
		$sql = $sql."where username = '".$username."'";

		if ($conn->query($sql) == TRUE) {
		  echo "Cập nhật tài khoản thành công!";
		} else {
		  echo "Cập nhật tài khoản thất bại!";
		}
	} catch (Exception $e) {
		echo "Lỗi cập nhật tài khoản: ".$e;
	}
?>