 <?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  require $root."/DB/call-db.php";
  dbsetup($db, $text);
  $tablename = $_SESSION["CoListTabName"];
  $paramname = "ID";
  $paramvalue = "6100";
  $dbrowvalues = array();
  dbcreatecompanylisttable($db, $tablename, $text);
  dbreadrecord($db, $tablename, $paramname, $paramvalue, $dbrowvalues, $text);
  dbclose($db, $text);
  $jsonArray_1 = json_encode($dbrowvalues);
  $val = str_replace("]", "", $jsonArray_1);
  $val = str_replace("[", "", $val);
  $val = str_replace("\",", "", $val);
  $datarray = explode("\"", $val);
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
textarea {
            flex: 1;
            margin-left: 10px;
            font-size: 16px;
            width: 100%;
            height: 100px;
            resize: none;
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
/* Hide the default file input button */
input[type="file"] {
    display: none;
}

/* Style the custom file input button */
.custom-file-input {
    background-color: #ddd;
    color: #fff;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    display: inline-block;
}

/* Style the file name display */
.custom-file-input + label {
    margin-left: 10px;
    color: #ff0000; /* Change the font color here */
}

</style>
<body>
<div id="id04">
  <div class="container">
    <div class="textbox">
      <div class="form-group">
        <form action="forms_action_page.php" class="form-container" method="post" id = "form" enctype="multipart/form-data">
        <h3>My Company: Edit Profile</h3>
        <label for="Coname"><b>Name: *</label>
        <input type = "text" class="input-box" id = "Coname" name = "Coname" value="<?php echo $datarray[1]; ?>" required><br><br>
        <label for="CoAddr"><b>Address: *</label>
        <input type = "text" class="input-box" id = "CoAddr" name = "CoAddr" value="<?php echo $datarray[3];?>"required><br><br>
        <label for="CoCity"><b>City: *</label>
        <input type = "text" class="input-box" id = "CoCity" name = "CoCity" value="<?php echo $datarray[4]; ?>"required><br><br>
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
        <input type = "text" class="input-box" id = "CoPcode" name = "CoPcode" maxlength = "6" size = "6" inputmode="numeric" required value="<?php echo $datarray[6]; ?>">
        <br><br>
        <label for="CoPh"><b>Mobile No: * +91</label>
        <input type = "text" class="input-box" inputmode="numeric" id = "CoPh" name = "CoPh" size="10" maxlength = "10" placeholder="xxxxxxxxxxxx" required value="<?php echo $datarray[7]; ?>"><br><br>
        <label for="CoAcode"><b>Admin Offcie Contact: * </label><br><br>
        <input type = "text" class="input-box" inputmode="numeric" id = "CoAcode" name = "CoAcode" size="6" maxlength = "6" placeholder="+9144" required value="<?php echo $datarray[9]; ?>">
        <input type = "text" class="input-box" inputmode="numeric" id = "CoAPh" name = "CoAPh" size="20" maxlength = "8" placeholder="xxxxxxxx" required value="<?php echo $datarray[10]; ?>"><br><br>
        <label for="CoEmail"><b>Email: *</label>
        <input type = "email" class="input-box" id = "CoEmail" name = "CoEmail"required value="<?php echo $datarray[8]; ?>"><br><br>
        <label for="CoGST"><b>GSTIN/UIN: *</label>
        <input type = "text" class="input-box" id = "CoGST" name = "CoGST" maxlength = "15" size = "15" inputmode="numeric" required value="<?php echo $datarray[2]; ?>"><br><br>
        <!-- Custom file input -->
        <label for="file1" class="custom-file-input">Choose a Logo File</label>
        <input type="file" id="file1">
        <!-- Display selected file name -->
        <label for="file1" id="file1-label"></label><br><br>
        <input type="text" name="file1_name" id="file1-name-hidden" hidden>
        <!-- Custom file input -->
        <label for="file2" class="custom-file-input">Choose a Digital Signature File</label>
        <input type="file" id="file2">
        <!-- Display selected file name -->
        <label for="file2" id="file2-label"></label><br><br>
        <input type="text" name="file2_name" id="file2-name-hidden" hidden>
        <!-- Custom file input -->
        <label for="file3" class="custom-file-input">Choose a Letterhead File</label>
        <input type="file" id="file3">
        <!-- Display selected file name -->
        <label for="file3" id="file3-label"></label><br><br>
        <input type="text" name="file3_name" id="file3-name-hidden" hidden>
        <label for="mList">Machine Name List: *</label>(Add comma seperated by a line for each machine name)
        <textarea name="mList" id="mList" required></textarea><br><br>
        <label for="gList">Godown Name List: *</label>(Add comma seperated by a line for each machine name)
        <textarea name="gList" id="gList" required></textarea><br><br>
        <input type = "submit" class="input-box" id = "CoSave" name = "CoSave" value = "Save">
        <br><br>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
const fileInput1 = document.getElementById('file1');
const fileLabel1 = document.getElementById('file1-label');
const filename1 = document.getElementById('file1-name-hidden');
const fileInput2 = document.getElementById('file2');
const fileLabel2 = document.getElementById('file2-label');
const filename2 = document.getElementById('file2-name-hidden');
const fileInput3 = document.getElementById('file3');
const fileLabel3 = document.getElementById('file3-label');
const filename3 = document.getElementById('file3-name-hidden');
fileInput1.addEventListener('change', function() {
    fileLabel1.textContent = this.files[0].name;
    filename1.value = this.files[0].name;
});
fileInput2.addEventListener('change', function() {
    fileLabel2.textContent = this.files[0].name;
    filename2.value = this.files[0].name;
});
fileInput3.addEventListener('change', function() {
    fileLabel3.textContent = this.files[0].name;
    filename3.value = this.files[0].name;
});

window.onload = function() {
  var filename1 = jsArray_1[11];
  var filename2 = jsArray_1[12];
  var filename3 = jsArray_1[13];
  document.getElementById("file1-label").textContent = filename1;
  document.getElementById("file2-label").textContent = filename2;
  document.getElementById("file3-label").textContent= filename3;
  document.getElementById("file1-name-hidden").value = filename1;
  document.getElementById("file2-name-hidden").value = filename2;
  document.getElementById("file3-name-hidden").value = filename3;
  var input = document.getElementById("Costate");
  input.value = jsArray_1[5];
  document.getElementById("mList").value = jsArray_1[14];
  document.getElementById("gList").value = jsArray_1[15];
}

</script>

</body>

</html>
