<?php 
include('assets/header.php');
if(!isset($_SESSION['studId']))
	{
		header('location:index.php');
	}
if(!isset($_GET['tid']))
	{
		header('location:take_test.php');
	}
	else
	{
		//echo"<script>alert('".$_GET['tid']."')</script>";
		$tid=$_GET['tid'];
	}
?>
<style>
#ans2
{
	height:300px;
}
.txt
{
	position:absolute;
	top:250px;
	//left:15px;
	width:100%;
}
</style>
<div class="row">
	<br><hr><br>
	<div class="col-sm-5">
	</div>
	<div class="col-sm-2">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Test Code</h3>
			</div>
			<div class="panel-body" id="ans2">
				<div class="form-group">
				<br><br>
					<p class="text-center">Test will inhance your
						Qualities and improve
						performance as well as 
						it will improve confidence...</p>
					<p class="text-center">BEST LUCK...!!!</p>
					<br>
					<div class="text-center">
					<form method="post">
						<input type="text" class="text-center" id="txt_code" name="txt_code" placeholder="Test Code">
						<br>
						<input type="submit" class="btn btn-success" id="btn_code" name="btn_code">
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-5">
	</div>
</div>
<br><br><br>
<?php include('assets/footer.php')?>
<?php
if(isset($_REQUEST['btn_code']))
{
	//echo"<script>alert('".$tid."')</script>";
	$result =(executeQuery("SELECT * FROM `test` WHERE `testid`=".$tid));
	if(mysqli_num_rows($result) > 0)
	{
		if($r = mysqli_fetch_array($result))
		{
			if($r['testcode'] == $_REQUEST['txt_code'])
			{
				echo"<script>alert('Testcode matched')</script>";
				HEADER('location: test.php');
				//header('location:Welcome.php');
			}
			else
			{
				echo"<script>alert('Testcode not matched')</script>";
			}
		}
	}
	else
	{
		echo"<script>alert('Something Went Wrong...')</script>";
	}
}
?>