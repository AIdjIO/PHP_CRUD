
<style>

.card{
  margin: 10 auto;
}

.fa-ticket{
  font-size:15em;
  color:MediumSeaGreen;
}

.fa-users{
  font-size:15em;
  color:DodgerBlue;
}

button:hover .fa-users{
  color:#FFFFFF;
    background-color:DodgerBlue;
}

button:hover .fa-ticket{
  color:#FFFFFF;
    background-color:MediumSeaGreen;
}

.button:hover{
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

button {
  border:none;
}
</style>

<form action="index.php" method="post">
<div id="collapse" class="<?php echo (isset($_SESSION['UserData']['Username']))? 'collapse':'';?> row">
<div class="container-fluid">
<div class="row p-3">
<button class="col-sm-6  p-3" type="submit" name="employee">
<div class="card">
<i class="fa fa-users"></i>
<h3 class="card-footer m-0" style="text-align:center;">Employee</h3>
</div>
</button>


<button class="col-sm-6  p-3" type="submit" name="visitor">
<div class="card ">
<i class="fa fa-ticket fa-ticket-alt"></i>
<h3 class="card-footer m-0" style="text-align:center">Visitor</h3>
</div>
</button>
</div>
</div>
</div>
</form>

