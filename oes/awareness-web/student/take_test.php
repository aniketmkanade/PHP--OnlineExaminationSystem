<?php 
	include('assets/header.php');
	if(!isset($_SESSION['studId']))
	{
		header('location:index.php');
	}
?>
 <div class="page-header text-center">
        <h3 style="color:blue">Test Schedule</h3>
      </div>
  <div class="bs-example" data-example-id="simple-table">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Test Name</th>
          <th>Test Discription</th>
          <th>Subject Name</th>
		  <th>Duration</th>
		  <th>Total Questions</th>
		  <th>Take Test</th>
        </tr>
      </thead>
    <tbody>
	<?php
		$i = 0;
		if($result = executeQuery("SELECT * FROM `test` t ,examschedule es,student s where t.testid = es.testid
		and s.courseid = t.courseid and s.levelid = t.levelid and s.studid =".$_SESSION['studId']))
		{
			if($result->num_rows > 0) 
			{
				while ($r = mysqli_fetch_array($result)) 
				{
					$i = $i + 1;
					if ($i % 2 == 0) 
					{
						echo "<tr class=\"alt\">";
					} 
					else 
					{
						echo "<tr>";
					}
					echo"<td>" .$r['testid']. "</td>
						<td>" .$r['testname']. "</td>
						<td>" . $r['testname']. "</td>
						<td>" . $r['testname']."</td>
						<td>" . $r['testname'] . "</td>
						<td>" . $r['testname']. "</td>"
					.  "<td class=\"tddata\">
						<input type='submit' id='" . $r['esid']."' name='" . $r['esid']."' onclick='taketestcode(this);'  value='Start Test' class='btn btn-success'/>
						<input type='hidden' id='hdn_" . $r['esid']."' name='hdn_" . $r['esid']."'  value='". $r['secretcode']."'/>
						</td>
						</tr>";
				}
			}
			else 
			{
				echo"<h3 style=\"color:#0000cc;text-align:center;\">Sorry...! For this moment, You have not Offered to take any tests.</h3><br><br>";
			}
		}
	?>
		<script>
			function taketestcode(btn)
			{
				var code = prompt("Enter Test Code : ", "");
				if(code=="")
				{
					alert('Enter Valid Test Code.');
				}
				else{
					var btnid=btn.name;
					var hdnid="hdn_"+btnid;
					
					var hdn = document.getElementById(hdnid);
					//alert('hdn='+hdn.value+" / "+code);
					if(hdn.value==code)
					{
						alert('Test Code Match.');
						location="test.php?id="+btnid;
					}
					else{
						alert('Test Code Not Match.');
					}
				}
			}
		</script>
	  </tbody>
    </table>
  </div>
<?php include('assets/footer.php') ?>