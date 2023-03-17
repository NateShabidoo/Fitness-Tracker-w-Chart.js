<?php
session_start();
require 'database/config.php';
ob_start();

 ?>

<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> SimpleChartsRI</title>
        
        <link href="style/ui.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
        <link href="main/ui.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/c114fc14ef.js" crossorigin="anonymous"></script>


        <!-- For Saving Files -->
        <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.2/dist/FileSaver.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.2.0/papaparse.min.js"></script>
    </head>
    
    
    <body>
        
        <div class="login-logo">
			<a class="logo" href="index.php">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" class="" viewBox="0 0 16 16">
					<rect x="5" y="3.71436" width="3" height="9.28571" fill="#52A5F7"/>
					<rect y="7.42847" width="3" height="5.57143" fill="#52A5F7"/>
					<rect x="10" width="3" height="13" fill="#52A5F7"/>
				</svg>
				<div class="Bold-h6">
					<span style="color: black">SimpleCharts</span><span style="color: #52A5F7">RI</span>
				</div>
			</a>            
        </div>
        
        <div class="row">
            <div class="col-7 login-sidebar">
                <img style="height:100vh" src="./images/slidebar1.png""> 
            </div>
            
            <div class="col-md-5" style="margin: auto; padding: 0 48px">
            
            	<div class="login-container">
            	
                	<form class="loginForm" style="gap:16px" action="login.php" method="POST">
                	    <div class="Bold-h1">Wecome back!</div>
                	    
                	    <div class="w-100">
                    		<label>Email</label>
                    		<div class="input-icons">
                                <i class="fa-solid fa-envelope Primary-05 icon"></i>
                    		    <input name="username" type="text" placeholder="Type your email" required/>
                		    </div>
                		</div>

                	    <div class="w-100">
                		    <label>Password</label>
                    		<div class="input-icons">
                                <i class="fa-solid fa-lock Primary-05 icon"></i>
                	    	    <input name="password" type="password" placeholder="Type your password" required/>
                		    </div>
                		</div>
                		
                    	<div class="d-flex justify-content-between w-100"> 
                            <span class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </span>
                            <a class="Primary-05 my-auto" href="resetpassword.php" id="reset_password">Forgot Password?</a>
                		</div>
                		<div class="w-100">
                		    <input name="login" class="Btn-primary Btn-large w-100" type="submit" id="login_btn" value="Login">
                		</div>
                		<div class="d-flex justify-content-center w-100">
                		    <a class="Primary-05 m-auto" href="register.php">Don't have an account? Register here.</a>
                		</div>
            	    </form>
            	
                <?php if(isset($_POST['login']))
            			{ 
            			    
            				$username = $_POST['username'];
            				$password = $_POST['password'];
            				$encrypted_password = md5($password);
            				$encrypted_username = md5($username);
            				$_SESSION['username'] = $username; //$_POST['username'];
            
            				$query = "select * from users WHERE username='$username' AND password='$encrypted_password'";
            
            				$query_run = mysqli_query($conn, $query);
            
            					if(mysqli_num_rows($query_run)>0)
            					            {
            									header('location:index.php');
            								}
            								else
            								{
            									//invalid
            									echo '<script type="text/javascript">alert("Invalid credentials")</script>';
            								}
            			}
            						?>
            	</div>
            </div>
            
        </div>


    </body>
    
</html>
