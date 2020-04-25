<?php 
include('assets/header.php');
if(!isset($_SESSION['studId']))
	{
		header('location:index.php');
	}
if(!isset($_GET['id']))
	{
		header('location:take_test.php');
	}
	else
	{
		$id = $_GET['id'];
	}
?>
<style>
#que
{
	height:80px;
}
#ans
{
	height:370px;
}
#ans2
{
	height:410px;
}
#txt_next
{
	position:absolute;
	left:700px;
}
#timer
{
	padding-left:125px;
}
#qno
{
	position:absolute;
	top:170px;
	left:500px;
}
</style>
<div class="page-header text-center">
	<h1>Test:Test1</h1>
</div>
<div id="timer">
	<input type="text" id="txt_timer" name="txt_timer" value="">
	<h3 id="qno" ><span class="label label-info">Question No: 
	<?php
		/*if($result = (executeQuery("SELECT  `qnid` FROM `question` WHERE `testid`=".$id)))
		if(mysqli_num_rows($result) == 0)
		{
			echo "<script>alert('Rows not found')</script>";
		}
		else
		{
			while($r = mysqli_fetch_array($result))
			{
				echo $r['qnid'];
			}
		}*/
	?>
	</span></h3>
</div><br>
<div class="row">
	<div class="col-sm-1">
	</div>
	<div class="col-sm-7">
		<div class="panel panel-info">
			<?php
				//"SELECT * FROM 'examschedule' es,'test' t,'question' q WHERE es.esid ='".$_REQUEST['id']."' and es.testid = t.testid and t.courseid = q.courseid and t.levelid = q.levelid"
				//function randomDigits($length){
					//$numbers = range(0,9);
					//shuffle($numbers);
					//for($i = 0;$i < $length;$i++)
					//$digits .= $numbers[$i];
					//return $digits;
					//}
					//if($result = (executeQuery("select * from question where qnid=1")))
					//{
						//if(mysqli_num_rows($result) == 0)
						//{
							//echo "<script>alert('no rows found')</script>";
						//}
						//else
						//{
							//while($r = mysqli_fetch_array($result))
						//	{
				?>
			<div class="panel-heading">

				<h3 class="panel-title" id="que">
					<?php	//echo $r['question'];?>
				</h3>
			</div>
			<div class="panel-body" id="ans">
				<div class="form-group">
					<br>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="option_a">
						<?php	//echo $r['option1'];?>
						</input>
					</label><br><br><br>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="option_b">
						<?php	//echo $r['option2'];?>
						</input>
					</label><br><br><br>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="option_c">
						<?php	//echo $r['option3'];?>
						</input>
					</label><br><br><br>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="option_d">
					<?php	//echo $r['option4'];
						//	}
						//}
					//}
					?>
						</input>
					</label><br><br><br>
					<?php
					echo "<input type='button' class='btn btn-lg btn-info' id='txt_preview' name='txt_preview' value='Preview'/>";
					?>
					<?php
					//HOW TO GIVE LAST QUESTION CONDITION TO NEXT BUTTON
					?>
					<input type="button" class="btn btn-lg btn-info" id="txt_next" name="txt_next" value="Next"/>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Question Summary</h3>
			</div>
			<div class="panel-body" id="ans2">
				<div class="form-group">
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('assets/footer.php')?>