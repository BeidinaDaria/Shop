<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
  <div class="navbar-nav">
    <a class="nav-link active" aria-current="page" href="index.php?page=1">Магазин</a>
    <a class="nav-link" href="index.php?page=2">Личный кабинет</a>
    <a class="nav-link" href="index.php?page=3">Консоль администратора</a>
    <button id='tobasket' name='tobasket' onclick='tocart()'></button>
<?php
      if(isset($_SESSION['radmin'])){
        if($page==6)
          $c='active';
        else
          $c='';
        echo '<li class="'.$c.'"><a href="index.php?page=6">Private</a></li>';
      }
?>
<script>
  document.getElementById('tobasket').addEventListener('DOMContentLoaded',function(){
    document.getElementById('tobasket').innerText='Cart('+ document.cookie.split(';').length + ')';
  })
  function tocart(){
    window.location="pages/cart.php";
  }
</script>