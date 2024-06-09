<html>
<body>
<!-- define variables and set to empty values*-->
<!--
Welcome  <?php echo $_POST["uname"]; ?><br> 
Password  <?php echo $_POST["pwd"]; ?><br>
Login  <?php echo $_POST["login"]; ?><br>
Signup  <?php echo $_POST["signup"]; ?><br>
-->
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
    <?php if(session_status() !== 1) session_start(); ?>
    <?php //echo $row['COMPANYID']; ?>
    <?php $_SESSION["companyID"] = $row['COMPANYID']; ?>
    <?php $_SESSION["User"] = $row['USERNAME']; ?>
<?php // Log session variables to the console ?>
<?php log_session_variables_to_console(); ?>
    <!-- Place holder to open the .htm file for main log in page -->    
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