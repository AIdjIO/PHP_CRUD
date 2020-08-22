<?php 

require_once('db_connect.php');
    $query_emp ='SELECT * FROM employees ORDER BY employee_id';
    $employee_statement = $db->prepare($query_emp);
    $employee_statement->execute();
    $employees = $employee_statement->fetchAll();
    $employee_statement->closeCursor();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee</title>
   <link rel="stylesheet" type="text/css" href="main.css" />
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.3/b-colvis-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.2/r-2.2.5/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.1/sl-1.3.1/datatables.min.css"/>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.21/af-2.3.5/b-1.6.3/b-colvis-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.2/r-2.2.5/rg-1.1.2/rr-1.2.7/sc-2.0.2/sp-1.1.1/sl-1.3.1/datatables.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  </head>
  <body>
  
  <?php require_once 'process.php';?>
  <?php  if (isset($_SESSION['message'])): ?>
  <div class="alert alert-<?=$_SESSION['msg_type']?>">
    <?php 
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>

    <div class="container">
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
            <a href="process.php?checkout=<?php echo $employee['employee_id']; ?>" class="btn btn-success">Checkout</a>
          </td>
        </tr>
      <!-- Mark the end of the foreach loop -->
      <?php endforeach; ?>
      </tbody>
    </table>

    <h2>Check In</h2>
<p>Fill in the form below in order to check in</p>
<p>Don't forget to check out when you leave</p>
<form action="process.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="employee_id" value="<?php echo $employee_id ?>" />
    <div class="form-group">
    <label for="uname">First Name:</label>
    <input class="form-control"  type="text" name="first_name" placeholder="Enter your first name" value="<?php echo $first_name; ?>" required/>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
    <label>Last Name:</label>
    <input class="form-control"  type="text" name="last_name" placeholder="Enter your last name" value="<?php echo $last_name; ?>" required/>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
    <label>Department:</label>
    <input class="form-control"  type="text" name="department" placeholder="Enter your department (optional)" value="<?php echo $department; ?>" />
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group form-check">
    <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name="temp_check" value="Y" required/>
    Have you checked your temperature is less than 38°C?<br>
    <div class="valid-feedback">Temperature OK</div>
    <div class="invalid-feedback">Check this checkbox to continue.</div>
    </label>
    </div>
    <div class="form-group">
      <?php if(isset($_GET['edit'])): ?>
        <button class="btn btn-warning" type="submit" name="update">Update</button>
      <?php else: ?>
        <button class="btn btn-primary" type="submit" name="save">Save</button>
      <?php endif ?>
    </div>
</form>
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