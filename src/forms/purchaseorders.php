 <?php
  $root = $_SERVER['DOCUMENT_ROOT'];
  //---add the DB API file
  require $root."/DB/call-db.php";
  //---open SQL lite 3 .db file
  dbsetup($db, $text);
  $tablename = $_SESSION["SListTabName"];
  $columnname = "NAME";
  $dbcolvalues = array(array());
  dbgetcolumnname($db, $tablename, $columnname, $dbcolvalues, $text);
  $dbsuptabdata = array(array());
  dbreadtable($db, $tablename, $dbsuptabdata, $text);
  $igstlist = array();
  $columnname = "IGST";
  dbgetcolumnname($db, $tablename, $columnname, $igstlist, $text);
  $tablename = $_SESSION["CoListTabName"];
  $paramname = "ID";
  $paramvalue = "6100";
  $dbrowvalues= array();
  dbreadrecord($db, $tablename, $paramname, $paramvalue, $dbrowvalues, $text);
  $jsonArray_4 = json_encode($dbrowvalues);
  $val = str_replace("]", "", $jsonArray_4);
  $val = str_replace("[", "", $val);
  $val = str_replace("\",", "", $val);
  $datarray = explode("\"", $val);
  $tablename = $_SESSION["ComListTabName"];
  $dbtabdata = array(array());
  dbreadtable($db, $tablename, $dbtabdata, $text);
    $tablename = $_SESSION["PRTabName"];
  dbcreatePRtable($db, $tablename, $text);
  $paramname = "PRNUMBER";
  $tablename = $_SESSION["PRNumTabName"];
  dbcreateprnumtable($db, $tablename, $text);
  dbreadprnumrecord($db, $tablename, $paramname, $newPRNum, $text);
    if ($newPRNum == 1) {
        $paramname = "PONUM";
        $tablename = $_SESSION["PRTabName"];
        dbreadprnumrecord($db, $tablename, $paramname, $newPRNum, $text);
          if ($newPRNum == 1) {
              $newPRNum = $_SESSION["InitPONum"] + 1;
          }
      }
  $tablename = $_SESSION["PRNumTabName"];
  $PRDes = "Allocated";
  dbaddprnumrecord($db, $tablename, $newPRNum, $PRDes, $text);
  dbclose($db, $text);
  $PONum = $newPRNum;
  // Convert the array of objects to a JSON array
  $jsonArray_1 = json_encode($igstlist);
  //commodity table data
  $jsonArray_2 = json_encode($dbtabdata);
  //supplier table data
  $jsonArray_3 = json_encode($dbsuptabdata);
  $jsonArray_4 = json_encode($datarray);
  // Echo the JSON array
  echo '<script>';
  echo 'var jsArray_1 = ' . $jsonArray_1 . ';';
  echo 'console.log(jsArray_1);'; // Output the array in the browser console
  echo 'var jsArray_2 = ' . $jsonArray_2 . ';';
  echo 'console.log(jsArray_2);'; // Output the array in the browser console
  echo 'var jsArray_3 = ' . $jsonArray_3. ';';
  echo 'console.log(jsArray_3);'; // Output the array in the browser 
  echo 'var jsArray_4 = ' . $jsonArray_4. ';';
  echo 'console.log(jsArray_4);'; // Output the array in the browser console
  echo '</script>';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
.image1 {
  position: relative;
  top: 0;
  left: 0;
  width: 100%;
  height: 101px;
  //border: 1px solid #000000;
  border: none
}
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
  width: 100%;
  border: 1px solid #ddd;
  border-right: 1px solid #000;
}

th, td {
  text-align: left;
  padding: 0px;
  border: 1px solid #000;
  border-right: 1px solid #000;
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

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
  width: 103px;

}

