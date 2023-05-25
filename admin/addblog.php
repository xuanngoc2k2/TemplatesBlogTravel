<?php
include '../lib/session.php';
Session::checkSession();
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
}
include '../classes/Blog.php';
?>
<?php
$blog = new Blog();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $insert_blog = $blog->insertBlog($_POST,$_FILES);
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

    <title>Add Blog</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include 'inc/sidebar.php'
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include 'inc/topbar.php'
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Thêm Blog</h1>
                    <?php
                    if (isset($insert_blog)) {
                        echo $insert_blog;
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-5 col-sm-12">
                            <form class="user" style="width: 500px; max-width: 100%;" method="post" action="addblog.php" enctype="multipart/form-data">
                                <div class="form-group" style="font-size: 18px;">
                                    <label>Tiêu đề Blog</label>
                                    <input class="form-control form-control-user" 
                                    style="font-size: 18px;" 
                                    name="blogTitle" 
                                    placeholder="Nhập tiêu đề blog ..." />
                                    <label>Chi tiết Blog</label>
                                    <textarea class="form-control" style="font-size: 18px;" name="blogDetail" placeholder="Nhập chi tiết blog ..."></textarea>
                                    <label style="margin-top: 10px;">Ảnh Blog</label>
                                    <input type="file" name="blogImage" id="blogImage" />
                                    <label style="margin-top: 10px;">Kiểu hiển thị: </label>
                                    <select style="text-align: center;" name="blogType">
                                        <option value="">-----Chọn kiểu hiển thị-----</option>
                                        <option value="0">Image Left</option>
                                        <option value="1">Image Right</option>
                                        <option value="2">Hide</option>
                                    </select>
                                </div>
                                <input style="font-size: 18px;" class="btn btn-primary btn-user btn-block" type="submit" name="submit" value="Tạo" />
                            </form>
                        </div>

                        <div class="col-md-7 col-sm-12">
                            <img id="showImage" style="max-width: 100%;" src="" alt="Ảnh Blog" />
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Ngọc CNTT2</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
    <script type="text/javascript">
        let inputFile = document.getElementById('blogImage');
        inputFile.onchange = function(){
            let files = this.files;
            if(files.length !==0){
                let obj = new FileReader();
                obj.onload = function(data){
                    document.getElementById('showImage').src = data.target.result;
                }
                obj.readAsDataURL(files[0]);
            }
        }
    </script>
</body>

</html>