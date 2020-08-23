<?php

require_once('db_connect.php');
date_default_timezone_set("Europe/London");
$first_name = "";
$last_name = "";
$department = "";
$temp_check = "";
$employee_id=0;

if(!session_start()){
echo "session not started";
}

if (isset($_POST['save'])){
# Get data from form
$first_name = filter_input(INPUT_POST,'first_name');
$last_name =  filter_input(INPUT_POST,'last_name');
$department = filter_input(INPUT_POST,'department');
$temp_check = filter_input(INPUT_POST,'temp_check');

# Create timestamp for check in time
$date_in = date('Y-m-d H:i:s');

# Verify that everything has bee entered (should not be required as validation is done in HTML intput form with bootstrap validation classes)
if($first_name == null || $last_name == null ){
# Print an error if values aren't entered
$err_msg = "All values not entered<br>";
include('db_error.php');

# Validate Data with Regular Expressions
# Regular Expressions are codes used to match patterns
# Check if first name contains only characters with a max of 30
} elseif(!preg_match("/[a-zA-Z]{3,30}$/", $first_name)){
$err_msg = "First name not valid<br>";
include('db_error.php');
} elseif(!preg_match("/[a-zA-Z]{3,30}$/", $last_name)){
$err_msg = "Last name not valid<br>";
include('db_error.php');
} elseif(!preg_match("/[a-zA-Z]{0,30}$/", $department)){
  $err_msg = "Department not valid<br>";
  include('db_error.php');
} else { 
  if (!($temp_check==1)) {
# if temperature is not 'Y' go home.
$temp_ok='NOK';
$employee_msg = "You should check out now<br> and return home.<br>";
} else{
$temp_ok='OK';
$employee_msg = "You can proceed into the building.<br> Remember to checkout when you leave.<br>";
}

# Create your query using : to add parameters to the statement
$query_employee_create = 'INSERT INTO employees (first_name, last_name ,department, checkin, employee_id, temp_check) 
VALUES (:first_name, :last_name,:department, :checkin, :employee_id, :temp_check)';

# Create a PDOStatement object
$employee_create_statement = $db->prepare($query_employee_create);

# Bind values to parameters in the prepared statement
$employee_create_statement->bindValue(':first_name',$first_name);
$employee_create_statement->bindValue(':last_name',$last_name);
$employee_create_statement->bindValue(':temp_check',$temp_ok);
$employee_create_statement->bindValue(':checkin',$date_in);
$employee_create_statement->bindValue(':department',$department);
$employee_create_statement->bindValue(':employee_id',null,PDO::PARAM_INT);

# Execute the query and store true or false based on success
$execute_create_success = $employee_create_statement->execute();
$employee_create_statement->closeCursor();

if (!$execute_create_success){
# If an error occurred print the error 
print_r($employee_create_statement->errInfo()[2]);
$_SESSION['message']='Record has not been saved due to an error!<br>';
$_SESSION['msg_type']='success';
} else{
  $_SESSION['message']='Record has been saved!<br>' . $employee_msg;
  $_SESSION['msg_type']='success';
}
}



header("location: index.php");
}


# Delete button is pressed
if(isset($_GET['delete'])){
$employee_id = $_GET['delete'];
$query_employee_delete = 'DELETE FROM employees WHERE employee_id=:employee_id';

# Create a PDO statement object
$employee_delete_statement = $db->prepare($query_employee_delete);

# Bind values to parameters in the prepared statement
$employee_delete_statement->bindValue(':employee_id',$employee_id,PDO::PARAM_INT);

# Execute the query and store true or false based on success
$execute_delete_success = $employee_delete_statement->execute();
$employee_delete_statement->closeCursor();

if (!$execute_delete_success){
  print_r($employee_delete_statement->errInfo()[2]);
  $_SESSION['message']='Record was not deleted due to an error!';
  $_SESSION['msg_type']='danger';
} else {
  $_SESSION['message']='Record has been deleted!';
  $_SESSION['msg_type']='danger';
}
header("location: index.php");
}

