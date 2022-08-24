<?php 
session_start();
include("../../../config/config.php");

$ten_tour = $_POST['ten_tour'];
$diadiem_tour = $_POST['diadiem_tour'];
$mota_tour = $_POST['mota_tour'];
$noidung_tour = $_POST['noidung_tour'];
$dangkytruoc_tour = $_POST['dangkytruoc_tour'];
$ngaydi_tour = $_POST['ngaydi_tour'];
$ngayve_tour = $_POST['ngayve_tour'];
$gia_tour = $_POST['gia_tour'];
// $soluongmax_tour = $_POST['soluongmax_tour'];
$soluongmax_tour = '2147483647';
$donvi_tour = $_POST['donvi_tour'];

$img_tour = $_FILES['img_tour']['name'];
$img_tour_tmp = $_FILES['img_tour']['tmp_name'];
$img_tour_remane = time().'_'.$img_tour;

$chitiet_tour = $_FILES['chitiet_tour']['name'];
$chitiet_tour_tmp = $_FILES['chitiet_tour']['tmp_name'];
$chitiet_tour_remane = time().'_'.$chitiet_tour;

$allowUpload = true;

// Xu ly them tour 
if(isset($_POST['themtour'])){
    //check định dạng file
    $file_ext_img = explode('/',$_FILES['img_tour']['type']);
    $expensions_img = array("jpeg","jpg","png");

    $file_ext_chitiet = explode('/',$_FILES['chitiet_tour']['type']);
    $expensions_chitiet = array("pdf");

    if(!in_array($file_ext_img[1],$expensions_img)){
        $allowUpload = false;
        $_SESSION['dinhdang_img'] = $file_ext_img[1];
        header('Location:../../../index.php?quanly=tour&query=them');
    }
    if(!in_array($file_ext_chitiet[1],$expensions_chitiet)){
        $allowUpload = false;
        $_SESSION['dinhdang_chitiet'] = $file_ext_chitiet[1];
        header('Location:../../../index.php?quanly=tour&query=them');
    }

    if($allowUpload){
        $tour_insert = "INSERT INTO `tbl_tourdulich`(`donvi_tourdulich`, `ten_tourdulich`, `gia_tourdulich`, `img_tourdulich`, `dangkytruoc_tourdulich`, `ngaydi_tourdulich`, `ngayve_tourdulich`, `diadiem_tourdulich`, `mota_tourdulich`, `noidung_tourdulich`, `chitiet_tourdulich`,`soluongdadangky_tourdulich`,`soluongtoida_tourdulich`) VALUES ('".$donvi_tour."','".$ten_tour."','".$gia_tour."','".$img_tour_remane."','".$dangkytruoc_tour."','".$ngaydi_tour."','".$ngayve_tour."','".$diadiem_tour."','".$mota_tour."','".$noidung_tour."','".$chitiet_tour_remane."','0','".$soluongmax_tour."')";
        $tour_insert_query = mysqli_query($mysqli,$tour_insert);
        
        $_SESSION['taotour'] = $ten_tour;

        move_uploaded_file($img_tour_tmp,'uploads/'.$img_tour_remane);
        move_uploaded_file($chitiet_tour_tmp,'chitiettour_pdf/'.$chitiet_tour_remane);
        header('Location:../../../index.php?quanly=tour&query=them');
    }
}
// Xu ly sua tour 
if(isset($_POST['suatour'])){
    $idtour = $_POST['id_tour'];
    $back_sua = '../../../index.php?quanly=tour&query=sua&idtour='.$idtour;

    if(!empty($img_tour))
    {
        $file_ext_img = explode('/',$_FILES['img_tour']['type']);
        $expensions_img = array("jpeg","jpg","png");
        if(!in_array($file_ext_img[1],$expensions_img)){
            $allowUpload = false;
            $_SESSION['dinhdang_img'] = $file_ext_img[1];
            header("Location:$back_sua");
        }
        if($allowUpload){
            $tour_select = "SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$idtour."'";
            $tour_query = mysqli_query($mysqli, $tour_select);
            $tour_row = mysqli_fetch_array($tour_query);
            //gỡ hình cũ
            unlink('uploads/'.$tour_row['img_tourdulich']);
            //lưu hình mới
            $tour_update_img = "UPDATE `tbl_tourdulich` SET `img_tourdulich`='".$img_tour_remane."' WHERE `id_tourdulich`='".$idtour."'";
            $tour_update_img_query = mysqli_query($mysqli, $tour_update_img);
            move_uploaded_file($img_tour_tmp,'uploads/'.$img_tour_remane);
        }
    }
    if(!empty($chitiet_tour))
    { 
        $file_ext_chitiet = explode('/',$_FILES['chitiet_tour']['type']);
        $expensions_chitiet = array("pdf");
        if(!in_array($file_ext_chitiet[1],$expensions_chitiet)){
            $allowUpload = false;
            $_SESSION['dinhdang_chitiet'] = $file_ext_chitiet[1];
            header("Location:$back_sua");
        }
        if($allowUpload){
            $tour_select = "SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$idtour."'";
            $tour_query = mysqli_query($mysqli, $tour_select);
            $tour_row = mysqli_fetch_array($tour_query);
            //gỡ chitiet cũ
            unlink('chitiettour_pdf/'.$tour_row['chitiet_tourdulich']);
            //lưu chitiet mới
            $tour_update_chitiet = "UPDATE `tbl_tourdulich` SET `chitiet_tourdulich`='".$chitiet_tour_remane."' WHERE `id_tourdulich`='".$idtour."'";
            $tour_update_chitiet_query = mysqli_query($mysqli, $tour_update_chitiet);
            move_uploaded_file($chitiet_tour_tmp,'chitiettour_pdf/'.$chitiet_tour_remane);
        }
    }
    if($allowUpload)
    {
        $tour_update = "UPDATE `tbl_tourdulich` SET `donvi_tourdulich`='".$donvi_tour."',`ten_tourdulich`='".$ten_tour."',`gia_tourdulich`='".$gia_tour."',`dangkytruoc_tourdulich`='".$dangkytruoc_tour."', `ngaydi_tourdulich`='".$ngaydi_tour."',`ngayve_tourdulich`='".$ngayve_tour."',`diadiem_tourdulich`='".$diadiem_tour."',`mota_tourdulich`='".$mota_tour."',`noidung_tourdulich`='".$noidung_tour."',`soluongtoida_tourdulich`='".$soluongmax_tour."' WHERE `tbl_tourdulich`.`id_tourdulich` = '".$idtour."'";
        $tour_update_query = mysqli_query($mysqli, $tour_update);
    }
    $_SESSION['suatour'] = $ten_tour;
    header("Location:$back_sua");
}
?>