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
    $myPerson = '(0,1)';
  break;
  case 'employee':
    $myPerson = '(0)';
  break;
  case 'visitor':
    $myPerson = '(1)';
  break;
  default:
    $myPerson = '(0,1)';
  }
  
if (!(isset($_GET["myFilters"]))){
  $query_emp ='SELECT * FROM employees WHERE date(checkin)=date(now()) ORDER BY employee_id';
} else {
   $query_emp ="SELECT * FROM employees WHERE isVisitor IN " . $myPerson . " AND date(checkin) BETWEEN '" . $myFromDate . "' AND '" . $myToDate . "' ORDER BY employee_id";}
    $employee_statement = $db->prepare($query_emp);
    $employee_statement->execute();
    $employees = $employee_statement->fetchAll();
    $employee_statement->closeCursor();

?>

<?php require_once 'process.php';?>
<?php include 'header.php';?>
<body style="m-3 p-5 background-color:#e9ecef;">


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

    <div class="container-fluid">
      
  <img class="rounded float-left "  src="./assets/images/logo.png">
  
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
          <h1 class=" col-md-auto display-5 " style="text-align:center">
          &nbsp;<?php echo date("d/m/Y");?> - <?php echo $location; ?> 
        <?php endif ?>"Covid" Check In</h1>
    <!-- set default value of input date element to todays date with Javascript -->
    <?php if(isset($_SESSION['UserData']['Username'])):?>
    <a class="" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
    <p class="bg-warning lead" style="text-align:center;">Display Check In buttons</p>
        </a>
        <?php else: ?>
          <p class="bg-warning lead">Please fill in the form, tick the checkbox to confirm whether your temperature exceeds 38°C else you should return home and self isolate/contact your GP.</p>
          <?php endif ?>

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
    <h2>Employee/Visitor List</h2>
    <table id="myTable" class="display nowrap dataTable dtr-inline collapsed" style="width: 100%;" role="grid" aria-describedby="example_info">
    <thead>
      <tr>
        <th colspan="6">Employee/Visitor Details</th>
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
          <td><?php echo $employee['first_name'] . ' ' . strtoupper($employee['last_name']); ?></td>
          <td><?php echo strtoupper($employee['department']); ?></td>
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
           <tfoot>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Department</th>
        <th>Temp</th>
        <th>Phone</th>
        <th>In</th>
        <th>Out</th>
        <th>Visitor</th>
        <th><span class="fa fa-edit fa-1x text-info px-3"></span> <span class="fa fa-trash fa-1x text-danger px-3"></span><span class="fa fa-sign-out fa-1x text-success px-3"></span></th>
      </tr>
      </tfoot>
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
                // "scrollY": 200,
        // "scrollX": true,
                lengthMenu: [[-1,10, 25, 50], ["All",10, 25, 50]],
                   responsive: true,
                   fixedHeader: {header: true,footer: true},
                   columnDefs: [
                       { targets: [-1, -3], className: 'dt-body-right'},
                       {targets:[0],visible:false},

         ],
         dom: 'Bfrltip',
       buttons: [
          'colvis', 
          {extend: 'copy',exportOptions: {columns: [1,2,3,4,5,6,7]}}, 
          {extend: 'csv',exportOptions: {columns: [1,2,3,4,5,6,7]}},
          {extend: 'excel',exportOptions: {columns: [1,2,3,4,5,6,7]}},
          {text: 'PDF',extend: 'pdf',
          orientation: 'portrait', //landscape
					pageSize: 'A4', //A3 , A5 , A6 , legal , letter,
          // download: 'open',
          filename: myLocation +'Covid_CheckIn_Report_From_' + fromDate + '_To_' + toDate,
          exportOptions: {columns: [1,2,3,4,5,6,7]},customize: function (doc) {
            doc.content[1].margin = [20, 0, 20, 0 ] 
						//Remove the title created by datatTables
						doc.content.splice(0,1);
						//Create a date string that we use in the footer. Format is dd-mm-yyyy
						var now = new Date();
						var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
            var logo = 'data:image/png;base64,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';            doc.pageMargins = [20,60,20,30];
						// Set the font size for the entire document
						doc.defaultStyle.fontSize = 8;
						// Set the fontsize for the table header
						doc.styles.tableHeader.fontSize = 10;
            doc.styles.tableHeader.alignment = 'left';
						// Create a header object with 3 columns
						// Left side: Logo
						// Middle: brandname
						// Right side: A document title
						doc['header']=(function() {
							return {
								columns: [
									{
										image: logo,
										width: 24
									},
									{
										alignment: 'center',
										italics: true,
										text: 'Covid Checkin Report at ' + myLocation + ' from ' + fromDate + ' to ' + toDate,
										fontSize: 16,
										margin: [10,0]
									}
								],
								margin: 20
							}
						});
						// Create a footer object with 2 columns
						// Left side: report creation date
						// Right side: current page and total pages
						doc['footer']=(function(page, pages) {
							return {
								columns: [
									{
										alignment: 'left',
										text: ['Document generated on: ', { text: now.toLocaleString('en-GB', {dateStyle:"full",timeStyle:"medium", hour12:false}) }],
                    fontSize:7
									},
									{
										alignment: 'right',
										text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }],
                    fontSize:7
									}
								],
								margin: 10
							}
						}),
            doc.content[0].layout = 'headerLineOnly'; //noBorders , headerLineOnly, lightHorizontalLines
            // objLayout = {};
						// objLayout['hLineWidth'] = function(i) { return .5; };
						// objLayout['vLineWidth'] = function(i) { return .5; };
						// objLayout['hLineColor'] = function(i) { return '#000'; };
						// objLayout['vLineColor'] = function(i) { return '#000'; };
						// objLayout['paddingLeft'] = function(i) { return 4; };
						// objLayout['paddingRight'] = function(i) { return 4; };
						// doc.content[0].layout = objLayout;
          }
            },
          {extend: 'print',exportOptions: {columns: [1,2,3,4,5,6,7]}},
       ],
       "order": [[ 5, "desc" ]]
               } );
       } );
  
</script>
</body>
</html>
