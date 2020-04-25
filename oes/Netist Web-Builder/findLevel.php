<?php
include_once 'dbconfig.php';
$query  = "SELECT levelid,levelname FROM level WHERE courseid='$_GET['Course']'";
echo $query;
$result = executeQuery($query);


?>
<select name="state" onchange="getCity(<?php echo $country?>,this.value)">
<option>Select State</option>
<?php while ($row=mysql_fetch_array($result)) { ?>
<option value=<?php echo $row['id']?>><?php echo $row['statename']?></option>
<?php } ?>
</select>
