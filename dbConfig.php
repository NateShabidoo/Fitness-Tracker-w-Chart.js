
//This is the config file used to connect user to the database on host site (local host here)
<?php
$con = mysqli_connect("localhost","fitness_tracker","########") OR die("cannot connect3");
mysqli_select_db($con, 'fitness_tracker');
?>
