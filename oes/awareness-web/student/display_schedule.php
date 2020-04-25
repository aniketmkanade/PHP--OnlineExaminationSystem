<?php include('assets/header.php');
//if(!isset($_SESSION['studId']))
//header('location:index.php');
?>
<?php include('dbconfig.php');?>
 <div class="page-header text-center">
        <h3>Display Schedule</h3>
      </div>
  <div class="bs-example" data-example-id="simple-table">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Test Name</th>
		  <th>Start Date</th>
		  <th>End Date</th>
		  <th></th>
		  <th>Take Test</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
		  <th></th>
		  <th><a href="test_code_page.php">Take Test</a></th>
        </tr>
      </tbody>
    </table>
  </div>
<?php include('assets/footer.php') ?>