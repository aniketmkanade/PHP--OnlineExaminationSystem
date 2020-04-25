<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
	?>	
	<!-- Wrapper Code  -->
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Results</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                        </div>
                    </div>
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
				$result = (executeQuery("SELECT `testid`, `testname`, `testdesc`,
				`duration`, `totalquestions`, `attemptedstudents` FROM `test` "));
			//Correct Answer Error
				$rowcount= mysqli_num_rows($result);
				$counter=1;
				while($r = mysqli_fetch_array($result))
				{
					echo '{ TestID:"'.$r['testid'].'",TestName:"'.$r['testname'].'", TestDesc:"'.$r['testdesc'].'",
					Duration:"'.$r['duration'].'", TotalQuestions:"'.$r['totalquestions'].'",
					AttemptedStudents:"'.$r['attemptedstudents'].'"}';
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
				{ field: "TestID", width: "100px", title: "TestID" },
				{ field: "TestName", width: "100px", title: "TestName" },
				{ field: "TestDesc", width: "100px", title: "TestDesc" },
				{ field: "Duration", width: "100px", title: "Duration" },
				{ field: "TotalQuestions", width: "100px", title: "TotalQuestions" },
				{ field: "AttemptedStudents", width: "100px", title: "AttemptedStudents" }
				]
			});
	});  	
</script>