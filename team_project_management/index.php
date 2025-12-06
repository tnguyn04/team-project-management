<?php
session_start();
include('././config/config.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql_login = "SELECT IDNguoiDung, email FROM nguoidung WHERE email = '$email' AND MatKhau = '$password' LIMIT 1";
    $result = mysqli_query($mysqli, $sql_login);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Lưu ID và email vào session
        $_SESSION['login'] = $row['email'];
        $_SESSION['user_id'] = $row['IDNguoiDung']; // Lấy ID người dùng

        header("Location: ././home.php");
    } else {
        $message = '<span style="color: red; font-size: 1rem; display: flex; margin-top: 10px; margin-bottom: 10px; justify-content: center; ">Email hoặc mật khẩu không đúng!</span>';
    }
}
                            
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập/Đăng ký</title>
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    
    <div class="app">
        <?php 
        include('pages/main.php');
        ?>     
    </div>     
</body>
</html>