<?php 
$donvi_select = "SELECT * FROM tbl_donvi";
$donvi_query = mysqli_query($mysqli, $donvi_select);

$diadiem_select = "SELECT DISTINCT diadiem_tourdulich FROM tbl_tourdulich ORDER BY diadiem_tourdulich";
$diadiem_query = mysqli_query($mysqli, $diadiem_select);

$tour_select = "SELECT * FROM tbl_tourdulich ORDER BY id_tourdulich DESC";
$tour_query = mysqli_query($mysqli, $tour_select);
?>


<!-- chi tiet tour -->
<form action="?quanly=tour&query=timkiem" method="POST">
    <div class="content__body__heading">
        <h1 class="content__body__heading-text">Danh sách các tour</h1>
        <div class="content__body__heading-gr">
            <h2 class="content__body__heading-gr-text">Thêm tour mới</h2>
            <a href="?quanly=tour&query=them" class="content__body__heading-link"><i
                    class="icon-m content__body__heading-link-btn ti-plus"></i></a>
            <a href="?" class="content__body__heading-link"><i
                    class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
        </div>
    </div>
    <div class="content__body__master">
        <div class="content__body-search">
            <div class="form-control">
                <input type="text" name="keyword" placeholder="Nhập tên tour..." class="form-control-input">
                <span class="form-control-label">Đơn vị:</span>
                <select name="donvi" class="form-control-select">
                    <option value="-1">------</option>
                    <option value="0">Tất cả</option>
                    <?php
                while($donvi_row = mysqli_fetch_array($donvi_query))
                {
                ?>
                    <option value="<?php echo $donvi_row['id_donvi']?>"><?php echo $donvi_row['ten_donvi']?></option>
                    <?php 
                } 
                ?>
                </select>

                <span class="form-control-label">Địa điểm:</span>
                <select name="diadiem" class="form-control-select">
                    <option value="0">Tất cả</option>
                    <?php
                while($diadiem_row = mysqli_fetch_array($diadiem_query))
                {
                ?>
                    <option value="<?php echo $diadiem_row['diadiem_tourdulich']?>"><?php echo $diadiem_row['diadiem_tourdulich']?>
                    </option>
                    <?php 
                } 
                ?>
                </select>

                <button type="submit" name="timkiem" class="form-control-btn"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </div>
    <div class="row content__body__master">
        <?php
                while($tour_row = mysqli_fetch_array($tour_query))
                {
                ?>
        <div class="col l-6 c-12">
            <a href="?quanly=tour&query=chitiet&idtour=<?php echo $tour_row['id_tourdulich'] ?>"
                class="a-defaul content__body-item">
                <img src="modules/container/quanly_tour/uploads/<?php echo $tour_row['img_tourdulich'] ?>" alt=""
                    class="content__body-item-img">
                <div class="content__body-item-group">
                    <h1 class="content__body-item-group-heading"><?php echo $tour_row['ten_tourdulich'] ?></h1>
                    <p class="content__body-item-group-desc"><?php echo $tour_row['mota_tourdulich'] ?></p>
                    <p class="content__body-item-group-text">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                        <span> Giá: <?php echo number_format($tour_row['gia_tourdulich'],0,',',',')?> đ</span>
                    </p>
                    <p class="content__body-item-group-text">
                        <i class="fa-solid fa-location-dot"></i>
                        <span> Địa điểm: <?php echo $tour_row['diadiem_tourdulich'] ?></span>
                    </p>
                    <p class="content__body-item-group-text">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span> Thời gian: <?php echo date("d/m/Y", strtotime($tour_row['ngaydi_tourdulich'])); ?> -
                            <?php echo date("d/m/Y", strtotime($tour_row['ngayve_tourdulich'])); ?></span>
                    </p>
                    <p class="content__body-item-group-text">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span> Đăng ký trước:
                            <?php echo date("d/m/Y", strtotime($tour_row['dangkytruoc_tourdulich'])); ?></span>
                    </p>
                    <p class="content__body-item-group-text">
                        <i class="fa-solid fa-ticket"></i>
                        <span> Số lượng đã đăng ký: <?php echo $tour_row['soluongdadangky_tourdulich'] ?></span>
                    </p>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</form>