<!-- Trưởng nhóm -->
    <ul class="box-info" id="leader" style="<?= $show_detail ? 'display:none;' : ''; ?>">
        <?php while($p = $leader_projects->fetch_assoc()): ?>
            <li  class="hover">
                <a href="?page=project&tab=leader&id_project=<?= $p['IDDuAn'] ?>" class="box-info-project">
                    <i class='bx bxs-group icon-color icon-project--leader'></i>
                    <span class="text text-project--gap">
                        <h3><?php echo $p['TenDuAn']; ?></h3>
                        <p><?php echo $p['MoTa']; ?></p>
                    </span>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>