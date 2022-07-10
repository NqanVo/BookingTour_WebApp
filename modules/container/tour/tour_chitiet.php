<?php
    $idtour = $_GET['idtour'];
    $tour_chitiet_select = "SELECT * FROM tbl_tourdulich WHERE tbl_tourdulich.id_tourdulich = '".$idtour."'";
    $tour_chitiet_query = mysqli_query($mysqli,$tour_chitiet_select);
    $tour_chitiet_row = mysqli_fetch_array($tour_chitiet_query);

    $iddv_tour = $tour_chitiet_row['donvi_tourdulich'];
    $tour_donvi_query = mysqli_query($mysqli,"SELECT * FROM tbl_donvi WHERE tbl_donvi.id_donvi = '".$iddv_tour."'");
    $tour_donvi_row = mysqli_fetch_array($tour_donvi_query);

    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    if(isset($_SESSION['khongcungdonvi'])){
        unset($_SESSION['khongcungdonvi']);
        echo '<script>window.alert("Tour này không thuộc đơn vị bạn!");</script>';
    }
    
?>


<!-- chi tiet tour  -->
<div class="grid wide">
    <div class="container-detail">
        <div class="row">
            <div class="col l-6 c-6">
                <a href="?select=tour&query=danhsach" class="btn-s btn-main container-detail-btn-back"><i
                        class="ti-back-left"></i></a>
            </div>
            <div class="col l-6 c-6 right">
                <p>Chi tiết tour</p>
                <a href="quanly/modules/container/quanly_tour/tour_download_chitiet.php?namefile=<?php echo $tour_chitiet_row['chitiet_tourdulich']?>"
                    class="btn-s btn-main container-detail-btn-back"><i class="ti-download"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col l-6 c-12">
                <div class="container-detail-heading">
                    <img src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_chitiet_row['img_tourdulich'] ?>"
                        alt="" class="container-detail-heading-img">
                </div>
            </div>
            <div class="col l-6 c-12">
                <div class="container-detail-heading">
                    <h3 class="container-detail-heading-title"><?php echo $tour_chitiet_row['ten_tourdulich'] ?></h3>
                    <div class="container-detail-heading-group">
                        <p class="container-detail-heading-group-text">Giá:
                            <?php echo number_format($tour_chitiet_row['gia_tourdulich'],0,',',',')?> đ</p>
                        <p class="container-detail-heading-group-text">Địa điểm:
                            <?php echo $tour_chitiet_row['diadiem_tourdulich'] ?></p>
                        <p class="container-detail-heading-group-text">Thời Gian:
                            <?php echo date("d/m/Y", strtotime($tour_chitiet_row['ngaydi_tourdulich'])); ?> -
                            <?php echo date("d/m/Y", strtotime($tour_chitiet_row['ngayve_tourdulich'])); ?></p>
                        <p class="container-detail-heading-group-text">Đăng ký trước:
                            <?php echo date("d/m/Y", strtotime($tour_chitiet_row['dangkytruoc_tourdulich'])); ?></p>
                        <p class="content__tour-item-group-text">Đã đăng ký:
                            <?php echo $tour_chitiet_row['soluongdadangky_tourdulich'] ?> /
                            <?php echo $tour_chitiet_row['soluongtoida_tourdulich'] ?>
                        <p class="container-detail-heading-group-text">Tour đơn vị:
                            <?php if($iddv_tour == 0){echo 'Tất cả';} else {echo $tour_donvi_row['ten_donvi'];} ?></p>
                    </div>
                    <div class="row">
                        <div class="col l-4 c-4">
                            <img src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_chitiet_row['img_tourdulich'] ?>"
                                class="container-detail-heading-img-mini">
                        </div>
                        <div class="col l-4 c-4">
                            <img src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_chitiet_row['img_tourdulich'] ?>"
                                class="container-detail-heading-img-mini">
                        </div>
                        <div class="col l-4 c-4">
                            <img src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_chitiet_row['img_tourdulich'] ?>"
                                class="container-detail-heading-img-mini">
                        </div>
                    </div>
                    <?php 
                        if(isset($_SESSION['user_login']))
                        {
                            if(strtotime($tour_chitiet_row['dangkytruoc_tourdulich']) < strtotime($today) || $tour_chitiet_row['soluongdadangky_tourdulich'] == $tour_chitiet_row['soluongtoida_tourdulich'] )
                            {
                                ?>
                    <a href="modules/container/tour/tour_dattour_xuly.php?dat_tour=1&idtour=<?php echo $tour_chitiet_row['id_tourdulich'] ?>"
                        class="btn-m btn-main disabled-btn">Đặt Tour Ngay</a>

                    <?php
                            }
                            else
                            {
                                ?>
                    <a href="modules/container/tour/tour_dattour_xuly.php?dat_tour=1&idtour=<?php echo $tour_chitiet_row['id_tourdulich'] ?>"
                        class="btn-m btn-main">Đặt Tour Ngay</a>

                    <?php
                            }
                        }
                        else
                        {
                            ?>
                    <a href="?select=dangnhap&query=1" class="btn-m btn-main">Đăng
                        nhập</a>
                    <?php
                        }
                        ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l-12 c-12">
                <div class="container-detail-desc">
                    <p><?php echo $tour_chitiet_row['mota_tourdulich'] ?></p>
                </div>
            </div>
            <div class="col l-12 c-12">
                <div class="container-detail-box-img">
                    <img src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_chitiet_row['img_tourdulich'] ?>"
                        alt="" class="container-detail-img">
                </div>
            </div>
            <div class="col l-12 c-12">
                <div class="container-detail-content">
                    <p><?php echo $tour_chitiet_row['noidung_tourdulich'] ?></p>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
$(document).ready(function() {
    $('#dattour_ngay').on('click', function() {
        var dattour_ngay = "dattour_ngay";
        var idtour = "<?php echo $tour_chitiet_row['id_tourdulich'] ?>";
        var idnv = "<?php echo $idnv ?>";
        var tienhotro = "<?php echo $tien_hotro?>";
        $.ajax({
            url: "modules/container/tour/tour_dattour_xuly.php",
            method: "POST",
            data: {
                dattour_ngay: dattour_ngay,
                idtour_ajax: idtour,
                idnv_ajax: idnv,
                tienhotro_ajax: tienhotro,
            },
            success: function(data) {
                
            }
        });
    });
})
</script> -->