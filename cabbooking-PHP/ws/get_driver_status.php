<?php
include '../includes/database_connection.php';
if($_REQUEST['d_email']){
    
    $driver_email = $_REQUEST['d_email'];
    $sel_status = mysql_fetch_object(mysql_query("select * from gcm_users where email='$driver_email' "));
    $status = $sel_status->driver_status;
    $sel_cab = mysql_fetch_object(mysql_query("select * from tbl_user where email='$driver_email' "));
    $cab= $sel_cab->cab_type;
    $response = array();
    $response['driver_status']= "$status";
    $response['cab_type']= "$cab";
    echo json_encode($response); 
    exit;
    
    
}

?>