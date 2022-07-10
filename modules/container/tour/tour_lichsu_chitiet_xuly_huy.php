<?php
    session_start();
    include('../../../quanly/config/config.php');
    require('../../../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $idtour = $_GET['idtour'];
    $idvechitiet= $_GET['idvechitiet'];

    //lay thong tin user
    foreach($_SESSION['thongtin_user'] as $key => $value){
    $idnv = $value['id_nhanvien'];
    $iddv = $value['id_donvi'];
    $idhotrokinhphi = $value['id_hotrokinhphi'];
    $thamnien = $value['thamnien'];
    $idnhanhotro = $value['id_nhan_hotro'];
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

    if($idhotrokinhphi == '0'){
        $tien_hotro = 0;
        $id_nhan_hotro = '0';
    }
    else{
        //tìm tiền hỗ trợ
        $hotro_kinhphi_chitiet_query = mysqli_query($mysqli,"SELECT * FROM `tbl_hotro_kinhphi_chitiet2` WHERE `tbl_hotro_kinhphi_chitiet2`.`thamnien_hotro_kinhphi_chitiet` <= '".$thamnien."' AND id_hotro_kinhphi = '".$idhotrokinhphi."' ORDER BY thamnien_hotro_kinhphi_chitiet DESC LIMIT 1");
        $hotro_kinhphi_chitiet_row = mysqli_fetch_array($hotro_kinhphi_chitiet_query);
        $tien_hotro = $hotro_kinhphi_chitiet_row['tien_hotro_kinhphi_chitiet'];
    }

    //giave
    $gia_ve_tour_query = mysqli_query($mysqli, "SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$idtour."'");
    $gia_ve_tour_row = mysqli_fetch_array($gia_ve_tour_query);
    $gia_ve_tour = $gia_ve_tour_row['gia_tourdulich'];


    //lay quanhe
    $ve_chitiet_query = mysqli_query($mysqli,"SELECT * FROM tbl_dangkytour_chitiet WHERE tbl_dangkytour_chitiet.id_dangkytour_chitiet = '".$idvechitiet."'");
    $ve_chitiet_row = mysqli_fetch_array($ve_chitiet_query);

    $iddangkytour = $ve_chitiet_row['id_dangkytour'];
    $quanhe =  $ve_chitiet_row['quanhe_dangkytour_chitiet'];

    if($thoihan)
    {
        //huy ve nguoithan
        if(isset($_GET['tacvu']) == 'xoa' && $quanhe != 'daidien'){
            //cap nhat huy ve
            $ve_chitiet_capnhat_huy = "UPDATE `tbl_dangkytour_chitiet` SET `status_dangkytour_chitiet`='0' WHERE `tbl_dangkytour_chitiet`.`id_dangkytour_chitiet` = '".$idvechitiet."'";
            $ve_huy_query = mysqli_query($mysqli, $ve_chitiet_capnhat_huy);

            //cap nhat lai so luong dadangky tour
            $soluong_tour_dadangky--;
            $update_soluongdk = mysqli_query($mysqli,"UPDATE `tbl_tourdulich` SET `soluongdadangky_tourdulich`='".$soluong_tour_dadangky."' WHERE `id_tourdulich` = '".$idtour."'");

            $_SESSION['huyve'] = 'abjew';
            header("location:../../../index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
        }

        //huy ve daidien
        elseif(isset($_GET['tacvu']) == 'xoa' && $quanhe == 'daidien')
        {
            //dem tong so ve dang đăng ký
            $tong_ve_dk_select = mysqli_query($mysqli,"SELECT COUNT(status_dangkytour_chitiet) FROM tbl_dangkytour_chitiet WHERE status_dangkytour_chitiet = '1' AND id_dangkytour = '".$iddangkytour."'");
            $tong_ve_dk_row = mysqli_fetch_array($tong_ve_dk_select);
            $tongve = $tong_ve_dk_row['COUNT(status_dangkytour_chitiet)'];

            //cap nhat huy ve
            $ve_chitiet_capnhat_huy = "UPDATE `tbl_dangkytour_chitiet` SET `status_dangkytour_chitiet`='0' WHERE `tbl_dangkytour_chitiet`.`id_dangkytour` = '".$iddangkytour."'";
            $ve_huy_query = mysqli_query($mysqli, $ve_chitiet_capnhat_huy);

            //cap nhat lai so luong dadangky tour
            $soluong_tour_dadangky = $soluong_tour_dadangky - $tongve;
            $update_soluongdk = mysqli_query($mysqli,"UPDATE `tbl_tourdulich` SET `soluongdadangky_tourdulich`='".$soluong_tour_dadangky."' WHERE `id_tourdulich` = '".$idtour."'");

            //tien vé của tour đang xóa
            $tien_ve_tour_dangxoa_query = mysqli_query($mysqli,"SELECT * FROM `tbl_dangkytour_chitiet` WHERE `tbl_dangkytour_chitiet`.`id_tourdulich` = '".$idtour."' AND `tbl_dangkytour_chitiet`.`id_dangkytour`='".$iddangkytour."' AND `tbl_dangkytour_chitiet`.`quanhe_dangkytour_chitiet` = 'daidien'");
            $tien_ve_tour_dangxoa_row = mysqli_fetch_array($tien_ve_tour_dangxoa_query);
            $tien_ve_tour_dangxoa = $tien_ve_tour_dangxoa_row['thanhtien_dangkytour_chitiet'];

            //nếu hiện tại không có kì ho trợ thì hủy như thường
            if($idhotrokinhphi != '0')
            {
                if($tien_ve_tour_dangxoa < $gia_ve_tour)
                {
                    $tienhoan = $gia_ve_tour;
                    // kiem tra xem tour đang xóa có đang dc hỗ trợ không
                    $check_hotro_query = mysqli_query($mysqli,"SELECT * FROM tbl_nhan_hotro WHERE id_nhanvien = '".$idnv."' AND id_hotro_kinhphi='".$idhotrokinhphi."' AND id_tourdulich ='".$idtour."'");
                    $check_hotro_row = mysqli_num_rows($check_hotro_query);

                    if($check_hotro_row>0)
                    {
                        //tìm các tour đã đăng ký còn lại
                        $tour_con_lai_query = mysqli_query($mysqli,"SELECT * FROM `tbl_dangkytour` WHERE `tbl_dangkytour`.`id_nhanvien` = '".$idnv."' AND id_tourdulich != '".$idtour."'");
                        $tour_con_lai_count = mysqli_num_rows($tour_con_lai_query);
                        $tour_hethan = false;
                        if($tour_con_lai_count > 0)
                        {
                            //chon 1 tour thay thế để trừ tiền vé
                            for($i = 0;$i<$tour_con_lai_count;$i++)
                            {
                                $tour_con_lai_row = mysqli_fetch_array($tour_con_lai_query);
                                $id_tour = $tour_con_lai_row['id_tourdulich'];
                                $id_dktour = $tour_con_lai_row['id_dangkytour'];

                                //tìm ngày dk_truoc
                                $select_tour_query = mysqli_query($mysqli,"SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$id_tour."'");
                                $row_tour = mysqli_fetch_array($select_tour_query);
                                $dangky_truoc = $row_tour['dangkytruoc_tourdulich'];

                                //tìm trạng thái vé đạidien của tour đang lặp
                                $select_ve_chitiet_query = mysqli_query($mysqli,"SELECT * FROM `tbl_dangkytour_chitiet` WHERE `tbl_dangkytour_chitiet`.`id_tourdulich` = '".$id_tour."' AND `tbl_dangkytour_chitiet`.`id_dangkytour`='".$id_dktour."' AND `tbl_dangkytour_chitiet`.`quanhe_dangkytour_chitiet` = 'daidien'");
                                $row_ve_chitiet = mysqli_fetch_array($select_ve_chitiet_query);
                                $status_ve = $row_ve_chitiet['status_dangkytour_chitiet'];
                                $tien_ve = $row_ve_chitiet['thanhtien_dangkytour_chitiet'];

                                //kiem tra xem còn hạn thêm/hủy vé không
                                if($dangky_truoc >= $today && $status_ve == '1')
                                {
                                    
                                    $trutien = $tien_ve - $tien_hotro;
                                    
                                    //update tiền qua tour mới
                                    $update_trutien_query = mysqli_query($mysqli, "UPDATE `tbl_dangkytour_chitiet` SET `thanhtien_dangkytour_chitiet`='".$trutien."' WHERE `tbl_dangkytour_chitiet`.`id_tourdulich`='".$id_tour."' AND `tbl_dangkytour_chitiet`.`id_dangkytour` = '".$id_dktour."' AND `tbl_dangkytour_chitiet`.`quanhe_dangkytour_chitiet` = 'daidien'");

                                    //hồi giá vé tour đang xóa về cũ
                                    $update_hoantien_query = mysqli_query($mysqli, "UPDATE `tbl_dangkytour_chitiet` SET `thanhtien_dangkytour_chitiet`='".$tienhoan."' WHERE `tbl_dangkytour_chitiet`.`id_tourdulich`='".$idtour."' AND `tbl_dangkytour_chitiet`.`id_dangkytour` = '".$iddangkytour."' AND `tbl_dangkytour_chitiet`.`quanhe_dangkytour_chitiet` = 'daidien'");

                                    //update lai tour đã nhận hỗ trợ
                                    $update_hoantien_query = mysqli_query($mysqli, "UPDATE `tbl_nhan_hotro` SET `id_tourdulich`='".$id_tour."' WHERE id_nhanvien = '".$idnv."' AND id_hotro_kinhphi = '".$idhotrokinhphi."'");

                                    $tour_hethan = false;
                                    break;
                                }
                                else{
                                    $tour_hethan = true;
                                    continue;
                                }
                            }
                        }
                        //nếu không còn tour thay thế thì xóa đã nhận hổ trợ
                        else
                        {   
                            //hồi giá vé tour đang xóa về cũ
                            $update_hoantien_query = mysqli_query($mysqli, "UPDATE `tbl_dangkytour_chitiet` SET `thanhtien_dangkytour_chitiet`='".$tienhoan."' WHERE `tbl_dangkytour_chitiet`.`id_tourdulich`='".$idtour."' AND `tbl_dangkytour_chitiet`.`id_dangkytour` = '".$iddangkytour."' AND `tbl_dangkytour_chitiet`.`quanhe_dangkytour_chitiet` = 'daidien'");
                            //xoa đã nhận hotro
                            $datele_da_nhan_hotro = mysqli_query($mysqli, "DELETE FROM `tbl_nhan_hotro` WHERE id_nhan_hotro = '".$idnhanhotro."'");
                        }
                        //nếu không còn tour nào còn hạn để thay thế thì xóa đã nhận hổ trợ
                        if($tour_hethan)
                        {   
                            $tienhoan = $tien_ve_tour_dangxoa + $tien_hotro;
                            //hồi giá vé tour đang xóa về cũ
                            $update_hoantien_query = mysqli_query($mysqli, "UPDATE `tbl_dangkytour_chitiet` SET `thanhtien_dangkytour_chitiet`='".$tienhoan."' WHERE `tbl_dangkytour_chitiet`.`id_tourdulich`='".$idtour."' AND `tbl_dangkytour_chitiet`.`id_dangkytour` = '".$iddangkytour."' AND `tbl_dangkytour_chitiet`.`quanhe_dangkytour_chitiet` = 'daidien'");

                            $datele_da_nhan_hotro = mysqli_query($mysqli, "DELETE FROM `tbl_nhan_hotro` WHERE id_nhan_hotro = '".$idnhanhotro."'");
                        }
                    }
                }
            }
            else
            {
                //nếu tour đang dc sp, hôm sau hết kì sp, mà hủy thì vé về giá gốc.
                if($tien_ve_tour_dangxoa < $gia_ve_tour)
                {
                    $tienhoan = $gia_ve_tour;
                    //hồi giá vé tour đang xóa về cũ
                    $update_hoantien_query = mysqli_query($mysqli, "UPDATE `tbl_dangkytour_chitiet` SET `thanhtien_dangkytour_chitiet`='".$tienhoan."' WHERE `tbl_dangkytour_chitiet`.`id_tourdulich`='".$idtour."' AND `tbl_dangkytour_chitiet`.`id_dangkytour` = '".$iddangkytour."' AND `tbl_dangkytour_chitiet`.`quanhe_dangkytour_chitiet` = 'daidien'");
                }
            }
        
            $_SESSION['huyve'] = 'abjew';
            header("location:../../../index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
        }
    }
    else{
        $_SESSION['thoihan'] = 'abc';
        header("location:../../../index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
    }

?>