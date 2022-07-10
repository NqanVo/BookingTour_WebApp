<?php 
$idpb = $_GET['idpb'];
$iddv = $_GET['iddv'];
$nhanvien_select = "SELECT * FROM tbl_nhanvien WHERE tbl_nhanvien.id_phongban = $idpb";
$nhanvien_query = mysqli_query($mysqli, $nhanvien_select);

$phongban_select = "SELECT * FROM tbl_phongban WHERE tbl_phongban.id_phongban = $idpb";
$phongban_query = mysqli_query($mysqli, $phongban_select);
$phongban_row = mysqli_fetch_array($phongban_query);
?>


<!-- danh sach nhân viên -->
<div class="content__body__heading">
    <h1 class="content__body__heading-text">Phòng: <?php echo $phongban_row['ten_phongban'] ?></h1>
    <div class="content__body__heading-gr">
        <h2 class="content__body__heading-gr-text">Thêm nhân viên</h2>
        <a href="?quanly=nhanvien&query=them&iddv=<?php echo $iddv ?>&idpb=<?php echo $idpb ?>"
            class="content__body__heading-link"><i class="icon-m content__body__heading-link-btn ti-plus"></i></a>
        <a href="?quanly=phongban&query=danhsach&iddv=<?php echo $iddv ?>&idpb=<?php echo $phongban_row['id_phongban'] ?>"
            class="content__body__heading-link"><i class="icon-m content__body__heading-link-btn ti-back-left"></i></a>
    </div>
</div>
<p class="content__body__desc">Danh sách: Nhân viên</p>
<form action="">
    <table class="content__body__table">
        <thead>
            <tr>
                <td>STT</td>
                <td>Họ tên</td>
                <td>Email</td>
                <td>Giới tính</td>
                <td>Tài khoản</td>
                <td>Chức vụ</td>
                <td>Chi tiết</td>
                <td>Cập nhật</td>
                <td>Trạng thái tài khoản</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 0;
                while($nhanvien_row = mysqli_fetch_array($nhanvien_query))
                {
                    $i++;
            ?>
            <tr>
                <td><?php  echo $i ?></td>
                <td><?php  echo $nhanvien_row['ten_nhanvien'] ?></td>
                <td><?php  echo $nhanvien_row['email_nhanvien'] ?></td>
                <td>
                    <?php  
                    if($nhanvien_row['gioitinh_nhanvien'] == 'nam'){
                        echo "Nam";
                    }
                    else{
                        echo "Nữ";
                    }
                ?>
                </td>
                <td><?php  echo $nhanvien_row['taikhoan_nhanvien'] ?></td>
                <td>
                    <?php  
                    if($nhanvien_row['chucvu_nhanvien'] == '0'){
                        echo "Quản lý";
                    }
                    elseif($nhanvien_row['chucvu_nhanvien'] == '1'){
                        echo "Tổ trưởng";
                    }
                    else{
                        echo "Nhân viên";
                    }
                    ?>
                </td>

                <td>
                    <a href="?quanly=nhanvien&query=chitiet&iddv=<?php echo $iddv ?>&idpb=<?php echo $phongban_row['id_phongban'] ?>&idnv=<?php echo $nhanvien_row['id_nhanvien']?>"
                        class="a-defaul">
                        <i class="icon-s ti-eye"></i>
                    </a>
                </td>
                <td>
                    <a href="?quanly=nhanvien&query=sua&iddv=<?php echo $iddv ?>&idpb=<?php echo $phongban_row['id_phongban'] ?>&idnv=<?php echo $nhanvien_row['id_nhanvien']?>"
                        class="a-defaul">
                        <i class="icon-s ti-pencil"></i>
                    </a>
                </td>
                <td>
                    <?php
                    if($nhanvien_row['status_nhanvien'] == '1'){
                        echo '<i class="ti-unlock success-txt"></i>';
                    }
                    else{
                        echo '<i class="ti-lock error-txt"></i>';
                    }
                    ?>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</form>
