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
  $dbrnvalues = array();
  $columnname = "REELNUMBER";
  dblistuniquecolvalues($db, $tablename, $columnname, $dbrnvalues, $text);
  $dbtabdata2 = array(array());
  dbreadstocktable($db, $tablename, $dbtabdata2, $text);
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
<style>
    .table-container {
        width: 40%; /* Adjust this value as needed */
        overflow-x: auto; /* Add horizontal scrollbar if content overflows */
        posiiton: absolute;
        left: -10px;
        top: 0%;
    }

    /* Optional: Add vertical scrollbar if content overflows */
    .table-container table {
        overflow-y: auto;
    }

    /* Optional: Style for table */
    table {
        border-collapse: collapse;
        width: 40%; /* Ensure table takes full width of its container */
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
    /* Style the tab buttons */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: rgb(173, 103, 79);
  display: flex; /* Use flexbox layout */
  flex-direction: column; /* Arrange tabs vertically */
  width: 18%;
  position: absolute;
  left:0%;
  top:8%;
  height: 91%;
  }
    /* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 16px;
  color: white;
  flex-grow: 1; /* Distribute space evenly among tab buttons */
  text-align: left;
  }


/* Change background color of buttons on hover */
  .tab button:hover {
  background-color: rgb(222, 191, 175);;
  color: black;
  }

/* Create an active/current tablink class */
.tab button.active {
  background-color: rgb(222, 191, 175);;
  color: black;
  }

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: none;
  border-top: none;
  }
.flex-container {
  display: flex; /* Use flexbox layout */
  border: 1px solid #ccc;
  flex-direction: row;
  width: 40%;
  height: 91%;
  position: absolute;
  left: 18%;
  top: 8%;
 }

.flex-container input[type=text], .flex-container select, .flex-container input[type=password], .flex-container input[type=email], .flex-container input[type=date], .flex-container input[type=number], .flex-container input[type=button], .flex-container input[type=submit]{
/* Styling for each item */
  border: 1px solid #ccc;
  padding: 2px;
  margin: 5px;
  width: 100%;
  -moz-appearance: textfield;
}
.flex-container h3{
  padding: 2px;
  margin: 5px;
}
.numbertype2 {
  display: flex; /* Use flexbox for easy horizontal alignment */
}

.numbertype2 input[type="number"], .numbertype2 input[type="text"] {
  width: 20%; /* Adjust the width of each input element */
  -moz-appearance: textfield; /* Optional: Firefox appearance */
  margin-right: 5px; /* Optional: Add some spacing between input elements */
  margin-top: 0px;
  margin-left: 0px;
}

</style>
</head>
<body>
<h3>Manufacturing Process Control Portal:</h3>

