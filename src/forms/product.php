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
  width: 100%;
  border: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
  font-size: 15px;
  font-weight: bold;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  position: relative;
  overflow: hidden; /* Optional: hides content that overflows the cell */
  white-space: nowrap;
}
tr, td {
  text-align: left;
  padding: 16px;
  font-size: 15px;
  font-weight: normal;
  border-bottom: 1px solid #ddd;
  border-right: 1px solid #ddd;
  width: auto;
}
tr:nth-child(even) {
  background-color: rgb(255, 208, 162);
}

/* Hide the fifth column by default */
  th:nth-child(9),
  td:nth-child(9) {
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
            <th>Product ID
            <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('idFilter')"></i><br>
            <input type="text" id="idFilter" class="filter-input" placeholder="Filter by name">
            </th>
            <th>Customer Name
            <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('nameFilter')"></i><br>
            <input type="text" id="nameFilter" class="filter-input" placeholder="Filter by name">
            </th> 
            <th>Description</th>
            <th>Spec
            <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('specFilter')"></i><br>
            <input type="text" id="specFilter" class="filter-input" placeholder="Filter by name">
            </th>    
            <th>GSM
            <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('gsmFilter')"></i><br>
            <input type="text" id="gsmFilter" class="filter-input" placeholder="Filter by name">
            </th>    
            <th>Size
            <i class="fa fa-search" style="font-size:14px;color:grey" onclick="toggleFilter('sizeFilter')"></i><br>
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
              echo "<td><span class=\"fa fa-minus-circle\" style=\"font-size:14px;color:grey\" onclick=\"deleteRow(this)\"></span></td>";
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