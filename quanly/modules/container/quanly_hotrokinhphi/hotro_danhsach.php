<?php
    $danhsach_hotro_query = mysqli_query($mysqli, "SELECT * FROM tbl_hotro_kinhphi ORDER BY id_hotro_kinhphi DESC");
    
    $hotro_cuthe = false;
    if(isset($_GET['idhotro'])){
        $idhotro = $_GET['idhotro'];
        $danhsach_hotro_query_cuthe = mysqli_query($mysqli, "SELECT * FROM tbl_hotro_kinhphi WHERE id_hotro_kinhphi = '".$idhotro."'");
        $hotro_cuthe = true;
    }

    

?>

<!-- danh sach phòng ban -->
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Hỗ Trợ Kinh Phí</h1>
    <div class="content__body__heading-gr">
        <?php if(!$hotro_cuthe){
            ?>
        <h2 class="content__body__heading-gr-text">Thêm Kì Hỗ Trợ Mới</h2>
        <a href="?quanly=hotrokinhphi&query=them" class="content__body__heading-link"><i
                class="icon-m content__body__heading-link-btn ti-plus"></i></a>
        <?php } ?>
        <a href="?" class="content__body__heading-link"><i
                class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
    </div>
</div>
<p class="content__body__desc">Danh Sách: Hỗ Trợ</p>
<form action="">
    <table class="content__body__table">
        <thead>
            <tr>
                <td colspan="2">Giai Đoạn</td>
                <td colspan="5">Thông Tin</td>
            </tr>
            <tr>
                <td>Từ Năm</td>
                <td>Đến Năm</td>
                <td>Đã sử dụng</td>
                <td>Thâm niên</td>
                <td>Đã nhận hổ trợ</td>
                <td>Cập Nhật</td>
                <td>Trạng Thái</td>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!$hotro_cuthe)
                {
                    while($danhsach_hotro_row = mysqli_fetch_array($danhsach_hotro_query))
                    {
                        $idhotrokinhphi = $danhsach_hotro_row['id_hotro_kinhphi'];

                        $select_hotro_chitiet = mysqli_query($mysqli,"SELECT SUM(sotien_nhan_hotro) FROM tbl_nhan_hotro WHERE id_hotro_kinhphi = '".$idhotrokinhphi."'");
                        $row_hotro_chitiet = mysqli_fetch_array($select_hotro_chitiet);
                        $tienhotro_dasudung = $row_hotro_chitiet['SUM(sotien_nhan_hotro)'];
                        if($tienhotro_dasudung == null){
                            $tienhotro_dasudung = 0;
                        }
                ?>
                <tr>
                    <td><?php echo $danhsach_hotro_row['tunam_hotro_kinhphi']?></td>
                    <td><?php echo $danhsach_hotro_row['dennam_hotro_kinhphi']?></td>
                    <td><?php echo number_format($tienhotro_dasudung,0,',',',')?>đ</td>
                    <td><a href="?quanly=hotrokinhphi&query=chitiet&idhotro=<?php echo $danhsach_hotro_row['id_hotro_kinhphi'] ?>"
                            class="a-defaul">
                            <i class="icon-s ti-eye"></i>
                        </a></td>
                    <td><a href="?quanly=hotrokinhphi&query=chitietnhanhotro&idhotro=<?php echo $danhsach_hotro_row['id_hotro_kinhphi'] ?>"
                            class="a-defaul">
                            <i class="icon-s ti-eye"></i>
                        </a></td>
                    <td><a href="?quanly=hotrokinhphi&query=capnhat&idhotro=<?php echo $danhsach_hotro_row['id_hotro_kinhphi'] ?>"
                            class="a-defaul">
                            <i class="icon-s ti-pencil"></i>
                        </a></td>
                    <td><?php if($danhsach_hotro_row['status_hotro_kinhphi'] == 1){echo '<span class="success-txt">Đang diễn ra</span>';}else{echo '<span class="error-txt">Đã kết thúc</span>';}?>
                    </td>
                </tr>
                <?php
                    }
                }
                else{
                    while($danhsach_hotro_row = mysqli_fetch_array($danhsach_hotro_query_cuthe))
                    {
                        $idhotrokinhphi = $danhsach_hotro_row['id_hotro_kinhphi'];

                        $select_hotro_chitiet = mysqli_query($mysqli,"SELECT SUM(sotien_nhan_hotro) FROM tbl_nhan_hotro WHERE id_hotro_kinhphi = '".$idhotrokinhphi."'");
                        $row_hotro_chitiet = mysqli_fetch_array($select_hotro_chitiet);
                        $tienhotro_dasudung = $row_hotro_chitiet['SUM(sotien_nhan_hotro)'];
                        if($tienhotro_dasudung == null){
                            $tienhotro_dasudung = 0;
                        }
                ?>
                <tr>
                    <td><?php echo $danhsach_hotro_row['tunam_hotro_kinhphi']?></td>
                    <td><?php echo $danhsach_hotro_row['dennam_hotro_kinhphi']?></td>
                    <td><?php echo number_format($tienhotro_dasudung,0,',',',')?>đ</td>
                    <td><a href="?quanly=hotrokinhphi&query=chitiet&idhotro=<?php echo $danhsach_hotro_row['id_hotro_kinhphi'] ?>"
                            class="a-defaul">
                            <i class="icon-s ti-eye"></i>
                        </a></td>
                    <td><a href="?quanly=hotrokinhphi&query=chitietnhanhotro&idhotro=<?php echo $danhsach_hotro_row['id_hotro_kinhphi'] ?>"
                            class="a-defaul">
                            <i class="icon-s ti-eye"></i>
                        </a></td>
                    <td><a href="?quanly=hotrokinhphi&query=capnhat&idhotro=<?php echo $danhsach_hotro_row['id_hotro_kinhphi'] ?>"
                            class="a-defaul">
                            <i class="icon-s ti-pencil"></i>
                        </a></td>
                    <td><?php if($danhsach_hotro_row['status_hotro_kinhphi'] == 1){echo '<span class="success-txt">Đang diễn ra</span>';}else{echo '<span class="error-txt">Đã kết thúc</span>';}?>
                    </td>
                </tr>
                <?php
                    }
                }
            ?>
        </tbody>
    </table>
</form>