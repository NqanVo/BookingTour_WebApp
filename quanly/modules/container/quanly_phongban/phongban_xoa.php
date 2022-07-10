<?php 
    $iddv = $_GET['iddv'];
    $idpb = $_GET['idpb'];
    //check xem có nhan vien nào trong phòng ban không.
    $nhanvien_select_query = mysqli_query($mysqli,"SELECT * FROM tbl_nhanvien WHERE id_phongban = '".$idpb."' AND status_nhanvien = '1'");
    $nhanvien_select_count = mysqli_num_rows($nhanvien_select_query);
    if($nhanvien_select_count > 0){
        $_SESSION['nhanvien_isset'] = 'rewre';
        header("Location:index.php?quanly=phongban&query=danhsach&iddv=$iddv");
    }
    else{
        $phongban_delete = "DELETE FROM tbl_phongban WHERE tbl_phongban.id_phongban ='".$idpb."'";
        $phongban_query = mysqli_query($mysqli, $phongban_delete);
    }
    
?>

<div class="notification-form">
    <h1 class="notification-form-heading">Xóa phòng thành công</h1>
    <h1 class="notification-form-icon"><i class="ti-check"></i></h1>
    <a href="?quanly=phongban&query=danhsach&iddv=<?php echo $iddv ?>" class="btn-s btn-main notification-form-btn a-defaul" style="color: #fff;">Quay lại</a>
</div>