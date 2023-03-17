<?php
session_start();
require 'dbconfig/config.php';
ob_start();
/* Nate's chopped version
$email = $_SESSION['email'];
$query = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");
while ($row = mysqli_fetch_array($query)) {  
$email= $row['email']; } */	
/*
$userID = $_SESSION['userID'];
$query = mysqli_query($con, "SELECT * FROM user WHERE userID = '$userID'");
while ($row = mysqli_fetch_array($query)) {  
	$userid= $row['userID']; 
}*/ 
//next try
$userEmail = $_SESSION['email'];
$query = mysqli_query($con, "SELECT * FROM user WHERE email = '$userEmail'");
while ($row = mysqli_fetch_array($query)) {  
	$userid= $row['userID']; 
}
 ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css/css.css" type="text/css">
  <title>Fitness Tracker</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark" id="navbar">
    <a class="navbar-brand" href="#" alt="fitness tracker logo"><img src="images/logo white small.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home <span class="sr-only"></span></a>
        </li>
		  <li class="nav-item active">
          <a class="nav-link" href="#">Add Workout<span class="sr-only">(current)</span></a>
        </li>
	        <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      </ul>
    </div>
  </nav>
   <div class="main">
    <div class="container">
      <div class="row">
        <div class="col-10 mx-auto rounded pt-6 text-light" id="formbg2">
		<!--newly added this is beginning of form-->
		<form class="myform" action="addworkout.php" method="post">
            <div class="form-group">
			<h2>Enter Cardio Workout</h2>
              <label>Cardio Workout Name (select)</label>
			  <select name="cardio_name" class="form-control" required>
				 <option value="Run">Run</option>
                 <option value="Walk">Walk</option>
                 <option value="Bike Ride">Bike Ride</option>
				 <option value="Swim">Swim</option>
				 <option value="Elliptical">Elliptical</option>
				 <option value="Stairmaster">Stairmaster</option>
               </select>
              </div>
			 <div class="form-group">
              <label for="ExampleInputPassword1">Distance in Miles</label>
              <input type="text" name="cardio_distance" class="form-control" id="ExampleInputPassword1" placeholder="0.00" required>
              </div>
			  <div class="form-group">
              <label for="speed">Speed (MPH)</label>
              <input type="text" name="cardio_MPH" class="form-control" id="ExampleInputPassword1" placeholder="0.00">
              </div>
			  <div class="form-group">
              <label for="speed">Max Heartbeats Per Minute</label>
              <input type="text" name="cardio_bpm" class="form-control" id="ExampleInputPassword1" placeholder="000">
              </div>
			  <div class="form-group">
              <label for="date">Date</label>
              <input type="date" name="cardio_date" class="form-control" id="ExampleInputPassword1" placeholder="MM-DD-YYYY" required>
              </div>
		<input name="cardio_submit_btn" class="btn" type="submit" id="submit_btn" value="Enter Cardio Workout"/><a href="home.php"></a><br>
          </form>
		  <?php

			if(isset($_POST['cardio_submit_btn'])){ //was 'insert_btn_cardio'
				
				@$userid_cardio=$_POST['userid_cardio'];
				@$cardio_name=$_POST['cardio_name'];
				@$cardio_distance=$_POST['cardio_distance'];
				@$cardio_MPH=$_POST['cardio_MPH'];
				@$cardio_maxbpm=$_POST['cardio_bpm'];
				@$date=$_POST['cardio_date'];
				@$cdate=date('Y-m-d', strtotime($_POST['cardio_date']));
				
				if($userid=="" || $cardio_name=="" || $cardio_distance=="" || $date=="")
				{
					echo '<script type="text/javascript">alert("Insert values in all fields")</script>';
				}
				else if($cardio_MPH=="" && $cardio_maxbpm=="")
				{
					$query = "insert into cardio_exercise (userid, exercisename, distance, DateTime) values('$userid', '$cardio_name', '$cardio_distance', '$cdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						//echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
				//this now displays table showing all exercises for this workout name and most recent addition
				$query = "select * from cardio_exercise where userID='$userid'";
				$result=mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				    $query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='$cardio_name'";
					$result=mysqli_query($con, $query);
					
					echo"<table>";
					echo"<tr><td>Exercise Name</td><td>Distance</td><td>MPH</td><td>Max Heart BPM</td><td>Date/Time</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				}
	            //end of table
					}
				}
				else if($cardio_MPH=="")
				{
					$query = "insert into cardio_exercise (userid, exercisename, distance, MaxHeartBPM, DateTime) values('$userid', '$cardio_name', '$cardio_distance', '$cardio_maxbpm', '$cdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
						//this now displays table showing all exercises for this workout name and most recent addition
				$query = "select * from cardio_exercise where userID='$userid'";
				$result=mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				    $query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='$cardio_name'";
					$result=mysqli_query($con, $query);
					
					echo"<table border='1'>";
					echo"<tr><td>Exercise Name</td><td>Distance</td><td>MPH</td><td>Max Heart BPM</td><td>Date/Time</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				}
				//end of table	
					}
				}
				else if($cardio_maxbpm=="")
				{
					$query = "insert into cardio_exercise (userid, exercisename, distance, MPH, DateTime) values('$userid', '$cardio_name', '$cardio_distance', '$cardio_MPH', '$cdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						//echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
						//this now displays table showing all exercises for this workout name and most recent addition
				$query = "select * from cardio_exercise where userID='$userid'";
				$result=mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				    $query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='$cardio_name'";
					$result=mysqli_query($con, $query);
					
					echo"<table border='1'>";
					echo"<tr><td>Exercise Name</td><td>Distance</td><td>MPH</td><td>Max Heart BPM</td><td>Date/Time</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				}
				//end of table
					}
				}
				else{
					$query = "insert into cardio_exercise (userid, exercisename, distance, mph,maxheartbpm, DateTime) values('$userid', '$cardio_name', '$cardio_distance', '$cardio_MPH', '$cardio_maxbpm', '$cdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
					//	echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
						//this now displays table showing all exercises for this workout name and most recent addition
				$query = "select * from cardio_exercise where userID='$userid'";
				$result=mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				    $query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='$cardio_name'";
					$result=mysqli_query($con, $query);
					
					echo"<table border='1'>";
					echo"<tr><td>Exercise Name</td><td>Distance</td><td>MPH</td><td>Max Heart BPM</td><td>Date/Time</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				}
				}
				else{
					echo '<script type="text/javascript">alert("Values Not inserted")</script>';
				}
				}
			}
			?>
	<!--newly added this is beginning of form-->
		<form class="myform" action="addworkout.php" method="post">
            <div class="form-group">
			<h2>Enter Resistance Workout</h2>
              <label>Resistance Workout Name (select)</label>
			  <select name="resist_name" class="form-control" required>
				 <option value="Bench Press">Bench Press</option>
                 <option value="Incline Bench Press">Incline Bench Press</option>
                 <option value="Preacher Curl">Preacher Curl</option>
				 <option value="Triceps Pull Down">Triceps Pull Down</option>
				 <option value="Calf Lift">Calf Lift</option>
				 <option value="Quad Lift">Quad Lift</option>
				 <option value="Dumbbell Curl">Dumbbell Curl</option>
				 <option value="Dumbbell Butterfly">Dumbbell Butterfly</option>
				 <option value="Skull Crusher">Skull Crusher</option>
               </select>
              </div>
			  <div class="form-group">
              <label for="date">Date</label>
              <input type="date" name="resist_date" class="form-control" id="ExampleInputPassword1" placeholder="MM-DD-YYYY" required>
              </div>
			 <div class="form-group">
              <label for="ExampleInputPassword1">Set 1 Resistance</label>
              <input type="text" name="set1_resist" class="form-control" id="ExampleInputPassword1" placeholder="0.00 lbs" required>
              </div>
			  <div class="form-group">
              <label for="speed">Set 1 Reps</label>
              <input type="text" name="set1_reps" class="form-control" id="ExampleInputPassword1" placeholder="00" required>
              </div>
			 <div class="form-group">
              <label for="ExampleInputPassword1">Set 2 Resistance</label>
              <input type="text" name="set2_resist" class="form-control" id="ExampleInputPassword1" placeholder="0.00 lbs">
              </div>
			  <div class="form-group">
              <label for="speed">Set 2 Reps</label>
              <input type="text" name="set2_reps" class="form-control" id="ExampleInputPassword1" placeholder="00">
              </div>
			  <div class="form-group">
              <label for="ExampleInputPassword1">Set 3 Resistance</label>
              <input type="text" name="set3_resist" class="form-control" id="ExampleInputPassword1" placeholder="0.00 lbs">
              </div>
			  <div class="form-group">
              <label for="speed">Set 3 Reps</label>
              <input type="text" name="set3_reps" class="form-control" id="ExampleInputPassword1" placeholder="00">
              </div>
			  <div class="form-group">
              <label for="ExampleInputPassword1">Set 4 Resistance</label>
              <input type="text" name="set4_resist" class="form-control" id="ExampleInputPassword1" placeholder="0.00 lbs" >
              </div>
			  <div class="form-group">
              <label for="speed">Set 4 Reps</label>
              <input type="text" name="set4_reps" class="form-control" id="ExampleInputPassword1" placeholder="00">
              </div>
			  <div class="form-group">
              <label for="ExampleInputPassword1">Set 5 Resistance</label>
              <input type="text" name="set5_resist" class="form-control" id="ExampleInputPassword1" placeholder="0.00 lbs" >
              </div>
			  <div class="form-group">
              <label for="speed">Set 5 Reps</label>
              <input type="text" name="set5_reps" class="form-control" id="ExampleInputPassword1" placeholder="00">
              </div>
		<input name="resist_submit_btn" class="btn" type="submit" id="submit_btn" value="Enter Resistance Workout"/><a href="home.php"></a><br>
          </form>
		  <?php

			if(isset($_POST['resist_submit_btn'])){ //was 'insert_btn_cardio'
				
				@$userid_resist=$_POST['userid_resist'];
				@$resist_name=$_POST['resist_name'];
				@$set1_resist=$_POST['set1_resist'];
				@$set1_reps=$_POST['set1_reps'];
				@$set2_resist=$_POST['set2_resist'];
			    @$set2_reps=$_POST['set2_reps'];
				@$set3_resist=$_POST['set3_resist'];
			    @$set3_reps=$_POST['set3_reps'];
				@$set4_resist=$_POST['set4_resist'];
			    @$set4_reps=$_POST['set4_reps'];
				@$set5_resist=$_POST['set5_resist'];
			    @$set5_reps=$_POST['set5_reps'];
				@$date=$_POST['resist_date'];
				@$rdate=date('Y-m-d', strtotime($_POST['resist_date']));
				
				if($resist_name=="" || $set1_resist=="" || $set1_reps=="" || $date=="")
				{
					echo '<script type="text/javascript">alert("Insert values in Name, Date, Set 1 Resistance and Set 1 Reps")</script>';
				}
				else if($set2_resist=="" && $set2_reps=="" && $set3_resist=="" && $set3_reps=="" && $set4_resist=="" && $set4_reps=="" && $set5_resist=="" && $set5_reps=="")
				{
					$query = "insert into resist_exercise (userid, exercisename, set1_resist, set1_reps, Date) values('$userid', '$resist_name', '$set1_resist', '$set1_reps', '$rdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						//echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
						//this now displays table showing all exercises for this workout name and most recent addition
						$query = "select * from resist_exercise where userID='$userid'";
						$result=mysqli_query($con, $query);

						while($row = mysqli_fetch_assoc($result)) {
							$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, set4_resist, set4_reps, set5_resist, set5_reps, date from resist_exercise where userID='$userid' and ExerciseName='$resist_name'";
							$result=mysqli_query($con, $query);
					
						echo"<table border='1'>";
						echo"<tr><td>Exercise Name</td><td>Set 1 Resistance</td><td>Set 1 Reps</td><td>Set 2 Resistance</td><td>Set 2 Reps</td><td>Set 3 Resistance</td><td>Set 3 Reps</td><td>Set 4 Resistance</td><td>Set 4 Reps</td><td>Set 5 Resistance</td><td>Set 5 Reps</td><td>Date</td></tr>";
						while($row = mysqli_fetch_assoc($result)) {
							echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['set4_resist']}</td><td>{$row['set4_reps']}</td><td>{$row['set5_resist']}</td><td>{$row['set5_reps']}</td><td>{$row['date']}</td></tr>";
					}
					echo"</table>";
					}
					//end of table
					}
				}
				else if($set3_resist=="" && $set3_reps=="" && $set4_resist=="" && $set4_reps=="" && $set5_resist=="" && $set5_reps=="")
				{
					$query = "insert into resist_exercise (userid, exercisename, set1_resist, set1_reps, set2_resist, set2_reps, Date) values('$userid', '$resist_name', '$set1_resist', '$set1_reps', '$set2_resist', '$set2_reps', '$rdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						//echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
						//this now displays table showing all exercises for this workout name and most recent addition
						$query = "select * from resist_exercise where userID='$userid'";
						$result=mysqli_query($con, $query);

						while($row = mysqli_fetch_assoc($result)) {
							$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, set4_resist, set4_reps, set5_resist, set5_reps, date from resist_exercise where userID='$userid' and ExerciseName='$resist_name'";
							$result=mysqli_query($con, $query);
					
						echo"<table border='1'>";
						echo"<tr><td>Exercise Name</td><td>Set 1 Resistance</td><td>Set 1 Reps</td><td>Set 2 Resistance</td><td>Set 2 Reps</td><td>Set 3 Resistance</td><td>Set 3 Reps</td><td>Set 4 Resistance</td><td>Set 4 Reps</td><td>Set 5 Resistance</td><td>Set 5 Reps</td><td>Date</td></tr>";
						while($row = mysqli_fetch_assoc($result)) {
							echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['set4_resist']}</td><td>{$row['set4_reps']}</td><td>{$row['set5_resist']}</td><td>{$row['set5_reps']}</td><td>{$row['date']}</td></tr>";
					}
					echo"</table>";
					}
					//end of table
					}
				}
				else if($set4_resist=="" && $set4_reps=="" && $set5_resist=="" && $set5_reps=="")
				{
					$query = "insert into resist_exercise (userid, exercisename, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, Date) values('$userid', '$resist_name', '$set1_resist', '$set1_reps', '$set2_resist', '$set2_reps', '$set3_resist', '$set3_reps','$rdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						//echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
						//this now displays table showing all exercises for this workout name and most recent addition
						$query = "select * from resist_exercise where userID='$userid'";
						$result=mysqli_query($con, $query);

						while($row = mysqli_fetch_assoc($result)) {
							$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, set4_resist, set4_reps, set5_resist, set5_reps, date from resist_exercise where userID='$userid' and ExerciseName='$resist_name'";
							$result=mysqli_query($con, $query);
					
						echo"<table border='1'>";
						echo"<tr><td>Exercise Name</td><td>Set 1 Resistance</td><td>Set 1 Reps</td><td>Set 2 Resistance</td><td>Set 2 Reps</td><td>Set 3 Resistance</td><td>Set 3 Reps</td><td>Set 4 Resistance</td><td>Set 4 Reps</td><td>Set 5 Resistance</td><td>Set 5 Reps</td><td>Date</td></tr>";
						while($row = mysqli_fetch_assoc($result)) {
							echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['set4_resist']}</td><td>{$row['set4_reps']}</td><td>{$row['set5_resist']}</td><td>{$row['set5_reps']}</td><td>{$row['date']}</td></tr>";
					}
					echo"</table>";
					}
					//end of table
					}
				}
				else if($set5_resist=="" && $set5_reps=="")
				{
					$query = "insert into resist_exercise (userid, exercisename, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, set4_resist, set4_reps,Date) values('$userid', '$resist_name', '$set1_resist', '$set1_reps', '$set2_resist', '$set2_reps', '$set3_resist', '$set3_reps', '$set4_resist', '$set4_reps','$rdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						//echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
						//this now displays table showing all exercises for this workout name and most recent addition
						$query = "select * from resist_exercise where userID='$userid'";
						$result=mysqli_query($con, $query);

						while($row = mysqli_fetch_assoc($result)) {
							$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, set4_resist, set4_reps, set5_resist, set5_reps, date from resist_exercise where userID='$userid' and ExerciseName='$resist_name'";
							$result=mysqli_query($con, $query);
					
						echo"<table border='1'>";
						echo"<tr><td>Exercise Name</td><td>Set 1 Resistance</td><td>Set 1 Reps</td><td>Set 2 Resistance</td><td>Set 2 Reps</td><td>Set 3 Resistance</td><td>Set 3 Reps</td><td>Set 4 Resistance</td><td>Set 4 Reps</td><td>Set 5 Resistance</td><td>Set 5 Reps</td><td>Date</td></tr>";
						while($row = mysqli_fetch_assoc($result)) {
							echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['set4_resist']}</td><td>{$row['set4_reps']}</td><td>{$row['set5_resist']}</td><td>{$row['set5_reps']}</td><td>{$row['date']}</td></tr>";
					}
					echo"</table>";
					}
					//end of table
					}
				}
				else{
									
					$query = "insert into resist_exercise (userid, exercisename, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, set4_resist, set4_reps, set5_resist, set5_reps,Date) values('$userid', '$resist_name', '$set1_resist', '$set1_reps', '$set2_resist', '$set2_reps', '$set3_resist', '$set3_reps', '$set4_resist', '$set4_reps', '$set5_resist', '$set5_reps','$rdate')";
					$query_run=mysqli_query($con,$query);
					if($query_run)
					{
						//echo '<script type="text/javascript">alert("Values inserted successfully")</script>';
						//this now displays table showing all exercises for this workout name and most recent addition
						$query = "select * from resist_exercise where userID='$userid'";
						$result=mysqli_query($con, $query);

						while($row = mysqli_fetch_assoc($result)) {
							$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, set4_resist, set4_reps, set5_resist, set5_reps, date from resist_exercise where userID='$userid' and ExerciseName='$resist_name'";
							$result=mysqli_query($con, $query);
					
						echo"<table border='1'>";
						echo"<tr><td>Exercise Name</td><td>Set 1 Resistance</td><td>Set 1 Reps</td><td>Set 2 Resistance</td><td>Set 2 Reps</td><td>Set 3 Resistance</td><td>Set 3 Reps</td><td>Set 4 Resistance</td><td>Set 4 Reps</td><td>Set 5 Resistance</td><td>Set 5 Reps</td><td>Date</td></tr>";
						while($row = mysqli_fetch_assoc($result)) {
							echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['set4_resist']}</td><td>{$row['set4_reps']}</td><td>{$row['set5_resist']}</td><td>{$row['set5_reps']}</td><td>{$row['date']}</td></tr>";
					}
					echo"</table>";
					}
					//end of table
					}
				}
			}
			?>
	</div>
      </div>
    </div>
    </div>
 
  <!-- Bootstrap's JavaScript Files -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>