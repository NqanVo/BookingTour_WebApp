<?php
    $tour_dk_select = "SELECT DISTINCT id_tourdulich FROM tbl_dangkytour ORDER BY id_dangkytour DESC";
    $tour_dk_query = mysqli_query($mysqli, $tour_dk_select);

?>



<div class="content__body__heading">
    <h1 class="content__body__heading-text">Danh Sách Các Tour Được Đăng Ký </h1>
    <div class="content__body__heading-gr">
        <a href="?quanly=tour&query=danhsach" class="content__body__heading-link"><i
                class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
    </div>
</div>
<p class="content__body__desc">Danh sách:</p>
<form action="">
    <table class="content__body__table">
        <thead>
            <tr>
                <td>Mã Tour</td>
                <td>Tên Tour</td>
                <td>Giá Vé</td>
                <td>Đã Đăng Ký</td>
                <!-- <td>Vé Tối Đa</td>
                <td>Vé còn lại</td> -->
                <td>Tổng Tiền</td>             
                <td>Danh Sách Đăng Ký</td>
                <td>Download danh sách</td>
            </tr>
        </thead>
        <tbody>
            <?php
                while($tour_dk_row = mysqli_fetch_array($tour_dk_query))
                {
                    $id_tour = $tour_dk_row['id_tourdulich'];
                    $tour_select = "SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$id_tour."'";
                    $tour_query = mysqli_query($mysqli, $tour_select);
                    $tour_row = mysqli_fetch_array($tour_query);

                    $tongtien_query = mysqli_query($mysqli,"SELECT SUM(thanhtien_dangkytour_chitiet) FROM tbl_dangkytour_chitiet WHERE id_tourdulich = '".$id_tour."' AND status_dangkytour_chitiet = '1'");
                    $tongtien_row = mysqli_fetch_array($tongtien_query);

                    $tongdk_query = mysqli_query($mysqli,"SELECT count(id_dangkytour_chitiet) FROM tbl_dangkytour_chitiet WHERE id_tourdulich = '".$id_tour."' AND status_dangkytour_chitiet = '1'");
                    $tongdk_row = mysqli_fetch_array($tongdk_query);
                    if($tongdk_row['count(id_dangkytour_chitiet)'] <= 0){ continue;}
                    
                    $veconlai = $tour_row['soluongtoida_tourdulich'] - $tongdk_row['count(id_dangkytour_chitiet)'];
            ?>
            <tr>
                <td><?php echo $tour_row['id_tourdulich'] ?></td>
                <td><a href="?quanly=tour&query=chitiet&idtour=<?php echo $id_tour?>" class="a-defaul"><?php echo $tour_row['ten_tourdulich'] ?></a></td>
                <td><?php echo number_format($tour_row['gia_tourdulich'],0,',',',')?>đ</td>
                <td><?php echo $tongdk_row['count(id_dangkytour_chitiet)'] ?></td>
                <!-- <td><?php echo $tour_row['soluongtoida_tourdulich'] ?></td>
                <td><?php echo $veconlai ?></td> -->
                <td><?php echo number_format($tongtien_row['SUM(thanhtien_dangkytour_chitiet)'],0,',',',')?>đ</td>
                <td><a href="?quanly=tour&query=danhsachdangky_chitiet&idtour=<?php echo $id_tour?>" class="a-defaul">
                        <i class="icon-s ti-eye"></i>
                    </a></td>
                <td><a href="./modules/container/quanly_tour/tour_download_danhsach_dangky_tour.php?idtour=<?php echo $id_tour ?>" class="a-defaul"><i class="icon-s ti-download"></i></a></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</form>
