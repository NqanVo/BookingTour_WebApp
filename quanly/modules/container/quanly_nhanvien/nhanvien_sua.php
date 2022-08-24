<?php
$iddv = $_GET['iddv'];
$idpb = $_GET['idpb'];
$idnv = $_GET['idnv'];
$phongban_select = "SELECT * FROM tbl_phongban WHERE tbl_phongban.id_phongban = $idpb";
$phongban_query = mysqli_query($mysqli, $phongban_select);
$phongban_row = mysqli_fetch_array($phongban_query);


//liet ke thong tin nhan vien
$nhanvien_select = "SELECT * FROM tbl_nhanvien where tbl_nhanvien.id_nhanvien = '".$idnv."' AND tbl_nhanvien.id_phongban ='".$idpb."'";
$nhanvien_query = mysqli_query($mysqli, $nhanvien_select);
$nhanvien_row = mysqli_fetch_array($nhanvien_query);

//xu ly cap nhat thong tin nhan vien
if(isset($_POST['suanv'])){
    $ten = $_POST['ten_nv'];
    $sdt = $_POST['sdt_nv'];
    $diachi = $_POST['diachi_nv'];
    $email = $_POST['email_nv'];
    $cccd = $_POST['cccd_nv'];
    $gioitinh = $_POST['gioitinh_nv'];
    $ngayvaolam = $_POST['ngayvaolam_nv'];
    $chucvu = $_POST['chucvu_nv'];
    $status = $_POST['status_nv'];
    // $phongban = $_POST['phongban_nv'];

    //cap nhat thong tin nhan vien
    $taikhoan_update = "UPDATE `tbl_nhanvien` SET `ten_nhanvien`='".$ten."',`sdt_nhanvien`='".$sdt."',`diachi_nhanvien`='".$diachi."',`email_nhanvien`='".$email."',`cccd_nhanvien`='".$cccd."',`gioitinh_nhanvien`='".$gioitinh."',`ngayvaolam_nhanvien`='".$ngayvaolam."',`chucvu_nhanvien`='".$chucvu."',`status_nhanvien`='".$status."' WHERE `id_nhanvien` = '".$idnv."' AND `id_phongban` = '".$idpb."'";
    $taikhoan__update_query = mysqli_query($mysqli, $taikhoan_update);
    echo '<script>alert("Cập nhật thành công!");</script>';
}


?>


