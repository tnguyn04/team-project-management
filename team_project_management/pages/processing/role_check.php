
<?php
if (isset($_GET['id_project'])) {
    $id_project = $_GET['id_project'];

    $sql_leader_check = "SELECT 1 FROM duan WHERE IDDuAn = $id_project AND IDLeader = $user_id LIMIT 1";
    $is_leader = mysqli_num_rows(mysqli_query($mysqli, $sql_leader_check)) > 0;

    // Nếu không phải leader thì mặc định là member
    $role = $is_leader ? 'leader' : 'member';
}


//
if (isset($_GET['id_project_public'])) {
    $id_project_public = $_GET['id_project_public'];
    $sql = "SELECT (d.IDLeader = $user_id) AS IsLeader,(SELECT COUNT(*) FROM thanhvienduan 
    WHERE IDDuAn = d.IDDuAn AND IDNguoiDung = $user_id) AS IsMember
    FROM duan d
    WHERE d.IDDuAn = $id_project_public";

    $query = mysqli_query($mysqli, $sql);
    $data = mysqli_fetch_assoc($query);

    $isLeader = $data['IsLeader'];
    $isMember = $data['IsMember'];
    }
?>



