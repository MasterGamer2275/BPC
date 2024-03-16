<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}
tr:nth-child(even) {
  background-color: #f2f2f2
}

</style>

<form action="/forms_action_page.php" method="post">
        <?php
        // Read Supplier table
        $root = $_SERVER['DOCUMENT_ROOT'];
        $tablename = "TEST_SUPPLIER";
        $data = array(array());
        include ($root."/main-page/read-table.php");
        ?>
<br><br>
<label for="Sname"><b>Supplier Name: *</label>
<input type = "text" id = "Sname" name = "Sname" required size="50">
<label for="SPh"><b>Phone: +91</label>
<input type = "text" inputmode="numeric" pattern="[0-9]{10}" id = "SPh" name = "SPh" size="10" maxlength = "10" placeholder="xxxxxxxxxxxx">
<label for="SEmail"><b>Email:</label>
<input type = "email" id = "SEmail" name = "SEmail" size="30" maxlength = "30" pattern="[a-z @]{30}">
<br><br>
<label for="SAddr"><b>Address:</label>
<input type = "text" id = "SAddr" name = "SAddr" size="35" maxlength = "35">
<label for="SCity"><b>City:</label>
<input type = "text" id = "SCity" name = "SCity" size="25" maxlength = "25">
<label for="SState"><b>State:</label>
<select name="Sstate" id="Sstate" width ="15px">
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
<input type = "text" id = "Pcode" name = "Pcode" pattern="[0-9]" maxlength = "6" size = "6" inputmode="numeric">
<input type = "submit" id = "SAdd" name = "SAdd" value = "Add">
<br><br>
<table>
  <tr>
    <th>Supplier ID</th>
    <th>Supplier Name</th>
    <th>Address</th>
    <th>City</th>
    <th>State</th>
    <th>Pin Code</th>
    <th>Phone</th>
    <th>Email</th>
  </tr>
        <?php
        // Loop through the array to generate table rows
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }
            echo "</tr>";
        }
        ?>
</table>

<script>


</script>
</body>
</html>