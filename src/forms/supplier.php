<?php
  //---define all variables and constants used
  //---read a table
  //find the root path to calling the php filles by path
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  $tablename = "TEST_SUPPLIER_4";
  dbsetup($db);
  dbcreatesuppliertable($db, $tablename);
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata);
  dbclose($db);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

select {
width: 13%;
/* width: 120px;*/
height: 20px;
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
</style>


<form action="forms_action_page.php" method="post">
<p>Suppliers : Please feed the new supplier name, address and GST. in to the MES System.<p>
<label for="Sname"><b>Supplier Name: *</label>
<input type= "text" id = "Sname" name = "Sname" required size="75">
<label for="SuGST"><b>GSTIN/UIN: *</label>
<input type = "text" id = "SuGST" name = "SuGST" maxlength = "15" size = "15" required>
<label for="SIGST"><b>(IGST):</label>
<input type = "checkbox" id = "SIGST" name = "SIGST">
<br><br>
<label for="SAddr"><b>Address:</label>
<input type = "text" id = "SAddr" name = "SAddr" size="75" maxlength = "75">
<label for="SCity"><b>City:</label>
<input type = "text" id = "SCity" name = "SCity" size="32" maxlength = "32">
<br><br>
<label for="SState"><b>State:</label>
<select name="Sstate" id="Sstate">
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
<input type = "submit" id = "SAdd" name = "SAdd" value = "Add Record">
<br><br>

<table>
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
            $i = 0;
            foreach ($row as $cell) {
              if ($i == 0) {
              echo "<td><a href='editsupplier.php'>$cell</a></td>";
              } else {
                echo "<td>$cell</td>";
              }
              $i++;
                }         
            echo "</tr>";
        }
        ?>
</table>

</body>
</html> 