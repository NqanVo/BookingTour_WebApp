<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    $idhotrochitiet = $_GET['idhotrochitiet'];
    $idhotro = $_GET['idhotro'];
    $danhsach_hotro_query = mysqli_query($mysqli,"SELECT * FROM tbl_hotro_kinhphi WHERE id_hotro_kinhphi = '".$idhotro."'");
    $danhsach_hotro_row = mysqli_fetch_array($danhsach_hotro_query);

    $danhsach_hotro_chitiet_query = mysqli_query($mysqli,"SELECT * FROM tbl_hotro_kinhphi_chitiet2 WHERE id_hotro_kinhphi = '".$idhotro."' AND id_hotro_kinhphi_chitiet = '".$idhotrochitiet."'");
    $danhsach_hotro_chitiet_row = mysqli_fetch_array($danhsach_hotro_chitiet_query);

    if(isset($_POST['suathamnien'])){
        $thamnien = $_POST['thamnien_hotro'];
        $tienhotro = $_POST['tien_hotro'];

        $hotrokinhphi_chitiet_insert_query = mysqli_query($mysqli, "UPDATE `tbl_hotro_kinhphi_chitiet2` SET `thamnien_hotro_kinhphi_chitiet`='".$thamnien."',`tien_hotro_kinhphi_chitiet`='".$tienhotro."' WHERE id_hotro_kinhphi_chitiet = '".$idhotrochitiet."'");
        
        echo '<script>window.alert("Cập nhật thành công!");</script>';

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
                    Thâm niên /Năm:
                </h1>
                <input type="number" name="thamnien_hotro" value="<?php echo $danhsach_hotro_chitiet_row['thamnien_hotro_kinhphi_chitiet'] ?>" step="1" value="0" class="input-df input-df-date content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tiền hỗ trợ:
                </h1>
                <input type="number" name="tien_hotro" value="<?php echo $danhsach_hotro_chitiet_row['tien_hotro_kinhphi_chitiet'] ?>" class="input-df input-df-date content__body-form-input" required>
            </div>
            <input type="submit" name="suathamnien" value="Cập Nhật" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>