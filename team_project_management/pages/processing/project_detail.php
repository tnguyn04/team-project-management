<?php
//
if(isset($_POST['edit-prj-save'])){
    $project_name = $_POST['project-name'];
    $description = $_POST['description'];
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $start_sql = empty($start_date) ? "NULL" : "'$start_date'";
    $end_sql = empty($end_date) ? "NULL" : "'$end_date'";
    $status = $_POST['status'];
    $sql_update_prj = "UPDATE duan SET 
                        TenDuAn = '$project_name',
                        MoTa = '$description',
                        NgayBatDau = $start_sql,
                        NgayKetThuc = $end_sql,
                        TrangThai = $status
                        WHERE IDDuAn = $id_project";
    mysqli_query($mysqli,$sql_update_prj);
}

//

if (isset($_POST['notify-post'])) {
    $content = mysqli_real_escape_string($mysqli, $_POST['content']);
    $id_notify = !empty($_POST['id_notify']) ? intval($_POST['id_notify']) : 0; // 0 = tạo mới

    // --- Folder upload ---
    $upload_dir = "files/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_names = []; // mảng lưu tên file đã upload

    // --- Xử lý nhiều file upload ---
    if (!empty($_FILES['files']['name'][0])) {
        foreach ($_FILES['files']['name'] as $key => $name) {
            $tmp_name = $_FILES['files']['tmp_name'][$key];
            $safe_name = basename($name); // tránh trùng tên + path injection
            if (move_uploaded_file($tmp_name, $upload_dir . $safe_name)) {
                $file_names[] = $safe_name;
            }
        }
    }

    // --- Nếu là sửa, giữ file cũ còn lại ---
    if ($id_notify) {
        // Lấy file cũ còn lại từ hidden input (JS phải gửi danh sách file cũ)
        $existing_files = !empty($_POST['existing_files']) ? $_POST['existing_files'] : [];
        $file_names = array_merge($existing_files, $file_names);

        $file_names_str = !empty($file_names) ? implode(',', $file_names) : NULL;

        // Update
        $sql = "
            UPDATE thongbao
            SET NoiDung='$content', TepDinhKem=" . ($file_names_str ? "'$file_names_str'" : "NULL") . "
            WHERE IDThongBao=$id_notify
        ";
    } else {
        // Tạo mới
        $file_names_str = !empty($file_names) ? implode(',', $file_names) : NULL;

        $sql = "
            INSERT INTO thongbao(NoiDung, TepDinhKem, NgayTao, IDDuAn, IDNguoiDung)
            VALUES ('$content', " . ($file_names_str ? "'$file_names_str'" : "NULL") . ", NOW(), $id_project, $user_id)
        ";
    }

    mysqli_query($mysqli, $sql);

    // --- Redirect để tránh resubmit ---
    echo "<meta http-equiv='refresh' content='0'>";
}




//get list member
if (isset($_GET['id_project'])) {
    $sql_member = "SELECT nd.IDNguoiDung, nd.Ten, nd.MoTa, nd.AnhDaiDien, nd.Email, ROUND(AVG(cvdn.DanhGia), 1) AS TrungBinhRating
                FROM thanhvienduan tvd
                JOIN nguoidung nd ON tvd.IDNguoiDung = nd.IDNguoiDung
                LEFT JOIN congviec cv ON cv.IDNguoiDung = nd.IDNguoiDung
                LEFT JOIN congviecdanop cvdn
                ON cvdn.IDCongViec = cv.IDCongViec

                WHERE tvd.IDDuAn = $id_project
                AND tvd.TrangThai = 'approved'
                GROUP BY nd.IDNguoiDung, nd.Ten, nd.MoTa";
    $query_member = mysqli_query($mysqli, $sql_member);
    $members = [];
    while($row = mysqli_fetch_assoc($query_member)){
        $members[] = $row;
    }


    $sql_member_pending = "SELECT nd.IDNguoiDung, nd.Ten, nd.MoTa, nd.AnhDaiDien, nd.Email, ROUND(AVG(cvdn.DanhGia), 1) AS TrungBinhRating
                FROM thanhvienduan tvd
                JOIN nguoidung nd ON tvd.IDNguoiDung = nd.IDNguoiDung
                LEFT JOIN congviec cv ON cv.IDNguoiDung = nd.IDNguoiDung
                LEFT JOIN congviecdanop cvdn
                ON cvdn.IDCongViec = cv.IDCongViec
                WHERE tvd.IDDuAn = $id_project
                AND tvd.TrangThai = 'pending'
                GROUP BY nd.IDNguoiDung, nd.Ten, nd.MoTa";
    $query_member_pending = mysqli_query($mysqli, $sql_member_pending);

    $sql_leader = "SELECT nd.Ten, nd.MoTa, nd.AnhDaiDien, nd.Email, ROUND(AVG(cvdn.DanhGia), 1) AS TrungBinhRating
                FROM duan d
                JOIN nguoidung nd ON d.IDLeader = nd.IDNguoiDung
                LEFT JOIN congviec cv ON cv.IDNguoiDung = d.IDLeader
                LEFT JOIN congviecdanop cvdn
                ON cvdn.IDCongViec = cv.IDCongViec
                WHERE d.IDDuAn = $id_project
                GROUP BY nd.Ten, nd.MoTa;";

    $query_leader = mysqli_query($mysqli, $sql_leader);
    $row_leader = mysqli_fetch_assoc($query_leader);
}

