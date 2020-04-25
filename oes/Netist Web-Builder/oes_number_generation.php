<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
	if(!isset($_SESSION['instid']))
	{
		header('location:index.php');
	}
/* ---------------------------------------------Update Process----------------------------------------------------*/
if(isset($_REQUEST['btn_submit']))
{	
	$queryS = 	"select * from `numbergeneration` where category='".$_REQUEST['ddl_category']."' and instid=".$_SESSION['instid'];
	if($result = (executeQuery($queryS)))
	{
		if(mysqli_num_rows($result)>0)
		{
			$queryU="UPDATE `numbergeneration` SET
			`category`='".$_REQUEST['ddl_category']."',
			`enable`='".$_REQUEST['cb_enable']."',
			`pre`='".$_REQUEST['txt_pre']."',
			`post`='".$_REQUEST['txt_post']."',
			`saperator`='".$_REQUEST['txt_saperator']."',
			`autoincrement`='".$_REQUEST['cb_autoincrement']."',
			`prepost`='".$_REQUEST['ddl_pre_post']."' where instid=".$_SESSION['instid']; 
			
			if($result = (executeQuery($queryU)))
			{
				echo"<script>alert('Invoice Updation Successful...!!!')</script>";
			}
			else
			{
				echo"<script>alert('Query not fired...!!!')</script>";
			}
		}
		else
		{
			$queryI="INSERT INTO `numbergeneration`(`instid`, `category`, `enable`, `pre`, `post`, `saperator`, `autoincrement`, `prepost`) VALUES ('".$_SESSION['instid']."','".$_REQUEST['ddl_category']."','".$_REQUEST['cb_enable']."','".$_REQUEST['txt_pre']."','".$_REQUEST['txt_post']."','".$_REQUEST['txt_saperator']."','".$_REQUEST['cb_autoincrement']."','".$_REQUEST['ddl_pre_post']."')"; 
			
			if($result = (executeQuery($queryI)))
			{
				echo"<script>alert('Invoice Insertion Successful...!!!')</script>";
			}
			else
			{
				echo"<script>alert('Query not fired...!!!')</script>";
			}
		}
	}
}
?>
<!------------------------------------------------ Wrapper Code----------------------------------------------------->
	<div id="page-wrapper">
            <div class="row">
				<div class="col-lg-3">
				</div>
                <div class="col-lg-6">
				<h1>Invoice</h1><br>
                    <form role="form">
					<div class="form-group">
						<label>Category</label>
						<select id="ddl_category" name="ddl_category" class="form-control">
							<option selected value="<Choose the Subject>">&lt;Choose the Course&gt;</option>
							<option>Other Income</option>
							<option>Fees recipt</option>
							<option>Expence</option>
							<option>Student Admission</option>
							<option>Exam</option>
							<option>Result</option>
							<option>Faculty</option>
						</select>
                    </div>
					<div class="row">
						<div class="col-lg-1 form-group">
							<label>Enable</label>
                            <input type="checkbox" id="cb_enable" name="cb_enable" value="1" class="form-control" >
                        </div>
					</div>
						<div class="form-group">
                            <label>Pre</label>
                            <input id="txt_pre" name="txt_pre" class="form-control" placeholder="Pre">
                        </div>
						<div class="form-group">
                            <label>Post</label>
                            <input id="txt_post" name="txt_post" class="form-control" placeholder="post">
                        </div>
						<div class="form-group">
                            <label>Saperator</label>
                            <input id="txt_saperator" name="txt_saperator" class="form-control" placeholder="saperator">
                        </div>
					<div class="row">
						<div class="col-lg-1 form-group">
                            <label>AutoIncrement</label>
                            <input type="checkbox" id="cb_autoincrement" name="cb_autoincrement" value="1" class="form-control">
                        </div>
					</div>
						<div class="form-group">
                            <label>Pre/Post</label>
                            <select id="ddl_pre_post" name="ddl_pre_post" class="form-control">
								<option selected value="<Choose the Subject>">&lt;Choose the Course&gt;</option>
								<option>pre</option>
								<option>post</option>
                            </select>
                        </div>
						<input type="submit" id="btn_submit" name="btn_submit" class="btn btn-default" />
                        <input type="reset" id="btn_reset" name="btn_reset" value="reset" class="btn btn-default">
					</form>
				</div>
				<div class="col-lg-3">
				</div>
            </div>
        </div>
<?php include_once("assets/includes/footer.inc"); ?>	