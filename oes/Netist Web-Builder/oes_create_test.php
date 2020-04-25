<?php include_once("assets/includes/header.inc");
	  include_once("dbconfig.php");
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
?>
<!--Ajax Code For DDl Working-->
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#ddl_course').on('change',function(){
        var courseID = $(this).val();
        if(courseID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'course_id='+courseID,
                success:function(html){
                    $('#ddl_level').html(html);
                    $('#ddl_subject').html('<option value="">Select Level first</option>'); 
                }
            }); 
        }else{
            $('#ddl_level').html('<option value="">Select course first</option>');
            $('#ddl_subject').html('<option value="">Select Level first</option>');
			$('#ddl_topic').html('<option value="">Select Subject first</option>');
        }
    });
    
    $('#ddl_level').on('change',function(){
        var levelID = $(this).val();
        if(levelID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'level_id='+levelID,
                success:function(html){
                    $('#ddl_subject').html(html);
                }
            }); 
        }else{
            $('#ddl_subject').html('<option value="">Select Level first</option>');
			$('#ddl_topic').html('<option value="">Select Subject first</option>'); 
        }
    });
	
	$('#ddl_subject').on('change',function(){
        var subjectID = $(this).val();
        if(subjectID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'subject_id='+subjectID,
                success:function(html){
                    $('#ddl_topic').html(html);
                }
            }); 
        }else{
            $('#ddl_topic').html('<option value="">Select Subject first</option>'); 
        }
    });
    
});
</script>
<!-- Page Wrapper Design  -->
<div id="page-wrapper">
            <div class="row">
				<div class="col-lg-3">
				</div>
                <div class="col-lg-6">
				<h1>Add Exam</h1><br>
                    <form method="get">
						<div class="form-group">
                            <label>Selects Course</label>
                            <select id="ddl_course" name="ddl_course" class="form-control">
                              <option selected value="<Choose the Subject>">&lt;Choose the Course&gt;</option>
							  <?php
								$result = executeQuery("SELECT `courseid`, `coursename` FROM `course`");
								if($result->num_rows>0)
								{	while ($r = mysqli_fetch_array($result)) 
										echo "<option value=\"" . $r['courseid'] . "\">" .$r['coursename']. "</option>";
								}
								else
									echo '<option value="">Course not available</option>';
								?>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Selects Level</label>
                            <select id="ddl_level" name="ddl_level" class="form-control">
                            <option selected value="<Choose the Subject>">&lt;Choose the Level&gt;</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Subject Name</label>
                            <select id="ddl_subject" name="ddl_subject" class="form-control">
							 <option selected value="<Choose the Subject>">&lt;Choose the Subject&gt;</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Selects Topic</label>
                            <select id="ddl_topic" name="ddl_topic" class="form-control">
                            <option selected value="<Choose the Subject>">&lt;Choose the Topic&gt;</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Test Name</label>
                            <input id="txt_test_name" name="txt_test_name" class="form-control" placeholder="Enter Test Name">
                        </div>
						<div class="form-group">
                            <label>Test Discription</label>
                            <textarea id="txt_test_discription" name="txt_test_discription" class="form-control" rows="3"></textarea>
                        </div>
						<div class="form-group">
                            <label>Total Questions</label>
                            <input id="txt_total_questions" name="txt_total_questions" class="form-control" placeholder="Enter Total Questions">
                        </div>
						<div class="form-group">
                            <label>Duration(Mins)</label>
                            <input id="txt_duration" name="txt_duration" class="form-control" placeholder="Enter Duration(Mins)">
                        </div>
						<div class="form-group">
							<label>Status&nbsp </label><br>
							<label class="radio-inline">
								<input type="radio" id="txt_is_active" name="txt_is_active" value="1">Enable</input>
							</label>
							<label class="radio-inline">
								<input type="radio" id="txt_is_active" name="txt_is_active" value="0">Disable</input>
							</label>
						</div>
						<input type="submit" id="txt_submit" name="txt_submit" value="submit" class="btn btn-default" />
                        <input type="reset" id="txt_reset" name="txt_reset" value="reset" class="btn btn-default" />
					</form>
				</div>
				<div class="col-lg-3">
				</div>
            </div>
        </div>

<?php include_once("assets/includes/footer.inc"); ?>  	
<!--------------------------------------------------JavaScript Code---------------------------------------------------------->
<?php
if(isset($_GET['txt_submit']))
{	   
   //Add the new Test information in the database
    $noerror = true;
    $fromtime = $_REQUEST['txt_test_from'] . " " . date("H:i:s");
    $totime = $_REQUEST['txt_test_to'] . " 23:59:59";
    if (strtotime($fromtime) > strtotime($totime) || strtotime($fromtime) < (time() - 3600)) 
	{
        $noerror = false;
        $_GLOBALS['message'] = "Start date of test is either less than today's date or greater than last date of test.";
		echo"Start date of test is either less than today's date or greater than last date of test.";
    } 
	else if ((strtotime($totime) - strtotime($fromtime)) <= 3600 * 24) 
	{
        $noerror = true;
        $_GLOBALS['message'] = "Note:<br/>The test is valid upto " . date(DATE_RFC850, strtotime($totime));
    }
    //$_GLOBALS['message']="time".date_format($first, DATE_ATOM)."<br/>time ".date_format($second, DATE_ATOM);
    $result = executeQuery("select max(testid) as tst from test");
    $r = mysqli_fetch_array($result);
    if (is_null($r['tst']))
        $newstd = 1;
    else
        $newstd=$r['tst'] + 1;

	$_GLOBALS['message']=$newstd;
    if (strcmp($_REQUEST['txt_subject_name'], "<Choose the Subject>") == 0 
	|| empty($_REQUEST['txt_test_name']) 
	|| empty($_REQUEST['txt_test_discription'])
	|| empty($_REQUEST['txt_total_questions']) 
	|| empty($_REQUEST['txt_duration']))
	{
      $_GLOBALS['message'] = "Some of the required Fields are Empty";
    } 
	elseif ($noerror)	
	{	//all fields not selected
        $query = "INSERT INTO `test`(`testname`, `testdesc`,`courseid`, `levelid`, `subid`, `instid`, `totalquestions`,`isactive`) VALUES(
		'" .$_REQUEST['txt_test_name']. "',
		'" .$_REQUEST['txt_test_discription']. "',
		'" .$_REQUEST['ddl_course']. "',
		'" .$_REQUEST['ddl_level']. "',
		'" .$_REQUEST['ddl_subject']. "',
		'".$_SESSION['instid']."',
		'" .$_REQUEST['txt_total_questions']. "',
		'" .$_REQUEST['txt_is_active']. "')";
		echo $query;
		$result = executeQuery($query);
        if (!$result) 
		{
            if(mysqli_errno () == 1062) //duplicate value
			{
                echo"<script>alert('Given Test Name voilates some constraints, please try with some other name')</script>";
			}
            else
			{
                $_GLOBALS['message'] = mysqli_error();
			}
		}
        else
		{
            echo"<script>alert('Successfully New Test is Created')</script>";
		}
	}
}
closedb();
?>