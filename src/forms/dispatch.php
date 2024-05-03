 <?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>
<?php
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
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  $tablename = $_SESSION["DispTabName"];
  dbcreatedispatchtable($db, $tablename, $text);
  $dbdptabdata = array(array());
  $toDate = date('Y-m-d'); // Current date
  $fromDate = (new DateTime($toDate))->modify('-1 day')->format('Y-m-d');
  dbreadtablewdatefilter($db, $tablename, $fromDate, $toDate, $dbdptabdata, $text);
  //dbreadtable($db, $tablename, $dbpdtabdata, $text);
  $tablename = $_SESSION["CoListTabName"];
  $paramname = "ID";
  $paramvalue = "6100";
  $mycompanyvalues = array();
  dbreadrecord($db, $tablename, $paramname, $paramvalue, $mycompanyvalues, $text);
  $tempArray = explode(",\r\n", $mycompanyvalues[14]);
  $templist = json_encode($tempArray );
  $val = str_replace("]", "", $templist);
  $val = str_replace("[", "", $val);
  $val = str_replace("\"", "", $val);
  $machinelist = explode(",", $val);
  //add filter by unfinished stock.
  $tablename = $_SESSION["StListTabName"];
  dbcreatestocktable($db, $tablename, $text);
  $dbrnvalues = array();
  $columnname = "REELNUMBER";
  dblistuniquecolvalues($db, $tablename, $columnname, $dbrnvalues, $text);
  $dbtabdata2 = array(array());
  dbreadstocktable($db, $tablename, $dbtabdata2, $text);
  $tablename = $_SESSION["PListTabName"];
  dbcreateproducttable($db, $tablename, $text);
  dbclose($db, $text);
  // Convert the array of objects to a JSON array
  $jsonArray_1 = json_encode($dbtabdata2);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
button {
  padding: 1px 6px 1px 6px;
  position: absolute;
  left: 90%;
  bottom: 94%;
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
  width: auto;
  padding: 5px;
  border: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}

table tr td:nth-child(3),
table tr th:nth-child(3) {
    width: 370px; /* Set your desired width */
}
table tr td:nth-child(4),
table tr th:nth-child(4) {
    width: 110px; /* Set your desired width */
}

th, td {
  text-align: left;
  padding: 8px;
  font-size: 15px;
  font-weight: bold;
  width: auto;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  position: relative;
  overflow: hidden; /* Optional: hides content that overflows the cell */
  white-space: wrap;
}
caption {
text-align: middle; /* Move the caption text to the right */
border: 1px solid #ddd; /* Add border to the caption */
padding: 5px; /* Add padding to the caption */
}
th input[type=text]{
width: 80%;
}

tr, td {
  text-align: left;
  padding: 1px;
  font-size: 15px;
  font-weight: normal;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  white-space: wrap;
}

  th:nth-child(11),
  td:nth-child(11) {
  display: none;
}

tr > img {
        width: 20px; /* Adjust the width as needed */
        height: 20px; /* Maintain aspect ratio */
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  max-width: 500px;
  width: 320px;
  top: 10px;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
  color: black;
}


/* Full-width input fields */
input[type=text], input[type=date], input[type=number]{
  width: 75px;
}
input[type=date] {
 width: 100px;
}
select type1{
width: 16%;
/* width: 120px;*/
height: 20px;
}

select {
width: 10%;
/* width: 120px;*/
height: 20px;
}

.customselect {
width: 8.5%;
/* width: 120px;*/
height: 20px;

}
</style>
</head>
 
