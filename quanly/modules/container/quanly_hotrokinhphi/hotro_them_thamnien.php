<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    $idhotro = $_GET['idhotro'];
    $danhsach_hotro_query = mysqli_query($mysqli,"SELECT * FROM tbl_hotro_kinhphi WHERE id_hotro_kinhphi = '".$idhotro."'");
    $danhsach_hotro_row = mysqli_fetch_array($danhsach_hotro_query);

    if(isset($_SESSION['hotro_new'])){
        unset($_SESSION['hotro_new']);
        echo '<script>window.alert("Thêm kì hỗ trợ mới thành công!");</script>';
    }
    if(isset($_POST['themthamnien'])){
        $thamnien = $_POST['thamnien_hotro'];
        $tienhotro = $_POST['tien_hotro'];

        $hotrokinhphi_chitiet_insert_query = mysqli_query($mysqli, "INSERT INTO `tbl_hotro_kinhphi_chitiet2`(`thamnien_hotro_kinhphi_chitiet`, `tien_hotro_kinhphi_chitiet`, `id_hotro_kinhphi`) VALUES ('".$thamnien."','".$tienhotro."','".$idhotro."')");
        
        echo '<script>window.alert("Thêm thâm niên hỗ trợ mới thành công!");</script>';

    }
?>

<div class="content__body__heading">
    <h1 class="content__body__heading-text">Thêm Thâm Niên Hỗ Trợ Kì: <?php echo $danhsach_hotro_row['tunam_hotro_kinhphi']?> - <?php echo $danhsach_hotro_row['dennam_hotro_kinhphi']?></h1>
    <a href="?quanly=hotrokinhphi&query=chitiet&idhotro=<?php echo $idhotro?>" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Thâm niên /Năm: <span class="error-txt">*</span>
                </h1>
                <input type="number" name="thamnien_hotro" step="1" value="0" class="input-df input-df-date content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tiền hỗ trợ: <span class="error-txt">*</span>
                </h1>
                <input type="number" name="tien_hotro" class="input-df input-df-date content__body-form-input" required>
            </div>
            <input type="submit" name="themthamnien" value="Thêm" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>