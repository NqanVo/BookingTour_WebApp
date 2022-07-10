<?php 
    $iddv = $_GET['iddv'];
    //check xem có phòng nào trong đơn vị không.
    $phongban_select_query = mysqli_query($mysqli,"SELECT * FROM tbl_phongban WHERE id_donvi = '".$iddv."'");
    $phongban_select_count = mysqli_num_rows($phongban_select_query);
    if($phongban_select_count > 0){
        $_SESSION['phongban_isset'] = 'rewre';
        header("Location:index.php?quanly=donvi&query=danhsach");
    }
    else{
        $donvi_delete = "DELETE FROM tbl_donvi WHERE tbl_donvi.id_donvi ='".$iddv."'";
        $donvi_query = mysqli_query($mysqli, $donvi_delete);
    
        $tour_delete = "DELETE FROM tbl_tourdulich WHERE tbl_tourdulich.donvi_tourdulich ='".$iddv."'";
        $tour_query = mysqli_query($mysqli, $tour_delete);
    }
?>

<div class="notification-form">
    <h1 class="notification-form-heading">Xóa đơn vị thành công</h1>
    <h1 class="notification-form-icon"><i class="ti-check"></i></h1>
    <a href="?quanly=donvi&query=danhsach" class="btn-s btn-main notification-form-btn a-defaul" style="color: #fff;">Quay lại</a>
</div>