<?php
echo '<form action="index.php?page=2" method="post">';
//define the current user name
$ruser='';
if(!isset($_SESSION['reg']) || $_SESSION['reg'] =="")
{
    $ruser="cart";
}
else
{
    $ruser=$_SESSION['reg'];
}
//total cost of the cart
$total=0;
foreach($_COOKIE as $k => $v)
{
    $pos=strpos($k,"_");
    if(substr($k,0,$pos) == $ruser)
    {
        //get the item id
        $id=substr($k,$pos+1);
        //create the item object by id
        $item=Item::fromDb($id);
        //increase the total cost
        $total+=$item->pricesale;
        //draw the item
        echo '<div class="row" style="margin-right:10px;">';
        $item->DrawForCart();
        echo '</div>';
    }
}
echo '<hr/>';
echo "<span style='margin-left:100px;color:blue;fontsize:16pt;background-color:#fffff;' class='' >Total cost is: </span><span style='marginleft:10px;
color:red;font-size:16pt;background-color:#ffffff;' class='' >".$total."</span>";
echo '<button type="submit" class="btn btn-success" name="suborder" style="margin-left:150px;" onkeyup=eraseCookie("'.$ruser.'")>
Purchase order</button>';
echo '</form>';
if(isset($_POST['suborder']))
{
    foreach($_COOKIE as $k => $v)
    {
        $pos=strpos($k,"_");
        if(substr($k,0,$pos) == $ruser)
        {
            //get the item id
            $id=substr($k,$pos+1);
            //create the item object by id
            $item=Item::fromDb($id);
            //sale the item
            $item->Sale();
        }
    }
}
if(isset($_GET['erase'])){
    $link=Tools::connect();
    $query="SELECT amount FROM cart WHERE ID=?";
    $ps = $link->prepare($query);
    $am=$ps->execute($_GET['id']);
    if ($am===1){
        $query="DELETE FROM cart WHERE ID=?";
        $ps = $link->prepare($query);
        $ps->execute($_GET['id']);
    }
    else{
        $query="UPDATE cart SET amount=amount-1 WHERE ID = ?";
        $ps = $link->prepare($query);
        $ps->execute($_GET['id']);
    }
}
if(isset($_GET['include'])){
    $id=$_GET['id'];
    //create the item object by id
    $item=Item::fromDb($id);
    //increase the total cost
    $total+=$item->pricesale;
    $item->Sale();
}
else{
    $id=$_GET['id'];
    //create the item object by id
    $item=Item::fromDb($id);
    //increase the total cost
    $total-=$item->pricesale*$_GET['amount'];
}
?>
<script>
    //deleting cookie with javascript
    function eraseCookie(uname)
    {
        var theCookies = document.cookie.split(';');
        for (var i = 1 ; i <= theCookies.length; i++)
        {
            if(theCookies[i-1].indexOf(uname) === 1)
            {
                var theCookie=theCookies[i-1].split('=');
                var date = new Date(new Date().getTime()-60000);
                document.cookie =theCookie[0]+"="+"id"+"; path=/;expires=" + date.toUTCString();
            }
        }
    }
</script>