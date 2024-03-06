<?php $host = 'localhost:3306'; ?>
<?php $user = 'Admin'; ?>
<?php $pass = 'Admin'; ?>
<?php $dbname = 'testDB'; ?>
<?php $conn = mysqli_connect($host, $user, $pass,$dbname); ?>
<?php if(!$conn){ ?>
   <?php die('Could not connect: '.mysqli_connect_error()); ?>
<?php } ?>
<?php echo 'Connected successfully<br/>'; ?>
<?php $sql = 'INSERT INTO emp4(name,salary) VALUES ("sonoo", 9000)'; ?>
<?php if(mysqli_query($conn, $sql)){ ?>
 <?php echo "Record inserted successfully"; ?> 
<?php }else{ ?>
<?php echo "Could not insert record: ". mysqli_error($conn); ?>
<?php } ?>
<?php mysqli_close($conn); ?>