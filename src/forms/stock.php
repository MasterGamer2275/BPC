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
  background-color: #f2f2f2
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
</style>

<form action="/forms_action_page.php" method="post">
<p>Stock Feed : Please feed the received raw material quantities in to the MES System.</p>
<label for="Pdate"><b>Purchase Date:</label>
<input type = "date" id = "Pdate" name = "Pdate""  size="0">
<label for="Cname"><b>Commodity</label>
<select name="Cname" id="Cname">

</select>
<label for="Sname"><b>Supplier: *</label>
<input type = "text" id = "Sname" name = "Sname" required size="15" disabled>
<label for="GSM"><b>GSM: *</label>
<input type = "text" id = "GSM" name = "GSM" required size="5" disabled>
<label for="BF"><b>BF: *</label>
<input type = "text" id = "BF" name = "BF" required disabled size="5"><br><br>
<label for="RW"><b>Reel Weight (Kg) : *</label>
<input type = "number" id = "RW" name = "RW" required width="4px" min = "10" max= "500" step=".01">
<br><br>
<label for="RN"><b>Reel Number :*</label>
<input type = "number" id = "RN" name = "RN" required width="4px" min = "5" max= "1000" step=".01">
<br><br>
<label for="RS"><b>Reel Size (m): *</label>
<input type = "number" id = "RS" name = "RS" required width="5px" min = "0" max= "1000" step=".01">
<br><br>
<label for="Rate"><b>Rate(Rs.): *</label>
<input type = "number" id = "Rate" name = "Rate" required width="5px" min = "0" max= "200" step=".01"><br><br>
<label for="SGST"><b>SGST(%): *</label>
<input type = "number" id = "SGST" name = "SGST" required width="2px" min = "0" max= "15" value = "6" step=".01">
<br><br>
<label for="CGST"><b>CGST(%): *</label>
<input type = "number" id = "CGST" name = "CGST" required width="2px" min = "0" max= "15" value = "6" step=".01">
<br><br>
<label for="Total"><b>Total(Rs.): *</label>
<input type = "number" id = "Total" name = "Total" required width="15px" min = "500" max= "100000" disabled step=".01">
<input type = "submit" id = "StAdd" name = "StAdd" value = "Add"><br><br><table>
<label for="Fdate"><b>Filter - From:</label>
<input type = "date" id = "Fdate1" name = "Fdate1"  size="0">
<label for="Fdate"><b>To:</label>
<input type = "date" id = "Fdate2" name = "Fdate2"  size="0">
<input type = "submit" id = "Export" name = "Export" value = "Export"><br><br>
<table>
  <tr>
      <th>Stock ID</th>
      <th>Date</th>
      <th>Commodity</th>    
      <th>Reel Weight (Kg)</th>    
      <th>Reel Number</th>    
      <th>Reel Size (m)</th>    
      <th>Rate (Rs.)</th>    
      <th>SGST(%)</th>    
      <th>CGST(%)</th>    
      <th>Total(Rs.)</th>  
  </tr>
</table>
</form>