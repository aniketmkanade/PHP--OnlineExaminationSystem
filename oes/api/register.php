<?php
//http://localhost:8080/oes/api/register.php?cname=s3&password=s3&email=s3@example.com&contactno=9999999999&address=ddddd&city=ppppp&pin=444444
include_once 'oesdb.php';

 /***************************** Step 1 : Case 1 ****************************/
 //Add the new user information in the database
     $result=executeQuery("select max(stdid) as std from student");
     $r=mysqli_fetch_array($result);
     if(is_null($r['std']))
     $newstd=1;
     else
     $newstd=$r['std']+1;

     $result=executeQuery("select stdname as std from student where stdname='".htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)."';");

    // $_GLOBALS['message']=$newstd;
    if(empty($_REQUEST['cname'])||empty ($_REQUEST['password'])||empty ($_REQUEST['email']))
    {
         echo"Some of the required Fields are Empty";
    }else if(mysqli_num_rows($result)>0)
    {
        echo"Sorry the User Name is Not Available Try with Some Other name.";
    }
    else
    {
     $query="insert into student values($newstd,'".htmlspecialchars($_REQUEST['cname'],ENT_QUOTES)."',
	 ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','".$pass_enc."'),
	 '".htmlspecialchars($_REQUEST['email'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['contactno'],ENT_QUOTES)."',
	 '".htmlspecialchars($_REQUEST['address'],ENT_QUOTES)."','".htmlspecialchars($_REQUEST['city'],ENT_QUOTES)."',
	 '".htmlspecialchars($_REQUEST['pin'],ENT_QUOTES)."')";
     if(!@executeQuery($query))
                echo"query not found";
     else
     {
        $success=true;
        echo"Success:".$newstd;
       // header('Location: index.php');
     }
    }
    closedb();
?>
<?php
//include_once 'header.php'
//if(!$success):
	//endif;
//if($success)
//{
//echo "<h2 style=\"text-align:center;color:#0000ff;\">Thank You For Registering with Online Examination System.<br/><a href=\"index.php\">Login Now</a></h2>";
//} 
?>