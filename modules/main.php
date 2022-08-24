<?php

    if(isset($_GET['select']) && $_GET['query']){
        $select = $_GET['select'];
        $query = $_GET['query'];
    }
    else{
        $select = '';
        $query = '';
    }
    
    if($select == 'dangnhap' && $query == '1'){
        include('container/login/sign_in.php');
    }
    // tour
        elseif($select == 'tour' && $query == 'likedall'){
            include('container/tour/tour_liked_danhsach.php');
        }
        elseif($select == 'tour' && $query == 'timkiem'){
            include('container/search/timkiem.php');
            include('container/search/timkiem_ketqua.php');
        }
        elseif($select == 'tour' && $query == 'danhsach'){
            include('container/search/timkiem.php');
            include('container/tour/tour_all.php');
        }
        elseif($select == 'tour' && $query == 'moiall'){
            include('container/search/timkiem.php');
            include('container/tour/tour_moiall.php');
        }
        elseif($select == 'tour' && $query == 'donviall'){
            include('container/search/timkiem.php');
            include('container/tour/tour_donviall.php');
        }
        elseif($select == 'tour' && $query == 'chitiet'){
            include('container/tour/tour_chitiet.php');
        }
        elseif($select == 'tour' && $query == 'dattour'){
            include('container/tour/tour_dattour.php');
        }
        elseif($select == 'tour' && $query == 'thanhtoan'){
            include('container/tour/tour_thanhtoan.php');
        }
        elseif($select == 'tour' && $query == 'hoanthanh'){
            include('container/tour/tour_hoanthanh.php');
        }
        elseif($select == 'tour' && $query == 'lichsu'){
            include('container/tour/tour_lichsu.php');
        }
        elseif($select == 'tour' && $query == 'lichsu_chitiet'){
            include('container/tour/tour_lichsu_chitiet.php');
        }
        elseif($select == 'tour' && $query == 'lichsu_chitiet_capnhat'){
            include('container/tour/tour_lichsu_chitiet_capnhat.php');
        }
        elseif($select == 'tour' && $query == 'lichsu_chitiet_themve'){
            include('container/tour/tour_lichsu_chitiet_themve.php');
        }
    
    //user
        elseif($select == 'user' && $query == 'chitiet'){
            include('container/user/user_chitiet.php');
        }elseif($select == 'user' && $query == 'capnhatinfo'){
            include('container/user/user_chitiet_sua_thongtin.php');
        }
        elseif($select == 'user' && $query == 'capnhatmk'){
            include('container/user/user_chitiet_sua_matkhau.php');
        }
        else{
        include('container/banner/banner.php');
        include('container/search/timkiem.php');
        include('container/tour/tour_index.php');
    }



?>