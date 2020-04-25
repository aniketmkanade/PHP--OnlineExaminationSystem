<?php
include_once 'oesdb.php';
//http://localhost:8080/oes/api/viewresult.php?stdname=s2&testid=1&stdid=3&sq.testid=1&stdid=3&testid=1					
if(isset($_REQUEST['stdname'])) 
{
	// Navigations

	if(isset($_REQUEST['details'])) 
	{
	$result=executeQuery("select s.stdname,t.testname,sub.subname,DATE_FORMAT(st.starttime,'%d %M %Y %H:%i:%s') as stime,
	TIMEDIFF(st.endtime,st.starttime) as dur,(select sum(marks) from question where testid=".$_REQUEST['details'].") as 
	tm,IFNULL((select sum(q.marks) from studentquestion as sq, question as q where sq.testid=q.testid and sq.qnid=q.qnid 
	and sq.answered='answered' and sq.stdanswer=q.correctanswer and sq.stdid=".$_REQUEST['stdid']." 
	and sq.testid=".$_REQUEST['details']."),0) as om from student as s,test as t, subject as sub,studenttest as st where
	s.stdid=st.stdid and st.testid=t.testid and t.subid=sub.subid and st.stdid=".$_REQUEST['stdid']." and
	st.testid=".$_REQUEST['details'].";") ;
		if(mysqli_num_rows($result)!=0) 
		{

			$r=mysqli_fetch_assoc($result);

			$result1=executeQuery("select q.qnid as questionid,q.question as quest,q.correctanswer as ca,sq.answered as status,
			sq.stdanswer as sa from studentquestion as sq,question as q where q.qnid=sq.qnid and sq.testid=q.testid and
			sq.testid=".$_REQUEST['details']." and sq.stdid=".$_REQUEST['stdid']." order by q.qnid;" );

			if(mysqli_num_rows($result1)==0) 
			{
				echo"<h3 style=\"color:#0000cc;text-align:center;\">1.Sorry because of some problems Individual questions Cannot be displayed.</h3>";
			}
			else 
			{
				while($r1=mysqli_fetch_assoc($result1)) 
				{

					if(is_null($r1['sa']))
					$r1['sa']="question"; //any valid field of question
					$result2=executeQuery("select ".$r1['ca']." as corans,IF('".$r1['status']."'='answered',(select ".$r1['sa']." from 
					question where qnid=".$r1['questionid']." and testid=".$_REQUEST['details']."),'unanswered') as stdans, 
					IF('".$r1['status']."'='answered',IFNULL((select q.marks from question as q, studentquestion as sq where
					q.qnid=sq.qnid and q.testid=sq.testid and q.correctanswer=sq.stdanswer and sq.stdid=".$_REQUEST['stdid']."
					and q.qnid=".$r1['questionid']." and q.testid=".$_REQUEST['details']."),0),0) as stdmarks from question
					where qnid=".$r1['questionid']." and testid=".$_REQUEST['details'].";");

					if($r2=mysqli_fetch_assoc($result2)) 
					{
						
							if($r2['stdmarks']==0) 
							{
								///echo"<td class=\"tddata\"><img src=\"images/wrong.png\" title=\"Wrong Answer\" height=\"30\" width=\"40\" alt=\"Wrong Answer\" /></td>";
							}
							else 
							{
								//echo"<td class=\"tddata\"><img src=\"images/correct.png\" title=\"Correct Answer\" height=\"30\" width=\"40\" alt=\"Correct Answer\" /></td>";
							}
					}
					else 
					{
						//echo"<h3 style=\"color:#0000cc;text-align:center;\">Sorry because of some problems Individual questions Cannot be displayed.</h3>".mysqli_error();
					}
				}

			}
		}
		else 
		{
			//echo"<h3 style=\"color:#0000cc;text-align:center;\">Something went wrong. Please logout and Try again.</h3>".mysqli_error();
		}
	}
	else 
	{
	$result=executeQuery("select st.*,t.testname,t.testdesc,DATE_FORMAT(st.starttime,'%d %M %Y %H:%i:%s') as startt from studenttest as st,
	test as t where t.testid=st.testid and st.stdid=".$_REQUEST['stdid']." and st.status='over' order by st.testid;");
	if(mysqli_num_rows($result)==0) 
	{
		//echo"Think You Haven't Attempted Any Exams Yet..! Please Try Again After Your Attempt";
	}
	else {
	//editing components

		while($r=mysqli_fetch_assoc($result)) 
		{
			$rows[]=$r;
		$om=0;
		$tm=0;
		$result1=executeQuery("select sum(q.marks) as om from studentquestion as sq, question as q where sq.testid=q.testid and
		sq.qnid=q.qnid and sq.answered='answered' and sq.stdanswer=q.correctanswer and sq.stdid=".$_REQUEST['stdid']."
		and sq.testid=".$r['testid']." order by sq.testid;");
		$r1=mysqli_fetch_assoc($result1);
		$result2=executeQuery("select sum(marks) as tm from question where testid=".$r['testid'].";");
		$r2=mysqli_fetch_assoc($result2);
		//echo "<td>".$r['startt']."</td><td>".htmlspecialchars_decode($r['testname'],ENT_QUOTES)." : ".htmlspecialchars_decode($r['testdesc'],ENT_QUOTES)."</td>";
			if(is_null($r2['tm'])) 
			{
				$tm=0;
			//	echo "$tm";
			}
			else 
			{
					$tm=$r2['tm'];
				//	echo "$tm";
			}
				if(is_null($r1['om'])) 
				{
					$om=0;
					//echo "$om";
				}
				else 
				{
					$om=$r1['om'];
					//echo "$om";
				}
				if($tm==0) 
				{
					//echo "0";
				}
				else 
				{
					//echo(($om/$tm)*100);
				}
				//echo"<td class=\"tddata\"><a title=\"Details\" href=\"viewresult.php?details=".$r['testid']."\"><img src=\"images/detail.png\" height=\"30\" width=\"40\" alt=\"Details\" /></a></td></tr>";
		}
		echo json_encode($rows);
		}
	}
closedb();
}
?>