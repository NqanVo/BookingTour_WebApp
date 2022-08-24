<?php
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }

    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $iddangkytour = $_GET['iddangkytour'];
    $idtour = $_GET['idtour'];

    //lay sl ve trong tour
    $tour_select = "SELECT * FROM tbl_tourdulich WHERE tbl_tourdulich.id_tourdulich = '".$idtour."'";
    $tour_query = mysqli_query($mysqli, $tour_select);
    $tour_row = mysqli_fetch_array($tour_query);
    $soluong_tour_max = $tour_row['soluongtoida_tourdulich'];
    $soluong_tour_dadangky = $tour_row['soluongdadangky_tourdulich'];
    $soluong_conlai = $soluong_tour_max - $soluong_tour_dadangky;
    $dangkytruoc = $tour_row['dangkytruoc_tourdulich'];
    $thanhtien = $tour_row['gia_tourdulich'];
    //lay sl ve trong dangkytour
    $tourdk_select = "SELECT * FROM tbl_dangkytour WHERE tbl_dangkytour.id_dangkytour = '".$iddangkytour."'";
    $tourdk_query = mysqli_query($mysqli, $tourdk_select);
    $tourdk_row = mysqli_fetch_array($tourdk_query);
    $soluong_ve = $tourdk_row['soluong_dangkytour'];

    if(strtotime($dangkytruoc) >= strtotime($today)){
        $thoihan = true;
    }
    else{
        $thoihan = false;
    }

    if(isset($_POST['themve']))
    {
        if($thoihan)
        {   
            $ten = $_POST['ten_ve'];
            $sdt = $_POST['sdt_ve'];
            $cccd = $_POST['cccd_ve'];
            $gioitinh = $_POST['gioitinh_ve'];
            $quanhe = 'nguoithan';
            //dat lai ve

            $check_daidien_dk_query = mysqli_query($mysqli,"SELECT * FROM tbl_dangkytour_chitiet WHERE id_dangkytour = '".$iddangkytour."' AND quanhe_dangkytour_chitiet = 'daidien'");
            $check_daidien_dk_row = mysqli_fetch_array($check_daidien_dk_query);
            $status_dadien = $check_daidien_dk_row['status_dangkytour_chitiet'];
            if($status_dadien == 1)
            {
                if($soluong_conlai >= 1)
                {
                    //them ve
                    $ve_chitiet_them = "INSERT INTO `tbl_dangkytour_chitiet`(`ten_dangkytour_chitiet`, `sdt_dangkytour_chitiet`, `cccd_dangkytour_chitiet`, `gioitinh_dangkytour_chitiet`, `quanhe_dangkytour_chitiet`, `thanhtien_dangkytour_chitiet`, `status_dangkytour_chitiet`, `id_dangkytour`, `id_tourdulich`) VALUES ('".$ten."','".$sdt."','".$cccd."','".$gioitinh."','".$quanhe."','".$thanhtien."','1','".$iddangkytour."','".$idtour."')";
                    $ve_chitiet_them_query = mysqli_query($mysqli, $ve_chitiet_them);

                    //cap nhat lai so luong dadangky tour
                    $soluong_tour_dadangky++;
                    $update_soluongdk = mysqli_query($mysqli,"UPDATE `tbl_tourdulich` SET `soluongdadangky_tourdulich`='".$soluong_tour_dadangky."' WHERE `id_tourdulich` = '".$idtour."'");

                    //cap nhat tong ve dangkytour
                    $soluong_ve++;
                    $update_soluongdktour = mysqli_query($mysqli,"UPDATE `tbl_dangkytour` SET `soluong_dangkytour`='".$soluong_ve."' WHERE `id_dangkytour` = '".$iddangkytour."'");
                    
                    $_SESSION['themve'] = 'abjew';
                    header("location:index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
                }
                else{
                    $_SESSION['fullve'] = 'abc';
                    header("location:index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
                }
            }
            else{
                $_SESSION['daidien_chuadk'] = 'abjew';
                header("location:index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
            }

            
        }
        else{
            $_SESSION['thoihan'] = 'abc';
            header("location:index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
        }
    }

?>




<div class="grid wide">
    <div class="row">
        <div class="col l-12 c-12">
            <div class="container-cart">
                <div class="heading-label">
                    <h1 class="heading-label-text">Đặt vé thêm</h1>
                    <div class="heading-label-gr">
                        <a href="?select=tour&query=lichsu_chitiet&iddangkytour=<?php echo $iddangkytour ?>"
                            class="heading-label-link"><i class="icon-m heading-label-link-btn ti-back-left"></i></a>
                    </div>
                </div>
                <div class="container-lichsu__form">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col l-12 c-12">
                                <div id="form-ve" class="form-capnhat">
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Mã tour:</span>
                                        <input type="text" value="<?php echo $idtour ?>"
                                            class="input-df input-df-date container-cart__form-input disabled">
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Họ tên:</span>
                                        <input type="text" name="ten_ve" id="ten_ve" placeholder="Nhập họ tên..."
                                            class="input-df container-cart__form-input" required>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Số điện thoại:</span>
                                        <input type="tel" name="sdt_ve" id="sdt_ve" placeholder="Nhập số điện thoại..." maxlength="10"  onkeypress="return isNumberKey(event);"
                                            class="input-df container-cart__form-input" required>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">CCCD/CMND:</span>
                                        <input type="tel" name="cccd_ve" maxlength="12" id="cccd_ve" placeholder="Nhập cccd/cmnd..."   onkeypress="return isNumberKey(event);"
                                            class="input-df container-cart__form-input" required>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Giới tính:</span>
                                        <select name="gioitinh_ve"
                                            class="input-df input-df-date container-cart__form-input">
                                            <option value="nam" checked>Nam</option>
                                            <option value="nu">Nữ</option>

                                        </select>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Quan hệ:</span>
                                        <select name="quanhe_ve"
                                            class="input-df input-df-date container-cart__form-input">
                                            <!-- <option value="daidien">Đại diện</option> -->
                                            <option value="nguoithan">Người thân</option>
                                        </select>
                                    </div>
                                    <div class="form-input container-cart__form-group container-cart__form-btn">
                                        <input type="submit" name="themve" value="Thêm vé"
                                            class="btn-s container-cart__form-btn-success"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>