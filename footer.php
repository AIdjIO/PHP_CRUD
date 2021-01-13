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
  <p class="float-left" id="time"></p>
  <a class="" data-toggle="collapse" href="#admin_collapse" role="button" aria-expanded="false" aria-controls="collapse">
    <p class="bg-warning lead" style="text-align:right;">admin area</p></a>
  
  

        
<div id="admin_collapse" class="container-fluid <?php echo (isset($_SESSION['UserData']['Username']))? 'collapse show':'collapse';?>" >
<?php if(isset($_SESSION['UserData']['Username'])):?>
    <p class = "float-right">&nbsp;Congratulation! You are logged as admin. <a href="logout.php">Click here to Logout.</a></p>
    <?php else: ?>
      <p class="float-right"><a href="login.php" class="btn btn-dark">Admin</a></p>
             <?php endif ?>
</div>
</footer>
<script>
    var myTime = document.getElementById('time');
    setInterval(function(){myTime.innerHTML = new Date();},1000);
</script>
