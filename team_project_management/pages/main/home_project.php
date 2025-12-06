<ul class="box-info">
    <?php while($row_prj_public = mysqli_fetch_assoc($query_prj_public)) { ?>
    <li class="hover">
        <a href="?page=home&id_project_public=<?= $row_prj_public['IDDuAn'] ?>">
            <div class="box-info-project">
                <i class='bx bxs-group icon-home' ></i>
                <span class="text text-project--gap">
                <h3><?php echo $row_prj_public['TenDuAn'] ?></h3>
                <p>Mô tả: <?php echo $row_prj_public['MoTa'] ?></p>
                </span>
            </div>
        </a>
    </li>
    <?php } ?>
    
</ul>