<?php   include_once("assets/includes/header.inc");
		include_once 'dbconfig.php';
		if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
/* ---------------------------------------------Updation Process----------------------------------------------------*/
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'edit')
	{
		if(isset($_REQUEST['btn_submit']))
		{
			$query="UPDATE `questiontype` SET 
			`qtype`='".$_REQUEST['txt_question_type']."',
			`qtypedesc`='".$_REQUEST['txt_qtype_discription']."',
			`no_of_options`='".$_REQUEST['txt_no']."',
			`img`='".$_REQUEST['cb_incl_img']."',
			`isactive`='".$_REQUEST['txt_is_active']."' 
			WHERE 
			qtypeid=".$_REQUEST['id'];
			
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
		$query="INSERT INTO `questiontype`(`qtype`, `qtypedesc`, `no_of_options`, `img`, `isactive`) 
		VALUES 
		('".$_REQUEST['txt_question_type']."',
		'".$_REQUEST['txt_qtype_discription']."',
		'".$_REQUEST['txt_no']."',
		'".$_REQUEST['cb_incl_img']."',
		'".$_REQUEST['txt_is_active']."')";
		
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
/* ---------------------------------------------Deletion Process----------------------------------------------------*/
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'delete')
	{
		$query="DELETE FROM `questiontype` WHERE qtypeid=".$_REQUEST['id'];
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Question Type Deletion Successful...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Question Type Deletion Not Successful...!!!')</script>";
		}
	}
}
?>
<!------------------------------------------------ Page Wrapper Design --------------------------------------------------->	
		<div id="page-wrapper">
            <div class="row">
				<div class="col-lg-3">
				</div>
                <div class="col-lg-6">
				<h1>Question Type</h1><br>
                    <form role="form">
						<div class="form-group">
                            <label>Question Type</label>
                            <input class="form-control" id="txt_question_type" name="txt_question_type" placeholder="Enter text"
							<?php
							if(isset($_REQUEST['action']))
							{
								if($_REQUEST['action'] == 'edit')
								{
									$query="SELECT `qtypeid`, `qtype` FROM `questiontype` WHERE qtypeid=".$_REQUEST['id'];
									if($result = (executeQuery($query)))
									{
										while($r = mysqli_fetch_assoc($result))
										{
											echo "value =".$r['qtype'];
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
                            <label>Question Type Discription</label>
                            <textarea class="form-control" id="txt_qtype_discription" name="txt_qtype_discription" rows="3">
							<?php
							if(isset($_REQUEST['action']))
							{
								if($_REQUEST['action'] == 'edit')
								{
									$query="SELECT `qtypeid`, `qtypedesc` FROM `questiontype` WHERE qtypeid=".$_REQUEST['id'];
									if($result = (executeQuery($query)))
									{
										while($r = mysqli_fetch_assoc($result))
										{
											echo $r['qtypedesc'];
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
							<label>No. of Options</label>
                            <input type="number" id="txt_no" name="txt_no" class="form-control"
							<?php
							if(isset($_REQUEST['action']))
							{
								if($_REQUEST['action'] == 'edit')
								{
									$query="SELECT `qtypeid`, `no_of_options` FROM `questiontype` WHERE qtypeid=".$_REQUEST['id'];
									if($result = (executeQuery($query)))
									{
										while($r = mysqli_fetch_assoc($result))
										{
											echo "value =".$r['no_of_options'];
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
						<div class="checkbox">
							<label>
							  <input type="checkbox" id="cb_incl_img" name="cb_incl_img"
							<?php
							if(isset($_REQUEST['action']))
							{
								if($_REQUEST['action'] == 'edit')
								{
									$query="SELECT `qtypeid`, `img` FROM `questiontype` WHERE qtypeid=".$_REQUEST['id'];
									if($result = (executeQuery($query)))
									{
										while($r = mysqli_fetch_assoc($result))
										{
											if($r['img'] == 'on')
											{
												echo "checked";
											}
										}
									}
									else
									{
										echo"<script>alert('Course Deletion Not Successful...!!!')</script>";
									}
								}
							}
							
							?>
							  
							  > Include Image
							</label>
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
					<br/>
					<hr/>
					<br/>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Question List :</h3>
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
<!------------------------------------------------ JavaScript Code(Table)--------------------------------------------------->
<script type="text/javascript">
	jQuery(function ($) 
	{
		var traffic = [
			<?php
				$result =(executeQuery("SELECT * FROM `questiontype`"));
				$rowcount= mysqli_num_rows($result);
				$counter=1;
				while($r = mysqli_fetch_array($result))
				{
					echo '{ qtype:"'.$r['qtype'].'", 
							qtypedesc:"'.$r['qtypedesc'].'",
							no_of_options:"'.$r['no_of_options'].'",
							action:"<a href=\'?action=edit&id='.$r['qtypeid'].' \' class=\'btn btn-success\'><i class=\'fa fa-pencil\'></i></a>&nbsp;<a href=\'?action=delete&id='.$r['qtypeid'].' \' class=\'btn btn-danger\'><i class=\'fa fa-trash\'></i></a>",}';
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
				rowHover: true,
				paging: false,
				columns: [
				{ field: "qtype", width: "100px", title: "Question Type" },
				{ field: "qtypedesc", width: "100px", title: "Question Desc" },
				{ field: "no_of_options", width: "100px", title: "No Of Options" },
				{ field: "action",width: "100px", title: "Action" }  
				]
			});
	});  	
</script>	