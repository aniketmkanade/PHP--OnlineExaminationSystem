<?php include('assets/header.php');
?>
<!--banner-->
<div class="head">
	<div class="container">
		<h2 > <a href="index.html">Home</a> / <span>Edit Profile</span></h2>
	</div>
</div>
<!--content-->
	<div class="container">
	
	<div class="page-header text-center">
        <h3>Profile</h3>
      </div>   
	  
	<?php
	$qry = (executeQuery("SELECT * FROM `teacher` where teacherid=".$_SESSION['studId']));
	if(mysqli_num_rows($qry) > 0)
	{
		if($r = mysqli_fetch_array($qry))
		{
	?>
  <div class="bs-example" data-example-id="simple-horizontal-form">
    <form class="form-horizontal">
      <div class="form-group">
		<label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">First Name</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="txt_fname" name="txt_fname" required placeholder="First Name"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'value ='.$r['fname'];
		  }
		  ?>
		  >
        </div>
      </div>
	  <div class="form-group">
	    <label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">Middle Name</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="txt_mname" name="txt_mname" required placeholder="Middle Name"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'value ='.$r['mname'];
		  }
		  ?>
		  >
        </div>
      </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">Last Name</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="txt_lname" name="txt_lname" required placeholder="Last Name"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'value ='.$r['lname'];
		  }
		  ?>
		  >
        </div>
      </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">Address</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="txt_address" name="txt_address" required placeholder="Address"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'value ='.$r['address'];
		  }
		  ?>
		  >
        </div>
      </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">Phone Number</label>
        <div class="col-sm-4">
          <input type="tel" class="form-control" id="txt_phone_no" name="txt_phone_no" required placeholder="Phone Number"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'value ='.$r['phone'];
		  }
		  ?>
		  >
        </div>
      </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">Mobile Number</label>
        <div class="col-sm-4">
          <input type="tel" class="form-control" id="txt_mobile_no" name="txt_mobile_no" required placeholder="Mobile Number"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'value ='.$r['mobile'];
		  }
		  ?>
		  >
        </div>
      </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">Email ID</label>
        <div class="col-sm-4">
          <input type="email" class="form-control" id="txt_email_id" name="txt_email_id" required placeholder="Email Address"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'value ="'.$r['email'].'"';
		  }
		  ?>
		  >
        </div>
      </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">Date Of Birth</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" id="txt_dob" name="txt_dob" required placeholder="DOB"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'value ='.$r['dob'];
		  }
		  ?>
		  >
        </div>
      </div>
	  <div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<label class="col-sm-2 control-label">Gender</label>
			<label class="radio-inline" style="padding-left:35px; " >
				<input type="radio" name="txt_gender" id="txt_gender" 
				<?php
				if(isset($_SESSION['studId']))
				{
					if($r['gender'] == "M")
					{	
					echo ' Checked = true ';
					}
				}
				?>
				value="M">Male
			</label>
			<label class="radio-inline">
				<input type="radio" name="txt_gender" id="txt_gender" 
				<?php
				if(isset($_SESSION['studId']))
				{
					if($r['gender'] == "F")
					{
					echo ' Checked = true ';
					}
				}
				?>
				value="F">Female
			</label>
		</div>
      <div class="form-group text-center">
        <div>
		<div class="form-group">
		<label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">Username</label>
        <div class="col-sm-4">
          <input  type="text" class="form-control" id="txt_login_name" name="txt_login_name" required placeholder="Username"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'disabled="true" value ='.$r['loginname'];
		  }
		  ?>
		  >
        </div>
      </div>
	  <div class="form-group">
		<label class="col-sm-3 control-label"></label>
        <label class="col-sm-2 control-label">Password</label>
        <div class="col-sm-4">
          <input type="password" class="form-control" id="txt_password" name="txt_password" required placeholder="Password"
		  <?php
		  if(isset($_SESSION['studId']))
		  {
			echo 'disabled="true" value ='.$r['password'];
		  }
		  ?>
		  >
        </div>
      </div>
		<?php
				if(isset($_SESSION['studId']))
				{
					echo"<input type='submit' name='btn_update' id='btn_update' value='Update' class='btn btn-default'/>";
				}
				else
				{
					echo"<input type='submit' name='btn_register' id='btn_register' value='Register' class='btn btn-default'/>";
				}
			}
		}
		?>
		</div>
      </div>
    </form>
	<!--//forms-->
	</div>
</div>
<?php include('assets/footer.php')?>
<?php 
if(isset($_REQUEST['btn_update']))
{
	$query = "UPDATE `teacher` SET 
	`fname`='".$_REQUEST['txt_fname']."',
	`mname`='".$_REQUEST['txt_mname']."',
	`lname`='".$_REQUEST['txt_lname']."',
	`address`='".$_REQUEST['txt_address']."',
	`phone`='".$_REQUEST['txt_phone_no']."',
	`mobile`='".$_REQUEST['txt_mobile_no']."',
	`email`='".$_REQUEST['txt_email_id']."',
	`dob`='".$_REQUEST['txt_dob']."',
	`gender`='".$_REQUEST['txt_gender']."',
	`loginname`='".$_REQUEST['txt_login_name']."',
	`password`='".$_REQUEST['txt_password']."' WHERE teacherid = ".$_SESSION['studId'];
	echo $query;
	if($result = (executeQuery($query)))
	{
		echo "<script>alert('Congrats Your Record is Updated...!!!')</script>";
	}
	else
	{
		echo "<script>alert('Query not Executed...!!!')</script>";
	}
}
	//IN REGISTRATION SOME FIELDS ARE TAKEN AS 0 AS DEFAULT
?>