<?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 0);
  ini_set('display_startup_errors', 0);
  error_reporting(0);
}
?>
<?php
 // Start the session
// Print the current session status
// remove all session variables
//$db->close();
session_unset();
// destroy the session
session_destroy();
//echo "Before session_start(): " . session_status() . "<br>"; 
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();
if(session_status() !== 2) {
    session_start();
/* set the cache limiter to 'private' */

//echo "The cache limiter is now set to $cache_limiter<br />";
    //echo "Session ID: " . session_id() . "<br>";
    //echo "After session_start(): " . session_status() . "<br>"; 
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
    $_SESSION["companyID"] = "6100";
    $_SESSION["CompanyID"] = "6100";
    $_SESSION["SListTabName"] = "SUPPLIER_TABLE";
    $_SESSION["ComListTabName"] = "COMMODITY_TABLE";
    $_SESSION["StListTabName"] = "RMSTOCK_TABLE";
    $_SESSION["CoListTabName"] = "COMPANYLIST_TABLE";
    $_SESSION["ClListTabName"] = "CUSTOMER_TABLE";
    $_SESSION["PListTabName"] = "PRODUCT_TABLE";
    $_SESSION["PRTabName"] = "PURCHASE_TABLE";
    $_SESSION["ProdTabName"] = "PRODFEED_TABLE";
    $_SESSION["DispTabName"] = "DISPATCH_TABLE";
    $_SESSION["DocIdTabName"] = "DOCID_TABLE";
    $_SESSION["UserTabName"] = "USER_TABLE";
    $_SESSION["JobTabName"] = "JOB_TABLE";
    $_SESSION["DBRef"] = $db;
    $_SESSION["DBConnStr"] = "Connected";
    //echo "<script>console.log('status:', " . $_SESSION["DBConnStr"] . ");</script>";


function log_session_variables_to_console() {
    echo "<script>console.log('Session Variables:', " . json_encode($_SESSION) . ");</script>";
    //echo json_encode($_SESSION);
}
//log_session_variables_to_console();

    }
}
?>