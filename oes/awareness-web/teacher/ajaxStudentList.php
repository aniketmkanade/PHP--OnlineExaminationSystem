<?php
//Include database configuration file
include_once 'dbconfig.php';

if(isset($_POST["batchID"]) && !empty($_POST["batchID"])){
    //Get all course data
    if($result = (executeQuery("SELECT * FROM `student`s , allotbatchtostudent b where s.userid=b.studid and b.batchid=".$_POST["batchID"])))
	{ 
		echo "<input type='hidden' id='hdn_stud_count' name='hdn_stud_count' value='$result->num_rows' />";
		while($r = mysqli_fetch_array($result))
		{
			echo 	"<tr>
						<th scope='row' class='text-center'>
							<input type='checkbox' checked name='s_".$r['userid']."' id='s_".$r['userid']."'>
						</th>
						<td class='text-center'>".$r['fname'].' '.$r['mname'].' '.$r['lname']."</td>
						<td class='text-center'>".$r['studentcode']."</td>
					</tr>";
		}
	}
}


?>