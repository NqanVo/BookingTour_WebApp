<?php ob_start();
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }

    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    //tinh tong tien
    if(isset($_SESSION['ticket'])){
        $tongnguoi = 0;
        $tongtien = 0;
        foreach($_SESSION['ticket'] as $key_ticket => $value_ticket){
            $gia_ticket = $value_ticket['gia_ve'];
            $tongtien += $gia_ticket;
            $tongnguoi += $value_ticket['songuoi_dangky'];
        }
    }

    //kiem ta so luong con lai
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

        if($soluong_conlai < $tongnguoi || isset($_SESSION['full-ve'])){
            unset($_SESSION['full-ve']);
            echo '<script>window.alert("Số vé đang vượt quá số lượng còn lại, vui lòng xóa bớt!");</script>';
        }

        //kiem ta tour da dang ky
        $tour_dangky_select = "SELECT * FROM tbl_dangkytour WHERE tbl_dangkytour.id_tourdulich = '".$idtour."' AND tbl_dangkytour.id_nhanvien = '".$idnv."'";
        $tour_dangky_query = mysqli_query($mysqli, $tour_dangky_select);
        $tour_dangky_count = mysqli_num_rows($tour_dangky_query);
        if($tour_dangky_count > 0){
            $_SESSION['tour-dadangky'] = $idtour;
            header("location:index.php?select=tour&query=lichsu");
        }
    }

    //kiem tra user da dat tour nay chua
    
    if(isset($_SESSION['dang_dattour'])){
        echo '<script>alert("Vui lòng hoàn thành tour đang đặt hoặc hủy tour!");</script>';
        unset($_SESSION['dang_dattour']);
    }
    if(isset($_SESSION['huytour'])){
        echo '<script>window.alert("Hủy tour thành công!");</script>';
        unset($_SESSION['huytour']);
    }
?>


