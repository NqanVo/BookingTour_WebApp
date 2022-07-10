<?php 
$donvi_select = "SELECT * FROM tbl_donvi";
$donvi_query = mysqli_query($mysqli, $donvi_select);

$diadiem_select = "SELECT DISTINCT diadiem_tourdulich FROM tbl_tourdulich ORDER BY diadiem_tourdulich";
$diadiem_query = mysqli_query($mysqli, $diadiem_select);

?>


<!-- tim kiem  -->
<form action="index.php?select=tour&query=timkiem" method="POST">
    <div class="grid wide">
        <div class="container">
            <section class="container__content">
                <div class="content__body-search">
                    <div class="form-control">
                        <input type="text" name="keyword" placeholder="Nhập tên tour..." class="form-control-input">
                        <span class="form-control-label">Đơn vị:</span>
                        <select name="donvi" class="form-control-select">
                            <option value="-1">------</option>
                            <option value="0">Tất cả</option>
                            <?php
                            while($donvi_row = mysqli_fetch_array($donvi_query))
                            {
                            ?>
                            <option value="<?php echo $donvi_row['id_donvi']?>"><?php echo $donvi_row['ten_donvi']?>
                            </option>
                            <?php 
                            } 
                            ?>
                        </select>

                        <span class="form-control-label">Địa điểm:</span>
                        <select name="diadiem" class="form-control-select">
                            <option value="0">Tất cả</option>
                            <?php
                            while($diadiem_row = mysqli_fetch_array($diadiem_query))
                            {
                            ?>
                            <option value="<?php echo $diadiem_row['diadiem_tourdulich']?>">
                                <?php echo $diadiem_row['diadiem_tourdulich']?>
                            </option>
                            <?php 
                            } 
                            ?>
                        </select>

                        <button type="submit" name="timkiem" class="form-control-btn"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</form>