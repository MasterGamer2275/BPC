<html>
<body>
<!-- define variables and set to empty values*-->
<!--
Welcome  <?php echo $_POST["uname"]; ?><br> 
Password  <?php echo $_POST["pwd"]; ?><br>
Login  <?php echo $_POST["login"]; ?><br>
Signup  <?php echo $_POST["signup"]; ?><br>
-->
<?php CREATE DATABASE testDB; ?>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
    <?php $name = $_POST["uname"]; ?>
    <?php $password = $_POST["pwd"]; ?>
    <?php $lgn = $_POST["login"]; ?>
    <?php $sp = $_POST["signup"]; ?>
   <!-- Place holder for SQL table query -->
  <?php if ($lgn != "" && $name == "Admin1234567" && $password == "Admin") { ?>
     <!-- Place holder to open the .htm file for main log in page -->
     <?php include 'main-page/main-page.php';?>
     <?php echo $lgn; ?>
    <?php } ?>
  <?php if ($sp != "") { ?>
    <?php echo $sp; ?>
    <!-- Place holder to open the .htm file for registration -->
    <?php include 'new-user/new-user-form.php';?>
    <!-- <?php header("Location: new-user\new-user-form.php"); ?> -->
   <?php }?>
<?php } ?>

</body>
</html>