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
  $columnname = "CUSTOMERNAME";
  $dbcolvalues2 = array(array());
  dblistuniquecolvalues($db, $tablename, $columnname, $dbcolvalues2, $text);
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  $tablename = $_SESSION["DocIdTabName"];
  dbcreatedocidtable($db, $tablename, $text);
  dbgetdocid($db, $tablename, "Dispatch", $DOCID, $text);
  dbeditdocidrecord($db, $tablename, "Dispatch", $DOCID, "alloted", $text);
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
  white-space: pre-wrap;
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

table tr td:nth-child(3),
table tr th:nth-child(3) {
    width: 420px; /* Set your desired width */
}
table tr td:nth-child(4),
table tr th:nth-child(4) {
    width: 110px; /* Set your desired width */
}
table tr td:nth-child(7),
table tr th:nth-child(7) {
    width: 60px; /* Set your desired width */
}
table tr td:nth-child(8),
table tr th:nth-child(8) {
    width: 110px; /* Set your desired width */
}
/*
td:nth-child(5),
th:nth-child(5) {
  display: none;
}
td:nth-child(7),
th:nth-child(7) {
  display: none;
}
td:nth-child(8),
th:nth-child(8) {
  display: none;
}
*/
td:nth-child(9),
th:nth-child(9) {
  display: none;
}
td:nth-child(10),
th:nth-child(10) {
  display: none;
}
caption {
text-align: middle; /* Move the caption text to the right */
border: 1px solid #ddd; /* Add border to the caption */
padding: 5px; /* Add padding to the caption */
}

