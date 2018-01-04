<?php 
require_once '../includes/db.php'; // The mysql database connection script
$filter = '';
$where = '';

if(isset($_GET['id'])){
	$where ='where ';
	$filter = "groupid like '%".$mysqli->real_escape_string($_GET['id'])."%'";
}
if(isset($_GET['phone'])){
	$where ='where ';
	$filter .= " and msisdn like '%".$mysqli->real_escape_string($_GET['phone'])."%'";
}
if(isset($_GET['ref'])){
	$where ='where ';
	$filter .= " and reference like '%".$mysqli->real_escape_string($_GET['ref'])."%'";
}
/*
if(isset($_GET['startDate'])){
	$filter .= " and fulltimestamp >= ".$mysqli->real_escape_string($_GET['startDate']);
}
if(isset($_GET['endDate'])){
	$filter .= " and fulltimestamp <= ".$mysqli->real_escape_string($_GET['endDate']);
}
*/
$query="SELECT id, fulltimestamp,msisdn, account,service,reference, amount,tstatus,lang, groupid from transactions $where $filter  order by fulltimestamp desc";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}

//echo $query ."<p>";
# JSON-encode the response
echo $json_response = json_encode($arr);
?>
