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
<h3>My Company: Edit Profile</h3>
<label for="Coname"><b>Name:</label>
<input type = "text" id = "Coname" name = "Coname" size="50"><br><br>
<label for="CoPh"><b>Mobile No: * +91</label>
<input type = "text" inputmode="numeric" pattern="[0-9]{10}" id = "CoPh" name = "CoPh" size="10" maxlength = "10" placeholder="xxxxxxxxxxxx" required><br><br>
<label for="CoAcode"><b>Admin Offcie Contact: * </label>
<input type = "text" inputmode="numeric" pattern="[0-9]" id = "CoAcode" name = "CoAcode" size="6" maxlength = "6" placeholder="+9144" required>
<input type = "text" inputmode="numeric" pattern="[0-9]{8}" id = "CoAPh" name = "CoAPh" size="8" maxlength = "8" placeholder="xxxxxxxx" required><br><br>

<label for="CoEmail"><b>Email: *</label>
<input type = "email" id = "CoEmail" name = "CoEmail" size="30" maxlength = "30" required><br><br>
<label for="CoAddr"><b>Address: *</label>
<input type = "text" id = "CoAddr" name = "CoAddr" size="35" maxlength = "35" required><br><br>
<label for="CoCity"><b>City: *</label>
<input type = "text" id = "CoCity" name = "CoCity" size="25" maxlength = "25" required><br><br>
<label for="CoState"><b>State:</label>
<select name="Costate" id="Costate" width ="15px">
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
</select><br><br>
<label for="CoPcode"><b>Pincode: *</label>
<input type = "text" id = "CoPcode" name = "CoPcode" pattern="[0-9]" maxlength = "6" size = "6" inputmode="numeric" required>
<br><br>
<label for="CoGST"><b>GSTIN/UIN: *</label>
<input type = "text" id = "CoGST" name = "CoGST" maxlength = "15" size = "15" inputmode="numeric" required><br><br>
<label for="fileToUpload"><b>Company Logo: *</label>
<input type="file" name="fileToUpload" id="fileToUpload" required><br><br>
<input type = "submit" id = "CoSave" name = "CoSave" value = "Save">
<br><br>

<script>


</script>
</body>
</html>