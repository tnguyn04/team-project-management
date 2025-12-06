<li id="security" class="page-section">
            <h3>Thay đổi mật khẩu</h3>     
            <form action="" method="post">
                <ul class="profile-setting setting-security">
                    <li>
                        <p>Mật khẩu hiện tại: </p>
                        <input type="password" class="input-text" name="password" required>
                
                    </li>
                    <li>
                        <p>Mật khẩu mới: </p>
                        <input type="password" class="input-text" name="new-password" >
                        <input type="password" placeholder="Nhập lại mật khẩu mới" class="input-text" name="again-password" required>
                    </li>
                    <?php if (!empty($message)) echo $message; ?>
                    <li>
                        <button type="submit" class="button" name="security-save">Lưu</button>
                    </li>
                </ul>
            </form> 
        </li>