<div class="grid wide">
    <div class="row">
        <div class="col l-12 c-12">
            <?php 
            if(isset($_SESSION['tour']))
            {
            ?>
            <div class="container-cart">
                <div style="display:flex; align-item:center; gap:20px;">
                    <a href="?select=tour&query=danhsach" class="btn-s btn-main container-cart__btn-back"><i
                            class="ti-back-left"></i>    
                    </a>
                    <!-- <p style="display:flex; align-item:center; gap:10px;">
                        <span>Danh sách</span>-
                        <span>Chi tiết</span>-
                        <span style="color:var(--color-main); font-weight:700">Giỏ hàng</span>
                    </p> -->
                </div>
                <div class="container-cart-status">
                    <div class="arrow-steps clearfix">
                        <div class="step current"><span><a href="">Giỏ Hàng</a></span> </div>
                        <div class="step"> <span><a href="#">Kiểm Tra</a></span> </div>
                        <div class="step"> <span><a href="#">Hoàn Thành</a><span> </div>
                    </div>
                </div>
                <div class="container-cart__tour">
                    <img src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_row['img_tourdulich'] ?>"
                        alt="" class="container-cart__tour-img">
                    <div class="container-cart__tour-group">
                        <h3 class="container-cart__tour-group-heading"><?php echo $tour_row['ten_tourdulich'] ?></h3>
                        <p class="container-cart__tour-group-heading-text">Địa điểm:
                            <?php echo $tour_row['diadiem_tourdulich'] ?></p>
                        <p class="container-cart__tour-group-heading-text">Giá vé:
                            <?php echo number_format($tour_row['gia_tourdulich'],0,',',',')?> đ</p>
                        <!-- <p class="container-cart__tour-group-heading-text">Số vé còn lại:
                            <?php echo $soluong_conlai ?> </p> -->
                    </div>
                </div>

                <!-- liet ke tong nguoi va tong tien  -->
                <div class="container-cart__control">
                    <button id="btn_themthanhvien" class="btn-s btn-main container-cart__control-btn">Thêm vé</button>
                    <h3 class="container-cart__control-text">Tổng người: <?php echo $tongnguoi ?>
                    </h3>
                    <h3 class="container-cart__control-text">Tiền hỗ trợ:
                        <?php echo number_format($tien_hotro,0,',',',')?>đ
                    </h3>
                    <h3 class="container-cart__control-text">Tổng tiền: <?php echo number_format($tongtien,0,',',',')?>đ
                    </h3>
                </div>
                <!-- liet ke ve da luu  -->
                <div class="container-cart__list">
                    <h3 class="container-cart__control-text">Vé đã lưu:</h3>
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Họ tên</td>
                                <td>SĐT</td>
                                <td>CCCD/CMND</td>
                                <td>Giới tính</td>
                                <td>Quan hệ</td>
                                <td>Xóa vé</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                        if(isset($_SESSION['ticket']))
                                        {
                                            $i = 0;
                                            $i--;
                                            $stt = 0;

                                            foreach ($_SESSION['ticket'] as $key_ticket => $value_ticket)
                                            {   
                                                $ten_ve = $value_ticket['ten_ve'];
                                                $sdt_ve = $value_ticket['sdt_ve'];
                                                $cccd_ve = $value_ticket['cccd_ve'];
                                                $gioitinh_ve_arr = $value_ticket['gioitinh_ve'];
                                                $quanhe_ve_arr = $value_ticket['quanhe_dangky'];
                                                if($gioitinh_ve_arr == 'nam'){
                                                    $gioitinh_ve = "Nam";
                                                }
                                                else{
                                                    $gioitinh_ve = "Nữ";
                                                }
                                                if($quanhe_ve_arr == 'daidien'){
                                                    $quanhe_ve = "Đại diện";
                                                }
                                                else{
                                                    $quanhe_ve = "Người Thân";
                                                }
                                                $i++;
                                                $stt++;
                                            ?>
                            <tr>
                                <td><?php echo $stt ?></td>
                                <td><?php echo $ten_ve ?></td>
                                <td><?php echo $sdt_ve ?></td>
                                <td><?php echo $cccd_ve ?></td>
                                <td><?php echo $gioitinh_ve ?></td>
                                <td><?php echo $quanhe_ve ?></td>
                                <td>
                                    <p class="container-cart__control-text-child"><a
                                            href="modules/container/tour/tour_dattour_xuly.php?xoave=<?php echo $i ?>"
                                            onclick="return confirm('Bạn chắc chắn muốn xóa vé?');" class="a-defaul"><i
                                                class="fa-solid fa-xmark"></i></a></p>
                                </td>
                            </tr>
                            <?php   
                                                
                                            }
                                        }
                                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="container-cart__form">
                    <form
                        action="modules/container/tour/tour_dattour_xuly.php?idtour=<?php echo $idtour ?>"
                        method="POST">
                        <div class="row">
                            <div class="col l-4 c-12">
                                <div id="form-ve" class="form-tour">
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Mã tour:</span>
                                        <input type="text" value="<?php echo $tour_row['id_tourdulich'] ?>"
                                            class="input-df input-df-date container-cart__form-input disabled">
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Mã tài khoản:</span>
                                        <input type="text" value="<?php echo $idnv ?>"
                                            class="input-df input-df-date container-cart__form-input disabled">
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Giá vé:</span>
                                        <input type="text" value="<?php echo $tour_row['gia_tourdulich'] ?>"
                                            class="input-df input-df-date container-cart__form-input disabled">
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Ngày đặt vé:</span>
                                        <input type="date" name="ngaydat_ve" value="<?php echo $today ?>"
                                            class="input-df input-df-date container-cart__form-input disabled">
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Họ tên: <span class="error-txt">*</span></span>
                                        <input type="text" name="ten_ve" id="ten_ve" placeholder="Nhập họ tên..."
                                            class="input-df container-cart__form-input" required>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Số điện thoại: <span class="error-txt">*</span></span>
                                        <input type="tel" name="sdt_ve" id="sdt_ve" maxlength="10" placeholder="Nhập số điện thoại..."
                                                onkeypress="return isNumberKey(event);"
                                            class="input-df container-cart__form-input" required>
                                        <span class="error-txt none" id="error-sdt">Số điện thoại không hợp lệ!</span>
                                    
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">CCCD/CMND: <span class="error-txt">*</span></span> 
                                        <input type="tel" name="cccd_ve" id="cccd_ve" maxlength="12" placeholder="Nhập CCCD/CMND..."  onkeypress="return isNumberKey(event);"
                                            class="input-df container-cart__form-input" required>
                                        <span class="error-txt none" id="error-cccd">CCCD/CMND không hợp lệ!</span>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Giới tính: <span class="error-txt">*</span></span>
                                        <select name="gioitinh_ve"
                                            class="input-df input-df-date container-cart__form-input">
                                            <option value="nam">Nam</option>
                                            <option value="nu">Nữ</option>
                                        </select>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Quan hệ: <span class="error-txt">*</span></span>
                                        <select name="quanhe_ve"
                                            class="input-df input-df-date container-cart__form-input">
                                            <!-- <option value="daidien">Đại diện</option> -->
                                            <option value="nguoithan">Người thân</option>
                                        </select>
                                    </div>
                                    <div class="form-input container-cart__form-group container-cart__form-btn">
                                        <input type="submit" name="luu_ve" id="btnsubmit" value="Lưu Vé"
                                            class="btn-s container-cart__form-btn-success"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col l-12 c-0" id="backgroud-ve">
                                <div class="form-img"></div>
                            </div>
                    </form>
                </div>
                <a href="?select=tour&query=thanhtoan" class="btn-m btn-main container-cart-btn">Tiếp tục</a>
                <a href="modules/container/tour/tour_dattour_xuly.php?huytour=1"
                    onclick="return confirm('Bạn chắc chắn muốn hủy tour?');"
                    class="btn-m success-bg-txt container-cart-btn">Hủy
                    Tour</a>
            </div>

            <?php
            }
            else
            {
            ?>
            <div class="container-cart">
                <a href="?select=tour&query=danhsach" class="btn-s btn-main container-cart__btn-back"><i
                        class="ti-back-left"></i></a>
                <div class="container-cart-status">
                    <div class="arrow-steps clearfix">
                        <div class="step current"><span><a href="">Giỏ Hàng</a></span></div>
                    </div>
                </div>
                <div class="container-cart container-cart__none">
                    <h3>Giỏ hàng trống</h3>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>