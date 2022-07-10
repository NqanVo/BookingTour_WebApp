<?php
$iddv = $_GET['iddv'];
//xu ly them nv
if(isset($_POST['thempb'])){
    $ten_phongban = $_POST['ten_phongban'];
    $phongban_insert = "INSERT INTO `tbl_phongban`(`id_donvi`,`ten_phongban`) VALUES ('".$iddv."','".$ten_phongban."')";
    $phongban_query = mysqli_query($mysqli, $phongban_insert);
    echo '<script>window.alert("Thêm phòng thành công!");</script>';
}

?>

<!-- <div class="content__body__status status-error">Tài khoản đã tồn tại!</div> -->
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Thêm đơn vị: Viễn Thông Tiền Giang </h1>
    <a href="?quanly=phongban&query=danhsach&iddv=<?php echo $iddv ?>" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên phòng ban: <span class="error-txt">*</span>
                </h1>
                <input type="text" name="ten_phongban" class="input-df content__body-form-input" required>
            </div>
            <input type="submit" name="thempb" value="Thêm" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>