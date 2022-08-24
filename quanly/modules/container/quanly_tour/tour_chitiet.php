<?php 
$idtour = $_GET['idtour'];
$tour_select = "SELECT * FROM tbl_tourdulich WHERE tbl_tourdulich.id_tourdulich = '".$idtour."'";
$tour_query = mysqli_query($mysqli, $tour_select);
$tour_row = mysqli_fetch_array($tour_query);
$iddv = $tour_row['donvi_tourdulich'];

$donvi_select = "SELECT * FROM tbl_donvi WHERE tbl_donvi.id_donvi = '".$iddv."'";
$donvi_query = mysqli_query($mysqli, $donvi_select);
$donvi_row = mysqli_fetch_array($donvi_query);

if(isset($_SESSION['tour_cant_delete'])){
    unset($_SESSION['tour_cant_delete']);
    echo '<script>window.alert("Tour đang xóa đã có người đăng kí, vui lòng kiểm tra lại!");</script>';
}
?>


<!-- chi tiet tour -->
<form action="">
    <div class="content__body__heading">
        <h1 class="content__body__heading-text">Chi tiết tour: <?php echo $tour_row['diadiem_tourdulich'] ?></h1>
        <div class="content__body__heading-gr">
            <a href="?quanly=tour&query=danhsach" class="content__body__heading-link"><i
                    class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
        </div>
    </div>
    <div class="row content__body__master">
        <div class="col l-12 c-12">
            <div class="row no-gutters content__body-detail">
                <div class="col l-12 c-12">
                    <div class="content__body-detail__group-btn">
                        <a href="modules/container/quanly_tour/tour_download_chitiet.php?namefile=<?php echo $tour_row['chitiet_tourdulich']?>"
                            class="content__body-detail__group-btn-l a-defaul">File chi tiết <i
                                class="fa-solid fa-cloud-arrow-down"></i></a>
                        <div class="content__body-detail__group-btn-r">
                            <a href="?quanly=tour&query=sua&idtour=<?php echo $idtour ?>"
                                class="content__body__heading-link"><i
                                    class="icon-m content__body__heading-link-btn ti-pencil"></i></a>
                            <a href="?quanly=tour&query=xoa&idtour=<?php echo $idtour ?>"
                                onclick="return confirm('Bạn chắc chắn muốn xóa? Dữ liệu sẽ không thể khôi phục.');"
                                class="content__body__heading-link"><i
                                    class="icon-m content__body__heading-link-btn ti-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters content__body-detail">
                <div class="col l-6 c-12">
                    <div class="content__body-detail__img">
                        <img src="modules/container/quanly_tour/uploads/<?php echo $tour_row['img_tourdulich'] ?>"
                            alt="" class="content__body-detail__img-item">
                    </div>
                </div>
                <div class="col l-6 c-12">
                    <div class="content__body-detail__info">
                        <h1 class="content__body-detail__info-heading"><?php echo $tour_row['ten_tourdulich'] ?></h1>
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
                        <p class="content__body-detail__group-text">
                            <i class="fa-solid fa-briefcase"></i>
                            <span>Tour cho đơn vị: <?php if($tour_row['donvi_tourdulich'] == 0)
                            {
                                echo "Tất cả";
                            }
                            else{
                                echo $donvi_row['ten_donvi'];
                            } ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row no-gutters content__body-detail">
                <div class="col l-12 c-12">
                    <div class="content__body-detail__desc">
                        <?php echo $tour_row['mota_tourdulich'] ?>
                    </div>
                </div>
                <div class="col l-12 c-12">
                    <div class="content__body-detail__content">
                        <?php echo $tour_row['noidung_tourdulich'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>