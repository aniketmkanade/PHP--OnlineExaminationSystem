<?php
include_once 'dbsettings.php';

$conn=false;

function executeQuery($query)
{
    global $conn,$dbserver,$dbname,$dbpassword,$dbusername,$pass_enc;
    global $message;
    if (!($conn = mysqli_connect ($dbserver,$dbusername,$dbpassword,$dbname)))
         $message="Cannot connect to server";

    $result = mysqli_query($conn,$query);
    if(!$result){
        $message="Error while executing query.<br/>Mysql Error: ".mysqli_error($conn);
		echo "Error while executing query.<br/>Mysql Error: ".mysqli_error($conn);
	}
    else
        return $result;

}
function closedb()
{
    global $conn;
    if(!$conn){
    mysqli_close($conn);
	}
}

?>