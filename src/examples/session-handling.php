 <?php
// Specify a custom session save path
session_save_path('/home/app/src/custom_sessions');

// Ensure the directory exists and is writable
if (!is_dir('/home/app/src/custom_sessions')) {
    mkdir('/home/app/src/custom_sessions', 0777, true);
}
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Start the session
session_start();

// Print the current session status
echo "Before session_destroy(): " . session_status() . "<br>"; // This will print 2 (PHP_SESSION_ACTIVE) since we started the session

// Destroy the session
session_destroy();

// Print the current session status again
echo "After session_destroy(): " . session_status() . "<br>"; // This will print 1 (PHP_SESSION_NONE) since we destroyed the session
?>

</body>
</html>