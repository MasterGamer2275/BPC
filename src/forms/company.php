<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root."/DB/call-db.php";
  dbsetup($db, $text);
  $tablename = "TEST_COMPANY_LIST_2";
  $paramname = "ID";
  $paramvalue = 6100;
  $dbrowvalues = array();
  dbcreatecompanylisttable($db, $tablename, $text);
  dbreadrecord($db, $tablename, $paramname, $paramvalue, $dbrowvalues, $text);
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  dbclose($db, $text);
  $jsonArray_1 = json_encode($dbrowvalues);
  $jsonArray_2 = json_encode($dbtabdata);
  echo $jsonArray_1;
  echo $jsonArray_2;
  $jsonArray_1 = str_replace("\"", "", $jsonArray_1);
  $jsonArray_1 = str_replace("]", "", $jsonArray_1);
  $jsonArray_1 = str_replace("[", "", $jsonArray_1);
  $datarray = explode(",", $jsonArray_1);
  // Echo the JSON array
  echo '<script>';
  echo 'var jsArray_1 = ' . $jsonArray_1 . ';';
  echo 'console.log(jsArray_1);'; // Output the array in the browser console
  echo '</script>';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>

 .container {
            display: flex;
            flex-direction: column;

        }
.textbox {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-right: 20px; /* Adjust this value to your preference */
        }
.form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-right: 20px; /* Adjust this value to your preference */

        }
.input-box {
            flex: 1;
            margin-left: 10px;
            width: 100%;
            font-size: 16px;
        }
.form-group label {
            /* Your general styles for labels */
            flex: 1;
            //margin-right: 40px; /* Adjust spacing between label and input */
            margin-left: 10px;
            font-size: 16px;
            color: #333;
            font-weight: bold; 
}
</style>
<body>
<div id="id04">
  <div class="container">
    <div class="textbox">
      <div class="form-group">
        <form action="forms_action_page.php" method="post" id = "myForm">
        <h3>My Company: Edit Profile</h3>
        <label for="Coname"><b>Name: *</label>
        <input type = "text" class="input-box" id = "Coname" name = "Coname" value="<?php echo $datarray[1]; ?>" required><br><br>
        <label for="CoAddr"><b>Address: *</label>
        <input type = "text" class="input-box" id = "CoAddr" name = "CoAddr" value="<?php echo $datarray[3];?>"required><br><br>
        <label for="CoCity"><b>City: *</label>
        <input type = "text" class="input-box" id = "CoCity" name = "CoCity" value="<?php echo $datarray[5]; ?>"required><br><br>
        <label for="CoState"><b>State:</label>
        <select name="Costate" class="input-box" id="Costate">
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
        <option value="Tamil Nadu" selected>Tamil Nadu</option>
        <option value="Telangana">Telangana</option>
        <option value="Tripura">Tripura</option>
        <option value="Uttar Pradesh">Uttar Pradesh</option>
        <option value="Uttarakhand">Uttarakhand</option>
        <option value="West Bengal">West Bengal</option>
        </select><br><br>
        <label for="CoPcode"><b>Pincode: *</label>
        <input type = "text" class="input-box" id = "CoPcode" name = "CoPcode" maxlength = "6" size = "6" inputmode="numeric" required value="<?php echo $datarray[7]; ?>">
        <br><br>
        <label for="CoPh"><b>Mobile No: * +91</label>
        <input type = "text" class="input-box" inputmode="numeric" id = "CoPh" name = "CoPh" size="10" maxlength = "10" placeholder="xxxxxxxxxxxx" required value="<?php echo $datarray[8]; ?>"><br><br>
        <label for="CoAcode"><b>Admin Offcie Contact: * </label><br><br>
        <input type = "text" class="input-box" inputmode="numeric" id = "CoAcode" name = "CoAcode" size="6" maxlength = "6" placeholder="+9144" required value="<?php echo $datarray[10]; ?>">
        <input type = "text" class="input-box" inputmode="numeric" id = "CoAPh" name = "CoAPh" size="20" maxlength = "8" placeholder="xxxxxxxx" required value="<?php echo $datarray[11]; ?>"><br><br>
        <label for="CoEmail"><b>Email: *</label>
        <input type = "email" class="input-box" id = "CoEmail" name = "CoEmail"required value="<?php echo $datarray[9]; ?>"><br><br>
        <label for="CoGST"><b>GSTIN/UIN: *</label>
        <input type = "text" class="input-box" id = "CoGST" name = "CoGST" maxlength = "15" size = "15" inputmode="numeric" required value="<?php echo $datarray[2]; ?>"><br><br>
        <label for="fileToUpload1"><b>Company Logo: *</label>
        <input type="file" class="input-box" name="fileToUpload1" id="fileToUpload1" accept=".png, .jpeg" required><br><br>
        <label for="fileToUpload2"><b>Digital Signature: *</label>
        <input type="file" class="input-box" name="fileToUpload2" id="fileToUpload2" accept=".png, .jpeg" required><br><br>
        <label for="fileToUpload3"><b>Letter Head: *</label>
        <input type="file" class="input-box" name="fileToUpload3" id="fileToUpload3" accept=".png, .jpeg" required><br><br>
        <input type = "submit" class="input-box" id = "CoSave" name = "CoSave" value = "Save">
        <br><br>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
   
</script>

</body>

</html>
