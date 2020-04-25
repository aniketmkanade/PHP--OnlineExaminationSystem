<?php//(PROBLEM IN FILE SYNTAX ERROR)
//error_reporting(0);
//session_start();
include_once 'oesdb.php';
/************************** Step 1 *************************/

/*******************Add the new user information in the database *****************/
//http://localhost:8080/oes/api/studReg.php?operation=save&uname=abc&password=abc&email=abc@ex.com&contact=9999999999&address=abcdefgh&city=abcd&pin=431001
 if(isset($_REQUEST['operation'])&&$_REQUEST['operation']=="save")
{
     $result=executeQuery("select max(stdid) as std from student");
     $r=mysqli_fetch_assoc($result);
     if(is_null($r['std']))
     $newstd=1;
     else
     $newstd=$r['std']+1;

     $result=executeQuery("select stdname as std from student where stdname='".htmlspecialchars($_REQUEST['uname'],ENT_QUOTES)."';");

    if(mysqli_num_rows($result)>0)
    {
        echo "unavailable";
    }
    else
    {
		 $query="insert into student values($newstd,'".htmlspecialchars($_REQUEST['uname'],ENT_QUOTES)."',ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','".$pass_enc."'),'".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['contact'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['address'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['city'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['pin'],ENT_QUOTES)."')";
		 
		 if(executeQuery($query))
			echo "success :".$newstd;
		 else
			echo "fail";
    }
    closedb();
}
/************************** updating the modified values *************************/
//http://localhost:8080/oes/api/studReg.php?operation=update&uname=abc&password=abc&email=abc@ex.com&contact=9999999999&address=abcdefgh&city=abcd&pin=431001&stdid=1
if(isset($_REQUEST['operation'])&&$_REQUEST['operation']=="update")
{
    $query="update student set stdname='".htmlspecialchars($_REQUEST['uname'],ENT_QUOTES)."', stdpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','".$pass_enc."'),emailid='".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."',contactno='".htmlspecialchars($_REQUEST['contact'],ENT_QUOTES)."',address='".htmlspecialchars($_REQUEST['address'],ENT_QUOTES)."',city='".htmlspecialchars($_REQUEST['city'],ENT_QUOTES)."',pincode='".htmlspecialchars($_REQUEST['pin'],ENT_QUOTES)."' where stdid='".$_REQUEST['student']."';";
    if(executeQuery($query))
        echo "success";
    else
        echo "fail";
    
    closedb();
}


/************************** Get All Student info(done) *************************/
//http://localhost:8080/oes/api/studReg.php?operation=showAll
if(isset($_REQUEST['operation'])&&$_REQUEST['operation']=="showAll")
{
    $query="select stdid,stdname,DECODE(stdpassword,'".$pass_enc."') as stdpass ,emailid,contactno,address,city,pincode from student;";
	
	if($result=executeQuery($query))
	{	
		if(mysqli_num_rows($result)>0) 
		{
			while($r=mysqli_fetch_assoc($result))
			{
				$rows[]=$r;
			}
			echo json_encode($rows);
		}
		closedb();
	}
	else
		//echo "fail";
    
}

/************************** Get Student info by ID (done)*************************/
//http://localhost:8080/oes/api/studReg.php?operation=showById&stdid=1
if(isset($_REQUEST['operation'])&&$_REQUEST['operation']=="showById")
{
    $query="select stdid,stdname,DECODE(stdpassword,'".$pass_enc."') as stdpass ,emailid,contactno,address,city,pincode from student where stdid='".$_REQUEST['stdid']."';";
	
	if($result=executeQuery($query))
	{	
		if(mysqli_num_rows($result)>0) 
		{
			while($r=mysqli_fetch_assoc($result))
			{
				$rows[]=$r;
			}
			echo json_encode($rows);
		}
	closedb();
	}
	else
		echo "fail";
}


/************************** Get Student info by Name *************************/
//http://localhost:8080/oes/api/studReg.php?operation=showByName&stdname=1
if(isset($_REQUEST['operation'])&&$_REQUEST['operation']=="showByName")
{
    $query="select stdid,stdname,DECODE(stdpassword,'".$pass_enc."') as stdpass ,emailid,contactno,address,city,pincode from student where stdname like '%".$_REQUEST['stdname']."%';";
	
	if($result=executeQuery($query))
	{	
		if(mysqli_num_rows($result)>0) 
		{
			while($r=mysqli_fetch_assoc($result))
			{
				$rows[]=$r;
			}
			echo json_encode($rows);
		}
	closedb();
	}
	else
		echo "fail";
}
?>