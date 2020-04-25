<?php
//Include database configuration file
include_once 'dbconfig.php';

if(isset($_POST["course_id"]) && !empty($_POST["course_id"])){
    //Get all course data
    $query = executeQuery("SELECT * FROM batch WHERE courseid = ".$_POST['course_id']." and status=1  ORDER BY batchname ASC");
   
    //Display level list
    if($query->num_rows > 0){
        echo '<option value="">Select Batch</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['batchid'].'">'.$row['batchname'].'</option>';
        }
    }else{
        echo '<option value="">Batch not available</option>';
    }
}
?>