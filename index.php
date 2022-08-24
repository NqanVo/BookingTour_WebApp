<?php
    session_start();
    include('quanly/config/config.php');
    require('carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $now_year = Carbon::now()->year;
    

    //check update lại status hotro_kinhphi
    $check_status_hotro_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM tbl_hotro_kinhphi WHERE status_hotro_kinhphi = '1' ORDER BY id_hotro_kinhphi DESC LIMIT 1"));
    $check_status_hotro_row = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tbl_hotro_kinhphi WHERE status_hotro_kinhphi = '1' ORDER BY id_hotro_kinhphi DESC LIMIT 1"));
    if($check_status_hotro_count != null){
        if($check_status_hotro_row['dennam_hotro_kinhphi'] <= $now_year){
            $update_status_hotro = mysqli_query($mysqli, "UPDATE `tbl_hotro_kinhphi` SET `status_hotro_kinhphi`='0' WHERE id_hotro_kinhphi = '".$check_status_hotro_row['id_hotro_kinhphi']."'");
        }
    }
    // đăng xuất
    if(isset($_GET['select']) && $_GET['select'] == 'dangxuat')
	{
		unset($_SESSION['user_login']);
        unset($_SESSION['login_admin']);
		header('Location:index.php');
	}
    
    if(isset($_SESSION['user_login']))
    {
        // lay thong tin nhan vien 
        $idnv = $_SESSION['user_login'];
        $nhanvien_select = "SELECT * FROM tbl_nhanvien WHERE tbl_nhanvien.id_nhanvien = '".$idnv."'";
        $nhanvien_query = mysqli_query($mysqli, $nhanvien_select);
        $nhanvien_row = mysqli_fetch_array($nhanvien_query);

        //chức vụ
        $chucvu = $nhanvien_row['chucvu_nhanvien'];
        
        //lấy kỳ hỗ trợ hiện hành
        $hotro_kinhphi_query = mysqli_query($mysqli,"SELECT * FROM tbl_hotro_kinhphi WHERE tunam_hotro_kinhphi <= '".$now_year."' AND dennam_hotro_kinhphi > '".$now_year."' AND status_hotro_kinhphi = '1'");
        $hotro_kinhphi_count = mysqli_num_rows($hotro_kinhphi_query);
        if($hotro_kinhphi_count >0)
        {
            $hotro_kinhphi_row = mysqli_fetch_array($hotro_kinhphi_query);
            $id_hotrokinhphi = $hotro_kinhphi_row['id_hotro_kinhphi'];
        }
        else{
            $hotro_kinhphi_row['tunam_hotro_kinhphi'] = '0000';
            $hotro_kinhphi_row['dennam_hotro_kinhphi'] = '0000';
            $id_hotrokinhphi = '0';
        }

        //tinh tham nien nhan vien
        $ngayvaolam = strtotime($nhanvien_row['ngayvaolam_nhanvien']);
        $now = strtotime($today);
        $datediff = abs($ngayvaolam - $now);
        $tongngaylam = floor($datediff / (60*60*24));
        if(($tongngaylam /365) >=1){
            $thamnien = (int)($tongngaylam/365);
        }
        else{
            $thamnien = '0';
        }

        //tìm kiếm xem nhân viên đã nhận hỗ trợ chưa
        if($id_hotrokinhphi > 0)
        {
            //status_nhan_hotro = 0 là đã nhận hỗ trợ 
            $nhan_hotro_query = mysqli_query($mysqli, "SELECT * FROM tbl_nhan_hotro WHERE id_nhanvien = '".$idnv."' AND id_hotro_kinhphi = '".$id_hotrokinhphi."' AND status_nhan_hotro = '0'");
            $nhan_hotro_count = mysqli_num_rows($nhan_hotro_query);
            //tinh tiền hỗ trợ
            $hotro_kinhphi_chitiet_query = mysqli_query($mysqli,"SELECT * FROM `tbl_hotro_kinhphi_chitiet2` WHERE `tbl_hotro_kinhphi_chitiet2`.`thamnien_hotro_kinhphi_chitiet` <= '".$thamnien."' AND id_hotro_kinhphi = '".$id_hotrokinhphi."' ORDER BY thamnien_hotro_kinhphi_chitiet DESC LIMIT 1");
            $hotro_kinhphi_chitiet_row = mysqli_fetch_array($hotro_kinhphi_chitiet_query);

            $tien_hotro_view = $hotro_kinhphi_chitiet_row['tien_hotro_kinhphi_chitiet'];

            if($nhan_hotro_count > 0)
            {
                $nhan_hotro_row = mysqli_fetch_array($nhan_hotro_query);
                $id_nhan_hotro = $nhan_hotro_row['id_nhan_hotro'];
                $tien_hotro = 0;
            }
            else
            {
                
                $id_nhan_hotro = '0';
                $tien_hotro = $hotro_kinhphi_chitiet_row['tien_hotro_kinhphi_chitiet'];
            }
        }
        else
        {
            $tien_hotro = 0;
            $tien_hotro_view = 0;
            $id_nhan_hotro = '0';
        }

        // lay thong tin phong ban cua nhan vien 
        $idpb = $nhanvien_row['id_phongban'];
        $phongban_select = "SELECT * FROM tbl_phongban WHERE tbl_phongban.id_phongban = '".$idpb."'";
        $phongban_query = mysqli_query($mysqli, $phongban_select);
        $phongban_row = mysqli_fetch_array($phongban_query);

        // lay thong tin don vi cua nhan vien 
        $iddv = $phongban_row['id_donvi'];
        $donvi_select = "SELECT * FROM tbl_donvi WHERE tbl_donvi.id_donvi = '".$iddv."'";
        $donvi_query = mysqli_query($mysqli, $donvi_select);
        $donvi_row = mysqli_fetch_array($donvi_query);

        $_SESSION['thongtin_user'] = array(array('id_donvi' => $iddv, 'id_phongban' => $idpb, 'id_nhanvien' => $idnv,'id_hotrokinhphi' => $id_hotrokinhphi, 'id_nhan_hotro' => $id_nhan_hotro,'thamnien' => $thamnien, 'tienhotro' => $tien_hotro));
    }
    else{
        header('Location:sign_in.php');
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/font-icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3125/3125848.png">


    <title>TravelVietNam</title>
</head>

<body>
    <div class="hero">
        <?php
            include('modules/header.php');
            include('modules/main.php');
            include('modules/footer.php');
        ?>
    </div>
    <script src="./assets/javascript/javascript.js"></script>
</body>

</html>