<?php
    include '../classes/adminlogin.php';
?>
<?php
    $class = new adminlogin();
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        $adminUser = $_POST['adminUser'];
        $adminPass = $_POST['adminPass'];
        
        $login_check = $class->loginadmin($adminUser,$adminPass);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5"
                style="
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50px);
">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url(img/login2.jpg);"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        <span style="color: red;"><?php
                                            if(isset($login_check)){
                                                echo $login_check;
                                            }
                                        ?></span>
                                    </div>
                                    <form class="user" action="login.php" method="post">
                                        <div class="form-group">
                                            <input class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username..."
                                                name="adminUser">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password"
                                                name="adminPass">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input class="btn btn-primary btn-user btn-block" type="submit" value="Login" />
                                        <!--<hr>-->
                                        <!--<a href="#" class="btn btn-google btn-user btn-block">-->
                                        <!--    <i class="fab fa-google fa-fw"></i> Login with Google-->
                                        <!--</a>-->
                                        <!--<a href="#" class="btn btn-facebook btn-user btn-block">-->
                                        <!--    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook-->
                                        <!--</a>-->
                                    </form>
                                    <!--<hr>-->
                                    <!--<div class="text-center">-->
                                    <!--    <a class="small" href="#">Forgot Password?</a>-->
                                    <!--</div>-->
                                    <!--<div class="text-center">-->
                                    <!--    <a class="small" href="#">Create an Account!</a>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>