<?php   include_once("assets/includes/header.inc");
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
			$query="UPDATE `course` SET
			`coursename`='".$_REQUEST['txt_course_name']."',
			`coursedesc`='".$_REQUEST['txt_course_discription']."',
			`instid`='".$_SESSION['instid']."',
			`isactive`='".$_REQUEST['is_active']."' 
			WHERE courseid=".$_REQUEST['id'];
			echo $query;		
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
		$query="INSERT INTO `course`(`coursename`, `coursedesc`,`instid`, `isactive`) VALUES
		('".$_REQUEST['txt_course_name']."','".$_REQUEST['txt_course_discription']."','".$_SESSION['instid']."', '".$_REQUEST['is_active']."')";
		echo  $query;
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Course Registration Successful...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Query not fired...!!!')</script>";
		}
	}
}
/*----------------------------------------------- Deletion Process ------------------------------------------------*/
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'delete')
	{
		$query="DELETE FROM `course` WHERE courseid=".$_REQUEST['id'];
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Course Deletion Successful...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Course Deletion Not Successful...!!!')</script>";
		}
	}
}
/* ---------------------------------------------Data Retriving Process------------------------------------------------*/
$coursename ="";
$coursedesc="";
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'edit')
	{
		$query="SELECT * FROM `course` WHERE courseid='".$_REQUEST['id']."' and instid='".$_SESSION['instid']."'";
		if($result = (executeQuery($query)))
		{				
			if($result->num_rows > 0 && $r = mysqli_fetch_array($result))
			{
				$coursename = $r['coursename'];
				$coursedesc = $r['coursedesc'];
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
<!---------------------------------------- Page Wrapper Design ------------------------------------------------------->		
		<div id="page-wrapper">
            <div class="row">
				<div class="col-lg-3">
				</div>
                <div class="col-lg-6">
				<h1>Courses Regestration</h1><br>
                    <form role="form">
						<div class="form-group">
                            <label>Course Name</label>
                            <input class="form-control" id="txt_course" name="txt_course_name" placeholder="Enter text"
							value ="<?php echo $coursename;?>"
							>
                        </div>
						<div class="form-group">
                            <label>Course Discription</label>
                            <textarea class="form-control" id="txt_course_discription" name="txt_course_discription" rows="3">
							<?php echo $coursedesc;?>
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
									<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Courses List :</h3>
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
<!------------------------------------------------- JavaScript Code --------------------------------------------------->
<script type="text/javascript">
	jQuery(function ($) 
	{	
		var traffic = [
			<?php
				$result = (executeQuery("SELECT * FROM `course` where instid='".$_SESSION['instid']."'"));
			
				$rowcount= mysqli_num_rows($result);
				$counter=1;
				while($r = mysqli_fetch_array($result))
				{
					echo '{ 
					coursename:"'.$r['coursename'].'", 
					coursedesc:"'.$r['coursedesc'].'", 
					action:"<a href=\'?action=edit&id='.$r['courseid'].' \' class=\'btn btn-success\'><i class=\'fa fa-pencil\'></i></a>&nbsp;<a href=\'?action=delete&id='.$r['courseid'].' \' class=\'btn btn-danger\'><i class=\'fa fa-trash\'></i></a>",}';
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
				{ field: "coursename", width: "175px", title: "Course" },
				{ field: "coursedesc",width: "200px", title: "Description" }  ,
				{ field: "action",width: "200px", title: "Action" }
				]
			});			
	});  	
</script>	