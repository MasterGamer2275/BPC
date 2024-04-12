<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sample Dashboard Boxes</title>
</head>
<style>
body {
    //font-family: Arial, Helvetica, sans-serif;
    font-family: "Trebuchet MS", sans-serif;
    margin: 0;
    padding: 0;
}
.dashboard {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
}
.box {
    background-color: #f0f0f0;
    border-radius: 5px;
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
    padding: 20px;
    flex: 1 1 300px; /* Adjust the width of boxes as needed */
}
.box h2 {
    margin-top: 0;
    font-size : 18px;
    position: relative;
    left: 30%;
    top: 0%;
}

.box p {
    margin-bottom: 0;
    font-size : 15px;
    font-weight: normal;
    position: relative;
    left: 30%;
    top: 0%;
}

.box img {
    position: relative;
    top: -20%;
    left: 10%;
    transform: translate(-50%, -50%);
    z-index: 1;
    /* You can adjust the size of the overlay image */
    width: 100px; /* Adjust width as needed */
    height: 100px; /* Adjust height as needed */
    /* You can add additional styles for the overlay image */
}
</style>

<body>
<h3>👋 Welcome User!<h3>
    <div class="dashboard">
        <div class="box">
            <h2>Items Low in Stock:</h2>
            <p>SDLX GSM 60 30%</p>
            <p>KY GSM 80 20%</p>
            <img src = "/Images/inventory.png" alt = "stock">
        </div>
        <div class="box">
            <h2 style="left:0%;">Dispatch Status:</h2>
            <p style="left:0%;">Job _____ done on 8/10</p>
        </div>
        <div class="box">
            <h2 style="left:0%;">Recent Activity:</h2>
            <p style="left:0%;">PO no:6184 sent through whats app to supplier BlueMount 03/24/2024</p>
            <p style="left:0%;">Order No: 4567 received from customer Chennai Silks</p>
        </div>
    </div>
        <div class="dashboard">
        <div class="box">
        </div>
    </div>
</div>
</body>
</html>