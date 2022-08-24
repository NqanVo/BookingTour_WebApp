<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $idhotro = $_GET['idhotro'];
    $danhsach_hotro_chitiet_query = mysqli_query($mysqli, "SELECT * FROM tbl_hotro_kinhphi_chitiet2 WHERE tbl_hotro_kinhphi_chitiet2.id_hotro_kinhphi = '".$idhotro."'");
    $danhsach_hotro_query = mysqli_query($mysqli,"SELECT * FROM tbl_hotro_kinhphi WHERE id_hotro_kinhphi = '".$idhotro."'");
    $danhsach_hotro_row = mysqli_fetch_array($danhsach_hotro_query);

    $danhsach_nhanvien_nhan = mysqli_query($mysqli,"SELECT * FROM tbl_nhan_hotro WHERE id_hotro_kinhphi = '".$idhotro."'");
?>

<!-- danh sach phòng ban -->
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Hỗ Trợ Theo Thâm Niên</h1>
    <div class="content__body__heading-gr">
        <h2 class="content__body__heading-gr-text">Thêm Thâm Niên Hổ Trợ</h2>
        <a href="?quanly=hotrokinhphi&query=them_thamnien&idhotro=<?php echo $idhotro?>" class="content__body__heading-link"><i
                class="icon-m content__body__heading-link-btn ti-plus"></i></a>
        <a href="?quanly=hotrokinhphi&query=danhsach" class="content__body__heading-link"><i
                class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
    </div>
</div>
<p class="content__body__desc">Danh Sách: Hỗ Trợ Kì <?php echo $danhsach_hotro_row['tunam_hotro_kinhphi']?> - <?php echo $danhsach_hotro_row['dennam_hotro_kinhphi']?></p>
<form action="">
    <table class="content__body__table">
        <thead>
            <tr>
                <td>STT</td>
                <td>Thâm Niên</td>
                <td>Tiền Hỗ Trợ</td>
                <td>Chỉnh Sửa</td>
            </tr>

        </thead>
        <tbody>
            <?php
                $i=0;
                while($danhsach_hotro_chitiet_row = mysqli_fetch_array($danhsach_hotro_chitiet_query))
                {
                    $i++;
                    if($danhsach_hotro_chitiet_row['thamnien_hotro_kinhphi_chitiet'] <= 0)
                    {
                        $thamnien = '<1';
                    }
                    else{
                        $thamnien = $danhsach_hotro_chitiet_row['thamnien_hotro_kinhphi_chitiet'];
                    }
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $thamnien?> Năm</td>
                <td><?php echo number_format($danhsach_hotro_chitiet_row['tien_hotro_kinhphi_chitiet'],0,',',',')?>đ</td>
                <td><a href="?quanly=hotrokinhphi&query=capnhatthamnien&idhotro=<?php echo $idhotro?>&idhotrochitiet=<?php echo $danhsach_hotro_chitiet_row['id_hotro_kinhphi_chitiet']?>" class="a-defaul">
                        <i class="icon-s ti-pencil"></i>
                    </a></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</form>