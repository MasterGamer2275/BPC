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
<h3>Stock Statistics</h3>
<label for="Fdate"><b>Filter By Date</label>
<input type = "date" id = "Fdate" name = "Fdate"  size="0">
<br><br>
<table>
  <tr>
      <th>Date</th>    
      <th>Commodity</th>   
      <th>GSM</th>    
      <th>Reel Size (m)</th>    
      <th>Reel No.</th>    
      <th>Total Weight (kg)</th>    
      <th>Current Price (Rs.)</th>    
      <th>Avg. Price (Rs.)</th>    
      <th>SGST (%)</th>    
      <th>CGST (%)</th>    
      <th>Total (Rs.)</th>
  </tr>
</table>
</form>