<?php
    if(!isset($_SESSION['user_login']))
    {
        header('Location:index.php');
    }

    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $tour_liked_select = mysqli_query($mysqli,"SELECT * FROM tbl_tourdulich_liked WHERE id_nhanvien = '".$idnv."'");
?>



<div class="grid wide">
    <div class="row">
        <div class="col l-12 c-12">
            <div class="container-cart">
                <div class="heading-label">
                    <h1 class="heading-label-text">Danh sách tour yêu thích</h1>
                    <div class="heading-label-gr">
                        <a href="?" class="heading-label-link"><i
                                class="icon-m heading-label-link-btn ti-back-left"></i></a>
                    </div>
                </div>
                <!-- <div class="container-history__group">
                    <h3>Danh sách tour đang diễn ra</h3>
                </div> -->
                <div class="container-history">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <td>Yêu thích</td>
                                <td>Hình ảnh</td>
                                <td>Tên tour</td>
                                <td>Giá Vé</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($tour_liked_row = mysqli_fetch_array($tour_liked_select))
                                {
                                    $id_tour = $tour_liked_row['id_tourdulich'];
                                    $tour_query = mysqli_query($mysqli, "SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$id_tour."'");
                                    $tour_row = mysqli_fetch_array($tour_query);
                                    
                            ?>
                            <tr>
                                <td><a href="modules/container/tour/tour_like_xuly.php?select=unlike&idtour=<?php echo $tour_row['id_tourdulich']?>" style="font-size:2rem;"><i class="error-txt fa-solid fa-heart"></i></a></td>
                                <td><img src="quanly/modules/container/quanly_tour/uploads/<?php echo $tour_row['img_tourdulich'] ?>"
                                            class="" width="200px" height="100px"></img></td>
                                <td><a href="?select=tour&query=chitiet&idtour=<?php echo $tour_row['id_tourdulich'] ?>" class="a-defaul-link"><?php echo $tour_row['ten_tourdulich'] ?></a></td>
                                <td><?php echo number_format($tour_row['gia_tourdulich'],0,',',',') ?>đ</td>
                            </tr>
                            <?php
                                    }
                                
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>