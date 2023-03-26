<footer>

</footer>
<? include_once('./modals/modalProfile.php') ?>
<script>
    function GetUser() {
        if (!getToken()) {
            $(location).prop('href', './login.php')
        }
        $.ajax({
            url: './api/user/account/read.php',
            type: 'get',
            headers: {
                'Authorization': getToken(),
                'Content-Type': 'application/json'
            },
            success: function (data) {
                if (data.code == 200) {
                    $('#right-nav').show();
                    $('#spFullname').text(data.account.fullname);
                    $('#aHistory').show();

                    $('#txtProfileUsername').val(data.account.username);
                    $('#txtProfileFullname').val(data.account.fullname);
                    $('#txtProfilePhone').val(data.account.phone);
                    $('#txtProfileEmail').val(data.account.email);
                    $('#txtProfileAddress').val(data.account.address);
                } else {
                    $.toast({
                        heading: 'Error',
                        text: data.message,
                        showHideTransition: 'fade',
                        icon: 'error'
                    });
                    $(location).prop('href', './login.php')
                }

            },
            error: function (request, status, error) {
                console.log(request.responseText);
                $(location).prop('href', './login.php')
            }
        })
    }

    function getToken() {
        return localStorage.getItem('token');
    }
    $('.aProfile').click(function (e) {
        e.preventDefault();        
        $('#modalProfile').modal();
    })

    $('.aLogout').click(function (e) {
        e.preventDefault();
        localStorage.removeItem('token');
        $(location).prop('href', './login.php')
    })
</script>