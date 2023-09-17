<?php
session_start();
require 'dbconfig/config.php';
ob_start();

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
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="addworkout.php">Add Workout</a>
        </li>
	        <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../index.html">NateErickson.com</a>
      </li>
      </ul>
    </div>
  </nav>
   <div class="main">
    <div class="container">
      <div class="row">
        <div class="col-12 mx-auto rounded pt-6 text-light" id="formbg2">
			  <center>
		<form class="myform" action="addworkout.php" method="post">  
		<input name="submit_btn" class="btn" type="submit" id="main_btn" value="Enter New Workout"/><a href="addworkout.php"></a>
	    </form>
		  </center>

		  <center>
        <h1>Your Workouts</h1>
		</center>
		</div>
		</div>
		</div>
		</div>
	<div class="row">

<!--this is beginning of run chart with table if it is in database for user-->
	<?php
			$query1 = "SELECT userid FROM `cardio_exercise` WHERE exercisename='run' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
			
			if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Run</h3> <?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'run' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='run' order by datetime asc";
					$result=mysqli_query($con, $query);
				
				//	echo"<table>";
				//	echo"<thead><tr><th>Exercise</th><th>Distance</th><th>MPH</th><th>Max Heart BPM</th><th>Date</th></tr></thead>";
					while($row = mysqli_fetch_assoc($result)) {
						//echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
								$chart_data = ""; //this is new
								$runDistance[] = $row['distance']; //new
								$dateTime[] = $row['datetime']; //new
								$maxBPM[] = $row['maxheartbpm']; //new
				}
				//echo"</table>";
				} ?>
				<canvas id="chartjs_bar" height="200"></canvas>

				<?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'run' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='run' order by datetime asc";
					$result=mysqli_query($con, $query);
				
					echo"<table>";
					echo"<thead><tr><th>Exercise</th><th>Distance</th><th>MPH</th><th>Max Heart BPM</th><th>Date</th></tr></thead>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!--this is end of new-->

<!--this is beginning of elliptical with chart and table-->			
			<?php

			$query1 = "SELECT userid FROM `cardio_exercise` WHERE exercisename='elliptical' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
			
			if(mysqli_num_rows($query_run)==0) {
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Elliptical</h3> <?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'elliptical' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='elliptical' order by datetime asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								$ellipticalDistance[] = $row['distance']; //new
								$ellipticalDateTime[] = $row['datetime']; //new
								$ellipticalMaxBPM[] = $row['maxheartbpm']; //new
				}

				} ?>
				<canvas id="chartjs_bar2" height="200"></canvas>

				<?php

			    $query = "SELECT 'elliptical' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='elliptical' order by datetime asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise</td><td class='th1'>Distance</td><td class='th1'>MPH</td><td class='th1'>Max Heart BPM</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!--end of elliptical-->			
			
<!--bike ride chart and table starts here-->
			<?php

			$query1 = "SELECT userid FROM `cardio_exercise` WHERE exercisename='bike ride' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
			
			if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Bike Ride</h3> <?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'bike ride' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='bike ride' order by datetime asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								$bikeRideDistance[] = $row['distance']; //new
								$bikeRideDateTime[] = $row['datetime']; //new
								$bikeRideMaxBPM[] = $row['maxheartbpm']; //new
				}

				} ?>
				<canvas id="chartjs_bar3" height="200"></canvas>

				<?php

				$query = "SELECT 'bike ride' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='bike ride' order by datetime asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise</td><td class='th1'>Distance</td><td class='th1'>MPH</td><td class='th1'>Max Heart BPM</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!--bike ride ends here-->			

