<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
if (isset($_REQUEST["register"])) 
{
/*-------------------------------------------------New Id Generation--------------------------------------*/
	$numbergenerationid=null;
	$currentsequence=null;
	$newid = $_REQUEST['txt_student_id'];
	$query="select * from `numbergeneration` where category = 'Student Admission' and instid=".$_SESSION['instid'];
	if($rec = (executeQuery($query)))
	{
		
		if((mysqli_num_rows($rec) > 0) && ($res= mysqli_fetch_assoc($rec))&& $res['enable'] == 1)
		{
			$numbergenerationid=$res['numbergenerationid'];
			if($res['autoincrement'] == 1)
			{
				//$query1 = "select max('inst_stud_id') as 'lastid' from student where instid=".$_SESSION['instid'];
				//if($lastid = (executeQuery($query1)))
				//{
				//	if($res2 = mysqli_fetch_assoc($lastid))
					$newid = $currentsequence = $res['currentsequence'];
				}
				else
				{
					$newid = $_REQUEST['txt_student_id'];
				}
				if($res['prepost'] == 'pre')
				{
					$newid = $res['pre'].$res['saperator'].$newid;
				}
				else
				{
					$newid = $newid.$res['saperator'].$res['post'];
				}
			
		}
		else
		{
			$newid = $_REQUEST['txt_student_id'];
		}
	}
/*--------------------------------------------------Registration------------------------------------------*/
    if(!( empty($_REQUEST['txt_fname']) 
	|| empty($_REQUEST['txt_mname']) 
	|| empty($_REQUEST['txt_fname']) 
	|| empty($_REQUEST['txt_mobile_no']) 
	|| empty($_REQUEST['txt_login_name']) 
	|| empty($_REQUEST['txt_password']) 
	|| empty($_REQUEST['txt_dob']))) 
	{          
        $query = "INSERT INTO `student`(`inst_stud_id`, `instid`, `fname`, `mname`, `lname`, `address`,
		`contactno`, `mobileno`, `emailid`, `dob`, `age`, `gender`, `courseid`, `levelid`, `duration`, `doa`,
		`login_name`, `password`, `isactive`) VALUES 
		('".$newid."','".$_SESSION['instid']."','".$_REQUEST['txt_fname']."','".$_REQUEST['txt_mname']."',
		'".$_REQUEST['txt_lname']."','".$_REQUEST['txt_address']."','".$_REQUEST['txt_contact_no']."',
		'".$_REQUEST['txt_mobile_no']."','".$_REQUEST['txt_email_id']."','".$_REQUEST['txt_dob']."',
		'".$_REQUEST['txt_age']."','".$_REQUEST['txt_gender']."','".$_REQUEST['txt_course_id']."','".$_REQUEST['txt_level_id']."',
		'".$_REQUEST['txt_duration']."','".$_REQUEST['txt_doa']."','".$_REQUEST['txt_login_name']."',
		'".$_REQUEST['txt_password']."','".$_REQUEST['txt_is_active']."')";
        if($result = (executeQuery($query)))
		{
			$query="update numbergeneration set currentsequence='".($currentsequence +1)."' where numbergenerationid=".$numbergenerationid;
			//echo $query;
			if($result = (executeQuery($query)))
			{
				echo "<script>alert('Student Registration Confirm...!!!');</script>";
			}
			else
			{
				//echo mysqli_error($conn);
				echo "<script>alert('Student Registration  not Confirm...!!!');</script>";
			}
		}
		else
			echo "<script>alert('Student Registration  not Confirm...!!');</script>";
    }
}
?>
<!------------------------------------------ Page Wrapper Design ------------------------------------------------>
<div id="page-wrapper">
		<div class="row">
		<?php
			if(isset($_GLOBALS['message'])) 	
			{
				echo "<div class=\"col-lg-12\">".$_GLOBALS['message']."</div>";
				echo "<script>alert('".$_GLOBALS['message']."');</script>";
			}
		?>
		</div>
		<div class="row">
			<div class="col-lg-3">
			</div>
			<div class="col-lg-6">
			<h1>Create Student</h1><br>
				<form role="form">
					<div class="form-group">
						<label>Student ID</label>
						<input type="text" id="txt_student_id" name="txt_student_id" class="form-control">
					</div>
					<div class="form-group">
						<label>Institute ID</label>
						<input type="text" id="txt_institute_id" name="txt_institute_id" class="form-control">
					</div>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" id="txt_fname" name="txt_fname" class="form-control">
					</div>
					<div class="form-group">
						<label>Middle Name</label>
						<input type="text" id="txt_mname" name="txt_mname" class="form-control">
					</div>
					<div class="form-group">
						<label>last Name</label>
						<input type="text" id="txt_lname" name="txt_lname" class="form-control">
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" id="txt_address" name="txt_address" class="form-control">
					</div>
					<div class="form-group">
						<label>Contact Number</label>
						<input type="text" id="txt_contact_no" name="txt_contact_no" class="form-control">
					</div>
					<div class="form-group">
						<label>Mobile Number</label>
						<input type="text" id="txt_mobile_no" name="txt_mobile_no"class="form-control">
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
						<label>Age</label>
						<input type="text" id="txt_age" name="txt_age" class="form-control">
					</div>
					<div class="form-group">
						<label>Gender&nbsp </label><br>
						<label class="radio-inline">
							<input type="radio" id="txt_gender" name="txt_gender" value="Male">Male
						</label>
						<label class="radio-inline">
							<input type="radio" id="txt_gender" name="txt_gender" value="Female">Female
						</label>
					</div>
					<div class="form-group">
						<label>Course ID</label>
						<input type="text" id="txt_course_id" name="txt_course_id" class="form-control">
					</div>
					<div class="form-group">
						<label>Level ID</label>
						<input type="text" id="txt_level_id" name="txt_level_id" class="form-control">
					</div>
					<div class="form-group">
						<label>Date of Admission</label>
						<input type="date" id="txt_doa" name="txt_doa" class="form-control">
					</div>
					<div class="form-group">
						<label>Duration(Days)</label>
						<input type="text" id="txt_duration" name="txt_duration" class="form-control">
					</div>
					<div class="form-group">
						<label>Login Name</label>
						<input type="text" id="txt_login_name" name="txt_login_name" class="form-control">
					</div>
					<div class="form-group">
						<label>Enter Password</label>
						<input type="password" id="txt_password" name="txt_password" class="form-control">
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" id="txt_password" name="txt_password" class="form-control">
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
						<input type="submit" value="register" id="register" name="register" class="btn btn-default" />
					</div>
				</form>
			</div>
			<div class="col-lg-3">
			</div>
		</div>
	</div>
<?php include_once("assets/includes/footer.inc"); ?>