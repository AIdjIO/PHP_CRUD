<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	#header('Location: '.$uri.'/');
	#exit;
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
   <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
<style>
.center {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  width:100%;
  margin:auto;
  vertical-align:middle;
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.one, .two, .three {float:left;}

.fa-users:hover{
    color:#FFFFFF !important;
    background-color:DodgerBlue;
}

.fa-ticket:hover{
    color:#FFFFFF !important;
    background-color:MediumSeaGreen;
}

div.polaroid {
width:50%;
height:50%;
padding:10px;
margin:0px;
  border-radius:10px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
} 

.fa {
  font-size:15em;
}

.content {
  font-weight:bold;
  font-feature-settings: "c2sc", "smcp";
  vertical-align:center;
  text-align:center;
}

</style>
<script src="./assets/js/fontawesome.config.js"></script>
</head>
<body>
<div class="center">
<form action="checkin.php" method="post">
<div class="one polaroid">
<button class="btn btn-warning btn-block" type="submit" name="employee">
<i class="fa fa-users style=" style="color:DodgerBlue"></i>
</button>
<hr>
<div class="content" style="padding: 5px; font-size:60px;">Employee</div>
</div>
<div class="two polaroid">
<button class="btn btn-warning btn-block" type="submit" name="visitor">
<i class="fa fa-ticket fa-ticket-alt" style="color:MediumSeaGreen"></i>
</button>
<hr>
<div class="content" style="padding: 5px; font-size:60px;">Visitor</div>
</div>
</form>
<?php error_reporting(0); ?>
<br>
<div style="display:block">
<?php
footer('location:footer.php');
?>
</div>
</body>
</html>


