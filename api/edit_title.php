<?php
include_once "base.php";

dd($_POST);

foreach($_POST['id']as $idx=>$id){
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        $Title->del($id);
        }else{
            $row=$Title->find($id);
            $row['text']=$_POST['text'][$idx];
            $row['sh']=(isset($_POST['sh']) && $_POST['sh']==$id)?1:0;
            $Title->save($row);
        }
}


//舊方式
// foreach($_POST['id'] as $idx->$id){
// $row=$Title->find($id);
// $row['text']=$_POST['text'][$idx];
// }

// $row1=$Title->find($_POST['sh']);
// foreach($_POST['id']as $id){
//     $row2=$Title->find($id);
//     $eow2['sh']=0;
//     $Title->save($row2);
// }

// $row1['sh']=1;
// $Title->save($row1);

// foreach($_POST['del']as $id){
//     $Title->del($id);
// }

to("../back.php?do=title");
?>
