<?php
session_start();
include('../../../quanly/config/config.php');
$url_back = $_SERVER["HTTP_REFERER"];

$idtour = $_GET['idtour'];

foreach($_SESSION['thongtin_user'] as $key => $value){
    $idnv = $value['id_nhanvien'];
}

if($_GET['select'] == 'like'){
    $tour_like = mysqli_query($mysqli, "INSERT INTO `tbl_tourdulich_liked`(`id_tourdulich`, `id_nhanvien`) VALUES ('".$idtour."','".$idnv."')");
}
if($_GET['select'] == 'unlike'){
    $tour_like = mysqli_query($mysqli, "DELETE FROM `tbl_tourdulich_liked` WHERE id_tourdulich  = '".$idtour."' AND id_nhanvien = '".$idnv."'");
}
header("Location:$url_back");
?>