<body>
<div id="id01">
  <form action="forms_action_page.php" method="post" enctype="multipart/form-data" id = "entryform">
    <h3>Dispatch Feed:</h3>
    <label for="dp-Date"><b>Date:</label>
    <input type = "date" id = "dp-Date" name = "dp-Date" required value="<?php echo date('Y-m-d'); ?>">
    <label for="dp-CName"><b>Client Name: *</label>
    <select name="dp-CName" id="dp-CName" onchange="getsizelist();enablebutton();">
      <option value="0">Select</option>
      <?php
      // Loop through the array to generate list items
        foreach ($dbcolvalues as $row) {
            foreach ($row as $value) {
              echo "<option value='$value'>$value</option>";
            }
        }
        ?>
        </select>
    <label for="dp-Size"><b>Size: *</label>
    <select name="dp-Size" id="dp-Size" onchange = "updateinfo();enablebutton();" class = "customselect">
      <option value="0">Select</option>
    </select> 
    <label for="dp-Rate"><b>Rate(₹):</label>
    <input type = "number" id = "dp-Rate" name = "dp-Rate" value = "0" disabled>
    <input type = "hidden" id = "dp-Rate2" value = "0" name = "dp-Rate2"> 
    <label for="dp-CountSt"><b>Stock Count:</label>
    <input type = "number" id = "dp-CountSt" name = "dp-CountSt" value = "0" disabled><br><br>    
    <label for="dp-Count"><b>Count: *</label>
    <input type = "number" id = "dp-Count" name = "dp-Count" value = "0" step = "1" min = "0" onchange = "calculateval();enablebutton();">
    <label for="dp-Weight"><b>Total Weight(Kg): *</label>
    <input type = "number" id = "dp-Weight" name = "dp-Weight" value = "0" step = "0.01" min = "0">
    <label for="dp-TotRate"><b>Total Rate(₹):</label>
    <input type = "number" id = "dp-TotRate" name = "dp-TotRate" value = "0" disabled>
    <label for="dp-KGperPackage"><b>KGperPackage: *</label>
    <input type = "number" id = "dp-KGperPackage" name = "dp-KGperPackage" value = "0" step = "1" min = "0">
    <input type = "button" name = "dp-Add" id = "dp-Add" value = "Add to table" disabled onclick = "addtotable();"><br><br>
    <input type = "button" onclick="deleteSelectedRows();" disabled id = "delbutton" name = "delbutton" value = "Delete Selected Rows">
</form>
</div>
<div>
<form action="forms_action_page.php" method="post" enctype="multipart/form-data" id = "form2">
  <table id = "myTable" name = "myTable">
  <caption style="text-align: middle;">
      <?php echo $mycompanyvalues[1] . " PACKING LIST"; ?> 
      <span style="float: left;"> 
          <?php //echo date('Y-m-d, H:i:s');  ?> 
          <?php echo "Date:" . date('Y-m-d');  ?>
      </span> 
      <span style="float: right;"> 
          Location: <?php echo $mycompanyvalues[4]; ?>  
      </span> 
  </caption>
    <tr>
      <td><input type="checkbox" class = "selectallbutton" onchange = "selectAll(this);"></td>
      <th>S.No:</th>
      <th>CustomerName</th>
      <th>Size(Cm)</th>
      <th>RatePerC(₹)</th>
      <th>Count</th>
      <th>Weight(Kg)</th>
      <th>Rate(₹)</th>
    </tr>
    <?php
    // Loop through the array to generate table rows
    foreach ($dbdptabdata as $row) {
        echo "<tr>";
        foreach ($row as $cell) {
                  echo "<td>$cell</td>";
                }
        echo "</tr>";
    }
    ?>
  </table>
      <input type = "button" id = "Print" name = "Print" value = "Print" disabled onclick = "printPL();">
      <input type = "button" id = "SaveRecord" name = "SaveRecord" value = "SaveRecord" disabled onclick = "createsubmit();">
</form>
</div>
</body>
<script>

function reorderid() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
  var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) {
      var cells = rows[i].getElementsByTagName("td");
      cells[0].innerText = i;
    }
}


function hideColumn() {
  var table = document.getElementById("myTable");
  var rows = table.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName("td");
    if (cells.length > 0) {
      cells[0].style.display = "none"; // Hide the first cell (column)
    }
  }
}

function unhideColumn() {
  var table = document.getElementById("myTable");
  var rows = table.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName("td");
    if (cells.length > 0) {
      cells[0].style.display = "block"; // Hide the first cell (column)
    }
  }
}

function selectAll(box) {
var checkboxes = document.getElementsByClassName('row-checkbox');
  for (var i = 0; i < checkboxes.length; i++) {
      if (box.checked) {
        checkboxes[i].checked = true;
        } else {
        checkboxes[i].checked = false;
      }
  }
}

function printPL() {
document.getElementById("entryform").style.display = "none";
document.getElementById("Print").hidden = true;
document.getElementById("SaveRecord").hidden = true;
hideColumn();
window.print();
document.getElementById("entryform").style.display = "block";
document.getElementById("Print").hidden = false;
document.getElementById("SaveRecord").hidden = false;
unhideColumn();
}

function getsizelist() {
  var select = document.getElementById("dp-Size");
  var numberOfOptions = select.options.length;
  for (let i = 1; i < numberOfOptions; i++) {
  select.remove(1);
    }
  select.selectedIndex = 0;
  //update size list
  var clnamestr = document.getElementById("dp-CName").value;
  var tr = "\"" + clnamestr + "\"";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let position = c.search(tr);
    let found = (position>0);
    if (found) {
          const myArray = c.split(",");
          let s1= myArray[5];
          const myArray3 = s1.split(":");
          let s2 = myArray3[1];
          let s3 = s2.replaceAll("\"", "");
          var option = document.createElement("option");
          option.text = s3;
          option.value = s3;
          select.appendChild(option);
      } else {
      select.selectedIndex = 0;
      }
  }
}

