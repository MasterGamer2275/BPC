<!DOCTYPE html>
<html>

<?php include 'header.php';?>

<form action="\action_page.php" method="post">
  <label for="oldpwd" style=" font-size: 100%; color: black;">Old Password::</label><br>
  <input type="text" id="oldpwd" name="oldpwd" placeholder = "Enter Old Password" required onkeyup = "validate_oldpwd()">
  <input type="text" id = "uimsg1" disabled readonly style="color: red; font-family: times-new-roman;font-size: 100%; border: none;" value="invalid input"></label><br>
  <label for="newpwd" style=" font-size: 100%; color: black;">Create New Password::</label><br>
  <input type="text" id="newpwd" name="newpwd" placeholder = "Enter New Password" required onkeyup = "validate_pwd()">
  <input type="text" id = "uimsg1" disabled readonly style="color: red; font-family: times-new-roman;font-size: 100%; border: none;" value="invalid input"></label><br>
  <label for="newpwd2" style=" font-size: 100%; color: black;">Re-nter Password::</label><br>
  <input type="text" id="oldpwd" name="oldpwd" placeholder = "Enter New Password" required onkeyup = "validate_pwd()">
</form>

<script>
function myFunction() {
  var x = document.getElementById("pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function validate_username() {
  var y = document.getElementById("uimsg1");
  var z = document.getElementById("uname");
  var d = document.getElementById("login");
  if (z.value.length == 12) {
    y.value = "";
    d.disabled=false
  } else {
    y.value = "invalid input.";
    d.disabled=true
 }
}

</script>


<?php include 'loginfooter.php';?>
</body>
</html>