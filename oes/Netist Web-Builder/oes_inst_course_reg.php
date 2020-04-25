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
				<div class="col-lg-3">
				</div>
                <div class="col-lg-6">
				<h1>Courses Regestration</h1><br>
                    <form role="form">
						<div class="form-group">
                            <label>Course Name</label>
                            <input id="txt_course_name" class="form-control" placeholder="Enter text">
                        </div>
						<div class="form-group">
                            <label>Course Discription</label>
                            <textarea id="txt_course_discription" class="form-control" rows="3"></textarea>
                        </div>
						<button type="submit" class="btn btn-default">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
					</form>
					<br/>
					<hr/>
					<br/>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Course List :</h3>
								</div>
								<div id="txt_course_list" class="panel-body">
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
	<!-- Page JavaScript coode  -->
	<script type="text/javascript">
        jQuery(function ($) {
            var traffic = [
                {
                    Course: "Course 1", Name: "Course Name 1"
                },
                {
                    Course: "Course 2", Name: "Course Name 2"
                },
                {
                    Course: "Course 3", Name: "Course Name 3"
                },
                {
                    Course: "Course 4", Name: "Course Name 4"
                },
                {
                    Course: "Course 5", Name: "Course Name 5"
                }];

           

            $("#shieldui-grid1").shieldGrid({
                dataSource: {
                    data: traffic
                },
                sorting: {
                    multiple: true
                },
                rowHover: false,
                paging: false,
                columns: [
                { field: "Course", width: "200px", title: "Course" },
                { field: "Name",width: "200px", title: "Name" },  
                ]
            });            
        });        
    </script>