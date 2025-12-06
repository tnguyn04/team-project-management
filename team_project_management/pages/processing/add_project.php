<?php
function generateCode($length = 6) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}
$project_code = generateCode(6); 

if(isset($_POST['create-project'])){
    $project_name = $_POST['project-name'];
    $describe = $_POST['describe'];
    $begin = $_POST['begin'];
    $end = $_POST['end'];

    if (!empty($begin) && !empty($end) && strtotime($begin) > strtotime($end)) {
        $message_cr = '<p style="color: red;">Ngày bắt đầu không được lớn hơn ngày kết thúc!</p>';
    } else {
        $begin_sql = empty($begin) ? "NULL" : "'$begin'";
        $end_sql = empty($end) ? "NULL" : "'$end'";
        $sql_create = "INSERT INTO duan(MaDuAn,TenDuAn,MoTa,NgayBatDau,NgayKetThuc,TrangThai,IDLeader,NgayTao) VALUES('".$project_code."','".$project_name."','".$describe."',$begin_sql,$end_sql,0,'".$user_id."',NOW())";
        if(mysqli_query($mysqli, $sql_create)) {
            // Lấy ID dự án vừa tạo
            $new_project_id = mysqli_insert_id($mysqli);
            $sql_group = "INSERT INTO nhom(TenNhom, IDDuAn) VALUES ('$project_name', $new_project_id)";
            mysqli_query($mysqli, $sql_group);
            $new_group_id = mysqli_insert_id($mysqli);
            $sql_group_member = "INSERT INTO thanhviennhom(IDNhom, IDNguoiDung, NgayThamGia) VALUES ($new_group_id, $user_id, NOW())";
            mysqli_query($mysqli, $sql_group_member);
            header("Location: home.php?page=project&tab=leader&id_project=".$new_project_id);
            exit();
        }
    }
}
//
if(isset($_POST['enter-code'])){
    $code = $_POST['invite-code'];

    // Lấy ID dự án + Leader
    $project = mysqli_query($mysqli, "
        SELECT IDDuAn, IDLeader 
        FROM duan 
        WHERE MaDuAn = '$code' 
        LIMIT 1
    ");

    if(mysqli_num_rows($project) > 0){
        $project_row = mysqli_fetch_assoc($project);

        $pid = $project_row['IDDuAn'];
        $leader_id = $project_row['IDLeader'];

        // Kiểm tra xem user là Leader chưa
        if($leader_id == $user_id){
            $message = '<div><p>Bạn đã là leader của dự án này!</p></div>';
        } 
        else {
            // Cho tham gia như bình thường
            mysqli_query($mysqli, "
                INSERT IGNORE INTO thanhvienduan(IDDuAn, IDNguoiDung, TrangThai, NgayThamGia) 
                VALUES($pid, $user_id,'approved', NOW())
            ");
            // Lấy nhóm mặc định của dự án
            $group = mysqli_query($mysqli, "SELECT IDNhom FROM nhom WHERE IDDuAn=$pid LIMIT 1");
            if(mysqli_num_rows($group) > 0){
                $group_row = mysqli_fetch_assoc($group);
                $gid = $group_row['IDNhom'];

                // Thêm user vào nhóm
                mysqli_query($mysqli, "INSERT IGNORE INTO thanhviennhom(IDNhom, IDNguoiDung, NgayThamGia) VALUES ($gid, $user_id, NOW())");
            }
            header("Location: home.php?page=project&tab=member&id_project=".$pid);
            exit();
        }
    } else {
        $message = '<div><p>Mã dự án không đúng!</p></div>';
    }
}
?>