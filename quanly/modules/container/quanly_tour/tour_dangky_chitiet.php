<?php
    $id_tour = $_GET['idtour'];
    $dangkytour_select = "SELECT * FROM tbl_dangkytour WHERE id_tourdulich = '".$id_tour."'";
    $dangkytour_query = mysqli_query($mysqli, $dangkytour_select);

    // $slect_id_dk = "SELECT DISTINCT id_tourdulich FROM tbl_dangkytour ORDER BY id_dangkytour DESC";
    $tour_query = mysqli_query($mysqli,"SELECT ten_tourdulich,gia_tourdulich FROM tbl_tourdulich WHERE id_tourdulich = '".$id_tour."'");
    $tour_row = mysqli_fetch_array($tour_query);
    $gia_ve = $tour_row['gia_tourdulich'];
?>



<div class="content__body__heading">
    <h1 class="content__body__heading-text">Danh Sách Người Đại Diện </h1>
    <div class="content__body__heading-gr">
        <a href="?quanly=tour&query=danhsachdangky" class="content__body__heading-link"><i
                class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
    </div>
</div>
<p class="content__body__desc">Tour: <?php echo $tour_row['ten_tourdulich']?></p>
<form action="">
    <table class="content__body__table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Tên Nhân Viên</td>
                <td>Số người thân</td>
                <td>Tổng Vé</td>  
                <td>Tổng Tiền</td>
                <td>Danh Sách Người Thân</td>
            </tr>
        </thead>
        <tbody>
            <?php
                while($dangkytour_row = mysqli_fetch_array($dangkytour_query))
                {
                    $id_nhanvien = $dangkytour_row['id_nhanvien'];
                    $id_dktour = $dangkytour_row['id_dangkytour'];

                    //nguoi dai dien
                    $select_daidien_query = mysqli_query($mysqli, "SELECT ten_dangkytour_chitiet FROM tbl_dangkytour_chitiet WHERE quanhe_dangkytour_chitiet='daidien' AND id_dangkytour = '".$id_dktour."'");
                    $daidien_row = mysqli_fetch_array($select_daidien_query);

                    //so nguoi than di cung
                    $tongnguoithan_query = mysqli_query($mysqli, "SELECT COUNT(id_dangkytour_chitiet) FROM tbl_dangkytour_chitiet WHERE status_dangkytour_chitiet='1' AND id_dangkytour = '".$id_dktour."' AND quanhe_dangkytour_chitiet = 'nguoithan'");
                    $tongnguoithan_row = mysqli_fetch_array($tongnguoithan_query);

                    // tong ve
                    $tong_ve_query = mysqli_query($mysqli,"SELECT COUNT(id_dangkytour_chitiet) FROM tbl_dangkytour_chitiet WHERE status_dangkytour_chitiet='1' AND id_dangkytour = '".$id_dktour."'");
                    $tong_ve_row = mysqli_fetch_array($tong_ve_query);

                    // $tongtien = $tong_ve_row['COUNT(id_dangkytour_chitiet)']*$gia_ve;
                    $tongtien_query = mysqli_query($mysqli,"SELECT SUM(thanhtien_dangkytour_chitiet) FROM tbl_dangkytour_chitiet WHERE id_tourdulich = '".$id_tour."' AND id_dangkytour = '".$id_dktour."' AND status_dangkytour_chitiet = '1'");
                    $tongtien_row = mysqli_fetch_array($tongtien_query);
            ?>
            <tr>
                <td><?php echo $id_nhanvien ?></td>
                <td><?php echo $daidien_row['ten_dangkytour_chitiet'] ?></a></td>
                <td><?php echo $tongnguoithan_row['COUNT(id_dangkytour_chitiet)']?></td>
                <td><?php echo $tong_ve_row['COUNT(id_dangkytour_chitiet)']?></td>
                <td><?php echo number_format($tongtien_row['SUM(thanhtien_dangkytour_chitiet)'],0,',',',')?>đ</td>
                <td><a href="?quanly=tour&query=danhsachdangky_chitiet_nguoithan&iddktour=<?php echo $id_dktour?>&idtour=<?php echo $id_tour ?>" class="a-defaul">
                        <i class="icon-s ti-eye"></i>
                    </a></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</form>
