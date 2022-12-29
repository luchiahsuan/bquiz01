<?php
include "base.php";


$text=$_POST['text'];

$Ad->save(['text'=>$text,'sh'=>1]);

to('../back.php?do=ad');

?>