<?php
if(!isset($_POST['addbtn']))
{
?>
<form action="index.php?page=4" method="post" enctype="multipart/form-data" >
    <label for="catid">Category:</label>
    <select class="" name="catid">
        <?php
        $pdo=Tools::connect();
        $list=$pdo->query("SELECT * FROM Categories");
        while ($row=$list->fetch())
        {
            echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
        }
        ?>
    </select>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="" name="name">
    </div>
    <div class="form-group">
        <label for="pricein">Incoming Price and Sale Price:</label>
        <div>
            <input type="number" class="" name="pricein">
            <input type="number" class="" name="pricesale">
        </div>
    </div>
    <div class="form-group">
        <label for="info">Description:</label>
        <div>
            <textarea class="" name="info"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="imagepath">Select image:</label>
        <input type="file" class="" name="imagepath">
    </div>
    <button type="submit" class="btn btn-primary" name="addbtn">Register</button>
</form>
<?php
}
else
{
    if(is_uploaded_file($_FILES['imagepath']['tmp_name']))
    {
        $path="images/".$_FILES['imagepath']['name'];
        move_uploaded_file($_FILES['imagepath']['tmp_name'], $path);
    }
    $catid=$_POST['catid'];
    $pricein=$_POST['pricein'];
    $pricesale=$_POST['pricesale'];
    $name=trim(htmlspecialchars($_POST['name']));
    $info=trim(htmlspecialchars($_POST['info']));
    $item=new Item($name,$catid,$pricein,$pricesale,$info,$path);
    $item->intoDb();
}
?>