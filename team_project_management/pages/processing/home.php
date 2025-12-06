<?php
$sql_prj_public = "SELECT 
        duan.IDDuAn,
        duan.TenDuAn,
        duan.MoTa,
        duancongkhai.YeuCau,
        duancongkhai.NgayTao
    FROM duan
    JOIN duancongkhai
        ON duan.IDDuAn = duancongkhai.IDDuAn
    ORDER BY duancongkhai.NgayTao DESC";
$query_prj_public = mysqli_query($mysqli, $sql_prj_public);

if(isset($_POST['search'])) {
    $key = $_POST['key'];
    $sql_prj_public = "SELECT 
            duan.IDDuAn,
            duan.TenDuAn,
            duan.MoTa,
            duancongkhai.YeuCau,
            duancongkhai.NgayTao
        FROM duan
        JOIN duancongkhai
            ON duan.IDDuAn = duancongkhai.IDDuAn
        WHERE (duan.TenDuAn LIKE '%$key%' OR duan.MoTa LIKE '%$key%')
        ORDER BY duancongkhai.NgayTao DESC";
    $query_prj_public = mysqli_query($mysqli, $sql_prj_public);
}
//
if(isset($_POST['request-join'])) {
    $id_prj_public = $_GET['id_project_public'];
    $sql_request = "INSERT INTO thanhvienduan (IDNguoiDung, IDDuAn, TrangThai)
                    VALUES ($user_id, $id_prj_public, 'pending')";
    mysqli_query($mysqli, $sql_request);
    $message = '<p style="color: #00c060; display: flex; justify-content: center;">Đã gửi yêu cầu!</p>';
}
?>

