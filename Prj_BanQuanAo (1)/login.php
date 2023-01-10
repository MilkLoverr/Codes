<?php
//Khai báo sử dụng session
session_start();
 
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
 
//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) 
{
    //Kết nối tới database
    include('./config/db.php');
     
    //Lấy dữ liệu nhập vào
    $username = addslashes($_POST['txtUsername']);
    $password = addslashes($_POST['txtPassword']);
     
    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$username || !$password) {
        echo '<script>  alert("Vui Lòng Nhập Tên Đăng Nhập Hoặc Mật Khẩu");
        window.location.href="login.php";   
        </script>';
        
        exit;
    }
     
    // mã hóa pasword
    $password = md5($password);
     
    //Kiểm tra tên đăng nhập có tồn tại không
    $query = $connect->query("SELECT username, password FROM member WHERE username='$username'");
    if (mysqli_num_rows($query) == 0) {
        echo '<script>  alert("Tên Đăng Nhập Không Đúng");
        window.location.href="login.php";    
        </script>';
        
        exit;
    }
     
    //Lấy mật khẩu trong database ra
    $row = mysqli_fetch_array($query);
     
    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['password']) {
        echo '<script>  alert("Nhập Sai Mật Khẩu Vui Lòng Nhập lại"); 
        window.location.href="login.php";   
        </script>';
          
        exit;
    }
     
    //Lưu tên đăng nhập
    $_SESSION['username'] = $username;
    if ($username == "admin")
        echo '<script>  alert("Bạn đã đăng nhập thành công. "); 
        window.location.href="./dssp.php";   
        </script>';
    else
        echo '<script>  alert("Bạn đã đăng nhập thành công. Không Có Quyền Lực admin nên sẽ quay về trang chủ "); 
        window.location.href="trangChu.html";   
        </script>';
         
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css\login.css">
</head>

<body>
    <header class="sticky">
        <div class="logo"><img src="images\logo1.png" alt="" class="anh"></div>

        <div class="giuaTren">
            <li><a href="index.html">Trang Chủ</a></li>
            <div class="dropdown">
                <li>Cửa hàng</li>
            </div>
            <li><a href="">Giới thiệu</a></li>
            <li><a href="">Tin tức</a></li>
        </div>
        <div class="phaiTren">
            <li><a href="login.php" class="btnDangNhap">Đăng nhập</a></li>
            <li><button  onclick="window.location.href='./dangkytk.html'"  class="btnThietKe">Đăng ký</button></li>
            <li>
                <p class=shopinglogo><i class="fa fa-shopping-basket" aria-hidden="true"></i></p>
            </li>
        </div>
    </header>
    <!-- ==================================================== -->
    <div class="tong">
        <div class="login">
            <div class="imgLogin">
                <img src="images/thumnailLogin.png" alt="">
            </div>
            <div class="formLogin">
                <form action='login.php?do=login' method='POST'>
                    <label for="">Đăng nhập</label>
                    <div class="User">
                        <input type="text" name="txtUsername" placeholder="Username" size="30" class="inputUser">
                        <input type="password" name="txtPassword" id="" placeholder="Password" size="30" class="inputUser">
                        <input type="submit" name="dangnhap" value="Đăng nhập" class="btnSubmit">
                    </div>
                </form>
            </div>
        </div>
        <!-- endLINE -->
        <div class="endline">
            <div class="Contentend">
                <div class="sellerContent">
                    <ul>
                        <a href="" class="spacing1">Seller</a>
                        <li>
                            <a href="" class="spacing">Hướng dẫn mở bán</a>
                        </li>
                        <li>
                            <a href="" class="spacing">Thiết kế ngay</a>
                        </li>
                        <li>
                            <a href="" class="spacing">FAQs</a>
                        </li>
                    </ul>
                </div>
                <div class="AboutContent">
                    <ul>
                        <a href="" class="spacing1">About us</a>
                        <li>
                            <a href="" class="spacing">Facebook</a>
                        </li>
                        <li>
                            <a href="" class="spacing">Telegram</a>
                        </li>
                        <li>
                            <a href="" class="spacing">liên hệ bằng Zalo</a>
                        </li>
                    </ul>
                </div>
                <div class="dadangky">
                    <img src="images/dadangky.png" alt="">
                </div>
            </div>
        </div>
    </div>
 
