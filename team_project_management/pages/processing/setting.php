<?php
$sql_profile = "SELECT * FROM nguoidung where IDNguoiDung = '".$user_id."'";
$query_profile = mysqli_query($mysqli, $sql_profile);
$row = mysqli_fetch_assoc($query_profile);

if(isset($_POST['profile-save'])){
    $name = $_POST['name'];
    $bio = $_POST['bio'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $sql_update_profile = "UPDATE nguoidung SET Ten = '".$name."', MoTa = '".$bio."', email = '".$email."', SoDienThoai = '".$phonenumber."', NgaySinh = '".$birthday."', GioiTinh = b'$gender' where IDNguoiDung = '".$user_id."'";
    mysqli_query($mysqli,$sql_update_profile);

    $sql_profile = "SELECT * FROM nguoidung WHERE IDNguoiDung='$user_id'";
    $query_profile = mysqli_query($mysqli, $sql_profile);
    $row = mysqli_fetch_assoc($query_profile);
}

//

if(isset($_POST['security-save'])){
    $password = md5($_POST['password']);
    $new_password = md5($_POST['new-password']);
    $again_password = md5($_POST['again-password']);
    
    $sql = "SELECT * FROM NguoiDung WHERE IDNguoiDung = '".$user_id."'";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($query);
    if($password != $row['MatKhau'] && $new_password != $again_password){
        $message = '<li><p style="color: var(--red);">Mật khẩu không đúng. Vui lòng nhập lại!</p></li>';
    }elseif($new_password != $again_password){
        $message = '<li><p style="color: var(--red);">Mật khẩu mới không khớp. Vui lòng nhập lại!</p></li>';
    }elseif($password != $row['MatKhau']){
        $message = '<li><p style="color: var(--red);">Mật khẩu không đúng. Vui lòng nhập lại!</p></li>';
    }
    else{
        mysqli_query($mysqli,"UPDATE NguoiDung SET MatKhau = '".$new_password."' WHERE IDNguoiDung = '".$user_id."'");
        $message = '<li><p style="color: var(--primary);">Đổi mật khẩu thành công!</p></li>';
    }
}


if (isset($_FILES['avatar'])) {

    $imageData = $_FILES['avatar']['tmp_name'];
    $base64 = base64_encode(file_get_contents($imageData));

    $sql = "UPDATE nguoidung 
            SET AnhDaiDien = '$base64' 
            WHERE IDNguoiDung = $user_id";

    mysqli_query($mysqli, $sql);

    // Load lại trang để hiển thị avatar mới
    echo "<meta http-equiv='refresh' content='0'>";
}