<!--bench press w chart starts here-->
		<?php
		$query1 = "SELECT userid FROM `resist_exercise` WHERE exercisename='bench press' and userid='$userid'";
		$query_run = mysqli_query($con, $query1);

		if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Bench Press</h3> <?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'bench press' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='bench press' order by date asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								//attempt to add 1st set here
								$benchPress1stMax[] = $row['set1_resist'];
								$benchPress1stReps[] = $row['set1_reps'];
							
								$benchPress2ndMax[] = $row['set2_resist'];
								$benchPress2ndReps[] = $row['set2_reps'];
							
								$benchPress3rdMax[] = $row['set3_resist']; //new
								$benchPress3rdReps[] = $row['set3_reps'];
								$benchPressDateTime[] = $row['date']; //new
				}

				} ?>
				<canvas id="chartjs_bar7" height="110"></canvas>

				<?php //end new stuff here

				$query = "SELECT 'bench press' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);
				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='bench press' order by date asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th2'><td class='th2'>Exercise Name</td><td class='th2'>Set 1 Resist</td><td class='th2'>Set 1 Reps</td><td class='th2'>Set 2 Resist</td><td class='th2'>Set 2 Reps</td><td class='th2'>Set 3 Resist</td><td class='th2'>Set 3 Reps</td><td class='th2'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['date']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!--bench press w chart ends here-->
		
<!--stairmaster w chart starts here-->
			<?php

			$query1 = "SELECT userid FROM `cardio_exercise` WHERE exercisename='stairmaster' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
			
			if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Stair Climber</h3> <?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'stairmaster' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='stairmaster' order by datetime asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								$stairMasterDistance[] = $row['distance']; //new
								$stairMasterDateTime[] = $row['datetime']; //new
								$stairMasterMaxBPM[] = $row['maxheartbpm']; //new
				}

				} ?>
				<canvas id="chartjs_bar4" height="200"></canvas>

				<?php

				$query = "SELECT 'stairmaster' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='stairmaster' order by datetime asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise</td><td class='th1'>Distance</td><td class='th1'>MPH</td><td class='th1'>Max Heart BPM</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!--stairmaster ends here-->
<!--preacher curl with chart and table starts here-->
		<?php
		$query1 = "SELECT userid FROM `resist_exercise` WHERE exercisename='preacher curl' and userid='$userid'";
		$query_run = mysqli_query($con, $query1);

		if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Preacher Curl</h3> <?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'preacher curl' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='preacher curl' order by date asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								//attempt to add 1st set here
								$preacherCurl1stMax[] = $row['set1_resist'];
								$preacherCurl1stReps[] = $row['set1_reps'];
								//end attempt
								//attempt to add 2nd set here
								$preacherCurl2ndMax[] = $row['set2_resist'];
								$preacherCurl2ndReps[] = $row['set2_reps'];
								//end attempt
								$preacherCurl3rdMax[] = $row['set3_resist']; //new
								$preacherCurl3rdReps[] = $row['set3_reps']; //new
								$preacherCurlDateTime[] = $row['date']; //new
				}

				} ?>
				<canvas id="chartjs_bar8" height="110"></canvas>

				<?php //end new stuff here

				$query = "SELECT 'preacher curl' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);
				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='preacher curl' order by date asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise Name</td><td class='th1'>Set 1 Resist</td><td class='th1'>Set 1 Reps</td><td class='th1'>Set 2 Resist</td><td class='th1'>Set 2 Reps</td><td class='th1'>Set 3 Resist</td><td class='th1'>Set 3 Reps</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['date']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>

<!--preacher curl ends here-->
	
<!--Calf lift table and chart starts here -->
		<?php
			//next resist exercise
			$query1 = "SELECT userid FROM `resist_exercise` WHERE exercisename='calf lift' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
			
			if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light" id="formbg3"><center>
			<h3>Calf Lift</h3>	
			<?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'calf lift' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);
				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='calf lift' order by date asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise Name</td><td class='th1'>Set 1 Resist</td><td class='th1'>Set 1 Reps</td><td class='th1'>Set 2 Resist</td><td class='th1'>Set 2 Reps</td><td class='th1'>Set 3 Resist</td><td class='th1'>Set 3 Reps</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['date']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!--Calf lift ends here -->
<!--swim w chart starts here-->			
 <?php

			$query1 = "SELECT userid FROM `cardio_exercise` WHERE exercisename='swim' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
			
			if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Swim</h3> <?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'swim' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='swim' order by datetime asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								$swimDistance[] = $row['distance']; //new
								$swimDateTime[] = $row['datetime']; //new
								$swimMaxBPM[] = $row['maxheartbpm']; //new
				}

				} ?>
				<canvas id="chartjs_bar5" height="200"></canvas>

				<?php

				$query = "SELECT 'swim' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='swim' order by datetime asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise</td><td class='th1'>Distance</td><td class='th1'>MPH</td><td class='th1'>Max Heart BPM</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>			
