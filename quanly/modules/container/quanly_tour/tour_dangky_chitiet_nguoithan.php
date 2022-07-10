<?php
    $iddktour = $_GET['iddktour'];
    $idtour = $_GET['idtour'];
    $dk_chitiet_query = mysqli_query($mysqli, "SELECT * FROM tbl_dangkytour_chitiet WHERE id_dangkytour = '".$iddktour."' AND status_dangkytour_chitiet = '1'");
?>



<div class="content__body__heading">
    <h1 class="content__body__heading-text">Danh Sách Người Tham Gia </h1>
    <div class="content__body__heading-gr">
        <a href="?quanly=tour&query=danhsachdangky_chitiet&idtour=<?php echo $idtour?>" class="content__body__heading-link"><i
                class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
    </div>
</div>
<p class="content__body__desc">Danh sách người thân:</p>
<form action="">
    <table class="content__body__table">
        <thead>
            <tr>
                <td>Mã Vé</td>
                <td>Họ Tên</td>
                <td>Số Điện Thoại</td>
                <td>CCCD/CMND</td>  
                <td>Giới Tính</td>
                <td>Quan Hệ</td>
            </tr>
        </thead>
        <tbody>
            <?php
                while($dk_chiitet_row = mysqli_fetch_array($dk_chitiet_query))
                {
                   
            ?>
            <tr>
                <td><?php echo $dk_chiitet_row['id_dangkytour_chitiet']?></td>
                <td><?php echo $dk_chiitet_row['ten_dangkytour_chitiet']?></td>
                <td><?php echo $dk_chiitet_row['sdt_dangkytour_chitiet']?></td>
                <td><?php echo $dk_chiitet_row['cccd_dangkytour_chitiet']?></td>
                <td><?php if($dk_chiitet_row['gioitinh_dangkytour_chitiet'] == 'nam'){echo 'Nam';}else{echo 'Nữ';} ?></td>
                <td><?php if($dk_chiitet_row['quanhe_dangkytour_chitiet'] == 'daidien'){echo 'Đại diện';}else{echo 'Người Thân';} ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</form>
