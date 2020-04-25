<?php 
include('assets/header.php');
if(!isset($_SESSION['studId']))
	{
		header('location:index.php');
	}
?>
<div class="page-header text-center">
	<h2 style="color:red">Change Password</h2>
</div>
<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<div class="contact">
			<div class="container">
				<div class="contact-grids">
					<div class="contact-form">
						<h3>Password: </h3>
							<form method="post">
								<div class="col-md-6 contact-bottom">
									<div class=" in-contact">
										<input type="text" id="txt_login_name" name="txt_login_name" placeholder="Login Name">
									</div>
									<div class=" in-contact">
										<input type="text" id="txt_currp" name="txt_currp" placeholder="Current Password">
									</div>
									<div class=" in-contact">
										<input type="text" id="txt_cp" name="txt_cp" placeholder="Change Password">
									</div><br>
									<div class=" in-contact">
										<input type="text" id="txt_rcp" name="txt_rcp" placeholder="Rewrite Change Password">
									</div><br>
								</div>
								<div class="send-top" style="position:absolute;top:420px;left:200px">
									<label class="hvr-rectangle-out">
										<input type="submit" id="btn_cp" name="btn_cp" value="Change Password">
									</label>
								</div>
							</form>
					</div>			
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
	</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include('assets/footer.php')?>
<?php
if(isset($_REQUEST['btn_cp']))
{
	if($_REQUEST['txt_cp'] == $_REQUEST['txt_rcp'])
	{
		if($result =(executeQuery("SELECT `teacherid`, `loginname`, `password` FROM `teacher` WHERE 
		teacherid = '".$_SESSION['studId']."'")))
		{
			if(mysqli_num_rows($result) > 0)
			{
				if($r = mysqli_fetch_array($result))
				{
					if($r['loginname'] == $_REQUEST['txt_login_name'])
					{
						if($r['password'] == $_REQUEST['txt_currp'])
						{
							$result2 = (executeQuery("UPDATE `teacher` SET `password`='".$_REQUEST['txt_cp']."'  WHERE 
							teacherid =".$_SESSION['studId']));
							echo "<script>alert('Congratulation Password Changed...!!!')</script>";
						}
						else
						{
							echo "<script>alert('Old Password Don\'t match')</script>";
						}
					}
					else
					{
						echo "<script>alert('Login Name Don\'t match')</script>";
					}
				}
				else
				{
					echo "<script>alert('Login Name Don\'t match')</script>";
				}
			}
			else
				{
					echo "<script>alert('Login Name Don\'t match')</script>";
				}
		}
		else
				{
					echo "<script>alert('Login Name Don\'t match')</script>";
				}
	}
	else
	{
		echo "<script>alert('Changed Password Don\'t match')</script>";
	}
}
?>