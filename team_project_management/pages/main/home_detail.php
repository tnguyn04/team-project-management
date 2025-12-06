<?php
include('pages/processing/role_check.php');
$id_prj_public = $_GET['id_project_public'];
$sql_prj_public_id = "SELECT duan.*, duancongkhai.YeuCau FROM duan JOIN duancongkhai ON duan.IDDuAn = duancongkhai.IDDuAn WHERE duan.IDDuAn = $id_prj_public";
$query_prj_public_id = mysqli_query($mysqli, $sql_prj_public_id);
$row_prj_public_id = mysqli_fetch_assoc($query_prj_public_id);

$sql_member_count = "SELECT COUNT(IDNguoiDung) AS SoLuongThanhVien 
              FROM thanhvienduan 
              WHERE IDDuAn = $id_prj_public AND TrangThai = 'approved'";

$query_member_count = mysqli_query($mysqli, $sql_member_count);
$row_member_count = mysqli_fetch_assoc($query_member_count);
?>

<div class="home-detail">

    <!-- LEFT CARD -->
    <div class="project-card hover">
        <div class="card-header">
            <h3 id="projectName"><?php echo $row_prj_public_id['TenDuAn'] ?></h3>
            <button title="Lưu dự án" class="edit-prj-btn" id="editToggle"><i class='bx  bxs-bookmark'    ></i>  </button>
        </div>

        <p id="projectDesc">
            <?php echo $row_prj_public_id['MoTa'] ?>
        </p>

        <div class="info-prj">
            <p><strong>Bắt đầu: </strong><?php echo !empty($row_prj_public_id['NgayBatDau']) ? date('d/m/Y', strtotime($row_prj_public_id['NgayBatDau'])) : 'Chưa cập nhật'; ?></p>
            <p><strong>Kết thúc: </strong><?php echo !empty($row_prj_public_id['NgayKetThuc']) ? date('d/m/Y', strtotime($row_prj_public_id['NgayKetThuc'])) : 'Chưa cập nhật'; ?></p>
            <p><strong>Số lượng thành viên: </strong><?php echo $row_member_count['SoLuongThanhVien'] + 1; ?></p>
            <p><strong>Trạng thái: </strong><?php echo ($row_prj_public_id['TrangThai'] == 1) ? 'Hoàn thành' : 'Đang thực hiện';  ?></p>
        </div> 
        <div class="info-prj">
            <p><strong>Mô tả yêu cầu: </strong><?php echo $row_prj_public_id['YeuCau'] ?></p>
        </div>
        <?php if (!empty($message)) echo $message; ?>
        <?php if (!$isLeader && !$isMember) { ?>
            <form action="" method="post">
                <div class="btn-claim">
                    <button name="request-join">Yêu cầu tham gia</button>
                </div>
            </form>
        <?php } ?>
    </div>
    <!-- LEFT CARD EDIT-->
</div>
