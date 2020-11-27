<?php error_reporting(0); ?>
<button id="btnOpnCheckIn" class="btn btn-info btn-block" onclick="openForm()">Fill In Form</button>
<form style="display:<?php if (isset($_GET['edit'])): echo 'block'; else: echo 'none'; endif ?>;" id="myForm" action="process.php" method="POST" >
    <input type="hidden" name="employee_id" value="<?php echo $employee_id ?>" />
    <div class="form-group">
    <label for="first_name">First Name:</label>
    <input class="form-control"  type="text" name="first_name" placeholder="First name" value="<?php echo $first_name; ?>" title="First name" required/>
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
    
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="temp_check" value="1" title="make sure you check your temperature with the thermometer provided"/>
        <label class="form-check-label">
    Is your temperature less than 38°C?</label>
    <div class="valid-feedback">Temperature OK</div>
    <div class="invalid-feedback">Check this checkbox to continue.</div>
</div>
    
    <div class="form-group">
      <?php if(isset($_GET['edit'])): ?>
        <button class="btn btn-warning btn-block" type="submit" name="update">Update</button>
      <?php else: ?>
        <button class="btn btn-primary btn-block" type="submit" name="save">Check In</button>
      <?php endif ?>
        <button class="btn btn-info btn-block" type="button" onclick="closeForm()">Cancel</button>
     </div>
</form>
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
