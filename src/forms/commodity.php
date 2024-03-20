<?php
  // Read Commodity table
  $root = $_SERVER['DOCUMENT_ROOT'];
  include ($root."/DB/db-setup.php");
  $tablename = "TEST_COMMODITY_3";
  include ($root."/DB/create-commodity-table.php");
  $data = array(array());
  $allnames = array(array());
  $colvalues = array(array());
  include ($root."/DB/read-table.php");
  //get list of supplier names
  $tablename = "TEST_SUPPLIER_4";
  $columnname = "NAME";
  include($root."/DB/get-column-values.php");
  $allnames = $colvalues;

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
  background-color: rgb(255, 208, 162);
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
<p>Commodities : Please feed the new raw material name, source and correspoding spec. in to the MES System.</p>
<label for="Cname"><b>Commodity Name: *</label>
<input type = "text" id = "Cname" name = "Cname" required>
<label for="CSname"><b>Supplier Name: *</label>
<select name="CSname" id="CSname">
<option value="Default">Default</option>
  <?php
  
  // Loop through the array to generate list items
  foreach ($allnames as $row) {
      foreach ($row as $value) {
  echo "<option value='$value'>$value</option>";
      }
  }
  ?>
</select>
<br><br>
<label for="CGSM"><b>GSM: *</label>
<input type = "number" id = "CGSM" name = "CGSM" required min = "10" max= "500" step=".01">
<label for="CBF"><b>BF: *</label>
<input type = "number" id = "CBF" name = "CBF" required min = "1" max= "500" step=".01">
<input type = "submit" id = "CAdd" name = "CAdd" value = "Add Record">
<br><br>

<table>
  <tr>
    <th>Commodity ID</th>
    <th>Commodity Name</th>
    <th>Supplier Name</th>
    <th>GSM</th>
    <th>BF</th>
    <th>COMPANYID</th>
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

</body>
</html> 