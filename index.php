<?php 
include 'header.php';

date_default_timezone_set("Europe/London");

require_once('db_connect.php');
    $query_emp ='SELECT * FROM employees WHERE date(checkin)=date(now()) ORDER BY employee_id';
    $employee_statement = $db->prepare($query_emp);
    $employee_statement->execute();
    $employees = $employee_statement->fetchAll();
    $employee_statement->closeCursor();
    

?>


  <body style="background-color:#e9ecef;">
  <div class="jumbotron">
    <div class="clearfix">
  <img class= "rounded float-left" src="images/avl_logo.png">
<h1 class="display-4">AVL Basildon Employee "Covid" Check In</h1></div>
  
  <p class="lead">Please fill in the form, tick the checkbox to confirm you have checked your temperature does not exceed 38°C else you should return home and self isolate.</p>
  <hr class="my-4">
  <?php require_once 'process.php';?>
  <?php  if (isset($_SESSION['message'])): ?>
  <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php 
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>

    <div class="container-fluid">
      <div class="row">

<div class="col-md-2 border border-white rounded border-right-0">
    <h2>Check In</h2>
<p>Fill in the form below in order to check in</p>
<p>Don't forget to check out when you leave</p>
<form action="process.php" method="POST" >
        <input type="hidden" name="employee_id" value="<?php echo $employee_id ?>" />
    <div class="form-group">
    <label for="uname">First Name:</label>
    <input class="form-control"  type="text" name="first_name" placeholder="First name" value="<?php echo $first_name; ?>"title="First name" required/>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
    <label>Last Name:</label>
    <input class="form-control"  type="text" name="last_name" placeholder="Last name" value="<?php echo $last_name; ?>" title="Last name"required/>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
    <label>Department:</label>
    <input class="form-control"  type="text" name="department" placeholder="Department (optional)" value="<?php echo $department; ?>"  title="Department (optional)" />
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group form-check">
    <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name="temp_check" value="1" title="make sure you check your temperature with the thermometer provided"/>
    Is your temperature less than 38°C?<br>
    <div class="valid-feedback">Temperature OK</div>
    <div class="invalid-feedback">Check this checkbox to continue.</div>
    </label>
    </div>
    <div class="form-group">
      <?php if(isset($_GET['edit'])): ?>
        <button class="btn btn-warning btn-block" type="submit" name="update">Update</button>
      <?php else: ?>
        <button class="btn btn-primary btn-block" type="submit" name="save">Check In</button>
      <?php endif ?>
    </div>
</form>
      </div>
      <div class="col-md-10 border border-light rounded">
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
        <th>Temp checked</th>
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
          <td><?php echo $employee['checkin']; ?></td>
          <td><?php echo $employee['checkout']; ?></td>
          <td>
            <a href="index.php?edit=<?php echo $employee['employee_id']; ?>" class="btn btn-info">Edit</a>
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
      </div>
      <?php include 'footer.php'?>
      </div>
            </div>
    <script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
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