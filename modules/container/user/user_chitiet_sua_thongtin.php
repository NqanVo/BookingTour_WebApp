<?php
ob_start();
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }
    
    if(isset($_POST['capnhat_thongtin'])){
        $ten = $_POST['ten_nhanvien'];
        $diachi = $_POST['diachi_nhanvien'];
        $sdt = $_POST['sdt_nhanvien'];
        $email = $_POST['email_nhanvien'];
        $cccd = $_POST['cccd_nhanvien'];
        $gioitinh = $_POST['gioitinh_nhanvien'];

        $update_thongtin_query = mysqli_query($mysqli,"UPDATE `tbl_nhanvien` SET `ten_nhanvien`='".$ten."',`sdt_nhanvien`='".$sdt."',`diachi_nhanvien`='".$diachi."',`email_nhanvien`='".$email."',`cccd_nhanvien`='".$cccd."',`gioitinh_nhanvien`='".$gioitinh."' WHERE id_nhanvien = '".$idnv."'");
        $_SESSION['update_ingo'] = 'hlkew';
        header("location:index.php?select=user&query=chitiet");
    }
ob_end_flush();
?>


<div class="grid wide">
    <div class="container">
        <section class="container__content container-user">
            <div class="row no-gutters">
                <div class="col l-12 c-12">
                    <div class="container_information-gr container_information-gruop-btn">
                        <div class="container_information-gruop-btn-gr-right">
                        </div>
                        <div class="container_information-gruop-btn-gr">
                        <a href="?select=user&query=chitiet"
                            class="a-defaul btn-s btn-main container_information-gruop-btn-item"><i
                                class="ti-back-left"></i></a>
                        <a href="?select=user&query=capnhatmk&idnv=<?php echo $idnv ?>"
                            class="a-defaul btn-s btn-main container_information-gruop-btn-item"><i
                                class="ti-key"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row no-gutters">
                <div class="col l-6 c-12">
                    <div class="container_information-gr container_information-gr-work">
                        <h3 class="container_information-gr-info-heading container_information-gr-info-heading-update">
                            Cập nhật thông tin tài khoản</h3>
                        <form method="POST" action="">
                            <div class="container_information-gr-info-heading-update">
                                <div class="form-input container-cart__form-group">
                                    <span class="container-cart__form-label">Tên nhân viên:</span>
                                    <input type="text" name="ten_nhanvien"
                                        value="<?php echo $nhanvien_row['ten_nhanvien'] ?>"
                                        class="input-df container-cart__form-input" required>
                                </div>
                                <div class="form-input container-cart__form-group">
                                    <span class="container-cart__form-label">Địa chỉ:</span>
                                    <input type="text" name="diachi_nhanvien"
                                        value="<?php echo $nhanvien_row['diachi_nhanvien'] ?>"
                                        class="input-df container-cart__form-input" required>
                                </div>
                                <div class="form-input container-cart__form-group">
                                    <span class="container-cart__form-label">SDT:</span>
                                    <input type="tel" name="sdt_nhanvien" maxlength="10"  onkeypress="return isNumberKey(event);"
                                        value="<?php echo $nhanvien_row['sdt_nhanvien'] ?>"
                                        class="input-df container-cart__form-input" required>
                                </div>
                                <div class="form-input container-cart__form-group">
                                    <span class="container-cart__form-label">Email:</span>
                                    <input type="email" name="email_nhanvien"
                                        value="<?php echo $nhanvien_row['email_nhanvien'] ?>"
                                        class="input-df container-cart__form-input" required>
                                </div>
                                <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">CCCD/CMND:</span>
                                        <input type="tel" name="cccd_nhanvien" id="cccd_ve" maxlength="12" placeholder="Nhập CCCD/CMND..." onkeypress="return isNumberKey(event);" value="<?php echo $nhanvien_row['cccd_nhanvien'] ?>"
                                            class="input-df container-cart__form-input" required>
                                        <span class="error-txt none" id="error-cccd">CCCD/CMND không hợp lệ!</span>
                                    </div>
                                <div class="form-input container-cart__form-group">
                                    <span class="container-cart__form-label">Giới tính:</span>
                                    <select name="gioitinh_nhanvien"
                                        class="input-df input-df-date container-cart__form-input">
                                        <?php
                                            if($nhanvien_row['gioitinh_nhanvien'] =='nam')
                                            {
                                                echo '<option value="nam" selected>Nam</option>
                                                <option value="nu" >Nữ</option>';
                                            }
                                            else{
                                                echo '<option value="nam">Nam</option>
                                                <option value="nu" selected>Nữ</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <input type="submit" name="capnhat_thongtin" value="Cập nhật" id="btnsubmit" class="btn-m btn-main">
                        </form>
                    </div>
                </div>
                <div class="col l-6 c-0">
                    <div class="container_information-gr-update-info-bg">
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>