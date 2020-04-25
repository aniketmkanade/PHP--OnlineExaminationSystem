<?php
include_once 'dbsettings.php';

$conn=false;

function executeQuery($query)
{
    global $conn,$dbserver,$dbname,$dbpassword,$dbusername,$pass_enc;
    global $message;
	
    if (!($conn = mysqli_connect ($dbserver,$dbusername,$dbpassword,$dbname)))
         $message="Cannot connect to server";
    
	mysqli_set_charset($conn, 'utf8');
    return mysqli_query($conn,$query);
    
}
function closedb()
{
    global $conn;
    if(!$conn)
    mysqli_close($conn);
}
?>