function updateinfo() {
var sizestr = document.getElementById("dp-Size").value;
document.getElementById("dp-Rate").value = "0";
document.getElementById("dp-CountSt").value = "0";
var tr = "SIZE:" + sizestr + ",";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let cstr = c.replaceAll("\"", "");
    let cstr1 = cstr.replaceAll("}", "");
    let cstr2 = cstr1.replaceAll("{", "");
    let position = cstr2.search(tr);
    let found = (position>0);
    if (found) {
    const myArray= cstr2.split(",");
          let rt1 = myArray[7];
          let ct1 = myArray[12];
          const myArray1= rt1.split(":");
          let rt2 = myArray1[1];
          const myArray2= ct1.split(":");
          let ct2 = myArray2[1];
    document.getElementById("dp-Rate").value = rt2;
    document.getElementById("dp-CountSt").value = ct2;
      }
  }
}

function calculateval() {
var rt = document.getElementById("dp-Rate").value;
var nums = document.getElementById("dp-Count").value;
document.getElementById("dp-TotRate").value = rt * nums;
}

function enablebutton() {
    let val = (document.getElementById("dp-CName").value !== "0" && document.getElementById("dp-Size").value !== "0" && document.getElementById("dp-Count").value !== "0");
    if (val) {
        document.getElementById("dp-Add").disabled = false;
        document.getElementById("delbutton").disabled = false;
    } else {
        document.getElementById("dp-Add").disabled = true;
        document.getElementById("delbutton").disabled = true;
    }
}

function addtotable() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
  var rowoffset = (table.rows.length-1);
  const selectElement = document.getElementById("dp-CName");
  var selectValue= selectElement.options[selectElement.selectedIndex].text;
  var w = document.getElementById("dp-Weight").value;
  var perKg = document.getElementById("dp-KGperPackage").value;
  var totcount = document.getElementById("dp-Count").value;
  var nump = (w/perKg);
  var qofW = Math.floor(w/perKg);
  var rofW = w % perKg;
  var countPkg = totcount/w;
  var countpp = countPkg * perKg;
  var qofC = Math.floor(totcount/countpp);
  var rofC = totcount % countpp;
/*
  if (rofW != 0) {
  labelcount = qofW + 1;
  } else {
  labelcount = qofW;
  }
  */
  for (let j = 0; j < qofW; j++) {
    var newRow = table.insertRow(table.rows.length);
    newRowId = rowoffset + j;
    //var selectValue1 = selectValue + "&emsp;(" + (j + 1) + " of " + labelcount + ")";
    const myArray = ["<td><input type=\"checkbox\" class=\"row-checkbox\"></td>", newRowId, selectValue, document.getElementById("dp-Size").value, document.getElementById("dp-Rate").value, countpp, perKg, (document.getElementById("dp-Rate").value*countpp)];
        for (let i = 0; i < myArray.length; i++) {
        var cell = newRow.insertCell(i);
        cell.innerHTML = myArray[i];
         }
  }
  if (rofW != 0) {
    newRowId = newRowId + 1;
    //var selectValue1 = selectValue + "&emsp;(" + (j + 1) + "of" + labelcount + ")";
    const myArray = ["<td><input type=\"checkbox\" class=\"row-checkbox\"></td>", newRowId, selectValue, document.getElementById("dp-Size").value, document.getElementById("dp-Rate").value, rofC, rofW, (document.getElementById("dp-Rate").value*rofC)];
    var newRow = table.insertRow(table.rows.length);
      for (let i = 0; i < myArray.length; i++) {
          var cell = newRow.insertCell(i);
          cell.innerHTML = myArray[i];
          }
   }
  document.getElementById("Print").disabled = false;
  document.getElementById("SaveRecord").disabled = false;
}

function deleteSelectedRows() {
  var checkboxes = document.getElementsByClassName('row-checkbox');
  var checkboxAll = document.getElementsByClassName('selectallbutton');
  var rowsToDelete = [];
  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      rowsToDelete.push(checkboxes[i].parentNode.parentNode);
    }
  }
  for (var i = 0; i < rowsToDelete.length; i++) {
    rowsToDelete[i].parentNode.removeChild(rowsToDelete[i]);
  }
  if (checkboxes.length == 0) {
  checkboxAll[0].checked = false;
  document.getElementById("Print").disabled = true;
  document.getElementById("SaveRecord").disabled = true;
  }
reorderid();
}


</script>
</html> 