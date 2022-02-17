<?php
$connect = mysqli_connect('localhost', 'ncvinh', 'vinh2000', 'task_manage11r');
mysqli_set_charset($connect, "utf8");
function err($str){
    echo "<script type='text/javascript'>alert('".$str."');</script>";
}
?>