<?php
  //---define all variables and constants used
  //---read a table
  //find the root path to calling the php filles by path
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
  $dbtabdata = array(array());
  dbreadtableproduct($db, $tablename, $dbtabdata, $text);
  dbclose($db, $text);
  // Convert the array of objects to a JSON array
  $jsonArray_1 = json_encode($dbcolvalues);
    // Echo the JSON array
  echo '<script>';
  echo 'var jsArray_1 = ' . $jsonArray_1 . ';';
  echo 'console.log(jsArray_1);'; // Output the array in the browser console
  echo '</script>';
?>  
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: "Source Sans Pro", "sans-serif";
  //font-family: "Trebuchet MS", sans-serif;
}
label {
  /* Your general styles for labels */
  font-size: 16px;
  color: #333;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: auto; /* Let the browser calculate the width */
  min-width: 100px; /* Set a minimum width to ensure readability */
  max-width: none; /* Allow the width to expand beyond the content */
  border: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}
table tr td:nth-child(1),
table tr th:nth-child(1) {
    width: 20px; /* Set your desired width */
}
table tr td:nth-child(2),
table tr th:nth-child(2) {
    width: 300px; /* Set your desired width */
}
table tr td:nth-child(3),
table tr th:nth-child(3) {
    width: 300px; /* Set your desired width */
}
table tr td:nth-child(4),
table tr th:nth-child(4) {
    width: 115px; /* Set your desired width */
}
table tr td:nth-child(5),
table tr th:nth-child(5) {
    width: 40px; /* Set your desired width */
}
table tr td:nth-child(6),
table tr th:nth-child(6) {
    width: 50px; /* Set your desired width */
}
table tr td:nth-child(8),
table tr th:nth-child(8) {
    width: 30px; /* Set your desired width */
}
th, td {
  text-align: left;
  padding: 8px;
  font-size: 15px;
  font-weight: bold;
  width: calc(100% + 10px); /* Adjust the 10px value as needed */
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  position: relative;
  overflow: hidden; /* Optional: hides content that overflows the cell */
  white-space: wrap;
}

