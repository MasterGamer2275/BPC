<?php
/*
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
  */
?>
<html>
<body>
<!-- define variables and set to empty values*-->
<!--
Welcome  <?php echo $_POST["uname"]; ?><br> 
Password  <?php echo $_POST["pwd"]; ?><br>
Login  <?php echo $_POST["login"]; ?><br>
Signup  <?php echo $_POST["signup"]; ?><br>
-->
<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>
    <?php //---add the DB API file ?>
    <?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
    <?php require $root."/DB/call-db.php"; ?>
    <?php require "Reset.php"; ?>
    <?php //include 'DB/createDBTables.php'; ?>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
    <?php $name = $_POST["uname"]; ?>
    <?php $password = $_POST["pwd"]; ?>
    <?php $lgn = $_POST["login"]; ?>
    <?php $sp = $_POST["signup"]; ?>
   <!-- Place holder for SQL table query -->
<?php // The username to search for ?>
<?php $searchUsername = $name; ?>

<?php // Prepare the SQL statement with a parameter placeholder ?>
<?php $tablename = $_SESSION["UserTabName"]; ?>
<?php $sql = "SELECT * FROM  `$tablename` WHERE username = ?"; ?>
<?php $stmt = $db->prepare($sql); ?>

<?php // Bind the parameter to the actual value ?>
<?php $stmt->bind_param("s", $searchUsername); ?>

<?php // Execute the statement ?>
<?php $stmt->execute(); ?>

<?php // Get the result ?>
<?php $result = $stmt->get_result(); ?>

<?php // Fetch the row as an associative array ?>
<?php $row = $result->fetch_assoc(); ?>

<?php if ($row) { ?>
    <?php // Output the result ?>
    <?php //echo 'User found: ' . print_r($row, true); ?>
    <?php // Set session variables ?>
    <?php // Start the session ?>
    <?php
// Start the session
//session_start();
//if(session_status() !== 1) session_start();
// Unset specific session variables
unset($_SESSION['companyID']);
unset($_SESSION['User']);

// Optionally, check if the variables are unset
if (!isset($_SESSION['companyID']) && !isset($_SESSION['User'])) {
    //echo 'Session variables unset successfully.';
} else {
    echo 'Failed to unset session variables.';
}

$_SESSION['companyID'] = $row['COMPANYID'];
$x = $_SESSION['companyID'];
$_SESSION['CompanyID'] = $row['COMPANYID'];
$_SESSION['User'] = $row['USERNAME'];
$y = $_SESSION['User'];
echo "<script>console.log('COMPANYID:', " . $x . ");</script>";
echo "<script>console.log('USER:', " . $y . ");</script>";
//echo $x;
//echo $y;
    if (isset($_SESSION['companyID']) && isset($_SESSION['User'])) {
        //echo 'Session variables set successfully.';
} else {
    echo 'Failed to set session variables.';
}
?>  
    <?php include 'main-page/main-page.php'; ?>
<?php } else { ?>
    <?php echo 'No user found with username: ' . $searchUsername; ?>
<?php } ?>
  <?php if ($sp != "") { ?>
    <!-- Place holder to open the .htm file for registration -->
    <?php include 'new-user/new-user-form.php';?>
    <!-- <?php header("Location: new-user\new-user-form.php"); ?> -->
   <?php }?>
<?php } ?>

</body>
</html>