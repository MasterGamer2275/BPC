<?php
  //---define all variables and constants used
  //---read a table
  //find the root path to calling the php filles by path
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  $tablename = "TEST_SUPPLIER_4";
  dbsetup($db, $text);
  dbcreatesuppliertable($db, $tablename, $text);
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
  padding: 15px;
  margin: 5px 0 2px 0;
  border: none;
  font-family: "Source Sans Pro", "sans-serif";
  font-size: 16px;
  background: #f2f2f2;
}
label {
  /* Your general styles for labels */
  font-size: 16px;
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
<div id="id01">

  <form action="forms_action_page.php" method="post">
    <h3>Suppliers : Add/Edit Suppliers<h3p><br><br>
    <label for="Sname"><b>Supplier Name: *</label>
    <input type= "text" id = "Sname" name = "Sname" required size="75">
    <label for="SuGST"><b>GSTIN/UIN: *</label>
    <input type = "text" id = "SuGST" name = "SuGST" maxlength = "15" size = "15" required>
    <label for="SIGST"><b>(IGST):</label>
    <input type = "checkbox" id = "SIGST" name = "SIGST"><br><br>
    <label for="SAddr"><b>Address:</label>
    <input type = "text" id = "SAddr" name = "SAddr" size="75" maxlength = "75">
    <label for="SCity"><b>City:</label>
    <input type = "text" id = "SCity" name = "SCity" size="32" maxlength = "32"><br><br>
    <label for="SState"><b>State:</label>
      <select name="Sstate" id="Sstate">
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
    <label for="Pcode"><b>Pincode:</label>
    <input type = "text" id = "Pcode" name = "Pcode" maxlength = "6" size = "6" pattern="\d{6}">
    <label for="SPh"><b>Mobile: +91</label>
    <input type = "text" inputmode="numeric" id = "SPh" name = "SPh" size="10" maxlength = "10" placeholder="xxxxxxxxxxxx">
    <label for="SEmail"><b>Email:</label>
    <input type = "email" id = "SEmail" name = "SEmail" size="43" maxlength = "43">
    <input type = "submit" id = "SAdd" name = "SAdd" value = "Add Record"><br><br>

    <table id="myTable">
      <tr>
          <th>Supplier ID</th>
          <th>Supplier Name</th>
          <th>GSTIN/UIN</th>
          <th>Address</th>
          <th>City</th>
          <th>State</th>
          <th>Pin Code</th>
          <th>Phone</th>
          <th>Email</th>
          <th>CompanyID</th>
          <th>IGST</th>
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
   <input type = "number" id = "SID" name = "SID" maxlength = "6" size = "6" hidden>
   <label for="Sname2"><b>Supplier Name: * &nbsp;</label>
   <input type = "submit" style="font-size:18px" class = "updatebtn" id = "S2Save" name = "S2Save" value = "V" ></button>
   <input type = "submit" style="font-size:18px" class = "delete" id = "Sdelete" name = "Sdelete" value = "Del">
   <input type = "button" style="font-size:18px" class = "cancel" id = "Scancel" name = "Scancel" value = "X" onclick= "closeForm()">
   <input type= "text" id = "Sname2" name = "Sname2" required size="75" disabled>
   <label for="SuGST2"><b>GSTIN/UIN: *</label>
   <input type = "text" id = "SuGST2" name = "SuGST2" maxlength = "15" size = "15" required>
   <label for="SIGST2"><b>(IGST):</label>
   <input type = "checkbox" id = "SIGST2" name = "SIGST2"><br><br>
   <label for="SAddr2"><b>Address:</label>
   <input type = "text" id = "SAddr2" name = "SAddr2" size="75" maxlength = "75">
   <label for="SCity2"><b>City:</label>
   <input type = "text" id = "SCity2" name = "SCity2" size="32" maxlength = "32">
   <label for="Sstate2"><b>State:</label>
    <input type = "text" name="Sstate2" id="Sstate2">
   <label for="SPcode2"><b>Pincode:</label>
   <input type = "text" id = "SPcode2" name = "SPcode2" maxlength = "6" size = "6" pattern="\d{6}">
   <label for="SPh2"><b>Mobile: +91</label>
   <input type = "text" inputmode="numeric" id = "SPh2" name = "SPh2" size="10" maxlength = "10" placeholder="xxxxxxxxxxxx">
   <label for="SEmail2"><b>Email:</label>
   <input type = "email" id = "SEmail2" name = "SEmail2" size="43" maxlength = "43">

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
      var igst = cells[10].innerText;
      var igstboolean = (igst == "on");
      var statearray = ["Andhra Pradesh", "Andaman and Nicobar Islands", "Arunachal Pradesh", "Assam", "Bihar", "Chandigarh", "Chhattisgarh", "Dadar and Nagar Haveli", "Daman and Diu", "Delhi", "Lakshadweep", "Puducherry", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"];
      var strstr = JSON.stringify(state);
      var x = statearray.indexOf(state);
      // Set the values of the form fields
      document.getElementById("SID").value = id;
      document.getElementById("Sname2").value = name;
      document.getElementById("SuGST2").value = gstin;
      document.getElementById("SAddr2").value = addr;
      document.getElementById("SCity2").value = city;
      //document.getElementById("Sstate2").selectedIndex = x;
      document.getElementById("Sstate2").value = state;
      document.getElementById("SPcode2").value = pincode;
      document.getElementById("SPh2").value = phone;
      document.getElementById("SEmail2").value = email;
      document.getElementById("SIGST2").checked = igstboolean;
      
    }
  });
</script>

</script>
</body>
</html> 