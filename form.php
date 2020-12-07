<?php error_reporting(0); ?>
<!-- <button id="btnOpnCheckIn" class="btn btn-info btn-block" onclick="openForm()">Fill In Form</button>
   -->
<?php $isVisitor = isset($_POST['visitor']);?>
<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: relative;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
<div class="modal fade" tabindex="-1" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content p-3 m-3">
<form role="form" class="form-horizontal" id="myForm" action="process.php" method="POST"autocomplet="off" >
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Check In Form</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
    <input type="hidden" name="employee_id" value="<?php echo $employee_id ?>" />
    <input type="hidden" name="isVisitor" value="<?php echo $isVisitor ?>" />
    <div class="form-group pt-2">
    <label for="first_name">First Name:</label>
    <input id="firstNameInput" class="form-control"  type="text" name="first_name" placeholder="First name" value="<?php echo $first_name; ?>" title="First name" onkeyup="showHint(this.value)" required/>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group pt-2">
    <label>Last Name:</label>
    <input id="lastNameInput" class="form-control "  type="text" name="last_name" placeholder="Last name" value="<?php echo $last_name; ?>" title="Last name" onkeyup="showHint(this.value)" required/>
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

// function showHint(str) {
//   if (str.length == 0) {
//     document.getElementById("firstNameInput").innerHTML = "";
//     return;
//   } else {
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//       if (this.readyState == 4 && this.status == 200) {
//         document.getElementById("firstNameInput").innerHTML = this.responseText;
//       }
//     };
//     xmlhttp.open("GET", "gethint.php?q=" + str, true);
//     xmlhttp.send();
//   }
// }

function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];
var firstName = ["Prashant","Florin","Varun","John","Onenc","Jason","Sharif","Gursen","Mohammad","Paul","Lucian","Nicola","Guru","Mohammad","Harpreet","Robbie","Robert","Nicholas","Damir","Yang","Jaime","Mark","Jon","Mandy","Richard","Stefano","Nick","Amanda","Pietro","Rosello Jose David","Paul","Clive","Srikanth"," Paulo","Leonardo","Michael","Ben","Darren","Supreet","Ryan","Aissa","Katy","Kayleigh","Paulina","Otto","Nikhil","John","Oltun","Frank","Syed Zeeshan","Martin","Dominic","Martin","Catalin","Alan","Lukasz","Richard","Zoltan","Gabriele","Saikat","Steve","Mattia","Ganish","Celal","Pedro","Florent","Peter","Fatin","Liam","Kwang Hyun","Elias","Andrew","Paul","George","Matheus","Tom","Huy","Mark","Stephen","Steven","Tadveer","Taaha","Dimitrios","Balaji","Deoraj","Dinu","Viswanath","Michael","Puneet","Muntazir","Gurdeep","Jayant","Tom","Jinsang","Ushandan","James","Klearchos","Santhosh","John Peter","Onkar","Krishan Kant","Avraam","Boon","Daniel","Vitaliia","Hosig","Matthew","Sophie","Mengyan","Bernadette","Yanglong","Flavius","Mart","Becky","Christophe","Eva","Dawn","Thomas","Dawn","Oscar","Mateusz","Benedikt","Simon","Prashant Kumar","James","Siva","Ratheev","Mamadou","Corey","Florian","Andrew","John","Alberto","Halil","Laura","Bumsin","Chantelle","Subroto","Heino","Ilaria","Caglar","Vivian","Dawid","Malgorzata","Mark","Avinash","Danielle","Sivaraj","Faris","Vinoth","Arvind","Sophie","Natalie","Karthic","Swamy","Aajay","Michal","Firat","Akhil","Guillaume","Can","Anil","Nantha","Nathan","Jason","Mandar","Yinghao","Sandra","Brian","Inho","Mike","Thomas","Hari","Sunil","David","Thiha","Francis","Paul","Sharon","Pete","Georgina","Joseph","Andreas","Sathesh","Radhakrishna","Kevin","Huaji","Xiang","Matthias","Dave","Craig","Andrew","Arda","Vikky","Davie","Augustin","Zhao"]
var lastName =["Adate","Aftanasa","Aggarwal","Alexander","Alkis","Almeida","Al-Raqqad","Altin","Alzorgan","Amies","Antonache","Argent","Arunachalam","Ashouri","Bajwa","Ball","Berry","Birger","Bjekic","Brigstock","Bruni","Bullivant","Caine","Carrington","Carroll","Cerqua","Chadwick","Champion","Ciraci","Conejero","Cowen","Crewe","Dabbikar","das Neves","De Almeida Gussem","Dean","Delmaestro","Dewis","Dhindsa","Dixon","Djema","Eglinton","Elisha","Ellena","Emmerich","Eswaran","Evans","Evliyaoglu","Ewen","Fatmi","Fensom","Fenton","Fitzpatrick","Fliscu","Forrest","Gadek","Gaitskell","Geiszt","Gentile","Ghosh","Gill","Giovannini","Girilal","Gokalp","Gomez Posada","Gree","Guerrier","Gunes","Hale","Han","Harb","Hart","Havelock","Haworth","Henriques","Hinchcliffe","Ho","Holdstock","Holland","Hood","Hora","Hussain","Ioakeim","Jagadeesan","Jajware","James","Jandhyala","Japp","Jethani","Jivraj","Kallah","Kaushik","Kigezi","Kim","Kirupalaratnam","Ko","Korkovelos","Krishnan","Kulandaisamy","Kulkarni","Kumar","Kyriakidis","Lang","Lawrence","Laznikova","Lee","Lennon","Lennox","Lin","Longridge","Lu","Luncan","Magi","Maguire","Maleyrie","Marriott","Marsh","Maunders","McDonald","McGeehan","Medyk","Meynen","Mills","Mishra","Mitchell","Muram","Nair","Ndiaye","Nicholls","Niehaves","Norgate","O'Leary","Oliveira","Ors","Panaite","Park","Pasquale","Paul","Pedersen","Pezzulla","Pinar","Pipe","Polak","Polak","Pounder","Prakash","Pullen","Pullur","Puzhuthiniyil","Raghunathan","Rajaram","Reader","Reynolds","Sampath","Sanda","Sankar","Sapielak","Saracoglu","Sathyapalan","Sauton","Saydere","Sebastian","Shanmuga Sundaram","Sharp","Shaw","Shewale","Shi","Shirley","Smith","Song","Staples","Stone","Subramanian","Sutar","Suter","Than","Theobalds","Tiplady","Tiplady","Todd","Trainer","Travers","Varnavides","Vasu","Veeramalla","Vesey","Wang","Wang","Wellers","Wilkins","Windross-Buckley","Wright","Yalcin","Yates","Young","Zeitouny","Zhang"]
/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
<?php if (!(isset($_POST['visitor']) || $_GET['visit'])):?>
autocomplete(document.getElementById("firstNameInput"), firstName);
autocomplete(document.getElementById("lastNameInput"),lastName);
<?php endif ?>
</script>
