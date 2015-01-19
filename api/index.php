<?php
$okhubSearchURL = "http://api.okhub.org/v1/hub/search/documents/full/?_token_guid=".$_GET['token_guid']."&format=json";
$param=$_GET['param'];
$start_offset = $_GET['start_offset'];
if ($_GET['type'] == "search"){
	$url = $okhubSearchURL."&q=".$param;
}
if ($_GET['type'] == "navigate"){
	$url = $okhubSearchURL."&q=".$param."&start_offset=".$start_offset;	
}
if ($_GET['type'] == "navigate2"){
	$url = $okhubSearchURL."&".$_GET['param1']."=".$_GET['param2']."&start_offset=".$start_offset;	
}
if ($_GET['type'] == "details"){
	$url="http://api.okhub.org/v1/hub/get/documents/".$param."/full/?format=json&_token_guid=".$_GET['token_guid'];
}
if ($_GET['type'] == "search2"){
	$url = $okhubSearchURL."&".$_GET['param1']."=".$_GET['param2'];
		
}
if ($url != ""){
	$documents = file_get_contents($url);
	header("Content-type: application/javascript");
	$callback = $_GET['callback'];
	echo "$callback($documents);";
}else{
	echo "Wrapper class for Widget";	
}
?>