<?PHP
include('../../../config/config.php');
$idtour = $_GET['idtour'];

function  filterData (&$str ) { 
    $str  =  preg_replace ( "/ \ t /" ,  "\\ t" ,  $str ); 
    $str  =  preg_replace ( "/ \ r? \ n /" ,  "\\ n" ,  $str ); 
    if ( strstr ( $str ,  '"' ))  $str  =  '"'  . str_replace ( '"' ,  '" "' ,  $str ).  '"' ; 
}
$fileName  =  "members-data_" .date("d/m/Y"). ".xls" ; 

$fields = array('Tên_NV', 'Phone', 'CCCD', 'Giới tính', 'Tên_Tour', 'Ngày đăng ký', 'Ngày đi', 'Ngày về', 'Quan hệ', 'Thành tiền');
 
// // Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 $excel_dangkytour="SELECT 
 tbl_dangkytour_chitiet.ten_dangkytour_chitiet,
 tbl_dangkytour_chitiet.sdt_dangkytour_chitiet,
 tbl_dangkytour_chitiet.cccd_dangkytour_chitiet,
 tbl_dangkytour_chitiet.gioitinh_dangkytour_chitiet,
 tbl_dangkytour.tentour_dangkytour,
 tbl_dangkytour.ngaydangky_dangkytour, 
 tbl_dangkytour.ngaydi_dangkytour, 
 tbl_dangkytour.ngayve_dangkytour,
 tbl_dangkytour_chitiet.quanhe_dangkytour_chitiet,
 tbl_dangkytour_chitiet.thanhtien_dangkytour_chitiet,
 tbl_dangkytour_chitiet.status_dangkytour_chitiet FROM tbl_dangkytour, tbl_dangkytour_chitiet WHERE tbl_dangkytour_chitiet.id_tourdulich = '".$idtour."' AND tbl_dangkytour.id_tourdulich = '".$idtour."'";
// Tìm nạp bản ghi từ cơ sở dữ liệu 
$query  =  $mysqli -> query ($excel_dangkytour); 
if ( $query -> num_rows  >  0 ) { 
    // Xuất từng hàng dữ liệu 

    while ( $row  =  $query -> fetch_assoc()) 
    { 
        $status  = ($row ['status_dangkytour_chitiet'] ==  1 )?'Active':'Inactive'; 
        $lineData = array(ucfirst($row[ 'ten_dangkytour_chitiet']),$row['sdt_dangkytour_chitiet'],$row['cccd_dangkytour_chitiet'],ucfirst($row ['gioitinh_dangkytour_chitiet' ]),$row ['tentour_dangkytour' ],$row ['ngaydangky_dangkytour' ],$row ['ngaydi_dangkytour' ],$row ['ngayve_dangkytour' ],  ucfirst($row [ 'quanhe_dangkytour_chitiet' ]), number_format($row['thanhtien_dangkytour_chitiet' ])); 
        array_walk ( $lineData ,'filterData' ); 
        $excelData  .=  implode ( "\t" ,array_values($lineData )) ."\n" ; 
    } 
} else { 
    $excelData  .=  'No records found...' . "\ n" ; 
} 
// Tiêu đề cho 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
 
// Kết xuất dữ liệu excel 
echo  $excelData ; 
exit;
?>
