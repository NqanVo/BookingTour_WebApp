<div class="container">
    <div class="row no-gutters">
        <?php include('container/navbar_container.php') ?>
        <div class="col l-10 c-12">
            <section class="content">
                <section class="content__body">
                    <?php 
                        if(isset($_GET['quanly']) && $_GET['query'])
                        {
                            $quanly = $_GET['quanly'];
                            $query = $_GET['query'];
                        }
                        else
                        {
                            $quanly= '';
                            $query = '';
                        }
                        // Quan ly don vi
                        if($quanly=='donvi' && $query=='danhsach')
                        {
                            include('container/quanly_donvi/donvi_danhsach.php');
                        }
                        elseif($quanly=='donvi' && $query=='them'){
                            include('container/quanly_donvi/donvi_them.php');
                        }
                        elseif($quanly=='donvi' && $query=='sua'){
                            include('container/quanly_donvi/donvi_sua.php');
                        }
                        elseif($quanly=='donvi' && $query=='xoa'){
                            include('container/quanly_donvi/donvi_xoa.php');
                        }

                        // Quan ly phong ban
                        elseif($quanly=='phongban' && $query=='danhsach'){
                            include('container/quanly_phongban/phongban_danhsach.php');
                        }
                        elseif($quanly=='phongban' && $query=='them'){
                            include('container/quanly_phongban/phongban_them.php');
                        }
                        elseif($quanly=='phongban' && $query=='xoa'){
                            include('container/quanly_phongban/phongban_xoa.php');
                        }
                        elseif($quanly=='phongban' && $query=='sua'){
                            include('container/quanly_phongban/phongban_sua.php');
                        }

                        // Quan ly nhan vien
                        elseif($quanly=='nhanvien' && $query=='danhsach'){
                            include('container/quanly_nhanvien/nhanvien_danhsach.php');
                        }
                        elseif($quanly=='nhanvien' && $query=='them'){
                            include('container/quanly_nhanvien/nhanvien_them.php');
                        }
                        elseif($quanly=='nhanvien' && $query=='sua'){
                            include('container/quanly_nhanvien/nhanvien_sua.php');
                        }
                        elseif($quanly=='nhanvien' && $query=='suamatkhau'){
                            include('container/quanly_nhanvien/nhanvien_suamatkhau.php');
                        }
                        elseif($quanly=='nhanvien' && $query=='chitiet'){
                            include('container/quanly_nhanvien/nhanvien_chitiet.php');
                        }

                        // Quan ly tour
                        elseif($quanly=='tour' && $query=='danhsach'){
                            include('container/quanly_tour/tour_danhsach.php');
                        }
                        elseif($quanly=='tour' && $query=='chitiet'){
                            include('container/quanly_tour/tour_chitiet.php');
                        }
                        elseif($quanly=='tour' && $query=='download'){
                            include('container/quanly_tour/tour_download_chitiet.php');
                        }
                        elseif($quanly=='tour' && $query=='them'){
                            include('container/quanly_tour/tour_them.php');
                        }
                        elseif($quanly=='tour' && $query=='xoa'){
                            include('container/quanly_tour/tour_xoa.php');
                        }
                        elseif($quanly=='tour' && $query=='sua'){
                            include('container/quanly_tour/tour_sua.php');
                        }
                        elseif($quanly=='tour' && $query=='danhsachdangky'){
                            include('container/quanly_tour/tour_danhsach_dangky.php');
                        }
                        elseif($quanly=='tour' && $query=='danhsachdangky_chitiet'){
                            include('container/quanly_tour/tour_dangky_chitiet.php');
                        }
                        elseif($quanly=='tour' && $query=='danhsachdangky_chitiet_nguoithan'){
                            include('container/quanly_tour/tour_dangky_chitiet_nguoithan.php');
                        }
                        elseif($quanly=='tour' && $query=='timkiem'){
                            include('container/quanly_tour/tour_timkiem.php');
                        }

                        // Quan ly ho tro kinh phi
                        elseif($quanly=='hotrokinhphi' && $query=='danhsach'){
                            include('container/quanly_hotrokinhphi/hotro_danhsach.php');
                        }
                        elseif($quanly=='hotrokinhphi' && $query=='them'){
                            include('container/quanly_hotrokinhphi/hotro_them.php');
                        }
                        elseif($quanly=='hotrokinhphi' && $query=='capnhat'){
                            include('container/quanly_hotrokinhphi/hotro_sua.php');
                        }
                        elseif($quanly=='hotrokinhphi' && $query=='chitiet'){
                            include('container/quanly_hotrokinhphi/hotro_danhsach_chitiet.php');
                        }
                        elseif($quanly=='hotrokinhphi' && $query=='chitietnhanhotro'){
                            include('container/quanly_hotrokinhphi/hotro_danhsach_danhanhotro.php');
                        }
                        elseif($quanly=='hotrokinhphi' && $query=='them_thamnien'){
                            include('container/quanly_hotrokinhphi/hotro_them_thamnien.php');
                        }
                        elseif($quanly=='hotrokinhphi' && $query=='capnhatthamnien'){
                            include('container/quanly_hotrokinhphi/hotro_sua_thamnien.php');
                        }
                        else{
                            include('container/dashboard.php');
                        }
                    ?>
                </section>
            </section>
        </div>
    </div>
</div>