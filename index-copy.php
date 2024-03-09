<!DOCTYPE html>
<html>

<?php include 'header.php';?>
<h3>Welcome to Kraft Paper Cover Manufacturing Execution System Online Portal. Please Log In to continue.</h3>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
<form action="/action_page.php" method="post">
    <div>
     <label class="control-label" style="color: blue;font-size: 80%;" disabled>New user please click sign up to register.</label><br>
     <input type="Submit" id="signup" name="signup" value="signup" class = "SignUpbutton">
     </div>
</form>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="container">
      <label class="control-label" style="color: black;font-size: 200%;Align: Center;">Employee Log In</label><br><br><br>
      <label for="uname"><b>Employee ID:</b></label>
      <input type="text" placeholder="Enter Username" id = "uname" name="uname" required maxlength = 12 onkeyup = "validate_username()">
      <input type="text" id = "uimsg1" disabled readonly style="color: red; border: none;" value="invalid input"></label><br>
      <label for="pwd"><b>Password:</b></label>
      <input type="password" placeholder="Enter Password" name="pwd" id = "pwd"required>
      <input type="checkbox" onclick="myFunction()">Show Password<br><br>        
      <input type="Submit" id="login" name="login" value="LogIn" disabled class = "Loginbutton">
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="pwd">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>



<script>

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
// Show Password
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