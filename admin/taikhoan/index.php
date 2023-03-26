<?php include_once('../layout/header.php') ?>

<div class="container-fluid">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../">PHP API</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="../">Câu hỏi</a></li>
				<li class="active"><a href="./" id="aHistory">Tài khoản</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right" id="right-nav">
				<li><a href="#" id="aProfile"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
				<li><a href="#" id="aLogout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
</div>
<div class="container">
	<div class="row">

		<!-- phần tìm kiếm -->
		<div class="col-sm-4">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Tìm kiếm" id="txtSearch" />
				<div class="input-group-btn">
					<button class="btn btn-primary" id="btnSearch">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</div>
			</div>
		</div>
		<!-- kết thúc phần tìm kiếm -->

		<div class="col-sm-8 text-right">
			<button id="btnAccount" class="btn btn-success" type="button" data-toggle="modal" data-target="#modalTaiKhoan">+</button>
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
		<tbody id="tblAccounts">
		</tbody>
	</table>

	<ul class="pagination pagination-sm" id="pagination">
		<li><a href="#">1</a></li>
	</ul>
</div>
<?php include_once('../layout/footer.php') ?>



<?php include_once('../../components/modals/modalAccount.php') ?>
<?php include_once('../../components/modals/modalHistory.php') ?>
<?php include_once('../../components/modals/modalExamDetail.php') ?>
<?php include_once('../../components/modals/modalProfile.php') ?>


