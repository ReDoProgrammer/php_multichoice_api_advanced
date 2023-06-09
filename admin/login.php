<?php include_once('./layouts/head.php') ?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Administrator!</h1>
                                    </div>
                                    <div class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="txtUsername" aria-describedby="emailHelp" placeholder="Enter username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="txtPassword" placeholder="Password">
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" id="btnSubmitLogin">
                                            Login
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>



</body>
<?php include_once('./layouts/footer.php') ?>

<script>
    $('#btnSubmitLogin').click(function(){
        let username = $('#txtUsername').val();
        let password = $('#txtPassword').val();
        console.log({username,password});
    })
</script>