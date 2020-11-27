<?php error_reporting(0); ?>
<!-- Footer -->
<div class="container pt-3">
<p class="float-left" id="time"></p>
<?php
if (isset($_SESSION['UserData']['Username'])){
  $admin_msg = '<p class = "float-right">&nbsp;Congratulation! You are logged into password protected page. <a href="logout.php">Click here to Logout.</a></p>';
  echo $admin_msg;
  } else {
    $admin_msg = '<p class="float-right"><a href="login.php" class="btn btn-dark">Admin</a></p>';
    echo $admin_msg;
  }
  ?>
  </div>
<script>
    var myTime = document.getElementById('time');
    setInterval(function(){myTime.innerHTML = new Date();},1000);
</script>
