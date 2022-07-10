<?php
$idhotro = $_GET['idhotro'];
use Carbon\Carbon;
use Carbon\CarbonInterval;
$today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
$now_year = Carbon::now()->year;
$hotro_select = "SELECT * FROM tbl_hotro_kinhphi WHERE tbl_hotro_kinhphi.id_hotro_kinhphi = '".$idhotro."'";
$hotro_query = mysqli_query($mysqli, $hotro_select);
$hotro_row = mysqli_fetch_array($hotro_query);

if(isset($_POST['suahotro'])){
    $tunam = $_POST['tunam_hotro'];
    $dennam = $_POST['dennam_hotro'];
    $sotien = $_POST['tongtien_hotro'];

    if($hotro_row['status_hotro_kinhphi'] == 1)
    {
        if(($tunam < $now_year) || ($dennam < $now_year))
        {
            echo '<script>window.alert("Chu kì không hợp lệ! Năm bắt đầu và kết thúc phải lớn hơn hoặc bằng năm hiện tại.");</script>';
        }
        else{
            $hotro_update = "UPDATE `tbl_hotro_kinhphi` SET `tunam_hotro_kinhphi`='".$tunam."',`dennam_hotro_kinhphi`='".$dennam."',`tongtien_hotro_kinhphi`='".$sotien."'  WHERE `id_hotro_kinhphi` = '".$idhotro."' AND `status_hotro_kinhphi` = '1'";
            $hotro_query = mysqli_query($mysqli, $hotro_update);
            echo '<script>window.alert("Cập nhật hỗ trợ thành công!");</script>';
        }
    }
    else{
        echo '<script>window.alert("Không thể cập nhật cho chu kì đã hết hạn!");</script>';
    }
}

?>

<!-- <div class="content__body__status status-error">Tài khoản đã tồn tại!</div> -->
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Cập Nhật Kì Hỗ Trợ: <?php echo $hotro_row['tunam_hotro_kinhphi'] ?> -
        <?php echo $hotro_row['dennam_hotro_kinhphi'] ?></h1>
    <a href="?quanly=hotrokinhphi&query=danhsach" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Từ năm
                </h1>
                <input type="number" name="tunam_hotro" min="1900" max="2099" step="1"
                    value="<?php echo $hotro_row['tunam_hotro_kinhphi']?>"
                    class="input-df input-df-date content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Đến năm
                </h1>
                <input type="number" name="dennam_hotro" min="1900" max="2099" step="1"
                    value="<?php echo $hotro_row['dennam_hotro_kinhphi']?>"
                    class="input-df input-df-date content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tổng tiền hỗ trợ
                </h1>
                <input type="number" name="tongtien_hotro" value="<?php echo $hotro_row['tongtien_hotro_kinhphi']?>"
                    class="input-df content__body-form-input" required>
            </div>
            <input type="submit" name="suahotro" value="Cập nhật" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>