<?php
    include('../../config/config.php');
    require('../../../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    if(isset($_GET['reload']))
    {
        // delete thongke 
        $delete_thongke = mysqli_query($mysqli,"DELETE FROM `tbl_thongke_donvi_dangky`");

        // select các dv đang dk tour
        $select_all_donvi_dk = mysqli_query($mysqli,"SELECT DISTINCT id_donvi FROM tbl_dangkytour");
        while($row = mysqli_fetch_array($select_all_donvi_dk))
        {
            $iddv = $row['id_donvi'];
            // select dv đang dk đã dk bao nhiêu tour
            $select_all_tour_dk = mysqli_query($mysqli,"SELECT COUNT(DISTINCT id_tourdulich) FROM tbl_dangkytour WHERE id_donvi= '".$iddv."'");
            $count_row = mysqli_fetch_array($select_all_tour_dk);

            //insert thongke
            $insert_thongke = mysqli_query($mysqli,"INSERT INTO `tbl_thongke_donvi_dangky`(`id_donvi`, `sotour_thongke`, `ngay_thongke`) VALUES ('".$iddv."','".$count_row['COUNT(DISTINCT id_tourdulich)']."','".$today."')");
            
        }

        header('Location:../../index.php');
    }
    

?>