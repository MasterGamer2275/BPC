<?php
  //---define all variables and constants used
  //---read a table
  //find the root path to calling the php filles by path
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["ClListTabName"];
  $columnname = "NAME";
  $dbcolvalues = array(array());
  dbgetcolumnname($db, $tablename, $columnname, $dbcolvalues, $text);
  $tablename = $_SESSION["PListTabName"];
  dbcreateproducttable($db, $tablename, $text);
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  dbclose($db, $text);
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
th {
  text-align: left;
  padding: 16px;
  font-size: 15px;
  font-weight: normal;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  font-weight: bold; 
}

td {
  text-align: left;
  padding: 16px;
  font-size: 15px;
  font-weight: normal;
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
input[type=number] {
  -moz-appearance: textfield;
  width: 9%;
}
.sizeclass {

}

/* Firefox */
.sizeclass input[type=number] {
  -moz-appearance: textfield;
}
.sizeclass input[type=text] {
  width: 3%;
}
select {
width: 25%;
/* width: 120px;*/
height: 20px;
}
</style>
<body>
    <form action="forms_action_page.php" method="post" id = "myForm">
    <h3>Create/Add Client Master:</h3>
    <label for="pCus"><b>Customer Name: *</label>
    <select name="pCus" id="pCus">
      <?php
      
      // Loop through the array to generate list items
      foreach ($dbcolvalues as $row) {
          foreach ($row as $value) {
      echo "<option value='$value'>$value</option>";
          }
      }
      ?>
    </select>
    <label for="pDes"><b>Description: *</label>
    <input type = "text" id = "pDes" name = "pDes" required size="15" placeholder = "Brown Cover GY">
    <label for="pSpec"><b>Spec: *</label>
    <input type = "text" id = "pSpec" name = "pSpec" required size="15">
    <label for="pGSM"><b>GSM: *</label>
    <input type = "number" id = "pGSM" name = "pGSM" required min = "10" step = "0.01"><br><br>
    <div class = "sizeclass">
      <label for="pSize1"><b>Size: *</label>
      <input type = "text" id = "pSize1" name = "pSize1" required size="5" maxlength = "5" min = "1" step = "1">x
      <input type = "text" id = "pSize2" name = "pSize2" required size="5" maxlength = "5" min = "1" step = "1">x
      <input type = "text" id = "pSize3" name = "pSize3" size="5" maxlength = "5" min = "1" step = "1">
      <label for="pUnit"><b>Unit: *</label>
      <input type = "text" id = "pUnit" name = "pUnit" required size="5" placeholder = "cm">
      <label for="pRate"><b>Rate(Rs.):*</label>
      <input type = "number" id = "pRate" name = "pRate" required min = "1" step = "0.01" class = "number">
      <input type = "submit" id = "PAdd" name = "PAdd" value = "Add Record"></div>
    </div><br><br>
    <table id = "myTable">
      <tr>    
            <th>Product ID</th>
            <th>Customer Name</th> 
            <th>Description</th>
            <th>Spec</th>    
            <th>GSM</th>    
            <th>Size</th>   
            <th>Unit</th> 
            <th>Rate(Rs.)</th>  
            <th>CompanyID</th>
      </tr>
        <?php
          // Loop through the array to generate table rows
          foreach ($dbtabdata as $row) {
              echo "<tr>";
              foreach ($row as $cell) {
                        echo "<td>$cell</td>";
                      }
              echo "</tr>";
          }
          ?>
    </table>
    </form>
</body>
<script>



</script>
</html>