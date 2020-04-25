<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}?>	
<!--------------------------------------------------- Wrapper Code -------------------------------------------------->
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Students</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once("assets/includes/footer.inc"); ?>	
<!-------------------------------------------------- JavaScript Code ------------------------------------------------>
	<script type="text/javascript">
	jQuery(function ($) 
	{
		var traffic = [
			<?php
				$result = (executeQuery("SELECT * FROM `student`"));
				$rowcount= mysqli_num_rows($result);
				$counter=1;
				while($r = mysqli_fetch_array($result))
				{
					echo '{ instid:"'.$r['instid'].'",
					inst_stud_id:"'.$r['inst_stud_id'].'",
					name:"'.$r['fname'].'",
					contactno:"'.$r['contactno'].'",
					mobileno:"'.$r['mobileno'].'",
					emailid:"'.$r['emailid'].'",
					dob:"'.$r['dob'].'",
					age:"'.$r['age'].'",
					gender:"'.$r['gender'].'",
					studentcode:"'.$r['studentcode'].'",
					duration:"'.$r['duration'].'",
					doa:"'.$r['doa'].'",
					login_name:"'.$r['login_name'].'",
					password:"'.$r['password'].'"}';
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
				{ field: "instid", width: "50px", title: "instid" },
				{ field: "inst_stud_id", width: "50px", title: "inst_stud_id" },
				{ field: "name", width: "180px", title: "name" },
				{ field: "contactno", width: "70px", title: "contactno" },
				{ field: "mobileno", width: "70px", title: "mobileno" },
				{ field: "emailid", width: "90px", title: "emailid" },
				{ field: "dob", width: "50px", title: "dob" },
				{ field: "age", width: "50px", title: "age" },
				{ field: "gender", width: "50px", title: "gender" },
				{ field: "studentcode",width: "50px", title: "studentcode" },
				{ field: "duration", width: "50px", title: "duration" },
				{ field: "doa", width: "50px", title: "doa" },
				{ field: "login_name", width: "70px", title: "login_name" },
				{ field: "password", width: "70px", title: "password" }
				]
			});
	});  	
</script>