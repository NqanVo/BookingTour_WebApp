<?php
    $select_index = false;
    $select_tour = false;
    $select_cart = false;
    $select_info = false;
    $select_dktour= false;
    if(isset($_GET['select'])){
        $select = $_GET['select'];
        $query = $_GET['query'];

        if(($select == 'tour' && $query == 'danhsach') || ($select == 'tour' && $query == 'chitiet') || ($select == 'tour' && $query == 'donviall') || ($select == 'tour' && $query == 'moiall') || ($select == 'tour' && $query == 'timkiem')){ $select_tour = true;}
        if(($query == 'dattour') || ($query == 'thanhtoan') || ($query == 'hoanthanh')){ $select_cart = true;}
        if(($select == 'user')){ $select_info = true;}
        if(($query == 'lichsu') || ($query == 'lichsu_chitiet') || ($query == 'lichsu_chitiet_capnhat') || ($query == 'lichsu_chitiet_themve')){ $select_dktour = true;}
        // if(($select == 'donvi') || ($select == 'phongban') || ($select == 'nhanvien')){ $select_donvi = true;}
    }
    else{
        $select_index = true;
    }
?>



<!-- header  -->
<header class="header">
    <ul class="header__list">
        <li class="header__list-item">
            <a href="index.php" class="header__list-item-link">Trang chủ</a>
        </li>
        <li class="header__list-item">
            <a href="?select=tour&query=danhsach" class="header__list-item-link">Danh sách tour</a>
        </li>
        <li class="header__list-item">
            <a href="quanly/modules/container/quanly_hdsd/hdsd_download.php?hdsd=1" class="header__list-item-link">Hướng dẫn sử dụng <i class="ti-download"></i></a>
        </li>
    </ul>
    <ul class="header__list">
        <?php 
            if(isset($_SESSION['user_login']))
            {
        ?>
        <li class="header__list-item"><a href="?select=tour&query=likedall" class="header__list-item-link">Yêu thích <i
                    class="fa-solid fa-heart"></i></a></li>
        <li class="header__list-item"><a href="?select=tour&query=dattour" class="header__list-item-link">Giỏ hàng <i
                    class="fa-solid fa-cart-shopping"></i></a></li>
        <?php
            }
            ?>

        <li class="header__list-item">
            <?php 
                if(isset($_SESSION['user_login'])){
                    ?>
            <div class="header__list-item-link">Thông tin <i class="fa-solid fa-caret-down"></i></div>
            <ul class="header__sub-list">
                <li class="header__sub-list-item">
                    <a href="?select=user&query=chitiet" class="a-defaul header__sub-list-item-link"><i
                            class="fa-solid fa-user"></i> Tài khoản</a>
                </li>
                <li class="header__sub-list-item">
                    <a href="?select=tour&query=lichsu" class="a-defaul header__sub-list-item-link"><i
                            class="fa-solid fa-clock-rotate-left"></i> Lịch sử Tour</a>
                </li>
                <?php
                    if($chucvu == 0){ echo '<li class="header__sub-list-item">
                        <a href="./quanly" target="_blank" class="a-defaul header__sub-list-item-link"><i
                                class="fa-solid fa-house-user"></i> Đến trang Admin</a>
                    </li>';}
                ?>
                <li class="header__sub-list-item">
                    <a href="?select=dangxuat&query=1" class="a-defaul header__sub-list-item-link"><i
                            class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất</a>
                </li>
            </ul>
            <?php
                }
                else{
                    ?>
            <a href="?select=dangnhap&query=1" class="header__list-item-link">Đăng nhập <i
                    class="fa-solid fa-arrow-right-to-bracket"></i></a>
            <?php
                
                }
            ?>
        </li>
    </ul>
</header>
<div class="fake-header"></div>


<!-- header mobile -->
<header class="header-mb">
    <ul class="header__list header__list-mobile">
        <?php 
            if(isset($_SESSION['user_login']))
            {
        ?>
        <li class="header__list-item header__list-item-mobile">
            <a href="index.php" class="header__list-item-link <?php if($select_index){ echo 'header__list-item-link-selected';}?> "><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="header__list-item header__list-item-mobile">
            <a href="?select=tour&query=danhsach" class="header__list-item-link <?php if($select_tour){ echo 'header__list-item-link-selected';}?>"><i
                    class="fa-solid fa-plane-departure"></i></a>
        </li>
        <li class="header__list-item header__list-item-mobile">
            <a href="?select=tour&query=dattour" class="header__list-item-link <?php if($select_cart){ echo 'header__list-item-link-selected';}?>"><i
                    class="fa-solid fa-cart-shopping"></i></a>
        </li>
        <li class="header__list-item header__list-item-mobile">
            <a href="?select=user&query=chitiet" class="header__list-item-link <?php if($select_info){ echo 'header__list-item-link-selected';}?>"><i class="fa-solid fa-user"></i></a>
        </li>
        <li class="header__list-item header__list-item-mobile">
            <a href="?select=tour&query=lichsu" class="header__list-item-link <?php if($select_dktour){ echo 'header__list-item-link-selected';}?>"><i
                    class="fa-solid fa-clock-rotate-left"></i></a>
        </li>
        <?php
            }
            else{
        ?>
        <li class="header__list-item header__list-item-mobile">
            <a href="index.php" class="header__list-item-link"><i class="fa-solid fa-house"></i></a>
        </li>
        <li class="header__list-item header__list-item-mobile">
            <a href="?select=tour&query=danhsach" class="header__list-item-link"><i
                    class="fa-solid fa-plane-departure"></i></a>
        </li>
        <li class="header__list-item header__list-item-mobile">
            <a href="?select=dangnhap&query=1" class="header__list-item-link"><i
                    class="fa-solid fa-arrow-right-to-bracket"></i></a>
        </li>
        <?php
            }
            ?>
    </ul>
</header>