tfoot input[type=text]{
width: 100%;
}
th input[type=text]{
width: 80%;
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

/* Full-width input fields */
input[type=text], input[type=date], input[type=number]{
  width: 75px;
}
input[type=date] {
 width: 100px;
}

.hidden {
        display: none;
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
    <label for="dp-Dispatch ID"><b>DSl.No: *</label>
    <input type = "text" id = "dp-Dispatch ID" name = "dp-Dispatch ID" value = "<?php echo $DOCID; ?>" step = "1" min = "0" disabled>
    <label for="dp-Date"><b>Date:</label>
    <input type = "date" id = "dp-Date" name = "dp-Date" required value="<?php echo date('Y-m-d'); ?>" onchange = "copydate();">
    <label for="dp-CName"><b>Client Name: *</label>
    <select name="dp-CName" id="dp-CName" onchange="getsizelist();enablebutton();">
      <option value="0">Select</option>
      <?php
      // Loop through the array to generate list items
            foreach ($dbcolvalues2 as $value) {
              echo "<option value='$value'>$value</option>";
            }
        ?>
        </select>
    <label for="dp-Size"><b>Size: *</label>
    <select name="dp-Size" id="dp-Size" onchange = "updateinfo();enablebutton();" class = "customselect">
      <option value="0">Select</option>
    </select> 
    <label for="dp-Rate"><b>Rate(₹):</label>
    <input type = "number" id = "dp-Rate" name = "dp-Rate" value = "0" disabled><br><br>
    <input type = "hidden" id = "dp-Rate2" value = "0" name = "dp-Rate2"> 
    <label for="dp-CountSt"><b>Stock Count:</label>
    <input type = "number" id = "dp-CountSt" name = "dp-CountSt" value = "0" disabled>    
    <label for="dp-Count"><b>Count: *</label>
    <input type = "number" id = "dp-Count" name = "dp-Count" value = "0" step = "1" min = "0" onchange = "enablebutton();">
    <label for="dp-Weight"><b>Weight(Kg): *</label>
    <input type = "number" id = "dp-Weight" name = "dp-Weight" value = "0" step = "0.01" min = "0" onchange = "enablebutton();">
    <input type = "text" id = "dp-Desc" name = "dp-Desc" style = "display:none;">
    <label for="dp-Bundle"><b>No. of Bundles: *</label>
    <input type = "number" id = "dp-Bundle" name = "dp-Bundle" value = "0" step = "1" min = "0" onchange = "enablebutton();">
    <input type = "button" name = "dp-Add" id = "dp-Add" value = "Add to table" disabled onclick = "addtotable();enablebutton();">
    <br><br>
    <label for="dp-pOnum"><b>Customer PO Number: *</label>
    <input type = "text" id = "dp-pOnum" name = "dp-pOnum" step = "1" min = "1" onchange = "enablebutton();">
    <label for="dp-CuName"><b>Ship To: *</label>
    <select name="dp-CuName" id="dp-CuName" onchange = "enablebutton();">
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
    <input type="hidden" id="dptableData" name="dptableData">
    <input type = "submit" id = "dpSave" value = "dpSave" style="display: none;">
    <input type = "button" id = "SaveRecord" name = "SaveRecord" value = "SaveRecord" disabled onclick = "createsubmitevent();"><br><br>
    <input type = "button" onclick="deleteSelectedRows();" disabled id = "delbutton" name = "delbutton" value = "Deleted Selected Rows &#x1F5D1;">
</form>
</div>
<div>
<form action="#" method="post" enctype="multipart/form-data" id = "form2">
  <table id = "myTable" name = "myTable" oninput = "calculate();">
  <caption style="text-align: middle;">
      <?php echo $mycompanyvalues[1] . " PACKING LIST" ."(DSl.No:" . $DOCID . ")"; ?> 
      <span style="float: left;"> 
          <?php //echo date('Y-m-d, H:i:s');  ?> 
          Date: <input type = "text" id = "dAte2" name = "dAte2" disabled>
      </span> 
      <span style="float: right;"> 
          Location: <?php echo $mycompanyvalues[4]; ?>  
      </span> 
  </caption>
    <tr>
      <td><input type="checkbox" class = "selectallbutton" onchange = "selectAll(this);"></td>
      <td>S.No:</td>
      <td>ItemName</td>
      <td>Size(Cm)</td>
      <td>RatePerC(₹)</td>
      <td>Count</td>
      <td>Weight(Kg)</td>
      <td>Rate(₹)</td>
      <td>P</td>
      <td>CustomerName</td>
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
    <tfoot>
    <tr>
    <td colspan="1"></td>
    <td colspan="1"></td>
    <td colspan="1"></td>
    <td colspan="1"></td>
    <td colspan="1"></td>
    <td colspan="1"></td>
    <td colspan="1"><input type = "text" id = "totw" name = "totw" disabled></td>
    <td colspan="1"><input type = "text" id = "totc" name = "totc" disabled></td>
    </tr>
  </tfoot>

  </table>
  
      <input type = "button" id = "Print" name = "Print" value = "Print" disabled onclick = "printPL();">
      <input type = "button" id = "PrintLabel" name = "PrintLabel" value = "Print Labels" disabled onclick = "printlabel();">
      
</form>
</div>
</body>
<script>

function copydate() {
document.getElementById("dAte2").value = document.getElementById("dp-Date").value
}
copydate();

function hideColumn(columnIndex) {
  var table = document.getElementById("myTable");
  var rows = table.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName("td");
    if (cells.length > columnIndex) {
      cells[columnIndex].style.display = 'none';// Hide the first cell (column)
    }
 }
}

function unhideColumn(columnIndex) {
  var table = document.getElementById("myTable");
  var rows = table.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName("td");
    if (cells.length > columnIndex) {
      cells[columnIndex].style.display = ''; //unhide the first cell (column)
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
document.getElementById("PrintLabel").hidden = true;
hideColumn(0);
hideColumn(4);
hideColumn(6);
hideColumn(7);
addbundlenum();
window.print();
document.getElementById("entryform").style.display = "block";
document.getElementById("Print").hidden = false;
document.getElementById("SaveRecord").hidden = false;
document.getElementById("PrintLabel").hidden = false;
unhideColumn(0);
unhideColumn(4);
unhideColumn(6);
unhideColumn(7);
removebundlenum();
}

function calculate(){
    var table = document.getElementById('myTable');
    var rows = table.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var resultCell = cells[7];
        if (cells.length >= 2) {
            var value1 = parseInt(cells[4].textContent);
            var value2 = parseInt(cells[5].textContent);
            if (!isNaN(value1) && !isNaN(value2)) {
              resultCell.textContent = value1 * value2;
            }
      }
    }
    calculate3();
}

function calculate2(){
    var table = document.getElementById('myTable');
    var rows = table.getElementsByTagName('tr');
    for (var i = 1; i < (rows.length-1); i++) {
        var cells = rows[i].getElementsByTagName('td');
        var resultCell = cells[1];
        if (cells.length >= 2) {
            var value1 = i-1;
            if (!isNaN(value1)) {
              resultCell.textContent = value1;
            }
      }
    }
}

function createsubmitevent() {
removebundlenum();
var data = [];
var table = document.getElementById('myTable');
var rows = table.getElementsByTagName('tr');
for (var i = 1; i < (rows.length-1); i++) {
    var cells = rows[i].getElementsByTagName('td');
    for (var j=1; j < cells.length;j++) {
            var value1 = cells[j].textContent;
              data.push(value1);
          }
        data.push(";")
      }
document.getElementById('dptableData').value = JSON.stringify(data);
document.getElementById("dpSave").value = "dpSave";
document.getElementById("dpSave").click();
}

function addbundlenum() {
    var table = document.getElementById('myTable');
    var rows = table.getElementsByTagName('tr');
    for (var i = 1; i < (rows.length - 1); i++) {
        var cells = rows[i].getElementsByTagName('td');
        if (cells.length >= 1) {
            var ct = cells[2].textContent;
            var value1 = ct + "\t\t\t" + (i-1) + "/" + (rows.length - 3); // Using '\t' for tab space
            cells[2].textContent = value1; // Set the modified content back to the cell
        }
    }
}

function removebundlenum() {
    var table = document.getElementById('myTable');
    var rows = table.getElementsByTagName('tr');
    for (var i = 1; i < (rows.length - 1); i++) {
        var cells = rows[i].getElementsByTagName('td');
        if (cells.length >= 1) {
            var ct = cells[2].textContent;
            const myArray1= ct.split("\t\t\t");
            cells[2].textContent = myArray1[0]; // Set the modified content back to the cell
        }
    }

}

function calculate3() {
    var table = document.getElementById('myTable');
    var rows = table.getElementsByTagName('tr');
    document.getElementById("totw").value = 0;
    document.getElementById("totc").value = 0;
    var sum1 = 0;
    var sum2 = 0;
    for (var i = 1; i < (rows.length-1); i++) {
        var cells = rows[i].getElementsByTagName('td');
        if (cells.length >= 5) {
        var ct = cells[6].textContent;
        var value1 = parseInt(ct);
        var ct1 = cells[7].textContent;
        var value2 = parseInt(ct1);
        sum1 = sum1 + value1;
        sum2 = sum2 + value2;
        }
      }
      let formatter = new Intl.NumberFormat('en-IN', {
          style: 'currency',
          currency: 'INR'
      });
    document.getElementById("totw").value = sum1;
    document.getElementById("totc").value = formatter.format(sum2);
}


function getsizelist() {
  var select = document.getElementById("dp-Size");
  var clnamestr = document.getElementById("dp-CName").value;
  if (clnamestr == "Select"){
  document.getElementById("dp-CName").disabled = false;
  } else {
  document.getElementById("dp-CName").disabled = true;
  }
  var numberOfOptions = select.options.length;
  for (let i = 1; i < numberOfOptions; i++) {
  select.remove(1);
    }
  select.selectedIndex = 0;
  //update size list
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
          let ds1 = myArray[2];
          let spec1 = myArray[3];
          const myArray1= rt1.split(":");
          let rt2 = myArray1[1];
          const myArray2= ct1.split(":");
          let ct2 = myArray2[1];
          const myArray3= ds1.split(":");
          let ds2 = myArray3[1];
          const myArray4= spec1.split(":");
          let spec2 = myArray4[1];
    document.getElementById("dp-Rate").value = rt2;
    document.getElementById("dp-CountSt").value = ct2;
    document.getElementById("dp-Desc").value = ds2 + "(" + spec2 + ")";
      }
  }
}
/*
function calculateval() {
var rt = document.getElementById("dp-Rate").value;
var nums = document.getElementById("dp-Count").value;
document.getElementById("dp-TotRate").value = rt * nums;
}
*/
function enablebutton() {
    let val = (document.getElementById("dp-CName").value !== "0" && document.getElementById("dp-CName").value !== "Select" && document.getElementById("dp-Size").value !== "" && document.getElementById("dp-Size").value !== "0" && document.getElementById("dp-Count").value !== "0" && document.getElementById("dp-Count").value !== "" && document.getElementById("dp-Weight").value !== "0" && document.getElementById("dp-Weight").value !== "" && document.getElementById("dp-Bundle").value !== "0" && document.getElementById("dp-Bundle").value !== "");
      var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
      var rows = (table.rows.length-1);
    if (val) {
        document.getElementById("dp-Add").disabled = false;
        document.getElementById("delbutton").disabled = false;
         let val1 =(document.getElementById("dp-pOnum").value !== "" && document.getElementById("dp-pOnum").value !== "0" && document.getElementById("dp-CuName").value !== "0" && document.getElementById("dp-CuName").value !== "Select" && rows > "0");
           if (val1) {
           document.getElementById("SaveRecord").disabled = false;
           } else {
           document.getElementById("SaveRecord").disabled = true;
           }
    } else {
        document.getElementById("dp-Add").disabled = true;
        document.getElementById("delbutton").disabled = true;
        document.getElementById("SaveRecord").disabled = true;
    }
}

