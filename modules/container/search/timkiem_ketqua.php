<?php

 use Carbon\Carbon;
 use Carbon\CarbonInterval;
 $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

 if(isset($_POST['timkiem']))
{
    $keyword = $_POST['keyword'];
    $donvi = $_POST['donvi'];
    $diadiem = $_POST['diadiem'];
    if($donvi == -1){
        $donvi_view = "";
    }
    elseif($donvi == 0){
        $donvi_view = "Đơn vị: Tất cả";
    }
    else{
        $select_tendonvi_row = mysqli_fetch_array(mysqli_query($mysqli,"SELECT * FROM tbl_donvi WHERE id_donvi = '".$donvi."'"));
        $donvi_view = "Đơn vị: ".$select_tendonvi_row['ten_donvi'];
    }

    if($diadiem === '0'){
        $diadiem_view = "Địa điểm: Tất cả";
    }
    else
    {
        $diadiem_view = "Địa điểm: ".$diadiem;
    }

?>

<div class="grid wide">
    <div class="container">
        <section class="container__content">
            <div class="row">
                <div class="col l-12 c-12">
                    <div class="content__label non-backgroud">
                        <a href="?select=tour&query=danhsach" class="btn-s btn-main"><i class="ti-back-left"></i></a>
                    </div>
                </div>
                <div class="col l-12 c-12">
                    <div class="content__label">
                        <h3 class="content__label-heading" style="display:flex; align-item: center; gap:10px">Tìm kiếm: <?php echo $keyword?>. <?php echo $donvi_view?>. <?php echo $diadiem_view?>  <i class="fa-solid fa-magnifying-glass"></i></h3>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
                if($keyword == '' && $donvi == '-1' && $diadiem == '0')
                {
                    $tour_select = "SELECT * FROM tbl_tourdulich ORDER BY id_tourdulich DESC";
                    $tour_query = mysqli_query($mysqli, $tour_select);
                    $count = mysqli_num_rows($tour_query);
                    if($count == 0)
                    {
                    ?>
                        <div class="col l-12 c-12">
                        <div class="notification-form">
                            <h1 class="notification-form-heading">Không tìm thấy thông tin phù hợp!</h1>
                            <h1 class="notification-form-icon"><i class="ti-face-sad"></i></h1>
                            <div class="notification-form-bg">

                                <img src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1656654506~exp=1656655106~hmac=493adf1790ef4d0ae14053a5f1464d1ca442d50b678dcbdcb633c4bf2eb3b904&w=1380"></img>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php 
                        while($tour_moi_row = mysqli_fetch_array($tour_query))
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
                                    
                                    <img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                            else
                            {
                                ?>
                    <div class="col l-4 c-12">
                        <div class="content__tour">
                            <div class="content__tour-item">
                                <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                    class="content__tour-item-link"><img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                }
                elseif($keyword == '' && $donvi == '-1' && $diadiem != '0')
                {
                    $tour_select = "SELECT * FROM tbl_tourdulich WHERE diadiem_tourdulich = '".$diadiem."' ORDER BY id_tourdulich DESC";
                    $tour_query = mysqli_query($mysqli, $tour_select);
                    $count = mysqli_num_rows($tour_query);
                    if($count == 0)
                    {
                    ?>
                        <div class="col l-12 c-12">
                        <div class="notification-form">
                            <h1 class="notification-form-heading">Không tìm thấy thông tin phù hợp!</h1>
                            <h1 class="notification-form-icon"><i class="ti-face-sad"></i></h1>
                            <div class="notification-form-bg">

                                <img src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1656654506~exp=1656655106~hmac=493adf1790ef4d0ae14053a5f1464d1ca442d50b678dcbdcb633c4bf2eb3b904&w=1380"></img>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php 
                        while($tour_moi_row = mysqli_fetch_array($tour_query))
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
                                    
                                    <img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                            else
                            {
                                ?>
                    <div class="col l-4 c-12">
                        <div class="content__tour">
                            <div class="content__tour-item">
                                <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                    class="content__tour-item-link"><img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                }
                elseif($keyword == '' && $donvi != '-1' && $diadiem == '0')
                {
                    $tour_select = "SELECT * FROM tbl_tourdulich WHERE donvi_tourdulich = '".$donvi."' ORDER BY id_tourdulich DESC";
                    $tour_query = mysqli_query($mysqli, $tour_select);
                    $count = mysqli_num_rows($tour_query);
                    if($count == 0)
                    {
                    ?>
                        <div class="col l-12 c-12">
                        <div class="notification-form">
                            <h1 class="notification-form-heading">Không tìm thấy thông tin phù hợp!</h1>
                            <h1 class="notification-form-icon"><i class="ti-face-sad"></i></h1>
                            <div class="notification-form-bg">

                                <img src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1656654506~exp=1656655106~hmac=493adf1790ef4d0ae14053a5f1464d1ca442d50b678dcbdcb633c4bf2eb3b904&w=1380"></img>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php 
                        while($tour_moi_row = mysqli_fetch_array($tour_query))
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
                                    
                                    <img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                            else
                            {
                                ?>
                    <div class="col l-4 c-12">
                        <div class="content__tour">
                            <div class="content__tour-item">
                                <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                    class="content__tour-item-link"><img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                }
                elseif($keyword == '' && $donvi != '-1' && $diadiem != '0')
                {
                    $tour_select = "SELECT * FROM tbl_tourdulich WHERE donvi_tourdulich = '".$donvi."' AND diadiem_tourdulich = '".$diadiem."' ORDER BY id_tourdulich DESC";
                    $tour_query = mysqli_query($mysqli, $tour_select);
                    $count = mysqli_num_rows($tour_query);
                    if($count == 0)
                    {
                    ?>
                        <div class="col l-12 c-12">
                        <div class="notification-form">
                            <h1 class="notification-form-heading">Không tìm thấy thông tin phù hợp!</h1>
                            <h1 class="notification-form-icon"><i class="ti-face-sad"></i></h1>
                            <div class="notification-form-bg">

                                <img src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1656654506~exp=1656655106~hmac=493adf1790ef4d0ae14053a5f1464d1ca442d50b678dcbdcb633c4bf2eb3b904&w=1380"></img>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php 
                        while($tour_moi_row = mysqli_fetch_array($tour_query))
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
                                    
                                    <img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                            else
                            {
                                ?>
                    <div class="col l-4 c-12">
                        <div class="content__tour">
                            <div class="content__tour-item">
                                <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                    class="content__tour-item-link"><img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                }
                elseif($keyword != '' && $donvi == '-1' && $diadiem == '0')
                {
                    $tour_select = "SELECT * FROM tbl_tourdulich WHERE ten_tourdulich LIKE '%".$keyword."%' ORDER BY id_tourdulich DESC";
                    $tour_query = mysqli_query($mysqli, $tour_select);
                    $count = mysqli_num_rows($tour_query);
                    if($count == 0)
                    {
                    ?>
                        <div class="col l-12 c-12">
                        <div class="notification-form">
                            <h1 class="notification-form-heading">Không tìm thấy thông tin phù hợp!</h1>
                            <h1 class="notification-form-icon"><i class="ti-face-sad"></i></h1>
                            <div class="notification-form-bg">

                                <img src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1656654506~exp=1656655106~hmac=493adf1790ef4d0ae14053a5f1464d1ca442d50b678dcbdcb633c4bf2eb3b904&w=1380"></img>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php 
                        while($tour_moi_row = mysqli_fetch_array($tour_query))
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
                                    
                                    <img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                            else
                            {
                                ?>
                    <div class="col l-4 c-12">
                        <div class="content__tour">
                            <div class="content__tour-item">
                                <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                    class="content__tour-item-link"><img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                }
                elseif($keyword != '' && $donvi != '-1' && $diadiem == '0')
                {
                    $tour_select = "SELECT * FROM tbl_tourdulich WHERE donvi_tourdulich = '".$donvi."' AND ten_tourdulich LIKE '%".$keyword."%' ORDER BY id_tourdulich DESC";
                    $tour_query = mysqli_query($mysqli, $tour_select);
                    $count = mysqli_num_rows($tour_query);
                    if($count == 0)
                    {
                    ?>
                        <div class="col l-12 c-12">
                        <div class="notification-form">
                            <h1 class="notification-form-heading">Không tìm thấy thông tin phù hợp!</h1>
                            <h1 class="notification-form-icon"><i class="ti-face-sad"></i></h1>
                            <div class="notification-form-bg">

                                <img src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1656654506~exp=1656655106~hmac=493adf1790ef4d0ae14053a5f1464d1ca442d50b678dcbdcb633c4bf2eb3b904&w=1380"></img>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php 
                        while($tour_moi_row = mysqli_fetch_array($tour_query))
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
                                    
                                    <img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                            else
                            {
                                ?>
                    <div class="col l-4 c-12">
                        <div class="content__tour">
                            <div class="content__tour-item">
                                <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                    class="content__tour-item-link"><img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                }
                elseif($keyword != '' && $donvi == '-1' && $diadiem != '0')
                {
                    $tour_select = "SELECT * FROM tbl_tourdulich WHERE donvi_tourdulich = '".$donvi."' AND diadiem_tourdulich = '".$diadiem."' AND ten_tourdulich LIKE '%".$keyword."%' ORDER BY id_tourdulich DESC";
                    $tour_query = mysqli_query($mysqli, $tour_select);
                    $count = mysqli_num_rows($tour_query);
                    if($count == 0)
                    {
                    ?>
                        <div class="col l-12 c-12">
                        <div class="notification-form">
                            <h1 class="notification-form-heading">Không tìm thấy thông tin phù hợp!</h1>
                            <h1 class="notification-form-icon"><i class="ti-face-sad"></i></h1>
                            <div class="notification-form-bg">

                                <img src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1656654506~exp=1656655106~hmac=493adf1790ef4d0ae14053a5f1464d1ca442d50b678dcbdcb633c4bf2eb3b904&w=1380"></img>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php 
                        while($tour_moi_row = mysqli_fetch_array($tour_query))
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
                                    
                                    <img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                            else
                            {
                                ?>
                    <div class="col l-4 c-12">
                        <div class="content__tour">
                            <div class="content__tour-item">
                                <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                    class="content__tour-item-link"><img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                }
                elseif($keyword != '' && $donvi == '-1' && $diadiem != '0')
                {
                    $tour_select = "SELECT * FROM tbl_tourdulich WHERE diadiem_tourdulich = '".$diadiem."' AND ten_tourdulich LIKE '%".$keyword."%' ORDER BY id_tourdulich DESC";
                    $tour_query = mysqli_query($mysqli, $tour_select);
                    $count = mysqli_num_rows($tour_query);
                    if($count == 0)
                    {
                    ?>
                        <div class="col l-12 c-12">
                        <div class="notification-form">
                            <h1 class="notification-form-heading">Không tìm thấy thông tin phù hợp!</h1>
                            <h1 class="notification-form-icon"><i class="ti-face-sad"></i></h1>
                            <div class="notification-form-bg">

                                <img src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1656654506~exp=1656655106~hmac=493adf1790ef4d0ae14053a5f1464d1ca442d50b678dcbdcb633c4bf2eb3b904&w=1380"></img>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    <?php 
                        while($tour_moi_row = mysqli_fetch_array($tour_query))
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
                                    
                                    <img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                            else
                            {
                                ?>
                    <div class="col l-4 c-12">
                        <div class="content__tour">
                            <div class="content__tour-item">
                                <a href="?select=tour&query=chitiet&idtour=<?php echo $tour_moi_row['id_tourdulich'] ?>"
                                    class="content__tour-item-link"><img
                                        src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_moi_row['img_tourdulich'] ?>"
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
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngaydi_tourdulich'])); ?> -
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['ngayve_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đăng ký trước:
                                        <?php echo date("d/m/Y", strtotime($tour_moi_row['dangkytruoc_tourdulich'])); ?>
                                    </p>
                                    <p class="content__tour-item-group-text">Đã đăng ký:
                                        <?php echo $tour_moi_row['soluongdadangky_tourdulich'] ?>
                                        
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
                }
                else{
                    ?>
                    <div class="col l-12 c-12">
                        <div class="notification-form">
                            <h1 class="notification-form-heading">Không tìm thấy thông tin phù hợp!</h1>
                            <h1 class="notification-form-icon"><i class="ti-face-sad"></i></h1>
                            <div class="notification-form-bg">

                                <img src="https://img.freepik.com/free-vector/business-team-looking-new-people-allegory-searching-ideas-staff-woman-with-magnifier-man-with-spyglass-flat-illustration_74855-18236.jpg?t=st=1656654506~exp=1656655106~hmac=493adf1790ef4d0ae14053a5f1464d1ca442d50b678dcbdcb633c4bf2eb3b904&w=1380"></img>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
            </div>
        </section>
    </div>
</div>
<?php
}
?>