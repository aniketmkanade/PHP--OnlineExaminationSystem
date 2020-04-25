<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
if(isset($_REQUEST['btn_submit']))
{
	$opcols="";
	$opvals="";
	
	for($i=1; $i<=6;$i++)
	{
		if(isset($_REQUEST['txt_option_'.$i]))
		{
			$opcols=$opcols.",option".$i;
			$opvals=$opvals.",'".$_REQUEST['txt_option_'.$i]."'";
		}
	}
	$query="INSERT INTO `question`(`courseid`, `levelid`, `subid`, `topicid`,`qtypeid`,`question`".$opcols.", `correctanswer`, `isactive`) VALUES 
	('".$_REQUEST['ddl_course']."','".$_REQUEST['ddl_level']."','".$_REQUEST['ddl_subject']."','".$_REQUEST['ddl_topic']."',
	'".$_REQUEST['ddl_qtype']."','".$_REQUEST['txt_question']."' ".$opvals.",'".$_REQUEST['txt_correct_answer']."',".$_REQUEST['txt_is_active'].")";
	
	if($result = (executeQuery($query)))
	{
		$last_id = mysqli_insert_id($conn);
					
		echo"<script>alert('Question Successfully Added...!!!')</script>";
		if(isset($_REQUEST["file_img"]))
		{
			$target_dir = "../qImages/";
			$target_file = $target_dir . basename($_FILES["file_img"]["name"]);
			
			if($_FILES["file_img"]["error"]>0)
			{
				echo '<script >alert ("Error:--'.$_FILES["file_img"]["error"].'");</script>';
				
			}
			else if (file_exists($target_file))
				echo '<script >alert ("Already Exist.");</script>';
			else
			{
				echo '<script >alert ("has file");</script>';
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				//$imageFileType = explode(".", $_FILES["file_img"]["name"]);
				echo '<script >alert ("'.$imageFileType.'");</script>';
				if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
					|| $imageFileType == "gif" )
				{
					$ext = explode(".", $_FILES["file_img"]["name"]);
					$newfilename = $last_id . '.' . end($ext);
					$target_file = $target_dir .$newfilename;
					if (move_uploaded_file($_FILES["file_img"]["tmp_name"], $target_file)) 
					{
						echo '<script >alert ("The file '. $newfilename.' has been uploaded.);</script>';
						
						$que="Update  question  set imagename='$newfilename' where qnid = $last_id";
						//echo '<script >alert ("'.$que.'");</script>';
						if($res=executeQuery($que))
						{
							echo '<script >alert ("Record Saved");</script>';
						}
						else
						{
							executeQuery("delete from question where qnid=".$last_id);
							echo '<script >alert ("'.mysqli_error($conn).'");</script>';
						}
					} 
					else 
					{
						executeQuery("delete from question where qnid=".$last_id);
						echo '<script >alert ("Sorry, there was an error uploading your file.");</script>';
					}
				}
				else
				{
					executeQuery("delete from question where qnid=".$last_id);
					echo '<script >alert ("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
				}
			}
		}
		else
		{
			executeQuery("delete from question where qnid=".$last_id);
			echo '<script >alert ("no file selected");</script>';
		}
	}
	else
	{
		echo"<script>alert('Query not fired...!!!')</script>";
	}
}
?>	
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
	$('#ddl_qtype').on('change',function(){
        var qtypeID = $(this).val();
        if(qtypeID){
            $.ajax({
                type:'POST',
                url:'ajaxOptions.php',
                data:'qtypeid='+qtypeID,
                success:function(html){
                    $('#questionSet').html(html);
                }
            }); 
        }else{
            $('#ddl_topic').html('<option value="">Select Subject first</option>'); 
        }
    });
});
</script>
	<!-- Wrapper Code  -->
<div id="page-wrapper">
		<form  method="get" role="form">
            <div class="row">
                <div class="col-sm-6">
					<h1>Question Bank</h1><br>
                    
						<div class="form-group">
                            <label>Selects Course</label>
                            <select id="ddl_course" name="ddl_course" class="form-control">
                                <option selected value="">Select Course</option>
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
                                <option selected value="">Select Level</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Selects Subject</label>
                            <select id="ddl_subject" name="ddl_subject" class="form-control">
                                <option selected value="">Select Subject</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Selects Topic</label>
                            <select id="ddl_topic" name="ddl_topic" class="form-control">
                                <option selected value="">Select Topic</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Question Type</label>
                            <select id="ddl_qtype" name="ddl_qtype" class="form-control">
                                <option selected value="">Select Question Type</option>
								<?php
								$result = executeQuery("SELECT `qtypeid`, `qtype`, `no_of_options`, `img`, `isactive` FROM `questiontype`");
								if($result->num_rows>0)
								{	while ($r = mysqli_fetch_array($result)) 
									{
										echo "<option value=\"" . $r['qtypeid'] . "\">" .$r['qtype']. "</option>";
									}
								}
								else
								{
									echo '<option value="">Question Type not available</option>';
								}
								?>
                            </select>
                        </div>
						<div class="form-group">
							<label>Status&nbsp </label><br>
							<label class="radio-inline">
								<input type="radio" id="txt_is_active" name="txt_is_active" value="1" checked="true">Enable</input>
							</label>
							<label class="radio-inline">
								<input type="radio" id="txt_is_active" name="txt_is_active" value="0">Disable</input>
							</label>
						</div>
				</div>
				<div class="col-sm-6" id="questionSet">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<input type="submit" id="btn_submit" name="btn_submit" class="btn btn-default" />
                    <input type="reset" id="btn_reset" name="btn_reset" class="btn btn-default" />
				</div>
			</div>
		</form>
<?php include_once("assets/includes/footer.inc"); ?>