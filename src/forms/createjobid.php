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
  require "/home/app/src/Reset.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["ClListTabName"];
  $columnname = "NAME";
  $dbcolvalues = array(array());
  dbgetcolumnname($db, $tablename, $columnname, $dbcolvalues, $text);
  $tablename = $_SESSION["PListTabName"];
  $columnname = "CUSTOMERNAME";
  $dbcolvalues2 = array(array());
  dblistuniquecolvalues($db, $tablename, $columnname, $dbcolvalues2, $text);
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
  $tablename = $_SESSION["JobTabName"];
  $dbtabdata2 = array(array());
  dbreadtable($db, $tablename, $dbtabdata2, $text);
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
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        width: 12px; /* Adjust the width as needed */
        height: 12px; /* Maintain aspect ratio */
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
/* width: 112px;*/
height: 20px;
}

.customselect {
width: 8.5%;
/* width: 112px;*/
height: 20px;
}
</style>
</head>
 
<body>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Libre+Barcode+128">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text">
<div id="id01">
  <form action="#" method="post" enctype="multipart/form-data" id = "entryform">
    <h3>Create Job ID:</h3>
    <label for="dp-Date"><b>Date:</label>
    <input type = "date" id = "dp-Date" name = "dp-Date" required value="<?php echo date('Y-m-d'); ?>">
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
    <label for="dp-Count"><b>Count: *</label>
    <input type = "number" id = "dp-Count" name = "dp-Count" value = "0" step = "1" min = "0" onchange = "enablebutton();">
    <label for="dp-pOnum"><b>Customer PO Number: *</label>
    <input type = "text" id = "dp-pOnum" name = "dp-pOnum" step = "1" min = "1" onchange = "enablebutton();updateponum();">
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
    <input type = "button" id = "dpSave" value = "dpSave" style="display: none;" onclick = "addrecord()">
    <input type = "button" id = "SaveRecord" name = "SaveRecord" value = "AddRecord" disabled onclick = "createsubmitevent()"><br><br>
    <input type = "button" onclick="deleteSelectedRows();" disabled id = "delbutton" name = "delbutton" value = "Deleted Selected Rows &#x1F5D1;">
</form>
</div>
<br><br>

<table id = "myTable">
  <tr>
    <th>Job ID</th>
    <th>Date</th>
    <th>Customer Name</th>
    <th>Ship To</th>
    <th>Size</th>
    <th>Count</th>
    <th>Customer PO Ref</th>
    <th>Status</th>
    <th>COMPANYID</th>
  </tr>
  <?php
  // Loop through the array to generate table rows
  $i=0;
  foreach ($dbtabdata2 as $row) {
      echo "<tr>";
      foreach ($row as $cell) {
                echo "<td>$cell</td>";
              }
           if ($i) {
              echo "<td><input type=\"checkbox\" class=\"row-checkbox\"></td>";
           }
           $i = $i+1;
      echo "</tr>";
  }
  ?>
</table>
</body>
<script>

function createsubmitevent() {
var data = [];
data.push("testdata;");
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
var cname = document.getElementById("dp-CName").value;
document.getElementById("dp-Rate").value = "0";
document.getElementById("dp-CountSt").value = "0";
var tr = "SIZE:" + sizestr + ",";
var tr2 = "CUSTOMERNAME:" + cname + ",";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let cstr = c.replaceAll("\"", "");
    let cstr1 = cstr.replaceAll("}", "");
    let cstr2 = cstr1.replaceAll("{", "");
    let position = cstr2.search(tr);
    let position2 = cstr2.search(tr2);
    let found = (position > 0 && position2 > 0);
    if (found) {
    const myArray= cstr2.split(",");
          let rt1 = myArray[7];
          let ct1 = myArray[10];
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

function enablebutton() {
    let val = (document.getElementById("dp-CName").value !== "0" && document.getElementById("dp-CName").value !== "Select" && document.getElementById("dp-Size").value !== "" && document.getElementById("dp-Size").value !== "0" && document.getElementById("dp-Count").value !== "0" && document.getElementById("dp-Count").value !== "" && document.getElementById("dp-pOnum").value !== "" && document.getElementById("dp-pOnum").value !== "0" && document.getElementById("dp-CuName").value !== "0" && document.getElementById("dp-CuName").value !== "Select");
    if (val) {
        document.getElementById("delbutton").disabled = false;
        document.getElementById("SaveRecord").disabled = false;
           } else {
        document.getElementById("delbutton").disabled = true;
        document.getElementById("SaveRecord").disabled = true;
    }
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
  }
}

function addrecord() {
    // Get values from input elements
    var dpdate = document.getElementById("dp-Date").value;
    var dpdid = document.getElementById("dp-DiD").value;
    var dpcuname = document.getElementById("dp-CuName").value;
    var dptableData = document.getElementById("dptableData").value;

    // Create data object to be sent to the server
    var data = {
        dpdate: dpdate,
        dpdid: dpdid,
        dpcuname: dpcuname,
        dptableData: dptableData
    };

    // Make AJAX request
    $.ajax({
        url: 'saverecord-cjid.php', // URL of the server-side script
        type: 'POST', // HTTP method to use for the request
        enctype: 'multipart/form-data',
        data: data, // Data to send to the server
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8', // Content type of the request
        success: function(response) {
            // Handle successful response
            //alert('Response from server: ' + response);
            
            // If expecting JSON response, you can parse it like this:
            // let jsonResponse = JSON.parse(response);
            // alert('Response from server: ' + jsonResponse.message);
            alert ("record saved!");
        },
        error: function(xhr, status, error) {
            // Handle error response
            alert('Request failed with status: ' + status + ', error: ' + error);
        }
    });
}


</script>
</html> 