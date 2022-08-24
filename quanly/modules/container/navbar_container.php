<?php 
$donvi_select = "SELECT * FROM tbl_donvi";
$donvi_query = mysqli_query($mysqli, $donvi_select);
use Carbon\Carbon;
use Carbon\CarbonInterval;
$now_year = Carbon::now()->year;

//lấy kỳ hỗ trợ hiện hành
$hotro_kinhphi_query = mysqli_query($mysqli,"SELECT * FROM tbl_hotro_kinhphi WHERE tunam_hotro_kinhphi <= '".$now_year."' AND dennam_hotro_kinhphi > '".$now_year."' AND status_hotro_kinhphi = '1'");
$hotro_kinhphi_count = mysqli_num_rows($hotro_kinhphi_query);
if($hotro_kinhphi_count >0)
{
    $hotro_kinhphi_row = mysqli_fetch_array($hotro_kinhphi_query);
    $idhotro = $hotro_kinhphi_row['id_hotro_kinhphi'];
    $giaidoan = $hotro_kinhphi_row['tunam_hotro_kinhphi']." - ".$hotro_kinhphi_row['dennam_hotro_kinhphi'];
}
else{
    $hotro_kinhphi_row['tunam_hotro_kinhphi'] = '0000';
    $hotro_kinhphi_row['dennam_hotro_kinhphi'] = '0000';
    $idhotro = '0';
}
?>

<div class="col l-2 c-0">
    <nav class="navbar">
        <a href="index.php" class="navbar__heading"><i class="fa-solid fa-house"></i> Dashboard</a>
        <ul class="navbar__list">
            <li class="navbar__list-item">
                <a href="?quanly=donvi&query=danhsach" class="navbar__list-item-link"><i class="ti-control-record"
                        style="visibility: hidden"></i> Viễn Thông Tiền Giang</a>
            </li>
            <li class="navbar__list-item">
                <a href="?quanly=tour&query=danhsach" class="navbar__list-item-link"><i class="ti-angle-down"></i> Tour
                    Du Lịch</a>
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
                <a href="?quanly=hotrokinhphi&query=danhsach" class="navbar__list-item-link"><i
                        class="ti-angle-down"></i> Hổ Trợ Kinh Phí</a>
                <?php if($idhotro != 0)
                {?>
                <ul class="sub-navbar__list">
                    <li class="sub-navbar__list-item">
                        <a href="?quanly=hotrokinhphi&query=danhsach&idhotro=<?php echo $idhotro ?>"
                            class="sub-navbar__list-item-link">Giai đoạn <?php echo $giaidoan ?></a>
                    </li>
                    <li class="sub-navbar__list-item">
                        <a href="?quanly=hotrokinhphi&query=chitiet&idhotro=<?php echo $idhotro ?>"
                            class="sub-navbar__list-item-link">Thâm niên</a>
                    </li>
                    <li class="sub-navbar__list-item">
                        <a href="?quanly=hotrokinhphi&query=chitietnhanhotro&idhotro=<?php echo $idhotro ?>"
                            class="sub-navbar__list-item-link">Danh sách nhận hỗ trợ</a>
                    </li>
                </ul>
                <?php
                } ?>
            </li>
            <li class="navbar__list-item">
                <a href="modules/container/quanly_hdsd/hdsd_download.php?hdsdadmin=1" class="navbar__list-item-link"><i
                        class="ti-download"></i> Hướng dẫn sử dụng Admin</a>
            </li>
            <li class="navbar__list-item">
                <a href="modules/container/quanly_hdsd/hdsd_download.php?hdsd=1" class="navbar__list-item-link"><i
                        class="ti-download"></i> Hướng dẫn sử dụng User</a>
            </li>
        </ul>
    </nav>
</div>