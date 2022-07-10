<?php


//xu ly them nv
if(isset($_POST['themdv'])){
    $ten_donvi = $_POST['ten_donvi'];
    $donvi_insert = "INSERT INTO `tbl_donvi`(`ten_donvi`) VALUES ('".$ten_donvi."')";
    $donvi_query = mysqli_query($mysqli, $donvi_insert);
    echo '<script>window.alert("Thêm đơn vị thành công!");</script>';
}

?>

<!-- <div class="content__body__status status-error">Tài khoản đã tồn tại!</div> -->
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Thêm đơn vị: Viễn Thông Tiền Giang </h1>
    <a href="?quanly=donvi&query=danhsach" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên đơn vị: <span class="error-txt">*</span>
                </h1>
                <input type="text" name="ten_donvi" class="input-df content__body-form-input" required>
            </div>
            <input type="submit" name="themdv" value="Thêm" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>