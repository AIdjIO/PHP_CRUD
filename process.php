<?php

require_once('db_connect.php');

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
if($first_name == null || $last_name == null || 
$temp_check == null){
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
} elseif(!preg_match("/[yY]{1}/", $temp_check)){
    $err_msg = $temp_check . " Temp Check Not Valid<br>";
    include('db_error.php');
} elseif (!($temp_check ==='Y')) {
  # if temperature is not 'Y' go home.
  $temp_check=false;
  echo "You need to return home.<br>";
} else{
  $temp_checked=true;
  echo "You can proceed into the building.<br> Remember to checkout when you leave.<br>";
 
    
    # Create your query using : to add parameters to the statement
    $query_employee_create = 'INSERT INTO employees (first_name, last_name ,department, checkin, employee_id, temp_check) 
    VALUES (:first_name, :last_name,:department, :checkin, :employee_id, :temp_check)';
    
    # Create a PDOStatement object
    $employee_create_statement = $db->prepare($query_employee_create);

     # Bind values to parameters in the prepared statement
     $employee_create_statement->bindValue(':first_name',$first_name);
     $employee_create_statement->bindValue(':last_name',$last_name);
     $employee_create_statement->bindValue(':temp_check',$temp_check);
     $employee_create_statement->bindValue(':checkin',$date_in);
     $employee_create_statement->bindValue(':department',$department);
     $employee_create_statement->bindValue(':employee_id',null,PDO::PARAM_INT);
 
     # Execute the query and store true or false based on success
     $execute_create_success = $employee_create_statement->execute();
     $employee_create_statement->closeCursor();

     if (!$execute_create_success){
         # If an error occurred print the error 
         print_r($employee_create_statement->errInfo()[2]);
     }
    }

    $_SESSION['message']='Record has been saved!';
    $_SESSION['msg_type']='success';

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
      }

      
    $_SESSION['message']='Record has been deleted!';
    $_SESSION['msg_type']='danger';

    header("location: index.php");
    
    }