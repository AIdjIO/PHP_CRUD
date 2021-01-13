<?php
    require_once('db_connect.php');

    echo date('Y-m-d' ,strtotime('-30 days'));

    $query_emp = 'DELETE FROM employees WHERE date(checkin)<=' . date('Y-m-d' ,strtotime('-30 days'));
          $employee_statement = $db->prepare($query_emp);
          $employee_statement->execute();
          $employees = $employee_statement->fetchAll();
          $employee_statement->closeCursor();
?>