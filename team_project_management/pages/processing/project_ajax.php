<?php

include('config.php');
header('Content-Type: application/json');

$id_project = $_POST['id_project'] ?? null;

if (isset($_POST['post-public'])) {
    $request_desc = $_POST['request-desc'];
    $sql = "INSERT INTO duancongkhai (IDDuAn, YeuCau, NgayTao) VALUES ($id_project, '$request_desc', NOW())";
    $sql_update = "UPDATE duancongkhai SET YeuCau = '$request_desc', NgayTao = NOW() WHERE IDDuAn = $id_project";
    if(mysqli_query($mysqli, $sql)){
        echo json_encode(['status' => 'success']);
    } elseif(mysqli_query($mysqli, $sql_update)) {
        echo json_encode(['status' => 'success']);
    }
    exit;
} elseif(isset($_POST['delete_notify'])){
    $notifyId = $_POST['id_notify'];

    $sql = "DELETE FROM thongbao WHERE IDThongBao = $notifyId LIMIT 1";
    if(mysqli_query($mysqli, $sql)){
        echo json_encode(['status' => 'success']);
    }
    exit;
} elseif(isset($_POST['delete_member'])){
    $userId = $_POST['id_user'];

    $sql = "DELETE FROM thanhvienduan WHERE IDNguoiDung = $userId AND IDDuAn = $id_project LIMIT 1";
    $group = mysqli_query($mysqli, "SELECT IDNhom FROM nhom WHERE IDDuAn=$id_project LIMIT 1");
    if(mysqli_num_rows($group) > 0){
        $group_row = mysqli_fetch_assoc($group);
        $gid = $group_row['IDNhom'];
        mysqli_query($mysqli, "DELETE FROM thanhviennhom WHERE IDNhom = $gid AND IDNguoiDung = $userId");
    }
    if(mysqli_query($mysqli, $sql)){
        echo json_encode(['status' => 'success']);
    }
    exit;
} elseif(isset($_POST['add_member'])){
    $userId = $_POST['id_user'];

    $sql = "UPDATE thanhvienduan SET TrangThai = 'approved', NgayThamGia = NOW() WHERE IDDuAn = $id_project AND IDNguoiDung = $userId";
    $group = mysqli_query($mysqli, "SELECT IDNhom FROM nhom WHERE IDDuAn=$id_project LIMIT 1");
    if(mysqli_num_rows($group) > 0){
        $group_row = mysqli_fetch_assoc($group);
        $gid = $group_row['IDNhom'];
        mysqli_query($mysqli, "INSERT IGNORE INTO thanhviennhom(IDNhom, IDNguoiDung, NgayThamGia) VALUES ($gid, $userId, NOW())");
    }
    if(mysqli_query($mysqli, $sql)){
        echo json_encode(['status' => 'success']);
    }
    exit;
} elseif(isset($_POST['delete_task'])){
    $taskId = $_POST['id_task'];

    $sql = "DELETE FROM congviec WHERE IDCongViec = $taskId LIMIT 1";
    if(mysqli_query($mysqli, $sql)){
        echo json_encode(['status' => 'success']);
    }
    exit;
}


