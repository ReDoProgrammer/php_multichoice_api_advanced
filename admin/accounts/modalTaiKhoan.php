<div id="modalTaiKhoan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="mdlTitle">Modal Header</h4>
      </div>
      <div class="modal-body">
       <div class="form-group">
        <label for="">Tài khoản</label>
        <input type="text" placeholder="Tài khoản đăng nhập" id="txtUsername" class="form-control">
       </div>
       <div class="form-group col-md-6">
        <label for="">Mật khẩu</label>
        <input type="password" placeholder="Mật khẩu" id="txtPassword" class="form-control">
       </div>
       <div class="form-group col-md-6">
        <label for="">Xác nhận mật khẩu</label>
        <input type="password" placeholder="Xác nhận mật khẩu" id="txtConfirmPassword" class="form-control">
       </div>
       <div class="form-group">
        <label for="">Họ và tên</label>
        <input type="text" placeholder="Họ và tên" id="txtFullname" class="form-control">
       </div>
       <div class="form-group">
        <label for="">Điện thoại</label>
        <input type="text" placeholder="Điện thoại" id="txtPhone" class="form-control">
       </div>
       <div class="form-group">
        <label for="">Email</label>
        <input type="text" placeholder="Email" id="txtEmail" class="form-control">
       </div>
       <div class="form-group">
        <label for="">Địa chỉ</label>
        <input type="text" placeholder="Địa chỉ" id="txtAddress" class="form-control">
       </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" id="btnSubmit">
            Xác nhận
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
    $('#btnSubmit').click(function(){
        let username = $('#txtUsername').val();
        let password = $('#txtPassword').val();
        let confirm_password = $('#txtConfirmPassword').val();
        let fullname = $('#txtFullname').val();
        let phone = $('#txtPhone').val();
        let email = $('#txtEmail').val();
        let address = $('#txtAddress').val();


        if(username.trim().length == 0){
           alert('Vui long nhap ten tai khoan!');
           return;//neu chua nhap username thi dung chuong trinh ngang day, k chay tiep cac cau lenh phia duoi
        }
        
        if(password.trim().length == 0 || confirm_password.trim().length == 0){
            alert('Vui lòng nhập mật khẩu cho tài khoản!');
            return;
        }

        if(password!=confirm_password){
            alert('2 lần nhập mật khẩu không giống nhau!');
            return;
        }

        console.log({username})

        if(usr.trim().length != 0){//cap nhat ai khoan da co
              //tiến hành truy vấn dữ liệu bằng ajax để cập nhật tài khoản vào csdl
              $.ajax({
                          url:'update.php',
                          type:'post',
                          data:{
                              username,
                              password,
                              fullname,
                              phone,
                              email,
                              address
                          },
                          success:function(data){
                              alert(data)
                              $('#modalTaiKhoan').modal('hide');
                              ReadData();
                          }
                      })
        }else{//them moi tai khoan
//tiến hành truy vấn dữ liệu bằng ajax để thêm mới tài khoản vào csdl
            $.ajax({
                        url:'add.php',
                        type:'post',
                        data:{
                            username,
                            password,
                            fullname,
                            phone,
                            email,
                            address
                        },
                        success:function(data){
                            alert(data)
                        }
                    })
        }
        
    })

    $('#modalTaiKhoan').on('hidden.bs.modal', function () {
      ReadData();
      usr = '';//cho dù thêm mới hay sửa thì khi đóng modal cũng trả về giá trị mặc định cho username
      
      //set về giá trị mặc định cho text input
      $('#txtUsername').val('');
				$('#txtPassword').val('');
				$('#txtConfirmPassword').val('');
				$('#txtFullname').val('');
				$('#txtPhone').val('');
				$('#txtEmail').val('');
				$('#txtAddress').val('');

        //trả về trạng thái readonly = false cho các input
        $('#txtUsername').prop('readonly', false);
        $('#txtPassword').prop('readonly', false);
        $('#txtConfirmPassword').prop('readonly', false);
        $('#txtFullname').prop('readonly', false);
        $('#txtAddress').prop('readonly', false);
        $('#txtPhone').prop('readonly', false);

        $('#btnSubmit').show();


})
</script>