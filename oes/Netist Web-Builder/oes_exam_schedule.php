 <?php   include_once("assets/includes/header.inc");
		include_once 'dbconfig.php';
		if(!isset($_SESSION['instid']))
		{
			header('location:index.php');
		}
if(isset($_REQUEST['btn_submit']))
{
	$query="INSERT INTO `examschedule`(`testid`, `testfrom`, `testto`, `secretcode`) VALUES 
	('".$_REQUEST['txt_selects_test']."','".$_REQUEST['txt_test_from']."','".$_REQUEST['txt_test_to']."',
	'".$_REQUEST['txt_test_secret_code']."')";
	
	if($result = (executeQuery($query)))
	{
		echo"<script>alert('Course Registration Successful...!!!')</script>";
	}
	else
	{
		echo"<script>alert('Query not fired...!!!')</script>";
	}
}
else
{
	//echo"<script>alert('Button not pressed...!!!')</script>";
}
?>
<!-- Page Wrapper Design  -->		
		<div id="page-wrapper">
            <div class="row">
				<div class="col-lg-3">
				</div>
                <div class="col-lg-6">
				<h1>Exam Schedule</h1><br>
                    <form role="form">
						<div class="form-group">
                            <label>Select Test</label>
                            <select id="txt_selects_test" name="txt_selects_test" class="form-control">
							<option selected>Select Test</option>
                                <?php
								$result = (executeQuery("SELECT testid,`testname` FROM `test`"));
								while($r = mysqli_fetch_array($result))
								{
									echo "<option value='".$r['testid']."'>".$r['testname']."</option>";
								}
								?>
                            </select>
                        </div>
						<div class="form-group">
                            <label>From Date</label>
                            <input type="date" id="txt_test_from" name="txt_test_from" class="form-control" placeholder="Enter From Date">
                        </div>
						<div class="form-group">
                            <label>To Date</label>
                            <input type="date" id="txt_test_to" name="txt_test_to" class="form-control" placeholder="Enter To Date">
                        </div>
						<div class="form-group">
                            <label>Test Secret Code</label>
                            <input id="txt_test_secret_code" name="txt_test_secret_code" class="form-control" placeholder="Enter Secret Code">
                        </div>						
						<input type="submit" id="btn_submit" name="btn_submit" class="btn btn-default" />
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
	<!-- JavaScript Code  -->
<script type="text/javascript">
	jQuery(function ($) 
	{
	
		var traffic = [
			<?php
				$result = (executeQuery("SELECT `test`, `testfrom`, `testto`, `secretcode` FROM `examschedule`;"));
			
				$rowcount= mysqli_num_rows($result);
				$counter=1;
				while($r = mysqli_fetch_array($result))
				{
					echo '{ Test:"'.$r['test'].'", TestFrom:"'.$r['testfrom'].'"
					, TestTo:"'.$r['testto'].'", SecretCode:"'.$r['secretcode'].'"}';
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
				{ field: "Test", width: "100px", title: "Test" },
				{ field: "TestFrom", width: "100px", title: "TestFrom" },
				{ field: "TestTo", width: "100px", title: "TestTo" },
				{ field: "SecretCode",width: "100px", title: "SecretCode" }  
				]
			});
		
	});  	
</script>	