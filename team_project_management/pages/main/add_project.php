<?php include('pages/processing/add_project.php'); ?>
<div class="head-title">
        <div class="left">
            <h1>Thêm dự án</h1>
            <ul class="breadcrumb">
                <li><i class='bx bx-chevron-right' ></i></li>
                <li>
                    <a class="active" href="#">Tạo hoặc tham gia dự án</a>
                </li>
            </ul>
        </div>
    </div>
    <ul class="box-info">
        <li class="box-create">
            <h3>Tạo dự án mới</h3>
            <form action="" method="post" autocomplete="off">
                <ul class="create-list">
                    <li>
                        <p>Tên: </p>
                        <input name="project-name" type="text" class="input-text" required>
                    </li>
                    <li>
                        <p>Mô tả: </p>
                        <textarea name="describe" class="textarea" name="" id=""></textarea>
                    </li>
                    <li>
                        <p>Ngày bắt đầu</p>
                        <input name="begin" type="date">
                    </li>
                    <li>
                        <p>Ngày kết thúc</p>
                        <input name="end" type="date">
                    </li>
                    <li><?php if (!empty($message_cr)) echo $message_cr; ?></li>
                    <li>
                        <button name="create-project" class="create-project">Tạo</button>
                    </li>
                </ul>
            </form>
        </li>
        <li class="box-create box-invite">
            <h3>Nhập mã mờ để tham gia</h3>
            <form action="" method="POST" autocomplete="off">
                <input type="text" class="input-text" name="invite-code" placeholder="Nhập mã mời" required>
                <button style="justify-content: center;" name="enter-code">Tham gia</button>
            </form>
            <?php if (!empty($message)) echo $message; ?>
        </li>
        
    </ul>


    



