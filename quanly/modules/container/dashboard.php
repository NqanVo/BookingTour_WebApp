<?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $select_tour_dk_nhieunhat = mysqli_query($mysqli,"SELECT * FROM `tbl_tourdulich` WHERE ngaydi_tourdulich >= '".$today."' ORDER BY soluongdadangky_tourdulich DESC LIMIT 5");

    $select_tour_dk_moi = mysqli_query($mysqli,"SELECT * FROM `tbl_tourdulich` ORDER BY id_tourdulich DESC LIMIT 5");

    //select 5 donvi dk nhieu nhat
    $select_dv_dk_nhieunhat = mysqli_query($mysqli,"SELECT * FROM `tbl_thongke_donvi_dangky` ORDER BY sotour_thongke DESC LIMIT 5");
    $sotour_dv_dk = "";
    $donvi_dk = "";
    while($row_donvi_dk = mysqli_fetch_array($select_dv_dk_nhieunhat))
    {
        $ngaythongke = $row_donvi_dk['ngay_thongke'];

        $sotour_dv_dk .= $row_donvi_dk['sotour_thongke'].", ";

        $select_donvi = mysqli_query($mysqli,"SELECT * FROM `tbl_donvi` WHERE id_donvi = '".$row_donvi_dk['id_donvi']."'");
        $row_donvi = mysqli_fetch_array($select_donvi);
        $donvi_dk .= "'".$row_donvi['ten_donvi']."', ";
        
    }  
?>

<div class="content__body__heading">
    <h1 class="content__body__heading-text">Thống kê <i class="fa-solid fa-chart-pie"></i></h1>
</div>
<div class="row content__body__master">
    <div class="col l-12 c-12">
        <p class="content__body__desc">Top 5 Tour đăng ký nhiều nhất:</p>
        <div class="group-top">
            <?php 
                $i = 0;
                while($row = mysqli_fetch_array($select_tour_dk_nhieunhat))
                {
                    $i++;
                    if($i == 1 || $i == 2 || $i == 3){
                        ?>
            <p class="group-top-rank" style="border-color:var(--color-main)"><b><?php echo $i ?></b><a
                    href="?quanly=tour&query=chitiet&idtour=<?php echo $row['id_tourdulich'] ?>"><?php echo $row['ten_tourdulich']?></a>
                <img src="https://flyclipart.com/thumb2/mrnyxxs-profile-760316.png" width="20px" alt=""> <b> Lượt đăng
                    ký: <?php echo $row['soluongdadangky_tourdulich'] ?></b>
            </p>
            <?php
                    }
                    else
                    {
                        ?>
            <p class="group-top-rank"><b><?php echo $i ?></b><a
                    href="?quanly=tour&query=chitiet&idtour=<?php echo $row['id_tourdulich'] ?>"><?php echo $row['ten_tourdulich']?></a>
                <b> Lượt đăng ký: <?php echo $row['soluongdadangky_tourdulich'] ?></b>
            </p>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>

<div class="row content__body__master top-rank">
    <div class="col l-6 c-12 ">
        <p class="content__body__desc">Tour Thêm gần đây:</p>
        <div class="group-top">
            <?php
                while($row_moi = mysqli_fetch_array($select_tour_dk_moi))
                {
                    ?>
            <p class="group-top-rank"><a
                    href="?quanly=tour&query=chitiet&idtour=<?php echo $row_moi['id_tourdulich'] ?>"><?php echo $row_moi['ten_tourdulich']?></a>
            </p>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="col l-6 c-12">
        <p class="content__body__desc">
            5 Đơn vị đăng ký nhiều nhất: 
            <a href="modules/container/thongke.php?reload=1" class="a-defaul icon-s fa-solid fa-rotate" style="cursor:pointer"></a>
            <span style="font-size:1.2rem">Cập nhật gần nhất: <?php echo date("d/m/Y", strtotime($ngaythongke)); ?></span>
        </p>
        <div class="group-top group-top-chart">
            <div class="chart">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>


<script>
const data = {
    labels: [
        <?php
            echo $donvi_dk;
        ?>
    ],
    datasets: [{
        label: 'My First Dataset',

        data: [
            <?php
                echo $sotour_dv_dk;
            ?>
        ],
        backgroundColor: [
            'rgb(255, 105, 105)',
            'rgb(255, 130, 155)',
            'rgb(255, 159, 204)',
            'rgb(255, 191, 251)',
            'rgb(243, 238, 217)',
        ],
        hoverOffset: 4
    }]
};

const config = {
    type: 'pie',
    data: data,
};
</script>

<script>
const myChart = new Chart(
    document.getElementById('myChart'),
    config
);
</script>