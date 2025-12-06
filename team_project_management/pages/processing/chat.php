<?php
include('config.php');


if(isset($_POST['get_group'])) {
    $groupId = mysqli_real_escape_string($mysqli, $_POST['id_group']);
    $userId = mysqli_real_escape_string($mysqli, $_POST['user_id']);

    $query = mysqli_query($mysqli, "
        SELECT tn.*, nd.Ten, nd.AnhDaiDien 
        FROM tinnhan tn 
        JOIN nguoidung nd ON tn.IDNguoiDung = nd.IDNguoiDung
        WHERE tn.IDNhom = $groupId
        ORDER BY tn.NgayGui ASC
    ");

   while($row = mysqli_fetch_assoc($query)) {
    $isMe = $row['IDNguoiDung'] == $userId;
    $class = $isMe ? 'message-me' : 'message-other';
    $avatar = $isMe ? '' : '<img src="data:image/*;base64,' . $row['AnhDaiDien'] . '" class="msg-avatar">';
    $name = $isMe ? '' : '<p class="msg-sender-name">'.$row['Ten'].'</p>';

    echo '<div class="message '.$class.'" data-msg-id="'.$row['IDTinNhan'].'">'.$avatar.'<div class="msg-wrapper">';
    echo $name;

    if($row['Loai'] == 'text'){
        echo '<div class="message-content">'.$row['NoiDung'].'</div>';
    }
    elseif($row['Loai'] == 'image'){
        echo '<div class="message-img"><img src="images/'.$row['NoiDung'].'" class="msg-img"></div>';
    }
    elseif($row['Loai'] == 'file'){
        echo '<div class="message-file"><a href="files/'.$row['NoiDung'].'" class="msg-file" target="_blank">'.htmlspecialchars($row['NoiDung']).'</a><i class="bx bxl-google-cloud file-message-icon"></i></div>';
    }

    echo '<span class="time">'.date('H:i', strtotime($row['NgayGui'])).'</span>';
    echo '</div></div>';
}

}



if(isset($_POST['send_message'])) {

    $groupId = mysqli_real_escape_string($mysqli, $_POST['id_group']);
    $userId  = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $message = mysqli_real_escape_string($mysqli, $_POST['message']);

    $filePath = "";
    $imagePath = "";
    $type = "text";

    // Upload file
    if(!empty($_FILES['file']['name'])) {
        $fileName = $_FILES['file']['name'];
        $filePath = "../../files/" . $fileName; // thư mục lưu file
        move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
        $type = "file";
        $message = $fileName; // lưu tên file vào cột NoiDung
    }

    // Upload ảnh
    if(!empty($_FILES['image']['name'])) {
        $imgName = time() . "_" . $_FILES['image']['name'];
        $imagePath = "../../images/" . $imgName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        $type = "image";
        $message = $imgName; // lưu tên ảnh vào cột NoiDung
    }

    // Insert vào database
    $sql = "
        INSERT INTO tinnhan(NoiDung, Loai, IDNhom, IDNguoiDung, NgayGui)
        VALUES('$message', '$type', $groupId, $userId, NOW())
    ";

    mysqli_query($mysqli, $sql);
    exit;
}


