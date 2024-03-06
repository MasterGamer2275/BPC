<!DOCTYPE html>
<html>

<?php include 'header.php';?>

<h2>Please enter the below details and submit to register. A response with employee ID and confirmation will be emailed by the web host in 24-48 Hrs.</h2>

<form action="\new_user_action_page.php" method="post" enctype="multipart/form-data">
  Company Name:<input type="text" id="fname" name="fname" value="" style="font-size: 100%;"><br><br>
  First Name:<input type="dropdownbox" id="fname" name="fname" value="" style="font-size: 100%;"><br><br>
  Last Name:<input type="text" id="lname" name="lname" value="" style="font-size: 100%;"><br><br>
  Email ID:<input type="email" id="eid" name="eid" value="" style="font-size: 100%;"><br><br>
  BirthDate:<input type="date" id="bd" name="bd" value="" style="font-size: 100%;"><br><br>
  Photo:<input type="image" id="photo" name="photo" value="" style="font-size:
  <a href="url"></a>
  <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
    <textarea name="Tell About Yourself" rows="10" cols="30">Tell About Yourself.</textarea>
  <br><br>
  <input type="Submit" id="Register" name="register" disabled value="Register" style=" font-size: 100%; background-color: #1284b16b;">

</form>

<script>


</script>

<?php include 'footer.php';?>

</body>
</html>