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

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>

<form action="/forms_action_page.php" method="post">
<p>Customers : Please feed the new customer name, address and GST info in to the MES System.</p>
<label for="Clname"><b>Client Name:</label>
<input type = "text" id = "Clname" name = "Clname" size="50">
<label for="CPh"><b>Mobile No: * +91</label>
<input type = "text" inputmode="numeric" pattern="[0-9]{10}" id = "CPh" name = "CPh" size="10" maxlength = "10" placeholder="xxxxxxxxxxxx" required>
<br><br>
<label for="Cname"><b>Customer Name: *</label>
<input type = "text" id = "Cname" name = "Cname" required size="50">
<label for="Acode"><b>Admin Offcie Contact: * </label>
<input type = "text" inputmode="numeric" pattern="[0-9]" id = "Acode" name = "Acode" size="6" maxlength = "6" placeholder="xxxxxx" required>
<input type = "text" inputmode="numeric" pattern="[0-9]{8}" id = "APh" name = "APh" size="8" maxlength = "8" placeholder="xxxxxxxxxxxx" required>
<br><br>
<label for="CEmail"><b>Email: *</label>
<input type = "email" id = "CEmail" name = "CEmail" size="30" maxlength = "30" required>
<br><br>
<label for="CAddr"><b>Address: *</label>
<input type = "text" id = "CAddr" name = "CAddr" size="35" maxlength = "35" required>
<label for="CCity"><b>City: *</label>
<input type = "text" id = "CCity" name = "CCity" size="25" maxlength = "25" required>
<label for="CState"><b>State:</label>
<select name="Cstate" id="Cstate" width ="15px">
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
<input type = "text" id = "CPcode" name = "CPcode" pattern="[0-9]" maxlength = "6" size = "6" inputmode="numeric" required>
<br><br>
<label for="CSAddr"><b>Secondary Address:</label>
<input type = "text" id = "CSAddr" name = "CSAddr" size="50" maxlength = "50">
<br><br>
<label for="CGST"><b>GSTIN/UIN: *</label>
<input type = "text" id = "CGST" name = "CGST" maxlength = "15" size = "15" inputmode="numeric" required>
<input type = "submit" id = "CAdd" name = "CAdd" value = "Add">
<br><br>
<table>
  <tr>
    <th>Customer ID</th>
    <th>Customer Name</th>
    <th>Client Name</th>
    <th>Address</th>
    <th>City</th>
    <th>State</th>
    <th>Pin Code</th>
    <th>Mobile</th>
    <th>Admin Office Contact</th>
    <th>Email</th>
    <th>Secondary Address</th>
    <th>GSTIN/UIN</th>
  </tr>
</table>

<script>


</script>
</body>
</html>