input[type=date] {
width: 100px;
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
  height: auto;
}
/* Add styles to the form container */
.form-container {
  max-width: 500px;
  width: 320px;
  padding: 10px;
  background-color: white;
  font: inherit;
  height: auto;
 }

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password], .form-container input[type=email], .form-container input[type=date], .form-container input[type=number]{
  width: 55%;
  height: 0px;
  padding: 15px;
  margin: 5px 0 2px 0;
  border: none;
  font-family: "Source Sans Pro", "sans-serif";
  font-size: 15px;
  background: #f2f2f2;
  text-align: right;
}
.form-container label {
  /* Your general styles for labels */
  font-size: 16px;
  color: #333;
  text-align: left;
}
.form-container select{
  width: 90%;
  padding: auto;
  border: none;
  background: #f2f2f2;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #f2f2f2;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #f2f2f2;
  color: #f2f2f2;
  border: none;
  cursor: pointer;
  margin-bottom:10px;
  opacity: 0.2;
}
/* Add a red background color to the cancel button */
.form-container .updatebtn {
  background-color: #f2f2f2;
  color: Green;
  opacity: 0.7;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: #f2f2f2;
  opacity: 0.5;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
select {
width: 12%;
/* width: 120px;*/
height: 20px;
}

 .form-container2 {
            display: flex;
            justify-content: center; /* Horizontal center alignment */
            align-items: center; /* Vertical center alignment */
            height: auto; /* Height of the container */
            width: 100%;
            border: none; /* Border for visualization */
            flex-direction: row;
            margin-bottom: 0;
        }

.textbox {
            border: 1px solid #000; /* Border of the text box */
            padding: 10px; /* Padding inside the text box */
            height: auto;
            margin-right: 0px; /* Spacing between rectangles */
            width: 100%; /* Width of the text box */
            font-size: 12px;
            margin-bottom: 0px;
            margin-top: 0px;
            text-align: center; /* Align text to the center */
        }
.form-group3 {
            display: flex;
            align-items: center;
        }
.input-box {
            margin-bottom: 0px;
            margin-top: 0px; /* Remove margin bottom */
            width: calc(100% - 20px); /* Full width minus padding */
            height: auto;
            box-sizing: border-box; /* Include padding and border in the width */
            border: none;
            margin-left: -28px;
        }
 .title-box {
            margin-bottom: 0; /* Remove margin bottom */
            width: calc(100% - 20px); /* Full width minus padding */
            height: auto;
            box-sizing: border-box; /* Include padding and border in the width */
            border: none;
            text-align: center; /* Align text to the center */
            font-weight: bold; /* Make the text bold */
        }
.form-group3 label {
            /* Your general styles for labels */
            margin-right: 40px; /* Adjust spacing between label and input */
            font-size: 12px;
            color: #333;
            text-align: left;
            vertical-align: left;
            font-weight: bold; 
            width:25%;
}

.form-group4{
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

.form-group4 label {
            /* Your general styles for labels */
            color: white;
            margin-right: 40px; /* Adjust spacing between label and input */
            font-size: 12px;
            text-align: left;
            vertical-align: left;
            font-weight: bold; 
            width:25%;

}
.form-group4 h3 {
            font-size: 14px;
            text-align: left;
            vertical-align: left;
            font-weight: bold;
            padding: 1px;
            margin-bottom: 0;
            margin-top: 0;
}
.form-group4 p {
            font-size: 12px;
            text-align: left;
            vertical-align: left;
            font-weight: normal;
            padding: 1px;
            margin-bottom: 0;
            margin-top: 0;
}

.form-group5 {
            align-items: left;
            text-align: left;
            margin-bottom: 0;
            margin-top: 0;
        }

.form-group6 {
            align-items: right;
            text-align: right;
            margin-bottom: 0;
            margin-top: 0;
        }

.image-container {
        width: 100px; /* Adjust the width as needed */
        height: auto; /* This maintains the aspect ratio */
        float: right;
    }

.image-container img {
        width: 100%;
        height: auto;
        align-items: right;
    }
</style>
</head>
<body>
<div id="id01">
  <form id = "form1" onsubmit="reorderid();addtotable();checkDuplicates();handleSubmit(event);saveTableDataToConsole();">
    <!--addtotable();checkDuplicates();handleSubmit(event);saveTableDataToConsole();-->
    <h3>Generate Purchase Order:</h3>
    <label for="pONum"><b>PO No:</label>
    <input type = "text" id = "pONum" name = "pONum" size = "7" value="<?php echo $PONum; ?>" required disabled><br><br>
    <label for="pDate"><b>Purchase Date:</label>
    <input type = "date" id = "pDate" name = "pDate" size="0" value="" required onchange="disable('pDate')">
    <label for="PSname"><b>Supplier: *</label>
    <select name= = "PSname" id = "PSname" onchange="getcommoditylist();updateval();setformstate();">
    <option value="">Select</option>
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
    <select name="PCname" id="PCname" onchange = "updateval();">
    <option value="">Select</option>
    </select>
    <label for="PGSM"><b>GSM: *</label>
    <input type = "text" id = "PGSM" name = "PGSM" required size="5" disabled>
    <label for="PBF"><b>BF: *</label>
    <input type = "text" id = "PBF" name = "PBF" required size="5" disabled>
    <label for="PRS"><b>RS(Cm): *</label>
    <input type = "text" id = "PRS" name = "PRS" required size="5" disabled><br><br>
    <label for="PRN"><b>No. Of Reels: *</label>
    <input type = "number" id = "PRN" name = "PRN" required min = "1" step="1">
    <label for="PRW"><b>Weight (Kg) : *</label>
    <input type = "number" id = "PRW" name = "PRW" required min = "1" step=".01" onchange = "calculatetotal()">
    <label for="PRate"><b>RatePerKg(Rs.):</label>
    <input type = "number" id = "PRate" name = "PRate" min = "0.01" step=".01" onchange = "calculatetotal()">
    <label for="PDis"><b>Discount%:</label>
    <input type = "number" id = "PDis" name = "PDis" step=".01" value = "0" onchange = "calculatetotal()">
    <label for="PTotal"><b>Amount(Rs.):</label>
    <input type = "number" id = "PTotal" name = "PTotal" min = "0.01" step=".01" disabled><br><br>
    <label for="PDdate1"><b>Delivery Date from:</label>
    <input type = "date" id = "PDdate1" name = "PDdate1" size="0" value="<?php echo date('Y-m-d'); ?>" required>
    <label for="PDdate2"><b>Delivery Date to:</label>
    <input type = "date" id = "PDdate2" name = "PDdate2" size="0" value="<?php echo date('Y-m-d'); ?>" required>
    <input type = "submit" id = "POAdd" name = "POAdd" value = "Add to Table" disabled>
    <br><br>
  </form>
</div>
<div id="id02">
  <form action="#" method="post" id = "form2">
    <input type="hidden" id="tableData" name="tableData">
    <input type="text" id="sName" name="sName" hidden>
    <label for="PSubmit"><b>Verify the below table and click on Generate PO :</label>
    <input type = "button" id = "POSubmit" name = "POSubmit" value = "Generate PO" onclick="$('#myTable2').html($('#myTable').html());updateformval();calculateSum();submitFirstForm(event);"><br><br>
    <table id= "myTable">
      <tr>
        <th>S No:</th>
        <th>!</th>
        <th>Particulars</th>
        <th>No. Of Reels</th>
        <th>Rate Per</th> 
        <th>Qnty</th>     
        <th>Rate</th>
        <th>Dis%</th>
        <th>Amount(Rs.)</th>
        <th>Delivery Date From</th>
        <th>Delivery Date To</th>      
    </tr>
    </table>
  </form>
</div>
<div id="id03">
    <form action="#" id="form3">
      <button id = "PExpEx" name = "PExpEx" onclick = "exporttoexcel();handleSubmit(event);">
        <span>Export to</span>
        <img src="/icons/icons8-excel-48.png" alt="excelpng" />
      </button>
    </form>
</div>

<div class="form-popup" id="myForm">
  <form class="form-container" id="form3">
    <input type = "number" id = "id2" name = "id2" hidden>
    <label for="!"><b>!:</label>
    <input type = "text" name= "!" id = "!" disabled><br>
    <label for="PCname2"><b>Commodity/Desc</label>
    <input type = "text" name="PCname2" id="PCname2" disabled><br>
    <label for="PRN2"><b>No. Of Reels: *</label>
    <input type = "number" id = "PRN2" name = "PRN2" required width="4px" min = "5"step="1"><br>
    <label for="PRW2"><b>Weight(Kg) : *</label>
    <input type = "number" id = "PRW2" name = "PRW2" required width="4px" min = "1" step=".01" onchange = "calculatetotal2()" ><br>
    <label for="PRate2"><b>RatePerKg(Rs.):</label>
    <input type = "number" id = "PRate2" name = "PRate2" width="5px" min = "0" step=".01" onchange = "calculatetotal2()"><br>
    <label for="PDis2"><b>Discount%:</label>
    <input type = "number" id = "PDis2" name = "PDis2" step=".01" onchange = "calculatetotal2()"><br>
    <label for="PTotal2"><b>Amount(Rs.):</label>
    <input type = "number" id = "PTotal2" name = "PTotal2" min = "0.01" step=".01" disabled><br>
    <label for="PDdate3"><b>Delivery Date from:</label>
    <input type = "date" id = "PDdate3" name = "PDdate3" size="0" value="<?php echo date('Y-m-d'); ?>" required><br>
    <label for="PDdate4"><b>Delivery Date to:</label>
    <input type = "date" id = "PDdate4" name = "PDdate4" size="0" value="<?php echo date('Y-m-d'); ?>" required><br><br>
    <input type = "button" style="font-size:18px" class = "updatebtn" id = "S2Save2" name = "S2Save2" value = "V" onclick = "edittable('V')">
    <input type = "button" style="font-size:18px" class = "delete" id = "Sdelete2" name = "Sdelete2" value = "Del" onclick = "edittable('Del')">
    <input type = "button" style="font-size:18px" class = "cancel" id = "Scancel2" name = "Scancel2" value = "X" onclick= "closeForm()">
  </form>
</div>
<div id="id04">
  <form action="forms_action_page.php" method="post" id = "form4">
    <img class="image1" src="/Images/Letterhead1.png">
        <div class="form-container2">
            <div class="textbox">
                <input type="text" style="font-size:18px" class="title-box" value = "PURCHASE ORDER" disabled >
            </div>
        </div>
        <div class="form-container2">
            <div class="textbox">
                <input type="text" class="input-box" placeholder="Company Name" value = "<?php echo $datarray[1]; ?>" disabled>
                <input type="text" class="input-box" placeholder="GST" value = "<?php echo $datarray[2]; ?>" disabled>
                <input type="text" class="input-box" placeholder="Address Line 1, City" value = "<?php echo ($datarray[3] .",". $datarray[4]); ?>"" disabled>
                <input type="text" class="input-box" placeholder="State, Pincode" value = "<?php echo ($datarray[5] .",". $datarray[6]); ?>"" disabled>
                <input type="text" class="input-box" placeholder="Phone, Email" value = "<?php echo ($datarray[7] .",". $datarray[8]); ?>"" disabled>
                <input type="text" class="input-box" placeholder="Phone" value = "<?php echo ($datarray[9] . $datarray[10]); ?>"" disabled>
            </div>
            <div class="textbox">
                <input type="text" class="input-box" id = "supName" placeholder="Supplier Name" disabled>
                <input type="text" class="input-box" id = "sAddr" placeholder="Address line 1"disabled>
                <input type="text" class="input-box" id = "sAddr2" placeholder="City, State, Pincode"disabled>
                <input type="text" class="input-box" id = "sCont" placeholder="Mobile, Email"disabled>
                <input type="text" class="input-box" id = "sGST" placeholder="GST"disabled>
                <input type="text" class="input-box" id = "sPAN" placeholder="PAN">
            </div>
        </div>
        <div class="form-container2">
          <div class="textbox" id = "t03">
            <div class="form-group3">
                  <label for="pONumber" class="label">PO No:</label>
                  <input type="text" id ="pONumber" class="input-box"  placeholder="Enter text 1" disabled>
                  <label for="pODate" class="label">PO Date:</label>
                  <input type="text" id ="pODate" class="input-box"  placeholder="Enter text 1" disabled>
                </div>
            <div class="form-group3">
                  <label for="CtPerson" class="label">Contact Person:</label>
                  <input type="text" id ="CtPerson" class="input-box"  placeholder="Enter text 1">
                  <label for="PONumber" class="label"></label>
                  <input type="text" id ="PONumber" class="input-box"  placeholder="">
            </div>
            <div class="form-group3">
                  <label for="CtMethod" class="label">Contact Method:</label>
                  <input type="text" id ="CtMethod" class="input-box"  placeholder="Enter text 1">
                  <label for="PONumber" class="label"></label>
                  <input type="text" id ="PONumber" class="input-box"  placeholder="">
             </div>
             <div class="form-group3">
                  <label for="Dto" class="label">Dispatch to:</label>
                  <input type="text" id ="Dto" class="input-box"  placeholder="Enter text 1">
                  <label for="SContact" class="label">Site Contact:</label>
                  <input type="text" id ="SContact" class="input-box"  placeholder="Enter text 1">
             </div>
             <div class="form-group3">
                  <label for="M" class="label">Mode of Pay:</label>
                  <input type="text" id ="Dto" class="input-box"  value="Cheque">
                  <label for="SContact" class="label">Mobile/Ph:</label>
                  <input type="text" id ="SContact" class="input-box"  placeholder="Enter text 1">
             </div>
         </div>
          <div class="textbox" id = "t04">
              <div class="form-group3">
                  <label for="Scont" class="label">Supplier Contact:</label>
                  <input type="text" id ="Scont" class="input-box"  placeholder="Enter text 1">
                  <input type="text" id ="sp11" class="input-box" disabled>
              </div>
              <div class="form-group3">
                      <label for="SPh" class="label">Mobile/Tel.No:</label>
                      <input type="text" id ="SPh" class="input-box"  placeholder="xxxxxxxxxx">
                      <input type="text" id ="sp11" class="input-box" disabled>
              </div>
              <div class="form-group3">
                      <input type="text" id ="sp11" class="input-box" disabled>
                      <input type="text" id ="sp2" class="input-box" disabled>
              </div>
              <div class="form-group3">
                      <input type="text" id ="sp11" class="input-box" disabled>
                      <input type="text" id ="sp2" class="input-box" disabled>
              </div>
              <div class="form-group3">
                      <input type="text" id ="sp11" class="input-box" style="font-size:18px" disabled>
                      <input type="text" id ="sp2" class="input-box" style="font-size:18px" disabled>
              </div>
              <div class="form-group3">
                      <input type="text" id ="sp11" class="input-box" style="font-size:18px" disabled>
                      <input type="text" id ="sp2" class="input-box" style="font-size:18px" disabled>
              </div>
          </div>
        </div>
    <table id= "myTable2">
      <tr>
        <th>S No:</th>
        <th>!</th>
        <th>Particulars</th>
        <th>No. Of Reels</th>
        <th>Rate Per</th> 
        <th>Qnty</th>     
        <th>Rate</th>
        <th>Dis%</th>
        <th>Amount(Rs.)</th>
        <th>Delivery Date From</th>
        <th>Delivery Date To</th>      
    </tr>
    </table>
            <div class="form-container2">
            <div class="textbox">
                <div class="form-group3">
                  <label for="pOAmtWords" class="label">Amount in words:</label>
                  <input type="text" id ="pOAmtWords" class="input-box"  placeholder="Enter text 1" disabled>
                    <br>
                    <br>
                    <br>
                </div>
              </div>
            <div class="textbox">
                <div class="form-group3">
                  <label for="pOTotal" class="label">Total:</label>
                  <input type="text" id ="pOTotal" class="input-box"  placeholder="Enter text 1" disabled>
                  <label for="pOGTotal" class="label" style="font-size:14px;">Grand Total:</label>
                  <input type="text" id ="pOGTotal" class="input-box" style="font-size:14px;" placeholder="Enter text 1" disabled>
                  <br>
                  <br>
                  <br>
                </div>
              </div>
            </div>
    <div class="form-container2">
        <div class="textbox">
            <div class="form-group4">
                <div>
                  <h3>Terms and Conditions:</h3>
                  <p><b>Invoice to be raised in the name of:</b> <?php echo $datarray[1]; ?></p>
                  <p><b>Terms of Payment :</b> After delivery</p>
                  <p><b>Forwarding charges:</b> Extra</p>
                  <p><b>Declaration:</b> If exceeding the due date, penalty class will be applicable. Applicable GST, If any will be payable by the company in addition to the price quoted above</p>
                  <p><b>Terms of Delivery:</b> CUSTOMER USE</p>
                </div>
            </div>
        </div>
    </div>
    <div class="form-container2">
        <div class="textbox">
            <div class="form-group5">
                  <p>Party Signature</p>
                  <br>
                  <br>
                  <p>Accepted By</p>
            </div>
        </div>
        <div class="textbox">
            <div class="form-group6">
                <p>For <?php echo $datarray[1]; ?></p>
                <div class="image-container">
                    <img class="image2" src="/Images/DigitalSignature.png">
                </div>
                <div>
                                  <br>
                  <br>
                <p>Authorized Signature</p>
                </div>
            </div>
        </div>
    </div>
    <input type = "button" id = "PrintPO" name = "PrintPO" value = "Print PO" onclick = "printPO();emailPO();">
    <input type = "button" id = "Back" name = "Back" value = "Back">
  </form>
</div>
<script>
//document.getElementById("myForm").style.display = "none";
// Get the table element
var table = document.getElementById("myTable");
document.getElementById("form4").style.display = "none";
document.getElementById("id04").style.display = "none";

function printPO() {

}

function emailPO() {

}

function submitFirstForm(event) {
  //event.preventDefault(); // Prevent default form submission
  // You can perform any form validation here before proceeding
  // Assuming validation passes, hide the first form and display the second form
  document.getElementById("id01").style.display = "none";
  document.getElementById("id02").style.display = "none";
  document.getElementById("id03").style.display = "none";
  document.getElementById("myForm").style.display = "none";
  document.getElementById("form4").style.display = "block";
  document.getElementById("id04").style.display = "block";
  }

function updateformval() {
    var suppliername = document.getElementById("PSname").value;
    $.ajax({
        type: 'POST', // Request type (POST in this case)
        url: 'getsupdata.php', // URL of the PHP file to which the request is sent
        data: { suppliername: suppliername }, // Data to be sent along with the request (here, a variable named 'suppliername')
        success: function(response) { // Function to handle successful response from the PHP file
        const str = response.replace("[", "");
        const str1 = str.replace("]", "");
        const str2 = str1.replace(/"/g, "");
        const datarray1 = str2.split(",");
        document.getElementById("supName").value = datarray1[1];
        document.getElementById("sAddr").value = datarray1[3];
        document.getElementById("sAddr2").value = datarray1[4] + "," + datarray1[5] + "," + datarray1[6];
        document.getElementById("sCont").value = datarray1[7] + "," + datarray1[8];
        document.getElementById("sGST").value = datarray1[2];
      }
    });
    document.getElementById("pODate").value = document.getElementById("pDate").value;
    document.getElementById("pONumber").value = document.getElementById("pONum").value;
    const secondTextBox = document.getElementById("t04");
    const firstTextBox = document.getElementById("t03");
    //alert(firstTextBox.offsetHeight);
    //secondTextBox.style.height = (firstTextBox.offsetHeight-22) + "px";
    //firstTextBox.style.height = (firstTextBox.offsetHeight-22) + "px";
    secondTextBox.style.height = 151 + "px";
    firstTextBox.style.height = 151 + "px";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

// Get the table element
  var table = document.getElementById("myTable");
// Attach a click event listener to the table
table.addEventListener("click", function(event) {
    // Check if the clicked element is a table row
    if (event.target.tagName === "TD") {
      document.getElementById("myForm").style.display = "block";
      // Get the data of the clicked row
      var row = event.target.parentNode; // Get the parent row (<tr>)
      var cells = row.getElementsByTagName("td"); // Get all cells (<td>) in the row
      // Extract the data from 
      var id= cells[0].innerText;
      var warning= cells[1].innerText;
      var cname = cells[2].innerText;
      var rn= cells[3].innerText;
      var rw = cells[5].innerText;
      var rate= cells[6].innerText;
      var dis = cells[7].innerText;
      var amt= cells[8].innerText;
      var dt1 = cells[9].innerText;
      var dt2 = cells[10].innerText;
      // Set the values of the form fields
      document.getElementById("id2").value = id;
      document.getElementById("!").value = warning;
      document.getElementById("PCname2").value = cname;
       document.getElementById("PRN2").value = rn;
      document.getElementById("PRW2").value = rw;
      document.getElementById("PRate2").value = rate;
      document.getElementById("PDis2").value = dis;
      document.getElementById("PTotal2").value = amt;
      document.getElementById("PDdate3").value = dt1;
      document.getElementById("PDdate4").value = dt2;
      }
  });


function getcommoditylist() {
  var select = document.getElementById("PCname");
  var numberOfOptions = select.options.length;
  for (let i = 1; i < numberOfOptions; i++) {
  select.remove(1);
    }
  select.selectedIndex = 0;
  //update commodity list
  var supplierstr = document.getElementById("PSname").value;
  var tr = "\"" + supplierstr + "\"";
  for (let i = 1; i < jsArray_2.length; i++) {
    let c = JSON.stringify(jsArray_2[i]);
    let position = c.search(tr);
    let found = (position>0);
    if (found) {
          const myArray = c.split(",");
          let word1 = myArray[1];
          let gsm1 = myArray[3];
          let bf1 = myArray[4];
          let rs1 = myArray[6];
          const myArray2 = word1.split(":");
          let word2 = myArray2[1];
          let word3 = word2. replaceAll("\"", "");
          const myArray3 = gsm1.split(":");
          let gsm2 = myArray3[1];
          const myArray4 = bf1.split(":");
          let bf2 = myArray4[1];
          const myArray5 = rs1.split(":");
          let rs2 = myArray5[1];
          let rs3 = rs2. replaceAll("}", "");
          var option = document.createElement("option");
          option.text = word3 +"-" + "GSM:" + gsm2 + "-" + "BF:" + bf2 + "-" + "RS:" + rs3;
          option.value = i;
          select.appendChild(option);
          document.getElementById("PSname").disabled = true;
      } else {
      select.selectedIndex = 0;
      }
  }
}


function updateval() {
  var button = document.getElementById("POAdd");
  var selectElement = document.getElementById("PCname");
  var val = (selectElement.options[selectElement.selectedIndex].value);
  updated = (val >= 1);
  if (updated){
    button.disabled = false;
    var c = selectElement.options[selectElement.selectedIndex].text;
    const myArray = c.split("-");
    let word1 = myArray[1];
    let word2 = myArray[2];
    let word3 = myArray[3];
    const myArray1 = word1.split(":");
    const myArray2 = word2.split(":");
    const myArray3 = word3.split(":");
    document.getElementById("PGSM").value = myArray1[1];
    document.getElementById("PBF").value = myArray2[1];
    document.getElementById("PRS").value = myArray3[1];
  } else {
    button.disabled = true;
    document.getElementById("PGSM").value = 0;
    document.getElementById("PBF").value = 0;
    document.getElementById("PRS").value = 0;
  }
}

function calculatetotal() {
  disp = document.getElementById("PDis").value;
  rweight = document.getElementById("PRW").value;
  rate = document.getElementById("PRate").value;
  dis = 1- (parseInt(disp)/100);
  total= (rweight * rate) * dis;
  document.getElementById("PTotal").value = parseFloat(total).toFixed(2);
}

function calculatetotal2() {
  disp = document.getElementById("PDis2").value;
  rweight = document.getElementById("PRW2").value;
  rate = document.getElementById("PRate2").value;
  dis = 1- (parseInt(disp)/100);
  total= (rweight * rate) + dis;
  document.getElementById("PTotal2").value = parseFloat(total).toFixed(2);
}


function addtotable() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
  var newRowId = table.rows.length;
  var newRow = table.insertRow(table.rows.length);
  const selectElement = document.getElementById("PCname");
  const selectValue= selectElement.options[selectElement.selectedIndex].text;
  const myArray = [newRowId, "", selectValue, document.getElementById("PRN").value, "KG", document.getElementById("PRW").value, document.getElementById("PRate").value, document.getElementById("PDis").value, document.getElementById("PTotal").value, document.getElementById("PDdate1").value, document.getElementById("PDdate2").value];
        for (let i = 0; i < myArray.length; i++) {
        var cell = newRow.insertCell(i);
        cell.innerHTML = myArray[i];
         }
  document.getElementById("POSubmit").disabled = false;
}

function edittable(buttonText) {
var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
const rowIndex = (document.getElementById("id2").value);
var row = table.rows[rowIndex];
var cells = row.getElementsByTagName("td");
var edit = (buttonText == "V");
var ddel = (buttonText == "Del");
if (edit) {
  const myArray = [rowIndex, "", document.getElementById("PCname2").value, document.getElementById("PRN2").value, "KG", document.getElementById("PRW2").value, document.getElementById("PRate2").value, document.getElementById("PDis2").value, document.getElementById("PTotal2").value, document.getElementById("PDdate3").value, document.getElementById("PDdate4").value];
        for (let i = 0; i < myArray.length; i++) {
        cells[i].innerHTML = myArray[i];
         }
         }else { if (ddel) {
                   table.deleteRow(rowIndex);
                }
}
checkDuplicates();
closeForm();
}

function reorderid() {
  var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];
  var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) {
      var cells = rows[i].getElementsByTagName("td");
      cells[0].innerText = i;
    }
}

function handleSubmit(event) {
  event.preventDefault(); // Prevent default form submission behavior
  const inputField = document.getElementById('inputField');
  console.log("Input value:", inputField.value);
  // Further processing or form submission logic can go here
    }

function disable(name) {
document.getElementById(name).disabled = true;
    }
function exporttoexcel() {
javascript:void(window.open('data:application/vnd.ms-excel,' + encodeURIComponent(document.getElementById('myTable').outerHTML)));
}


function checkDuplicates() {
  var table = document.getElementById("myTable");
  var seen = {};
  var duplicates = [];
  var er = table.rows.length;
   if (er <= 4) { 
     var sr = 0;
       } else {
         sr = er-4;
               }
  // Iterate over each row of the table (starting from index 1 to skip header row)
    for (let i =sr; i < er; i++) {
      var currentRow = table.rows[i];
      var key = currentRow.cells[3].innerText; // Assuming the first cell contains the value to check for duplicates
      // Check if the value is already seen
        if (seen[key]) {
                duplicates.push(key);
                currentRow.cells[1].innerText = "!!Duplicate Entry!!";
        } else {
                seen[key] = true;
        }
      }

    // Display the duplicate values, if any
    if (duplicates.length > 0 && duplicates.length < 3) {
          alert("Duplicate entries found: " + duplicates.join(", "));
        } else { if (duplicates.length <= 0) {
            //alert("No duplicate entries found.");
        } else {
        var currentRow = table.rows[table.rows.length-1];
        currentRow.parentNode.removeChild(currentRow);
        alert("Number of repeated records exceeded.");
        }
            
    }
}

window.addEventListener('beforeunload', function(event) {
  // Cancel the event
  event.preventDefault();
  // Chrome requires returnValue to be set
  event.returnValue = '';
  // Alert the user
  alert("Are you sure you want to leave this page?");
});

document.getElementById('form2').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    var table = document.getElementById('myTable');
    var tableData = [];
    // Loop through table rows
    for (var i = 0; i < table.rows.length; i++) {
        var rowData = [];
        var row = table.rows[i];
        // Loop through table cells
        for (var j = 0; j < row.cells.length; j++) {
            var cell = row.cells[j];
            rowData.push(cell.innerText);
        }

        tableData.push(rowData);
    }

    // Set the table data as a JSON string in the hidden input field
    document.getElementById('tableData').value = JSON.stringify(tableData);
    // Submit the form
    this.submit();
});
function calculateSum() {
            var table = document.getElementById('myTable2');
            var sum = 0;

            // Loop through each row in the table
            for (var i = 1; i < table.rows.length; i++) {
                // Parse the numeric value from the cell and add it to the sum
                sum += parseFloat(table.rows[i].cells[8].innerHTML);
            }

            // Display the sum in the input box
            document.getElementById('pOTotal').value = sum;
            document.getElementById('pOGTotal').value = sum;
            var sumInWords = toWords(sum);
            document.getElementById('pOAmtWords').value = sumInWords;
        }
var th = ['','thousand','million', 'billion','trillion'];
var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine'];
 var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen'];
 var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];
 
function toWords(s) {
    s = s.toString();
    s = s.replace(/[\, ]/g,'');
    if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');
    if (x == -1)
        x = s.length;
    if (x > 15)
        return 'too big';
    var n = s.split(''); 
    var str = '';
    var sk = 0;
    for (var i=0;   i < x;  i++) {
        if ((x-i)%3==2) { 
            if (n[i] == '1') {
                str += tn[Number(n[i+1])] + ' ';
                i++;
                sk=1;
            } else if (n[i]!=0) {
                str += tw[n[i]-2] + ' ';
                sk=1;
            }
        } else if (n[i]!=0) { // 0235
            str += dg[n[i]] +' ';
            if ((x-i)%3==0) str += 'hundred ';
            sk=1;
        }
        if ((x-i)%3==1) {
            if (sk)
                str += th[(x-i-1)/3] + ' ';
            sk=0;
        }
    }
    
    if (x != s.length) {
        var y = s.length;
        str += 'point ';
        for (var i=x+1; i<y; i++)
            str += dg[n[i]] +' ';
    }
    return str.replace(/\s+/g,' ');
    alert(str);
}
</script>

</body>
</html>

