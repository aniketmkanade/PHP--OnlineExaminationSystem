<?php
include_once 'oesdb.php';
$final=false;
if(isset($_REQUEST['next']) || isset($_REQUEST['summary']) || isset($_REQUEST['viewsummary']))
    {
	//next question
	$answer='unanswered';
	if(time()<strtotime($_REQUEST['endtime']))
	{
		if(isset($_REQUEST['markreview']))
		{
			$answer='review';
		}
		else if(isset($_REQUEST['answer']))
		{
			$answer='answered';
		}
		else
		{
			$answer='unanswered';
		}
		if(strcmp($answer,"unanswered")!=0)
		{
			if(strcmp($answer,"answered")==0)
			{
				$query="update studentquestion set answered='answered',
				stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' where stdid=".$_REQUEST['stdid']." and
				testid=".$_REQUEST['testid']." and qnid=".$_REQUEST['qn'].";";
			}
			else
			{
				$query="update studentquestion set answered='review',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."' 
				where stdid=".$_REQUEST['stdid']." and testid=".$_REQUEST['testid']." and qnid=".$_REQUEST['qn'].";";
			}
			if(!executeQuery($query))
			{
				echo"Your previous answer is not updated.Please answer once again";
			}
			closedb();
		}
	}
	if((int)$_REQUEST['qn']<(int)$_REQUEST['tqn'])
	{
	$_REQUEST['qn']=$_REQUEST['qn']+1;
   
	}
	if((int)$_REQUEST['qn']==(int)$_REQUEST['tqn'])
	{
	   $final=true;
	}
	}
    else if(isset($_REQUEST['previous']))
    {
    // Perform the changes for current question
        $answer='unanswered';
        if(time()<strtotime($_REQUEST['endtime']))
        {
            if(isset($_REQUEST['markreview']))
            {
                $answer='review';
            }
            else if(isset($_REQUEST['answer']))
            {
                $answer='answered';
            }
            else
            {
                $answer='unanswered';
            }
            if(strcmp($answer,"unanswered")!=0)
            {
                if(strcmp($answer,"answered")==0)
                {
                    $query="update studentquestion set answered='answered',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."'
					where stdid=".$_REQUEST['stdid']." and testid=".$_REQUEST['testid']." and qnid=".$_REQUEST['qn'].";";
                }
                else
                {
                    $query="update studentquestion set answered='review',stdanswer='".htmlspecialchars($_REQUEST['answer'],ENT_QUOTES)."'
					where stdid=".$_REQUEST['stdid']." and testid=".$_REQUEST['testid']." and qnid=".$_REQUEST['qn'].";";
                }
                if(!executeQuery($query))
                {
                // to do
                echo"Your previous answer is not updated.Please answer once again";
                }
                closedb();
            }
        }
        //previous question
        if((int)$_REQUEST['qn']>1)
        {
            $_REQUEST['qn']=$_REQUEST['qn']-1;
        }

    }
    else if(isset($_REQUEST['fs']))
    {
        //Final Submission
        header('Location: testack.php');
    }
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
?>
<!--<script type="text/javascript" >-->
<?php
	$elapsed=time()-strtotime($_REQUEST['starttime']);
	if(((int)$elapsed/60)<(int)$_REQUEST['duration'])
	{
		$result=executeQuery("select TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%H') as hour,
		TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%i') as min,TIME_FORMAT(TIMEDIFF(endtime,CURRENT_TIMESTAMP),'%s') as
		sec from studenttest where stdid=".$_REQUEST['stdid']." and testid=".$_REQUEST['testid'].";");
		if($rslt=mysqli_fetch_array($result))
		{
		 echo "var hour=".$rslt['hour'].";";
		 echo "var min=".$rslt['min'].";";
		 echo "var sec=".$rslt['sec'].";";
		}
		else
		{
			$_GLOBALS['message']="Try Again";
		}
		closedb();
	}
	else
	{
		echo "var sec=01;var min=00;var hour=00;";
	}
?>
    <!--</script>-->
<?php
if(isset($_REQUEST['stdname']))
{
	$result=executeQuery("select stdanswer,answered from studentquestion where stdid=".$_REQUEST['stdid']." and
	testid=".$_REQUEST['testid']." and qnid=".$_REQUEST['qn'].";");
	$r1=mysqli_fetch_array($result);
	$result=executeQuery("select * from question where testid=".$_REQUEST['testid']." and qnid=".$_REQUEST['qn'].";");
	$r=mysqli_fetch_array($result);
closedb();
}
?>