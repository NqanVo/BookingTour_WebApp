<?php
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }

    $iddangkytour = $_GET['iddangkytour'];
    $dangkytour_chitiet_select = "SELECT * FROM tbl_dangkytour_chitiet WHERE tbl_dangkytour_chitiet.id_dangkytour = '".$iddangkytour."'";
    $dangkytour_chitiet_query = mysqli_query($mysqli, $dangkytour_chitiet_select);

    $dangkytour_select = "SELECT * FROM tbl_dangkytour WHERE tbl_dangkytour.id_dangkytour = '".$iddangkytour."'";
    $dangkytour_query = mysqli_query($mysqli, $dangkytour_select);   
    $dangkytour_row = mysqli_fetch_array($dangkytour_query);
    $idtour = $dangkytour_row['id_tourdulich'];

    $tour_query = mysqli_query($mysqli, "SELECT dangkytruoc_tourdulich FROM tbl_tourdulich WHERE id_tourdulich = '".$idtour."'");
    $tour_row = mysqli_fetch_array($tour_query);
    $dktruoc = $tour_row['dangkytruoc_tourdulich'];

    //tim tong ve da dat va tong ve da huy
    $dangkytour_chitiet_dat_select = "SELECT status_dangkytour_chitiet FROM tbl_dangkytour_chitiet WHERE tbl_dangkytour_chitiet.status_dangkytour_chitiet = '1' AND tbl_dangkytour_chitiet.id_dangkytour = '".$iddangkytour."'";
    $dangkytour_chitiet_dat_query = mysqli_query($mysqli, $dangkytour_chitiet_dat_select);
    $count_dat = mysqli_num_rows($dangkytour_chitiet_dat_query);

    $dangkytour_chitiet_huy_select = "SELECT status_dangkytour_chitiet FROM tbl_dangkytour_chitiet WHERE tbl_dangkytour_chitiet.status_dangkytour_chitiet = '0' AND tbl_dangkytour_chitiet.id_dangkytour = '".$iddangkytour."'";
    $dangkytour_chitiet_huy_query = mysqli_query($mysqli, $dangkytour_chitiet_huy_select);
    $count_huy = mysqli_num_rows($dangkytour_chitiet_huy_query);

    //tim xem tour nay có được hỗ trợ không
    $nhan_hotro_query = mysqli_query($mysqli,"SELECT * FROM tbl_nhan_hotro WHERE id_nhanvien = '".$idnv."' AND id_tourdulich = '".$idtour."' AND id_hotro_kinhphi = '".$id_hotrokinhphi."'");
    $nhan_hotro_row = mysqli_fetch_array($nhan_hotro_query);
    if($nhan_hotro_row != null){
        $id_hotro = $nhan_hotro_row['id_hotro_kinhphi'];
        $hotro_chuki_query = mysqli_query($mysqli,"SELECT * FROM tbl_hotro_kinhphi WHERE id_hotro_kinhphi = '".$id_hotro."'");
        $hotro_chuki_row = mysqli_fetch_array($hotro_chuki_query);
        $tunam = $hotro_chuki_row['tunam_hotro_kinhphi'];
        $dennam = $hotro_chuki_row['dennam_hotro_kinhphi'];
        $tien_nhan = number_format($nhan_hotro_row['sotien_nhan_hotro'],0,',',',');
        $tien_nhan_hotro = $tien_nhan."đ, Trong kì: ".$tunam." - ".$dennam;
    }
    else{
        $tien_nhan_hotro = "0đ";
    }

    if(isset($_SESSION['huyve'])){
        unset($_SESSION['huyve']);
        echo '<script>window.alert("Hủy vé thành công!");</script>';
    }
    if(isset($_SESSION['thoihan'])){
        unset($_SESSION['thoihan']);
        echo '<script>window.alert("Đã hết thời hạn đặt / hủy vé !");</script>';
    }
    if(isset($_SESSION['fullve'])){
        unset($_SESSION['fullve']);
        echo '<script>window.alert("Số lượng vé trống đã hết, vui lòng thử lại sau!");</script>';
    }
    if(isset($_SESSION['datve_lai'])){
        unset($_SESSION['datve_lai']);
        echo '<script>window.alert("Đặt lại vé thành công!");</script>';
    }
    if(isset($_SESSION['themve'])){
        unset($_SESSION['themve']);
        echo '<script>window.alert("Thêm vé thành công!");</script>';
    }
    if(isset($_SESSION['capnhat'])){
        unset($_SESSION['capnhat']);
        echo '<script>window.alert("Cập nhật thông tin thành công!");</script>';
    }
    if(isset($_SESSION['daidien_chuadk'])){
        unset($_SESSION['daidien_chuadk']);
        echo '<script>window.alert("Người đại diện cần đăng ký lại trước khi người thân đăng ký!");</script>';
    }
?>

