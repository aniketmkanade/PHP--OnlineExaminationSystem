<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	?>
<!---------------------------------------- Page Wrapper Design ---------------------------------------------------->
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-3">
		</div>
		<div class="col-lg-6">
		<h1>Teacher Registration</h1><br>
			<form role="form">
				<div class="form-group">
					<label>Institute ID</label>
					<input id="txt_institute_id" name="txt_institute_id" class="form-control">
				</div>
				<div class="form-group">
					<label>First Name</label>
					<input id="txt_fname" name="txt_fname" class="form-control">
				</div>
				<div class="form-group">
					<label>Middle Name</label>
					<input id="txt_mname" name="txt_mname" class="form-control">
				</div>
				<div class="form-group">
					<label>last Name</label>
					<input id="txt_lname" name="txt_lname" class="form-control">
				</div>
				<div class="form-group">
					<label>Address</label>
					<input id="txt_address" name="txt_address"class="form-control">
				</div>
				<div class="form-group">
					<label>Contact Number</label>
					<input id="txt_contact_no" name="txt_contact_no" class="form-control">
				</div>
				<div class="form-group">
					<label>Mobile Number</label>
					<input id="txt_mobile_no" name="txt_mobile_no" class="form-control">
				</div>
				<div class="form-group">
					<label>Email ID</label>
					<input type="email" id="txt_email_id" name="txt_email_id" class="form-control">
				</div>
				<div class="form-group">
					<label>Date Of Birth</label>
					<input type="date" id="txt_dob" name="txt_dob" class="form-control">
				</div>
				<div class="form-group">
					<label>Teacher Code</label>
					<input type="text" id="txt_teacher_code" name="txt_teacher_code" class="form-control">
				</div>
				<div class="form-group">
					<label>Gender&nbsp </label><br>
					<label class="radio-inline">
						<input type="radio" id="txt_gender" name="txt_gender" value="male" />Male
					 </label>
					 <label class="radio-inline">
						<input type="radio" id="txt_gender" name="txt_gender" value="female" />Female
					 </label>
				</div>
				<div class="form-group">
					<label>Date of Joining</label>
					<input type="date" id="txt_doj" name="txt_doj" class="form-control">
				</div>
				<div class="form-group">
					<label>Salary</label>
					<input id="txt_salary" name="txt_salary"class="form-control">
				</div>
				<div class="form-group">
					<label>Status&nbsp </label><br>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="1">Enable</input>
					 </label>
					 <label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="0">Disable</input>
					 </label>
				</div>
				<div class="form-group">
					<label>Login Name</label>
					<input id="txt_login_name" name="txt_login_name" class="form-control">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" id="txt_password" name="txt_password" class="form-control">
				</div>
				<input type="submit" name="register" id="register" class="btn btn-default" />
			</form>
		<hr></div>
		<div class="col-lg-3">
		</div>
	</div>
</div>	
<?php include_once("assets/includes/footer.inc"); ?>	
<!------------------------------------------- PHP Code ---------------------------------------------------------->
<?php
if(isset($_REQUEST["register"]))
{
	$query = "INSERT INTO `teacher`(`instid`, `fname`, `mname`, `lname`, `address`, 
	`phone`, `mobile`, `email`, `dob`, `gender`,`teachercode`,`designation`, `doj`, `salary`, `isactive`, `loginname`,
	`password`) VALUES   
	('".$_REQUEST['txt_institute_id']."','".$_REQUEST['txt_fname']."','".$_REQUEST['txt_mname']."',
	'".$_REQUEST['txt_lname']."','".$_REQUEST['txt_address']."','".$_REQUEST['txt_contact_no']."',
	'".$_REQUEST['txt_mobile_no']."','".$_REQUEST['txt_email_id']."','".$_REQUEST['txt_dob']."','".$_REQUEST['txt_gender']."',
	'".$_REQUEST['txt_teacher_code']."','".$_REQUEST['txt_doj']."',
	'".$_REQUEST['txt_salary']."',
	'".$_REQUEST['txt_is_active']."','".$_REQUEST['txt_login_name']."','".$_REQUEST['txt_password']."')";
	
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