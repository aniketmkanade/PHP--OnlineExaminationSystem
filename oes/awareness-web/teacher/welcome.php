<?php 
include('assets/header.php');
if(!isset($_SESSION['studId']))
	{
		header('location:index.php');
	}
?>
<style>
#ans
{
	height:410px;
}
#ans2
{
	height:410px;
}
.pro_title
{
	color:red;
}
</style>
<?php
//WHERE CONDITION IS TEMPRARY
	$qry =(executeQuery("SELECT * FROM `teacher` WHERE `teacherid` =".$_SESSION['studId']));
	if(mysqli_num_rows($qry) == 0)
	{
		echo "<script>alert('Rows not Found')</script>";
	}
	else
	{
		while($r = mysqli_fetch_array($qry))
		{
?>
<div class="page-header text-center">
	<h2 style="color:red">Welcome</h2>
</div>
<br>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-3">
		<div class="panel panel-primary">			
			<div class="panel-heading text-center">
				<h3 class="panel-title" id="que">Welcome <?php echo $r['loginname']; ?></h3>
			</div>
			<div class="panel-body" id="ans">
				<div class="form-group text-center">
					<br><br>
					<img src="srk.jpg" style="height:100px;width:100px;border-radius:50%"></img><br><br>
					<span class="pro_title">User Id : </Span><span><?php echo $r['teacherid'];?></span>
					<br>
					<span class="pro_title">Name : </Span><span><?php echo $r['fname'];?>&nbsp;<?php echo $r['mname'];?>&nbsp;<?php echo $r['lname'];?></span>
					<br>
					<span class="pro_title">Contact No : </Span><span><?php echo $r['phone'];?></span>
					<br>
					<span class="pro_title">Mobile No : </Span><span><?php echo $r['mobile'];?></span>
					<br>
					<span class="pro_title">Email : </Span><span><?php echo $r['email'];?></span>
					<br>
					<span class="pro_title">Date Of Birth : </Span><span><?php echo $r['dob'];?></span>
					<br>
					<span class="pro_title">Address : </Span><span><?php echo $r['address'];?></span>
				</div>
			</div>
		</div>
	</div>
<?php
		}
	}
?>
	<div class="col-sm-2">
	</div>
	<div class="col-sm-3">
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				<h3 class="panel-title">Dashboard</h3>
			</div>
			<div class="panel-body" id="ans2">
				<div class="form-group text-center"><br><br><br><br><br><br>
				<a href="attendence.php">Attendence</a><br><br>
				<a href="registration.php">Edit Profile</a><br><br>
				</div>
			</div>
		</div>
	</div>
	<br>
</div>
<?php include('assets/footer.php')?>