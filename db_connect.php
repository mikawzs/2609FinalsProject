<?php
$RMAQhost = 'localhost';
$RMAQuser = 'root';
$RMAQpass = '';
$RMAQdb = 'voting_system';

$RMAQ_conn = new mysqli($RMAQhost, $RMAQuser, $RMAQpass, $RMAQdb);

if ($RMAQ_conn->connect_error) {
    die("Connection failed: " . $RMAQ_conn->connect_error);
}
?>
