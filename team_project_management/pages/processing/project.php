<?php
// --- Thành viên (Member) ---
$sql_member = "
    SELECT d.IDDuAn, d.TenDuAn, d.MoTa, d.TrangThai
    FROM duan d
    JOIN thanhvienduan t ON d.IDDuAn = t.IDDuAn
    WHERE t.IDNguoiDung = $user_id
    AND d.TrangThai = 0
    AND t.TrangThai = 'approved'
    ORDER BY d.IDDuAn DESC
";
$member_projects = $mysqli->query($sql_member);

// --- Trưởng nhóm ---
$sql_leader = "
    SELECT d.IDDuAn, d.TenDuAn, d.MoTa, d.TrangThai
    FROM duan d
    WHERE d.IDLeader = $user_id
    AND d.TrangThai = 0
    ORDER BY d.IDDuAn DESC
";
$leader_projects = $mysqli->query($sql_leader);

// --- Hoàn thành ---
$sql_complete = "
    SELECT d.IDDuAn, d.TenDuAn, d.MoTa
    FROM duan d
    LEFT JOIN thanhvienduan t ON d.IDDuAn = t.IDDuAn
    WHERE (d.IDLeader = $user_id OR t.IDNguoiDung = $user_id) AND d.TrangThai = 1
    GROUP BY d.IDDuAn
    ORDER BY d.IDDuAn DESC
";
$complete_projects = $mysqli->query($sql_complete);

?>