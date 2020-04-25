<?php
include_once 'oesdb.php';
if(isset($_REQUEST['resume'])) 
{
	if($r=mysqli_fetch_array($result=executeQuery("select testname from test where testid=".$_REQUEST['resume'].";"))) 
	{
	$_REQUEST['testname']=htmlspecialchars_decode($r['testname'],ENT_QUOTES);
	$_REQUEST['testid']=$_REQUEST['resume'];
	}
}
else if(isset($_REQUEST['resumetest'])) 
{
	if(!empty($_REQUEST['tc'])) 
	{
		$result=executeQuery("select DECODE(testcode,'".$pass_enc."') as tcode from test where testid=".$_REQUEST['testid'].";");

		if($r=mysqli_fetch_array($result)) 
		{
			if(strcmp(htmlspecialchars_decode($r['tcode'],ENT_QUOTES),htmlspecialchars($_REQUEST['tc'],ENT_QUOTES))!=0) 
			{
				$display=true;
				$_GLOBALS['message']="You have entered an Invalid Test Code.Try again.";
			}
			else {
			//now prepare parameters for Test Conducter and redirect to it.

				$result=executeQuery("select totalquestions,duration from test where testid=".$_REQUEST['testid'].";");
				$r=mysqli_fetch_array($result);
				$_REQUEST['tqn']=htmlspecialchars_decode($r['totalquestions'],ENT_QUOTES);
				$_REQUEST['duration']=htmlspecialchars_decode($r['duration'],ENT_QUOTES);
				$result=executeQuery("select DATE_FORMAT(starttime,'%Y-%m-%d %H:%i:%s') as startt,DATE_FORMAT(endtime,'%Y-%m-%d %H:%i:%s') as endt from studenttest where testid=".$_REQUEST['testid']." and stdid=".$_REQUEST['stdid'].";");
				$r=mysqli_fetch_array($result);
				$_REQUEST['starttime']=$r['startt'];
				$_REQUEST['endtime']=$r['endt'];
				$_REQUEST['qn']=1;
				header('Location: testconducter.php');
			}

		}
		else {
			$display=true;
			$_GLOBALS['message']="You have entered an Invalid Test Code.Try again.";
		}
	}
	else {
		$display=true;
		$_GLOBALS['message']="Enter the Test Code First!";
	}
}

 if(isset($_REQUEST['stdname'])) {
    if(isset($_REQUEST['resume'])) {
        echo "<div class=\"pmsg\" style=\"text-align:center;\">What is the Code of ".$_REQUEST['testname']." ? </div>";
    }
    else {
        echo "<div class=\"pmsg\" style=\"text-align:center;\">Tests to be Resumed</div>";
    }
	if(isset($_REQUEST['resume'])|| $display==true) 
	{
    }
    else 
	{
        $result=executeQuery("select t.testid,t.testname,DATE_FORMAT(st.starttime,'%d %M %Y %H:%i:%s') as startt,sub.subname as sname,TIMEDIFF(st.endtime,CURRENT_TIMESTAMP) as remainingtime from subject as sub,studenttest as st,test as t where sub.subid=t.subid and t.testid=st.testid and st.stdid=".$_REQUEST['stdid']." and st.status='inprogress' order by st.starttime desc;");
        if(mysqli_num_rows($result)==0) {
            echo"<h3 style=\"color:#0000cc;text-align:center;\">There are no incomplete exams, that needs to be resumed! Please Try Again..!</h3>";
        }
        else 
		{
			while($r=mysqli_fetch_array($result)) {
			$i=$i+1;
			if($r['remainingtime']<0) 
			{
            }
		}

	}
	closedb();
            }
?>