<script type="text/javascript">



	var page = 1;
	var pageSize = 5;
	var search = "";
	var idx = 0;
	var user_id = -1;
	var withHis = true;// thuoc tinh danh dau mo modal history

	$(document).ready(function() {
		GetUser();
		$('#btnSearch').click();
	});


	$('#btnAccount').click(function() {
		$('.modal-title').text('Thêm mới tài khoản');
		$('#modalAccount').modal();
		ResetInputs(true)
	});
	$(document).on('click', "button[name='btnViewExam']", function() {
		exam_id = $(this).closest('tr').attr('id');
		$.ajax({
			url: '../../api/admin/examination/detail.php',
			type: 'get',
			dataType: 'json',
			headers: {
				'Authorization': getToken(),
				'Content-Type': 'application/json'
			},
			data: {
				id: exam_id
			},
			success: function(data) {
				if (data.code == 200) {

					let result = JSON.parse(data.result);
					let index = 1;
					$('#modalHistory').modal('hide');
					$('#modalExamDetail').modal();
					result.forEach(r => {
						$('#tblExamDetail').empty();
						GetQuestion(r, index++);
					})


				} else {
					$.toast({
						heading: 'Error',
						text: data.message,
						showHideTransition: 'fade',
						icon: 'error'
					})
				}
			},
			error: function(request, status, error) {
				alert(request.responseText);
				console.log(request.responseText);
			}
		});
	})


	function GetQuestion(question, index) {
		$.ajax({
			url: '../../api/admin/question/detail.php',
			type: 'get',
			dataType: 'json',
			headers: {
				'Authorization': getToken(),
				'Content-Type': 'application/json'
			},
			data: {
				id: question.id
			},
			success: function(data) {
				q = data.question;

				let d = '';
				d += '<div class="row" style = "margin-left:10px;" id="question_' + q.id + '"> ';
				d += '<h5 style="font-weight:bold;" id="' + q.id + '"> <span class="text-danger">Câu ' + index + ': </span><strong>' + q.title + '</strong></h5>';

				d += '<fieldset>';
				d += '<div class="radio col-md-12 ">';
				if (question.choice == 'A') {
					d += '<label class = "A"><input type="radio" onclick="return false;" checked class="A" name = "' + q.id + '"><span class="text-danger">A: </span>' + q.option_a + '</label>';
				} else {
					d += '<label class = "A"><input type="radio" onclick="return false;"  class="A" name = "' + q.id + '"><span class="text-danger">A: </span>' + q.option_a + '</label>';
				}

				d += '</div>';

				d += ' <div class="radio col-md-12">';
				if (question.choice == 'B') {
					d += '<label class = "B"><input type="radio"  checked onclick="return false;" class="B" name = "' + q.id + '"><span class="text-danger">B: </span>' + q.option_b + '</label>';
				} else {
					d += '<label class = "B"><input type="radio"  onclick="return false;" class="B" name = "' + q.id + '"><span class="text-danger">B: </span>' + q.option_b + '</label>';
				}
				d += '</div>';

				d += '<div class="radio  col-md-12">';
				if (question.choice == 'C') {
					d += '<label class = "C"><input type="radio" onclick="return false;" checked class="C" name = "' + q.id + '"><span class="text-danger">C: </span>' + q.option_c + '</label>';
				} else {
					d += '<label class = "C"><input type="radio" onclick="return false;" class="C" name = "' + q.id + '"><span class="text-danger">C: </span>' + q.option_c + '</label>';
				}
				d += '</div>';

				d += '<div class="radio col-md-12">';
				if (question.choice == 'D') {
					d += '<label class = "D"><input type="radio" onclick="return false;" checked class="D" name = "' + q.id + '"><span class="text-danger">D: </span>' + q.option_d + '</label>';
				} else {
					d += '<label class = "D"><input type="radio" onclick="return false;" class="D" name = "' + q.id + '"><span class="text-danger">D: </span>' + q.option_d + '</label>';
				}
				d += '</div>';
				d += '</fieldset>';
				d += '</div>';

				$('#tblExamDetail').append(d);
				$('#question_' + question.id + ' > fieldset > div > label.' + q.answer).css("background-color", "yellow");
			}
		});
	}


	$(document).on('click', "button[name='btnHistory']", function() {
		uid = $(this).closest('tr').attr('id'); // lấy id của dòng đc chọn trên table khi click vào button có tên là update
		$.ajax({
			url: '../../api/admin/examination/get.php',
			type: 'get',
			dataType: 'json',
			headers: {
				'Authorization': getToken(),
				'Content-Type': 'application/json'
			},
			data: {
				user_id: uid
			},
			success: function(data) {
				if (data.code == 200) {
					$('#modalHistory').modal();
					$('#tblHistory').empty(); //set tbody trống trước khi đổ dữ liệu
					let idx = 0;
					data.exams.forEach(ex => {
						let tr = `<tr id="${ex.id}">`;
						tr += `<td>${++idx}</td>`;
						tr += `<td>${ex.exam_date}</td>`;
						tr += `<td>${ex.mark}</td>`;
						tr += `<td class="text-right">
					    <button class="btn btn-xs btn-info"name="btnViewExam">Chi tiết</button>
					    
					</td>`;
						$('#tblHistory').append(tr);
					})


				} else {
					$.toast({
						heading: 'Error',
						text: data.message,
						showHideTransition: 'fade',
						icon: 'error'
					})
				}
			},
			error: function(request, status, error) {
				alert(request.responseText);
				console.log(request.responseText);
			}
		});



	});

	$(document).on('click', "button[name='btnDelete']", function() {

		var trid = $(this).closest('tr').attr('id'); // lấy id của dòng đc chọn trên table khi click vào
		Swal.fire({
			title: 'Bạn có chắc muốn xóa tài khoản này?',
			showDenyButton: true,
			confirmButtonText: 'Yes'
		}).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				$.ajax({
					url: '../../api/admin/account/delete.php',
					type: 'delete',
					headers: {
						'Authorization': getToken(),
						'Content-Type': 'application/json'
					},
					data: JSON.stringify({
						"id": trid
					}),
					success: function(data) {
						if (data.code == 200) {
							$.toast({
								heading: 'Success',
								text: data.message,
								showHideTransition: 'fade',
								icon: 'success'
							})
							ReadData();
						} else {
							$.toast({
								heading: 'Error',
								text: data.message,
								showHideTransition: 'fade',
								icon: 'error'
							})
						}
					},
					error: function(request, status, error) {
						// alert(request.responseText);
						console.log(request.responseText);
					}
				});
			}
		})


	});

	$(document).on('click', "button[name='btnEdit']", function() {
		$('.modal-title').text('Cập nhật câu hỏi');
		user_id = $(this).closest('tr').attr('id'); // lấy id của dòng đc chọn trên table khi click vào button có tên là update
		GetDetail(); //lấy dữ liệu câu hỏi dựa vào id tìm đc ở trên và đổ dữ liệu cho các input
	});


	function GetDetail() { //hàm lấy câu hỏi dựa vào id câu hỏi
		$.ajax({
			url: '../../api/admin/account/detail.php',
			type: 'get',
			headers: {
				'Authorization': getToken(),
				'Content-Type': 'application/json'
			},
			data: {
				id: user_id
			},
			success: function(data) {
				if (data.code == 200) {
					$('#txtUsername').val(data.account.username);
					$('#txtPassword').val('123');
					$('#txtConfirmPassword').val('123');
					$('#txtFullname').val(data.account.fullname);
					$('#txtPhone').val(data.account.phone);
					$('#txtEmail').val(data.account.email);
					$('#txtAddress').val(data.account.address);
				}

				$('#modalAccount').modal();
			},
			error: function(request, status, error) {
				// alert(request.responseText);
				console.log(request.responseText);
			}

		});
	}


	function ReadData() {
		data = {
			'page': page,
			'search': search
		}
		$.ajax({
			url: '../../api/admin/account/get.php',
			type: 'get',
			dataType: 'json',
			headers: {
				'Authorization': getToken(),
				'Content-Type': 'application/json'
			},
			data: {
				page,
				search,
				pageSize
			},
			success: function(data) {
				if (data.code == 200) {
					console.log(data)
					$('#tblAccounts').empty(); //set tbody trống trước khi đổ dữ liệu
					data.accounts.forEach(acc => {
						let tr = `<tr id="${acc.id}">`;
						tr += `<td>${++idx}</td>`;
						tr += `<td>${acc.username}</td>`;
						tr += `<td class="font-weight-bold text-primary"><strong>${acc.fullname}</strong></td>`;
						tr += `<td>${acc.phone}</td>`;
						tr += `<td>${acc.email}</td>`;
						tr += `<td>${acc.address}</td>`;
						tr += `<td class="text-right">
					    <button class="btn btn-xs btn-info"name="btnHistory">Lịch sử thi</button>
					    <button class="btn btn-xs btn-warning"name="btnEdit">Sửa</button>
					    <button class="btn btn-xs btn-danger ml-2"name="btnDelete">Xóa</button>
					</td>`;
						$('#tblAccounts').append(tr);
					})
					Pagination(data.pages);

				} else {
					$.toast({
						heading: 'Error',
						text: data.message,
						showHideTransition: 'fade',
						icon: 'error'
					})
				}
			},
			error: function(request, status, error) {
				window.location.href = `../login.php`;
				console.log(request.responseText);
			}
		});
	}


	$('#btnSearch').click(function() {
		page = 1;
		idx = 0;
		search = $('#txtSearch').val().trim();
		ReadData();
	});



	$("#pagination").on("click", "li a", function(event) {
		event.preventDefault();
		page = $(this).text();
		idx = (page - 1) * pageSize;
		var $activeLi = $('#pagination').find("li.active");
		$activeLi.removeClass('active');
		ReadData();
	});

	function Pagination(pages) {
		$('#pagination').empty();
		if (page > pages) {
			page = 1;
		}
		if (pages > 1) {
			$('#pagination').show();
			let pagi = '';
			for (i = 1; i <= pages; i++) {
				if (i == page) {
					pagi += '<li class="page-item active" ><a class="page-link" href="#">' + i + '</a></li>';
				} else {
					pagi += '<li class="page-item" ><a class="page-link" href="#">' + i + '</a></li>';
				}

			}
			$('#pagination').append(pagi);
		}

	}
	$('#txtSearch').on('keypress', function(e) {
		if (e.which === 13) {
			$('#btnSearch').click();
		}
	});




	function GetUser() {
		$.ajax({
			url: '../../api/admin/account/read.php',
			type: 'get',
			headers: {
				'Authorization': getToken(),
				'Content-Type': 'application/json'
			},
			success: function(data) {
				if (data.code != 200) {
					window.location.href = `../login.php`; // trả về trang chủ của admin
				}
				$('#txtProfileUsername').val(data.account.username);
				$('#txtProfileFullname').val(data.account.fullname);
				$('#txtProfilePhone').val(data.account.phone);
				$('#txtProfileEmail').val(data.account.email);
				$('#txtProfileAddress').val(data.account.address);
			},
			error: function(request, status, error) {
				window.location.href = `../login.php`;
			}

		})
	}

	function getToken() {
		return localStorage.getItem('token');
	}
