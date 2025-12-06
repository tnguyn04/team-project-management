<nav>
	<i class='bx bx-menu' ></i>
	<a href="#" class="nav-link">Danh mục</a>
	<form action="#" method="post" autocomplete="off">
		<div class="form-input">
			<input type="search" placeholder="Tìm dự án công khai..." name="key" value="<?php echo isset($_POST['key']) ? htmlspecialchars($_POST['key']) : ''; ?>">
			<button type="submit" class="search-btn" name="search"><i class='bx bx-search' ></i></button>
		</div>
	</form>
	<a href="?page=add_project" class="add-project <?php echo $selected == 'add_project' ? 'add-project--active' : ''; ?>">
		<i class='bx  bxs-plus-circle add-project__icon'></i>
		<p class="add-project__text">Dự án</p>
	</a>
	<input type="checkbox" id="switch-mode" hidden>
	<label for="switch-mode" class="switch-mode"></label>
	<a href="#" class="notification">
		<i class='bx bxs-bell' ></i>
		<span class="num">8</span>
	</a>
</nav>

