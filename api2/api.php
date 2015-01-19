<?php
$type = $_GET['type']; // type, either search, get, get_all
require_once('../wrapper/okhubwrapper.wrapper.inc');
/*$valid_api_key = $_GET['token_guid'];*/
$valid_api_key = '5c96d95b-c729-4624-b1c2-14c6b98dc9ce';
$okhubapi = new OkhubApiWrapper;
if ($type == "admin"){
	$object_type = $_GET['object_type'];
	$response = $okhubapi->getAll($object_type, 'hub', $valid_api_key, 'full');
}
header("Content-type: application/javascript");
$callback = $_GET['callback'];
echo "$callback($json);";
?>
