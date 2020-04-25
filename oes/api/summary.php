<?php

include_once 'oesdb.php';
?>
<script type="text/javascript" >

<?php
	$elapsed=time()-strtotime($_REQUEST['starttime']);
	if(((int)$elapsed/60)<(int)$_REQUEST['duration'])
	{
		$result=executeQuery("select TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%H') as hour,TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%i') as min,TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%s') as sec from studenttest where stdid=".$_REQUEST['stdid']." and testid=".$_REQUEST['testid'].";");
		if($rslt=mysqli_fetch_assoc($result))
		{
		 //echo "var hour=".$rslt['hour'].";";
		 //echo "var min=".$rslt['min'].";";
		 //echo "var sec=".$rslt['sec'].";";
		}
		else
		{
			$_GLOBALS['message']="Try Again";
		}
		closedb();
	}
	else
	{
		//echo "var sec=01;var min=00;var hour=00;";
	}
?>
   </script>
           <form id="summary" action="summary.php" method="post">
<!--http://localhost:8080/oes/api/summary.php?stdname=abc&testid=123&stdid=123-->
<?php if(isset($_REQUEST['stdname'])) {
	$result=executeQuery("select * from studentquestion where testid=".$_REQUEST['testid']." and stdid=".$_REQUEST['stdid']." order by qnid ;");
	if(mysqli_num_rows($result)==0) {
	  //echo"Please Try Again";
	}
	else
	{
//editing components
		while($r=mysqli_fetch_assoc($result)) 
			{
				//echo $r['qnid'];
			if(strcmp(htmlspecialchars_decode($r['answered'],ENT_QUOTES),"unanswered")==0 ||strcmp(htmlspecialchars_decode($r['answered'],ENT_QUOTES),"review")==0)
				{
					//echo htmlspecialchars_decode($r['answered'],ENT_QUOTES);
				}
			else
				{
					//echo htmlspecialchars_decode($r['answered'],ENT_QUOTES);
				}
			//echo $r['qnid'];
			$rows[]=$r;
			}
			echo json_encode($rows);
		}
		closedb();
	}
?>