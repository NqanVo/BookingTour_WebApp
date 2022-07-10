<?php
 $tour_moi_select = "SELECT * FROM tbl_tourdulich ORDER BY id_tourdulich DESC";
 $tour_moi_query = mysqli_query($mysqli, $tour_moi_select);

 use Carbon\Carbon;
use Carbon\CarbonInterval;
$today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

?>
<div class="grid wide">
    <div class="container">
        <section class="container__content">
            <div class="row">
                <div class="col l-12 c-12">
                    <div class="content__label non-backgroud">
                        <a href="?" class="btn-s btn-main"><i class="ti-back-left"></i></a>
                    </div>
                </div>
                <div class="col l-12 c-12">
                    <div class="content__label">
                        <h3 class="content__label-heading">Danh sách các tour: <i class="fa-brands fa-hotjar"></i></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
                    while($tour_moi_row = mysqli_fetch_array($tour_moi_query))
                    {
                        if(isset($_SESSION['user_login']))
                        {
                    ?>
                <div class="col l-4 c-12">
                    <div class="content__tour">
                        <div class="content__tour-item">

                            <?php
                                if(strtotime($tour_moi_row['dangkytruoc_tourdulich']) >= strtotime($today))
                                {
                                    if($tour_moi_row['soluongdadangky_tourdulich'] == $tour_moi_row['soluongtoida_tourdulich'])
                                    {
                                    ?>
                            <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                class="content__tour-item-link full-ve">
                                <?php
                                    }
                                    else
                                    {
                                    ?>
                                <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                    class="content__tour-item-link">
                                    <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                        class="content__tour-item-link het-han">
                                        <?php
                                }
                            ?>

                                        <img src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
                                            class="content__tour-item-img"></img></a>
                                    <?php 
                                        if(isset($_SESSION['user_login']))
                                        {
                                            $check_tour_like_count = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM tbl_tourdulich_liked WHERE id_nhanvien = '".$idnv."' AND id_tourdulich = '".$tour_moi_row['id_tourdulich']."'"));
                                            if($check_tour_like_count > 0){
                                                ?><div class="content__tour-item-like liked"><a href="modules/container/tour/tour_like_xuly.php?select=unlike&idtour=<?php echo $tour_moi_row['id_tourdulich']?>"><i class="fa-solid fa-heart"></i></a></div><?php
                                            }
                                            else{
                                                ?><div class="content__tour-item-like"><a href="modules/container/tour/tour_like_xuly.php?select=like&idtour=<?php echo $tour_moi_row['id_tourdulich']?>"><i class="fa-solid fa-heart"></i></a></div><?php
                                            }
                                        ?>
                                        <?php
                                        }
                                    ?>
                                    <div class="content__tour-item-group">
                                        <h3 class="content__tour-item-heading">
                                            <?php echo $tour_moi_row['ten_tourdulich'] ?></h3>
                                        <p class="content__tour-item-group-text">Giá:
                                            <?php echo number_format($tour_moi_row['gia_tourdulich'],0,',',',')?> đ</p>
                                        <p class="content__tour-item-group-text">Địa điểm:
                                            <?php echo $tour_moi_row['diadiem_tourdulich'] ?></p>
                                        <p class="content__tour-item-group-text">Thời gian:
                                            <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?>
                                            -
                                            <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                        </p>
                                        <p class="content__tour-item-group-text">Đăng ký trước:
                                            <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                        </p>
                                        <p class="content__tour-item-group-text">Đã đăng ký:
                                            <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?> /
                                            <?php echo $tour_moi_row['soluongtoida_tourdulich'] ?>
                                        <div class="content__tour-item-group-btn">
                                            <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                                class="btn-s content__tour-item-group-btn-link">Xem chi tiết</a>
                                            <a href="modules/container/tour/tour_dattour_xuly.php?dat_tour=1&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                                class="btn-s btn-main content__tour-item-group-btn-link">Đặt Tour</a>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                        else{
                            ?>
                <div class="col l-4 c-12">
                    <div class="content__tour">
                        <div class="content__tour-item">
                            <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                class="content__tour-item-link"><img
                                    src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
                                    class="content__tour-item-img"></img></a>
                            <div class="content__tour-item-group">
                                <h3 class="content__tour-item-heading">
                                    <?php echo $tour_moi_row['ten_tourdulich'] ?></h3>
                                <p class="content__tour-item-group-text">Giá:
                                    <?php echo number_format($tour_moi_row['gia_tourdulich'],0,',',',')?> đ</p>
                                <p class="content__tour-item-group-text">Địa điểm:
                                    <?php echo $tour_moi_row['diadiem_tourdulich'] ?></p>
                                <p class="content__tour-item-group-text">Thời gian:
                                    <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                    <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                </p>
                                <p class="content__tour-item-group-text">Đăng ký trước:
                                    <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                </p>
                                <p class="content__tour-item-group-text">Đã đăng ký:
                                    <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?> /
                                    <?php echo $tour_moi_row['soluongtoida_tourdulich'] ?>
                                <div class="content__tour-item-group-btn">
                                    <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                        class="btn-s content__tour-item-group-btn-link">Xem chi tiết</a>
                                    <a href="?select=dangnhap&query=1"
                                        class="btn-s btn-main content__tour-item-group-btn-link">Đăng nhập</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                    ?>
            </div>
        </section>
    </div>
</div>