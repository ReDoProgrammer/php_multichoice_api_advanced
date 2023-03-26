<div id="modalLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Đăng nhập để thực hiện bài thi</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Tài khoản:</label>
                    <input type="text" placeholder="Tài khoản của bạn" id="txtUsername" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu:</label>
                    <input type="password" placeholder="Mật khẩu" id="txtPassword" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="btnLogin">Đăng nhập</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>
    $('#btnLogin').click(function () {
        let username = $('#txtUsername').val();
        let password = $('#txtPassword').val();
        data = {
            'username': username,
            'password': password
        }
        $.ajax({
            url: './api/user/account/login.php',
            type: 'post',
            data: JSON.stringify(data),
            success: function (data) {
                if (data.code == 200) {
                    $.toast({
                        heading: 'Success',
                        text: data.message,
                        showHideTransition: 'fade',
                        icon: 'info'
                    });

                    $('#modalLogin').modal('hide');
                    localStorage.token = data.token;
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
                console.log(request.responseText);
            }
        })
    })
</script>