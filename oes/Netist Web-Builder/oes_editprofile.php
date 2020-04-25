<?php include_once("assets/includes/header.inc");
include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
?>
<!-- Page Wrapper Design  -->
<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-3">
			</div>
			<div class="col-lg-6">
				<form role="form">
					<div class="form-group">
						<label>User Name</label>
						<input id="txt_user_name" name="txt_user_name" class="form-control">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input id="txt_password" name="txt_password" class="form-control">
					</div>
					<div class="form-group">
						<label>Email-ID</label>
						<input id="txt_email_id" name="txt_email_id" class="form-control">
					</div>
					<div class="form-group">
						<label>Contact No.</label>
						<input id="txt_contact_no" name="txt_contact_no" class="form-control">
					</div>
					<div class="form-group">
						<label>Address</label>
						<input id="txt_address" name="txt_address" class="form-control">
					</div>
					<div class="form-group">
						<label>City</label>
						<input id="txt_city" name="txt_city" class="form-control">
					</div>
					<div class="form-group">
						<label>Pincode</label>
						<input id="txt_pincode" name="txt_pincode" class="form-control">
					</div>
					<input type="submit" id="update" name="update" value="update" class="btn btn-default" />
				</form>
			</div>
			<div class="col-lg-3">
			</div>
		</div>
	</div>
<?php include_once("assets/includes/footer.inc"); ?>	
<!-- JavaScript Code  -->
<?php
if(isset($_REQUEST["update"]))
{
	$query = "UPDATE `student` SET `stdname`='".$_REQUEST['txt_user_name']."',`stdpassword`='".$_REQUEST['txt_password']."',
	`emailid`='".$_REQUEST['txt_email_id']."',`contactno`='".$_REQUEST['txt_contact_no']."',`address`='".$_REQUEST['txt_address']."',
	`city`='".$_REQUEST['txt_city']."',`pincode`='".$_REQUEST['txt_pincode']."' WHERE ";//doubt
	echo $query;
	if($result = (executeQuery($query)))
	{
		echo "update successful";
	}
	else
	{
		echo"Query not fired";
	}
}	 
else
{
//echo"<script>alert('button not pressed...!!!')</script>";	
}
closedb;	
?>