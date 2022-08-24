<?php
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }

    if(isset($_SESSION['ticket'])){
        $tongnguoi = 0;
        $tongtien = 0;
        foreach($_SESSION['ticket'] as $key_ticket => $value_ticket){
            $gia_ticket = $value_ticket['gia_ve'];
            $tongtien += $gia_ticket;
            $tongnguoi += $value_ticket['songuoi_dangky'];
        }
    }
    if(isset($_SESSION['tour'])){
        foreach($_SESSION['tour'] as $key => $value){
            $idtour = $value['id_tour'];
        }
        $tour_select = "SELECT * FROM tbl_tourdulich WHERE tbl_tourdulich.id_tourdulich = '".$idtour."'";
        $tour_query = mysqli_query($mysqli, $tour_select);
        $tour_row = mysqli_fetch_array($tour_query);
        $soluong_tour_max = $tour_row['soluongtoida_tourdulich'];
        $soluong_tour_dadangky = $tour_row['soluongdadangky_tourdulich'];
        $soluong_conlai = $soluong_tour_max - $soluong_tour_dadangky;

        if($soluong_conlai < $tongnguoi){
            $_SESSION['full-ve'] = $soluong_conlai;
            header('location:index.php?select=tour&query=dattour');
        }
    }
?>

<div class="grid wide">
    <div class="row">
        <div class="col l-12 c-12">
            <div class="container-cart">
                <a href="?select=tour&query=dattour" class="btn-s btn-main container-cart__btn-back"><i
                        class="ti-back-left"></i></a>
                <div class="container-cart-status">
                    <div class="arrow-steps clearfix">
                        <div class="step done"><span><a href="">Giỏ Hàng</a></span> </div>
                        <div class="step current"> <span><a href="#">Kiểm Tra</a></span> </div>
                        <div class="step"> <span><a href="#">Hoàn Thành</a><span> </div>
                    </div>
                </div>

                <div class="container-cart__list">
                    <h3 class="container-cart__control-text">Kiểm tra thông tin vé:</h3>
                    <div class="container-cart__list-ticket">
                        <div class="row">
                            <?php 
                            if(isset($_SESSION['ticket']))
                            {
                                $i = 0;
                                $i--;
                                $stt = 0;

                                foreach ($_SESSION['ticket'] as $key_ticket => $value_ticket)
                                {   
                                    $ten_ve = $value_ticket['ten_ve'];
                                    $gia_ve = $value_ticket['gia_ve'];
                                    $sdt_ve = $value_ticket['sdt_ve'];
                                    $cccd_ve = $value_ticket['cccd_ve'];
                                    $gioitinh_ve_arr = $value_ticket['gioitinh_ve'];
                                    $quanhe_ve_arr = $value_ticket['quanhe_dangky'];
                                    if($gioitinh_ve_arr == 'nam'){
                                        $gioitinh_ve = "Nam";
                                    }
                                    else{
                                        $gioitinh_ve = "Nữ";
                                    }
                                    if($quanhe_ve_arr == 'daidien'){
                                        $quanhe_ve = "Đại diện";
                                    }
                                    else{
                                        $quanhe_ve = "Người Thân";
                                    }
                                    $i++;
                                    $stt++;
                                ?>
                            <div class="col l-6 c-12">
                                <div class="container-cart__list-ticket-item">
                                    <h3>Tour: <?php echo $tour_row['ten_tourdulich'] ?>
                                    </h3>
                                    <div class="row no-gutters">
                                        <div class="col l-6 c-12">
                                            <div class="container-cart__list-ticket-item-group">
                                                <p>Giá:
                                                    <?php echo number_format($gia_ve,0,',',',')?> đ
                                                </p>
                                                </p>
                                                <p>Địa điểm: <?php echo $tour_row['diadiem_tourdulich'] ?></p>
                                                <p>Thời gian:
                                                    <?php echo date("d/m/Y", strtotime($tour_row['ngaydi_tourdulich'])); ?>
                                                    -
                                                    <?php echo date("d/m/Y", strtotime($tour_row['ngayve_tourdulich'])); ?>
                                                </p>
                                                <p>Tên: <?php echo $ten_ve ?></p>
                                                <p>SĐT: <?php echo $sdt_ve ?></p>
                                                <p>Quan hệ: <?php echo $quanhe_ve ?></p>
                                            </div>
                                        </div>
                                        <div class="col l-6 c-0">
                                            <img src="./assets/img/travel-img-payment.jpg" alt=""
                                                class="container-cart__list-ticket-item-img">
                                            </img>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php   
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="container-cart__control container-cart__control-payment">
                    <h3 class="container-cart__control-text container-cart__control-text-payment">Tổng vé:
                        <?php echo $tongnguoi ?>
                    </h3>
                    <h3 class="container-cart__control-text container-cart__control-text-payment">Tổng tiền:
                        <?php echo number_format($tongtien,0,',',',')?>
                        đ</h3>
                </div>

                <form action="modules/container/tour/tour_thanhtoan_xuly.php" method="POST">
                    <input type="submit" name="thanhtoan" value="Tiếp tục"
                        class="btn-m btn-main container-cart-btn"></input>
                </form>
            </div>
        </div>
    </div>
</div>