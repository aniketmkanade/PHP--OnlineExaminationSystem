<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
/* ---------------------------------------------Update Process----------------------------------------------------*/
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'edit')
	{
		if(isset($_REQUEST['btn_submit']))
		{
			$query="UPDATE `batch` SET
			`batchname`='".$_REQUEST['txt_batch_name']."',
			`batchcode`='".$_REQUEST['txt_batch_code']."',
			`courseid`='".$_REQUEST['ddl_course']."',
			`levelid`='".$_REQUEST['ddl_level']."',
			`startfrom`='".$_REQUEST['txt_start_from']."',
			`endat`='".$_REQUEST['txt_end_at']."',
			`timingfrom`='".$_REQUEST['txt_timing_from']."',
			`timingto`='".$_REQUEST['txt_timing_to']."',
			`remark`='".$_REQUEST['txt_remark']."',
			`status`='".$_REQUEST['txt_is_active']."'  
			WHERE batchid=".$_REQUEST['id'];
					
			if($result = (executeQuery($query)))
			{
				echo"<script>alert('Course Updation Successful...!!!')</script>";
			}
			else
			{
				echo"<script>alert('Query not fired...!!!')</script>";
			}
		}
	}
}
/* ---------------------------------------------Insert Process----------------------------------------------------*/
else
{
	if (isset($_REQUEST["register"])) 
	{
		if(!( empty($_REQUEST['txt_batch_name']) 
		|| empty($_REQUEST['txt_batch_code']) 
		|| empty($_REQUEST['ddl_course']) 
		|| empty($_REQUEST['ddl_level']) 
		|| empty($_REQUEST['txt_start_from']) 
		|| empty($_REQUEST['txt_end_at']))) 
		{          
		
			$query = "INSERT INTO `batch`(`batchname`, `batchcode`, `courseid`, `levelid`, `startfrom`, `endat`, `timingfrom`, `timingto`, `remark`, `status`) VALUES 
			('".$_REQUEST['txt_batch_name']."',
			'".$_REQUEST['txt_batch_code']."','".$_REQUEST['ddl_course']."','".$_REQUEST['ddl_level']."',
			'".$_REQUEST['txt_start_from']."','".$_REQUEST['txt_end_at']."','".$_REQUEST['txt_timing_from']."',
			'".$_REQUEST['txt_timing_to']."','".$_REQUEST['txt_remark']."','".$_REQUEST['txt_is_active']."')";
			if($result = (executeQuery($query)))
			{
					 echo "<script>alert('Student Registration Confirm...!!!');</script>";
			}
		}
		else
		{
			echo "<script>alert('All Fields Are not Filled...!!!');</script>";
		}
	}
}
/* ---------------------------------------------Deletion Process----------------------------------------------------*/
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'delete')
	{
		$query="DELETE FROM `batch` WHERE batchid=".$_REQUEST['id'];
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Level Deletion Successful...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Level Deletion Not Successful...!!!')</script>";
		}
	}
}
/* ---------------------------------------------Data Retriving Process------------------------------------------------*/
$txt_batch_name ="";
$txt_batch_code="";
$courseid="";
$levelid="";
$txt_start_from="";
$txt_end_at="";
$txt_timing_from="";
$txt_timing_to="";
$txt_remark="";
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'edit')
	{
		$query="SELECT * FROM `batch` WHERE batchid=".$_REQUEST['id'];
		if($result = (executeQuery($query)))
		{				
			if($result->num_rows > 0 && $r = mysqli_fetch_array($result))
			{
				$txt_batch_name = $r['levelname'];
				$txt_batch_code = $r['leveldesc'];
				$courseid= $r['courseid'];
				$levelid= $r['levelid'];
				$txt_start_from= $r['startfrom'];
				$txt_end_at= $r['endat'];
				$txt_timing_from= $r['timingfrom'];
				$txt_timing_to= $r['timingto'];
				$txt_remark= $r['remark'];
			}
			else 
				echo"<script>alert('Data Not found...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Data Not found...!!!')</script>";
		}
	}
}
?>
<!-----------------------------------------------------Ajax Code------------------------------------------------>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#ddl_course').on('change',function(){
        var courseID = $(this).val();
        if(courseID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'course_id='+courseID,
                success:function(html){
                    $('#ddl_level').html(html);
                    $('#ddl_subject').html('<option value="">Select Level first</option>'); 
                }
            }); 
        }else{
            $('#ddl_level').html('<option value="">Select course first</option>');
            $('#ddl_subject').html('<option value="">Select Level first</option>'); 
        }
    });
    
    $('#ddl_level').on('change',function(){
        var levelID = $(this).val();
        if(levelID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'level_id='+levelID,
                success:function(html){
                    $('#ddl_subject').html(html);
                }
            }); 
        }else{
            $('#ddl_subject').html('<option value="">Select Level first</option>'); 
        }
    });
});
</script>
<!----------------------------------------------------- Page Wrapper Design-------------------------------------------->
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
		<h1>Add Batch</h1><br>
			<form role="form">
				<div class="form-group">
					<label>Batch Name</label>
					<input type="text" id="txt_batch_name" name="txt_batch_name" class="form-control"
					value ="<?php echo $txt_batch_name;?>"
					>
				</div>
				<div class="form-group">
					<label>Batch Code</label>
					<input type="text" id="txt_batch_code" name="txt_batch_code" class="form-control"
					value ="<?php echo $txt_batch_code;?>"
					>
				</div>
				<div class="form-group">
					<label>Selects Course</label>
					<select id="ddl_course"name="ddl_course" class="form-control">
						<option selected value="<Choose the Subject>">&lt;Choose the Course&gt;</option>
						<?php
							$result = executeQuery("SELECT `courseid`, `coursename` FROM `course`");
							while ($r = mysqli_fetch_array($result)) 
							{
							?>
							<option value='<?php echo $r['courseid']; ?>' <?php if($r['courseid'] == $courseid) echo "selected";?>>
							<?php echo htmlspecialchars_decode($r['coursename'], ENT_QUOTES); ?> 
							</option>
							<?php
							}
							closedb();
							?>
					</select>
				</div>
				<div class="form-group">
					<label>Selects Level</label>
					<select id="ddl_level" name="ddl_level" class="form-control">
						<option selected value="">&lt;Choose the Level&gt;</option>
						<?php
						$result = executeQuery("SELECT `levelid`, `levelname` FROM `level`");
						while ($r = mysqli_fetch_array($result)) 
						{
						?>
						<option value='<?php echo $r['levelid']; ?>' <?php if($r['levelid'] == $levelid) echo "selected";?>>
						<?php echo htmlspecialchars_decode($r['levelname'], ENT_QUOTES); ?> 
						</option>
						<?php
						}
						closedb();
					?>
					</select> 
				</div>
				<div class="form-group">
					<label>Start From (Date)</label>
					<input type="date" id="txt_start_from" name="txt_start_from" class="form-control"
					value ="<?php echo $txt_start_from;?>"
					>
				</div>
				<div class="form-group">
					<label>End At (Date)</label>
					<input type="date" id="txt_end_at" name="txt_end_at" class="form-control"
					value ="<?php echo $txt_end_at;?>"
					>
				</div>
				<div class="form-group">
					<label>Timing From (Time)</label>
					<input type="text" id="txt_timing_from" name="txt_timing_from" class="form-control"
					value ="<?php echo $txt_timing_from;?>"
					>
				</div>
				<div class="form-group">
					<label>Timing to (Time)</label>
					<input type="text" id="txt_timing_to" name="txt_timing_to" class="form-control"
					value ="<?php echo $txt_timing_to;?>"
					>
				</div>
				<div class="form-group">
					<label>Remark</label>
					<input type="text" id="txt_remark" name="txt_remark" class="form-control"
					value ="<?php echo $txt_remark;?>"
					>
				</div>
				<div class="form-group">
					<label>Status&nbsp </label><br>
					<label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" checked value="1">Running</input>
					 </label>
					 <label class="radio-inline">
						<input type="radio" id="txt_is_active" name="txt_is_active" value="0">Closed</input>
					 </label>
				</div>
				<div class="form-group">
					<input type="submit" value="register" id="register" name="register" class="btn btn-default" />
				</div>
			</form>
			<br/><hr/><br/>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Batch List :</h3>
						</div>
						<div class="panel-body">
							<div id="shieldui-grid1"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
		</div>
	</div>
