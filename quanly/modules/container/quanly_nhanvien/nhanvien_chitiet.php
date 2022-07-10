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
?>


<div class="content__body__heading">
    <h1 class="content__body__heading-text">Thông tin nhân viên: <?php echo $nhanvien_row['ten_nhanvien']?></h1>
    
    <div class="content__body__heading-gr">
        <a href="?quanly=nhanvien&query=sua&iddv=<?php echo $iddv ?>&idpb=<?php echo $phongban_row['id_phongban'] ?>&idnv=<?php echo $nhanvien_row['id_nhanvien']?>"
            class="content__body__heading-link"><i class="icon-m content__body__heading-link-btn ti-pencil"></i></a>
            <a href="?quanly=nhanvien&query=danhsach&iddv=<?php echo $iddv ?>&idpb=<?php echo $idpb ?>"
        class="content__body__heading-link"><i class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
    </div>
</div>

<form method="POST" action="">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên nhân viên
                </h1>
                <p class="input-df content__body-form-input"><?php echo $nhanvien_row['ten_nhanvien']?></p>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Số điện thoại
                </h1>
                <p class="input-df content__body-form-input"><?php echo $nhanvien_row['sdt_nhanvien']?></p>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Địa chỉ
                </h1>
                <p class="input-df content__body-form-input"><?php echo $nhanvien_row['diachi_nhanvien']?></p>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Email
                </h1>
                <p class="input-df content__body-form-input"><?php echo $nhanvien_row['email_nhanvien']?></p>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    CCCD/CMND
                </h1>
                <p class="input-df content__body-form-input"><?php echo $nhanvien_row['cccd_nhanvien']?></p>

            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Giới tính
                </h1>
                <select name="gioitinh_nv" class="input-df input-df-date content__body-form-input" disabled>
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
                    class="input-df input-df-date content__body-form-input" disabled>
            </div>

            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Chức vụ
                </h1>
                <select name="chucvu_nv" class="input-df input-df-date content__body-form-input" disabled>
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
                <p class="input-df content__body-form-input"><?php echo $nhanvien_row['taikhoan_nhanvien']?></p>

            </div>

            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Trạng thái:
                </h1>
                <select name="status_nv" class="input-df input-df-date content__body-form-input" disabled>
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
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Phòng
                </h1>
                <p class="input-df content__body-form-input"><?php echo $phongban_row['ten_phongban']?></p>

            </div>

        </div>
    </div>
</form>