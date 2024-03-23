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
<p>Purchase Orders : Please feed the below details to the MES System and generate an automated PO.</p>
<label for="Cname"><b>Commodity Name: *</label>
<select name="Cname" id="Cname">

</select>
<label for="Sname"><b>Supplier Name: *</label>
<input type = "text" id = "Sname" name = "Sname" required size="15" disabled>
<label for="GSM"><b>GSM: *</label>
<input type = "text" id = "GSM" name = "GSM" required size="5" disabled><br><br>
<label for="BF"><b>BF: *</label>
<input type = "text" id = "BF" name = "BF" required size="5" disabled>
<label for="Size"><b>Size(m):*</label>
<input type = "number" id = "Size" name = "Size" required width="5px" min = "0" max= "10000">
<label for="Weight"><b>Weight(kg): *</label>
<input type = "number" id = "Weight" name = "Weight" required width="5px" min = "0" max= "10000">
<label for="NReels"><b>No. of Reels: *</label>
<input type = "number" id = "NReels" name = "NReels" required width="5px" min = "0" max= "10000">
<input type = "submit" id = "GeneratePO" name = "GeneratePO" value = "GeneratePO">
<br><br>
<table>
  <tr>    
    <th>PO No.</th>    
    <th>Date</th>    
    <th>Commodity ID</th>    
    <th>Size(m)</th>    
    <th>Weight(kg)</th>    
    <th>No. of Reels</th>  
  </tr>

</table>
</form>