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
        $thamnien = $value['thamnien'];
    }

    $quanhe = "daidien";
    $ngaydatve = $today;

    // lay thong tin don vi cua nhan vien 
    $donvi_select = "SELECT * FROM tbl_donvi WHERE tbl_donvi.id_donvi = '".$iddv."'";
    $donvi_query = mysqli_query($mysqli, $donvi_select);
    $donvi_row = mysqli_fetch_array($donvi_query);

    // them ve 
    if(isset($_POST['luu_ve']))
    {
        $idtour = $_GET['idtour'];
        
        $songuoi_dangky = 1;

        $tour_select = "SELECT * FROM tbl_tourdulich where id_tourdulich ='".$idtour."' LIMIT 1";
        $tour_query = mysqli_query($mysqli,$tour_select);
        $tour_row = mysqli_fetch_array($tour_query);

        $gia_ve = $tour_row['gia_tourdulich'];
        $ngaydat_ve = $_POST['ngaydat_ve'];
        $ten_ve = $_POST['ten_ve'];
        $sdt_ve = $_POST['sdt_ve'];
        $cccd_ve = $_POST['cccd_ve'];
        $gioitinh_ve = $_POST['gioitinh_ve'];
        $quanhe_ve = $_POST['quanhe_ve'];

        $old_ticket = $_SESSION['ticket'];

		$new_ticket = array(array('id_nv'=>$idnv,'id_tour'=>$idtour,'gia_ve'=> $gia_ve,'ngaydat_ve'=>$ngaydat_ve,'ten_ve'=>$ten_ve,'sdt_ve'=>$sdt_ve,'cccd_ve'=>$cccd_ve,'gioitinh_ve'=>$gioitinh_ve,'quanhe_dangky' => $quanhe_ve,'songuoi_dangky'=>$songuoi_dangky));

        $_SESSION['ticket'] = array_merge($old_ticket,$new_ticket);

        header('location:../../../index.php?select=tour&query=dattour');
    }

    //xoa ve
    if(isset($_SESSION['ticket']) && isset($_GET['xoave']))
	{
		$thutu_arr = $_GET['xoave'];
        $arr = $_SESSION['ticket'];
        unset($arr[$thutu_arr]);

        $arr_sort_index = array_values($arr);

        $_SESSION['ticket'] = $arr_sort_index;

        if($_SESSION['ticket'] == null)
        {
            unset($_SESSION['tour']);
            unset($_SESSION['ticket']);
        }
        header('location:../../../index.php?select=tour&query=dattour');
	}

    //huy tour khoi gio hang
    if(isset($_GET['huytour'])){
        unset($_SESSION['tour']);
        unset($_SESSION['ticket']);
        $_SESSION['huytour'] = "huytour";
        header("Location:../../../index.php?select=tour&query=dattour");
    }

    //them tour vào giỏ hàng
    if(isset($_GET['dat_tour'])){
        $idtour = $_GET['idtour'];

        $songuoi_dangky = 1;
        
		$tour_select = "SELECT * FROM tbl_tourdulich where id_tourdulich ='".$idtour."' LIMIT 1";
		$tour_query = mysqli_query($mysqli,$tour_select);
		$tour_row = mysqli_fetch_array($tour_query);

        if($tour_row['donvi_tourdulich'] == $iddv || $tour_row['donvi_tourdulich']== '0'){
            $nhanvien_select = "SELECT * FROM tbl_nhanvien where id_nhanvien ='".$idnv."' LIMIT 1";
            $nhanvien_query = mysqli_query($mysqli,$nhanvien_select);
            $nhanvien_row = mysqli_fetch_array($nhanvien_query);
    
            // $tienhotro = $tien_hotro;
            $gia_ve = $tour_row['gia_tourdulich'];
            $thanhtien = $gia_ve - $tienhotro;
            if($thanhtien <=0){
                $thanhtien = 0;
            }
    
            if($tour_row)
            {   
                $new_tour = array(array('id_tour'=>$idtour,'ten_tour'=>$tour_row['ten_tourdulich'],'gia_tour'=> $tour_row['gia_tourdulich'],'img_tour'=>$tour_row['img_tourdulich'],'diadiem_tour'=>$tour_row['diadiem_tourdulich']));
    
                $new_ticket = array(array('id_nv'=>$idnv,'id_tour'=>$idtour,'gia_ve'=> $thanhtien,'ngaydat_ve'=>$ngaydatve,'ten_ve'=>$nhanvien_row['ten_nhanvien'],'sdt_ve'=>$nhanvien_row['sdt_nhanvien'],'cccd_ve'=>$nhanvien_row['cccd_nhanvien'],'gioitinh_ve'=>$nhanvien_row['gioitinh_nhanvien'],'quanhe_dangky' => $quanhe,'songuoi_dangky'=>$songuoi_dangky));
                
                if(isset($_SESSION['tour']) && isset($_SESSION['ticket']))
                {
                    $_SESSION['dang_dattour'] = $idtour;
                    header("Location:../../../index.php?select=tour&query=dattour");
                }
                else
                {
                    $_SESSION['tour'] = $new_tour;
                    $_SESSION['ticket'] = $new_ticket;
		            header('location:../../../index.php?select=tour&query=dattour');
                }
            }
        }
        else{
            $_SESSION['khongcungdonvi'] = $idtour;
            header("Location:../../../index.php?select=tour&query=chitiet&idtour=$idtour");
        }
    }

?>