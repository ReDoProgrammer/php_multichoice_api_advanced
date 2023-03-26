<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh sách tài khoản người dùng</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>
	<a href="/tracnghiem/admin/">Quản lý ngân hàng câu hỏi</a>
	<div class="container">


		<div class="row">

			<!-- phần tìm kiếm -->
			<div class="col-sm-4">
				 <div class="input-group">
			        <input type="text" class="form-control" placeholder="Tìm kiếm" id="txtSearch"/>
			        <div class="input-group-btn">
			          <button class="btn btn-primary" id="btnSearch">
			            <span class="glyphicon glyphicon-search"></span>
			          </button>
			        </div>
			      </div>    		
    		</div>
    		<!-- kết thúc phần tìm kiếm -->

    		<!-- phần phân trang -->
    		<div class = "col-sm-6">
    			<nav aria-label="Page navigation example" >
				  <ul class="pagination" style="margin:0px; padding-top:0; margin-left:10px;" id="pagination">			    
				    
				   
				  </ul>
				</nav>
    		</div> <!--kết thúc phần phân trang -->
	  		<div class="col-sm-2 text-right">
	  			<button id="btnAddTaiKhoan" class="btn btn-success" type="button" data-toggle="modal" data-target="#modalTaiKhoan">+</button>
	  		</div>
	  	</div>

		<table class="table table-striped">
		  <thead>
		    <tr>

		      <th scope="col">#</th>
		      <th scope="col">Tài khoản</th>
		      <th scope="col">Họ tên</th>
		      <th scope="col">Số điện thoại</th>
              <th scope="col">Email</th>		
		      <th scope="col">Địa chỉ</th>		           
		      <th scope="col"></th>
		    </tr>
		  </thead>
		  <tbody id="tbUsers">     
		  </tbody>
		</table>
	</div>
</body>
</html>
<?php include('modalTaiKhoan.php');?>
<?php include('modalMark.php');?>
<?php include('modalChiTiet.php');?>

<script type="text/javascript">
	var page = 1;
	var search = "";
var usr = '';

	//trong sự kiện trang được load xong thì gọi tới hàm load ds tài khoản
	$(document).ready(function(){

		//kiểm tra xem admin đã đăng nhập hay chưa
		//nếu chưa thì điều hướng về trang đăng nhập của admin
		if(!sessionStorage.adminLogin){
			var base_url = window.location.origin;// lấy đường dẫn gốc                       
			window.location.href = `${base_url}/tracnghiem/admin/login.php`;// trả về trang chủ của admin
		}
		$('#btnSearch').click();
	});

	

	$('#btnSearch').click(function(){
		let search = $('#txtSearch').val().trim();
		ReadData();
		Pagination();
	});

	//sự kiện lấy kết quả thi
	$(document).on('click',"button[name='result']",function() {		
		let username = $(this).closest('tr').attr('username'); // table row ID 	  
		$.ajax({
			url:'marks.php',
			type:'get',
			data:{username},
			success:function(data){				
				$('#modalMarks').modal();
				$('#tbHistory').empty();
     			$('#tbHistory').append(data);
			}
		})
	});


//sự kiện cập nhật tài khoản
	$(document).on('click',"input[name='update']",function() {
		
		usr = $(this).closest('tr').attr('username'); // table row ID 	  
		GetDetail();
		$('#txtUsername').prop('readonly', true);//sửa các thuộc tính khác, ngoại trừ username
	});

//sự kiện của button xem chi tiết tài khoản
	$(document).on('click',"input[name='view']",function() {
		usr = $(this).closest('tr').attr('username'); // table row ID 	  
		GetDetail();
	
		$('#btnSubmit').hide();
		$('#txtUsername').prop('readonly', true);
		$('#txtPassword').prop('readonly', true);
		$('#txtConfirmPassword').prop('readonly', true);
		$('#txtFullname').prop('readonly', true);
		$('#txtAddress').prop('readonly', true);
		$('#txtPhone').prop('readonly', true);
	});

//sự kiện của button xóa tài khoản
	$(document).on('click',"input[name='delete']",function() {
		
	    
	 
	   	if(confirm("Bạn chắc chắn muốn xóa tài khoản này?") == true){
	   		$.ajax({
	   			url:'delete.php',
	   			type:'post',
	   			data:{
	   				username: $(this).closest('tr').attr('username') // lấy id của dòng đc chọn trên table khi click vào
	   			},
	   			success:function(data){
	   				alert(data);
	   				ReadData();
	   			}
	   		});
	   	}
  
	});

//hàm load thông tin tài khoản dựa vào id
	function GetDetail(){//hàm lấy tài khoản dựa vào id tài khoản

		
	   $.ajax({
	   		url:'detail.php',//chỉ đường dẫn tới file detail.php để lấy thông tin tài khoản
	   		type:'get',//phuong thức get
	   		data:{
	   			username:usr //vì username được sử dụng không trùng lặp nên có thể xem nó là khóa chính primary key/ unique
	   		},
	   		success:function(data){   			
				var q = jQuery.parseJSON( data);//ép dữ liệu trả về qua json
				console.log(q);
				$('#modalTaiKhoan').modal();
				$('#txtUsername').val(q.username);
				$('#txtPassword').val(q.password);
				$('#txtConfirmPassword').val(q.password);
				$('#txtFullname').val(q.fullname);
				$('#txtPhone').val(q.phone);
				$('#txtEmail').val(q.email);
				$('#txtAddress').val(q.address);
	   		}

	   });
	}

//hàm load ds tài khoản
	function ReadData(){
		$.ajax({
			url:'view.php',
			type:'get',
			data:{
				search:search,
				page:page
			},
			success:function(data){
				$('#tbUsers').empty();
				$('#tbUsers').append(data);
			}
		});
	}

	 $('#txtSearch').on('keypress', function (e) {
         if(e.which === 13){
	           $('#btnSearch').click();
	         }
	   });




	$("#pagination").on("click", "li a", function(event){
		event.preventDefault();
	    page = $(this).text();
	    ReadData();
	});

	function Pagination(){
		$.ajax({
				url:'pagination.php',
				type:'get',
				data:{
					search:search
				},
				success:function(data){					
					if(data<=1){
						$('#pagination').hide();
					}else{
						$('#pagination').show();
						$('#pagination').empty();
						let pagi = '';
						for(i = 1; i<=data; i++){
							pagi += '<li class="page-item" ><a class="page-link" href="#">'+i+'</a></li>';
						}
						$('#pagination').append(pagi);
					}
				}
			});
	}

</script>