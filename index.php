<?php
session_start();
include "models/pdo.php";
include "models/sanpham.php";
include "models/taikhoan.php";
include "views/header.php";

// thực hiện chức năng 
if(isset($_GET['page'])){
    $page=$_GET['page'];
    switch($page){
        case'shop':
            include "views/shop.php";
        break;

        case'gioithieu':
            include "views/gioithieu.php";
        break;
        case'lienhe':
            include "views/lienhe.php";
        break;
        case'chitiet':
            if($_GET['id']){
                $id =$_GET['id'];
                $one_sp = load_one_sp($id);
            }
            include "views/chitiet.php";    
        break;
        case'login':
            
            if(isset($_POST['dangnhap_btn'])){
                $user = $_POST['username'];
                $password = $_POST['password'];
                $check = check_tk($user,$password);
                extract($check);
                if($user == $check['user']  && $password = $check['password']){
                    $_SESSION['name'] = check_tk($user,$password);
                    if($vaitro  == 0){
                        header('Location:index.php');
                    }elseif($vaitro == 1){
                        header('Location:admin/index.php');
                    }

                   
                }
            }
            include "views/login.php";
        break;
        case'dangky':
            include "views/dangky.php";
        break;
        case'dangxuat':
          if($_SESSION['name']){
            unset($_SESSION['name']);
          }
          header('Location:index.php');
        break;
        //giu nguyen
        default;
        $danh_sach = show_all_sp();
        include "views/home.php";
        break;
    }
}else{
    $danh_sach = show_all_sp();
    include "views/home.php";
}


include "views/footer.php";
?>