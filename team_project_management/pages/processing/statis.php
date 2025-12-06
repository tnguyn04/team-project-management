<?php
$sql_count_prj = "SELECT COUNT(DISTINCT IDDuAn) AS SoDuAn FROM thanhvienduan WHERE IDNguoiDung = $user_id AND TrangThai = 'approved';";
$query_count_prj = mysqli_query($mysqli, $sql_count_prj);
$rows_count_prj = mysqli_fetch_assoc($query_count_prj);
$sql_count_prj2 = "SELECT COUNT(DISTINCT IDDuAn) AS SoDuAn FROM duan WHERE IDLeader = $user_id;";
$query_count_prj2 = mysqli_query($mysqli, $sql_count_prj2);
$rows_count_prj2 = mysqli_fetch_assoc($query_count_prj2);

$sql_count_task = "SELECT COUNT(DISTINCT IDCongViec) AS SoCongViec FROM congviec WHERE IDNguoiDung = $user_id;";
$query_count_task = mysqli_query($mysqli, $sql_count_task);
$rows_count_task = mysqli_fetch_assoc($query_count_task);

$sql_count_rating = "SELECT ROUND(AVG(cvdn.DanhGia), 1) AS DiemTrungBinh FROM congviecdanop cvdn JOIN congviec cv ON cvdn.IDCongViec = cv.IDCongViec WHERE cv.IDNguoiDung = $user_id;";
$query_count_rating = mysqli_query($mysqli, $sql_count_rating);
$rows_count_rating = mysqli_fetch_assoc($query_count_rating);
//

$done = 0;
$doing = 0;
$late  = 0;

$sql_statis = "SELECT TrangThai FROM congviec WHERE IDNguoiDung = $user_id";
$query_statis = mysqli_query($mysqli, $sql_statis);

while($row_statis = mysqli_fetch_assoc($query_statis)) {
    if (is_null($row_statis['TrangThai'])) {
        $doing++;
    } elseif ($row_statis['TrangThai'] == 1) {
        $done++;
    } elseif ($row_statis['TrangThai'] == 0) {
        $late++;
    }
}

// Xuất ra dạng JSON để dùng trong JS
$chartData = [$done, $doing, $late];

//
$years = [2021, 2022, 2023, 2024, 2025];
$dataByYear = [];

foreach ($years as $y) {
    $sql = "SELECT COUNT(DISTINCT c.IDCongViec) AS SoCongViec
            FROM congviec c
            JOIN congviecdanop d ON d.IDCongViec = c.IDCongViec
            WHERE c.TrangThai = 1
              AND c.IDNguoiDung = $user_id
              AND YEAR(d.NgayNop) = $y";  // <-- quan trọng

    $res = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($res);
    $dataByYear[] = (int)$row['SoCongViec'];
}





