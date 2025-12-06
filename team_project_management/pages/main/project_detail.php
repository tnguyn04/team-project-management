<?php 
$id_project = $_GET['id_project'];
include('pages/processing/role_check.php');
include('pages/processing/project_detail.php');

$sql_project = "SELECT * FROM duan WHERE IDDuAn = $id_project";
$query_project = mysqli_query($mysqli, $sql_project);
$row_project = mysqli_fetch_assoc($query_project);
?>
<input type="hidden" name="id_project" id="id_project" value="<?php echo $id_project; ?>">
<div class="page-container">
    <!-- LEFT CARD -->
    <div class="project-card hover">
        <div class="card-header">
            <h3 id="projectName"><?php echo $row_project['TenDuAn'] ?></h3>
            <?php if($role === 'leader'): ?> 
            <button class="edit-prj-btn" id="editToggle"><i class='bx bxs-edit'></i></button>
            <?php endif; ?>
        </div>

        <p id="projectDesc">
            <?php echo $row_project['MoTa'] ?>
        </p>

        <div class="info-prj">
            <p><strong>Bắt đầu: </strong><?php echo !empty($row_project['NgayBatDau']) ? date('d/m/Y', strtotime($row_project['NgayBatDau'])) : 'Chưa cập nhật'; ?></p>
            <p><strong>Kết thúc: </strong><?php echo !empty($row_project['NgayKetThuc']) ? date('d/m/Y', strtotime($row_project['NgayKetThuc'])) : 'Chưa cập nhật'; ?></p>
            <p><strong>Trạng thái: </strong><?php echo ($row_project['TrangThai'] == 1) ? 'Hoàn thành' : 'Đang thực hiện';  ?></p>
            <?php if($role === 'leader'): ?>
                <p><strong>Mã dự án: </strong><?php echo $row_project['MaDuAn'] ?></p>
            <?php endif; ?>
        </div> 
    </div>
    <!-- LEFT CARD EDIT-->
    <div class="hover edit-card hidden">
        <form action="" method="POST">

            <div class="card-header">
                <h3>Chỉnh sửa dự án</h3>
                <button class="edit-prj-btn" type="submit" title="Lưu lại" name="edit-prj-save">
                    <i class='bx bxs-save'></i>
                </button>
            </div>

            <div class="input-group">
                <p>Tên dự án</p>
                <input type="text" name="project-name" value="<?php echo $row_project['TenDuAn'] ?>">
            </div>

            <div class="input-group">
                <p>Mô tả</p>
                <textarea name="description"><?php echo $row_project['MoTa'] ?></textarea>
            </div>

            <div class="input-row">
                <div class="input-group">
                    <p>Bắt đầu</p>
                    <input type="date" name="start-date" value="<?php echo $row_project['NgayBatDau'] ?>">
                </div>

                <div class="input-group">
                    <p>Kết thúc</p>
                    <input type="date" name="end-date" value="<?php echo $row_project['NgayKetThuc'] ?>">
                </div>
            </div>

            <div class="input-group">
                <p>Trạng thái</p>
                <select name="status">
                    <option value="0" <?= $row_project['TrangThai']==0 ? 'selected' : '' ?>>Đang thực hiện</option>
                    <option value="1" <?= $row_project['TrangThai']==1 ? 'selected' : '' ?>>Hoàn thành</option>
                </select>

            </div>

        </form> 
    </div>


    <!-- RIGHT AREA -->
    <div class="right-area">

        <!-- SIDEBAR ICONS -->
        <div class="sidebar-prj hover">
            <div class="tab-icon tab-icon-1 active-tab" data-tab="tab1" title="Bảng tin"><i class='bx bxs-news'></i> </div>
            <div class="tab-icon tab-icon-2" data-tab="tab2" title="Thành viên"><i class='bx  bxs-community'></i> </div>
            <div class="tab-icon tab-icon-3" data-tab="tab3" title="<?php echo ($role === 'leader') ? 'Công việc đã giao' : 'Công việc được giao'; ?>"><i class='bx  bx-clipboard-detail'></i> </div>
            <?php if($role === 'leader'): ?>
            <div class="tab-icon tab-icon-4" data-tab="tab4" title="Công việc hoàn thành"><i class='bx  bxs-clipboard-check'    ></i> </div>
            <div class="tab-icon tab-icon-5" data-tab="tab5" title="Công việc quá hạn"><i class='bx  bxs-clipboard-x'    ></i> </div>
            <?php endif; ?>
        </div>

        <!-- TAB CONTENT -->
        <div class="feed-container tab1 hover">
            <div class="new-post-box">
                <h3>Bảng tin</h3>
                <?php if($role === 'leader'): ?>
                <button class="btn-primary" id="openFormBtn">
                    <i class='bx bx-plus-circle'></i>Tạo thông báo
                </button>
                <?php endif; ?>
            </div>
            <!-- FORM TẠO THÔNG BÁO -->
            <form method="POST" enctype="multipart/form-data" id="PostForm">
                <div class="create-post-form hidden" id="createPostForm">
                    <textarea placeholder="Nhập nội dung thông báo..." class="post-input" name="content" required></textarea>

                    <input type="hidden" name="id_notify" id="notifyIdInput">

                    <label class="file-upload">
                        <i class='bx bx-upload'></i><span id="file-name">Chọn tệp đính kèm</span>
                        <input type="file" name="files[]" id="fileInput" multiple>
                    </label>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel" id="cancelPostBtn">Hủy</button>
                        <button type="submit" class="btn-submit" name="notify-post">Đăng</button>
                    </div>
                </div>
                <script>
                const fileInput = document.getElementById('fileInput');
                const fileNameSpan = document.getElementById('file-name');
                fileInput.addEventListener('change', () => {
                    if(fileInput.files.length > 0){
                        const fileNames = Array.from(fileInput.files).map(f => f.name).join(', ');
                        fileNameSpan.textContent = fileNames;
                    } else {
                        fileNameSpan.textContent = "Chọn tệp đính kèm";
                    }
                });
                </script>
            </form>

            <?php 
            $sql_notify = "SELECT t.IDThongBao, t.NoiDung, t.TepDinhKem, t.NgayTao, u.Ten, u.AnhDaiDien 
                    FROM thongbao t
                    JOIN nguoidung u ON t.IDNguoiDung = u.IDNguoiDung
                    WHERE t.IDDuAn = $id_project
                    ORDER BY t.NgayTao DESC";
            $query_notify = mysqli_query($mysqli, $sql_notify); 
            ?>
            <!-- POST WITH FILE -->
            <?php while($row_notify = mysqli_fetch_assoc($query_notify)): ?>
            <div class="post-item">
                <div class="post-header">
                    <div class="user-info">
                        <div class="avatar"><img src="data:image/*;base64,<?= $row_notify['AnhDaiDien']; ?>" alt=""></div>
                        <div>
                            <h4 class="user-name"><?php echo $row_notify['Ten'] ?></h4>
                            <span class="time"><?php
                                                $created = strtotime($row_notify['NgayTao']);
                                                $today = strtotime(date('Y-m-d'));
                                                $yesterday = strtotime('-1 day', $today);

                                                if ($created >= $today) {
                                                    echo 'Hôm nay lúc ' . date('H:i', $created);
                                                } elseif ($created >= $yesterday) {
                                                    echo 'Hôm qua lúc ' . date('H:i', $created);
                                                } else {
                                                    echo date('d/m/Y \l\ú\c H:i', $created);
                                                }
                                                ?>
                            </span>
                        </div>
                    </div>
                    <?php if($role === 'leader'): ?> 
                    <div class="post-menu">
                        <i class='bx bx-dots-horizontal-rounded menu-icon'></i>
                        <ul class="menu-dropdown">
                            <li class="edit-notify" data-notify="<?= $row_notify['IDThongBao'] ?>">Chỉnh sửa</li>
                            <li class="delete-notify" data-notify="<?= $row_notify['IDThongBao'] ?>">Xóa</li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>

                <p class="post-content"><?php echo $row_notify['NoiDung'] ?></p>
                <!-- if file -->
                <?php if(!empty($row_notify['TepDinhKem'])): ?>
                    <div class="file-box">
                        <?php
                        // Tách chuỗi file thành mảng
                        $files = explode(',', $row_notify['TepDinhKem']);
                        foreach($files as $file):
                            $file = trim($file); // loại bỏ khoảng trắng thừa
                            if($file == '') continue; // bỏ qua rỗng
                        ?>
                        <div>
                            <a href="files/<?php echo $file; ?>" class="file-name" target="_blank">
                                <?php echo $file; ?>
                            </a>
                            <i class='bx bxl-google-cloud file-icon'></i>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
           
            <?php endwhile; ?>
        </div>
        <!-- member -->
        <div class="feed-container tab2 feed-member hover hidden">
            <div class="new-post-box">
                <h3>Danh sách thành viên</h3>
                <div>
                    <?php if($role === 'leader'): ?>
                    <button class="btn-primary add-member-btn">
                        <i class='bx bx-plus-circle'></i>Thêm thành viên
                    </button>
                    <button class="btn-primary request-btn">
                        <i class='bx  bxs-arrow-out-down-left-circle'></i>Yêu cầu tham gia
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="add-member-box hidden" id="addMemberBox">
                <h4>Chia sẻ mã dự án để mọi người tham gia: <strong><?php echo $row_project['MaDuAn'] ?></strong></h4>
                <div class="divider">
                    <span>Hoặc</span>
                </div>

                <h4>Yêu cầu tuyển thành viên</h4>
                <form id="inviteForm" method="POST">
                    <textarea class="input textarea" placeholder="Nhập mô tả yêu cầu tuyển..." id="inviteNote" name="request-desc" required></textarea>
                    <div id="messageBox"></div>
                    <div class="btn-group">
                        <button class="btn cancel-btn" id="cancelAdd">Hủy</button>
                        <button class="btn submit-btn" id="submitAdd" name="post-public" type="submit">Đăng</button>
                    </div>
                </form>
            </div>
            <ul class="list-member list-member--pending hidden">
                <?php while($row_member_pending = mysqli_fetch_assoc($query_member_pending)): ?>    
                <li class="member-row member-pending">
                    <div class="user-img-wrap">
                        <div class="user-img">
                            <img src="data:image/*;base64,<?= $row_member_pending['AnhDaiDien']; ?>">
                        </div>
                    </div>
                    <div class="user-meta">
                        <div class="user-name"><?php echo $row_member_pending['Ten'] ?></div>
                        <p class="star-rating"><?php echo $row_member_pending['TrungBinhRating'] ?? 0 ?><i class='bx bxs-star'></i></p>
                        <div class="user-location"><?php echo $row_member_pending['MoTa'] ?></div>
                        <div class="user-profiles">
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $row_member_pending['Email'] ?>" target="_blank">
                                <i class="fa-regular fa-envelope"></i>
                            </a>
                            <a href="https://github.com">
                                <i class="fa-brands fa-github"></i>
                            </a>
                            <a href="https://wa.me">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                    <div class="hover-icons">
                        <i title="Chấp nhận thành viên" class='bx bx-plus-circle add-member' data-user="<?php echo $row_member_pending['IDNguoiDung'] ?>"></i>
                        <i title="Từ chối thành viên" class='bx bx-minus-circle delete-member' data-user="<?php echo $row_member_pending['IDNguoiDung'] ?>"></i>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
            <ul class="list-member list-member--approved">
                <li>
                    <div class="user-img-wrap">
                        <div class="user-img">
                            <img src="data:image/*;base64,<?= $row_leader['AnhDaiDien']; ?>">
                        </div>
                    </div>
                    <div class="user-meta">
                        <div class="user-name">
                            <?php echo $row_leader['Ten'] ?>
                            
                        </div>
                        <p class="star-rating"><?php echo $row_leader['TrungBinhRating'] ?? 0 ?><i class='bx bxs-star'></i></p>
                        <div class="user-location">
                            <?php echo $row_leader['MoTa'] ?>
                        </div>
                        <div class="user-profiles">
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $row_leader['Email'] ?>" target="_blank">
                                <i class="fa-regular fa-envelope"></i>
                            </a>
                            <a href="https://github.com">
                                <i class="fa-brands fa-github"></i>
                            </a>
                            <a href="https://wa.me">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                    <div class="hover-icons hover-leader">
                        LEADER
                    </div>
                </li>
                <?php foreach($members as $row_member): ?>    
                <li class="member-row">
                    <div class="user-img-wrap">
                        <div class="user-img">
                            <img src="data:image/*;base64,<?= $row_member['AnhDaiDien']; ?>">
                        </div>
                    </div>
                    <div class="user-meta">
                        <div class="user-name"><?php echo $row_member['Ten'] ?></div>
                        <p class="star-rating"><?php echo $row_member['TrungBinhRating'] ?? 0 ?><i class='bx bxs-star'></i></p>
                        <div class="user-location"><?php echo $row_member['MoTa'] ?></div>
                        <div class="user-profiles">
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $row_member['Email'] ?>" target="_blank">
                                <i class="fa-regular fa-envelope"></i>
                            </a>
                            <a href="https://github.com">
                                <i class="fa-brands fa-github"></i>
                            </a>
                            <a href="https://wa.me">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                    <?php if($role === 'member'): ?>
                    <div class="hover-icons hover-member">
                        MEMBER
                    </div>
                    <?php endif; ?>
                    <?php if($role === 'leader'): ?>
                    <div class="hover-icons">
                        <i title="Xóa thành viên" class='bx bx-minus-circle delete-member' data-user="<?php echo $row_member['IDNguoiDung'] ?>"></i>
                    </div>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>  
        </div>
        <!-- list job -->
        <div class="feed-container tab3 feed-work hover hidden">
            <?php if($role === 'member'): ?>
            <div class="new-post-box">
                <h3>Công việc được giao</h3>
            </div>
            <?php foreach($tasks as $t): ?>
            <div class="task-card" data-id="<?= $t['IDCongViec'] ?>">
                <p class="task-desc"><?= $t['NoiDung'] ?></p>
                <div class="deadline">
                    <?php if ($t['TrangThai'] === "1"): ?>
                        <i class='bx bx-check-circle'></i> Đã xong
                    <?php elseif (isset($t['Priority'])): ?>
                        <i class='bx bx-time'></i> Hạn: <?= date('d/m/Y \l\ú\c H:i', strtotime($t['NgayKetThuc'])) ?>
                    <?php else: ?>
                        <i class='bx bx-error'></i> Hạn: <?= date('d/m/Y \l\ú\c H:i', strtotime($t['NgayKetThuc'])) ?>
                    <?php endif; ?>
                </div>

                <div class="task-meta">
                    <?php if ($t['TrangThai'] === "1"): ?>
                        <span class="tag complete">Hoàn thành</span>

                    <?php elseif (isset($t['Priority'])): ?>
                        <span class="tag doing">Đang làm</span>

                        <?php if ($t['Priority'] === "high"): ?>
                            <span class="priority high">Ưu tiên cao</span>

                        <?php elseif ($t['Priority'] === "medium"): ?>
                            <span class="priority medium">Ưu tiên trung bình</span>

                        <?php else: ?>
                            <span class="priority low">Ưu tiên thấp</span>
                        <?php endif; ?>

                    <?php else: ?>
                        <span class="tag late">Quá hạn</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="task-card-detail hidden" data-id="<?= $t['IDCongViec'] ?>">
                <div class="task-content"><?= $t['NoiDung'] ?></div>
                <div class="info-grid">
        <!-- Cột trái: file đính kèm -->
                <?php
                $files = explode(",", $t['TepDinhKem']); // tách file thành mảng
                ?>
                    <div>
                        <?php foreach ($files as $file): ?>
                        <div class="info-item">
                            <span>Tệp đính kèm</span>
                            <a href="files/<?php echo trim($file); ?>" target="_blank">
                                <?php echo trim($file); ?>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div>
                        <!-- Cột phải: thời gian -->
                        <div class="info-item">
                            <span>Ngày bắt đầu</span>
                            <?= date('d/m/Y \l\ú\c H:i', strtotime($t['NgayBatDau'])) ?>
                        </div>
                        <div class="info-item">
                            <span>Hạn chót</span>
                            <?= date('d/m/Y \l\ú\c H:i', strtotime($t['NgayKetThuc'])) ?>
                        </div>
                    </div>                   
                </div>
                <div class="box-status">
                    <div>
                        <?php
                        $status = $t['TrangThai'];
                        if (is_null($status)) {
                            echo '<div class="status doing">Đang làm</div>';
                        } elseif ($status == 0) {
                            echo '<div class="status late">Trễ hạn</div>';
                        } elseif ($status == 1) {
                            echo '<div class="status complete">Hoàn thành</div>';
                        }
                        if (time() > strtotime($t['NgayKetThuc'])) {
                            echo '<div class="status late" style="margin-left: 5px;">Không thể nộp sau khi hết hạn</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="submit-box">
                    <form class="workSubmit" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id-task" value="<?= $t['IDCongViec']; ?>">
                        <textarea placeholder="Ghi chú..." name="note-submit"></textarea>
                        <div>
                            <button type="button" class="back-btn">Hủy</button>
                            <?php if (time() < strtotime($t['NgayKetThuc'])): ?>
                            <div>
                                <label class="file-upload">
                                    <i class='bx bx-upload'></i><span class="file-name-submit">Chọn tệp đính kèm</span>
                                    <input type="file" name="files[]" class="fileInput-submit" multiple required>
                                </label>
                                <button name="work-submit-btn" class="submit-btn">Nộp</button>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="messageWorkSubmited"></div>
                    </form>
                </div>
                <div class="submitted-files-box">
                    <?php
                    $id_task = $t['IDCongViec'] ?? 0;
                    $sql_file_submited = "SELECT * FROM congviecdanop WHERE $id_task = IDCongViec ORDER BY NgayNop DESC";
                    $query_file_submited = mysqli_query($mysqli, $sql_file_submited);
                    $all_files_submited = [];
                    while ($row_file_submited = mysqli_fetch_assoc($query_file_submited)) {
                        if (!empty($row_file_submited['TepDinhKem'])) {
                            $files_submited = explode(",", $row_file_submited['TepDinhKem']);
                            foreach ($files_submited as $file) {
                                $all_files_submited[] = trim($file);
                            }
                        }
                    }
                    $all_files_submited = array_filter($all_files_submited); // loại bỏ rỗng
                    ?>
                    <h4>Tệp đã nộp</h4>
                    <ul class="submitted-files-list">
                        <?php foreach ($all_files_submited as $file): ?>
                        <li><a href="files/<?php echo $file; ?>" target="_blank"><?php echo $file; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
            </div>
            <?php endforeach; ?>
            <script>
                document.querySelectorAll(".task-card").forEach(card => {
                    card.addEventListener("click", function () {
                        let id = this.dataset.id;

                        // Ẩn tất cả task-card
                        document.querySelectorAll(".task-card").forEach(t => t.classList.add("hidden"));

                        // Ẩn tất cả detail
                        document.querySelectorAll(".task-card-detail").forEach(d => d.classList.add("hidden"));

                        // Hiện detail đúng
                        let detail = document.querySelector(`.task-card-detail[data-id="${id}"]`);
                        if(detail) detail.classList.remove("hidden");
                    });
                });
                document.querySelectorAll('.back-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        // Ẩn tất cả detail
                        document.querySelectorAll('.task-card-detail').forEach(d => d.classList.add('hidden'));

                        // Hiện lại danh sách task-card
                        document.querySelectorAll('.task-card').forEach(c => c.classList.remove('hidden'));
                    });
                });

                document.querySelectorAll('.fileInput-submit').forEach(input => {
                    input.addEventListener('change', function() {
                        const span = this.closest('label').querySelector('.file-name-submit');
                        if(this.files.length > 0){
                            const fileNames = Array.from(this.files).map(f => f.name).join(', ');
                            span.textContent = fileNames;
                        } else {
                            span.textContent = "Chọn tệp đính kèm";
                        }
                    });
                });

                </script>

            <?php endif; ?>
            <?php if($role === 'leader'): ?>
                <div class="new-post-box">
                    <h3>Công việc đang thực hiện</h3>
                    <button class="btn-primary" id="openTaskBtn">
                        <i class='bx bx-plus-circle'></i>Giao công việc
                    </button>
                </div>
                <?php 
                $sql_task = "SELECT cv.*, nd.Ten FROM congviec cv JOIN nguoidung nd ON nd.IDNguoiDung = cv.IDNguoiDung 
                WHERE cv.IDDuAn = $id_project AND cv.TrangThai IS NULL ORDER BY cv.IDcongViec DESC";
                $query_task = mysqli_query($mysqli, $sql_task); 
                ?>
                <?php while($row_task = mysqli_fetch_assoc($query_task)): ?>
                <div class="task-card task-card-leader" data-start="<?= $row_task['NgayBatDau'] ?>"
                                                        data-end="<?= $row_task['NgayKetThuc'] ?>"
                                                        data-user="<?= $row_task['IDNguoiDung'] ?>">
                    <div class="task-card-menu">
                        <p class="task-desc"><?= $row_task['NoiDung'] ?></p>
                        <div class="post-menu">
                            <i class='bx bx-dots-horizontal-rounded menu-icon'></i>
                            <ul class="menu-dropdown">
                                <li class="edit-task" data-task="<?= $row_task['IDCongViec'] ?>">Chỉnh sửa</li>
                                <li class="delete-task" data-task="<?= $row_task['IDCongViec'] ?>">Xóa</li>
                            </ul>
                        </div>
                    </div>
                    <div class="deadline">
                        <i class='bx bx-time'></i> Hạn: <?= date('d/m/Y \l\ú\c H:i', strtotime($row_task['NgayKetThuc'])) ?>
                    </div>
                    <div class="user-deadline">
                        <i class='bx  bx-user'></i> Giao cho: <strong><?= $row_task['Ten'] ?></strong>
                    </div>
                    <?php if(!empty($row_task['TepDinhKem'])): ?>
                        <div class="task-file-edit hidden">
                            <?php
                            // Tách chuỗi file thành mảng
                            $files = explode(',', $row_task['TepDinhKem']);
                            foreach($files as $file):
                                $file = trim($file); // loại bỏ khoảng trắng thừa
                                if($file == '') continue; // bỏ qua rỗng
                            ?>
                            <div>
                                <a href="files/<?php echo $file; ?>" class="file-name" target="_blank">
                                    <?php echo $file; ?>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>             
                <?php endwhile; ?>
                <div class="add-member-box assign-modal hidden">
                    <form method="POST" id="assignForm" enctype="multipart/form-data">
                        <div class="create-post-form create-task-form" id="createTaskForm">
                            <input type="hidden" name="id_task" id="taskIdInput">

                            <textarea placeholder="Nhập nội dung công việc..." class="post-input" name="content" id="contentWork" required></textarea>
                            <label class="file-upload">
                                <i class='bx bx-upload'></i><span id="file-name-work">Chọn tệp đính kèm</span>
                                <input type="file" name="files[]" id="fileInput-work" multiple>
                            </label>
                            <div class="datetime">
                                <p>Ngày bắt đầu</p>
                                <input type="datetime-local" name="start_datetime" required>
                            </div>
                            <div class="datetime">
                                <p>Ngày kết thúc</p>
                                <input type="datetime-local" name="end_datetime" required>
                            </div>
                            <div class="select-member">
                                <p><strong>Giao cho</strong></p>
                                <div class="member-grid">
                                <?php foreach($members as $row_member): ?>
                                    <label class="member-select">
                                        <input type="checkbox" name="member[]" value="<?= $row_member['IDNguoiDung'] ?>">

                                        <div class="member-info">
                                            <img src="data:image/*;base64,<?= $row_member['AnhDaiDien'] ?>" class="avatar">
                                            <span><?= $row_member['Ten'] ?></span>
                                        </div>
                                    </label>
                                <?php endforeach; ?>
                                </div>

                            </div>
                            <div id="messageBoxAssign"></div>
                            <div class="form-actions">
                                <button type="button" class="btn-cancel" id="cancelAssignBtn">Hủy</button>
                                <button type="submit" class="btn-submit" name="assign-work">Giao</button>
                            </div>
                        </div>
                        <script>
                        const fileInputW = document.getElementById('fileInput-work');
                        const fileNameSpanW = document.getElementById('file-name-work');
                        fileInputW.addEventListener('change', () => {
                            if(fileInputW.files.length > 0){
                                const fileNamesW = Array.from(fileInputW.files).map(f => f.name).join(', ');
                                fileNameSpanW.textContent = fileNamesW;
                            } else {
                                fileNameSpanW.textContent = "Chọn tệp đính kèm";
                            }
                        });
                        </script>
                    </form>
                </div>
                
            <?php endif; ?>
            <!-- <div id="taskDetail"></div> -->
        </div>
        <!-- job -->
        <div class="feed-container tab4 feed-complete hover hidden">
            <div class="new-post-box">
                <h3>Danh sách công việc đã nộp</h3>
            </div>
            <?php while($row_task_submited = mysqli_fetch_assoc($query_task_submited)) { ?>
            <div class="post-item">
                <div class="post-header">
                    <div class="user-info">
                        <div class="avatar"><img src="data:image/*;base64,<?= $row_task_submited['AnhDaiDien']; ?>" alt=""></div>
                        <div>
                            <h4 class="user-name"><?= $row_task_submited['Ten'] ?></h4>
                            <span class="time"><?php
                                                $created = strtotime($row_task_submited['NgayNop']);
                                                $today = strtotime(date('Y-m-d'));
                                                $yesterday = strtotime('-1 day', $today);

                                                if ($created >= $today) {
                                                    echo 'Hôm nay lúc  ' . date('H:i', $created);
                                                } elseif ($created >= $yesterday) {
                                                    echo 'Hôm qua lúc ' . date('H:i', $created);
                                                } else {
                                                    echo date('d/m/Y \l\ú\c H:i', $created);
                                                }
                                                ?>
                            </span>
                        </div>
                        <?php $rating = intval($row_task_submited['DanhGia']); ?>
                        <div class="rating" data-id="<?= $row_task_submited['IDNop'] ?>">
                            <?php for($i=1; $i<=5; $i++): ?>
                                <i class='bx bxs-star <?= $i <= $rating ? "active" : "" ?>' data-value="<?= $i ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" name="rating" class="rating-value" value="<?= $rating ?>">
                    </div>
                </div>
                <p class="job-content"><?= $row_task_submited['job_content'] ?></p>
                <h4 class="job-name">Nội dung đã nộp</h4>
                <p class="post-content"><?= $row_task_submited['post_content'] ?></p>
                <?php if(!empty($row_task_submited['file_submited'])): ?>
                    <div class="file-box">
                        <?php
                        // Tách chuỗi file thành mảng
                        $files = explode(',', $row_task_submited['file_submited']);
                        foreach($files as $file):
                            $file = trim($file); // loại bỏ khoảng trắng thừa
                            if($file == '') continue; // bỏ qua rỗng
                        ?>
                        <div>
                            <a href="files/<?php echo $file; ?>" class="file-name" target="_blank">
                                <?php echo $file; ?>
                            </a>
                            <i class='bx bxl-google-cloud file-icon'></i>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php } ?>
        </div>
        <!-- late -->
        <div class="feed-container tab5 feed-late hover hidden">
            <div class="new-post-box">
                <h3>Danh sách công viêc trễ hạn</h3>
            </div>
            <?php while($row_task_late = mysqli_fetch_assoc($query_task_late)) { ?>
            <div class="post-item">
                <div class="post-header">
                    <div class="user-info">
                        <div class="avatar"><img src="data:image/*;base64,<?= $row_task_late['AnhDaiDien']; ?>" alt=""></div>
                        <div>
                            <h4 class="user-name"><?= $row_task_late['Ten'] ?></h4>
                            <span class="time"><?php
                                                $created = strtotime($row_task_late['NgayKetThuc']);
                                                $today = strtotime(date('Y-m-d'));
                                                $yesterday = strtotime('-1 day', $today);

                                                if ($created >= $today) {
                                                    echo 'Hôm nay lúc  ' . date('H:i', $created);
                                                } elseif ($created >= $yesterday) {
                                                    echo 'Hôm qua lúc ' . date('H:i', $created);
                                                } else {
                                                    echo date('d/m/Y \l\ú\c H:i', $created);
                                                }
                                                ?>
                            </span>
                        </div>
                        
                    </div>
                </div>
                <p class="job-content"><?= $row_task_late['NoiDung'] ?></p>
            </div>
            <?php } ?>
        </div>
    </div>

</div>


<script src="././js/jquery-3.7.1.min.js"></script>
<script src="././js/project_ajax.js"></script>
<script src="././js/project.js"></script>
