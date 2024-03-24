<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sample Dashboard Boxes</title>
</head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
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
        <h2 style="left:0%;">Home Page</h2>
        <h2 style="left:0%;">What is an MES?</h2>
        <p style="left:0%;">A manufacturing execution system (MES) is a software-based solution used in manufacturing to monitor and control production processes on the shop floor.</p>
        <p style="left:0%;">An MES is a software-based solution used in manufacturing to monitor and control production processes on the shop floor. In manufacturing operations management, an MES serves as a bridge between the planning and control systems of an enterprise, such as an enterprise resource planning (ERP) system, and the actual manufacturing operations.</p>
        <p style="left:0%;">The primary purpose of an MES is to track and document the transformation of raw materials into finished products in real time. It captures data from various sources, including machines, sensors and operators, to provide accurate and up-to-date information about the status of production activities.</p>
        <p style="left:0%;">An MES provides real-time visibility and control over production processes, enabling stakeholders to monitor operations, identify bottlenecks, minimize downtime and make informed decisions promptly. By facilitating optimized production planning and scheduling, MES systems ensure efficient resource allocation, workload balancing and on-time deliveries, leading to higher profitability.</p>
        <p style="left:0%;">They also play a critical role in quality assurance and compliance by enforcing quality control procedures, monitoring metrics and capturing real-time data. With their ability to manage inventory levels, track material movements and help ensure timely availability of materials, MES systems optimize inventory management and minimize production delays.</p>
        <p style="left:0%;">Moreover, MES systems enable data-driven decision-making by providing comprehensive and accurate production data, empowering organizations to continuously improve processes and optimize resource usage. MES systems can help decision-makers ascertain overall equipment effectiveness (OEE), a broad metric used to monitor manufacturing effectiveness.</p>
        <p style="left:0%;">By streamlining workflows, automating tasks and providing real-time feedback, MES systems enhance plant floor efficiency and productivity. Also, these management systems enable traceability and genealogy, crucial for industries with strict regulations, by tracking the movement of materials and processes throughout the smart manufacturing lifecycle.</p>
        <p style="left:0%;">Guide</p>
        <p style="left:0%;">Delve into our exclusive guide to the EU's CSRD
        With ESG disclosures starting as early as 2025 for some companies, make sure that you’re prepared with our guide.</p>
        <p style="left:0%;">Related content
        Register for the ebook on GHG emissions accounting</p>
        <h2 style="left:0%;">How it works</h2>
        <h3 style="left:0%;">A MES software system captures real-time data from various sources on the factory floor and uses that information to monitor and control manufacturing operations. Here is a general overview of the process:</h3>
        <p style="left:0%;">Data collection: The system collects data from multiple sources, including machines, sensors, operators and other information systems such as ERP systems or product lifecycle management (PLM) systems. This data can include production rates, machine statuses, inventory levels, quality measurements and more.</p>
        <p style="left:0%;">Data integration: The collected data is processed and integrated within the MES system, creating a comprehensive view of the manufacturing environment. This integration helps ensure that the MES has accurate and up-to-date information to work with.</p>
        <p style="left:0%;">Production scheduling: Based on the production orders received from higher-level planning systems, the MES generates a production schedule. This schedule considers factors like order priorities, available resources, machine capacities and labor availability.</p>
        <p style="left:0%;">Work order management: The system assigns work orders to operators or workstations based on the schedule. It provides operators with instructions, specifications and necessary documentation to help them carry out their tasks. The system tracks the progress of each work order and updates the work-in- progress status in real time.</p>
        <p style="left:0%;">Machine and equipment integration: The system interfaces with machines and equipment on the shop floor to monitor their status, collect production data and exchange information. This integration can be achieved through various means such as machine sensors, programmable logic controllers (PLCs) interfaces or communication protocols like OLE (object linking and embedding) for process control (OPC).</p>
        <p style="left:0%;">Quality management: Quality data is captured during production, such as measurements, inspections and test results. It enforces quality control procedures, triggers alerts or notifications for quality issues and records quality-related information for analysis and traceability.</p>
        <p style="left:0%;">Material and inventory management: The MES tracks the movement of materials and components throughout the production process. It monitors inventory levels, initiates material requisitions or replenishments and helps ensure that the correct materials are available at the right time and in the right quantities.</p>
        <p style="left:0%;">Data analysis and reporting: The collected data is analyzed to provide real-time insights and performance metrics. It generates reports, dashboards and visualizations that help management and operators make informed decisions and identify areas for improvement.</p>
        <p style="left:0%;">Integration with higher-level systems: The system interfaces with other systems such as ERP, PLM or supply chain management (SCM) systems. This integration allows for the exchange of data, synchronization of information and alignment of manufacturing processes with overall business operations.</p>
        </div>
    </div>
</div>
</body>
</html>