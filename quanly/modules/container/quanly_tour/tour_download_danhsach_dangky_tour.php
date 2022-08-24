<?PHP
include('../../../config/config.php');
$idtour = $_GET['idtour'];

$fileName  =  "members-data_" .date("d/m/Y"). ".xls" ; 
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\""); 

    //select all nguoithamgia
    $excel_dangkytour="SELECT * FROM `tbl_dangkytour_chitiet` WHERE id_tourdulich = '".$idtour."' AND status_dangkytour_chitiet = '1'";
    $excel_query=mysqli_query($mysqli,$excel_dangkytour);

    //select thongtin tour
    $select_tour = mysqli_query($mysqli,"SELECT * FROM tbl_tourdulich WHERE id_tourdulich = '".$idtour."'");
    $row_tour = mysqli_fetch_array($select_tour);

    $doa1=$row_tour['ten_tourdulich'];
    $tentour = "Tên Tour: ".$doa1;

    $array1 = array ( $doa1);
    $unique1 = array();

    foreach($array1 as $v1){
    isset($k1[$v1]) || ($k1[$v1]=1) && $unique1[] = $v1;
    }

?>

<br>
<table border='2px' cellspacing="1" cellpadding="2">
    <tr>
        <th colspan="9" style="width:2%;font-style: normal;font-family:Arial;font-weight: 600; ">
            <?php  echo $tentour ?></th>
    </tr>
    <tr>
        <th style="width:2%;font-style: normal;font-family:Arial; ">STT</th>
        <th style="width:15%;font-style: normal;font-family:Arial; ">Tên_NV</th>
        <th style="width:10%;font-style: normal;font-family:Arial; ">Phone</th>
        <th style="width:10%;font-style: normal;font-family:Arial; ">CCCD</th>
        <th style="width:8%;font-style: normal;font-family:Arial; ">Giới tính</th>
        <!-- <th style="width:20%;font-style: normal;font-family:Arial; ">Tên_Tour</th> -->
        <!-- <th style="width:10%;font-style: normal;font-family:Arial; ">Ngày đăng ký</th> -->
        <th style="width:10%;font-style: normal;font-family:Arial; ">Ngày đi</th>
        <th style="width:10%;font-style: normal;font-family:Arial; ">Ngày về</th>
        <th style="width:10%;font-style: normal;font-family:Arial; ">Quan hệ</th>
        <th style="width:10%;font-style: normal;font-family:Arial; ">Thành tiền</th>
    </tr>


    <?php 
  

  $i=0;
  while($row=mysqli_fetch_array($excel_query)){
    $i++;

  ?>

    <tr>

        <td style="width:2%;font-family:Arial; font-style: normal;"><?php echo $i;?></td>
        <td style="width:15%;font-family:Arial; font-style: normal;">
            <?php echo ucfirst($row['ten_dangkytour_chitiet']);?></td>
        <td style="width:10%;font-family:Arial; font-style: normal; "><?php echo $row['sdt_dangkytour_chitiet'];?></td>
        <td style="width:10%;font-family:Arial; font-style: normal; "><?php echo $row['cccd_dangkytour_chitiet'];?></td>
        <td style="width:8%;font-family:Arial; font-style: normal; ">
            <?php echo ucfirst($row['gioitinh_dangkytour_chitiet']);?></td>
        <!-- <td style="width:20%;font-family:Arial; font-style: normal;border: 0px hidden; white; " ><?php print_r(implode($unique));?></td>  -->
        <!-- <td style="width:5%;font-family:Arial; font-style: normal; "><?php echo $row['ngaydangky_dangkytour'];?></td> -->
        <td style="width:10%;font-family:Arial; font-style: normal; "><?php echo $row_tour['ngaydi_tourdulich'];?></td>
        <td style="width:10%;font-family:Arial; font-style: normal; "><?php echo $row_tour['ngayve_tourdulich'];?></td>
        <td style="width:10%;font-family:Arial; font-style: normal; "><?php echo $row['quanhe_dangkytour_chitiet'];?>
        </td>
        <td style="width:10%;font-family:Arial; font-style: normal; ">
            <?php echo  number_format($row['thanhtien_dangkytour_chitiet' ]);?></td>
    </tr>

    <?php

}?>
</table>
<?php
mysqli_close( $mysqli);
?>