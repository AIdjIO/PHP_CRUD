<?php error_reporting(1); ?>
<!-- <button id="btnOpnCheckIn" class="btn btn-info btn-block" onclick="openForm()">Fill In Form</button>
   -->
<?php $isVisitor = isset($_POST['visitor']);?>

<div class="modal fade" tabindex="-1" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content p-3 m-3">
<form role="form" class="form-horizontal" id="myForm" action="process.php" method="POST" >
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Check In Form</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
    <input type="hidden" name="employee_id" value="<?php echo $employee_id ?>" />
    <input type="hidden" name="isVisitor" value="<?php echo $isVisitor ?>" />
    <div class="form-group pt-2">
    <label for="first_name">First Name:</label>
    <input class="form-control"  type="text" name="first_name" placeholder="First name" value="<?php echo $first_name; ?>" title="First name" required/>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group pt-2">
    <label>Last Name:</label>
    <input class="form-control "  type="text" name="last_name" placeholder="Last name" value="<?php echo $last_name; ?>" title="Last name"required/>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group pt-2">
    <?php if (isset($_POST['visitor']) || $_GET['visit']):?>
    <label>Company Name:</label>
    <input class="form-control "  type="text" name="department" placeholder="Company Name (Optional)" value="<?php echo $department; ?>"  title="Company Name" />
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    <label for="phone">Enter your phone number:</label>
    <input class="form-control" type="tel" id="phone" placeholder="01234567890" name="phone" value="<?php echo $phone; ?>" pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    <?php else: ?>
    <label>Department:</label>
    <input class="form-control pt-2"  type="text" name="department" placeholder="Department" value="<?php echo $department; ?>"  title="Department" />
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    <?php endif;?>
    </div>
    <div class="form-check">
        <label class="pr-4">Tick the box if your temperature is less than 38°C?</label>
        <input class="form-check-input" type="checkbox" name="temp_check" value="1" title="make sure you check your temperature with the thermometer provided"/>
    <div class="valid-feedback">Temperature OK</div>
    <div class="invalid-feedback">Check this checkbox to continue.</div>
    </div>
    
    <!-- <div class="form-group">  -->
     <div class="modal-footer">
      <?php if(isset($_GET['edit'])): ?>
      <button class="btn btn-warning btn-block" type="submit" name="update">Update</button>
      <?php else: ?>
      <button class="btn btn-primary btn-block" type="submit" name="save">Check In</button>
      <?php endif ?>
      <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <!-- <button class="btn btn-info btn-block" type="button" onclick="closeForm()">Cancel</button>
     </div> -->
             <!-- Modal footer -->
          <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
        </div>
</form>
</div>
</div>
</div>

<script>
function closeForm() {
  document.getElementById("myForm").style.display = "none";
  document.getElementById("btnOpnCheckIn").style.display = "block";
}
function openForm() {
  document.getElementById("myForm").style.display = "block";
  document.getElementById("btnOpnCheckIn").style.display = "none";
}
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
</script>
