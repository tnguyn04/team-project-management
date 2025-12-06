<?php include('pages/processing/project.php'); ?>
<?php
$show_detail = isset($_GET['id_project']);

if(isset($_GET['tab'])){
    $temp=$_GET['tab'];
}else{
    $temp='';
}
if($temp=='member'){
    include("project_member.php");
}elseif($temp=='leader'){
    include("project_leader.php");
}elseif($temp=='complete'){
    include("project_complete.php");
}
else{
    include("project_member.php");
}

if(isset($_GET['id_project'])){
    include("project_detail.php");
}
?>

<!-- ------------ -->






