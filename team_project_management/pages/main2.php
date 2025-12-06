
<?php
if(isset($_GET['page'])){
    $temp=$_GET['page'];
}else{
    $temp='';
}
if($temp=='home'){
    include("main/home.php");
}elseif($temp=='project'){
    include("main/project.php");
}elseif($temp=='chat'){
    include("main/chat.php");
}elseif($temp=='statis'){
    include("main/statis.php");
}elseif($temp=='add_project'){
    include("main/add_project.php");
}elseif($temp=='setting'){
    include("main/setting.php");
}elseif($temp=='project_detail'){
    include("main/project_detail.php");
}
else{
    include("main/home.php");
}
?>



