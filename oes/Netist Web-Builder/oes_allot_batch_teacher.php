<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
/* ---------------------------------------------Insert Process----------------------------------------------------*/
	//Date Insertion Remaining and is fees recieved
	if(isset($_REQUEST['btn_submit']))
	{
		$query=("INSERT INTO `allotbatchtoteacher`(`date`, `teacherid`, `courseid`, `batchid`, `isactive`) VALUES
		(
		'".$_REQUEST['txt_date']."',
		'".$_REQUEST['ddl_teacher']."',
		'".$_REQUEST['ddl_course']."',
		'".$_REQUEST['ddl_batch']."',
		'".$_REQUEST['txt_is_active']."'
		)");
		
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Batch Alloted...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Query not fired...!!!')</script>";
		}
	}
?>
<!-------------------------------------------------------Ajax Code----------------------------------------------------->
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#ddl_course').on('change',function(){
        var courseID = $(this).val();
        if(courseID){
            $.ajax({
                type:'POST',
                url:'ajaxcoursewisebatches.php',
                data:'course_id='+courseID,
                success:function(html){
                    $('#ddl_batch').html(html); 
                }
            }); 
        }
    });
});
</script>
<!---------------------------------------------- Wrapper Code---------------------------------------------------------->
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-3">
		</div>
		<div class="col-lg-6">
		<h1>Allot Batch (Teacher)</h1><br>
			<form role="form">
				<div class="form-group">
					<label>Date</label><br>
					<input type="date" id="txt_date" required name="txt_date" class="form-control">
				</div>
				<div class="form-group">
					<label>Teacher</label>
					<select id="ddl_teacher" name="ddl_teacher" class="form-control">
					<option selected value="<Choose the Teacher>">&lt;Choose the Teacher&gt;</option>
					<?php
					$result = executeQuery("SELECT * FROM `teacher` ");
					while ($r = mysqli_fetch_array($result)) 
					{
					?>
					<option value='<?php echo $r['teacherid']; ?>'><?php echo $r['fname']." ".$r['mname']." ".$r['lname'];?></option>
					<?php
					}
					?>
					</select>
				</div>
				<div class="form-group">
					<label>Course</label>
					<select id="ddl_course" name="ddl_course" class="form-control">
					<option selected value="<Choose the Subject>">&lt;Choose the Course&gt;</option>
					<?php
						$result = executeQuery("SELECT * FROM `course`");
						while ($r = mysqli_fetch_array($result)) 
						{
						?>
						<option value='<?php echo $r['courseid']; ?>'>
						<?php echo $r['coursename']; ?> 
						</option>
						<?php
						}
					?>
					</select>
				</div>
				<div class="form-group">
					<label>Batch </label>
					<select id="ddl_batch" name="ddl_batch" class="form-control">
					<option selected value="<Choose the Batch>">&lt;Choose the Batch&gt;</option>
					</select>
				</div>
				<div class="form-group">
					<label>Status&nbsp </label><br>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" checked value="1">Enable</input>
					</label>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="0">Disable</input>
					</label>
				</div>
				<input type="submit" id="btn_submit" name="btn_submit" class="btn btn-default" />
				<input type="reset" id="btn_reset" name="btn_reset" class="btn btn-default" />
			</form>
			<br/><hr/><br/>
		</div>
		<div class="col-lg-3">
		</div>
	</div>
</div>
<?php include_once("assets/includes/footer.inc"); ?>