# Edit button is pressed (update record)
if(isset($_GET['edit'])){
  $employee_id = $_GET['edit'];
  $query_employee_edit = 'SELECT * FROM employees WHERE employee_id=:employee_id';
  
  # Create a PDO statement object
  $employee_edit_statement = $db->prepare($query_employee_edit);
  
  # Bind values to parameters in the prepared statement
  $employee_edit_statement->bindValue(':employee_id',$employee_id,PDO::PARAM_INT);
  
  # Execute the query and store true or false based on success
  $execute_edit_success = $employee_edit_statement->execute();

  if (!$execute_edit_success){
    print_r($employee_edit_statement->errInfo()[2]);
   
  } else{
    $employee_edit = $employee_edit_statement->fetchAll();
   echo "fetching employes";
    $first_name = $employee_edit[0]['first_name'];
    $last_name = $employee_edit[0]['last_name'];
    $department = $employee_edit[0]['department'];
    $temp_check = $employee_edit[0]['temp_check'];
  }
  $employee_edit_statement->closeCursor();
  }

  # Edit button is pressed (update record)
if(isset($_POST['update'])){
  $employee_id = $_POST['employee_id'];
  $first_name = filter_input(INPUT_POST,'first_name');
  $last_name =  filter_input(INPUT_POST,'last_name');
  $department = filter_input(INPUT_POST,'department');
  $temp_check = filter_input(INPUT_POST,'temp_check');

  $query_employee_update = 'UPDATE employees
                            SET first_name = :first_name, last_name=:last_name,
                            department=:department, temp_check=:temp_check
                            WHERE employee_id=:employee_id';
  
  # Create a PDO statement object
  $employee_update_statement = $db->prepare($query_employee_update);

  # Bind values to parameters in the prepared statement
$employee_update_statement->bindValue(':first_name',$first_name);
$employee_update_statement->bindValue(':last_name',$last_name);
$employee_update_statement->bindValue(':temp_check',$temp_check);
$employee_update_statement->bindValue(':department',$department);
$employee_update_statement->bindValue(':employee_id',$employee_id,PDO::PARAM_INT);
  
  # Execute the query and store true or false based on success
  $execute_update_success = $employee_update_statement->execute();
  $employee_update_statement->closeCursor();
  if (!$execute_update_success){
    print_r($employee_update_statement->errInfo()[2]);
    $_SESSION['message']='Record has not been updated due to an error!';
    $_SESSION['msg_type']='danger';
  } else{
    $_SESSION['message']='Record was updated!';
    $_SESSION['msg_type']='warning';
  }
  header('location:index.php');
}

# Checkout button is pressed (check out employee)
if(isset($_GET['checkout'])){

  # Create timestamp for check out time
$date_out = date('Y-m-d H:i:s');

  $employee_id = $_GET['checkout'];
  $query_employee_checkout = 'UPDATE employees
                              SET checkout=:date_out WHERE employee_id=:employee_id';
  
  # Create a PDO statement object
  $employee_checkout_statement = $db->prepare($query_employee_checkout);
  
  # Bind values to parameters in the prepared statement
  $employee_checkout_statement->bindValue(':employee_id',$employee_id,PDO::PARAM_INT);
  $employee_checkout_statement->bindValue(':date_out',$date_out);
  
  # Execute the query and store true or false based on success
  $execute_checkout_success = $employee_checkout_statement->execute();

  if (!$execute_checkout_success){
    print_r($employee_checkout_statement->errInfo()[2]);
    $_SESSION['message']='An error occured!';
    $_SESSION['msg_type']='danger';
  } else{
    $_SESSION['message']='You have successfully checked out!';
    $_SESSION['msg_type']='success';
  }
  header('location:index.php');
  }
