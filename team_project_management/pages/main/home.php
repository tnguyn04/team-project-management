<?php 
include('pages/processing/home.php'); ?>

<?php 
if(isset($_GET['id_project_public'])){
    include("home_detail.php");
}else {
    include("home_project.php");
}
?>

		
