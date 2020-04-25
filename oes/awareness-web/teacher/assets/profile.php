<?php
include('dbconfig.php');
$qry = (executeQuery("SELECT * FROM `teacher` where teacherid=".$_SESSION['studId']));
	if(mysqli_num_rows($qry) == 0)
	{
		echo "<script>alert('rows not found')</script>";
	}
	else
	{
		if($r = mysqli_fetch_array($qry))
		{
?>
			<div class="profile">
				<form action="" method="get">
				<span>User Id :</Span><?php echo $r['teacherid'];?>
				<br>
				<span>Name :</Span><?php echo $r['fname'].' '.$r['mname'].' '.$r['lname'];?>
				<br>
				<span>Address :</Span><?php echo $r['address'];?>
				<br>
				<span>Contact No :</Span><?php echo $r['phone'];?>
				<br>
				<span>Mobile No :</Span><?php echo $r['mobile'];?>
				<br>
				<span>Email :</Span><?php echo $r['email'];?>
				<br>
				<span>Date Of Birth :</Span><?php echo $r['dob'];?>
				<br>
				<input type="submit" name="btn_logout" value="Log-out">
				<input type="submit" name="btn_chng_pass" value="Change Password">
				</form>	
			</div>
<?php
		}
	}	
?>
<?php
if(isset($_REQUEST['btn_logout']))
{
	SESSION_DESTROY();
	HEADER('location:index.php');
}
if(isset($_REQUEST['btn_chng_pass']))
{
	HEADER('location:changepassword.php');
}
?>