function addtotable() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
  var rowoffset = (table.rows.length-1);
  const selectElement = document.getElementById("dp-CName");
  var selectValue= selectElement.options[selectElement.selectedIndex].text;
  var w = document.getElementById("dp-Weight").value;
  var numofbundles = document.getElementById("dp-Bundle").value;
  var count = document.getElementById("dp-Count").value;
  var ds = document.getElementById("dp-Desc").value;
    for (let j = 0; j < numofbundles; j++) {
      var newRow = table.insertRow(table.rows.length);
      newRowId = rowoffset + j;
      var actbundle = parseInt(numofbundles) + parseInt(rowoffset-1);
      var ds1 = ds + "&nbsp;&nbsp;&nbsp;&nbsp;" + ((j+1) + " / " + actbundle);
      const myArray = ['<td><input type=\"checkbox\" class=\"row-checkbox\"></td>', newRowId, ds, document.getElementById("dp-Size").value, document.getElementById("dp-Rate").value, '<td><div input type = \"number\" contenteditable>' + count + '</div></td>', '<td><div input type = \"number\" contenteditable>' + w + '</div></td>', (document.getElementById("dp-Rate").value * count), ((j+1) + " / " + actbundle), selectValue];
      for (let i = 0; i < myArray.length; i++) {
          var cell = newRow.insertCell(i);
          cell.innerHTML = myArray[i];
      }
    }
 document.getElementById("Print").disabled = false;
 document.getElementById("PrintLabel").disabled = false;
 calculate3();
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
  document.getElementById("PrintLabel").disabled = true;
  document.getElementById("totw").value = 0;
  document.getElementById("totc").value = 0;
  } else {
  calculate2();
  calculate3();
  }
}


</script>
</html> 