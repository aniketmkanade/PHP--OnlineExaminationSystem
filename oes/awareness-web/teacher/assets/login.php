<?php 
include('dbconfig.php');
if(isset($_REQUEST['login']))
{
	if($_REQUEST['ddl_user'] == 'student')
	{
		$result = executeQuery("SELECT * FROM student where login_name='".$_REQUEST['uname']."' and password='".$_REQUEST['pwd']."'");
		if(mysqli_num_rows($result) > 0) 
		{
			while($r = mysqli_fetch_array($result))
			{
				$_SESSION['studId'] = $r['userid'];
				header('location:Welcome.php');
			}
		}
		else
		{
			echo"<script>alert('rows not found')</script>";	
		}
	}
	else if($_REQUEST['ddl_user'] == 'teacher')
	{
		$result = executeQuery("SELECT * FROM `teacher` where loginname='".$_REQUEST['uname']."' and password='".$_REQUEST['pwd']."'");
		if(mysqli_num_rows($result) > 0) 
		{
			while($r = mysqli_fetch_array($result))
			{
				$_SESSION['studId'] = $r['teacherid'];
				header('location:Welcome.php');
			}
		}
		else
		{
			echo"<script>alert('rows not found')</script>";	
		}
	}
	else
	{
		echo"<script>alert('Invalid user')</script>";
	}
}
else if(isset($_REQUEST['reg']))
{
	HEADER('location:registration.php');
}
?>
<div class="login">
	<form action="" method="post">
	<label class="sr-only" for="UserReg_Uname">User</label>
	<select id="ddl_user" name="ddl_user" class="form-control">
	<option selected value="<Choose the Subject>">&lt;Choose the User&gt;</option>
	<option value="student"> Student </option>
	<option value="teacher"> Teacher </option>
	<input type="text" name="uname" placeholder="Username..">		
	<input type="text" name="pwd" placeholder="Password....">
	<br>
	<input type="submit" name="login" value="Login">
	<input type="submit" name="reg" id="reg" value="Register"><br>
	<a href="forgotpassword.php" style="font-size:20px" id="fp" name="fp">Forgot Password </a>
	</form>	
</div>