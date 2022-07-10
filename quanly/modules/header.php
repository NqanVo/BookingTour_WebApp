<?php
    $select_donvi = false;
    $select_dktour = false;
    $select_tour = false;
    $select_support = false;
    if(isset($_GET['quanly'])){
        $quanly = $_GET['quanly'];
        $query = $_GET['query'];

        if(($quanly == 'donvi') || ($quanly == 'phongban') || ($quanly == 'nhanvien')){ $select_donvi = true;}
        if(($query == 'danhsachdangky') || ($query == 'danhsachdangky_chitiet') || ($query == 'danhsachdangky_chitiet_nguoithan')){ $select_dktour = true;}
        if(($quanly == 'tour' && $query == 'danhsach') || ($quanly == 'tour' && $query == 'chitiet') || ($quanly == 'tour' && $query == 'sua')){ $select_tour = true;}
        if(($quanly == 'hotrokinhphi')){ $select_support = true;}
    }
?>


<header class="header">
    <ul class="header__list">
        <li class="header__list-item">
            <a href="../index.php" class="header__list-item-link"><i class="ti-world"></i> Website</a>
        </li>
    </ul>

    <ul class="header__list">
        <!-- <li class="header__list-item">
            <a href="" class="header__list-item-link"><i class="fa-solid fa-bell"></i></a>
        </li> -->
        <li class="header__list-item">
            <p class="header__list-item-link"><i class="ti-settings"></i></p>
            <ul class="header__sub-list">
                <li class="header__sub-list-item">
                    <a href="?quanly=nhanvien&query=chitiet&iddv=<?php echo $id_dv ?>&idpb=<?php echo $id_pb?>&idnv=<?php echo $id_nv?>" class="header__sub-list-item-link"><i class="fa-solid fa-user"></i> Thông tin</a>
                </li>
                <li class="header__sub-list-item">
                    <a href="?quanly=dangxuat&query=1" class="header__sub-list-item-link"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất</a>
                </li>
            </ul>
        </li>
    </ul>
</header>


<header class="header-mb">
    <ul class="header__list">
        <li class="header__list-item">
            <a href="../index.php" class="header__list-item-link"><i class="ti-world"></i></a>
        </li>
        <li class="header__list-item">
            <a href="?quanly=donvi&query=danhsach" class="header__list-item-link <?php if($select_donvi){ echo 'header__list-item-link-selected';}?> "><i class="fa-solid fa-briefcase"></i></i></a>
        </li>
        <li class="header__list-item">
            <a href="?quanly=tour&query=danhsach" class="header__list-item-link <?php if($select_tour){ echo 'header__list-item-link-selected';}?>"><i class="fa-solid fa-plane-departure"></i></a>
        </li>
        <li class="header__list-item">
            <a href="?quanly=tour&query=danhsachdangky" class="header__list-item-link <?php if($select_dktour){ echo 'header__list-item-link-selected';}?> "><i class="fa-solid fa-ticket"></i></a>
        </li>
        <li class="header__list-item">
            <a href="?quanly=hotrokinhphi&query=danhsach" class="header__list-item-link <?php if($select_support){ echo 'header__list-item-link-selected';}?>"><i class="fa-solid fa-dollar-sign"></i></a>
        </li>
    </ul>

    <ul class="header__list">
        <li class="header__list-item">
            <p class="header__list-item-link"><i class="ti-settings"></i></p>
            <ul class="header__sub-list">
                <li class="header__sub-list-item">
                    <a href="?quanly=nhanvien&query=chitiet&iddv=<?php echo $id_dv ?>&idpb=<?php echo $id_pb?>&idnv=<?php echo $id_nv?>" class="header__sub-list-item-link"><i class="fa-solid fa-user"></i> Thông tin</a>
                </li>
                <li class="header__sub-list-item">
                    <a href="?quanly=dangxuat&query=1" class="header__sub-list-item-link"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất</a>
                </li>
            </ul>
        </li>
    </ul>
</header>