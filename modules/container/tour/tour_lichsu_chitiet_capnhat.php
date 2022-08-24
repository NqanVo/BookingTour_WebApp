<?php
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }

    $iddangkytour = $_GET['iddangkytour'];
    $idvechitiet = $_GET['idvechitiet'];

    $ve_chitiet_query = mysqli_query($mysqli,"SELECT * FROM tbl_dangkytour_chitiet WHERE id_dangkytour_chitiet = '".$idvechitiet."'");
    $ve_chitiet_row = mysqli_fetch_array($ve_chitiet_query);

    if(isset($_POST['capnhat'])){
        $ten = $_POST['ten_ve'];
        $sdt = $_POST['sdt_ve'];
        $cccd = $_POST['cccd_ve'];
        $gioitinh = $_POST['gioitinh_ve'];

        $capnhat_thongtin_query = mysqli_query($mysqli,"UPDATE `tbl_dangkytour_chitiet` SET `ten_dangkytour_chitiet`='".$ten."',`sdt_dangkytour_chitiet`='".$sdt."',`cccd_dangkytour_chitiet`='".$cccd."',`gioitinh_dangkytour_chitiet`='".$gioitinh."' WHERE `tbl_dangkytour_chitiet`.`id_dangkytour_chitiet` = '".$idvechitiet."'");
        
        $_SESSION['capnhat'] = 'abjew';
        header("location:index.php?select=tour&query=lichsu_chitiet&iddangkytour=$iddangkytour");
    }

?>




<div class="grid wide">
    <div class="row">
        <div class="col l-12 c-12">
            <div class="container-cart">
                <div class="heading-label">
                    <h1 class="heading-label-text">Cập nhật thông tin vé</h1>
                    <div class="heading-label-gr">
                        <a href="?select=tour&query=lichsu_chitiet&iddangkytour=<?php echo $iddangkytour ?>"
                            class="heading-label-link"><i class="icon-m heading-label-link-btn ti-back-left"></i></a>
                    </div>
                </div>
                <div class="container-lichsu__form">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col l-8 c-12">
                                <div id="form-ve" class="form-capnhat">
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Mã vé:</span>
                                        <input type="text"
                                            value="<?php echo $ve_chitiet_row['id_dangkytour_chitiet'] ?>"
                                            class="input-df input-df-date container-cart__form-input disabled">
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Họ tên:</span>
                                        <input type="text" name="ten_ve" id="ten_ve"
                                            value="<?php echo $ve_chitiet_row['ten_dangkytour_chitiet'] ?>"
                                            class="input-df container-cart__form-input" required>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Số điện thoại:</span>
                                        <input type="tel" name="sdt_ve" id="sdt_ve" maxlength="10" onkeypress="return isNumberKey(event);"
                                            value="<?php echo $ve_chitiet_row['sdt_dangkytour_chitiet'] ?>"
                                            class="input-df container-cart__form-input" required>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">CCCD/CMND:</span>
                                        <input type="tel" name="cccd_ve" id="cccd_ve" maxlength="12" onkeypress="return isNumberKey(event);"
                                            value="<?php echo $ve_chitiet_row['cccd_dangkytour_chitiet'] ?>"
                                            class="input-df container-cart__form-input" required>
                                    </div>
                                    <div class="form-input container-cart__form-group">
                                        <span class="container-cart__form-label">Giới tính:</span>
                                        <select name="gioitinh_ve"
                                            class="input-df input-df-date container-cart__form-input">
                                            <?php 
                                                if($ve_chitiet_row['gioitinh_dangkytour_chitiet'] == "nam"){
                                                    echo '<option value="nam" checked>Nam</option>
                                                    <option value="nu">Nữ</option>';
                                                }
                                                else{
                                                    echo '<option value="nam">Nam</option>
                                                    <option value="nu" checked>Nữ</option>';
                                                }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-input container-cart__form-group container-cart__form-btn">
                                        <input type="submit" name="capnhat" value="Cập nhật"
                                            class="btn-s container-cart__form-btn-success"></input>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>