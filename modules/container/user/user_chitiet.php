<?php
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }

    if($nhanvien_row['gioitinh_nhanvien'] == 'nam'){
        $gioitinh_nhanvien_ucfirst = 'Nam';
    }
    else{
        $gioitinh_nhanvien_ucfirst = "Nữ";
    }

   if(isset($_SESSION['update_ingo'])){
        unset($_SESSION['update_ingo']);
        echo '<script>window.alert("Cập nhật thông tin thành công!");</script>';
   }

    if( $nhanvien_row['chucvu_nhanvien']==0){
        $chuvu="Quản lý";
    }elseif($nhanvien_row['chucvu_nhanvien']==1){
        $chuvu="Tổ trưởng";
    }elseif($nhanvien_row['chucvu_nhanvien']==2){
        $chuvu="Nhân viên";
    }

    if($nhanvien_row['gioitinh_nhanvien']== 'nam'){
        $avata="https://cdn-icons-png.flaticon.com/128/163/163834.png";
    }else{
        $avata="https://cdn-icons-png.flaticon.com/512/186/186037.png";
    }

?>
<div class="grid wide">
    <div class="container">
        <section class="container__content container-user">
            <div class="row no-gutters">
                <div class="col l-12 c-12">
                    <div class="container_information-gr container_information-gruop-btn">
                        <div class="container_information-gruop-btn-gr-right">
                            <?php
                            if($chucvu == 0){ echo '<a href="./quanly" target="_blank"
                                class="a-defaul btn-s btn-main container_information-gruop-btn-item"><i
                                    class="fa-solid fa-house-user"></i> Đến trang Admin</a>';}
                            ?>
                        </div>
                        <div class="container_information-gruop-btn-gr">
                            <a href="?select=tour&query=likedall"
                                class="a-defaul btn-s btn-main container_information-gruop-btn-item container_information-gruop-btn-item-liked"><i
                                    class="fa-solid fa-heart"></i></a>
                            <a href="?select=user&query=capnhatinfo&idnv=<?php echo $idnv ?>"
                                class="a-defaul btn-s btn-main container_information-gruop-btn-item"><i
                                    class="ti-pencil"></i></a>
                            <a href="?select=user&query=capnhatmk&idnv=<?php echo $idnv ?>"
                                class="a-defaul btn-s btn-main container_information-gruop-btn-item"><i
                                    class="ti-key"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col l-3 c-12">
                    <div class="container_information-avt">
                        <img src="<?php echo $avata;?>" class="container_information-avt-img">
                    </div>
                </div>
                <div class="col l-9 c-12">
                    <div class="container_information-gr container_information-gr-info">
                        <h3 class="container_information-gr-info-heading"><i class="fa-solid fa-user"></i> Thông tin
                            nhân viên</h3>
                        <div class="container_information-gr-info-group">
                            <div class="container_information-gr-info-group-text">
                                <p class="container_information-gr-info-text">Tên:</p>
                                <p class="container_information-gr-info-text">SĐT:</p>
                                <p class="container_information-gr-info-text">Địa chỉ:</p>
                                <p class="container_information-gr-info-text">Email:</p>
                                <p class="container_information-gr-info-text">CCCD:</p>
                                <p class="container_information-gr-info-text">Giới tính:</p>
                            </div>
                            <div class="container_information-gr-info-group-text">
                                <p><?php echo $nhanvien_row['ten_nhanvien']?></p>
                                <p><?php echo $nhanvien_row['sdt_nhanvien'];?></p>
                                <p><?php echo $nhanvien_row['diachi_nhanvien'];?></p>
                                <p><?php echo $nhanvien_row['email_nhanvien'];?></p>
                                <p><?php echo $nhanvien_row['cccd_nhanvien'];?></p>
                                <p><?php echo $gioitinh_nhanvien_ucfirst ;?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col l-12 c-12">
                    <div class="container_information-gr container_information-gr-work">
                        <h3 class="container_information-gr-info-heading"><i class="fa-solid fa-briefcase"></i> Thông
                            tin đơn vị</h3>
                        <div class="container_information-gr-info-group">
                            <div class="container_information-gr-info-group-text">
                                <p class="container_information-gr-info-text">Đơn vị:</p>
                                <p class="container_information-gr-info-text">Phòng:</p>
                                <p class="container_information-gr-info-text">Chức vụ:</p>
                                <p class="container_information-gr-info-text">Ngày vào làm:</p>
                                <p class="container_information-gr-info-text">Thâm niên:</p>
                            </div>
                            <div class="container_information-gr-info-group-text">
                                <p><?php echo $donvi_row['ten_donvi'];?></p>
                                <p>
                                    <?php echo $phongban_row['ten_phongban'];?></p>
                                <p><?php echo $chuvu ;?></p>
                                <p>
                                    <?php echo date("d/m/Y", strtotime($nhanvien_row['ngayvaolam_nhanvien'])); ?>
                                </p>
                                <p><?php echo $thamnien?> Năm</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col l-12 c-12">
                    <div class="row no-gutters">
                        <div class="col l-6 c-12">
                            <div class="container_information-gr container_information-gr-work">
                                <h3 class="container_information-gr-info-heading"><i class="fa-solid fa-ticket"></i> Hỗ
                                    trợ kinh
                                    phí</h3>
                                <div class="container_information-gr-info-group">
                                    <div class="container_information-gr-info-group-text">
                                        <p class="container_information-gr-info-text">Số tiền hỗ trợ:</p>
                                        <p class="container_information-gr-info-text">Số lần hỗ trợ:</p>
                                        <p class="container_information-gr-info-text">Đã sử dụng:</p>
                                        <p class="container_information-gr-info-text">Chu kì:
                                    </div>
                                    <div class="container_information-gr-info-group-text">
                                        <p><?php echo number_format($tien_hotro_view,0,',',',')?> đ</p>
                                        <p>1</p>
                                        <p><?php if($tien_hotro==0){echo '1';}else{echo '0';}?></p>
                                        <p><?php echo $hotro_kinhphi_row['tunam_hotro_kinhphi']?> -
                                            <?php echo $hotro_kinhphi_row['dennam_hotro_kinhphi']?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col l-6 c-12">
                            <div class="container_information-gr container_information-gr-work">
                                <h3 class="container_information-gr-info-heading"><i
                                        class="fa-solid fa-exclamation"></i> Lưu ý</h3>
                                <p>- Vui lòng đặt lại nếu như tiền hỗ trợ chưa được khấu trừ vào giá tour.</p>
                                <p>- Khi hủy tour, tiền hỗ trợ sẽ được khấu trừ vào tour còn lại trong <a
                                        href="?select=tour&query=lichsu" class="warring-txt">lịch sử đặt tour</a> hoặc
                                    sẽ được hoàn về và khấu trừ vào lần đặt tour kế tiếp.</p>
                                <p>- Tiền hỗ trợ sẽ không được cộng dồn nếu như kì này bạn không sử dụng.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col l-12 c-12">
                    <div class="container_information-gr container_information-gruop-btn">
                        <div class="container_information-gruop-btn-gr">
                            <a href="?select=dangxuat&query=1"
                                class="a-defaul btn-s btn-main container_information-gruop-btn-item"><i
                                    class="fa-solid fa-arrow-right-from-bracket"></i>Đăng Xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>