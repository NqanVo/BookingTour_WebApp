<?php 
$idtour = $_GET['idtour'];
$tour_select = "SELECT * FROM tbl_tourdulich WHERE tbl_tourdulich.id_tourdulich = '".$idtour."'";
$tour_query = mysqli_query($mysqli, $tour_select);
$tour_row = mysqli_fetch_array($tour_query);

$donvi_select = "SELECT * FROM tbl_donvi";
$donvi_query = mysqli_query($mysqli, $donvi_select);

$diadiem_select_query = mysqli_query($mysqli,"SELECT * FROM tbl_diadiem");

if(isset($_SESSION['suatour'])){
    echo '<script>window.alert("Cập nhật tour thành công!");</script>';
    unset($_SESSION['suatour']);
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

<div class="content__body__heading">
    <h1 class="content__body__heading-text">Cập nhật tour:</h1>
    <a href="?quanly=tour&query=chitiet&idtour=<?php echo $idtour ?>" class="content__body__heading-link"><i
            class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
</div>
<!-- modules/container/quanly_tour/tour_them_sua_xuly.php  -->
<form method="POST" action="modules/container/quanly_tour/tour_them_sua_xuly.php" enctype="multipart/form-data" autocomplete="off">
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    ID tour:
                </h1>
                <input type="text" name="id_tour" value="<?php echo $tour_row['id_tourdulich'] ?>"
                    class="input-df content__body-form-input disabled">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tên tour:
                </h1>
                <input type="text" name="ten_tour" value="<?php echo $tour_row['ten_tourdulich'] ?>"
                    class="input-df content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Địa điểm:
                </h1>
                    <select name="diadiem_tour" class="input-df input-df-date content__body-form-input" required>
                    <?php 
                        while($diadiem_row = mysqli_fetch_array($diadiem_select_query))
                        {
                            if($tour_row['diadiem_tourdulich'] == $diadiem_row['ten_diadiem'])
                            {
                            ?>
                                <option value="<?php echo $diadiem_row['ten_diadiem'] ?>" selected><?php echo $diadiem_row['ten_diadiem'] ?></option>
                            <?php
                            }
                            else{
                                ?>
                                <option value="<?php echo $diadiem_row['ten_diadiem'] ?>"><?php echo $diadiem_row['ten_diadiem'] ?></option>
                            <?php
                            }
                        ?>
                        <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Mô tả:
                </h1>
                <input type="text" name="mota_tour" value="<?php echo $tour_row['mota_tourdulich'] ?>"
                    class="input-df content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Nội dung:
                </h1>
                <textarea rows="10" name="noidung_tour"
                    class="input-df content__body-form-input"><?php echo $tour_row['noidung_tourdulich'] ?></textarea>
                <script>
                CKEDITOR.replace('noidung_tour');
                </script>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Đăng ký trước ngày:
                </h1>
                <input type="date" name="dangkytruoc_tour" value="<?php echo $tour_row['dangkytruoc_tourdulich'] ?>"
                    class="input-df input-df-date content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Ngày đi:
                </h1>
                <input type="date" name="ngaydi_tour" value="<?php echo $tour_row['ngaydi_tourdulich'] ?>"
                    class="input-df input-df-date content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Ngày về:
                </h1>
                <input type="date" name="ngayve_tour" value="<?php echo $tour_row['ngayve_tourdulich'] ?>"
                    class="input-df input-df-date content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Giá tour:
                </h1>
                <input type="number" name="gia_tour" value="<?php echo $tour_row['gia_tourdulich'] ?>"
                    class="input-df content__body-form-input">
            </div>
            <!-- <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Số lượng tối đa:
                </h1>
                <input type="number" name="soluongmax_tour" value="<?php echo $tour_row['soluongtoida_tourdulich'] ?>" class="input-df input-df-date content__body-form-input">
            </div> -->
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Tour cho đơn vị:
                </h1>
                <select name="donvi_tour" class="input-df input-df-date content__body-form-input">
                    <?php
                        if($tour_row['donvi_tourdulich'] == 0){ echo '<option value="0" selected>Tất cả</option>';}
                        else{echo '<option value="0">Tất cả</option>';}
                    ?>
                    <?php 
                        while($donvi_row = mysqli_fetch_array($donvi_query))
                        {
                            if($tour_row['donvi_tourdulich'] == $donvi_row['id_donvi'])
                            {
                                ?>
                                <option value="<?php echo $donvi_row['id_donvi'] ?>" selected><?php echo $donvi_row['ten_donvi'] ?></option>
                                <?php
                            }
                            else
                            {
                                ?>
                                <option value="<?php echo $donvi_row['id_donvi'] ?>"><?php echo $donvi_row['ten_donvi'] ?></option>
                                <?php
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Ảnh nền (PNG/JPG/JPEG):
                </h1>
                <input type="file" name="img_tour" class="input-df content__body-form-input">
            </div>
            <div class="form-input content__body-form">
                <h1 class="content__body-form-text">
                    Chi tiết tour (PDF):
                </h1>
                <input type="file" name="chitiet_tour" class="input-df content__body-form-input">
            </div>
            <input type="submit" name="suatour" value="Cập nhật"
                class="btn-m btn-main success-bg-txt content__body-btn"></input>
        </div>
    </div>
</form>
<?php
?>