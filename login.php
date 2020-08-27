<?php error_reporting(0);
include 'header.php';

 session_start(); /* Starts the session */
/* Check Login form submitted */
if(isset($_POST['Submit'])){
/* Define username and associated password array */
$logins = array('admin' => '123456');

/* Check and assign submitted Username and Password to new variable */
$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

/* Check Username and Password existence in defined array */
if (isset($logins[$Username]) && $logins[$Username] == $Password){
/* Success: Set session variables and redirect to Protected page  */
$_SESSION['UserData']['Username']=$logins[$Username];
header("location:index.php");
exit;
} else {
/*Unsuccessful attempt: Set error message */$msg="<span style='color:red'>Invalid Login Details</span>";
}
}
?>
<body style="background-color:#e9ecef;">
<div class="border container col-md-4 pt-3">
<form action="" method="post" name="Login_Form">
  <div class="form-group">
    <label for="username">Username</label>
    <input name="Username" type="text" class="form-control" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input name="Password" type="password" class="form-control" placeholder="Enter password" id="pwd">
  </div>
  <div class="form-group">
  <button name="Submit" type="submit" class="btn btn-primary">Login</button>
</div>
<div class="form-group">
  <a href="index.php" class="btn btn-primary">Return to Check In </a>
</div>
</form>
<?php if(isset($msg)):?>
      <p><?php echo $msg;?></p>
      <?php endif ?>
</div>
</body>
</html>