// get list assigned work
$sql_assigned = "SELECT * FROM congviec WHERE IDDuAn = $id_project AND IDNguoiDung = $user_id ORDER BY NgayKetThuc ASC";
$query_assigned = mysqli_query($mysqli, $sql_assigned);

$doing = [];
$done  = [];
$late  = [];

while ($t = mysqli_fetch_assoc($query_assigned)) {

    // Nếu trạng thái = 1 → hoàn thành
    if ($t['TrangThai'] == 1) {
        $done[] = $t;
        continue;
    }

    $now = new DateTime();
    $end = new DateTime($t['NgayKetThuc']);

    // Nếu quá hạn → late
    if ($end < $now) {
        $late[] = $t;
        continue;
    }

    // Đang làm → tính ưu tiên
    $diff = $now->diff($end)->days;

    if ($diff < 2)       $t['Priority'] = "high";
    elseif ($diff <= 5)  $t['Priority'] = "medium";
    else                 $t['Priority'] = "low";

    $doing[] = $t;
}

// Gộp theo thứ tự: đang làm → hoàn thành → quá hạn
$tasks = array_merge($doing, $done, $late);

// assigned work detail
// $id_task = $_POST['id_task'] ?? 0;
// $sql_assigned_detail = "SELECT congviec.*, congviecdanop.TepDinhKem AS TepDaNop FROM congviec LEFT JOIN congviecdanop 
//                         ON congviecdanop.IDCongViec = congviec.IDCongViec WHERE congviec.IDCongViec = 4 ORDER BY congviecdanop.NgayNop DESC";
// $query_assigned_detail = mysqli_query($mysqli, $sql_assigned_detail);
// $row_assigned_detail = mysqli_fetch_assoc($query_assigned_detail);
// $query_file_submited = mysqli_query($mysqli, $sql_assigned_detail);

// $all_files_submited = [];
// while ($row_file_submited = mysqli_fetch_assoc($query_file_submited)) {
//     if (!empty($row_file_submited['TepDaNop'])) {
//         $files_submited = explode(",", $row_file_submited['TepDaNop']);
//         foreach ($files_submited as $file) {
//             $all_files_submited[] = trim($file);
//         }
//     }
// }


// $all_files_submited = array_filter($all_files_submited); // loại bỏ rỗng


// Get list task submited
$sql_task_submited = "SELECT cv.IDCongViec, cv.NoiDung AS job_content, nd.Ten, nd.AnhDaiDien, dn.NoiDung AS post_content, dn.TepDinhKem AS file_submited, dn.NgayNop, dn.IDNop, dn.DanhGia
                        FROM congviecdanop dn
                        JOIN congviec cv ON dn.IDCongViec = cv.IDCongViec
                        JOIN nguoidung nd ON cv.IDNguoiDung = nd.IDNguoiDung
                        WHERE cv.IDDuAn = $id_project
                        ORDER BY dn.NgayNop DESC";
$query_task_submited = mysqli_query($mysqli, $sql_task_submited);
 
$sql_task_late = "SELECT cv.IDCongViec, cv.NoiDung, cv.NgayKetThuc, nd.Ten, nd.AnhDaiDien
                        FROM congviec cv
                        JOIN nguoidung nd ON cv.IDNguoiDung = nd.IDNguoiDung
                        WHERE cv.IDDuAn = $id_project AND cv.NgayKetthuc < NOW()
                        ORDER BY cv.NgayKetThuc DESC";
$query_task_late = mysqli_query($mysqli, $sql_task_late);
//


 ?>

 

