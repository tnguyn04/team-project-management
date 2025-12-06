<?php
include('config.php'); // đảm bảo $mysqli được định nghĩa


if (isset($_POST['post-public'])) {
    $request_desc = $_POST['request-desc'];
    $sql_post = "UPDATE duan SET CongKhai = 1, TuyenThanhVien = '$request_desc' WHERE IDDuAn = $id_project";
    mysqli_query($mysqli,$sql_post);
  
    exit; // NGĂN load cả HTML trang → tránh reload
}