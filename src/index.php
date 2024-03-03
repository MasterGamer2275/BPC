
<?php include 'header.php';?>
<h2>Please enter a valid ID and a password to continue.</h2>


<form action="\action_page.php" method="post">
  <label for="uname" style=" font-size: 100%; font-family: times-new-roman; color: black;">Employee ID:</label><br>
  <input type="text" id="uname" name="uname" value="" maxlength = 12 style="font-family: times-new-roman;font-size: 100%;color: black;" onkeyup = "validate_username()">
  <input type="text" id = "uimsg1" readonly style="color: red; font-family: times-new-roman;font-size: 100%; border: none;" value="invalid input"></label><br>
  <label for="pwd" style=" font-family: times-new-roman;font-size: 100%;color: black;" >Password:</label><br>
  <input type="password" id="pwd" name="pwd" value="" style=" font-family: times-new-roman;font-size: 100%;color: black;" maxlength="10">
  <input type="checkbox" style=" font-family: times-new-roman;font-size: 100%;color: black;" onclick="myFunction()">Show Password<br><br>
  <input type="Submit" id="login" name="login" value="LogIn" disabled style=" font-family: times-new-roman;font-size: 100%; color: black;background-color: #1284b16b;">
  <input type="Submit" id="signup" name="signup" value="Sign Up" style=" font-family: times-new-roman;font-size: 100%;color: black;">
  <label class="control-label" style="color: blue; font-family: times-new-roman;font-size: 100%;">New user please click sign up to register.</label>
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