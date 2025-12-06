<?php
$page = $_GET['page'] ?? 'home';

// Xử lý tab theo từng page
if ($page == 'project') {
    $selected_tab = $_GET['tab'] ?? 'member'; 

} elseif ($page == 'setting') {
    $selected_tab = $_GET['tab'] ?? 'account'; 

} else {
    $selected_tab = ''; // các trang khác không có tab
}
?>

<?php
switch ($page) {
    case 'home':
        $title = 'Trang chủ';
        $breadcrumb = '
            <ul class="breadcrumb">
                <li><i class="bx bx-chevron-right" ></i></li>
                <li>
                    <a class="active" href="?page=home">Danh sách dự án công khai</a>
                </li>
            </ul>';
        break;

    case 'project':
        $title = 'Dự án';
        $breadcrumb = '
            <ul class="breadcrumb">
            <li><i class="bx bx-chevron-right"></i></li>
            <li>
                <a class="project-mb ' . ($selected_tab=='member' ? 'active' : '') . '" href="?page=project&tab=member">Thành viên</a>
            </li>
            <li><i class="bx bx-chevron-right"></i></li>
            <li>
                <a class="project-ld ' . ($selected_tab=='leader' ? 'active' : '') . '" href="?page=project&tab=leader">Trưởng nhóm</a>
            </li>
            <li><i class="bx bx-chevron-right"></i></li>
            <li>
                <a class="project-cpl ' . ($selected_tab=='complete' ? 'active' : '') . '" href="?page=project&tab=complete">Hoàn thành</a>
            </li>
        </ul>';
        break;

    case 'job':
        $title = 'Công việc';
        $breadcrumb = '
            <ul class="breadcrumb">
                <li><i class="bx bx-chevron-right" ></i></li>
                <li>
                    <a  class="active" href="#">Chưa hoàn thành</a>
                </li>
                <li><i class="bx bx-chevron-right" ></i></li>
                <li>
                    <a href="#">Hoàn thành</a>
                </li>
                <li><i class="bx bx-chevron-right" ></i></li>
                <li>
                    <a href="#">Quá hạn</a>
                </li>
            </ul>';
        break;
    case 'chat':
        $title = 'Trao đổi';
        $breadcrumb = '
            <ul class="breadcrumb">
                <li><i class="bx bx-chevron-right" ></i></li>
                <li>
                    <a class="active" href="#">Trao đổi với thành viên dự án</a>
                </li>
            </ul>';
        break;
    case 'statis':
        $title = 'Thống kê';
        $breadcrumb = '
            <ul class="breadcrumb">
                <li><i class="bx bx-chevron-right" ></i></li>
                <li>
                    <a class="active" href="#">Thống kê cá nhân</a>
                </li>
            </ul>';
        break;
    case 'setting':
        $title = 'Cài đặt';
        $breadcrumb = '
        <ul class="breadcrumb">
                <li><i class="bx bx-chevron-right" ></i></li>
                <li>
                    <a class="' . ($selected_tab=='account' ? 'active' : '') . '" href="?page=setting&tab=account">Tài khoản</a>
                </li>
                <li><i class="bx bx-chevron-right" ></i></li>
                <li>
                    <a class="' . ($selected_tab=='security' ? 'active' : '') . '" href="?page=setting&tab=security">Bảo mật</a>
                </li>
                <li><i class="bx bx-chevron-right" ></i></li>
                <li>
                    <a class="' . ($selected_tab=='connect' ? 'active' : '') . '" href="?page=setting&tab=connect">Kết nối</a>
                </li>
            </ul>';
        break;
    default:
        $title = '';
        $breadcrumb = '';
}
?>

<div class="head-title">
    <div class="left">
        <h1><?= $title ?></h1>
        <?= $breadcrumb ?>
    </div>

    <?php if ($page == 'statis'): ?>
        <button id="downloadPdf" class="btn-download">
         
            <i class='bx bxs-cloud-download'></i>
            <span class="text">Download PDF</span>
   
        </button>
        
    <?php endif; ?>
</div>