<div class="content__body__heading">
    <h1 class="content__body__heading-text">Cập nhật thông tin:</h1>
    <a href="?quanly=nhanvien&query=chitiet&iddv=<?php echo $iddv ?>&idpb=<?php echo $idpb ?>&idnv=<?php echo $idnv?>" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master content__body__master-info">
        <div class="col l-4 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên nhân viên
                </h1>
                <input type="text" name="ten_nv" value="<?php echo $nhanvien_row['ten_nhanvien']?>"
                    class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Số điện thoại
                </h1>
                <input type="tel" name="sdt_nv" id="sdt_nv" pattern="\d*" minlength="10" maxlength="10"  onkeypress="return isNumberKey(event);" value="<?php echo $nhanvien_row['sdt_nhanvien']?>"
                    class="input-df content__body-form-input" required>
                <span class="error-txt none" id="error-sdt">Số điện thoại không hợp lệ!</span>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Địa chỉ
                </h1>
                <input type="text" name="diachi_nv" value="<?php echo $nhanvien_row['diachi_nhanvien']?>"
                    class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Email
                </h1>
                <input type="email" name="email_nv" value="<?php echo $nhanvien_row['email_nhanvien']?>"
                    class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    CCCD/CMND
                </h1>
                <input type="tel" name="cccd_nv" id="cccd_nv" maxlength="12"  onkeypress="return isNumberKey(event);" value="<?php echo $nhanvien_row['cccd_nhanvien']?>"
                    class="input-df content__body-form-input" required>
                <span class="error-txt none" id="error-cccd">CCCD/CMND không hợp lệ!</span>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Giới tính
                </h1>
                <select name="gioitinh_nv" class="input-df input-df-date content__body-form-input">
                    <?php 
                    if($nhanvien_row['gioitinh_nhanvien'] == 'nam')
                    {
                        echo '<option value="nam" selected="">Nam</option>
                        <option value="nu">Nữ</option>';
                    }
                    else{
                        echo '<option value="nam">Nam</option>
                        <option value="nu" selected="">Nữ</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Ngày vào làm
                </h1>
                <input type="date" name="ngayvaolam_nv" value="<?php echo $nhanvien_row['ngayvaolam_nhanvien']?>"
                    class="input-df input-df-date content__body-form-input">
            </div>
        </div>
        <div class="col l-4 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Phòng
                </h1>
                <input type="text" name="password_nv" value="<?php echo $phongban_row['ten_phongban']?>"
                    class="input-df content__body-form-input" disabled>
            </div>
            
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Chức vụ
                </h1>
                <select name="chucvu_nv" class="input-df input-df-date content__body-form-input">
                    <?php 
                    if($nhanvien_row['chucvu_nhanvien'] == '0')
                    {
                        echo '<option value="0" selected="">Quản lý</option>
                        <option value="1">Tổ trưởng</option>
                        <option value="2">Nhân viên</option>';
                    }
                    elseif($nhanvien_row['chucvu_nhanvien'] == '1'){
                        echo '<option value="0">Quản lý</option>
                        <option value="1" selected="">Tổ trưởng</option>
                        <option value="2">Nhân viên</option>';
                    }
                    elseif($nhanvien_row['chucvu_nhanvien'] == '2'){
                        echo '<option value="0">Quản lý</option>
                        <option value="1">Tổ trưởng</option>
                        <option value="2" selected="">Nhân viên</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tài khoản
                </h1>
                <input type="text" name="taikhoan_nv" value="<?php echo $nhanvien_row['taikhoan_nhanvien']?>"
                    class="input-df content__body-form-input" disabled>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Mật khẩu
                </h1>
                <a href="?quanly=nhanvien&query=suamatkhau&iddv=<?php echo $iddv ?>&idpb=<?php echo $idpb?>&idnv=<?php echo $idnv?>"
                    class="input-df input-df-date btn-main content__body-form-input a-defaul" style="color:white">Đổi mật khẩu</a>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Trạng thái:
                </h1>
                <?php
                    if($idnv == $_SESSION['login_admin'])
                    {
                    ?>
                        <select name="status_nv" class="input-df input-df-date content__body-form-input disabled">
                            <?php 
                            if($nhanvien_row['status_nhanvien'] == '1')
                            {
                                echo '<option value="1" selected="">Hoạt động</option>
                                <option value="0">Ngừng hoạt động</option>';
                            }
                            else
                            {
                                echo '<option value="1">Hoạt động</option>
                                <option value="0" selected="">Ngừng hoạt động</option>';
                            }
                            ?>
                        </select>
                    <?php                           
                    }
                    else{
                        ?>
                        <select name="status_nv" class="input-df input-df-date content__body-form-input">
                            <?php 
                            if($nhanvien_row['status_nhanvien'] == '1')
                            {
                                echo '<option value="1" selected="">Hoạt động</option>
                                <option value="0">Ngừng hoạt động</option>';
                            }
                            else
                            {
                                echo '<option value="1">Hoạt động</option>
                                <option value="0" selected="">Ngừng hoạt động</option>';
                            }
                            ?>
                        </select>
                    <?php   
                    }
                    ?>
            </div>
            <input type="submit" name="suanv" id="btnsubmit" value="Cập Nhật" class="btn-m btn-main content__body-btn"></input>
            
        </div>
        <div class="col l-4 c-12">
        </div>
    </div>
</form>