</script>

<script>
  $('#btnSubmitAccount').click(function() {
    let username = $('#txtUsername').val();
    let password = $('#txtPassword').val();
    let confirm_password = $('#txtConfirmPassword').val();
    let fullname = $('#txtFullname').val();
    let phone = $('#txtPhone').val();
    let email = $('#txtEmail').val();
    let address = $('#txtAddress').val();


    if (username.trim().length == 0) {
      $.toast({
        heading: 'Warning',
        text: 'Vui lòng nhập tài khoản!',
        showHideTransition: 'fade',
        icon: 'warning'
      })
      return; //neu chua nhap username thi dung chuong trinh ngang day, k chay tiep cac cau lenh phia duoi
    }

    if (password.trim().length == 0 || confirm_password.trim().length == 0) {
      $.toast({
        heading: 'Warning',
        text: 'Vui lòng nhập đầy đủ mật khẩu!',
        showHideTransition: 'fade',
        icon: 'warning'
      })
      return;
    }

    if (password != confirm_password) {
      $.toast({
        heading: 'Warning',
        text: 'Hai lần nhập mật khẩu không khớp!',
        showHideTransition: 'fade',
        icon: 'warning'
      })
      return;
    }



    if (user_id <= 0) { //trường hợp thêm mới tài khoản
      $.ajax({
        url: '../../api/admin/account/create.php',
        type: 'post',
        dataType: 'json',
        headers: {
          'Authorization': getToken(),
          'Content-Type': 'application/json'
        },
        data: JSON.stringify({
          'username': username,
          'password': password,
          'fullname': fullname,
          'phone': phone,
          'email': email,
          'address': address
        }),
        success: function(data) {
          if (data.code == 201) {
            $.toast({
              heading: 'Success',
              text: data.message,
              showHideTransition: 'fade',
              icon: 'info'
            });

            $('#btnSearch').click();
            ResetInputs(true);
          } else {
            $.toast({
              heading: 'Error',
              text: data.message,
              showHideTransition: 'fade',
              icon: 'error'
            });
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    } else {
      $.ajax({
        url: '../../api/admin/account/update.php',
        type: 'put',
        dataType: 'json',
        headers: {
          'Authorization': getToken(),
          'Content-Type': 'application/json'
        },
        data: JSON.stringify({
          'id': user_id,
          'password': password,
          'fullname': fullname,
          'phone': phone,
          'email': email,
          'address': address
        }),
        success: function(data) {
          if (data.code == 200) {
            $.toast({
              heading: 'Success',
              text: data.message,
              showHideTransition: 'fade',
              icon: 'info'
            });

            $('#btnSearch').click();
            $('#modalAccount').modal('hide');
          } else {
            $.toast({
              heading: 'Error',
              text: data.message,
              showHideTransition: 'fade',
              icon: 'error'
            });
          }
        },
        error: function(request, status, error) {
          console.log(request.responseText);
        }
      });
    }

  })

  $('#modalAccount').on('hidden.bs.modal', function() {
    ReadData();
    ResetInputs(true);
  })

  function ResetInputs(is_new = false) {
    user_id = is_new ? -1 : user_id;

    //set về giá trị mặc định cho text input
    $('#txtUsername').val('');
    $('#txtPassword').val('');
    $('#txtConfirmPassword').val('');
    $('#txtFullname').val('');
    $('#txtPhone').val('');
    $('#txtEmail').val('');
    $('#txtAddress').val('');

    //trả về trạng thái readonly = false cho các input
    $('#txtUsername').prop('readonly', is_new ? false : true);
    $('#txtPassword').prop('readonly', is_new ? false : true);
    $('#txtConfirmPassword').prop('readonly', is_new ? false : true);
    $('#txtFullname').prop('readonly', is_new ? false : true);
    $('#txtAddress').prop('readonly', is_new ? false : true);
    $('#txtPhone').prop('readonly', is_new ? false : true);

    if (is_new) {
      $('#btnSubmit').show();
    } else {
      $('#btnSubmit').hide();
    }

  }
</script>