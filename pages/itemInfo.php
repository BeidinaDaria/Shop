<?php include_once("classes.php");
echo '<div class="row" style="margin-right:10px;">';
$item=Item::fromDb($_GET['name']);
    $item->DrawForCart();
echo '</div>';
?>