<div id="id01">
  <form onsubmit="handleSubmit(event);">
        <div class="tab">
          <button class="tablinks" onclick="openTab(event, 'Select')">Select a Work Order</button> 
          <button class="tablinks" onclick="openTab(event, 'Job1')">Create New Work Order</button>
          <button class="tablinks" onclick="openTab(event, 'Load')">Enter Material(Raw) Info</button>
          <button class="tablinks" onclick="openTab(event, 'Output')">Review Work Order</button>
          <button class="tablinks" onclick="openTab(event, 'Complete')">Update Work Order Status</button>
      </div>
   <div class="flex-container">
      <div id="Select" class="tabcontent">
      <table id="myTable">
          <tr>
            <th>WO No:</th>
            <th>Customer Name</th>
            <th>Target</th>
          </tr>
        </table>
      </div>
      <div id="Job1" class="tabcontent">
            <h3>WorkOrder:</h3>
            <label for="Machine"><b>Machine: *</label>
            <select name="Machine" id="Machine" required min = "1">
              <option value="0">Select</option>
      <?php
        // Loop through the array to generate list items
      foreach ($machinelist as $value) {
            echo "<option value='$value'>$value</option>";
          }
      ?>
            </select>
            <label for="pRC-P-CName"><b>Client Name: *</label>
            <select name="pRC-P-CName" id="pRC-P-CName" onchange="getsizelist();">
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
            <label for="pRC-P-Target"><b>Target</label>
            <input type = "number" id = "pRC-P-Target" name = "pRC-P-Target" required min = "1" step = "1">
            <label for="pRC-P-Size"><b>Cover Size: *</label>
            <select name="pRC-P-Size" id="pRC-P-Size" onchange="updateval();">
              <option value="0">Select</option>
            </select>
            <label for="pR-P-CUnit"><b>Unit: *</label>
            <input type = "text" id = "pR-P-CUnit" name = "pR-P-CUnit" required size="5" disabled>
            <label for="pR-P-CGSM"><b>GSM: *</label>
            <input type = "text" id = "pR-P-CGSM" name = "pR-P-CGSM" required size="5" disabled>
     </div>
     <div id="Load" class="tabcontent">
        <h3>Material Info:</h3>
        <label for="pRCRN"><b>Reel Number: *</label>
        <select name="pRCRN" id="pRCRN" onchange = "updatereelinfo();calculateval();">
           <option value="0">Select</option>
                 <?php
      foreach ($dbrnvalues as $value) {
            echo "<option value='$value'>$value</option>";
          }
      ?>
        </select>
        <div id = "RMInfo" class = "numbertype2">
          <label for="pRCMT"><b>Material: *</label>
          <input type = "text" id = "pRCMT" name = "pRCMT" required size="15" disabled>
          <label for="pRC-RM-GSM"><b>GSM: *</label>
          <input type = "number" id = "pRC-RM-GSM" name = "pRC-RM-GSM" required disabled>
          <label for="pRC-RM-RW"><b>ReelWeight(Kg): *</label>
          <input type = "number" id = "pRC-RM-RW" name = "pRC-RM-RW" required disabled>
          <label for="pRC-RM-RS"><b>ReelSize: *</label>
          <input type = "number" id = "pRC-RM-RS" name = "pRC-RM-RS" required disabled>
        </div>

        <label for="pRC-ReelWidth"><b>Reel Width(cm): *</label>
        <input type = "number" id = "pRC-ReelWidth" name = "pRC-ReelWidth" required min = "1" step = "0.01" onchange = "calculateval();">
        <label for="pRC-ReelLength"><b>Reel Length(cm): *</label>
        <input type = "number" id = "pRC-ReelLength" name = "pRC-ReelLength" required min = "1" step = "0.01" onchange = "calculateval();">
        <label for="pRC-Est.WeightPK"><b>Estimated Weight(Kg/1000): *</label>
        <input type = "number" id = "pRC-TotalWeight" name = "pRC-TotalWeight" required min = "1" step = "0.01" disabled>
        <label for="rStatus"><b>Reel Status: *</label>
        <select name="rStatus" id="rStatus" required min = "1">
          <option value="0">Select</option>
          <option value="1">In-Stock</option>
          <option value="2">In-Factory</option>
          <option value="4">Loaded</option>
          <option value="5">LeftOver</option>
          <option value="6">Finished</option>
         </select>  
     </div>
     <div id="Output" class="tabcontent">
        <h3>Review :</h3>
        <label for="pRc-Wastage"><b>Wastage:</label>
        <input type = "number" id = "pRc-Wastage" name = "pRc-Wastage" required step = "0.01" onchange = "calculateval();">
        <label for="pRC-UsedW"><b>Used Reel Weight:</label>
        <input type = "number" id = "pRC-UsedW" name = "pRC-UsedW" step = "0.01" disabled>
        <label for="pRC-Est-ProdW"><b>Estimated Production:</label>
        <input type = "number" id = "pRC-Est-ProdW" name = "pRC-Est-ProdW" step = "0.01" disabled>
        <label for="pRC-Act-Prod"><b>Actual Production: </label>
        <input type = "number" id = "pRC-Act-Prod" name = "pRC-Act-Prod" step = "0.01" disabled>
        <label for="pRC-PerCLoss"><b>PerCoverLoss:</label>
        <input type = "number" id = "pRC-PerCLoss" name = "pRC-PerCLoss" step = "0.01" disabled>
        <label for="pRC-ExtraWaste"><b>Extra Watse:</label>
        <input type = "number" id = "pRC-ExtraWaste" name = "pRC-ExtraWaste" step = "0.01" disabled>
        <label for="pRC-TotalWaste"><b>Total Waste:</label>
        <input type = "number" id = "pRC-TotalWaste" name = "pRC-TotalWaste" step = "0.01" disabled>
     </div>
     <div id="Complete" class="tabcontent">
        <h3>Work Order Status:</h3>
        <select name="wOStatus" id="wOStatus" required min = "1">
              <option value="0">Select</option>
              <option value="1">Not Started</option>
              <option value="2">In Milling</option>
              <option value="3">Hold</option>
              <option value="4">Finished/Close</option>
         </select>
         <label for="pRC-P-Actual"><b>Actual Production:</label>
         <input type = "number" id = "pRC-P-Actual" name = "pRC-P-Actual" required min = "1" step = "1" onchange = "calculateval();">
         <input type = "submit" id = "WOSave" name = "WOSave" value = "Save">
         <input type = "button" id = "WOCancel" name = "WOCancel" value = "Cancel">
      </div>
  </form>
</div>

<script>
    // Function to switch between tabs
    tabcontent[0].style.display = "block";
    document.getElementById("id02").style.display = "none";
    document.getElementById("myForm2").style.display = "none";

    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

