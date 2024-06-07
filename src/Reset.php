 <?php
session_save_path('/home/app/src/custom_sessions');

// Ensure the directory exists and is writable
if (!is_dir('/home/app/src/custom_sessions')) {
    mkdir('/home/app/src/custom_sessions', 0777, true);
}
// Start the session
if(session_status() !== 1) session_start();

?>

 <?php

    $text = "Debug Mode:<br>";
    $err = "Db Error:";
    
    // Database connection parameters
    $host = 'sql12.freesqldatabase.com'; // e.g., 'localhost' or '127.0.0.1'
    $username = 'sql12710106';
    $password = 'BGhnvtAIRZ';
    $database = 'sql12710106';
    
    // Create connection
    $db = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($db->connect_error) {
        $err = "Connection failed: " . $db->connect_error;
        $text .= $err;
        $text .= "<br>";
    } else {
        $text .= "Connected to MySQL database successfully<br>";
    }
    $_SESSION["companyID"] = "6100";
    $_SESSION["SListTabName"] = "SUPPLIER_TABLE";
    $_SESSION["ComListTabName"] = "COMMODITY_TABLE";
    $_SESSION["StListTabName"] = "RMSTOCK_TABLE";
    $_SESSION["PRNumTabName"] = "PRNUM_TABLE";
    $_SESSION["CoListTabName"] = "COMPANYLIST_TABLE";
    $_SESSION["ClListTabName"] = "CUSTOMER_TABLE";
    $_SESSION["PListTabName"] = "PRODUCT_TABLE";
    $_SESSION["PRTabName"] = "PURCHASE_TABLE";
    $_SESSION["ProdTabName"] = "PRODFEED_TABLE";
    $_SESSION["InitPONum"] = "8100000";
    $_SESSION["InitWONum"] = "6100000";
    $_SESSION["InitDPNum"] = "7100000";
    $_SESSION["DispTabName"] = "DISPATCH_TABLE";
    $_SESSION["DocIdTabName"] = "DOCID_TABLE";
    $_SESSION["DBRef"] = $db;

function log_session_variables_to_console() {
    echo "<script>console.log('Session Variables:', " . json_encode($_SESSION) . ");</script>";
}

// Log session variables to the console
log_session_variables_to_console();

?>