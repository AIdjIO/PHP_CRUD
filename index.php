<?php  
#error_reporting(0);
#session_start(); /* Starts the session */
#session_destroy(); 

date_default_timezone_set("Europe/London");

require_once('db_connect.php');

if (isset($_GET['myToDate'])){
 $myToDate = $_GET['myToDate'];
} else {
  $myToDate = date("Y-m-d");
}

if (isset($_GET['myFromDate'])){
  $myFromDate = $_GET['myFromDate'];
} else {
  $myFromDate = date("Y-m-d");
}

if (isset($_GET['myPerson'])){
  $myPersonChoice = $_GET['myPerson'];
} else {
  $myPersonChoice = '';
}
switch ($myPersonChoice){
  case 'all' :
    $myPerson = '';
  break;
  case 'employee':
    $myPerson = 0;
  break;
  case 'visitor':
    $myPerson = 1;
  break;
  default:
    $myPerson = '';
  }
  
if (!(isset($_GET["myFilters"]))){
  $query_emp ='SELECT * FROM employees WHERE date(checkin)=date(now()) ORDER BY employee_id';
} else {
  $query_emp ="SELECT * FROM employees WHERE isVisitor = '" . $myPerson . "' AND date(checkin) BETWEEN '" . $myFromDate . "' AND '" . $myToDate . "' ORDER BY employee_id";
}
    $employee_statement = $db->prepare($query_emp);
    $employee_statement->execute();
    $employees = $employee_statement->fetchAll();
    $employee_statement->closeCursor();

?>

<?php require_once 'process.php';?>
<?php include 'header.php';?>
  <body style="background-color:#e9ecef;">


  <?php  if ((isset($_SESSION['message']))): ?>
  <div class="alert alert-<?php echo $_SESSION['msg_type'];?>">
    <?php 
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
    <script>
      //  smooth alert fade out
$(document).ready(function () {
 
 window.setTimeout(function() {
     $(".alert").fadeOut({duration:1000, queue:false}).slideUp(1000, function(){
         $(this).remove(); 
     });
 }, 3500);
  
 });
</script>
    </div>
    <?php endif ?>

    <div class="container-fluid pt-3">
      
  <img class = "rounded float-left "  src="./assets/images/logo.png">
  
    <?php if(isset($_SESSION['UserData']['Username'])):?>

      <form action="" name="dateForm" method="GET">
        <div class="form-group">
        <label for="myFromDate">&nbsp;From:</label><input class="" type="date" id="myFromDate" name="myFromDate" value="<?php echo $myFromDate;?>"/>
        <label for="myToDate">To:</label><input class="" type="date" id="myToDate" name="myToDate" value="<?php echo $myToDate;?>"/>
        <label for="myPerson">filter by:</label>
        <select name="myPerson" id="myPerson" class="selectpicker">
          <option value="all">All</option>
          <option value="employee">Employee</option>
          <option value="visitor">Visitor</option>
          </select>
        <button class="btn btn-primary" type="submit" name="myFilters">Go</button>
    </div>
    </form>
<h1>
        <?php else: ?>
          <h1 class=" col-md-auto display-5 ">
          &nbsp;<?php echo date("d m Y");?> - <?php echo $location; ?> 
        <?php endif ?>"Covid" Check In/Out </h1>
    <!-- set default value of input date element to todays date with Javascript -->
<p class="bg-warning lead">Please fill in the form, tick the checkbox to confirm whether your temperature exceeds 38°C else you should return home and self isolate/contact your GP.</p>
</div>
<br>
  
<?php include 'front_page.php';?>
    <div class="container-fluid pt-3">
      <div class="row">

      <!-- <?php if(isset($_SESSION['UserData']['Username'])): echo '<div class="col-md-2 border border-white rounded border-right-0">'; else: echo '<div class="w-100 border border-white rounded border-right-0">'; endif;?> -->

    <!-- <h2>Check In</h2>
<p>Fill in the form below in order to check in</p>
<p>Don't forget to check out when you leave</p> -->
   <!-- </div> -->
<?php include 'form.php' ?>
<?php if(isset($_GET['edit']) || isset($_POST['employee']) || isset($_POST['visitor'])): ?>
   <script>
   $('#myModal').modal();
   </script>
   <?php endif; ?>
                 <!-- if logged in as admin then create edit and delete buttons -->
                 <?php if(isset($_SESSION['UserData']['Username'])):?>
                  <div class="container-fluid border border-white rounded">
    <h2>Employee List</h2>
    <table id="myTable" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;" role="grid" aria-describedby="example_info">
    <thead>
      <tr>
        <th colspan="6">Employee Details</th>
      <th colspan="2">Action</th>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Department</th>
        <th>Temp<br>OK?</th>
        <th>In</th>
        <th>Out</th>
        <th>Visitor</th>
        <th><span class="fas fa-user-edit"></span> <span class="fas fa-trash-alt"></span></th>
      </tr>
      </thead>
      <!-- Get an array from the DB query and cycle
      through each row of data -->
      <tbody>
      <?php foreach($employees as $employee): ?>
             <tr>
          <!-- Print out individual column data -->
          <td><?php echo $employee['employee_id']; ?></td>
          <td><?php echo $employee['first_name'] . ' ' . $employee['last_name']; ?></td>
          <td><?php echo $employee['department']; ?></td>
          <td><?php echo $employee['temp_check']; ?></td>
          <td><?php echo substr($employee['checkin'], 11, 8); ?></td>
          <td><?php echo substr($employee['checkout'], 11, 8); ?></td>
          <td><?php echo $employee['isVisitor'] == 1 ? "Visitor" : "Employee" ?></td>
          <td>
            <a href="index.php?edit=<?php echo ($employee['employee_id'] . '&visit=' . $employee['isVisitor'])?>" id="edit_link" class="btn btn-info" >Edit</a>
            <a href="process.php?delete=<?php echo $employee['employee_id']; ?>" class="btn btn-danger">Delete</a>

            <?php if (($employee['checkout']==null)): ?>
            <a href="process.php?checkout=<?php echo $employee['employee_id']; ?>" class="btn btn-success">Checkout</a>
            <?php endif ?>
          </td>
        </tr>
      <!-- Mark the end of the foreach loop -->
      <?php endforeach; ?>
      </tbody>
    </table>
            </div>
            <?php endif ?>
      </div>

      </div>
      <?php include 'footer.php'?>

    <script>

$(document).ready( function () {
           $('#myTable')
               .addClass( 'nowrap' )
               .dataTable( {
                   responsive: true,
                   columnDefs: [
                       { targets: [-1, -3], className: 'dt-body-right' }                      
         ],
         dom: 'Bfrtip',
       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       "order": [[ 0, "desc" ]]
               } );
       } );
   
  
</script>
</body>

</html>