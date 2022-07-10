<?php 
$iddv = $_GET['iddv'];
$phongban_select = "SELECT * FROM tbl_phongban WHERE tbl_phongban.id_donvi = $iddv";
$phongban_query = mysqli_query($mysqli, $phongban_select);

$donvi_select = "SELECT * FROM tbl_donvi WHERE tbl_donvi.id_donvi = $iddv";
$donvi_query = mysqli_query($mysqli, $donvi_select);
$donvi_row = mysqli_fetch_array($donvi_query);


if(isset($_SESSION['nhanvien_isset'])){
    unset($_SESSION['nhanvien_isset']);
    echo '<script>window.alert("Không thể xóa vì còn tài khoản nhân viên hoạt động trong phòng ban!");</script>';
}

?>



<!-- danh sach phòng ban -->
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Đơn Vị: <?php echo $donvi_row['ten_donvi'] ?></h1>
    <div class="content__body__heading-gr">
        <h2 class="content__body__heading-gr-text">Thêm phòng ban</h2>
        <a href="?quanly=phongban&query=them&iddv=<?php echo $iddv ?>" class="content__body__heading-link"><i
                class="icon-m content__body__heading-link-btn ti-plus"></i></a>
        <a href="?quanly=donvi&query=danhsach" class="content__body__heading-link"><i
                class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
    </div>
</div>
<p class="content__body__desc">Danh sách: phòng ban</p>
<form action="">
    <table class="content__body__table">
        <thead>
            <tr>
                <td>STT</td>
                <td>Tên Phòng Ban</td>
                <td>Danh sách nhân viên</td>
                <td>Cập nhật</td>
                <td>Xóa</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 0;
            
                while($phongban_row = mysqli_fetch_array($phongban_query))
                {
                    $i++;
            ?>
            <tr>
                <td><?php  echo $i ?></td>
                <td><?php  echo $phongban_row['ten_phongban'] ?></td>
                <td>
                    <a href="?quanly=nhanvien&query=danhsach&iddv=<?php echo $donvi_row['id_donvi'] ?>&idpb=<?php echo $phongban_row['id_phongban'] ?>"
                        class="a-defaul">
                        <i class="icon-s ti-eye"></i>
                    </a>
                </td>
                <td><a href="?quanly=phongban&query=sua&iddv=<?php echo $iddv ?>&idpb=<?php echo $phongban_row['id_phongban'] ?>"
                        class="a-defaul">
                        <i class="icon-s ti-pencil"></i>
                    </a></td>
                <td><a href="?quanly=phongban&query=xoa&iddv=<?php echo $iddv ?>&idpb=<?php echo $phongban_row['id_phongban'] ?>"
                        onclick="return confirm('Bạn chắc chắn muốn xóa? Dữ liệu sẽ không thể khôi phục.');"
                        class="a-defaul">
                        <i class="icon-s ti-trash js-comfirm-phongban"></i>
                    </a>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</form>