<div id="modalProfile" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="mdlTitle">Thông tin tài khoản</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Tài khoản</label>
                    <input type="text" placeholder="Tài khoản đăng nhập" id="txtProfileUsername" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" placeholder="Họ và tên" id="txtProfileFullname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Điện thoại</label>
                    <input type="text" placeholder="Điện thoại" id="txtProfilePhone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" placeholder="Email" id="txtProfileEmail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <input type="text" placeholder="Địa chỉ" id="txtProfileAddress" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu hiện tại</label>
                    <input type="password" placeholder="Mật khẩu" id="txtProfilePassword" class="form-control">
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btnUpdateProfile">
                    Xác nhận
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>
    $('#btnUpdateProfile').click(function() {
        let fullname = $('#txtProfileFullname').val();
        let phone = $('#txtProfilePhone').val();
        let email = $('#txtProfileEmail').val();
        let address = $('#txtProfileAddress').val();
        let password = $('#txtProfilePassword').val();
        if (fullname.trim().length == 0) {
            $.toast({
                heading: 'Warning',
                text: 'Vui lòng nhập họ tên!',
                showHideTransition: 'fade',
                icon: 'warning'
            })
            return; //neu chua nhap username thi dung chuong trinh ngang day, k chay tiep cac cau lenh phia duoi
        }
        if (password.trim().length == 0) {
            $.toast({
                heading: 'Warning',
                text: 'Vui lòng nhập đầy đủ mật khẩu!',
                showHideTransition: 'fade',
                icon: 'warning'
            })
            return;
        }



        $.ajax({
            url: '../api/user/account/update_profile.php',
            type: 'put',
            headers: {
                'Authorization': getToken(),
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                "fullname": fullname,
                "password": password,
                "phone": phone,
                "email": email,
                "address": address
            }),
            success: function(data) {
                if (data.code == 200) {
                    $.toast({
                        heading: 'Success',
                        text: data.message,
                        showHideTransition: 'fade',
                        icon: 'info'
                    });

                    $('#modalProfile').modal('hide');
                } else {
                    $.toast({
                        heading: 'Error',
                        text: data.message,
                        showHideTransition: 'fade',
                        icon: 'error'
                    })
                }
            },
            error: function (request, status, error) {
                $.toast({
                        heading: 'Error',
                        text: request.responseText,
                        showHideTransition: 'fade',
                        icon: 'error'
                    })
                    console.log(request.responseText);
                }
        })
    })
</script>