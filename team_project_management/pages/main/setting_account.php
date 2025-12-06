<li id="account" class="page-section hover">
            <h3>Thay đổi thông tin cá nhân</h3>     
            <form action="" method="post">
                <ul class="profile-setting">
                    <li>
                        <p>Tên: </p>
                        <input type="text" class="input-text" name="name" value="<?php echo $row['Ten'] ?>" required>
                        <p>Giới thiệu: </p>
                        <textarea class="textarea" name="bio" id=""><?php echo $row['MoTa'] ?></textarea>
                    </li>
                    <li>
                        <p>Email: </p>
                        <input type="email" class="input-text" name="email" value="<?php echo $row['Email'] ?>" required>
                        <p>Số điện thoại: </p>
                        <input type="number" class="input-text" name="phonenumber" value="<?php echo $row['SoDienThoai'] ?>">
                    </li>
                    <li>
                        <p>Ngày sinh: </p>
                        <input type="date" name="birthday" value="<?php echo $row['NgaySinh'] ?>" required>
                    </li>
                    <li>
                        <p>Giới tính: </p>
                        <input type="radio" name="gender" value="1" 
                            <?= ($row['GioiTinh'] !== null && $row['GioiTinh'] == 1) ? 'checked' : '' ?>> Nam
                        <input type="radio" name="gender" value="0" 
                            <?= ($row['GioiTinh'] !== null && $row['GioiTinh'] == 0) ? 'checked' : '' ?>> Nữ
                    </li>

                    <li>
                        <button type="submit" class="button" name="profile-save">Lưu</button>
                    </li>
                </ul>
            </form> 
        </li>