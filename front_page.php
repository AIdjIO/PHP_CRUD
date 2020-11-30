
<style>
.center {
  display: table;
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

.fa-ticket{
  color:MediumSeaGreen;
}

.fa-users{
  color:DodgerBlue;
}

.fa-users:hover{
  color:#FFFFFF;
    background-color:DodgerBlue;
}

.fa-ticket:hover{
  color:#FFFFFF;
    background-color:MediumSeaGreen;
}

.fa {
  font-size:15em;
}

.card:hover{
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}
</style>

<form action="index.php" method="post">
<div class="card-deck">
<div class="card border-dark shadow-lg">
<button class="" type="submit" name="employee">
<i class="fa fa-users"></i>
</button>
<h3 class="card-header" style="text-align:center;">Employee</h3>
</div>
<div class="card border-dark">
<button class="" type="submit" name="visitor">
<i class="fa fa-ticket fa-ticket-alt"></i>
</button>
<h3 class="card-header" style="text-align:center">Visitor</h3>
</div>
</div>
</form>




