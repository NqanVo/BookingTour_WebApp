<?php
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }
?>

<div class="grid wide">
    <div class="row">
        <div class="col l-12 c-12">
            <div class="container-cart">
                <div class="container-cart-status">
                    <div class="arrow-steps clearfix">
                        <div class="step done"><span><a href="">Giỏ Hàng</a></span> </div>
                        <div class="step done"> <span><a href="#">Kiểm Tra</a></span> </div>
                        <div class="step current"> <span><a href="#">Hoàn Thành</a><span> </div>
                    </div>
                </div>

                <div class="container-cart-done">
                    <h3>Đặt Vé Thành Công <i class="fa-solid fa-check"></i></h3>
                    <p>Chúc bạn có chuyến đi vui vẻ</p>
                    <img src="./assets/img/bg-payment-done.jpg" alt="" class="container-cart-done-img">
                    <a href="?" class="a-defaul btn-m btn-main">Hoàn Thành</a>
                </div>
                
            </div>
        </div>
    </div>
</div>