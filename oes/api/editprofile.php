<?php
//http://localhost:8080/oes/api/editprofile.php?cname=s3&password=s3&email=s3@example.com&contactno=9999888888&address=ddddd&city=ppppp&pin=444444&student=4
include_once 'oesdb.php';
    if(empty($_REQUEST['cname'])||empty ($_REQUEST['password'])||empty ($_REQUEST['email']))
    {
         //echo"Some of the required Fields are Empty.Therefore Nothing is Updated";
    }
    else
    {
		 $query="update student set stdname='".htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)."',
		 stdpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','".$pass_enc."'),
		 emailid='".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."',contactno='".htmlspecialchars($_REQUEST['contactno'],
		 ENT_QUOTES)."',address='".htmlspecialchars($_REQUEST['address'],ENT_QUOTES)."'
		 ,city='".htmlspecialchars($_REQUEST['city'],ENT_QUOTES)."',pincode='".htmlspecialchars($_REQUEST['pin'],ENT_QUOTES)."'
		 where stdid='".$_REQUEST['student']."';";
		 
		 if(!@executeQuery($query))
		 {}
		 else
			echo"Success:".$_REQUEST['student'];
    }
    closedb();

// if(isset($_REQUEST['stdname'])) {
	//$result=executeQuery("select stdid,stdname,DECODE(stdpassword,'".$pass_enc."') as stdpass ,emailid,contactno,
	//address,city,pincode from student where stdname='".$_REQUEST['stdname']."';");
	//if(mysqli_num_rows($result)==0) 
	//{
	//	echo"fields are empty";
	//}
	//else if($r=mysqli_fetch_array($result))
	//{
?>           