<!--swim w chart ends here-->

<!--dumbbell butterfly starts here-->			
			<?php
			//next resist exercise
			$query1 = "SELECT userid FROM `resist_exercise` WHERE exercisename='dumbbell butterfly' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
			
			if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light" id="formbg3"><center>
			<h3>Preacher Curl</h3>
			<?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'dumbbell butterfly' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);
				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='dumbbell butterfly' order by date asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise Name</td><td class='th1'>Set 1 Resist</td><td class='th1'>Set 1 Reps</td><td class='th1'>Set 2 Resist</td><td class='th1'>Set 2 Reps</td><td class='th1'>Set 3 Resist</td><td class='th1'>Set 3 Reps</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['date']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!--dumbbell butterfly w chart and table starts here-->	
<!--triceps pull down w chart starts here-->			
			<?php
			$query1 = "SELECT userid FROM `resist_exercise` WHERE exercisename='triceps pull down' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
	//add new stuff here
		if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Triceps Pull Down</h3> <?php

				$query = "SELECT 'preacher curl' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='triceps pull down' order by date asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								//attempt to add 1st set here
								$tricepsPullDown1stMax[] = $row['set1_resist'];
								$tricepsPullDown1stReps[] = $row['set1_reps'];
								//end attempt
								//attempt to add 2nd set here
								$tricepsPullDown2ndMax[] = $row['set2_resist'];
								$tricepsPullDown2ndReps[] = $row['set2_reps'];
								//end attempt
								$tricepsPullDown3rdMax[] = $row['set3_resist']; //new
								$tricepsPullDown3rdReps[] = $row['set3_reps']; //new
								$tricepsPullDownDateTime[] = $row['date']; //new
				}

				} ?>
				<canvas id="chartjs_bar11" height="110"></canvas>

				<?php //end new stuff here

				$query = "SELECT 'triceps pull down' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);
				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='triceps pull down' order by date asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise Name</td><td class='th1'>Set 1 Resist</td><td class='th1'>Set 1 Reps</td><td class='th1'>Set 2 Resist</td><td class='th1'>Set 2 Reps</td><td class='th1'>Set 3 Resist</td><td class='th1'>Set 3 Reps</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['date']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			
			<?php	
			}
			?>
<!--triceps pull down w chart ends here-->

<!-- walk w chart starts here-->			
 <?php

			$query1 = "SELECT userid FROM `cardio_exercise` WHERE exercisename='walk' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
			
			if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Walk</h3> <?php
				//echo "<p>'table full'</p>";
				$query = "SELECT 'walk' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='walk' order by datetime asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								$walkDistance[] = $row['distance']; //new
								$walkDateTime[] = $row['datetime']; //new
				}

				} ?>
				<canvas id="chartjs_bar6" height="200"></canvas>

				<?php

				$query = "SELECT 'walk' FROM cardio_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, distance, mph, maxheartbpm, datetime from cardio_exercise where userID='$userid' and ExerciseName='walk' order by datetime asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise</td><td class='th1'>Distance</td><td class='th1'>MPH</td><td class='th1'>Max Heart BPM</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['distance']}</td><td>{$row['mph']}</td><td>{$row['maxheartbpm']}</td><td>{$row['datetime']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!-- walk w chart ends here-->			

<!-- incline bench press w chart starts here-->
<?php
			//next resist exercise
			$query1 = "SELECT userid FROM `resist_exercise` WHERE exercisename='incline bench press' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);

		if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Incline Bench Press</h3> <?php

				$query = "SELECT 'incline bench press' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='incline bench press' order by date asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								//attempt to add 1st set here
								$inclineBenchPress1stMax[] = $row['set1_resist'];
								$inclineBenchPress1stReps[] = $row['set1_reps'];
								//end attempt
								//attempt to add 2nd set here
								$inclineBenchPress2ndMax[] = $row['set2_resist'];
								$inclineBenchPress2ndReps[] = $row['set2_reps'];
								//end attempt
								$inclineBenchPress3rdMax[] = $row['set3_resist']; //new
								$inclineBenchPress3rdReps[] = $row['set3_reps']; //new
								$inclineBenchPressDateTime[] = $row['date']; //new
				}

				} ?>
				<canvas id="chartjs_bar14" height="110"></canvas>

				<?php //end new stuff here

				$query = "SELECT 'incline bench press' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);
				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='incline bench press' order by date asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise Name</td><td class='th1'>Set 1 Resist</td><td class='th1'>Set 1 Reps</td><td class='th1'>Set 2 Resist</td><td class='th1'>Set 2 Reps</td><td class='th1'>Set 3 Resist</td><td class='th1'>Set 3 Reps</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['date']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!--incline bench press w chart ends here-->

