
<?php include 'header.php';?>
  <body style="background-color:#e9ecef;">

    <div class="container-fluid pt-3">
      
  <img class = "rounded float-left "  src="./assets/images/avl_logo.png">
  
          <h1 class=" col-md-auto display-5 ">
		  <span id="todayDate"></span>AVL Basildon Employee "Covid" Check In/Out </h1>

<p class="bg-warning lead">Please fill in the form, tick the checkbox to confirm whether your temperature exceeds 38°C else you should return home and self isolate/contact your GP.</p>
</div>  
  

<img class="img-fluid" src="./assets/images/Covid_CheckIn.png">

</body>
</html>
<script>
d=new Date();
document.getElementById("todayDate").innerHTML =" " + (d.getDate()) + "/" + (d.getMonth() + 1) + "/" + (d.getFullYear()) + " " ;
</script>