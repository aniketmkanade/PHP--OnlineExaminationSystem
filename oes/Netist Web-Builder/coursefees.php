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
			$query="UPDATE `coursefees` SET
			`courseid`='".$_REQUEST['ddl_course']."',
			`levelid`='".$_REQUEST['ddl_level']."',
			`charges`='".$_REQUEST['txt_charges']."'
			WHERE coursefeesid=".$_REQUEST['id'];
			
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
		$query="INSERT INTO `coursefees`(`courseid`, `levelid`, `charges`) VALUES  
		('".$_REQUEST['ddl_course']."', '".$_REQUEST['ddl_level']."','".$_REQUEST['txt_charges']."')";
		
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
		$query="DELETE FROM `coursefees` WHERE coursefeesid=".$_REQUEST['id'];
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
$courseid="";
$levelid="";
$charges="";
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'edit')
	{
		$query="SELECT * FROM `coursefees` WHERE coursefeesid=".$_REQUEST['id'];
		if($result = (executeQuery($query)))
		{				
			if($result->num_rows > 0 && $r = mysqli_fetch_array($result))
			{
				$courseid = $r['courseid'];
				$levelid = $r['levelid'];
				$charges= $r['charges'];
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
<!-----------------------------------------------Ajax Code--------------------------------------------------------->
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
<!------------------------------------------------ Wrapper Code----------------------------------------------------->
	<div id="page-wrapper">
            <div class="row">
				<div class="col-lg-3">
				</div>
                <div class="col-lg-6">
				<h1>Course Fees</h1><br>
                    <form role="form">
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
                            <label>Charges</label>
                            <input id="txt_charges" name="txt_charges" class="form-control" placeholder="Charges"
							<?php
							echo "value=".$charges;
							?>
							>
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
                        <input type="reset" id="btn_reset" name="btn_reset" value="reset" class="btn btn-default">
					</form>
					<br/>
					<hr/>
					<br/>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Course fees :</h3>
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
<!---------------------------------------------- JavaScript Code(Table)----------------------------------------------->
<script type="text/javascript">
jQuery(function ($) {
	var traffic = [
		<?php
		$result = (executeQuery("SELECT l.*, c.*, cf.* FROM 
				`level` l,`course` c,`coursefees` cf WHERE l.levelid = cf.levelid and cf.courseid = c.courseid"));
	
		$rowcount= mysqli_num_rows($result);
		$counter=1;
		while($r = mysqli_fetch_array($result))
		{
			echo '{ 
			CourseName:"'.$r['coursename'].'",
			LevelName:"'.$r['levelname'].'",
			Charges:"'.$r['charges'].'",
			action:"<a href=\'?action=edit&id='.$r['coursefeesid'].' \' class=\'btn btn-success\'><i class=\'fa fa-pencil\'></i></a>&nbsp;<a href=\'?action=delete&id='.$r['coursefeesid'].' \' class=\'btn btn-danger\'><i class=\'fa fa-trash\'></i></a>",}';
			$counter++;
			if($rowcount>=$counter)
				echo ',';
		}
	?>
	];
	$("#shieldui-grid1").shieldGrid({
		dataSource: {
			data: traffic
		},
		sorting: {
			multiple: true
		},
		rowHover: true,
		paging: false,
		columns: [
		{ field: "CourseName",width: "75px", title: "Course" },
		{ field: "LevelName", width: "75px", title: "Level" },
		{ field: "Charges", width: "80px", title: "Charges" },
		{ field: "action",width: "100px", title: "Action" }  
		]
	});            
});        
</script>