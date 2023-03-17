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
  <title>Login</title>
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
        <li class="nav-item active">
          <a class="nav-link" href="#">Login<span class="sr-only">(current)</span></a>
        </li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      </ul>
    </div>
  </nav>


  <div class="main">
    <div class="container">
      <div class="row">
        <div class="col-10 mx-auto rounded pt-6 text-light" id="formbg"">
        <h1>Registration Successful! Please Login!</h1>
        <h6><span class="font-weight-light">For Demonstration Please Login with </span><span class="font-weight-bold">Username: user@demo.com</span><span class="font-weight-light"> and </span><span class="font-weight-bold">Password: Pa55word!</span> Feel free to add new entries</h6>
          <form class="myform" action="newuserlogin.php" method="POST">
            <div class="form-group">
              <label for="ExampleInputEmail1" id="login_email" class="login">Email Address</label>
              <input name= "email" type="email" class="form-control" id="ExampleInputEmail1" placeholder="email">
              </div>
			  <!--<label class="login" id="login_email"><b>Email (Username)</b></label><br>
			<input name="username" type="text" class="inputvalues" placeholder="Type your email" required/><br>-->
            <div class="form-group">
              <label class="login" for="ExampleInputPassword1">Password</label>
              <input name="password" type="password" class="form-control" id="ExampleInputPassword1" placeholder="password" required>
			 <!--<label class="login"><b>Password</b></label><br>
		     <input name="password" type="password" class="inputvalues" placeholder="Type your password" required/><br>-->
              </div>
            <input name="login" class="btn" type="submit" id="login_btn" value="Login"/><a href="#" ></a>
			<!--<input name="login" class="inputvalues" type="submit" id="login_btn" value="Login"/><br>
		    <a href="register.php"><input type="button" id="register_btn" value="Register"/></a>-->
          </form>
        </div>
      </div>
    </div>
	<?php if(isset($_POST['login']))
			{ 
			    
				$email = $_POST['email'];
				$password = $_POST['password'];
				$encrypted_password = md5($password);
				//$encrypted_username = md5($username);
				$_SESSION['email'] = $email; //$_POST['username'];

				$query = "select * from user WHERE email='$email' AND password='$encrypted_password'"; 

				$query_run = mysqli_query($con, $query);

					if(mysqli_num_rows($query_run)>0)
					            {
									header('location:home.php');
								}
								else
								{
									//invalid
									echo '<script type="text/javascript">alert("Invalid credentials")</script>';
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
