<?php error_reporting(0);
# I create a PHP Data Object to work with our DB
# Using a PDO allows the same PHP code to work with
# multiple types of DBs.
# Make the userid and password constants

DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');

# Defines the data source name which is MySQL, local
# and the DB to use
$data_source='mysql:host=localhost;dbname=db_crud_vms';
try { # try to connect to database
    $db=new PDO($data_source, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    $err_msg = $e->getMessage();
    include('db_error.php');
    exit();
}