th input[type=text] {
width: 40%;

}
tr, td {
  text-align: left;
  padding: 1px;
  font-size: 15px;
  font-weight: normal;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  width: auto;
}
tr:nth-child(even) {
  background-color: rgb(255, 208, 162);
}

  th:nth-child(7),
  td:nth-child(7) {
  display: none;
}
  th:nth-child(8),
  td:nth-child(8) {
  //display: none;
}
  th:nth-child(9),
  td:nth-child(9) {
  display: none;
}
  th:nth-child(10),
  td:nth-child(10) {
  display: none;
}
  th:nth-child(11),
  td:nth-child(11) {
  display: none;
}
  th:nth-child(12),
  td:nth-child(12) {
  display: none;
}
  th:nth-child(13),
  td:nth-child(13) {
  display: none;
}

  th:nth-child(14),
  td:nth-child(14) {
  display: none;
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

select {
width: 25%;
/* width: 120px;*/
height: 20px;
}

  .delete-icon {
    cursor: pointer;
    color: grey;
    font-weight: bold;
    font-size: 20px;
  }

  .filter-icon {
    color: #555555;
    cursor: pointer;
    margin-left: 4px;
  }
  .longtext input[type=text] {
  -moz-appearance: textfield;
  width: 25%;
}
input[type=number], input[type=text] {
  -moz-appearance: textfield;
  width: 5%;
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
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  max-width: 300px;
  width: auto;
  top: 0;
  right: 5px;
  height: auto;
  border: 3px solid #f1f1f1;
  z-index: 9;
  color: black;
}
/* Add styles to the form container */
.form-container {
  max-width: 500px;
  width: 300px;
  padding: 10px;
  background-color: white;
  font: inherit;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password], .form-container input[type=email], .form-container input[type=date]{
  width: 90%;
  height: 0px;
  padding: 12px;
  margin: 5px 0 2px 0;
  border: none;
  font-family: "Source Sans Pro", "sans-serif";
  font-size: 16px;
  background: #f2f2f2;
}
label {
  /* Your general styles for labels */
  font-size: 16px;
  color: #333;
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
</style>
<body>
    <form action="forms_action_page.php" method="post" id = "Form">
    <h3>Create/Add Client Master:</h3>
    <label for="pCus"><b>Customer Name: *</label>
    <select name="pCus" id="pCus">
       <option value='0'>Select</option>
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
    <input type = "text" class = "longtext" id = "pDes" name = "pDes" required size="40" placeholder = "Brown Cover GY">
    <label for="pSpec"><b>Spec/ReelSize: *</label>
    <input type = "text" id = "pSpec" name = "pSpec" required size="15"><br><br>
    <div class = "sizeclass">
      <label for="pGSM"><b>GSM: *</label>
      <input type = "number" id = "pGSM" name = "pGSM" required min = "10" step = "0.01">
      <label for="pSize1"><b>Size: *</label>
      <input type = "text" id = "pSize1" name = "pSize1" required size="5" maxlength = "5" min = "1" step = "1">x
      <input type = "text" id = "pSize2" name = "pSize2" required size="5" maxlength = "5" min = "1" step = "1">x
      <input type = "text" id = "pSize3" name = "pSize3" size="5" maxlength = "5" min = "1" step = "1">
      <label for="pUnit" style = "display:none"><b>Unit: *</label>
      <input type = "text" id = "pUnit" name = "pUnit" required size="5" placeholder = "cm" value = "cm" style = "display:none">
      <label for="pRate"><b>Rate(Rs.):*</label>
      <input type = "number" id = "pRate" name = "pRate" required min = "0.01" step = "0.01" class = "number">
      <input type = "submit" id = "PAdd" name = "PAdd" value = "Add Record"></div>
    </div><br><br>

    <table id = "myTable">
      <tr>    
            <th>Product ID</th>
            <th>Customer Name<br>
            <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('nameFilter')"></i>
            <input type="text" id="nameFilter" class="filter-input" placeholder="Filter by name">
            </th> 
            <th>Description</th>
            <th>Spec<br>
            <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('specFilter')"></i>
            <input type="text" id="specFilter" class="filter-input" placeholder="Filter by name">
            </th>    
            <th>GSM<br>
            <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('gsmFilter')"></i>
            <input type="text" id="gsmFilter" class="filter-input" placeholder="Filter by name">
            </th>    
            <th>Size<br>
            <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('sizeFilter')"></i>
            <input type="text" id="sizeFilter" class="filter-input" placeholder="Filter by name">
            </th>   
            <th>Unit</th> 
            <th>Rate(Rs.)</th>  
            <th>CompanyID</th>
      </tr>
  <?php
  // Loop through the array to generate table rows
  $i=0;
  foreach ($dbtabdata as $row) {
      echo "<tr>";
      foreach ($row as $cell) {
                echo "<td>$cell</td>";
              }
           if ($i) {
              //echo "<td><span class=\"fa fa-minus-circle\" style=\"font-size:14px;color:grey\" onclick=\"deleteRow(this)\"></span></td>";
           }
           $i = $i+1;
      echo "</tr>";
  }
  ?>
    </table>
    </form>
  	<div class="form-popup" id="myForm">
  <form action="#" class="form-container" method="post">
   <input type = "number" id = "pID" name = "pID" maxlength = "6" size = "6" hidden>
   <input type = "number" id = "rID" name = "rID" maxlength = "6" size = "6" hidden>
      <input type = "button" style="font-size:18px" class = "updatebtn" id = "p2Save" name = "p2Save" value = "V" onclick = "editRow()"></button>
   <input type = "button" style="font-size:18px" class = "delete" id = "pdelete" name = "pdelete" value = "Del" onclick = "deleteRow()">
   <input type = "button" style="font-size:18px" class = "cancel" id = "pcancel" name = "pcancel" value = "X" onclick= "closeForm()"><br>
   <label for="cName2"><b>Customer Name: * &nbsp;</label>
       <select name="cName2" id="cName2">
       <option value='0'>Select</option>
       <?php
      // Loop through the array to generate list items
      foreach ($dbcolvalues as $row) {
          foreach ($row as $value) {
      echo "<option value='$value'>$value</option>";
          }
      }
      ?>
	   </select><br>
   <input type= "hidden" id = "Sname2" name = "Sname2" required size="75" disabled>
   <label for="pDes2"><b>Description: *</label>
   <input type = "text" id = "pDes2" name = "pDes2" required><br>
   <label for="pSpec2"><b>Spec: *</label>
   <input type = "text" id = "pSpec2" name = "pSpec2"><br>
   <label for="pGSM2"><b>GSM: *</label>
   <input type = "text" id = "pGSM2" name = "pGSM2"><br>
   <label for="pSizet2"><b>Size: *</label>
   <input type = "text" id = "pSizet2" name = "pSizet2"><br>
   <label for="pRate2"><b>Rate(Rs.):*</label>
   <input type = "text" id = "pRate2" name = "pRate2">
  </form>
</div>
</body>
<script>
// Get the table element
  var table = document.getElementById("myTable");

  // Attach a click event listener to the table
  table.addEventListener("click", function(event) {
    // Check if the clicked element is a table row
    if (event.target.tagName === "TD") {
      document.getElementById("myForm").style.display = "block";
      // Get the data of the clicked row
      var row = event.target.parentNode; // Get the parent row (<tr>)
      var rowIndex = row.rowIndex;
      var cells = row.getElementsByTagName("td"); // Get all cells (<td>) in the row
      // Extract the data from cells
      var name = cells[1].innerText;
      var cselect = document.getElementById("cName2");
      var cindex = -1;
      var coptions = cselect.options;
      for (var i = 0; i < coptions.length; i++) {
          let sstr = coptions[i].text;
          let sposition = sstr.search(name);
          let srfound = (sposition !== -1); // Check if sname is found in sstr
          if (srfound) {
              cindex = i; // Assign the index to the outer sindex variable
              break;
          }
      }
      document.getElementById("cName2").selectedIndex = cindex;
      var id = cells[0].innerText;   
      var desc = cells[2].innerText;
	    var spec = cells[3].innerText;
      var gsm = cells[4].innerText;
      var size = cells[5].innerText;
      var rate = cells[7].innerText;
      document.getElementById("pID").value = id;
      document.getElementById("rID").value = rowIndex;
	    //document.getElementById("cName2").value = name;
      document.getElementById("pDes2").value = desc;
      document.getElementById("pSpec2").value = spec;
      document.getElementById("pGSM2").value = gsm;
      document.getElementById("pSizet2").value = size;
      document.getElementById("pRate2").value = rate;      
    }
  });
function toggleFilter(inputId) {
        var input = document.getElementById(inputId);
        input.classList.toggle("active");
        if (input.classList.contains("active")) {
            input.focus();
        } else {
            input.value = "";
            filterTable();
        }
    }

function filterTable() {
        var filterInputs = document.getElementsByClassName("filter-input");
        var table = document.getElementById("myTable");
        var tr = table.getElementsByTagName("tr");

        // Loop through all rows
        for (var i = 0; i < tr.length; i++) {
            var row = tr[i];
            var display = true;

            // Loop through all filter inputs
            for (var j = 0; j < filterInputs.length; j++) {
                var filterInput = filterInputs[j];
                var columnIndex = filterInput.parentElement.cellIndex;
                var filterValue = filterInput.value.toUpperCase();
                var cell = row.getElementsByTagName("td")[columnIndex];
                if (cell) {
                    var cellValue = cell.textContent || cell.innerText;
                    if (cellValue.toUpperCase().indexOf(filterValue) === -1) {
                        display = false;
                        break;
                    }
                }
            }

            // Set display style for row
            if (display) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        }
    }

    // Attach input event listeners to filter inputs
    var filterInputs = document.getElementsByClassName("filter-input");
    for (var i = 0; i < filterInputs.length; i++) {
        filterInputs[i].addEventListener("input", filterTable);
    }

function editRow() {
	  var table = document.getElementById("myTable");
	  var rowId = document.getElementById("rID").value;
    var row = table.rows[rowId];
    var cell = row.cells[0]; // Assuming you want to access the second column (0-based index)
    var id = cell.innerText;
    var tablename = "PRODUCT_TABLE";
	  var edit = "true";
    var id = document.getElementById("pID").value;
    var name = document.getElementById("cName2").value;
    var desc = document.getElementById("pDes2").value;
      var spec = document.getElementById("pSpec2").value;
      var gsm = document.getElementById("pGSM2").value;
      var size = document.getElementById("pSizet2").value;
      var rate = document.getElementById("pRate2").value;    
	    var tabdata1 = [id, name, desc, spec, gsm, size, rate];
        let tabdata = tabdata1.join(',');
      $.ajax({
        type: 'POST', // Request type (POST in this case)
        enctype: 'multipart/form-data',
        url: 'edit-table-rowdata.php', // URL of the PHP file to which the request is sent
        data: { 
              id: id, 
              tablename: tablename,
			        edit: edit,
			        tabdata: tabdata 
          },
          success: function(response) {
              // Request was successful, handle response here
              alert(response);
              location.reload();
          },
          error: function(xhr, status, error) {
              // Request failed, handle error here
              alert('Request failed with status:', error, status);
          }
    
    });
    
}
function deleteRow(rowId) {
	  var table = document.getElementById("myTable");
	  rowId = document.getElementById("rID").value;
    var row = table.rows[rowId];
    var cell = row.cells[0]; // Assuming you want to access the second column (0-based index)
    var id = cell.innerText;
    var tablename = "PRODUCT_TABLE";
	  var edit = "false";
	  var tabdata = [];
      $.ajax({
        type: 'POST', // Request type (POST in this case)
        url: 'edit-table-rowdata.php', // URL of the PHP file to which the request is sent
        data: { 
              id: id,
              tablename: tablename,
			        edit: edit,
			        tabdata: tabdata 
          },
          success: function(response) {
              // Request was successful, handle response here
              alert(response);
          },
          error: function(xhr, status, error) {
              // Request failed, handle error here
              alert('Request failed with status:', error, status);
          }
    
    });
    location.reload();
}

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
</script>
</html>