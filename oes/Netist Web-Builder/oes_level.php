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
			$query="UPDATE `level` SET
			`courseid`='".$_REQUEST['ddl_course']."',
			`levelname`='".$_REQUEST['txt_level_name']."',
			`leveldesc`='".$_REQUEST['txt_level_discription']."',
			`instid`='1',
			`isactive`='".$_REQUEST['is_active']."'  
			WHERE levelid=".$_REQUEST['id'];
					
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
		$query="INSERT INTO `level`(`courseid`, `levelname`, `leveldesc`, `instid`, `isactive`) VALUES
		('".$_REQUEST['ddl_course']."','".$_REQUEST['txt_level_name']."','".$_REQUEST['txt_level_discription']."','".$_SESSION['instid']."','".$_REQUEST['is_active']."')";
		
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Level Registration Successful...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Query not fired...!!!')</script>";
		}
	}
}
/* ---------------------------------------------Deletion Process----------------------------------------------------*/
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'delete')
	{
		$query="DELETE FROM `level` WHERE levelid=".$_REQUEST['id'];
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
$levelname ="";
$leveldesc="";
$courseid="";
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'edit')
	{
		$query="SELECT * FROM `level` WHERE levelid='".$_REQUEST['id']."' and instid=".$_SESSION['instid'] ;
		if($result = (executeQuery($query)))
		{				
			if($result->num_rows > 0 && $r = mysqli_fetch_array($result))
			{
				$levelname = $r['levelname'];
				$leveldesc = $r['leveldesc'];
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
<!------------------------------------------ Page Wrapper Design ------------------------------------------------->
	<div id="page-wrapper">
            <div class="row">
				<div class="col-lg-3">
				</div>
                <div class="col-lg-6">
				<h1>Level / Years/ Semister Registration</h1><br>
                    <form role="form" method="post">
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
                            <label>Level Name</label>
                            <input id="txt_level_name" name="txt_level_name" class="form-control" placeholder="Enter text" value ="<?php echo $levelname;?>" >
                        </div>
						<div class="form-group">
                            <label>Level Discription</label>
                            <textarea id="txt_level_discription" name="txt_level_discription" class="form-control" rows="3">
							<?php echo $leveldesc; ?>
							</textarea>
                        </div>
						<div class="form-group">
							<label>Status&nbsp </label><br>
							<label class="radio-inline">
								<input type="radio" id="is_active" name="is_active" checked value="1">Enable</input>
							</label>
							<label class="radio-inline">
								<input type="radio" id="is_active" name="is_active" value="0">Disable</input>
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
					<br/>
					<hr/>
					<br/>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Level List :</h3>
								</div>
								<div id="txt_level_list" class="panel-body">
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
<!-------------------------------------------- JavaScript Code -------------------------------------------------------->
<script type="text/javascript">
jQuery(function ($) 
{
var traffic = [
	<?php
		$result = (executeQuery("SELECT c.*, l.* FROM `level` l, `course` c where c.courseid=l.courseid and l.instid=".$_SESSION['instid']));
		$rowcount= mysqli_num_rows($result);
		$counter=1;
		while($r = mysqli_fetch_array($result))
		{
			echo '
			{CourseName:"'.$r['coursename'].'",
			LevelName:"'.$r['levelname'].'", 
			LevelDesc:"'.$r['leveldesc'].'",
			action:"<a href=\'?action=edit&id='.$r['levelid'].' \' class=\'btn btn-success\'><i class=\'fa fa-pencil\'></i></a>&nbsp;<a href=\'?action=delete&id='.$r['levelid'].' \' class=\'btn btn-danger\'><i class=\'fa fa-trash\'></i></a>",}';
			
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
	{ field: "CourseName",width: "100px", title: "Course" },
	{ field: "LevelName", width: "100px", title: "Level" },
	{ field: "LevelDesc", width: "150px", title: "Level Desc." },
	{ field: "action",width: "100px", title: "Action" }
	]
});
});          
</script>