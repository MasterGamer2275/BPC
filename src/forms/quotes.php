 <?php
// If the request is made from our space preview functionality then turn on PHP error reporting
if (isset($_SERVER['HTTP_X_FORWARDED_URL']) && strpos($_SERVER['HTTP_X_FORWARDED_URL'], '.w3spaces-preview.com/') !== false) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  }
?>
<?php
 // $root = $_SERVER['DOCUMENT_ROOT'];
 // require $root."/DB/call-db.php";
  //dbsetup($db, $text);
  //$tablename = $_SESSION["PRNumTabName"];
  //dbcreateprnumtable($db, $tablename, $text);
  //$tablename = $_SESSION["PRTabName"];
  ///dbcreatePRtable($db, $tablename, $text);
  //$PRNum = 56703;
  //$PRDes = "Allocated";
  //dbaddprnumrecord($db, $tablename, $PRNum, $PRDes, $text);
  //dbeditprnumrecord($db, $tablename, $ID, $PRNum, $PRDes, $text);
  //$PRNum = 56701;
  //$PRDes = "Allocated";
  //dbaddprnumrecord($db, $tablename, $PRNum, $PRDes, $text);
  //$PRDes = "Checking";
  //dbeditprnumrecord($db, $tablename, $ID, $PRNum, $PRDes, $text);
  //$PRNum = 56701;
  //dbdeleteprnumrecord($db, $tablename, $PRNum, $text);
  /*
  $dbtabdata = array(array());
  $paramname = "PRNUMBER";
  dbreadprnumrecord($db, $tablename, $paramname, $newPRNum, $text);
 if ($newPRNum == 1) {
    $paramname = "PONUM";
    $tablename = $_SESSION["PRTabName"];
    dbreadprnumrecord($db, $tablename, $paramname, $newPRNum, $text);
      if ($newPRNum == 1) {
          $newPRNum = $_SESSION["InitPONum"];
      }
  }
  echo $newPRNum;
  */
 
 // dbclose($db, $text);
  //echo $text;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h1>Send an Email</h1>
    <form id="emailForm">
        <label for="to">To:</label>
        <input type="email" id="to" name="to" required><br><br>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" value="Send Email">
    </form>

    <script>
        $(document).ready(function () {
            // Handle form submission
            $("#emailForm").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                // Collect form data
                const formData = {
                    to: $("#to").val(),
                    subject: $("#subject").val(),
                    text: $("#message").val()
                };

                // Send AJAX request to server
                $.ajax({
                    url: "/send-email",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        alert(response); // Show success message
                    },
                    error: function (xhr, status, error) {
                        console.error(error); // Log any errors
                        alert("An error occurred. Please try again."); // Show error message
                    }
                });
            });
        });
    </script>
</body>
</html>