if(isset($_POST['action']) && $_POST['action'] == "assign_work"){

    $members = $_POST['member'];
    $id_project = $_POST['id_project'];
    $content = $_POST['content'];
    $start = $_POST['start_datetime'];
    $end   = $_POST['end_datetime'];
    $id_task = !empty($_POST['id_task']) ? intval($_POST['id_task']) : 0; // 0 = tạo mới


    // upload folder
    $upload_dir = "../../files/";
    if(!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $files = [];
    if(!empty($_FILES['files']['name'][0])){
        foreach($_FILES['files']['name'] as $k => $name){
            $tmp = $_FILES['files']['tmp_name'][$k];
            $safe = basename($name);
            if(move_uploaded_file($tmp, $upload_dir . $safe)){
                $files[] = $safe;
            }
        }
    }

    $files_str = !empty($files) ? implode(",", $files) : NULL;
    if($start > $end) {
        
    }
    
    if ($start > $end) {
    echo json_encode(['status' => 'error']);
        exit;
    }

    foreach($members as $id_member){
        if($id_task){
            // UPDATE nếu đã tồn tại
            $sql = "
                UPDATE congviec 
                SET NoiDung = '$content',  NgayBatDau='$start', NgayKetThuc='$end', TepDinhKem=" . ($files_str ? "'$files_str'" : "NULL") . ", IDNguoiDung = $id_member
            ";
        } else {
            // INSERT nếu chưa có
            $sql = "
                INSERT INTO congviec(NoiDung, NgayBatDau, NgayKetThuc, TepDinhKem, IDDuAn, IDNguoiDung)
                VALUES ('$content', '$start', '$end', " . ($files_str ? "'$files_str'" : "NULL") . ", $id_project, $id_member)
            ";
        }
        mysqli_query($mysqli, $sql);
    }

    echo json_encode(['status' => 'success']);
    exit;
}
//

if (isset($_POST['note-submit']) || isset($_POST['files'])) {
    $id_task = $_POST['id-task'];
    $note = $_POST['note-submit'] ?? null;
    $files = [];

    // upload folder
    $upload_dir = "../../files/";
    if(!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    if(!empty($_FILES['files']['name'][0])){
        foreach($_FILES['files']['name'] as $k => $name){
            $tmp = $_FILES['files']['tmp_name'][$k];
            $safe = basename($name);
            if(move_uploaded_file($tmp, $upload_dir . $safe)){
                $files[] = $safe;
            }
        }
    }

    $files_str = !empty($files) ? implode(",", $files) : NULL;

    $sql = "INSERT INTO congviecdanop(NoiDung, TepDinhKem, NgayNop, IDCongViec)
            VALUES ('$note', " . ($files_str ? "'$files_str'" : "NULL") . ",NOW(), $id_task)";
    $sql_update = "UPDATE congviec SET TrangThai = 1 WHERE $id_task = IDCongViec";

    if(mysqli_query($mysqli, $sql) && mysqli_query($mysqli, $sql_update)){
        echo json_encode(['status' => 'success']);
    }
    exit;
}

// task detail
// $id_task = $_POST['id_task'] ?? 0;

// $sql_assigned_detail = "SELECT congviec.*, congviecdanop.TepDinhKem AS TepDaNop 
//         FROM congviec 
//         LEFT JOIN congviecdanop 
//             ON congviecdanop.IDCongViec = congviec.IDCongViec 
//         WHERE congviec.IDCongViec = $id_task
//         ORDER BY congviecdanop.NgayNop DESC";

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
// $all_files_submited = array_filter($all_files_submited);
// if(isset($_POST['idTaskDetail'])) {
//     $id = intval($_POST['idTaskDetail']); 
//     $sql = "SELECT congviec.*, congviecdanop.TepDinhKem AS TepDaNop FROM congviec LEFT JOIN congviecdanop 
//             ON congviecdanop.IDCongViec = congviec.IDCongViec WHERE congviec.IDCongViec = $id ORDER BY congviecdanop.NgayNop DESC";
//     $result = mysqli_query($mysqli, $sql);                        
//     $result_submited = mysqli_query($mysqli, $sql);
//     $all_files_submited = [];
//     while ($row_file_submited = mysqli_fetch_assoc($result_submited)) {
//         if (!empty($row_file_submited['TepDaNop'])) {
//             $files_submited = explode(",", $row_file_submited['TepDaNop']);
//             foreach ($files_submited as $file) {
//                 $all_files_submited[] = trim($file);
//             }
//         }
//     }


//     $all_files_submited = array_filter($all_files_submited); // loại bỏ rỗng

//     $row = mysqli_fetch_assoc($result)
//         echo json_encode(['status' => 'success']);
//         exit;

// }


if(isset($_POST['IDNop'], $_POST['rating'])){
    $id = intval($_POST['IDNop']);
    $rating = intval($_POST['rating']);

    $sql = "UPDATE congviecdanop SET DanhGia = $rating WHERE IDNop = $id";
    mysqli_query($mysqli, $sql);
    
}






