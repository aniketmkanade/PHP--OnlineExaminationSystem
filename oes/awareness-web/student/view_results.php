<?php include('assets/header.php');?>
<?php 
if(!isset($_SESSION['studId']))
	{
		header('location:index.php');
	}
?>
<div class="container">
<div class="page-header text-center">
    <h3>Result</h3>
</div>
  <div class="bs-example" data-example-id="simple-table">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Date and Time</th>
          <th>Test Name</th>
          <th>Max Marks</th>
		  <th>Obtained Marks</th>
		  <th>Percentage</th>
		  <th>Details</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th><?php ?></th>
          <th><?php ?></th>
          <th><?php ?></th>
          <th><?php ?></th>
		  <th><?php ?></th>
		  <th><?php ?></th>
		  <th><a src="">Details</a></th>
        </tr>
      </tbody>
    </table>
	<hr>
</div>
</div>
		<div class="contact">
			<div class="container">
				<div class="contact-grids">
					<div class="contact-form text-center">
						<h3>Result Details</h3>
							<div class="table-responsive ">
				<table class="table table-bordered table-striped">
				  <colgroup>
					<col class="col-xs-3">
					<col class="col-xs-3">
				  </colgroup>
				  <thead>
					<tr>
					  <th>Class</th>
					  <th>Description</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th scope="row">
						<code>Student</code>
					  </th>
					  <td><?php ?></td>
					</tr>
					<tr>
					  <th scope="row">
						<code>Test</code>
					  </th>
					  <td><?php ?></td>
					</tr>
					<tr>
					  <th scope="row">
						<code>Subject</code>
					  </th>
					  <td><?php ?></td>
					</tr>
					<tr>
					  <th scope="row">
						<code>Date and Time</code>
					  </th>
					  <td><?php ?></td>
					</tr>
					<tr>
					  <th scope="row">
						<code>Test Duration</code>
					  </th>
					  <td><?php ?></td>
					</tr>
					<tr>
					  <th scope="row">
						<code>Maximum Marks</code>
					  </th>
					  <td><?php ?></td>
					</tr>
					<tr>
					  <th scope="row">
						<code>Obtained Marks</code>
					  </th>
					  <td><?php ?></td>
					</tr>
					<tr>
					  <th scope="row">
						<code>Percentage</code>
					  </th>
					  <td><?php ?></td>
					</tr>
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="container">
<div class="page-header text-center">
        <h3>Question Review</h3>
      </div>
  <div class="bs-example" data-example-id="simple-table">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Question</th>
          <th>Correct Answer</th>
          <th>Your Answer</th>
		  <th>Score</th>
		  <th>Review</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th><?php ?></th>
          <th><?php ?></th>
          <th><?php ?></th>
          <th><?php ?></th>
		  <th><?php ?></th>
		  <th><?php ?></th>
		  <th><?php ?></th>
        </tr>
      </tbody>
    </table>
</div>
</div>
<?php include('assets/footer.php') ?>