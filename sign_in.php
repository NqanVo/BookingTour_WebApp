 <?php
    session_start();
    include('quanly/config/config.php');
    if (isset($_POST['dangnhap_user'])) {
        $taikhoan = $_POST['taikhoan_user'];
        $matkhau = md5($_POST['matkhau_user']);

        //tạo select mẩu
        $taikhoan_select = "SELECT * FROM tbl_nhanvien WHERE tbl_nhanvien.taikhoan_nhanvien =? AND tbl_nhanvien.matkhau_nhanvien =?";
        //kết nối stmt với sql
        $stmt = mysqli_stmt_init($mysqli);
        //kiểm tra xem chuẩn bị đủ stmt vs mẩu select chưa
        if (mysqli_stmt_prepare($stmt, $taikhoan_select)) {
            //gán biến cho ? theo chứ tự tương ứng, s = string, d = double, i = int
            mysqli_stmt_bind_param($stmt, "ss", $taikhoan, $matkhau);
            //thực thi select
            mysqli_stmt_execute($stmt);
            $taikhoan_query = mysqli_stmt_get_result($stmt);
            //kiểm tra tài khoản
            $taikhoan_row = mysqli_fetch_array($taikhoan_query);
            $taikhoan_count = mysqli_num_rows($taikhoan_query);
            if ($taikhoan_count == 0 || $taikhoan_row['status_nhanvien'] == 0) {
                echo '<script>window.alert("Thông tin đăng nhập sai hoặc tài khoản đã bị khóa!");</script>';
            } else {
                $_SESSION['user_login'] = $taikhoan_row['id_nhanvien'];
                header("Location:index.php?");
            }
        } else {
            echo '<script>window.alert("prepare error!");</script>';
        }
    }

    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
     <link rel="stylesheet" href="./assets/font-icon/themify-icons/themify-icons.css">
     <link rel="stylesheet" href="./assets/css/base.css">
     <link rel="stylesheet" href="./assets/css/grid.css">
     <link rel="stylesheet" href="./assets/css/main.css">
     <link rel="stylesheet" href="./assets/css/responsive.css">
     <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3125/3125848.png">
     <title>TravelVietNam</title>

     <style>
         body {
             height: 100vh;
             /* background-image: radial-gradient(circle, #19cdf0, #00b9f7, #00a4fd, #008bfb, #196ef0); */
             background-image: url('https://storage.ko-fi.com/cdn/useruploads/display/80c9a163-20ac-45f1-aa90-1324e7e8be54_6ov01beacha.gif');
             background-repeat: no-repeat;
             background-position: center;
             background-size: cover;
         }

         .desc-login {
             font-style: italic;
         }
     </style>
 </head>

 <body>
     <!-- dang nhap  -->
     <form action="" method="POST" autocomplete="off">
         <div class="container-login">
             <div class="grid widd">
                 <div class="row no-gutters">
                     <div class="col l-12 c-12">
                         <div class="container-login__box">
                             <h1 class="container-login__box-heading">Đăng nhập</h1>
                             <span class="container-login__box-heading desc-login">Travel VietNam</span>
                             <div class="container-login__box__group">
                                 <h3 class="container-login__box__group-label">Tài khoản</h3>
                                 <input type="text" name="taikhoan_user" placeholder="Tài khoản và mật khẩu: admin" class="input-df container-login__box__group-input" required>
                             </div>
                             <div class="container-login__box__group">
                                 <h3 class="container-login__box__group-label">Mật khẩu</h3>
                                 <div class="container-login__box__group-input-icon">
                                     <input type="password" name="matkhau_user" class="input-df container-login__box__group-input container-login__box__group-input-passwrod" required>
                                     <i class="fa-solid fa-eye container-login__box__group-icon"></i>
                                     <i class="fa-solid fa-eye-slash container-login__box__group-icon showHidePw"></i>
                                 </div>
                             </div>
                             <input type="submit" name="dangnhap_user" value="Đăng nhập" class="btn-m btn-main container-login__box-btn"></input>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </form>
     <script src="./assets/javascript/javascript.js"></script>
 </body>

 </html>