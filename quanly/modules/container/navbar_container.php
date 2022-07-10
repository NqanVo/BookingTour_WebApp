<?php 
$donvi_select = "SELECT * FROM tbl_donvi";
$donvi_query = mysqli_query($mysqli, $donvi_select);
?>

<div class="col l-2 c-0">
    <nav class="navbar">
        <a href="index.php" class="navbar__heading"><i class="fa-solid fa-house"></i> Dashboard</a>
        <ul class="navbar__list">
            <li class="navbar__list-item">
                <a href="?quanly=donvi&query=danhsach" class="navbar__list-item-link"><i class="ti-angle-right"></i> Viễn Thông Tiền Giang</a>
                <ul class="sub-navbar__list">
                    <?php 
                        while($donvi_row = mysqli_fetch_array($donvi_query))
                        {
                    ?>
                    <li class="sub-navbar__list-item">
                        <a href="?quanly=phongban&query=danhsach&iddv=<?php echo $donvi_row['id_donvi'] ?>"
                            class="sub-navbar__list-item-link"><?php echo $donvi_row['ten_donvi'] ?></a>
                    </li>
                    <?php 
                        }
                    ?>
                </ul>
            </li>
            <li class="navbar__list-item">
                <a href="?quanly=tour&query=danhsach" class="navbar__list-item-link"><i class="ti-angle-right"></i> Tour Du Lịch</a>
                <ul class="sub-navbar__list">
                    <li class="sub-navbar__list-item">
                        <a href="?quanly=tour&query=danhsach" class="sub-navbar__list-item-link">Danh sách Tour</a>
                    </li>
                    <li class="sub-navbar__list-item">
                        <a href="?quanly=tour&query=danhsachdangky" class="sub-navbar__list-item-link">Danh sách đăng ký
                            Tour</a>
                    </li>
                    <li class="sub-navbar__list-item">
                        <a href="?quanly=tour&query=them" class="sub-navbar__list-item-link">Thêm Tour</a>
                    </li>
                </ul>
            </li>
            <li class="navbar__list-item">
                <a href="?quanly=hotrokinhphi&query=danhsach" class="navbar__list-item-link"><i class="ti-angle-right"></i> Hổ Trợ Kinh Phí</a>
            </li>
        </ul>
    </nav>
</div>








<!-- <ul class="sub2-navbar__list">
                            <li class="sub2-navbar__list-item">
                                <a href="" class="sub2-navbar__list-item-link">Phòng Nghiên Cứu Và Phát Triển</a>
                                <ul class="sub3-navbar__list">
                                    <li class="sub3-navbar__list-item">
                                        <a href="" class="sub3-navbar__list-item-link">Trần Văn A</a>
                                    </li>
                                    <li class="sub3-navbar__list-item">
                                        <a href="" class="sub3-navbar__list-item-link">Trần Văn A</a>
                                    </li>
                                    <li class="sub3-navbar__list-item">
                                        <a href="" class="sub3-navbar__list-item-link">Trần Văn A</a>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </li> -->