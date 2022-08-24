<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $now_year = Carbon::now()->year;
    $now_year_plus = $now_year+1;

    $hotro_kinhphi_select = mysqli_query($mysqli,"SELECT * FROM tbl_hotro_kinhphi WHERE status_hotro_kinhphi = '1'");
    $hotro_kinhphi_count = mysqli_num_rows($hotro_kinhphi_select);
    if(isset($_POST['themhotro'])){
        $tunam = $_POST['tunam_hotro'];
        $dennam = $_POST['dennam_hotro'];
        // $tongtien = $_POST['tongtien_hotro'];
        $tongtien = '2147483647';
        if($hotro_kinhphi_count == 0)
        {
            if(($tunam < $now_year) || ($dennam < $now_year))
            {
                echo '<script>window.alert("Chu kì không hợp lệ! Năm bắt đầu và kết thúc phải lớn hơn hoặc bằng năm hiện tại.");</script>';
            }
            else{
                $hotrokinhpho_insert_query = mysqli_query($mysqli, "INSERT INTO `tbl_hotro_kinhphi`(`tunam_hotro_kinhphi`, `dennam_hotro_kinhphi`, `tongtien_hotro_kinhphi`, `status_hotro_kinhphi`) VALUES ('".$tunam."','".$dennam."','".$tongtien."','1')");
                $hotrokinhpho_select_query = mysqli_query($mysqli,"SELECT * FROM `tbl_hotro_kinhphi` ORDER BY id_hotro_kinhphi DESC LIMIT 1");
                $hotrokinhpho_select_row = mysqli_fetch_array($hotrokinhpho_select_query);
                $id_hotro_new = $hotrokinhpho_select_row['id_hotro_kinhphi'];
                $_SESSION['hotro_new'] = 'erhkew';
                header("Location:index.php?quanly=hotrokinhphi&query=them_thamnien&idhotro=$id_hotro_new");

            }
        }
        else{
            echo '<script>window.alert("Không thể thêm chu kì mới khi chu kì cũ còn hiện hành!");</script>';
        }
    }
?>

<div class="content__body__heading">
    <h1 class="content__body__heading-text">Thêm Kì Hỗ Trợ Mới:</h1>
    <a href="?quanly=hotrokinhphi&query=danhsach" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Từ Năm: <span class="error-txt">*</span>
                </h1>
                <input type="number" name="tunam_hotro" min="1900" max="2099" step="1" value="<?php echo $now_year?>" class="input-df input-df-date content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Đến Năm: <span class="error-txt">*</span>
                </h1>
                <input type="number" name="dennam_hotro" min="1900" max="2099" step="1" value="<?php echo $now_year_plus?>" class="input-df input-df-date content__body-form-input">
            </div>
            <!-- <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tổng Tiền Hỗ Trợ: <span class="error-txt">*</span>
                </h1>
                <input type="number" name="tongtien_hotro" class="input-df content__body-form-input" required>
            </div> -->
            <input type="submit" name="themhotro" value="Thêm" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>