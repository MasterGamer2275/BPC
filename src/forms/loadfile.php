<label for="tablename"><b>Tablename:</label>
    <select name="tablename" id="tablename">
        <option value="0">commodity</option>
        <option value="1">stock</option>
        <option value="2">product</option>
    </select>

<input type="file" id="fileInput" />
<div id="output"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<script>
document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(event) {
        const data = event.target.result;
        const workbook = XLSX.read(data, { type: 'binary' });
        const sheetName = workbook.SheetNames[0];
        const sheet = workbook.Sheets[sheetName];
        const table = XLSX.utils.sheet_to_json(sheet, { header: 1 });

        // Display the table data
        const outputDiv = document.getElementById('output');
        outputDiv.innerText = JSON.stringify(table);
    };

    reader.readAsBinaryString(file);
});

</script>