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
  dbreadtable($db, $tablename, $dbtabdata, $text);
  dbclose($db, $text);
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
    width: 105px; /* Set your desired width */
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
</style>
<body>
    <form action="forms_action_page.php" method="post" id = "myForm">
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
    <input type = "text" id = "pDes" name = "pDes" required size="15" placeholder = "Brown Cover GY">
    <label for="pSpec"><b>Spec: *</label>
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
</body>
<script>
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

function deleteRow(rowId) {
    var table = document.getElementById("myTable");
    var rowIndex = rowId.parentNode.parentNode.rowIndex;
    var row = table.rows[rowIndex];
    var cell = row.cells[0]; // Assuming you want to access the second column (0-based index)
    var id = cell.innerText;
    var tablename = "product";
      $.ajax({
        type: 'POST', // Request type (POST in this case)
        url: 'del-table-rowdata.php', // URL of the PHP file to which the request is sent
        data: { 
              id: id, 
              tablename: tablename 
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
</script>
</html>