<?php
session_start();
include('config/config.php');
$user_id = $_SESSION['user_id'];
if(!isset($_SESSION['login'])){
    header('Location:index.php');
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

<?php
// foreach (glob("pages/processing/*.php") as $filename) {
//     include $filename;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng quan</title>
    
    <link href='https://cdn.boxicons.com/3.0.3/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap' rel='stylesheet'>
    <link rel="stylesheet" href="font/fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="app">
        <?php include('pages/sidebar.php'); ?>
        <section id="content">
            <?php include('pages/navbar.php'); ?>
            <main><?php include('pages/navbar_menu.php'); ?>
                <?php include('pages/main2.php'); ?>
            </main>
            
        </section>
    
        
    </div> 
    
</body>
</html>

<script src="js/sidebar.js"></script>

