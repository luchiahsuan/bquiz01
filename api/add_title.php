<?php
include "base.php";

if(!empty($_FILE['img']['tmp_name'])){
    move_uploaded_file($_FILE['img']['tmp_name'],"../uplaod/".$_FILE['img']['tmp_name']);
    $img=$_FLIE['img']['name'];
}

$text=$_POST['text'];

$Title->save(['img'=>$img,'text'=>$text,'sh'=>0]);
to('../back.php?do=title');

?>