function getsizelist() {
  var select = document.getElementById("pRC-P-Size");
  var numberOfOptions = select.options.length;
  for (let i = 1; i < numberOfOptions; i++) {
  select.remove(1);
    }
  select.selectedIndex = 0;
  //update size list
  var clnamestr = document.getElementById("pRC-P-CName").value;
  var tr = "\"" + clnamestr + "\"";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let position = c.search(tr);
    let found = (position>0);
    if (found) {
          const myArray = c.split(",");
          let s1= myArray[6];
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

function updateval() {
var sizestr = document.getElementById("pRC-P-Size").value;
document.getElementById("pR-P-CUnit").value = "Not Found";
document.getElementById("pR-P-CGSM").value = "Not Found";
var tr = "\"SIZE\":" + "\"" + sizestr + "\"";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let position = c.search(tr);
    let found = (position>0);
    if (found) {
          const myArray = c.split(",");
          let su1 = myArray[7];
          let sgsm1 = myArray[5];
          const myArray4 = su1.split(":");
          let su2 = myArray4[1];
          let su3 = su2.replaceAll("\"", "");
          const myArray5 = sgsm1.split(":");
          let sgsm2 = myArray5[1];
          let sgsm3 = sgsm2.replaceAll("\"", "");
          document.getElementById("pR-P-CUnit").value = su3;
          document.getElementById("pR-P-CGSM").value = sgsm3;
      }
  }
}
function updatereelinfo(){
var reelsizestr = document.getElementById("pRCRN").value;
document.getElementById("pRCMT").value = "Not Found";
document.getElementById("pRC-RM-GSM").value = "Not Found";
document.getElementById("pRC-RM-RW").value = "Not Found";
document.getElementById("pRC-RM-RS").value = "Not Found";
var tr = "REELNUMBER:" +  reelsizestr;
  for (let i = 1; i < jsArray_1.length; i++) {
    let c = JSON.stringify(jsArray_1[i]);
    let cstr = c.replaceAll("\"", "");
    let position = cstr.search(tr);
    let found = (position>0);
    if (found) {
          const myArray = c.split(",");
          let sd1 = myArray[4];
          let srw1 = myArray[6];
          let sd3 = sd1.replaceAll("\"", "");
          const myArray6 = sd3.split("-");
          let mattype1 = myArray6[0];
          let mattype2 = mattype1.split(":");
          let mattype3 = mattype2[1];
          let pgsm1 = myArray6[1];
          let pgsm2 = pgsm1.split(":");
          let pgsm3 = pgsm2[1];
          let srs1 = myArray6[3];
          let srs2 = srs1.split(":");
          let srs3 = srs2[1];
          const myArray5 = srw1.split(":");
          let srw2 = myArray5[1];
          let srw3 = srw2.replaceAll("\"", "");
          document.getElementById("pRCMT").value = mattype3;
          document.getElementById("pRC-RM-GSM").value = pgsm3;
          document.getElementById("pRC-RM-RW").value = srw3;
          document.getElementById("pRC-RM-RS").value = srs3;
      }
  }

}

function calculateval() {
var reelw = document.getElementById("pRC-ReelWidth").value;
var reell = document.getElementById("pRC-ReelLength").value;
var waste = document.getElementById("pRc-Wastage").value;
var gsm = document.getElementById("pRC-RM-GSM").value;
var rw = document.getElementById("pRC-RM-RW").value;
var act = document.getElementById("pRC-P-Actual").value;
var totalestw = ((reelw * reell * gsm)/10000);
document.getElementById("pRC-TotalWeight").value = parseFloat(totalestw).toFixed(2);
var usedweight = rw-waste;
document.getElementById("pRC-UsedW").value = parseFloat(usedweight).toFixed(2);
var estprod = (usedweight/totalestw) * 1000;
document.getElementById("pRC-Est-ProdW").value = parseFloat(estprod).toFixed(2);
var actprod = act - estprod;
document.getElementById("pRC-Act-Prod").value = parseFloat(actprod).toFixed(2);
var pcloss = totalestw/1000;
document.getElementById("pRC-PerCLoss").value = parseFloat(pcloss).toFixed(2);
var exwaste = (pcloss * actprod);
document.getElementById("pRC-ExtraWaste").value = parseFloat(exwaste).toFixed(2);
var totalwaste = waste - exwaste;
document.getElementById("pRC-TotalWaste").value = parseFloat(totalwaste).toFixed(2);

}

function handleSubmit(event) {
  event.preventDefault(); // Prevent default form submission behavior
  const inputField = document.getElementById('inputField');
  console.log("Input value:", inputField.value);
  // Further processing or form submission logic can go here
    }
</script>

</body>
</html>