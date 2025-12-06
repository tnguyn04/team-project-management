<?php
if(isset($_GET['action'])=='logout'){
    unset($_SESSION['login']);
    echo "<script>location.reload();</script>";
    exit();
}
?>

<?php
$selected = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Team Project Management</span>
		</a>
		<ul class="side-menu top">
			<li class="<?php echo $selected == 'home' ? 'active' : ''; ?>">
				<a href="?page=home">
					<i class='bx bxs-home' ></i>
					<span class="text">Trang chủ</span>
				</a>
			</li>
			<li class="<?php echo $selected == 'project' ? 'active' : ''; ?>">
				<a href="?page=project">
					<i class='bx bxs-group'></i>
					<span class="text">Dự án</span>
				</a>
			</li>
			<li class="<?php echo $selected == 'chat' ? 'active' : ''; ?>">
				<a href="?page=chat">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Trao đổi</span>
				</a>
			</li>
			<li class="<?php echo $selected == 'statis' ? 'active' : ''; ?>">
				<a href="?page=statis">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Thống kê</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu top">
			<li class="<?php echo $selected == 'setting' ? 'active' : ''; ?>">
				<a href="?page=setting">
					<i class='bx bxs-cog' ></i>
					<span class="text">Cài đặt</span>
				</a>
			</li>
			<li>
				<a href="?action=logout" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Đăng xuất</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->
	 
