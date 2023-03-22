<?php
session_start();
require 'dbconfig/config.php';
ob_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link href="css/css.css" rel="stylesheet" type="text/css">
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
          <a class="nav-link" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Register<span class="sr-only">(current)</span></a>
      </li>
      </ul>
    </div>
  </nav>


  <div class="main">
    <div class="container">
      <div class="row">
        <div class="col-10 mx-auto rounded pt-6 text-light" id="formbg"">
        <h1>Join Fitness Tracker for Free!</h1>
        <h6><span class="font-weight-light">For Demonstration Please Login with </span><span class="font-weight-bold">Username: user@demo.com</span><span class="font-weight-light"> and </span><span class="font-weight-bold">Password: Pa55word!</span> Feel free to add new entries!</h6>
          <!--<form>-->
		  <form class="myform" action="register.php" method="post">
         <!--   <div class="form-group">
             <label for="ExampleInputFirst-name1 ">First Name</label>
              <input type="first-name" name="fname" class="form-control" id="ExampleInputfirst-name1" placeholder="first-name">
              </div>
            <div class="form-group">
              <label for="ExampleInputLast-name1">Last Name</label>
              <input type="Last-name" name="lname" class="form-control" id="ExampleInputlate-name1" placeholder="last-name">
              </div> -->
            <div class="form-group">
              <label for="ExampleInputEmail1">Email Address</label>
              <input type="text" name="email" class="form-control" id="ExampleInputEmail1" placeholder="email" required>
              </div>
		<!--<label><b>User Name</b></label><br>
		<input name="username" type="text" class="inputvalues" placeholder="Type your username" required/><br>-->
            <div class="form-group">
              <label for="ExampleInputPassword1">Password (Passwords are Encrypted)</label>
              <input type="password" name="password" class="form-control" id="ExampleInputPassword1" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[!@#$%^&*+`~'=?\|\]\[\(\)\-<>/]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, one special character ~`!@#$%^*()_=+[]{}:.,\|/?&;- and at least 8 or more characters" required>
              </div>
	    <!--<label><b>Password</b></label><br>
		<input name="password" type="password" class="inputvalues" placeholder="Your password" required/><br>-->
			 <div class="form-group">
              <label for="ExampleInputPassword1">Confirm Password</label>
              <input type="password" name="cpassword" class="form-control" id="ExampleInputPassword1" placeholder="password" required>
              </div>

		<input name="submit_btn" class="btn" type="submit" id="submit_btn" value="Create Account"/><a href="login.php"></a><br>

          </form>
        </div>
      </div>
    </div>
  </div>
  <div>
  	<?php 
		if(isset($_POST['submit_btn']))
		{
			//echo '<script type="text/javascript"> alert("Sign up button clicked") </script>';
			
			$email = $_POST['email'];
			$password = $_POST['password'];
			$cpassword = $_POST['cpassword'];
			
			
			if($password == $cpassword){
                                    
                                    $encrypted_password = md5($password);
									$query = "select * from user WHERE email='$email'";
									$query_run = mysqli_query($con, $query);

									//finding rows that are true for query
									if(mysqli_num_rows($query_run)>0)
									{	
										//exisiting user with same username found
										echo ('<script type="text/javascript">alert("User already exists, try another username")</script>');
									} 

									else
									{

										//everyting went smoothly...entering user in database!
										$query = "insert into user values ('$email', '', '', '$encrypted_password', '')";
										$query_run = mysqli_query($con,$query);

										if($query_run)

										{
											//echo ('<script type="text/javascript">alert("User registered! Try to log in.")</script>');
											 header('location:newuserlogin.php');
										}

										else
										{
											echo ('<script type="text/javascript">alert("Something went wrong!")</script>');	
										}
									}
								}

								else
									{
										//goofed up...passwords didn't match
										echo ('<script type="text/javascript">alert("Passwords do not match! Try again!")</script>');
									}
							}
		
	?>
  </div>


  <!-- Bootstrap's JavaScript Files -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