<div class="grid wide">
    <div class="row">
        <div class="col l-12 c-12">
            <div class="container-cart">
                <div class="heading-label">
                    <h1 class="heading-label-text">Chi tiết vé</h1>
                    <div class="heading-label-gr">
                        <a href="?select=tour&query=lichsu" class="heading-label-link"><i
                                class="icon-m heading-label-link-btn ti-back-left"></i></a>
                    </div>
                </div>
                <div class="container-history__group">
                    <h3>Tour: <?php echo $dangkytour_row['tentour_dangkytour']?></h3>
                    <p>Tổng vé: <?php echo $dangkytour_row['soluong_dangkytour']?></p>
                    <p>Đã đặt: <?php echo ($count_dat > 0)?($count_dat):('0'); ?></p>
                    <p>Đã hủy: <?php echo ($count_huy > 0)?($count_huy):('0'); ?></p>
                    <p style="font-weight:700;">Nhân viên được hỗ trợ: <?php echo $tien_nhan_hotro?></p>
                </div>
                <a href="?select=tour&query=lichsu_chitiet_themve&idtour=<?php echo $idtour ?>&iddangkytour=<?php echo $iddangkytour ?>" class="btn-s btn-main container-cart__control-btn container-history-btn">Thêm vé</a>
                <div class="container-history">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Mã vé</td>
                                <td>Họ tên</td>
                                <td>SĐT</td>
                                <td>CCCD</td>
                                <td>Giới tính</td>
                                <td>Quan hệ</td>
                                <td>Thành tiền</td>
                                <td>Trang thái</td>
                                <td>Cập nhật</td>
                                <td>Hủy vé/ Đặt lại</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                while($dangkytour_chitiet_row = mysqli_fetch_array($dangkytour_chitiet_query))
                                {
                                    $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $dangkytour_chitiet_row['id_dangkytour_chitiet'] ?></td>
                                <td><?php echo $dangkytour_chitiet_row['ten_dangkytour_chitiet'] ?></td>
                                <td><?php echo $dangkytour_chitiet_row['sdt_dangkytour_chitiet'] ?></td>
                                <td><?php echo $dangkytour_chitiet_row['cccd_dangkytour_chitiet'] ?></td>
                                <td><?php if($dangkytour_chitiet_row['gioitinh_dangkytour_chitiet'] == 'nam'){echo 'Nam';}else{echo 'Nữ';} ?>
                                </td>
                                <td><?php if($dangkytour_chitiet_row['quanhe_dangkytour_chitiet'] == 'daidien'){echo 'Đại diện';}else{echo 'Người Thân';} ?>
                                </td>
                                <td><?php echo number_format($dangkytour_chitiet_row['thanhtien_dangkytour_chitiet'],0,',',',')?>đ
                                </td>
                                <td><?php 
                                        if($dangkytour_chitiet_row['status_dangkytour_chitiet'] == 1) 
                                        {
                                            echo '<p class="success-txt">Đã đặt vé</p>';
                                        }
                                        else{
                                            echo '<p class="error-txt">Đã hủy vé</p>';
                                        }
                                    ?>
                                </td>
                                <td><a href="?select=tour&query=lichsu_chitiet_capnhat&idvechitiet=<?php echo $dangkytour_chitiet_row['id_dangkytour_chitiet'] ?>&iddangkytour=<?php echo $dangkytour_chitiet_row['id_dangkytour'] ?>"
                                        class="a-defaul">
                                        <i class="icon-s ti-pencil"></i>
                                    </a></td>
                                <td>
                                    <?php 
                                        if($dangkytour_chitiet_row['status_dangkytour_chitiet'] == 1) 
                                        {
                                    ?>
                                    <a href="modules/container/tour/tour_lichsu_chitiet_xuly_huy.php?tacvu=xoa&idvechitiet=<?php echo $dangkytour_chitiet_row['id_dangkytour_chitiet'] ?>&idtour=<?php echo $dangkytour_chitiet_row['id_tourdulich'] ?>"
                                        onclick="return confirm('Bạn chắc chắn muốn hủy vé?');" class="a-defaul">
                                        <i class="icon-s ti-trash error-txt"></i>
                                    </a>
                                    <?php
                                        }
                                        else{
                                    ?>
                                    <a href="modules/container/tour/tour_lichsu_chitiet_xuly_datlai.php?tacvu=datlai&idvechitiet=<?php echo $dangkytour_chitiet_row['id_dangkytour_chitiet'] ?>&idtour=<?php echo $dangkytour_chitiet_row['id_tourdulich'] ?>"
                                        onclick="return confirm('Bạn muốn đặt lại vé?');" class="a-defaul">
                                        <i class="icon-s ti-loop warring-txt"></i>
                                    </a>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="container-history__group container-history__group-note">
                    <h4 class="container-history__group-note-heading">Lưu ý</h4>
                    <p>*Bạn chỉ có thể đăt / hủy vé trước ngày <?php echo date("d/m/Y", strtotime($dktruoc)); ?>.</p>
                    <p>*Nếu người đại diện hủy vé, tất cả vé của người thân cũng hủy theo.</p>
                </div>
            </div>
        </div>
    </div>
</div>