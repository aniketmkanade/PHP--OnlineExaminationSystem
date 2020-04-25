<?php
include_once("assets/includes/header.inc");
	include_once 'dbconfig.php';
if(!empty($_REQUEST["country_id"])) {
	$results = executeQuery("SELECT * FROM `level` WHERE courseid = '" . $_REQUEST["country_id"] . "'";);
?>
	<option value="">Select State</option>
<?php
	foreach($results as $state) {
?>
	<option value="<?php echo $state["id"]; ?>"><?php echo $state["name"]; ?></option>
<?php
	}
}
?>