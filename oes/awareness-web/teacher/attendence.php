<?php 
include('assets/header.php');
	if(!isset($_SESSION['studId']))
	{
		header('location:index.php');
	}

	if(isset($_REQUEST['btn_submit']))
	{
		if(isset($_REQUEST['hdn_stud_count']) && $_REQUEST['hdn_stud_count'] > 0)
		{
			$count = $_REQUEST['hdn_stud_count'];
			for($i=1; $count>0; $i++)
			{
				//$sids="";
				if(isset($_REQUEST['s_'.$i]))
				{
					if($_REQUEST['s_'.$i]=="on")
					{
						$sids[]=$_REQUEST['s_'.$i];
					}
					$count--;
				}
			}
			print_r($sids);
		}
		else
			echo "<script>alert('Please select valid batch code...!!!');</script>";
			
	}
	
	
	
	
	
	
?>


<!----------------------------------------------- Ajax Code ---------------------------------------------------->
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#ddl_batch').on('change',function(){
        var batchID = $(this).val();
        if(batchID){
			$('#tbody').html('<tr><td colspan="3" class="text-center">No Student Found </td></tr>');
            $.ajax({
                type:'POST',
                url:'ajaxStudentList.php',
                data:'batchID='+batchID,
                success:function(html){
                    $('#tbody').html(html);
                }
            }); 
        }
		else{
			$('#tbody').html('<tr><td colspan="3" class="text-center">No Student Found </td></tr>'); 
		}
    });
});
</script>
<!----------------------------------------------------------Wrapper Code --------------------------------------------->
<div class="page-header text-center">
	<h2 style="color:red">Attendence</h2>
</div>
<br>
<div class="row">
	<div class="col-sm-2">
	</div>
	<div class="col-sm-8">
		<div class="bs-example" data-example-id="simple-form-inline">
			<form class="form-inline">
			  <div class="form-group">				
				<label>Choose the Batch</label>
				<select id="ddl_batch" name="ddl_batch" class="form-control">
					<option selected value="<Choose the Subject>">&lt;Choose the Batch&gt;</option>				
					<?php
						$result = executeQuery("SELECT * FROM `batch`");
						while ($r = mysqli_fetch_array($result)) 
						{
						echo "<option value='".$r['batchid']."'> ".$r['batchname']."	</option>";
						}
						closedb();
					?>
				</select>
			  </div><br><br>&nbsp;&nbsp;&nbsp;
			  <div class="form-group">				
				<label>Add date </label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="Date" id="txt_date" name="txt_date">
			  </div>
			  <div class="form-group">
				<div class="col-sm-12">
					<div class="page-header text-center">
						<h3>Attendence Table</h3>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
						  <colgroup>
							<col class="col-xs-1">
							<col class="col-xs-5">
							<col class="col-xs-2">
						  </colgroup>
						  <thead>
							<tr>
							  <th class="text-center">Action</th>
							  <th class="text-center">Name</th>
							  <th class="text-center">Student Code</th>
							</tr>
						  </thead>
						  <tbody id="tbody">
						  <tr><td colspan="3" class="text-center">No Student Found </td></tr>
						  </tbody>
						</table>
					</div>
					<div class="page-header text-center">
					<button type="submit" id="btn_submit" name="btn_submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
				<div class="col-sm-2">
			  </div>
			</form>
		</div>
	<div class="col-sm-1">
	</div>
	<br>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include('assets/footer.php')?>