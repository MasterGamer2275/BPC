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

</style>

<form action="/forms_action_page.php" method="post">
<br><br>
        <?php
        // Read Commodity table
        $root = $_SERVER['DOCUMENT_ROOT'];
        $tablename = "TEST_COMMODITY";
        $data = array(array());
        include ($root."/main-page/read-table.php");
        // Get Supplier ID
        $root = $_SERVER['DOCUMENT_ROOT'];
        $columnname = "SUPPLIERID";
        $tablename = "TEST_COMMODITY";
        include($root."/main-page/get-column-values.php");
        ?>
<label for="Cname"><b>Commodity Name: *</label>
<input type = "text" id = "Cname" name = "Cname" required>
<label for="Sup"><b>Supplier Name: *</label>
    <select id="Sup" name="Sup" required>
        <?php
        // Loop through the array to generate list items
        foreach ($colvalues as $row) {
            foreach ($row as $value) {
                echo "<option value>$value</option>";
            }
        }
        ?>
        
    </select>
<br><br>
<label for="GSM"><b>GSM: *</label>
<input type = "number" id = "GSM" name = "GSM" required>
<label for="BF"><b>BF: *</label>
<input type = "number" id = "BF" name = "BF" required>
<input type = "submit" id = "Add" name = "Add" value = "Add">
<br><br>

<table>
  <tr>
    <th>Commodity ID</th>
    <th>Commodity Name</th>
    <th>Supplier</th>
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

<script>

</script>
</body>
</html> 