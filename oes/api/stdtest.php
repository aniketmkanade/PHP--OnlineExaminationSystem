<?php
include_once 'oesdb.php';
if (isset($_REQUEST['Operation']) && $_REQUEST['Operation']=="starttest") 
{
    if (!empty($_REQUEST['tc'])) 
	{
        $result = executeQuery("select DECODE(testcode,'".$pass_enc."') as tcode from test where testid=" . $_REQUEST['testid'] . ";");
        if ($r = mysqli_fetch_array($result)) 
		{
            if (strcmp(htmlspecialchars_decode($r['tcode'], ENT_QUOTES), htmlspecialchars($_REQUEST['tc'], ENT_QUOTES)) != 0) 
			{
                $display = true;
                echo"You have entered an Invalid Test Code.Try again.";
            } 
			else 
			{
                $result = executeQuery("select * from question where testid=" . $_REQUEST['testid'] . " order by qnid;");
                if (mysqli_num_rows($result) == 0) 
				{
                    echo"Tests questions cannot be selected.Please Try after some time!";
                } else 
				{ 
                    $error = false;
                    if (!executeQuery("insert into studenttest values(" . $_REQUEST['stdid'] . "," . $_REQUEST['testid'] . ",
					(select CURRENT_TIMESTAMP),date_add((select CURRENT_TIMESTAMP),INTERVAL (select duration from test where
					testid=" . $_REQUEST['testid'] . ") MINUTE),0,'inprogress')"))
                        echo"error" . mysqli_error();
                    else 
					{
                        while ($r = mysqli_fetch_array($result)) 
						{
                            if (!executeQuery("insert into studentquestion values(" . $_REQUEST['stdid'] . ",
							" . $_REQUEST['testid'] . "," . $r['qnid'] . ",'unanswered',NULL)")) 
							{
                                echo"Failure while preparing questions for you.Try again";
                                $error = true;
                            }
                        }
                        if ($error == true) {
                      //      executeQuery("rollback;");
                        } 
						else 
						{
                            $result = executeQuery("select totalquestions,duration from test where testid=" . $_REQUEST['testid'] . ";");
                            $r = mysqli_fetch_assoc($result);
                            $_REQUEST['tqn'] = htmlspecialchars_decode($r['totalquestions'], ENT_QUOTES);
                            $_REQUEST['duration'] = htmlspecialchars_decode($r['duration'], ENT_QUOTES);
                            $result = executeQuery("select DATE_FORMAT(starttime,'%Y-%m-%d %H:%i:%s') as startt,
							DATE_FORMAT(endtime,'%Y-%m-%d %H:%i:%s') as endt from studenttest where testid=" . $_REQUEST['testid'] . " 
							and stdid=" . $_REQUEST['stdid'] . ";");
                            $r = mysqli_fetch_assoc($result);
                            $_REQUEST['starttime'] = $r['startt'];
                            $_REQUEST['endtime'] = $r['endt'];
                            $_REQUEST['qn'] = 1;
                            header('Location: testconducter.php');
                        }
                    }
                }
            }
        } 
		else 
		{
            $display = true;
            echo"You have entered an Invalid Test Code.Try again.";
        }
    } 
	else 
	{
        $display = true;
        echo"Enter the Test Code First!";
    }
}
 
else if (isset($_REQUEST['Operation']) && $_REQUEST['Operation']=='testcode') 
{
    //test code preparation
    if ($r = mysqli_fetch_assoc($result = executeQuery("select testid from test 
	where testname='" . htmlspecialchars($_REQUEST['testcode'], ENT_QUOTES) . "';"))) 
	{
        $_REQUEST['testname'] = $_REQUEST['testcode'];
        $_REQUEST['testid'] = $r['testid'];
    }
}
 
else if (isset($_REQUEST['savem'])) 
{
    if (empty($_REQUEST['cname']) || empty($_REQUEST['password']) || empty($_REQUEST['email'])) 
	{
        $_GLOBALS['message'] = "Some of the required Fields are Empty.Therefore Nothing is Updated";
    } 
	else 
	{
        $query = "update student set stdname='" . htmlspecialchars($_REQUEST['cname'], ENT_QUOTES) . "',
		stdpassword=ENCODE('" . htmlspecialchars($_REQUEST['password'], ENT_QUOTES) . "','".$pass_enc."'),
		emailid='" . htmlspecialchars($_REQUEST['email'], ENT_QUOTES) . "',
		contactno='" . htmlspecialchars($_REQUEST['contactno'], ENT_QUOTES) . "',
		address='" . htmlspecialchars($_REQUEST['address'], ENT_QUOTES) . "',
		city='" . htmlspecialchars($_REQUEST['city'], ENT_QUOTES) . "',
		pincode='" . htmlspecialchars($_REQUEST['pin'], ENT_QUOTES) . "'
		where stdid='" . $_REQUEST['student'] . "';";
        if (!@executeQuery($query))
            echo"query not found";
        else
            echo"Your Profile is Successfully Updated.";
    }
    closedb();
}

if (isset($_REQUEST['stdname'])) 
{
	if (isset($_REQUEST['testcode'])) 
	{
		echo "<div class=\"pmsg\" style=\"text-align:center;\">What is the Code of " . $_REQUEST['testname'] . " ? </div>";
	} 
	else 
	{
		echo "Offered Tests";
	}
	if (isset($_REQUEST['testcode']) || $display == true) 
	{
	} 
	else 
	{
		$result = executeQuery("select t.*,s.subname from test as t, subject as s where s.subid=t.subid and
		CURRENT_TIMESTAMP<t.testto and t.totalquestions=(select count(*) from question where testid=t.testid)
		and NOT EXISTS(select stdid,testid from studenttest where testid=t.testid and stdid=" . $_REQUEST['stdid'] . ");");
		if (mysqli_num_rows($result) == 0) 
		{
			echo"Sorry...! For this moment, You have not Offered to take any tests";
		} 
		else 
		{
			//editing components
			while ($r = mysqli_fetch_assoc($result)) 
			{
				$rows[]=$r;
			}
			echo json_encode($rows);
		}
		closedb();
	}
}
?>