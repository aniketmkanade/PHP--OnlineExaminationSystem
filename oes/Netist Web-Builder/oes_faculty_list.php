<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
	?>	
<!--------------------------------------------------- Wrapper Code -------------------------------------------------->
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Faculty</h3>
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
				$result = (executeQuery("SELECT * FROM `testconductor`"));
				$rowcount= mysqli_num_rows($result);
				$counter=1;
				while($r = mysqli_fetch_array($result))
				{
					echo '{ instid:"'.$r['instid'].'",
					name:"'.$r['fname'].'",
					phone:"'.$r['phone'].'",
					mobile:"'.$r['mobile'].'",
					email:"'.$r['email'].'",
					dob:"'.$r['dob'].'",
					gender:"'.$r['gender'].'",
					facultycode:"'.$r['facultycode'].'",
					designation:"'.$r['designation'].'",
					doj:"'.$r['doj'].'",
					salary:"'.$r['salary'].'",
					loginname:"'.$r['loginname'].'",
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
				{ field: "instid", width: "50px", title: "Institute ID" },
				{ field: "name", width: "180px", title: "Name" },
				{ field: "phone", width: "70px", title: "Contact No" },
				{ field: "mobile", width: "70px", title: "Mobile No" },
				{ field: "email", width: "90px", title: "Email Id" },
				{ field: "dob", width: "50px", title: "DOB" },
				{ field: "gender", width: "50px", title: "Gender" },
				{ field: "facultycode", width: "50px", title: "Faculty Code" },
				{ field: "designation",width: "50px", title: "Designation" },
				{ field: "doj", width: "50px", title: "DOJ" },
				{ field: "salary", width: "50px", title: "Salary" },
				{ field: "loginname", width: "70px", title: "Login name" },
				{ field: "password", width: "70px", title: "password" }
				]
			});
	});  	
</script>