<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}?>	
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
				$result = (executeQuery("SELECT `qnid`,`question`, `optiona`, `optionb`, `optionc`, `optiond`, `correctanswer`
				FROM `question`;"));
			//Correct Answer Error
				$rowcount= mysqli_num_rows($result);
				$counter=1;
				while($r = mysqli_fetch_array($result))
				{
					echo '{ QuestionID:"'.$r['qnid'].'",Question:"'.$r['question'].'", Optiona:"'.$r['optiona'].'",Optionb:"'.$r['optionb'].'",
					Optionc:"'.$r['optionc'].'", Optiond:"'.$r['optiond'].'", CorrectAnswer:"'.$r['correctanswer'].'"}';
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
				{ field: "QuestionID", width: "50px", title: "QID" },
				{ field: "Question", width: "200px", title: "Question" },
				{ field: "Optiona", width: "200px", title: "Option a" },
				{ field: "Optionb", width: "200px", title: "Option b" },
				{ field: "Optionc", width: "200px", title: "Option c" },
				{ field: "Optiond", width: "200px", title: "Option d" },
				{ field: "CorrectAnswer",width: "200px", title: "Answer" }  
				]
			});
	});  	
</script>