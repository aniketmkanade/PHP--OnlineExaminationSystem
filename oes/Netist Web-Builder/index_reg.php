<?php
include 'dbconfig.php';
	if(!session_start())
	{
		session_start();
	}
	//if(isset($_SESSION['instid']))
	//{
		//echo "<script>location='oes_dashboard.php'</script>";
	//}
	
if(isset($_POST['btn_reg']))
{       
	if($result=executeQuery("INSERT INTO `institute`(`institutename`,`address`, `contactno`, `emailid`, `instituteloginname`, `institutepassword`) VALUES ('".$_REQUEST['txt_inst_name']."','".$_REQUEST['txt_address']."','".$_REQUEST['txt_contact_no']."','".$_REQUEST['txt_email_id']."','".$_REQUEST['txt_admin_login_name']."','".$_REQUEST['txt_admin_password']."')"))
	{
		HEADER('location:index.php');
		echo "<script language='javascript'> alert('Institute Registeration Successful...!')</script>";
	}
	else
	{
		echo "<script language='javascript'> alert('Institute Registeration Unsuccessful')</script>";
	}
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
                            <h1><strong>Admin Panel</strong> Registeration Form</h1>
                            <div class="description">
                            	<p>
	                            	Feel free to customize and use your own web-site...
                            	</p>
                            </div>
                        </div>
						<div class="col-sm-2">
						</div>
						<div class="col-sm-2 text">
						<?php
						echo date("l, ");
						?>
						<br>
						<?php
						echo date("jS F Y, h:i:s A");
						?>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Register to our site</h3>
                            		<p>Enter your Details to Register:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
									<div class="form-group">
			                    		<label class="sr-only" for="UserReg_Uname">Institute Name</label>
			                        	<input type="text" name="txt_inst_name" placeholder="Institute Name..." class="form-username form-control" id="txt_inst_name">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="UserReg_Upass">Address</label>
			                        	<input type="text" name="txt_address" placeholder="Address..." class="form-password form-control" id="txt_address">
			                        </div>
									<div class="form-group">
			                    		<label class="sr-only" for="UserReg_Uname">Contact Number</label>
			                        	<input type="number" name="txt_contact_no" placeholder="  Contact No..." class="form-username form-control" id="txt_contact_no">
			                        </div>
									<div class="form-group">
			                    		<label class="sr-only" for="UserReg_Uname">Email ID</label>
			                        	<input type="email" name="txt_email_id" placeholder="  Email..." class="form-username form-control" id="txt_email_id">
			                        </div>
									<div class="form-group">
			                    		<label class="sr-only" for="UserReg_Uname">Admin Login Name</label>
			                        	<input type="text" name="txt_admin_login_name" placeholder="Username..." class="form-username form-control" id="txt_admin_login_name">
			                        </div>
									<div class="form-group">
			                    		<label class="sr-only" for="UserReg_Uname">Admin Password</label>
			                        	<input type="password" name="txt_admin_password" placeholder="Password..." class="form-username form-control" id="txt_admin_password">
			                        </div>
			                        <button type="submit" class="btn" id="btn_reg" name="btn_reg">Register!</button>
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