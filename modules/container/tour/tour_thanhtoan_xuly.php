<?php
    session_start();
    include('../../../quanly/config/config.php');
    require('../../../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    //lay thong tin user
    foreach($_SESSION['thongtin_user'] as $key => $value){
        $idnv = $value['id_nhanvien'];
        $iddv = $value['id_donvi'];
        $id_hotrokinhphi = $value['id_hotrokinhphi'];
        $tienhotro = $value['tienhotro'];
    }

    //tổng vé
    if(isset($_SESSION['ticket'])){
        $tongnguoi = 0;
        $tongtien = 0;
        foreach($_SESSION['ticket'] as $key_ticket => $value_ticket){
            $gia_ticket = $value_ticket['gia_ve'];
            $tongtien += $gia_ticket;
            $tongnguoi += $value_ticket['songuoi_dangky'];
        }
    }
    
    //lấy thông tin tour
    if(isset($_SESSION['tour'])){
        foreach($_SESSION['tour'] as $key => $value){
            $idtour = $value['id_tour'];
        }
        $tour_select = "SELECT * FROM tbl_tourdulich WHERE tbl_tourdulich.id_tourdulich = '".$idtour."'";
        $tour_query = mysqli_query($mysqli, $tour_select);
        $tour_row = mysqli_fetch_array($tour_query);
        $soluong_tour_max = $tour_row['soluongtoida_tourdulich'];
        $soluong_tour_dadangky = $tour_row['soluongdadangky_tourdulich'];
        $soluong_conlai = $soluong_tour_max - $soluong_tour_dadangky;

        if($soluong_conlai < $tongnguoi){
            $_SESSION['full-ve'] = $soluong_conlai;
            header('location:index.php?select=tour&query=dattour');
        }
    }

    if(isset($_POST['thanhtoan'])){
        $ten_tour = $tour_row['ten_tourdulich'];
        $ngaydi_tour = $tour_row['ngaydi_tourdulich'];
        $ngayve_tour = $tour_row['ngayve_tourdulich'];

        //them dangkytour
        $dangkytour_insert = "INSERT INTO `tbl_dangkytour`(`id_donvi`, `id_nhanvien`, `id_tourdulich`, `tentour_dangkytour`, `ngaydi_dangkytour`, `ngayve_dangkytour`, `ngaydangky_dangkytour`, `soluong_dangkytour`) VALUES ('".$iddv."','".$idnv."','".$idtour."','".$ten_tour."','".$ngaydi_tour."','".$ngayve_tour."','".$today."','".$tongnguoi."')";
        $dangkytour_query = mysqli_query($mysqli, $dangkytour_insert);

        //tim id_dangkytour vua tao
        $dangkytour_select = "SELECT `id_dangkytour` FROM `tbl_dangkytour` ORDER BY `id_dangkytour` DESC LIMIT 1";
        $dangkytour_query_select = mysqli_query($mysqli, $dangkytour_select);
        $dangkytour_select_row = mysqli_fetch_array($dangkytour_query_select);
        $id_dangkytour = $dangkytour_select_row['id_dangkytour'];

        foreach($_SESSION['ticket'] as $key_ticket => $value_ticket)
        {   
            $idtour = $tour_row['id_tourdulich'];
            $ten_ve = $value_ticket['ten_ve'];
            $sdt_ve = $value_ticket['sdt_ve'];
            $cccd_ve = $value_ticket['cccd_ve'];
            $gioitinh_ve = $value_ticket['gioitinh_ve'];
            $quanhe_ve = $value_ticket['quanhe_dangky'];
            $thanhtien = $value_ticket['gia_ve'];
            // $ngaydangky = $value_ticket['ngaydat_ve'];
            $status = 1;

            //them ve vao data_base
            $dangkytour_chitiet_insert = "INSERT INTO `tbl_dangkytour_chitiet`(`ten_dangkytour_chitiet`, `sdt_dangkytour_chitiet`, `cccd_dangkytour_chitiet`, `gioitinh_dangkytour_chitiet`, `quanhe_dangkytour_chitiet`, `thanhtien_dangkytour_chitiet`, `status_dangkytour_chitiet`, `id_dangkytour`, `id_tourdulich`) VALUES ('".$ten_ve."','".$sdt_ve."','".$cccd_ve."','".$gioitinh_ve."','".$quanhe_ve."','".$thanhtien."','".$status."','".$id_dangkytour."','".$idtour."')";
            $dangkytour_chitiet_query = mysqli_query($mysqli, $dangkytour_chitiet_insert);

            //cap nhat lai so ve cua tour
            $soluong_tour_dadangky++;
            $update_soluong = "UPDATE `tbl_tourdulich` SET `soluongdadangky_tourdulich`='".$soluong_tour_dadangky."' WHERE `id_tourdulich` = '".$idtour."'";
            $update_soluong_query = mysqli_query($mysqli, $update_soluong);
        }

        //neu đang có kì hỗ trợ thì check và cap nhật đã nhận
        if($id_hotrokinhphi > 0)
        {
            //cap nhật đã nhận hộ trợ kỳ này
            $da_nhan_hotro_select_query = mysqli_query($mysqli, "SELECT * FROM `tbl_nhan_hotro` WHERE id_hotro_kinhphi='".$id_hotrokinhphi."' AND id_nhanvien = '".$idnv."'");
            $da_nhan_hotro_count = mysqli_num_rows($da_nhan_hotro_select_query);
    
            if($da_nhan_hotro_count == 0){
                $da_nhan_hotro = mysqli_query($mysqli, "INSERT INTO `tbl_nhan_hotro`(`id_hotro_kinhphi`, `id_nhanvien`, `id_tourdulich`, `sotien_nhan_hotro`, `status_nhan_hotro`) VALUES ('".$id_hotrokinhphi."','".$idnv."','".$idtour."','".$tienhotro."','0')");
            }
        }

        unset($_SESSION['tour']);
        unset($_SESSION['ticket']);
        header('location:../../../index.php?select=tour&query=hoanthanh');

    }
?>