</div>
<?php include_once("assets/includes/footer.inc"); ?>
<!-------------------------------------------------JavaScript Code(Table)-------------------------------------------------->
<script type="text/javascript">
	 jQuery(function ($) 
	{
		var traffic = [
			<?php
				$result = (executeQuery("SELECT l.*, c.*, b.* FROM `batch` b  
				`level` l,`course` c WHERE l.levelid = b.levelid and b.courseid = c.courseid"));
			
				$rowcount= mysqli_num_rows($result);
				$counter=1;
				while($r = mysqli_fetch_array($result))
				{
					echo '{ BatchName:"'.$r['batchname'].'",
					BatchCode:"'.$r['batchcode'].'",
					Course:"'.$r['coursename'].'",
					Level:"'.$r['levelname'].'",
					StartFrom:"'.$r['startfrom'].'",
					EndAt:"'.$r['endat'].'",
					TimingFrom:"'.$r['timingfrom'].'",
					TimingTo:"'.$r['timingto'].'",
					action:"<a href=\'?action=edit&id='.$r['batchid'].' \' class=\'btn btn-success\'><i class=\'fa fa-pencil\'></i></a>&nbsp;<a href=\'?action=delete&id='.$r['batchid'].' \' class=\'btn btn-danger\'><i class=\'fa fa-trash\'></i></a>",}';
					$counter++;
					if($rowcount>=$counter)
						echo ',';
				}
			?>
			];
	
			$("#shieldui-grid1").shieldGrid({
				dataSource: 
				{
					data: traffic
				},
				sorting: 
				{
					multiple: true
				},
				rowHover: false,
				paging: false,
				columns: [
				
				{ field: "BatchName", width: "50px", title: "Batch Name" },
				{ field: "BatchCode", width: "50px", title: "Batch Code" },
				{ field: "Course", width: "50px", title: "Course" },
				{ field: "Level",width: "50px", title: "Level" },
				{ field: "StartFrom",width: "50px", title: "Start From" },
				{ field: "EndAt",width: "50px", title: "End At" },
				{ field: "TimingFrom",width: "50px", title: "Timing From" },
				{ field: "TimingTo",width: "50px", title: "Timing To" },
				{ field: "action",width: "50px", title: "Action" }  
				]
			});
	});   
</script>