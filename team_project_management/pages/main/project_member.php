




    <!-- Thành viên -->
    <ul class="box-info show" id="member" style="<?= $show_detail ? 'display:none;' : ''; ?>">
        <?php while($p = $member_projects->fetch_assoc()): ?>
            <li  class="hover">
                <a href="?page=project&tab=member&id_project=<?= $p['IDDuAn'] ?>" class="box-info-project">
                    <i class='bx bxs-group icon-project--member'></i>
                    <span class="text text-project--gap">
                        <h3><?php echo $p['TenDuAn']; ?></h3>
                        <p><?php echo $p['MoTa']; ?></p>
                    </span>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>

    


