<?php
    session_start();
    include('../../../quanly/config/config.php');
    require('../../../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $idtour = $_GET['idtour'];
    $idvechitiet= $_GET['idvechitiet'];

    foreach($_SESSION['thongtin_user'] as $key => $value){
        $idnv = $value['id_nhanvien'];
        $idhotrokinhphi = $value['id_hotrokinhphi'];
        $thamnien = $value['thamnien'];
    }

    //lay sl ve trong tour
    $tour_select = "SELECT * FROM tbl_tourdulich WHERE tbl_tourdulich.id_tourdulich = '".$idtour."'";
    $tour_query = mysqli_query($mysqli, $tour_select);
    $tour_row = mysqli_fetch_array($tour_query);
    $soluong_tour_max = $tour_row['soluongtoida_tourdulich'];
    $soluong_tour_dadangky = $tour_row['soluongdadangky_tourdulich'];
    $soluong_conlai = $soluong_tour_max - $soluong_tour_dadangky;
    $dangkytruoc = $tour_row['dangkytruoc_tourdulich'];

    if(strtotime($dangkytruoc) >= strtotime($today)){
        $thoihan = true;
    }
    else{
        $thoihan = false;
    }

    //lay quanhe
    $ve_chitiet_query = mysqli_query($mysqli,"SELECT * FROM tbl_dangkytour_chitiet WHERE tbl_dangkytour_chitiet.id_dangkytour_chitiet = '".$idvechitiet."'");
    $ve_chitiet_row = mysqli_fetch_array($ve_chitiet_query);

    $iddangkytour = $ve_chitiet_row['id_dangkytour'];
    $quanhe =  $ve_chitiet_row['quanhe_dangkytour_chitiet'];

    //lấy giá vé
    $gia_ve_tour_query = mysqli_query($mysqli, "SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$idtour."'");
    $gia_ve_tour_row = mysqli_fetch_array($gia_ve_tour_query);
    $gia_ve_tour = $gia_ve_tour_row['gia_tourdulich'];

    if($thoihan)
    {
        //dat lai ve
        if(isset($_GET['tacvu']) == 'datlai' && $soluong_conlai >= 1)
        {
            if($quanhe == 'daidien')
            {
                //kiem tra xem có nhận sp chưa
                $nhan_hotro_query = mysqli_query($mysqli, "SELECT * FROM tbl_nhan_hotro WHERE id_nhanvien = '".$idnv."' AND id_hotro_kinhphi = '".$idhotrokinhphi."' AND status_nhan_hotro = '0'");
                $nhan_hotro_count = mysqli_num_rows($nhan_hotro_query);
                if($nhan_hotro_count > 0){
                    $nhan_hotro_row = mysqli_fetch_array($nhan_hotro_query);
                    $id_nhan_hotro = $nhan_hotro_row['id_nhan_hotro'];
                    $tien_hotro = 0;

                    //cap nhat dat ve
                    $ve_chitiet_capnhat_dat = "UPDATE `tbl_dangkytour_chitiet` SET `status_dangkytour_chitiet`='1' WHERE `tbl_dangkytour_chitiet`.`id_dangkytour_chitiet` = '".$idvechitiet."'";
                    $ve_dat_query = mysqli_query($mysqli, $ve_chitiet_capnhat_dat);

                    //cap nhat lai so luong dadangky tour
                    $soluong_tour_dadangky++;
                    $update_soluongdk = mysqli_query($mysqli,"UPDATE `tbl_tourdulich` SET `soluongdadangky_tourdulich`='".$soluong_tour_dadangky."' WHERE `id_tourdulich` = '".$idtour."'");
                }
                else{
                    
                    $hotro_kinhphi_chitiet_query = mysqli_query($mysqli,"SELECT * FROM `tbl_hotro_kinhphi_chitiet2` WHERE `tbl_hotro_kinhphi_chitiet2`.`thamnien_hotro_kinhphi_chitiet` <= '".$thamnien."' AND id_hotro_kinhphi = '".$idhotrokinhphi."' ORDER BY thamnien_hotro_kinhphi_chitiet DESC LIMIT 1");
                    $hotro_kinhphi_chitiet_row = mysqli_fetch_array($hotro_kinhphi_chitiet_query);
                    // $id_nhan_hotro = '0';
                    $tien_hotro = $hotro_kinhphi_chitiet_row['tien_hotro_kinhphi_chitiet'];
                    $thanhtien = $gia_ve_tour - $tien_hotro;

                    //cap nhat dat ve
                    $ve_chitiet_capnhat_dat = "UPDATE `tbl_dangkytour_chitiet` SET `thanhtien_dangkytour_chitiet`='".$thanhtien."', `status_dangkytour_chitiet`='1' WHERE `tbl_dangkytour_chitiet`.`id_dangkytour_chitiet` = '".$idvechitiet."'";
                    $ve_dat_query = mysqli_query($mysqli, $ve_chitiet_capnhat_dat);

                    //cap nhat lai so luong dadangky tour
                    $soluong_tour_dadangky++;
                    $update_soluongdk = mysqli_query($mysqli,"UPDATE `tbl_tourdulich` SET `soluongdadangky_tourdulich`='".$soluong_tour_dadangky."' WHERE `id_tourdulich` = '".$idtour."'");

                    //them vào da_nhan_hotro
                    $da_nhan_hotro = mysqli_query($mysqli, "INSERT INTO `tbl_nhan_hotro`(`id_hotro_kinhphi`, `id_nhanvien`, `id_tourdulich`, `sotien_nhan_hotro`, `status_nhan_hotro`) VALUES ('".$idhotrokinhphi."','".$idnv."','".$idtour."','".$tien_hotro."','0')");
                }

                $_SESSION['datve_lai'] = 'abjew';
                header("location:../../../index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
            }
            else
            {
                //check, chỉ cho nguoithan dk lại nếu người đại diện đã dk
                $check_daidien_dk_query = mysqli_query($mysqli,"SELECT * FROM tbl_dangkytour_chitiet WHERE id_dangkytour = '".$iddangkytour."' AND quanhe_dangkytour_chitiet = 'daidien'");
                $check_daidien_dk_row = mysqli_fetch_array($check_daidien_dk_query);
                $status_dadien = $check_daidien_dk_row['status_dangkytour_chitiet'];
                if($status_dadien == 1)
                {
                    //cap nhat dat ve
                    $ve_chitiet_capnhat_dat = "UPDATE `tbl_dangkytour_chitiet` SET `status_dangkytour_chitiet`='1' WHERE `tbl_dangkytour_chitiet`.`id_dangkytour_chitiet` = '".$idvechitiet."'";
                    $ve_dat_query = mysqli_query($mysqli, $ve_chitiet_capnhat_dat);

                    //cap nhat lai so luong dadangky tour
                    $soluong_tour_dadangky++;
                    $update_soluongdk = mysqli_query($mysqli,"UPDATE `tbl_tourdulich` SET `soluongdadangky_tourdulich`='".$soluong_tour_dadangky."' WHERE `id_tourdulich` = '".$idtour."'");
                
                    
                    $_SESSION['datve_lai'] = 'abjew';
                    header("location:../../../index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
                }
                else{
                    $_SESSION['daidien_chuadk'] = 'abjew';
                    header("location:../../../index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
                }
                
            }           
        }
        elseif(isset($_GET['tacvu']) == 'datlai' && $soluong_conlai < 1){
            $_SESSION['fullve'] = 'abc';
            header("location:../../../index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
        }
    }
    else{
        $_SESSION['thoihan'] = 'abc';
        header("location:../../../index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
    }
?>