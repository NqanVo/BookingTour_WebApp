<?php
$iddv = $_GET['iddv'];
$idpb = $_GET['idpb'];
$idnv = $_GET['idnv'];

//liet ke thong tin nhan vien
$nhanvien_select = "SELECT * FROM tbl_nhanvien where tbl_nhanvien.id_nhanvien = '".$idnv."' AND tbl_nhanvien.id_phongban ='".$idpb."'";
$nhanvien_query = mysqli_query($mysqli, $nhanvien_select);
$nhanvien_row = mysqli_fetch_array($nhanvien_query);

//xu ly cap nhat thong tin nhan vien
if(isset($_POST['suamknv'])){
    $matkhaumoi = md5($_POST['password_new_nv']);
    
    //cap nhat thong tin nhan vien
    $taikhoan_update = "UPDATE `tbl_nhanvien` SET `matkhau_nhanvien`='".$matkhaumoi."' WHERE `id_nhanvien` = '".$idnv."' AND `id_phongban` = '".$idpb."'";
    $taikhoan__update_query = mysqli_query($mysqli, $taikhoan_update);
    echo '<script>alert("Cập nhật mật khẩu thành công!");</script>';
}


?>


<div class="content__body__heading">
    <h1 class="content__body__heading-text">Cập nhật mật khẩu:</h1>
    <a href="?quanly=nhanvien&query=chitiet&iddv=<?php echo $iddv ?>&idpb=<?php echo $idpb ?>&idnv=<?php echo $idnv?>" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên nhân viên:
                </h1>
                <input type="text" name="ten_nv" value="<?php echo $nhanvien_row['ten_nhanvien']?>"
                    class="input-df content__body-form-input disabled">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Mật khẩu mới:
                </h1>
                <input type="password" name="password_new_nv" class="input-df content__body-form-input">
            </div>
            <input type="submit" name="suamknv" value="Cập Nhật" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>