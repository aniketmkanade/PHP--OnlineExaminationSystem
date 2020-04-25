<?php 
	include_once 'dbconfig.php';
		
	if(!session_start())
    {
        session_start();
    }
	if(isset($_GET['logout']))
		{
			SESSION_DESTROY();
			echo "<script>location='index.php'</script>";
		}
	if(!isset($_SESSION['instid']))
	{
		echo "<script>location='index.php'</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netist Web-Builder</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="css/light-bootstrap/all.min.css" />
    <link id="gridcss" rel="stylesheet" type="text/css" href="css/dark-bootstrap/all.min.css" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="oes_dashboard.php">Netist Web-Builder</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="active" class="nav navbar-nav side-nav">
					<li class="user-view">
						<a href="#">
							<img src="images/user.jpg"/> 
							<h4><?php echo $_SESSION['UserName']; ?></h4>
							<span> Web-Developer</span>
						</a>
					</li>
                    <li><a href="oes_dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
					<li class="dropdown">
						<a a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-list-ol"></i> Courses<span class="caret"></a>
						<ul class="dropdown-menu">
							<li><a href="oes_courses.php"><i class="fa fa-graduation-cap"></i>Add Courses</a></li>
							<li><a href="oes_level.php"><i class="fa  fa-sitemap"></i> Add Levels</a></li>
							<li><a href="oes_subject.php"><i class="fa fa-book"></i>Add Subjects</a></li>
							<li><a href="oes_topic.php"><i class="fa fa-list-ul"></i> Add Topics</a></li>
							<li><a href="oes_add_batch.php"><i class="fa fa-list-ul"></i> Add Batch</a></li>
						</ul>
					</li>
                    <li class="dropdown">
						<a a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-list-ol"></i> Question Bank<span class="caret"></a>
						<ul class="dropdown-menu">
							<li><a href="oes_question_list.php"><i class="fa fa-list-alt"></i> Question List</a></li>
							<li><a href="oes_question_bank.php"><i class="fa fa-question"></i> Add Question</a></li>
							<li><a href="oes_question_type.php"><i class="fa fa-list-ul"></i> Question Type</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa  fa-file-archive-o"></i> Exam Mgt.<span class="caret"></a>
						<ul class="dropdown-menu">
							<li><a href="oes_create_test.php"><i class="fa  fa-file-text-o"></i> Add Exam</a></li>
							<li><a href="oes_exam_list.php"><i class="fa fa-list-alt"></i> Exam List</a></li>
							<li><a href="oes_exam_schedule.php"><i class="fa fa-calendar"></i> Exam Schedule</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-folder-open-o"></i> Results<span class="caret"></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-table"></i> Result List</a></li>
							<li><a href="#"><i class="fa fa-list-alt"></i> Result Summary</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-folder-open-o"></i>  Student<span class="caret"></a>
						<ul class="dropdown-menu">
							<li><a href="oes_create_user.php"><i class="fa fa-user"></i> Add Student</a></li>
							<li><a href="oes_student_list.php"><i class="fa fa-user-secret"></i> Student List</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-folder-open-o"></i> Faculty <span class="caret"></a>
						<ul class="dropdown-menu">
							<li><a href="oes_employee_reg.php"><i class="fa fa-user"></i> Add Faculty</a></li>
							<li><a href="oes_faculty_list.php"><i class="fa fa-user-secret"></i> Faculty List</a></li>
						</ul>
					</li>
					<li><a href="oes_institute_reg.php"><i class="fa fa-institution"></i> Institute Details</a></li>
					<li class="dropdown">
						<a a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-folder-open-o"></i> Finance <span class="caret"></a>
						<ul class="dropdown-menu">
							<li>
							<a href="#"><i class="fa fa-user"></i> Inword</a>
							</li>
						</ul>
						<ul class="dropdown-menu">
							<li>
							<a href="#"><i class="fa fa-user"></i> Outword</a>
							</li>
						</ul>
						<ul class="dropdown-menu">
							<li>
							<a href="#"><i class="fa fa-user"></i> Reports</a>
							</li>
						</ul>
					</li>
					<li><a href="oes_number_generation.php"><i class="fa fa-institution"></i> Number Generation</a></li>
					<li><a href="otherincome.php"><i class="fa fa-institution"></i> Other Income</a></li>
					<li><a href="coursefees.php"><i class="fa fa-institution"></i> Course Fees</a></li>
                </ul>
				<ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title=" New Messages "><i class="fa fa-envelope-o"></i><sup class="badge">2</sup> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">2 New Messages</li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><i class="fa fa-bell"></i></span>
                                    <span class="message">Security alert</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><i class="fa fa-bell"></i></span>
                                    <span class="message">Security alert</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Go to Inbox <span class="badge">2</span></a></li>
                        </ul>
                    </li>
					<li class="dropdown messages-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Notifications"><i class="fa fa-bell-o"></i><sup class="badge">2</sup> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">2 Notifications</li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><i class="fa fa-bell"></i></span>
                                    <span class="message">Exam alert</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><i class="fa fa-bell"></i></span>
                                    <span class="message">Exam alert</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">View All <span class="badge">2</span></a></li>
                        </ul>
                    </li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['UserName']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="?logout=true"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <li>
                        <form class="navbar-search">
                            <input type="text" placeholder="Search" class="form-control">
                        </form>
                    </li>
                </ul>
        	</div>
        </nav>