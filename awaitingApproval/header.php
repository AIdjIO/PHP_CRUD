<?php error_reporting(0); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Employee Check In/Out</title>
   <link rel="stylesheet" type="text/css" href="../assets/css/main.min.css" />
   <link rel="stylesheet" type="text/css" href="../assets/css/datatables.min.css"/>
   <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
   <script src="../assets/js/jquery-3.5.1.min.js"></script>
   <script type="text/javascript" src="../assets/js/pdfmake.min.js"></script>
   <script type="text/javascript" src="../assets/js/vfs_fonts.js"></script>
   <script type="text/javascript" src="../assets/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" src="../assets/js/datatables.min.js"></script>
   <script type="text/javascript" src="../assets/js/dataTables.buttons.min.js"></script>
   <script type="text/javascript" src="../assets/js/buttons.flash.min.js"></script>
   <script type="text/javascript" src="../assets/js/jszip.min.js"></script>
   <script type="text/javascript" src="../assets/js/buttons.html5.min.js"></script>
   <script type="text/javascript" src="../assets/js/buttons.print.min.js"></script>
   <script type="text/javascript" src="../assets/js/popper.min.js"></script>
   <script src="../assets/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="../assets/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
   <style>
       <?php if (!isset($_SESSION['UserData']['Username'])) : ?>
       .dt-buttons {
           display:none;
           visibility:hidden;
       }
       <?php else : ?>
        .dt-buttons {
           display:block;
           visibility:visible;
       }
       <?php endif ?>

       </style>
  </head>
