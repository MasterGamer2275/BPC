<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stock Statistics:</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: auto;
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
  white-space: wrap; /* Corrected value to wrap text */
}

th input[type=text]{
width: 100%;
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

table tr td:nth-child(2),
table tr th:nth-child(2) {
    width: 70px; /* Set your desired width */
}
table tr td:nth-child(4),
table tr th:nth-child(4) {
    width: 385px; /* Set your desired width */
}
table tr td:nth-child(5),
table tr th:nth-child(5) {
    width: 110px; /* Set your desired width */
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
  .filter-icon {
    color: #555555;
    cursor: pointer;
    margin-left: 4px;
  }
</style>
<body onload="enforceDateFormat()">
  <h2>Filter Stock by Date</h2>
  <label for="fromDate">From:</label>
  <input type="date" id="fromDate" name="fromDate">
  <label for="toDate">To:</label>
  <input type="date" id="toDate" name="toDate">
  <input type="number" id="repnum" name="repnum" value = "1" style = "display: none">
  <button id="filterBtn">Filter</button>

  <table id="myTable">

    <!-- Table body will be populated dynamically -->

  </table>

  <script src="script.js"></script>

</body>
</html>