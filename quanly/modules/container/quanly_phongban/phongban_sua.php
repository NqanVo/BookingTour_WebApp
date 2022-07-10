<?php
$iddv = $_GET['iddv'];
$idpb = $_GET['idpb'];
$phongban_select = "SELECT * FROM tbl_phongban WHERE tbl_phongban.id_phongban = '".$idpb."'";
$phongban_query = mysqli_query($mysqli, $phongban_select);
$phongban_row = mysqli_fetch_array($phongban_query);

if(isset($_POST['suabp'])){
    $ten_phongban = $_POST['ten_phongban'];
    $phongban_update = "UPDATE `tbl_phongban` SET `ten_phongban` = '".$ten_phongban."' WHERE `id_phongban` = '".$idpb."'";
    $phongban_query = mysqli_query($mysqli, $phongban_update);
    echo '<script>window.alert("Cập nhật phòng ban thành công!");</script>';
}

?>

<!-- <div class="content__body__status status-error">Tài khoản đã tồn tại!</div> -->
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Cập nhật phòng ban: <?php echo $phongban_row['ten_phongban'] ?></h1>
    <a href="?quanly=phongban&query=danhsach&iddv=<?php echo $iddv ?>" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên phòng mới:
                </h1>
                <input type="text" name="ten_phongban" value="<?php echo $phongban_row['ten_phongban'] ?>" class="input-df content__body-form-input" required>
            </div>
            <input type="submit" name="suabp" value="Cập nhật" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>