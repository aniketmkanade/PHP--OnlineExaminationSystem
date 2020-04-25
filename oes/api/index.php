<?php
//http://localhost:8080/oes/api/index.php?name=abc&password=abc
 include_once 'oesdb.php';

 /***************************** Student Login ****************************/
	$query="select *,DECODE(stdpassword,'".$pass_enc."') as std from student where stdname='".htmlspecialchars($_REQUEST['name'],ENT_QUOTES)."' and stdpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','".$pass_enc."')";
    
	if($result=executeQuery($query))
	{
       if(mysqli_num_rows($result)>0)
        {
			if($row=mysqli_fetch_assoc($result))
			{
				if(strcmp(htmlspecialchars_decode($row['std'],ENT_QUOTES),(htmlspecialchars($_REQUEST['password'],ENT_QUOTES)))==0)
					$rows[]=$row;
			}
			echo json_encode($rows); 
        }
        else
           // echo "fail1";
		  
        closedb();
	}
	else
		//echo "fail2";    
?>