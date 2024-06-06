<?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>
<?php 
    if(session_status() !== 1) session_start();
  
    if (!isset($_SESSION['pg1'])) { 
        $_SESSION['pg1'] = 1; 
    } else { 
        $_SESSION['pg1'] += 1; 
    } 
  
?> 
  
<!DOCTYPE html> 
  
<body> 
    <h2 style="color:green">GeeksforGeeks</h2> 
    <strong>Session Manager</strong></br></br> 
    <?php 
    $i = 1; 
    for ($i = 1; $i <= 2; $i++) { 
        if (isset($_SESSION["pg$i"])) { 
            echo "Page number $i count: " . $_SESSION["pg$i"] . '</br>'; 
        } else { 
            echo "Page number $i count: " . 0 . '</br>'; 
        } 
    }
    function log_session_variables_to_console() {
    echo "<script>console.log('Session Variables:', " . json_encode($_SESSION) . ");</script>";
}

// Log session variables to the console
log_session_variables_to_console();
    ?> 
  
    <a href="file1.php">Page number 1</a> </br> 
    <a href="file2.php">Page number 2</a> </br> 
  
</body> 
</html> 