<?php
$mysqli = new mysqli("localhost","root","","quanlyduan");

if ($mysqli->connect_errno) {
  echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
  exit();
}

$mysqli->query("SET GLOBAL event_scheduler = ON");
$sql = "
CREATE EVENT IF NOT EXISTS update_congviec_trangthai
ON SCHEDULE EVERY 1 MINUTE
STARTS CURRENT_TIMESTAMP
DO
UPDATE quanlyduan.congviec SET TrangThai = 0 
WHERE NgayKetThuc < NOW() AND TrangThai IS NULL
";
$mysqli->query($sql);

?>