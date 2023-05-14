<h3>Login</h3>
<?php
include_once("classes.php");
if(!isset($_POST['logbtn'])&&!isset($_POST['regbtn']))
{
?>
<form action="index.php?page=3" method="post" enctype="multipart/form-data" >
    <div class="form-group">
        <label for="log">Login:</label>
        <input type="text" class="form-control" name="log">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password">   
    </div>
    <button type="submit" class="btn btn-primary" name="logbtn">Login</button>
    <button type="submit" class="btn btn-primary" name="regbtn">Registration</button>
</form>
    <?php
    }
    else
    {
        if(isset($_POST['logbtn'])){
            $t=new Tools();
            $f=$t->login($_POST['log'],$_POST['password']);
            if($f)
            {
                echo "<h3/><span style='color:green;'>Welcome!</span><h3/>";
            }
        }
        else include_once("registration.php");
    }
?>