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
			$query="UPDATE `subject` SET 
			`levelid`='".$_REQUEST['ddl_level']."',
			`courseid`='".$_REQUEST['ddl_course']."',
			`subname`='".$_REQUEST['txt_subject_name']."',
			`subdesc`='".$_REQUEST['txt_subject_discription']."',
			`instid`='".$_SESSION['instid']."',
			`isactive`='".$_REQUEST['txt_is_active']."' 
			WHERE 
			subjectid=".$_REQUEST['id'];
			
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
	if(isset($_REQUEST['btn_submit']))
	{
		$query="INSERT INTO `subject`(`levelid`, `courseid`, `subname`, `subdesc`,
		`instid`, `isactive`) VALUES  
		('".$_REQUEST['ddl_level']."', '".$_REQUEST['ddl_course']."','".$_REQUEST['txt_subject_name']."','".$_REQUEST['txt_subject_discription']."',
		 '".$_SESSION['instid']."','".$_REQUEST['txt_is_active']."')";
		
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Subject Registration Successful...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Query not fired...!!!')</script>";
		}
	}
}
/*----------------------------------------------Deletion Procedure--------------------------------------------------*/
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'delete')
	{
		$query="DELETE FROM `subject` WHERE subid=".$_REQUEST['id'];
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Subject Deletion Successful...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Subject Deletion Not Successful...!!!')</script>";
		}
	}
}
/* ---------------------------------------------Data Retriving Process------------------------------------------------*/
$subname ="";
$subdesc="";
$levelid="";
$courseid="";
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'edit')
	{
		$query="SELECT * FROM `subject` WHERE subid='".$_REQUEST['id']."' and instid=".$_SESSION['instid'];
		if($result = (executeQuery($query)))
		{				
			if($result->num_rows > 0 && $r = mysqli_fetch_array($result))
			{
				$subname = $r['subname'];
				$subdesc = $r['subdesc'];
				$levelid= $r['levelid'];
				$courseid= $r['courseid'];
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
<!---------------------------------------------- Wrapper Code---------------------------------------------------------->
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-3">
		</div>
		<div class="col-lg-6">
		<h1>Subject Registration</h1><br>
			<form role="form">
				<div class="form-group">
					<label>Selects Course</label>
					<select id="ddl_course" name="ddl_course" class="form-control">
					<option selected value="<Choose the Subject>">&lt;Choose the Course&gt;</option>
					<?php
					$result = executeQuery("SELECT `courseid`, `coursename` FROM `course` where instid=".$_SESSION['instid']);
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
					<option selected value="<Choose the Subject>">&lt;Choose the Level&gt;</option>
					<?php
						$result = executeQuery("SELECT `levelid`, `levelname` FROM `level` where instid=".$_SESSION['instid']);
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
					<label>Subject Name</label>
					<input id="txt_subject_name" name="txt_subject_name" class="form-control" placeholder="Enter text"
					<?php
					if(isset($_REQUEST['action']))
					{
						if($_REQUEST['action'] == 'edit')
						{
							$query="SELECT `subid`, `subname` FROM `subject` WHERE subid='".$_REQUEST['id']."' and instid=".$_SESSION['instid'];
							if($result = (executeQuery($query)))
							{
								while($r = mysqli_fetch_assoc($result))
								{
									echo "value =".$r['subname'];
								}
							}
							else
							{
								echo"<script>alert('Course Deletion Not Successful...!!!')</script>";
							}
						}
					}
					?>		
					>
				</div>
				<div class="form-group">
					<label>subject Discription</label>
					<textarea id="txt_subject_discription" name="txt_subject_discription" class="form-control" rows="3">
					<?php
					if(isset($_REQUEST['action']))
					{
						if($_REQUEST['action'] == 'edit')
						{
							$query="SELECT `subid`, `subdesc` FROM `subject` WHERE subid=".$_REQUEST['id'];
							if($result = (executeQuery($query)))
							{
								while($r = mysqli_fetch_assoc($result))
								{
									echo $r['subdesc'];
								}
							}
							else
							{
								echo"<script>alert('Course Deletion Not Successful...!!!')</script>";
							}
						}
					}
					?>
					</textarea>
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
				<input type="submit" id="btn_submit" name="btn_submit" class="btn btn-default" 
				<?php
				if(isset($_REQUEST['action']))
				{
					if($_REQUEST['action'] == 'edit')
					{
						echo'value ="Update"';
					}
				}
				?>				
				/>
				<input type="reset" id="btn_reset" name="btn_reset" class="btn btn-default" />
			</form>
			<br/><hr/><br/>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Subject List :</h3>
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
				$result = (executeQuery("SELECT l.*, c.*, s.* FROM `subject` s ,
				`level` l,`course` c WHERE l.levelid = s.levelid and s.courseid = c.courseid and s.instid=".$_SESSION['instid']));
			
				$rowcount= mysqli_num_rows($result);
				$counter=1;
				while($r = mysqli_fetch_array($result))
				{
					echo '{ CourseName:"'.$r['coursename'].'",
					LevelName:"'.$r['levelname'].'",
					SubjectName:"'.$r['subname'].'",
					SubjectDesc:"'.$r['subdesc'].'",
					action:"<a href=\'?action=edit&id='.$r['subid'].' \' class=\'btn btn-success\'><i class=\'fa fa-pencil\'></i></a>&nbsp;<a href=\'?action=delete&id='.$r['subid'].' \' class=\'btn btn-danger\'><i class=\'fa fa-trash\'></i></a>",}';
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
				
				{ field: "CourseName", width: "100px", title: "Course" },
				{ field: "LevelName", width: "100px", title: "Level" },
				{ field: "SubjectName", width: "100px", title: "Subject" },
				{ field: "SubjectDesc",width: "100px", title: "Description" },
				{ field: "action",width: "100px", title: "Action" }  
				]
			});
	});   
</script>