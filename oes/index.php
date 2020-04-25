<?php
	error_reporting(0);
      session_start();
      include_once 'oesdb.php';
/***************************** Step 1 : Case 1 ****************************/
 //redirect to registration page
      if(isset($_REQUEST['stdReg']))
      {
            header('Location: register.php');
      }
/***************************** Step 1 : Case 2 ****************************/
      else if(isset($_REQUEST['stdsubmit']))
      {
		//Perform Authentication
          $result=executeQuery("select *,DECODE(stdpassword,'".$pass_enc."') as std from student where stdname='".htmlspecialchars($_REQUEST['name'],ENT_QUOTES)."' and stdpassword=ENCODE('".htmlspecialchars($_REQUEST['password'],ENT_QUOTES)."','".$pass_enc."')");
          if(mysqli_num_rows($result)>0)
          {
			$r=mysqli_fetch_array($result);
              if(strcmp(htmlspecialchars_decode($r['std'],ENT_QUOTES),(htmlspecialchars($_REQUEST['password'],ENT_QUOTES)))==0)
              {
                  $_SESSION['stdname']=htmlspecialchars_decode($r['stdname'],ENT_QUOTES);
                  $_SESSION['stdid']=$r['stdid'];
                  unset($_GLOBALS['message']);
                  header('Location: stdwelcome.php');
              }
			  else
			  {
				  $_GLOBALS['message']="Check Your user name and Password.";
			  }
          }
          else
          {
              $_GLOBALS['message']="Check Your user name and Password.";
          }
          closedb();
      }
 ?>

   
<?php include_once 'header.php' ?>
    <form id="stdloginform" action="index.php" method="post">
		
		<div class="page">
            <table cellpadding="30" cellspacing="10">
				<tr>
					<td>User Name</td>
					<td><input type="text" tabindex="1" name="name" value="" size="16" /></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" tabindex="2" name="password" value="" size="16" />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
                      <input type="submit" tabindex="3" value="Log In" name="stdsubmit" class="subbtn" />
					  <input type="submit" tabindex="4" value="Register" name="stdReg" class="subbtn" />
					</td>
				</tr>
            </table>
		
      </div>
    </form>
<?php include_once 'footer.php'; ?> 
