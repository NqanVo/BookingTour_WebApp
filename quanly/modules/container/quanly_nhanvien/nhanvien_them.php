<?php
$iddv = $_GET['iddv'];
$idpb = $_GET['idpb'];
$phongban_select = "SELECT * FROM tbl_phongban WHERE tbl_phongban.id_phongban = $idpb";
$phongban_query = mysqli_query($mysqli, $phongban_select);
$phongban_row = mysqli_fetch_array($phongban_query);

//xu ly them nv
if(isset($_POST['themnv'])){
    $ten = $_POST['ten_nv'];
    $sdt = $_POST['sdt_nv'];
    $diachi = $_POST['diachi_nv'];
    $email = $_POST['email_nv'];
    $cccd = $_POST['cccd_nv'];
    $gioitinh = $_POST['gioitinh_nv'];
    $ngayvaolam = $_POST['ngayvaolam_nv'];
    $chucvu = $_POST['chucvu_nv'];
    $taikhoan = $_POST['taikhoan_nv'];
    $password = md5($_POST['password_nv']);
    $status = $_POST['status_nv'];
    $phongban = $_POST['phongban_nv'];

    //kiem tra taikhoan da ton tai tren he thong
    $taikhoan_check_select = "SELECT taikhoan_nhanvien FROM tbl_nhanvien WHERE tbl_nhanvien.taikhoan_nhanvien = '".$taikhoan."'";
    $taikhoan_check_query = mysqli_query($mysqli, $taikhoan_check_select);
    $taikhoan_check_count = mysqli_num_rows($taikhoan_check_query);
    if($taikhoan_check_count > 0){
        unset($taikhoan_check_count);
        echo '<script>window.alert("Tài khoản đã tồn tại!");</script>';
    }
    else{
        //them tai khoan vao he thong
        $taikhoan_insert = "INSERT INTO `tbl_nhanvien`(`id_phongban`, `ten_nhanvien`, `sdt_nhanvien`, `diachi_nhanvien`, `email_nhanvien`, `cccd_nhanvien`, `gioitinh_nhanvien`, `ngayvaolam_nhanvien`, `chucvu_nhanvien`, `taikhoan_nhanvien`, `matkhau_nhanvien`, `status_nhanvien`) VALUES ('".$phongban."','".$ten."','".$sdt."','".$diachi."','".$email."','".$cccd."','".$gioitinh."','".$ngayvaolam."','".$chucvu."','".$taikhoan."','".$password."','".$status."')";
        $taikhoan_query = mysqli_query($mysqli, $taikhoan_insert);
        echo '<script>window.alert("Tạo tài khoản thành công!");</script>';
    }
}

?>
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Thêm nhân viên: <?php echo $phongban_row['ten_phongban']?> </h1>
    <a href="?quanly=nhanvien&query=danhsach&iddv=<?php echo $iddv ?>&idpb=<?php echo $idpb ?>" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên nhân viên: <span class="error-txt">*</span>
                </h1>
                <input type="text" name="ten_nv" class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Số điện thoại: <span class="error-txt">*</span>
                </h1>
                <input type="tel" name="sdt_nv" id="sdt_nv" maxlength="10" class="input-df content__body-form-input"  onkeypress="return isNumberKey(event);" required>
                <span class="error-txt none" id="error-sdt">Số điện thoại không hợp lệ!</span>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Địa chỉ: <span class="error-txt">*</span>
                </h1>
                <input type="text" name="diachi_nv" class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Email: <span class="error-txt">*</span>
                </h1>
                <input type="email" name="email_nv" class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    CCCD/CMND: <span class="error-txt">*</span>
                </h1>
                <input type="tel" name="cccd_nv" id="cccd_nv" maxlength="12" class="input-df content__body-form-input"  onkeypress="return isNumberKey(event);" required>
                <span class="error-txt none" id="error-cccd">CCCD/CMND không hợp lệ!</span>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Giới tính: <span class="error-txt">*</span>
                </h1>
                <select name="gioitinh_nv" class="input-df input-df-date content__body-form-input">
                    <option value="nam">Nam</option>
                    <option value="nu">Nữ</option>
                </select>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Ngày vào làm: <span class="error-txt">*</span>
                </h1>
                <input type="date" name="ngayvaolam_nv" class="input-df input-df-date content__body-form-input"
                    required>
            </div>

            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Chức vụ: <span class="error-txt">*</span>
                </h1>
                <select name="chucvu_nv" class="input-df input-df-date content__body-form-input">
                    <option value="0">Quản lý</option>
                    <option value="1">Tổ trưởng</option>
                    <option value="2">Nhân viên</option>
                </select>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tài khoản: <span class="error-txt">*</span>
                </h1>
                <input type="text" name="taikhoan_nv" class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Mật khẩu: <span class="error-txt">*</span>
                </h1>
                <input type="password" name="password_nv" class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Trạng thái: <span class="error-txt">*</span>
                </h1>
                <select name="status_nv" class="input-df input-df-date content__body-form-input" required>
                    <option value="1">Hoạt động</option>
                    <option value="0">Ngừng hoạt động</option>
                </select>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Phòng:
                </h1>
                <select name="phongban_nv" class="input-df input-df-date content__body-form-input">
                    <option value="<?php echo $phongban_row['id_phongban']?>"><?php echo $phongban_row['ten_phongban']?>
                    </option>
                </select>
            </div>
            <input type="submit" name="themnv" id="btnsubmit" value="Thêm" class="btn-m btn-main content__body-btn"></input>
        </div>
    </div>
</form>