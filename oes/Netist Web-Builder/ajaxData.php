<?php
//Include database configuration file
include_once 'dbconfig.php';

if(isset($_POST["course_id"]) && !empty($_POST["course_id"])){
    //Get all course data
    $query = executeQuery("SELECT * FROM level WHERE courseid = ".$_POST['course_id']." and isactive=1  ORDER BY levelname ASC");
   
    //Display level list
    if($query->num_rows > 0){
        echo '<option value="">Select Level</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['levelid'].'">'.$row['levelname'].'</option>';
        }
    }else{
        echo '<option value="">Level not available</option>';
    }
}

if(isset($_POST["level_id"]) && !empty($_POST["level_id"])){
    //Get all level data
    $query = executeQuery("SELECT * FROM subject WHERE levelid = ".$_POST['level_id']." and isactive=1 ORDER BY subname ASC");
    
    //Display subject list
    if($query->num_rows > 0){
        echo '<option value="">Select Subject</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['subid'].'">'.$row['subname'].'</option>';
        }
    }else{
        echo '<option value="">Subject not available</option>';
    }
}
if(isset($_POST["subject_id"]) && !empty($_POST["subject_id"])){
    //Get all subject data
    $query = executeQuery("SELECT * FROM topic WHERE subid = ".$_POST['subject_id']." and isactive=1 ORDER BY topicname ASC");
    //Display topic list
    if($query->num_rows > 0)
	{
        echo '<option value="">Select Topic</option>';
        while($row = $query->fetch_assoc())
		{ 
            echo '<option value="'.$row['topicid'].'">'.$row['topicname'].'</option>';
        }
    }
	else
	{
        echo '<option value="">Topic not available</option>';
    }
}
?>