<?php
$iddv = $_GET['iddv'];
$donvi_select = "SELECT * FROM tbl_donvi WHERE tbl_donvi.id_donvi = '".$iddv."'";
$donvi_query = mysqli_query($mysqli, $donvi_select);
$donvi_row = mysqli_fetch_array($donvi_query);

if(isset($_POST['suadv'])){
    $ten_donvi = $_POST['ten_donvi'];
    $donvi_update = "UPDATE `tbl_donvi` SET `ten_donvi` = '".$ten_donvi."' WHERE `id_donvi` = '".$iddv."'";
    $donvi_query = mysqli_query($mysqli, $donvi_update);
    echo '<script>window.alert("Cập nhật đơn vị thành công!");</script>';
}

?>

<div class="content__body__heading">
    <h1 class="content__body__heading-text">Cập nhật đơn vị: <?php echo $donvi_row['ten_donvi'] ?></h1>
    <a href="?quanly=donvi&query=danhsach" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên đơn vị mới
                </h1>
                <input type="text" name="ten_donvi" value="<?php echo $donvi_row['ten_donvi'] ?>" class="input-df content__body-form-input" required>
            </div>
            <input type="submit" name="suadv" value="Cập nhật" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>