<!--skull crusher w chart starts here-->			
			<?php
			//next resist exercise
			$query1 = "SELECT userid FROM `resist_exercise` WHERE exercisename='skull crusher' and userid='$userid'";
			$query_run = mysqli_query($con, $query1);
	//add new stuff here
		if(mysqli_num_rows($query_run)==0) {
				//echo "<p>'table empty'</p>";
				}
			//finding rows that are true for query
			else if(mysqli_num_rows($query_run)>0)
			{ ?>
			<div class="col-xl-3.5 d-flex flex-column mx-auto rounded pt-6 text-light boogie" id="formbg3"><center>
				<h3>Skull Crusher</h3> <?php

				$query = "SELECT 'skull crusher' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);

				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='skull crusher' order by date asc";
					$result=mysqli_query($con, $query);

					while($row = mysqli_fetch_assoc($result)) {
					
								$chart_data = ""; //this is new
								//attempt to add 1st set here
								$skullCrusher1stMax[] = $row['set1_resist'];
								$skullCrusher1stReps[] = $row['set1_reps'];
								//end attempt
								//attempt to add 2nd set here
								$skullCrusher2ndMax[] = $row['set2_resist'];
								$skullCrusher2ndReps[] = $row['set2_reps'];
								//end attempt
								$skullCrusher3rdMax[] = $row['set3_resist']; //new
								$skullCrusher3rdReps[] = $row['set3_reps']; //new
								$skullCrusherDateTime[] = $row['date']; //new
				}

				} ?>
				<canvas id="chartjs_bar12" height="110"></canvas>

				<?php //end new stuff here

				$query = "SELECT 'skull crusher' FROM resist_exercise WHERE userID = '$userid'";
			    $result = mysqli_query($con, $query);
				while($row = mysqli_fetch_assoc($result)) {
				$query = "select ExerciseName, set1_resist, set1_reps, set2_resist, set2_reps, set3_resist, set3_reps, date from resist_exercise where userID='$userid' and ExerciseName='skull crusher' order by date asc";
					$result=mysqli_query($con, $query);
					
					echo"<table class='table1'>";
					echo"<tr class='th1'><td class='th1'>Exercise Name</td><td class='th1'>Set 1 Resist</td><td class='th1'>Set 1 Reps</td><td class='th1'>Set 2 Resist</td><td class='th1'>Set 2 Reps</td><td class='th1'>Set 3 Resist</td><td class='th1'>Set 3 Reps</td><td class='th1'>Date</td></tr>";
					while($row = mysqli_fetch_assoc($result)) {
						echo"<tr><td>{$row['ExerciseName']}</td><td>{$row['set1_resist']}</td><td>{$row['set1_reps']}</td><td>{$row['set2_resist']}</td><td>{$row['set2_reps']}</td><td>{$row['set3_resist']}</td><td>{$row['set3_reps']}</td><td>{$row['date']}</td></tr>";
				}
				echo"</table>";
				} ?>
				</center>
			</div>
			<?php	
			}
			?>
<!--skull crusher w chart ends here-->
</div>   
  <!--footer-->

<!--,
<div class="footer">
  <div class="container">
    <p>&copy; Fitness Tracker 2023</p>
  </div>
