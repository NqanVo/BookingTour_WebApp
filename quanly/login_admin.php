<?php
session_start();
include('config/config.php');

if(isset($_POST['dangnhap_admin']))
{
    $tk = $_POST['taikhoan_admin'];
    $mk = md5($_POST['matkhau_admin']);
    $chuoi_con = "'";
    if (strlen(strstr($tk, $chuoi_con)) > 0) {
        echo '<script>window.alert("Tài khoản không hợp lệ!");</script>';
    }
    else{
        $taikhoan_select = "SELECT * FROM tbl_nhanvien WHERE tbl_nhanvien.taikhoan_nhanvien ='".$tk."' AND tbl_nhanvien.matkhau_nhanvien ='".$mk."'";
        $taikhoan_query = mysqli_query($mysqli, $taikhoan_select);
        $taikhoan_row = mysqli_fetch_array($taikhoan_query);
        $taikhoan_count = mysqli_num_rows($taikhoan_query);
        if($taikhoan_count == 0 || $taikhoan_row['status_nhanvien'] == 0)
        {
            echo '<script>window.alert("Thông tin đăng nhập sai hoặc tài khoản đã bị khóa!");</script>';
            
        }
        else
        {
            if($taikhoan_row['chucvu_nhanvien'] != 0)
            {
                echo '<script>window.alert("Chỉ tài khoản quản lý mới được đăng nhập!");</script>';
            }
            else{
                $_SESSION['login_admin'] = $taikhoan_row['id_nhanvien'];
                header('Location:index.php');
            }       
        }
    }
    }

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/font-icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/login_admin.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
</head>

<body>
    <form method="POST" action="" autocomplete="off">
        <div class="master-login">
            <div class="master-login__box">
                <h1 class="master-login__box-heading">Đăng nhập quản lý</h1>
                <div class="master-login__box-group">
                    <span class="master-login__box-group-label">
                        Tên đăng nhập:
                    </span>
                    <input type="text" name="taikhoan_admin" placeholder="Tài khoản..." required
                        class="master-login__box-group-label-input"></input>
                </div>
                <div class="master-login__box-group">
                    <span class="master-login__box-group-label">
                        Mật khẩu:
                    </span>
                    <input type="password" name="matkhau_admin" class="master-login__box-group-label-input"
                        required></input>
                </div>
                <button type="submit" name="dangnhap_admin" class="master-login__box-btn">Đăng nhập</button>
                <a href="../index.php" class="a-defaul btn-s btn-mini"><i class="fa-solid fa-arrow-left-long"></i> Trang
                    chủ</a>
            </div>
        </div>
    </form>
</body>

</html>