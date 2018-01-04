<?php 
require_once '../includes/db.php'; // The mysql database connection script
$filter = '%';
if(isset($_GET['group'])){
	$filter = $mysqli->real_escape_string($_GET['group']);
}
$query="SELECT t.groupid, name from savings_group s join transactions t on s.groupid = t.groupid group by t.groupid order by s.name ";
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