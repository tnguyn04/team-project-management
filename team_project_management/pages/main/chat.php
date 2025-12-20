
<link rel="stylesheet" href="././css/chat.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

<div class="chat-layout hover">
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

    <!-- LEFT SIDEBAR -->
    <div class="chat-groups">
        <div class="chat-groups__header">Nhóm dự án</div>

        <div class="group-search">
            <i class='bx bx-search'></i>
            <input type="text" placeholder="Tìm nhóm...">
        </div>
        <div>
          <?php
          $sql_group_list = "SELECT n.IDNhom, n.TenNhom FROM nhom n
          JOIN thanhviennhom t ON n.IDNhom = t.IDNhom
          WHERE t.IDNguoiDung = $user_id
          ORDER BY t.NgayThamGia DESC";
          $query_group_list = mysqli_query($mysqli, $sql_group_list);
          ?>
        <?php while($row_group_list = mysqli_fetch_assoc($query_group_list)): ?>
        <div class="group-item" group-id="<?= $row_group_list['IDNhom'] ?>">
            <i class='bx bxs-group'></i>
            <span><?= $row_group_list['TenNhom'] ?></span>
        </div>
        <?php endwhile; ?>
        </div>
    </div>



    <!-- RIGHT CHAT AREA -->
    <div class="chat-box">
        
        <div class="chat-header"></div>

        <div class="chat-messages">

            
        </div>
        <?php
        $query_hasGroup = mysqli_query($mysqli, "SELECT COUNT(*) as cnt FROM thanhviennhom WHERE IDNguoiDung = $user_id");
        $row_hasGroup = mysqli_fetch_assoc($query_hasGroup);
        $hasGroup = $row_hasGroup['cnt'] > 0 ? 1 : 0;
        ?>
        <?php if ($hasGroup): ?>
        <form class="chat-input-area" id="chatForm" method="POST" enctype="multipart/form-data" autocomplete="off">
            <label class="upload-btn">
                <i class='bx bx-paperclip'></i>
                <input type="file" id="fileInput" name="file" hidden>
            </label>

            <label class="upload-btn">
                <i class='bx bx-image img-icon'></i>
                <input type="file" id="imageInput" accept="image/*" name="image" hidden>
            </label>
            

            <input type="text" name="message" id="chatMessage" placeholder="Nhập tin nhắn..." required>

            <button type="submit"><i class='bx bx-send'></i></button>
        </form>
        <?php endif; ?>


    </div>
</div>


<script src="././js/jquery-3.7.1.min.js"></script>
<script src="././js/chat.js"></script>


