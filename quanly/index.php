<?php 
session_start();
include("config/config.php");
require('../carbon/autoload.php');

if(isset($_SESSION['user_login'])){
    $id = $_SESSION['user_login'];
    $taikhoan_select = "SELECT * FROM tbl_nhanvien WHERE tbl_nhanvien.id_nhanvien ='".$id."'";
    $taikhoan_query = mysqli_query($mysqli, $taikhoan_select);
    $taikhoan_row = mysqli_fetch_array($taikhoan_query);
    if($taikhoan_row['chucvu_nhanvien'] != 0)
    {
        echo '<script>window.alert("Chỉ tài khoản quản lý mới được vào trang quản lý!");</script>';
    }
    else{
        $_SESSION['login_admin'] = $_SESSION['user_login'];
    }       
}
if(!isset($_SESSION['login_admin'])) 
{
    header('Location:login_admin.php');
}
else{
    $id_nv = $_SESSION['login_admin'];
    $nhanvien_select = "SELECT * FROM tbl_nhanvien WHERE tbl_nhanvien.id_nhanvien = '".$id_nv."'";
    $nhanvien_query = mysqli_query($mysqli, $nhanvien_select);
    $nhanvien_row = mysqli_fetch_array($nhanvien_query);
    // lay thong tin phong ban cua nhan vien 
    $id_pb = $nhanvien_row['id_phongban'];
    $phongban_select = "SELECT * FROM tbl_phongban WHERE tbl_phongban.id_phongban = '".$id_pb."'";
    $phongban_query = mysqli_query($mysqli, $phongban_select);
    $phongban_row = mysqli_fetch_array($phongban_query);

    // lay thong tin don vi cua nhan vien 
    $id_dv = $phongban_row['id_donvi'];
    $donvi_select = "SELECT * FROM tbl_donvi WHERE tbl_donvi.id_donvi = '".$id_dv."'";
    $donvi_query = mysqli_query($mysqli, $donvi_select);
    $donvi_row = mysqli_fetch_array($donvi_query);
}
if(isset($_GET['quanly']) && $_GET['query'] == 1)
{
    unset($_SESSION['login_admin']);
    unset($_SESSION['user_login']);
    header('Location:login_admin.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí</title>

    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./assets/font-icon/themify-icons/themify-icons.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3125/3125848.png">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
</head>

<body>
    <div class="hero">
        <!-- header -->
        <?php include("modules/header.php") ?>

        <div class="hero-container">
            <div class="grid wide">
                <!-- container -->
                <?php include('modules/main.php') ?>
            </div>
        </div>
        <!-- footer -->
        <?php 
        include('modules/footer.php') 
        ?>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./assets/javascript/javascript.js"></script>
    <script src="./assets/javascript/api.js"></script>
    <script src="./assets/javascript/data.json"></script>
    <script type="text/javascript" src="./assets/javascript/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/javascript/Chart.min.js"></script>
</body>
</html>