</div>-->

  <!-- Bootstrap's JavaScript Files -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($dateTime); ?>, 
            datasets: [
              { 
                label: "Miles",
                
                data: <?php echo json_encode($runDistance);?>,
               // spanGaps: true,
              // yAxisID: 'miles',
                backgroundColor: "rgba(255, 159, 64, 1)",
               yAxisID: 'B',

              },{ 
                label: "Max HeartBPM",
                
                data: <?php echo json_encode($maxBPM);?>,
               // spanGaps: true,
              // yAxisID: 'mbpm',
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
              
             ],
          },
        options:{
            scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },
              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'sans-serif',
                      fontSize: 14,
                  }
              },
              
          }
      });
      
    </script>
        <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar2").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($ellipticalDateTime); ?>, 
            datasets: [
              { 
                label: "Miles",
                
                data: <?php echo json_encode($ellipticalDistance);?>,
                backgroundColor: "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },{ 
                label: "Max HeartBPM",
                
                data: <?php echo json_encode($ellipticalMaxBPM);?>,
               // spanGaps: true,
              // yAxisID: 'mbpm',
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
             ],
          },
          options:{
            scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },
              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'sans-serif',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar3").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($bikeRideDateTime); ?>, 
            datasets: [
              { 
                label: "Miles",
                data: <?php echo json_encode($bikeRideDistance);?>, 
                backgroundColor: "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },{ 
                label: "Max HeartBPM",
                data: <?php echo json_encode($bikeRideMaxBPM);?>,
               // spanGaps: true,
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
             ],
          },
          options:{
                scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },

              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'sans-serif',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar4").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($stairMasterDateTime); ?>, 
            datasets: [
              { 
                label: "Miles",
                
                data: <?php echo json_encode($stairMasterDistance);?>,//$stairMasterMaxBPM
                backgroundColor: "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },{ 
                label: "Max HeartBPM",
                
                data: <?php echo json_encode($stairMasterMaxBPM);?>,
               // spanGaps: true,
              // yAxisID: 'mbpm',
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              }
             ],
          },
          options:{
                scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },

              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'Circular Std Book',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar5").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($swimDateTime); ?>, //$swimMaxBPM
            datasets: [
              { 
                label: "Miles",
                
                data: <?php echo json_encode($swimDistance);?>,
               // spanGaps: true,
              // yAxisID: 'miles',
                backgroundColor: "rgba(255, 159, 64, 1)",
               yAxisID: 'B',

              },{ 
                label: "Max HeartBPM",
                
                data: <?php echo json_encode($swimMaxBPM);?>,
               // spanGaps: true,
              // yAxisID: 'mbpm',
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
              
             ],
          },
          //

          //
          options:{
                scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },

              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'sans-serif',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
        <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar6").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($walkDateTime); ?>, 
            datasets: [
              { 
                label: "Miles",
                
                data: <?php echo json_encode($walkDistance);?>,
                backgroundColor: "rgba(255, 159, 64, 1)",
              },
             ],
          },
          options:{
              scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },

              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'Circular Std Book',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar7").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($benchPressDateTime); ?>, 
            datasets: [
                                { 
                label: "1st set lbs",
                
                data: <?php echo json_encode($benchPress1stMax);?>, 
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },{ 
                label: "1st set reps",
                
                data: <?php echo json_encode($benchPress1stReps);?>, //$benchPress1stReps
                backgroundColor: 
                    "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
                { 
                label: "2nd set LBs",
                
                data: <?php echo json_encode($benchPress2ndMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                    yAxisID: 'B',
              },{ 
                label: "2nd set reps",
                
                data: <?php echo json_encode($benchPress2ndReps);?>, //$benchPress1stReps
                backgroundColor: 
                    "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
              { 
                label: "3rd set LBs",
                
                data: <?php echo json_encode($benchPress3rdMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },
              { 
                label: "3rd set reps",
                
                data: <?php echo json_encode($benchPress3rdReps);?>, //$benchPress1stReps
                backgroundColor: 
                    "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },

             ],
          },
          options:{
              scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                               max: 25
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },

              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'sans-serif',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar11").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($tricepsPullDownDateTime); ?>, 
            datasets: [
                                { 
                label: "1st set lbs",
                
                data: <?php echo json_encode($tricepsPullDown1stMax);?>, 
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },{ 
                label: "1st set reps",
                
                data: <?php echo json_encode($tricepsPullDown1stReps);?>, //$benchPress1stReps
                backgroundColor: 
                    "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
                { 
                label: "2nd set LBs",
                
                data: <?php echo json_encode($tricepsPullDown2ndMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                    yAxisID: 'B',
              },{ 
                label: "2nd set reps",
                
                data: <?php echo json_encode($tricepsPullDown2ndReps);?>, //$benchPress1stReps
                backgroundColor: 
                    "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
              { 
                label: "3rd set LBs",
                
                data: <?php echo json_encode($tricepsPullDown3rdMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },
              { 
                label: "3rd set reps",
                
                data: <?php echo json_encode($tricepsPullDown3rdReps);?>, //$benchPress1stReps
                backgroundColor: 
                    "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },

             ],
          },
          options:{
              scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                               max: 25
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },

              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'sans-serif',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar8").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($preacherCurlDateTime); ?>,  
            datasets: [
                                { 
                label: "1st set lbs",
                
                data: <?php echo json_encode($preacherCurl1stMax);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },{ 
                label: "1st set reps",
                
                data: <?php echo json_encode($preacherCurl1stReps);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
                { 
                label: "2nd set lbs",
                
                data: <?php echo json_encode($preacherCurl2ndMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                    yAxisID: 'B',
                
              },{
            label: "2nd set reps",
                
                data: <?php echo json_encode($preacherCurl2ndReps);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
              { 
                label: "3rd set lbs",
                
                data: <?php echo json_encode($preacherCurl3rdMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                    yAxisID: 'B',
              },{
               label: "3rd set reps",
                
                data: <?php echo json_encode($preacherCurl3rdReps);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },

             ],
          },
          options:{
              scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                               max: 25
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },

              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'Sans-serif',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar12").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($skullCrusherDateTime); ?>,  
            datasets: [
                                { 
                label: "1st set lbs",
                
                data: <?php echo json_encode($skullCrusher1stMax);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },{ 
                label: "1st set reps",
                
                data: <?php echo json_encode($skullCrusher1stReps);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
                { 
                label: "2nd set lbs",
                
                data: <?php echo json_encode($skullCrusher2ndMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                    yAxisID: 'B',
                
              },{
            label: "2nd set reps",
                
                data: <?php echo json_encode($skullCrusher2ndReps);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
              { 
                label: "3rd set lbs",
                
                data: <?php echo json_encode($skullCrusher3rdMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                    yAxisID: 'B',
              },{
               label: "3rd set reps",
                
                data: <?php echo json_encode($skullCrusher3rdReps);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },

             ],
          },
          options:{
              scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                               max: 25
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },

              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'Sans-serif',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
    <script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar14").getContext('2d');
      var myChart = new Chart(ctx,{
          type: 'bar',
          data: {
        
            labels:<?php echo json_encode($inclineBenchPressDateTime); ?>,  
            datasets: [
                                { 
                label: "1st set lbs",
                
                data: <?php echo json_encode($inclineBenchPress1stMax);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(255, 159, 64, 1)",
                yAxisID: 'B',
              },{ 
                label: "1st set reps",
                
                data: <?php echo json_encode($inclineBenchPress1stReps);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
                { 
                label: "2nd set lbs",
                
                data: <?php echo json_encode($inclineBenchPress2ndMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                    yAxisID: 'B',
                
              },{
            label: "2nd set reps",
                
                data: <?php echo json_encode($inclineBenchPress2ndReps);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },
              { 
                label: "3rd set lbs",
                
                data: <?php echo json_encode($inclineBenchPress3rdMax);?>,
                backgroundColor: 
                    "rgba(255, 159, 64, 1)",
                    yAxisID: 'B',
              },{
               label: "3rd set reps",
                
                data: <?php echo json_encode($inclineBenchPress3rdReps);?>, //$preacherCurl1stReps
                backgroundColor: "rgba(179, 179, 179, 0.8)",
                yAxisID: 'A',
              },

             ],
          },
          options:{
              scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                              //  labelString: 'Month'
                            }
                        }],
                    yAxes: [{
                            id: 'A',
                            display: true,
                           position: 'left',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                               max: 25
                            }
                        }, {
                            id: 'B',
                            display: true,
                           position: 'right',
                            ticks: {
                                beginAtZero: true,
                               // steps: 10,
                            //    stepValue: 1,
                              //  max: 10
                            }
                        }]
                },

              legend:   {
                  display:true,
                  position:'bottom',
                  labels: {
                      fontColor: '#71748d',
                      fontFamily: 'Sans-serif',
                      fontSize: 14,
                  }
              },
              
          }
      });
    </script>
</body>
</html>
