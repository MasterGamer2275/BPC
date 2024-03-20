 <?php
  // Read Stock table
  $root = $_SERVER['DOCUMENT_ROOT'];
  include ($root."/DB/db-setup.php");
  //$tablename = "TEST_PURCHASE_STOCK";
  //include ($root."/DB/create-stocks-table.php");
  //$data = array(array());
  //include ($root."/DB/read-table.php");
  //get list of supplier names
  $tablename = "TEST_SUPPLIER_4";
  $columnname = "NAME";
  $colvalues = array(array());
  $supnames = array(array());
  include($root."/DB/get-column-values.php");
  $supnames = $colvalues;
  include ($root."/DB/db-close.php");
?>
 
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

<form action="forms_action_page.php" method="post">
<h3>Stock Feed:</h3>
<label for="Pdate"><b>Purchase Date:</label>
<input type = "date" id = "Pdate" name = "Pdate" size="0" value="<?php echo date('Y-m-d'); ?>">
<label for="PSname"><b>Supplier: *</label>
<select name= = "PSname" id = "PSname" onclick = "getcommoditylist()">
<option value="Default">Default</option>
  <?php
    // Loop through the array to generate list items
  foreach ($supnames as $row) {
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
<label for="GSM"><b>GSM: *</label>
<input type = "text" id = "GSM" name = "GSM" required size="5" disabled>
<label for="BF"><b>BF: *</label>
<input type = "text" id = "BF" name = "BF" required disabled size="5"><br><br>
<label for="PRS"><b>Reel Size (Cm): *</label>
<input type = "number" id = "PRS" name = "PRS" required width="5px" min = "0" max= "1000" step=".01">
<label for="PRN"><b>Reel Number :*</label>
<input type = "number" id = "PRN" name = "PRN" required width="4px" min = "5" max= "1000" step=".01">
<label for="PRW"><b>Reel Weight (Kg) : *</label>
<input type = "number" id = "PRW" name = "PRW" required width="4px" min = "10" max= "500" step=".01">
<label for="PRate"><b>Rate(Rs.): *</label>
<input type = "number" id = "PRate" name = "PRate" required width="5px" min = "0" max= "200" step=".01">
<br><br>
<label for="PSGST"><b>SGST(%): *</label>
<input type = "number" id = "PSGST" name = "PSGST" required width="2px" min = "0" max= "15" value = "0" step=".01">
<label for="PCGST"><b>CGST(%): *</label>
<input type = "number" id = "PCGST" name = "PCGST" required width="2px" min = "0" max= "15" value = "0" step=".01">
<label for="PIGST"><b>IGST(%): *</label>
<input type = "number" id = "PIGST" name = "PIGST" required width="2px" min = "0" max= "15" value = "0" step=".01">
<label for="PTotal"><b>Total(Rs.): *</label>
<input type = "number" id = "PTotal" name = "PTotal" required width="15px" min = "500" max= "100000" disabled step=".01">
<input type = "submit" id = "PAdd" name = "PAdd" value = "Add to List"><br><br>
<p>Verify the below table and click on submit to log the stock data in to the MES system</p>
<input type = "submit" id = "PSubmit" name = "PSubmit" value = "Save Record"><br><br>
<!--
<label for="Fdate"><b>Filter - From:</label>
<input type = "date" id = "Fdate1" name = "Fdate1"  size="0">
<label for="Fdate"><b>To:</label>
<input type = "date" id = "Fdate2" name = "Fdate2"  size="0">
<input type = "submit" id = "Export" name = "Export" value = "Export"><br><br>
-->
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


<script>

function getcommoditylist() {
 <?php
  $x = document.getElementById('PSname');
  $tablename = "TEST_COMMODITY_3";
  $columnname = "NAME";
  $filterbyname = "$x";
  include($root."/DB/get-column-values-filtered.php");
  // Loop through the array to generate list items
  foreach ($colvalues as $row) {
      foreach ($row as $value) {
            optionText = $value;
            optionValue = $value;
            let optionHTML = `
            <option value="${optionValue}"> 
                ${optionText} 
            </option>`;
            $('#PCname').append(optionHTML);
      }
  }
  ?>
}
</form>