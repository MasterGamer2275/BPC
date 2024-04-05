<?php
   //DB error handling
  if ($_SESSION["Err"] != "") {
    echo $_SESSION["ErrMsg"];
    echo "<script>alert('" . $_SESSION["ErrMsg"] . "');</script>";
    $_SESSION["ErrMsg"] = "";
    $_SESSION["Err"] = "";
    $_SESSION["ErrCode"] = "";
  }
?>