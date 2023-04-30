<?php
include_once('classes.php');
$cat=$_POST['cat'];
$pdo=Tools::connect();
//calling GetItems() method with parameter
$items=Item::GetItems($cat);
if($items==null) exit();
//drawing selected items
foreach($items as $item)
{
    $item->Draw();
}
?>