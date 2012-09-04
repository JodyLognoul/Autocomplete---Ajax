<?php

$mysql = new PDO('mysql:host=localhost;port=3306;dbname=yd', 'USERNAME', 'PASSWORD');


if(isset($_GET['query'])){
	$request = $_GET['query'];

	$sqlquery = 'SELECT distinct name 
			     FROM fruit 
			     WHERE name like :request';

	$sth = $mysql->prepare($sqlquery, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$param = "%".$request."%";
	$sth->bindParam(':request',$param);
	$sth->execute();

	$rows = $sth->fetchAll(PDO::FETCH_COLUMN,0);
	
	echo json_encode(array("query" => $request,"suggestions" => $rows));

}
?>