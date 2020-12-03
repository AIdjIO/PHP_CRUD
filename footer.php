<?php error_reporting(0); ?>
<!-- Footer -->
<style>
.footer {
  /* position: fixed; */
  display: inline-block;
  left: 0;
  bottom: 0vh;
  width: 100%;
  text-align: center;
}
</style>

<footer class="footer mt-5 pt-5">
<?php if(isset($_SESSION['UserData']['Username'])):?>
  <a class="" data-toggle="collapse" href="#admin_collapse" role="button" aria-expanded="false" aria-controls="collapse">
    <p class="bg-warning lead" style="text-align:right;">hide admin area</p>
        <?php else: ?>
          <a class="" data-toggle="collapse" href="#admin_collapse" role="button" aria-expanded="false" aria-controls="collapse">
          <p class="bg-warning lead" style="text-align:right;">show admin area</p>
          </a>
          <?php endif ?>
<div id="admin_collapse" class="container <?php echo (isset($_SESSION['UserData']['Username']))? '':'collapse';?>" >
<p class="float-left" id="time"></p>
<?php
if (isset($_SESSION['UserData']['Username'])){
  $admin_msg = '<p class = "float-right">&nbsp;Congratulation! You are logged as admin. <a href="logout.php">Click here to Logout.</a></p>';
  echo $admin_msg;
  } else {
    $admin_msg = '<p class="float-right"><a href="login.php" class="btn btn-dark">Admin</a></p>';
    echo $admin_msg;
  }
  ?>
  </div>
</footer>
<script>
    var myTime = document.getElementById('time');
    setInterval(function(){myTime.innerHTML = new Date();},1000);
</script>
