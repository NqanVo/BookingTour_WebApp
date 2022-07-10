<?php 
    $idtour = $_GET['idtour'];

    //check xem có ai dang dk tour không.
    $tour_select_query = mysqli_query($mysqli,"SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$idtour."' AND soluongdadangky_tourdulich > '0'");
    $tour_select_count = mysqli_num_rows($tour_select_query);
    if($tour_select_count > 0){
        $_SESSION['tour_cant_delete'] = 'rewre';
        header("Location:index.php?quanly=tour&query=chitiet&idtour=$idtour");
    }
    else{
        $tour_delete = "DELETE FROM tbl_tourdulich WHERE tbl_tourdulich.id_tourdulich ='".$idtour."'";
        $tour_query = mysqli_query($mysqli, $tour_delete);
    }
    
?>

<div class="notification-form">
    <h1 class="notification-form-heading">Xóa tour thành công</h1>
    <h1 class="notification-form-icon"><i class="ti-check"></i></h1>
    <a href="?quanly=tour&query=danhsach" class="btn-s btn-main notification-form-btn a-defaul" style="color: #fff;">Quay lại</a>
</div>