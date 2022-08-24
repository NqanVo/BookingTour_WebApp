<?php 
$donvi_select = "SELECT * FROM tbl_donvi";
$donvi_query = mysqli_query($mysqli, $donvi_select);

$diadiem_select_query = mysqli_query($mysqli,"SELECT * FROM tbl_diadiem");

if(isset($_SESSION['taotour'])){
    echo '<script>window.alert("Tạo tour mới thành công!");</script>';
    unset($_SESSION['taotour']);
}
if(isset($_SESSION['dinhdang_img'])){
    echo '<script>window.alert("Định dạng file ảnh không phù hợp!");</script>';
    unset($_SESSION['dinhdang_img']);
}
if(isset($_SESSION['dinhdang_chitiet'])){
    echo '<script>window.alert("Định dạng file chi tiết không phù hợp!");</script>';
    unset($_SESSION['dinhdang_chitiet']);
}

?>


<!-- tao tour du lich  -->
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Tạo tour mới</h1>
    <a href="?quanly=tour&query=danhsach"
        class="content__body__heading-link"><i class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>

<form method="POST" action="modules/container/quanly_tour/tour_them_sua_xuly.php" enctype="multipart/form-data" autocomplete="off">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên tour: <span class="error-txt">*</span>
                </h1>
                <input type="text" name="ten_tour" class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Địa điểm: <span class="error-txt">*</span>
                </h1>
                <!-- <input type="text" name="diadiem_tour" class="input-df content__body-form-input" required> -->

                <select name="diadiem_tour" class="input-df input-df-date content__body-form-input" required>
                    <?php 
                        while($diadiem_row = mysqli_fetch_array($diadiem_select_query))
                        {
                        ?>
                    <option value="<?php echo $diadiem_row['ten_diadiem'] ?>"><?php echo $diadiem_row['ten_diadiem'] ?></option>
                    <?php
                        }
                    ?>
                </select>

            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Mô tả: <span class="error-txt">*</span>
                </h1>
                <input type="text" name="mota_tour" class="input-df content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Nội dung: <span class="error-txt">*</span>
                </h1>
                <textarea rows="10" name="noidung_tour" class="input-df content__body-form-input"
                    required=""></textarea>
                <script>
                CKEDITOR.replace('noidung_tour');
                </script>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Đăng ký trước ngày: <span class="error-txt">*</span>
                </h1>
                <input type="date" name="dangkytruoc_tour" class="input-df input-df-date content__body-form-input"
                    required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Ngày đi: <span class="error-txt">*</span>
                </h1>
                <input type="date" name="ngaydi_tour" class="input-df input-df-date content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Ngày về: <span class="error-txt">*</span>
                </h1>
                <input type="date" name="ngayve_tour" class="input-df input-df-date content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Giá tour: <span class="error-txt">*</span>
                </h1>
                <input type="number" name="gia_tour" class="input-df content__body-form-input" required>
            </div>
            <!-- <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Số lượng tối đa: <span class="error-txt">*</span>
                </h1>
                <input type="number" name="soluongmax_tour" class="input-df input-df-date content__body-form-input" required>
            </div> -->
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tour cho đơn vị: <span class="error-txt">*</span>
                </h1>
                <select name="donvi_tour" class="input-df input-df-date content__body-form-input" required>
                    <option value="0">Tất cả</option>
                    <?php 
                        while($donvi_row = mysqli_fetch_array($donvi_query))
                        {
                        ?>
                    <option value="<?php echo $donvi_row['id_donvi'] ?>"><?php echo $donvi_row['ten_donvi'] ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Ảnh nền (PNG/JPG/JPEG): <span class="error-txt">*</span>
                </h1>
                <input type="file" name="img_tour" accept="image/png, image/jpg, image/jpeg" class="input-df content__body-form-input" required>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Chi tiết tour (PDF): <span class="error-txt">*</span>
                </h1>
                <input type="file" name="chitiet_tour" accept=".pdf" class="input-df content__body-form-input" required>
            </div>
            <input type="submit" name="themtour" value="Tạo Tour"
                class="btn-m btn-main success-bg-txt content__body-btn"></input>
        </div>
    </div>
</form>

