<!DOCTYPE html>
<html>
<style>

</style>
<?php include 'header.php';?>
<h3>Welcome to Kraft Paper Cover Manufacturing Execution System Online Portal, please Log In to continue.</h3>
<div id="id01">
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="container">
      <label for="uname" style="font-size: 16px; text-align: left;"><b>Employee ID:</b></label><br>
      <input type="text" style="font-size: 14px; text-align: left;" placeholder="Enter Username" id = "uname" name="uname" required maxlength = 13 onkeyup = "validate_username()">
      <input type="text" id = "uimsg1" disabled readonly style="color: red; border: none;" value="invalid input"></label><br>
      <label for="pwd" style="font-size: 16px; text-align: left;"><b>Password:</b></label><br>
      <input type="password" style="font-size: 14px; text-align: left;" placeholder="Enter Password" name="pwd" id = "pwd"required>
      <input type="checkbox" onclick="myFunction()">Show Password<br><br>        
      <input type="Submit" id="login" name="login" value="LogIn" disabled class = "Loginbutton">
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="pwd">Forgot <a href='#'>password?</a></span>
    </div>
  </form>
</div>




<script>

function myFunction() {
  var x = document.getElementById("pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
// validate emplyee ID
function validate_username() {
  var y = document.getElementById("uimsg1");
  var z = document.getElementById("uname");
  var d = document.getElementById("login");
  if (z.value.length == 13) {
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
