<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
?>	
<?php
	$uniqueregno = "";
	$institutename = "";
	$ownername = "";
	$mobilenumber = "";
	$website = "";
	$registerationno = "";
	$registerationdate = "";
	$instituteloginname = "";
	$address = "";
	$contactno = "";
	$emailid = "";
	$instituteloginname = "";
	$institutepassword = "";
	$query="SELECT * FROM `institute` where instid=".$_SESSION['instid'];
		if($result = (executeQuery($query)))
		{				
			if($result->num_rows > 0 && $r = mysqli_fetch_array($result))
			{
				$uniqueregno = $r['unique_reg_no'];
				$institutename = $r['institutename'];
				$ownername = $r['ownername'];
				$mobilenumber = $r['mobileno'];
				$website = $r['website'];
				$registerationno = $r['regno'];
				$registerationdate = $r['regdate'];
				$instituteloginname = $r['instituteloginname'];
				$address = $r['address'];
				$contactno = $r['contactno'];
				$emailid = $r['emailid'];
				$instituteloginname = $r['instituteloginname'];
				$institutepassword = $r['institutepassword'];
			}
			else 
				echo"<script>alert('Data Not found...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Data Not found...!!!')</script>";
		}
if(isset($_REQUEST["btn_update"]))
{
	$query = "UPDATE `institute` SET
	`unique_reg_no`='".$_REQUEST['txt_unique_reg_no']."',
	`institutename`='".$_REQUEST['txt_institute_name']."',
	`ownername`='".$_REQUEST['txt_owner_name']."',
	`address`='".$_REQUEST['txt_address']."',
	`contactno`='".$_REQUEST['txt_contact_no']."',
	`mobileno`='".$_REQUEST['txt_mobile_no']."',
	`emailid`='".$_REQUEST['txt_email_id']."',
	`website`='".$_REQUEST['txt_website']."',
	`regno`='".$_REQUEST['txt_registration_no']."',
	`regdate`='".$_REQUEST['txt_registration_date']."',
	`instituteloginname`='".$_REQUEST['txt_institute_login_name']."',
	`institutepassword`='".$_REQUEST['txt_institute_password']."',
	`isactive`='".$_REQUEST['txt_is_active']."'
	WHERE instid=".$_SESSION['instid'];
	
	if($result = (executeQuery($query)))
	{
		echo "<script>alert('Congatulation Registration Completed');</script>";
	}
	else
	{
		echo "<script>alert('Query not fired...!!!');</script>";
	}
}	
?>
<!---------------------------------------------- Page Wrapper Design --------------------------------------------->
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-3">
		</div>
		<div class="col-lg-6">
			<h1>Institute Registration</h1><br>
			<form method="get" action="#">
				<div class="form-group">
					<label>Unique REG No</label>
					<input id="txt_unique_reg_no" name="txt_unique_reg_no" class="form-control" value="<?php echo $uniqueregno ?>">
				</div>
				<div class="form-group">
					<label>Institute name</label>
					<input id="txt_institute_name" name="txt_institute_name" class="form-control" value="<?php echo $institutename ?>">
				</div>
				<div class="form-group">
					<label>Owner Name</label>
					<input id="txt_owner_name" name="txt_owner_name" class="form-control" value="<?php echo $ownername ?>">
				</div>
				<div class="form-group">
					<label>Address</label>
					<input id="txt_address" name="txt_address" class="form-control" value="<?php echo $address ?>">
				</div>
				<div class="form-group">
					<label>Contact Number</label>
					<input id="txt_contact_no" name="txt_contact_no" class="form-control" value="<?php echo $contactno ?>">
				</div>
				<div class="form-group">
					<label>Mobile Number</label>
					<input id="txt_mobile_no" name="txt_mobile_no" class="form-control" value="<?php echo $mobilenumber ?>">
				</div>
				<div class="form-group">
					<label>Email ID</label>
					<input id="txt_email_id" name="txt_email_id" class="form-control" value="<?php echo $emailid ?>">
				</div>
				<div class="form-group">
					<label>Website</label>
					<input id="txt_website" name="txt_website" class="form-control" value="<?php echo $website ?>">
				</div>
				<div class="form-group">
					<label>Registration No</label>
					<input id="txt_registration_no" name="txt_registration_no" class="form-control" value="<?php echo $registerationno ?>">
				</div>
				<div class="form-group">
					<label>Registration Date</label>
					<input type="date" id="txt_registration_date" name="txt_registration_date" class="form-control" value="<?php echo $registerationdate ?>">
				</div>
				<div class="form-group">
					<label>Institiue Admin Login Name</label>
					<input id="txt_institute_login_name" name="txt_institute_login_name" disabled class="form-control" value="<?php echo $instituteloginname ?>">
				</div>
				<div class="form-group">
					<label>Institiue Admin Password</label>
					<input type="password" id="txt_institute_password" name="txt_institute_password" disabled class="form-control"
					value="<?php echo $institutepassword ?>">
				</div>
				<div class="form-group">
					<label>Status&nbsp </label><br>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="1" checked>Enable</input>
					</label>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="0">Disable</input>
					</label>
				</div>
				<input type="submit" name="btn_update" id="btn_update" value="submit" class="btn btn-default" />
			</form>
		</div>
		<div class="col-lg-3">
		</div>
	</div>
</div>
<?php include_once("assets/includes/footer.inc"); ?>	