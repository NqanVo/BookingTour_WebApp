<?php
include('../../../config/config.php');

function output_file($source_file, $download_name, $mime_type='')
{
    if(!is_readable($source_file)) die('Không tìm thấy tệp hoặc không thể truy cập!');
    $size = filesize($source_file);
    $download_name = rawurldecode($download_name);
    /* Chỉ ra loại MIME (nếu không được chỉ định) */
    $known_mime_types=array(
        "pdf" => "application/pdf",
        // "csv" => "application/csv",
        // "txt" => "text/plain",
        // "html" => "text/html",
        // "htm" => "text/html",
        // "exe" => "application/octet-stream",
        // "zip" => "application/zip",
        // "doc" => "application/msword",
        // "xls" => "application/vnd.ms-excel",
        // "ppt" => "application/vnd.ms-powerpoint",
        // "gif" => "image/gif",
        // "png" => "image/png",
        // "jpeg"=> "image/jpg",
        // "jpg" =>  "image/jpg",
        // "php" => "text/plain"
    );
    if($mime_type==''){
        $file_extension = strtolower(substr(strrchr($source_file,"."),1));
        if(array_key_exists($file_extension, $known_mime_types)){
            $mime_type=$known_mime_types[$file_extension];
        } else {
            $mime_type="application/force-download";
        };
    };
    @ob_end_clean(); //Tắt bộ đệm đầu ra để giảm mức sử dụng Máy chủ
    // if IE, otherwise Content-Disposition ignored
    if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');
    header('Content-Type: ' . $mime_type);
    header('Content-Disposition: attachment; filename="'.$download_name.'"');
    header("Content-Transfer-Encoding: binary");
    header('Accept-Ranges: bytes');
    header("Cache-control: private");
    header('Pragma: private');
    header("Expires: Thu, 26 May 2021 05:00:00 GMT");
    // Hỗ trợ tải xuống nhiều phần và tải xuống
    if(isset($_SERVER['HTTP_RANGE']))
    {
        list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
        list($range) = explode(",",$range,2);
        list($range, $range_end) = explode("-", $range);
        $range=intval($range);
        if(!$range_end) {
            $range_end=$size-1;
        } else {
            $range_end=intval($range_end);
        }
        $new_length = $range_end-$range+1;
        header("HTTP/1.1 206 Partial Content");
        header("Content-Length: $new_length");
        header("Content-Range: bytes $range-$range_end/$size");
    } else {
        $new_length=$size;
        header("Content-Length: ".$size);
    }
    /* Xuất tệp tin */
    $chunksize = 1*(1024*1024); //you may want to change this
    $bytes_send = 0;
    if ($source_file = fopen($source_file, 'r'))
    {
        if(isset($_SERVER['HTTP_RANGE']))
        fseek($source_file, $range);
        while(!feof($source_file) &&
            (!connection_aborted()) &&
            ($bytes_send < $new_length)
            )
        {
            $buffer = fread($source_file, $chunksize);
            print($buffer); //echo($buffer); // is also possible
            flush();
            $bytes_send += strlen($buffer);
        }
    fclose($source_file);
    } else die('Lỗi - không thể mở tệp.');
    die();
}

if(isset($_GET['hdsd'])){
    $file = 'hdsd.docx';
    $pdf='hdsd/'.$file;
    set_time_limit(0);
    $file_path="hdsd/$file";
    output_file($file_path, "$file", 'application/pdf');
}
elseif(isset($_GET['hdsdadmin'])){
    $file = 'hdsdadmin.docx';
    $pdf='hdsdadmin/'.$file;
    set_time_limit(0);
    $file_path="hdsdadmin/$file";
    output_file($file_path, "$file", 'application/pdf');
}
?>