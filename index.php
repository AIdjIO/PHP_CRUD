<?php  error_reporting(0);
#session_start(); /* Starts the session */
#session_destroy(); 

date_default_timezone_set("Europe/London");

require_once('db_connect.php');

if (isset($_GET['myToDate'])){
 $myToDate = $_GET['myToDate'];
} else {
  $myTodate = date("d m Y");
}

if (isset($_GET['myFromDate'])){
  $myFromDate = $_GET['myFromDate'];
} else {
  $myFromDate = date("d m Y");
}

if (!(isset($_GET["dateFilter"]))){
  $query_emp ='SELECT * FROM employees WHERE date(checkin)=date(now()) ORDER BY employee_id';
} else {
  $query_emp ="SELECT * FROM employees WHERE date(checkin) BETWEEN '" . $myFromDate . "' AND '" . $myToDate . "' ORDER BY employee_id";
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
       <img class = "rounded float-left "  src="./assets/images/your_logo.jpg">
  
    <?php if(isset($_SESSION['UserData']['Username'])):?>
      <form action="" name="dateForm" method="GET">
         
        From: <input class="btn btn-white" type="date" id="myFromDate" name="myFromDate" value="<?php echo $myFromDate;?>"/>
        To: <input class="btn btn-white" type="date" id="myToDate" name="myToDate" value="<?php echo $myToDate;?>"/>
        <button class="btn btn-info" type="submit" name="dateFilter">Go</button>
    </form>
<h1>
        <?php else: ?>
          <h1 class=" col-md-auto display-5 ">
          &nbsp;<?php echo date("d m Y");?> - <?php echo $location; ?> 
        <?php endif ?>Employee "Covid" Check In/Out </h1>
    <!-- set default value of input date element to todays date with Javascript -->
<p class="bg-warning lead">Please fill in the form, tick the checkbox to confirm whether your temperature exceeds 38°C else you should return home and self isolate/contact your GP.</p>
</div>  
  
    <div class="container-fluid pt-3">
      <div class="row">

<div class="col-md-2 border border-white rounded border-right-0">
    <h2>Check In</h2>
<p>Fill in the form below in order to check in</p>
<p>Don't forget to check out when you leave</p>
<?php include 'form.php' ?>
      </div>
      <div class="col-md-10 border border-white rounded">
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
          <td>
             <!-- if logged in as admin then create edit and delete buttons -->
            <?php if(isset($_SESSION['UserData']['Username'])):?>
            <a href="index.php?edit=<?php echo $employee['employee_id']; ?>" class="btn btn-info">Edit</a>
            <a href="process.php?delete=<?php echo $employee['employee_id']; ?>" class="btn btn-danger">Delete</a>
            <?php endif ?>
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
       ]
               } );
       } );
</script>
</body>
</html>