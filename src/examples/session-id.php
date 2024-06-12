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
// Debug: Check if headers have already been sent
if (headers_sent()) {
    echo "Headers already sent. Cannot start session.<br>";
}

// Start the session
session_start();

// Check if the session ID is set
echo "Session ID: " . session_id() . "<br>";

// Print the current session status
echo "Before session_destroy(): " . session_status() . " (should be 2)<br>"; // This should print 2 (PHP_SESSION_ACTIVE) if the session is active

// Destroy the session
session_destroy();

// Print the current session status again
echo "After session_destroy(): " . session_status() . " (should be 1)<br>"; // This should print 1 (PHP_SESSION_NONE) if the session is destroyed

// Debug: Check session save path
echo "Session save path: " . session_save_path() . "<br>";

// Debug: Check if session file exists
$session_file = session_save_path() . "/sess_" . session_id();
if (file_exists($session_file)) {
    echo "Session file exists: " . $session_file . "<br>";
} else {
    echo "Session file does not exist.<br>";
}
?>

</body>
</html>