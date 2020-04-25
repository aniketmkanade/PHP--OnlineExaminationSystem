<?php include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
/* ---------------------------------------------Update Process----------------------------------------------------*/
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'edit')
	{
		if(isset($_REQUEST['btn_submit']))
		{
			$query="UPDATE `income` SET
			`isfeesrecipt`=1,
			`incometitle`=0,
			`date`='".$_REQUEST['txt_date']."',
			`amount`='".$_REQUEST['txt_amount']."',
			`details`='".$_REQUEST['txt_details']."' 
			WHERE incomeid=".$_REQUEST['id'];
			
			if($result = (executeQuery($query)))
			{
				echo"<script>alert('Course Updation Successful...!!!')</script>";
			}
			else
			{
				echo"<script>alert('Query not fired...!!!')</script>";
			}
		}
	}
}
/* ---------------------------------------------Insert Process----------------------------------------------------*/
else
{
	$_REQUEST['isfeesrecipt'] = "1";
	if(isset($_REQUEST['btn_submit']))
	{
		$query="INSERT INTO `income`(`isfeesrecipt`, `studid`, `incometitle`, `date`, `amount`, `details`) VALUES  
		(1, 1,0,'".$_REQUEST['txt_date']."','".$_REQUEST['txt_amount']."','".$_REQUEST['txt_details']."')";
		
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Subject Registration Successful...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Query not fired...!!!')</script>";
		}
	}
}
/*----------------------------------------------Deletion Procedure--------------------------------------------------*/
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'delete')
	{
		$query="DELETE FROM `income` WHERE incomeid=".$_REQUEST['id'];
		if($result = (executeQuery($query)))
		{
			echo"<script>alert('Subject Deletion Successful...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Subject Deletion Not Successful...!!!')</script>";
		}
	}
}
/* ---------------------------------------------Data Retriving Process------------------------------------------------*/
$date="";
$amount="";
$details="";
if(isset($_REQUEST['action']))
{
	if($_REQUEST['action'] == 'edit')
	{
		$query="SELECT * FROM `income` WHERE incomeid=".$_REQUEST['id'];
		if($result = (executeQuery($query)))
		{				
			if($result->num_rows > 0 && $r = mysqli_fetch_array($result))
			{
				$date = $r['date'];
				$amount = $r['amount'];
				$details= $r['details'];
			}
			else 
				echo"<script>alert('Data Not found...!!!')</script>";
		}
		else
		{
			echo"<script>alert('Data Not found...!!!')</script>";
		}
	}
}
?>
<!-----------------------------------------------Ajax Code--------------------------------------------------------->
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#ddl_course').on('change',function(){
        var courseID = $(this).val();
        if(courseID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'course_id='+courseID,
                success:function(html){
                    $('#ddl_level').html(html);
                    $('#ddl_subject').html('<option value="">Select Level first</option>'); 
                }
            }); 
        }else{
            $('#ddl_level').html('<option value="">Select course first</option>');
            $('#ddl_subject').html('<option value="">Select Level first</option>'); 
        }
    });
    
    $('#ddl_level').on('change',function(){
        var levelID = $(this).val();
        if(levelID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'level_id='+levelID,
                success:function(html){
                    $('#ddl_subject').html(html);
                }
            }); 
        }else{
            $('#ddl_subject').html('<option value="">Select Level first</option>'); 
        }
    });
});
</script>
<!------------------------------------------------ Wrapper Code----------------------------------------------------->
	<div id="page-wrapper">
            <div class="row">
				<div class="col-lg-3">
				</div>
                <div class="col-lg-6">
				<h1>Fees Reciept</h1><br>
                    <form role="form">
						<div class="form-group">
							<label>Student Code</label>
                            <select id="ddl_student_code" name="ddl_student_code" class="form-control">
								<option selected value="<Choose the Subject>">&lt;Student Code&gt;</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label>Date</label>
                            <input type="date" id="txt_date" name="txt_date" class="form-control" placeholder="Date"
							<?php
							echo "value=".$date;
							?>
							>
                        </div>
						<div class="form-group">
                            <label>Amount</label>
                            <input id="txt_amount" name="txt_amount" class="form-control" placeholder="Amount"
							<?php
							echo "value=".$amount;
							?>
							>
                        </div>
						<div class="form-group">
                            <label>Details</label>
                            <textarea id="txt_details" name="txt_details" class="form-control">
							<?php
							echo $details;
							?>
							</textarea>
                        </div>
						<div class="form-group">
							<label>Status&nbsp </label><br>
							<label class="radio-inline">
								<input type="radio" id="txt_is_active" name="txt_is_active" checked value="1">Enable</input>
							</label>
							<label class="radio-inline">
								<input type="radio" id="txt_is_active" name="txt_is_active" value="0">Disable</input>
							</label>
						</div>
						<input type="submit" id="btn_submit" name="btn_submit" class="btn btn-default" 
						<?php
						if(isset($_REQUEST['action']))
						{
							if($_REQUEST['action'] == 'edit')
							{
								echo'value ="Update"';
							}
						}
						?>
						
						/>
                        <input type="reset" id="btn_reset" name="btn_reset" value="reset" class="btn btn-default">
					</form>
					<br/><hr/><br/>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> fees Recipt :</h3>
								</div>
								<div class="panel-body">
									<div id="shieldui-grid1"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
				</div>
            </div>
        </div>
<?php include_once("assets/includes/footer.inc"); ?>	
<!---------------------------------------------- JavaScript Code(Table)----------------------------------------------->
<script type="text/javascript">
jQuery(function ($) {
	var traffic = [
		<?php
		$result = (executeQuery("SELECT * FROM `income` WHERE isfeesrecipt='1'"));
	
		$rowcount= mysqli_num_rows($result);
		$counter=1;
		while($r = mysqli_fetch_array($result))
		{
			echo '{ 
			Studentcode:"'.$r['studid'].'",
			Date:"'.$r['date'].'",
			Amount:"'.$r['amount'].'",
			action:"<a href=\'?action=edit&id='.$r['incomeid'].' \' class=\'btn btn-success\'><i class=\'fa fa-pencil\'></i></a>&nbsp;<a href=\'?action=delete&id='.$r['incomeid'].' \' class=\'btn btn-danger\'><i class=\'fa fa-trash\'></i></a>",}';
			$counter++;
			if($rowcount>=$counter)
				echo ',';
		}
	?>
	];
	$("#shieldui-grid1").shieldGrid({
		dataSource: {
			data: traffic
		},
		sorting: {
			multiple: true
		},
		rowHover: true,
		paging: false,
		columns: [
		{ field: "Studentcode",width: "75px", title: "Student code" },
		{ field: "Date", width: "75px", title: "Date" },
		{ field: "Amount", width: "80px", title: "Amount" },
		{ field: "action",width: "100px", title: "Action" }
		]
	});            
});        
</script>