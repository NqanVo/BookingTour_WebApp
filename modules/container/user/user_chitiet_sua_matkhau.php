<?php
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }

    if(isset($_POST['capnhat_matkhau']))
    {
        $matkhaucu = md5($_POST['matkhaucu_nhanvien']);
        $matkhaumoi = md5($_POST['matkhaumoi_nhanvien']);
        $re_matkhaumoi = md5($_POST['re_matkhaumoi_nhanvien']);
        
        $sql = "SELECT * from tbl_nhanvien where id_nhanvien ='".$idnv."' and matkhau_nhanvien='".$matkhaucu."' limit 1";
		$row = mysqli_query($mysqli, $sql);
		$count = mysqli_num_rows($row);

		if($count>0)
		{
			if($matkhaumoi == $re_matkhaumoi)
			{
				$sql_update = mysqli_query($mysqli, "UPDATE tbl_nhanvien set matkhau_nhanvien ='".$matkhaumoi."' where id_nhanvien='".$idnv."'");
				echo '<script>window.alert("Đổi mật khẩu thành công!");</script>';			
			}
			else
			{
                echo '<script>window.alert("Mật khẩu mới và nhập lại mật khẩu mới không trùng nhau!");</script>';   
			}

		}
		else
		{
            echo '<script>window.alert("Mật khẩu cũ sai!");</script>';
		}
	}

?>


<div class="grid wide">
    <div class="container">
        <section class="container__content container-user">
            <div class="row no-gutters">
                <div class="col l-12 c-12">
                    <div class="container_information-gr container_information-gruop-btn">


                        <div class="container_information-gruop-btn-gr-right">
                        </div>
                        <div class="container_information-gruop-btn-gr">
                            <a href="?select=user&query=chitiet"
                                class="a-defaul btn-s btn-main container_information-gruop-btn-item"><i
                                    class="ti-back-left"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row no-gutters">
                <div class="col l-6 c-0">
                    <div class="container_information-gr-update-password-bg">
                    </div>
                </div>
                <div class="col l-6 c-12">
                    <div class="container_information-gr container_information-gr-work">
                        <h3 class="container_information-gr-info-heading container_information-gr-info-heading-update">
                            Cập nhật mật khẩu</h3>
                        <form method="POST" action="">
                            <div class="container_information-gr-info-heading-update">
                                <div class="form-input container-cart__form-group">
                                    <span class="container-cart__form-label">Tên nhân viên:</span>
                                    <p><?php echo $nhanvien_row['ten_nhanvien'] ?></p>
                                </div>
                                <div class="form-input container-cart__form-group">
                                    <span class="container-cart__form-label">Mật khẩu cũ:</span>
                                    <input type="password" name="matkhaucu_nhanvien"
                                        class="input-df container-cart__form-input">
                                </div>
                                <div class="form-input container-cart__form-group">
                                    <span class="container-cart__form-label">Mật khẩu mới:</span>
                                    <input type="password" name="matkhaumoi_nhanvien"
                                        class="input-df container-cart__form-input">
                                </div>
                                <div class="form-input container-cart__form-group">
                                    <span class="container-cart__form-label">Nhập lại mật khẩu mới:</span>
                                    <input type="password" name="re_matkhaumoi_nhanvien"
                                        class="input-df container-cart__form-input">
                                </div>
                            </div>

                            <input type="submit" name="capnhat_matkhau" value="Cập nhật" class="btn-m btn-main">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>