 
<?php
  //---define all variables and constants used
  //---read a table
  //find the root path to calling the php filles by path
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  $tablename = "TEST_CUSTOMER_1";
  dbsetup($db, $text);
  dbcreatecustomertable($db, $tablename, $text);
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  dbclose($db, $text);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
  font-family: "Source Sans Pro", "sans-serif";
  //font-family: "Trebuchet MS", sans-serif;
}

label {
  /* Your general styles for labels */
  font-size: 16px;
  color: #333;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}
tr, td {
  text-align: left;
  font-size: 15px;
  font-weight: normal;
  padding: 16px;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}
tr:nth-child(even) {
  background-color: #f2f2f2
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input(type=number) {
  -moz-appearance: textfield;
}
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  max-width: 300px;
  top:0px;
  width: auto;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
  color: black;
}
/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
  font: inherit;
 
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password], .form-container input[type=email], .form-container input[type=date]{
  width: 90%;
  height: 0px;
  padding: 10px;
  margin: 5px 0 2px 0;
  border: none;
  font-family: "Source Sans Pro", "sans-serif";
  font-size: 14px;
  background: #f2f2f2;
}
.form-container label {
  /* Your general styles for labels */
  font-size: 14px;
  color: #333;
}

.form-container select{
  width: 90%;
  padding: auto;
  border: none;
  background: #f2f2f2;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #f2f2f2;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #f2f2f2;
  color: #f2f2f2;
  border: none;
  cursor: pointer;
  margin-bottom:10px;
  opacity: 0.2;
}
/* Add a red background color to the cancel button */
.form-container .updatebtn {
  background-color: #f2f2f2;
  color: Green;
  opacity: 0.7;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: #f2f2f2;
  opacity: 0.5;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
select {
width: 13%;
/* width: 120px;*/
height: 20px;
}
</style>

<form action="forms_action_page.php" method="post">
<h3>Customers : Please feed the new customer name, address and GST info in to the MES System.</h3>
<label for="Cname"><b>Customer Name: *</label>
<input type = "text" id = "Cname" name = "Cname" required size="100">
<label for="CGST"><b>GSTIN/UIN: *</label>
<input type = "text" id = "CGST" name = "CGST" maxlength = "15" size = "15" inputmode="numeric" required>
<br><br>
<label for="CAddr"><b>Address: *</label>
<input type = "text" id = "CAddr" name = "CAddr" size="99.5" required>
<label for="CCity"><b>City: *</label>
<input type = "text" id = "CCity" name = "CCity" size="32" required><br><br>
<label for="CState"><b>State:</label>
<select name="Cstate" id="Cstate">
<option value="">Select</option>
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
</select>
<label for="CPcode"><b>Pincode: *</label>
<input type = "text" id = "CPcode" name = "CPcode" maxlength = "6" size = "6" inputmode="numeric" required>
<label for="CPh"><b>Mobile No: * +91</label>
<input type = "text" inputmode="numeric" id = "CPh" name = "CPh" size="10" maxlength = "10" placeholder="xxxxxxxxxxxx" required>
<label for="CEmail"><b>Email: *</label>
<input type = "email" id = "CEmail" name = "CEmail" size="51" required>
<br><br>
<label for="CSAddr"><b>Secondary Address:</label>
<input type = "text" id = "CSAddr" name = "CSAddr" size="82">
<label for="CACode"><b>Admin Offcie Contact:</label>
<input type = "text" inputmode="numeric" id = "CACode" name = "CACode" size="8" maxlength = "8" placeholder="+91422">
<input type = "text" inputmode="numeric" id = "CAPh" name = "CAPh" size="8" maxlength = "8" placeholder="xxxxxxxxxxxx">
<br><br>
<input type = "submit" id = "ClAdd" name = "ClAdd" value = "Add Record">
<br><br>
<table id="myTable">
  <tr>
    <th>Customer ID</th>
    <th>Customer Name</th>
    <th>GSTIN/UIN</th>
    <th>Address</th>
    <th>City</th>
    <th>State</th>
    <th>Pin Code</th>
    <th>Mobile</th>
    <th>Email</th>
    <th>Secondary Address</th>
    <th>Admin Office Area Code</th>
    <th>Admin Office Contact</th>
    <th>Company ID</th>
  </tr>
              <?php
            // Loop through the array to generate table rows
            foreach ($dbtabdata as $row) {
                echo "<tr>";
                foreach ($row as $cell) {
                    echo "<td>$cell</td>";
                  }      
                echo "</tr>";
            }
            ?>
</table>
    </div>
  </form>
</div>
<div class="form-popup" id="myForm">
  <form action="forms_action_page.php" class="form-container" method="post">
   <input type = "number" id = "CID2" name = "CID2" maxlength = "6" size = "6" hidden>
   <label for="Cname2"><b>Customer Name: * &nbsp;</label>
   <input type= "text" id = "Cname2" name = "Cname2" required size="75" disabled>
   <input type = "submit" style="font-size:18px" class = "updatebtn" id = "C2Save" name = "C2Save" value = "V" ></button>
   <input type = "submit" style="font-size:18px" class = "delete" id = "Cdelete" name = "Cdelete" value = "Del">
   <input type = "button" style="font-size:18px" class = "cancel" id = "Ccancel" name = "Ccancel" value = "X" onclick= "closeForm()">
   <label for="CGST2"><b>GSTIN/UIN: *</label>
   <input type = "text" id = "CGST2" name = "CGST2" maxlength = "15" size = "15" required>
   <label for="CAddr2"><b>Address: *</label>
   <input type = "text" id = "CAddr2" name = "CAddr2" size="75">
   <label for="CCity2"><b>City: *</label>
   <input type = "text" id = "CCity2" name = "CCity2" size="32">
   <label for="Cstate2"><b>State:</label>
    <input type = "text" name="Cstate2" id="Cstate2">
   <label for="CPcode2"><b>Pincode: *</label>
   <input type = "text" id = "CPcode2" name = "CPcode2" maxlength = "6" size = "6">
   <label for="CPh2"><b>Mobile: *+91</label>
   <input type = "text" inputmode="numeric" id = "CPh2" name = "CPh2" size="10" maxlength = "10" placeholder="xxxxxxxxxxxx">
   <label for="CEmail2"><b>Email: *</label>
   <input type = "email" id = "CEmail2" name = "CEmail2" size="43>
   <label for="CSAddr2"><b>Secondary Address:</label>
   <input type = "text" id = "CSAddr2" name = "CSAddr2">
   <label for="CAPhAc2"><b>Admin Office Phone Area Code:</label>
   <input type = "text" inputmode="numeric" id = "CAPhAc2" name = "CAPhAc2" size="6" maxlength = "6" placeholder="+91422">
   <input type = "text" id = "CAPh2" name = "CAPh2" size="8" maxlength = "8" >
  </form>
</div>
<script>
  document.getElementById("myForm").style.display = "none";
  /*
  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }
  */
  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
  // Get the table element
  var table = document.getElementById("myTable");

  // Attach a click event listener to the table
  table.addEventListener("click", function(event) {
    // Check if the clicked element is a table row
    if (event.target.tagName === "TD") {
      document.getElementById("myForm").style.display = "block";
      // Get the data of the clicked row
      var row = event.target.parentNode; // Get the parent row (<tr>)
      var cells = row.getElementsByTagName("td"); // Get all cells (<td>) in the row
      // Extract the data from cells
      var id = cells[0].innerText;
      var name = cells[1].innerText;
      var gstin = cells[2].innerText;
      var addr = cells[3].innerText;
      var city = cells[4].innerText;
      var state = cells[5].innerText;
      var pincode = cells[6].innerText;
      var phone = cells[7].innerText;
      var email = cells[8].innerText;
      var saddr = cells[9].innerText;
      var adphac= cells[10].innerText;
      var adph = cells[11].innerText;
      var statearray = ["Andhra Pradesh", "Andaman and Nicobar Islands", "Arunachal Pradesh", "Assam", "Bihar", "Chandigarh", "Chhattisgarh", "Dadar and Nagar Haveli", "Daman and Diu", "Delhi", "Lakshadweep", "Puducherry", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"];
      var strstr = JSON.stringify(state);
      var x = statearray.indexOf(state);
      // Set the values of the form fields
      document.getElementById("CID2").value = id;
      document.getElementById("Cname2").value = name;
      document.getElementById("CGST2").value = gstin;
      document.getElementById("CAddr2").value = addr;
      document.getElementById("CCity2").value = city;
      //document.getElementById("Sstate2").selectedIndex = x;
      document.getElementById("Cstate2").value = state;
      document.getElementById("CPcode2").value = pincode;
      document.getElementById("CPh2").value = phone;
      document.getElementById("CEmail2").value = email;
      document.getElementById("CSAddr2").value = saddr;
      document.getElementById("CAPhAc2").value = adphac;
      document.getElementById("CAPh2").value = adph;
       
    }
  });

</script>
</body>
</html>
  

