<?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db);
  $tablename = "TEST_SUPPLIER_4";
  $columnname = "NAME";
  $dbcolvalues = array(array());
  dbgetcolumnname($db, $tablename, $columnname, $dbcolvalues);
  $igstlist = array();
  $columnname = "IGST";
  dbgetcolumnname($db, $tablename, $columnname, $igstlist);
  $tablename = "TEST_COMMODITY_3";
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata);
  dbclose($db);
  // Convert the array of objects to a JSON array
  $jsonArray_1 = json_encode($igstlist);
  $jsonArray_2 = json_encode($dbtabdata);
  // Echo the JSON array
  echo '<script>';
  echo 'var jsArray_1 = ' . $jsonArray_1 . ';';
  echo 'console.log(jsArray_1);'; // Output the array in the browser console
  echo 'var jsArray_2 = ' . $jsonArray_2 . ';';
  echo 'console.log(jsArray_2);'; // Output the array in the browser console
  echo '</script>';
?>
 
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

button {
  padding: 1px 6px 1px 6px;
  position: relative;
  left: 90%;
  bottom: 60%;
}
button img {
  width: 22px;
  height: 22px;
}

button > img,
button > span {
  vertical-align: middle;
}

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
</head>
 
<body>

<form action="forms_action_page.php" method="post">
<h3>Stock Feed:</h3>
<label for="Pdate"><b>Purchase Date:</label>
<input type = "date" id = "Pdate" name = "Pdate" size="0" value="<?php echo date('Y-m-d'); ?>">
<label for="PSname"><b>Supplier: *</label>
<select name= = "PSname" id = "PSname" onchange="getcommoditylist()">
<option value="Default">Default</option>
  <?php
    // Loop through the array to generate list items
  foreach ($dbcolvalues as $row) {
      foreach ($row as $value) {
         echo "<option value='$value'>$value</option>";
      }
  }
  ?>
</select>
<label for="PCname"><b>Commodity</label>
<select name="PCname" id="PCname">
<option value="Default">Default</option>
</select>
<label for="PGSM"><b>GSM: *</label>
<input type = "text" id = "PGSM" name = "PGSM" required size="5" disabled>
<label for="PBF"><b>BF: *</label>
<input type = "text" id = "PBF" name = "PBF" required size="5" disabled><br><br>
<label for="PRS"><b>Reel Size (Cm): *</label>
<input type = "number" id = "PRS" name = "PRS" required width="5px" min = "0" max= "1000" step=".01">
<label for="PRN"><b>Reel Number :*</label>
<input type = "number" id = "PRN" name = "PRN" required width="4px" min = "5" max= "1000" step=".01">
<label for="PRW"><b>Reel Weight (Kg) : *</label>
<input type = "number" id = "PRW" name = "PRW" required width="4px" min = "10" max= "500" step=".01" onchange = "calculatetotal()">
<label for="PRate"><b>Rate(Rs.): *</label>
<input type = "number" id = "PRate" name = "PRate" required width="5px" min = "0" max= "200" step=".01" onchange = "calculatetotal()">
<br><br>
<label for="PSGST"><b>SGST(%): *</label>
<input type = "number" id = "PSGST" name = "PSGST" required width="2px" min = "0" max= "15" value = "0" step=".01" disabled onchange = "calculatetotal()">
<label for="PCGST"><b>CGST(%): *</label>
<input type = "number" id = "PCGST" name = "PCGST" required width="2px" min = "0" max= "15" value = "0" step=".01" disabled onchange= "calculatetotal()">
<label for="PIGST"><b>IGST(%): *</label>
<input type = "number" id = "PIGST" name = "PIGST" required width="2px" min = "0" max= "15" value = "0" step=".01" disabled onchange = "calculatetotal()">
<label for="PTotal"><b>Total(Rs.): *</label>
<input type = "number" id = "PTotal" name = "PTotal" required width="15px" min = "500" max= "100000" disabled step=".01">
<input type = "submit" id = "PAdd" name = "PAdd" value = "Add to List">
<br><br>
<p>Verify the below table and click on submit to log the stock data in to the MES system</p>
<input type = "submit" id = "PSubmit" name = "PSubmit" value = "Save Record"><br><br>
</form>
<form action="#" method="post">
<button id = "PExpEx" name = "PExpEx">
  <span>Export</span>
  <img src="/icons/icons8-excel-48.png" alt="excelpng" />
</button>
</form>
<table>
  <tr>
      <th>Stock ID</th>
      <th>Date</th>
      <th>Supplier Name</th>
      <th>Commodity Name</th>
      <th>Reel Weight (Kg)</th>    
      <th>Reel Number</th>    
      <th>Reel Size (Cm)</th>    
      <th>Rate (Rs.)</th>    
      <th>SGST(%)</th>    
      <th>CGST(%)</th>    
      <th>Total(Rs.)</th>  
  </tr>
</table>

</body>

<script>
function getcommoditylist() {
  document.getElementById("PIGST").value = 0;
  document.getElementById("PSGST").value = 0;
  document.getElementById("PCGST").value = 0;
  var index = document.getElementById("PSname").selectedIndex;
  // Encode the PHP array to JSON
  str = jsArray_1[index-1];
  var stringData = JSON.stringify(str);
  var contains = stringData.includes("on");
  if (contains) {
  document.getElementById("PIGST").disabled = false;
  document.getElementById("PSGST").disabled = true;
  document.getElementById("PCGST").disabled = true;
    } else {
  document.getElementById("PIGST").disabled = true;
  document.getElementById("PSGST").disabled = false;
  document.getElementById("PCGST").disabled = false;
        }
}

function calculatetotal() {
  t1 = document.getElementById("PIGST").value;
  t2 = document.getElementById("PSGST").value;
  t3 = document.getElementById("PCGST").value;
  rsize = document.getElementById("PRS").value;
  rweight = document.getElementById("PRW").value;
  rate = document.getElementById("PRate").value;
  taxsum = 0;
  taxsum = (parseInt(t1) + parseInt(t2)+ parseInt(t3)) /100;
  document.getElementById("PTotal").value = (rweight * rate) + taxsum;
}
function updateval() {}
function addtotable() {}

</script>

</body>
</html>
