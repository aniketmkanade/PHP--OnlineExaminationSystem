<?php 
include('assets/header.php');
?>
<div class="page-header text-center">
	<h2 style="color:red">Forgot Password</h2>
</div>
<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<div class="contact">
			<div class="container">
				<div class="contact-grids">
					<div class="contact-form">
						<h3>Regain Password for Teacher: </h3>
							<form method="post">
								<div class="col-md-6 contact-bottom">
									<div class=" in-contact">
										<input type="text" id="txt_email_id" name="txt_email_id" placeholder="Email Id">
									</div>
								</div>
								<div class="send-top" style="position:absolute;top:200px;left:200px">
									<label class="hvr-rectangle-out">
										<input type="submit" id="btn_rp" name="btn_rp" value="Regain Password">
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
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include('assets/footer.php')?>
<?php
if(isset($_REQUEST['btn_rp']))
{
	if($result = executeQuery("SELECT  `password` FROM `teacher` WHERE email = '".$_REQUEST['txt_email_id']."'"))
	{
		if(mysqli_num_rows($result) > 0)
		{
			if($r = mysqli_fetch_assoc($result))
			{
				echo"<script>alert('Your Password is ".$r['password']."')</script>";
			}
		}
		else
		{
		echo"<script>alert('No such Email Id Found...!!! ')</script>";
		}
	}
	else
	{
		echo "Query not executed";
	}
}
?>