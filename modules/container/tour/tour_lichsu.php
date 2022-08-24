<?php
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }
    
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $dangkytour_select = "SELECT * FROM tbl_dangkytour WHERE tbl_dangkytour.id_nhanvien = '".$idnv."' ORDER BY id_dangkytour DESC";
    $dangkytour_query = mysqli_query($mysqli, $dangkytour_select);

    $dangkytour_select_hethan = "SELECT * FROM tbl_dangkytour WHERE tbl_dangkytour.id_nhanvien = '".$idnv."' ORDER BY id_dangkytour DESC";
    $dangkytour_query_hethan = mysqli_query($mysqli, $dangkytour_select_hethan);

    if(isset($_SESSION['tour-dadangky'])){
        echo '<script>window.alert("Bạn đã đặt tour này, vui lòng vào lịch sử để xem chi tiết!");</script>';
        unset($_SESSION['tour-dadangky']);
        unset($_SESSION['ticket']);
        unset($_SESSION['tour']);
    }
?>



<div class="grid wide">
    <div class="row">
        <div class="col l-12 c-12">
            <div class="container-cart">
                <div class="heading-label">
                    <h1 class="heading-label-text">Lịch sử tour</h1>
                    <div class="heading-label-gr">
                        <a href="?" class="heading-label-link"><i
                                class="icon-m heading-label-link-btn ti-back-left"></i></a>
                    </div>
                </div>
                <div class="container-history__group">
                    <h3>Danh sách tour đang diễn ra</h3>
                </div>
                <div class="container-history">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <td>Mã tuor</td>
                                <td>Tên tour</td>
                                <td>Thời gian</td>
                                <td>Ngày đăng ký</td>
                                <td>Số vé</td>
                                <td>Chi tiết</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($dangkytour_row = mysqli_fetch_array($dangkytour_query))
                                {
                                    $id_tour = $dangkytour_row['id_tourdulich'];
                                    $tour_query = mysqli_query($mysqli, "SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$id_tour."'");
                                    $tour_row = mysqli_fetch_array($tour_query);
                                    $dangkytruoc = $tour_row['dangkytruoc_tourdulich'];
                                    if(strtotime($dangkytruoc) >= strtotime($today)){
                                        $thoihan = true;
                                    }
                                    else{
                                        $thoihan = false;
                                    }
                                    if($thoihan)
                                    {
                            ?>
                            <tr>
                                <td><?php echo $tour_row['id_tourdulich'] ?></td>
                                <td><?php echo $tour_row['ten_tourdulich'] ?></td>
                                <td><?php echo date("d/m/Y", strtotime($tour_row['ngaydi_tourdulich'])); ?> -
                                    <?php echo date("d/m/Y", strtotime($tour_row['ngayve_tourdulich'])); ?>
                                </td>
                                <td><?php echo date("d/m/Y", strtotime($dangkytour_row['ngaydangky_dangkytour'])); ?>
                                </td>
                                <td><?php echo $dangkytour_row['soluong_dangkytour'] ?></td>
                                <td><a href="?select=tour&query=lichsu_chitiet&iddangkytour=<?php echo $dangkytour_row['id_dangkytour'] ?>"
                                        class="a-defaul">
                                        <i class="icon-s ti-eye"></i>
                                    </a></td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>


                </br>
                </br>


                <div class="container-history__group">
                    <h3>Danh sách tour hết hạn đặt / hủy vé</h3>
                </div>
                <div class="container-history">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <td>Mã tuor</td>
                                <td>Tên tour</td>
                                <td>Thời gian</td>
                                <td>Ngày đăng ký</td>
                                <td>Số vé</td>
                                <td>Chi tiết</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($dangkytour_row_hethan = mysqli_fetch_array($dangkytour_query_hethan))
                                {
                                    $id_tour_hethan = $dangkytour_row_hethan['id_tourdulich'];
                                    $tour_query_hethan = mysqli_query($mysqli, "SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$id_tour_hethan."'");
                                    $tour_row_hethan = mysqli_fetch_array($tour_query_hethan);
                                    $dangkytruoc_hethan = $tour_row_hethan['dangkytruoc_tourdulich'];
                                    if(strtotime($today) > strtotime($dangkytruoc_hethan)){
                                        $thoihan_hethan = true;
                                    }
                                    else{
                                        $thoihan_hethan = false;
                                    }
                                    if($thoihan_hethan)
                                    {
                            ?>
                            <tr>
                                <td><?php echo $tour_row_hethan['id_tourdulich'] ?></td>
                                <td><?php echo $tour_row_hethan['ten_tourdulich'] ?></td>
                                <td><?php echo date("d/m/Y", strtotime($tour_row_hethan['ngaydi_tourdulich'])); ?> -
                                    <?php echo date("d/m/Y", strtotime($tour_row_hethan['ngayve_tourdulich'])); ?>
                                </td>
                                <td><?php echo $dangkytour_row_hethan['ngaydangky_dangkytour'] ?>
                                </td>
                                <td><?php echo $dangkytour_row_hethan['soluong_dangkytour'] ?></td>
                                <td><a href="?select=tour&query=lichsu_chitiet&iddangkytour=<?php echo $dangkytour_row_hethan['id_dangkytour'] ?>"
                                        class="a-defaul">
                                        <i class="icon-s ti-eye"></i>
                                    </a></td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>