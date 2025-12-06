<?php include('pages/processing/setting.php'); ?>
    <ul class="box-info box-setting">
        <li class="hover">
            <div class="user-img-wrap">
                <div class="user-img">
                <form id="avatarForm" method="POST" enctype="multipart/form-data">
                    <input type="file" name="avatar" id="avatarInput" accept="image/*" hidden>

                    <!-- Ảnh đại diện -->
                    <img src="data:image/*;base64,<?= $row['AnhDaiDien']; ?>" id="avatarPreview">

                    <!-- Icon camera -->
                    <div class="camera-icon">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </form>
            </div>


            </div>
            <div class="user-meta">
                <div class="user-name">
                    <?php echo $row['Ten'] ?>
                </div>
                <div class="user-location">
                    <?php echo $row['MoTa'] ?>
                </div>
                <div class="user-profiles">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $row['Email'] ?>">
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
        </li>
        
        <?php
        if(isset($_GET['tab'])){
            $temp=$_GET['tab'];
        }else{
            $temp='';
        }
        if($temp=='account'){
            include("setting_account.php");
        }elseif($temp=='security'){
            include("setting_security.php");
        }elseif($temp=='connect'){
            include("setting_connect.php");
        }
        else{
            include("setting_account.php");
        }
        ?>
        
    </ul>

<script src="././js/setting.js"></script>




