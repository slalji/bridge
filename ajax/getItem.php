<?php 
require_once '../includes/db.php'; // The mysql database connection script
$filter = '%';
$phone = '%';
$ref = '%';
if(isset($_GET['id'])){
	$filter = $mysqli->real_escape_string($_GET['id']);
}
if(isset($_GET['phone'])){
	$phone = $mysqli->real_escape_string($_GET['phone']);
}
if(isset($_GET['ref'])){
	$ref = $mysqli->real_escape_string($_GET['ref']);
}
$query="SELECT id, fulltimestamp,msisdn, account,service,reference, amount,tstatus,lang, groupid from transactions where groupid like '$filter' or msisdn like '$phone' or reference like '$ref' order by fulltimestamp,id desc";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}

# JSON-encode the response
echo $json_response = json_encode($arr);
?>