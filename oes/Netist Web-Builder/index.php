<?php
include 'dbconfig.php';
	if(!session_start())
	{
		session_start();
	}
	if(isset($_SESSION['instid']))
	{
		echo "<script>location='oes_dashboard.php'</script>";
	}

if(isset($_POST['btn_login']))
{       
    //$UserReg_id=$_POST['UserReg_id'];
	$instituteloginname=$_POST['UserReg_Uname'];
	$institutepassword=$_POST['UserReg_Upass'];
   
	if($result=executeQuery("SELECT `instid`, `institutename`,`emailid`, `instituteloginname`, `institutepassword` FROM  `institute` where instituteloginname = '$instituteloginname' and institutepassword='$institutepassword' and isactive = 1 "))
	{
		if($result->num_rows > 0)
		{   
            while ($row=mysqli_fetch_array($result))
            {
					$_SESSION['instid']=$row["instid"];
					$_SESSION['UserID']=0;
					$_SESSION['UserName']="Admin";
                  echo "<script>location='oes_dashboard.php'</script>";
            }
        }
		else
			echo "<script language='javascript'> alert('Invalide Username or Passaword')</script>";
	}
	/*else if($result=mysqli_query($con, "SELECT `instid`, `institutename`,`emailid`, `instituteloginname`, `institutepassword` FROM  `institute` where instituteloginname = '$instituteloginname' and institutepassword='$institutepassword' and isactive = 1 "))
	{
		if(mysqli_num_rows($result)!=NULL)
		{   
            while ($row=mysqli_fetch_array($result))
            {
					$_SESSION['instid']=$row["instid"];
					$_SESSION['institutename']=$row["institutename"];
					$_SESSION['emailid']=$row["emailid"];
					
					$_SESSION['User']=0;
					$_SESSION['UserName']="Admin";
                  echo "<script>location='oes_dashboard.php'</script>";
            }
        }
		else
			echo "<script language='javascript'> alert('Invalide Username or Passaword')</script>";
	}*/
	else{
		//	echo "<script language='javascript'> alert('".mysqli_error($conn)."')</script>";
		echo "<script language='javascript'> alert('Invalide Username or Passaword')</script>";
	}
}
if(isset($_POST['btn_reg']))
{
	HEADER('location:index_reg.php');
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Login Form Template</title>
		<!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/login/form-elements.css">
        <link rel="stylesheet" href="css/login/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
	</head>
	<body>

        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Admin Panel</strong> Login Form</h1>
                            <div class="description">
                            	<p>
	                            	Feel free to customize and use your own web-site...
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
									<div class="form-group">
			                    		<label class="sr-only" for="UserReg_Uname">Username</label>
			                        	<input type="text" name="UserReg_Uname" placeholder="Username..." class="form-username form-control" id="UserReg_Uname">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="UserReg_Upass">Password</label>
			                        	<input type="password" name="UserReg_Upass" placeholder="Password..." class="form-password form-control" id="UserReg_Upass">
			                        </div>
			                        <button type="submit" class="btn" id="btn_login" name="btn_login">Sign in!</button><br><br>
									<button type="submit" class="btn" id="btn_reg" name="btn_reg">Register</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>Developed By <a href="http://www.netistsolutions.com">Netist Solutions, Aurangabad</a></h3>
							<span> To know about us please visit...</span>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-1 btn-link-1-facebook" href="http://www.facebook.com/netistsolutions">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-1 btn-link-1-twitter" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-1 btn-link-1-google-plus" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
	                        	</a>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>