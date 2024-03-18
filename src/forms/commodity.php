<?php
  // Read Commodity table
  $root = $_SERVER['DOCUMENT_ROOT'];
  include ($root."/DB/db-setup.php");
  $tablename = "TEST_COMMODITY";
  $data = array(array());
  include ($root."/DB/read-table.php");
  // Get Supplier ID
  $root = $_SERVER['DOCUMENT_ROOT'];
  $columnname = "SUPPLIERID";
  $tablename = "TEST_COMMODITY";
  include($root."/DB/get-column-values.php");
  // Get Supplier name
  $id = $colvalues;
  $tablename = "TEST_SUPPLIER";
  $varname = "NAME";
  /*
   foreach ($colvalues as $row) {
    foreach ($row as $value) {
        echo "<tr>$value</tr>";
        }
    }
    */
  $id = array("1", "1", "1", "1");
  $names = array("Mill no.1", "Mill no.2", "Mill no.3", "Mill no.4");
  //include($root."/DB/get-names.php");
  /*
   foreach ($names as $row) {
     foreach ($row as $value) {
        echo "<tr>$value</tr>";
        }
    }*/
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

<form action="/forms_action_page.php" method="post">
<p>Commodities : Please feed the new raw material name, source and correspoding spec. in to the MES System.</p>
<label for="Cname"><b>Commodity Name: *</label>
<input type = "text" id = "Cname" name = "Cname" required>
<label for="Sup"><b>Supplier Name: *</label>
    <select id="Sup" name="Sup" required>
  <?php
  // Loop through the array to generate list items
  foreach ($names as $row) {
      foreach ($row as $value) {
  echo "<option value>$value</option>";
      }
  }
  ?>
  
    </select>
<br><br>
<label for="GSM"><b>GSM: *</label>
<input type = "number" id = "GSM" name = "GSM" required min = "10" max= "500" step=".01">
<label for="BF"><b>BF: *</label>
<input type = "number" id = "BF" name = "BF" required min = "1" max= "500" step=".01">
<input type = "submit" id = "CAdd" name = "CAdd" value = "Add">
<br><br>

<table>
  <tr>
    <th>Commodity ID</th>
    <th>Commodity Name</th>
    <th>Supplier Name</th>
    <th>GSM</th>
    <th>BF</th>
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