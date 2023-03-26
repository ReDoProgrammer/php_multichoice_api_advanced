<?php 
	include('../../connect.php');

	$search = $_GET['search'];
	$page = $_GET['page'];
	$sql = $conn->prepare("SELECT * FROM taikhoan where username like '%".$search."%' or fullname like '%".$search."%' or phone like '%".$search."%' or email like '%".$search."%' limit 30 offset ".($page-1)*30);
	$sql->execute();
	$index = 1;
	$data='';
	while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {			    
	   	$data.= '<tr username='.$result['username'].'>';
	     	$data.=  '<td scope="row">'.($index++).'</td>';
	     	$data.= '<td class="text-primary">';
			$data.= '<button class="btn btn-xs btn-info" name="result">';
			$data.= 'Bảng điểm';
			$data.='</button><span style="margin-left:5px; font-weight:bold;">';
			$data.= $result['username'].'</span></td>';
	     	$data.= '<td class="text-info">'.$result['fullname'].'</td>';
	     	$data.= '<td>'.$result['phone'].'</td>';
	     	$data.= '<td>'.$result['email'].'</td>';
	     	$data.= '<td>'.$result['address'].'</td>';
	     	
	     	$data.= '<td class="text-right">';
	     	$data.=    '<input type="button" class="btn btn-xs btn-info" value="Xem" name="view"> &nbsp;';
	     	$data.=    '<input type="button" class="btn btn-xs btn-warning" value="Sửa" name="update">&nbsp;';
	     	$data.=    '<input type="button" class="btn btn-xs btn-danger" value="Xóa" name="delete"> ';
		     
	 		$data.= '</td>'	;		     
	  	$data.= '</tr>';
	}
	echo $data;
?>