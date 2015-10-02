<?php
/* search parameters */
$params = array();
if (isset($_GET['q'])){
	$params['q']=$_GET['q'];
}
if (isset($_GET['country'])){
	$params['country'] = $_GET['country'];	
}
if (isset($_GET['theme'])){
	$params['theme'] = $_GET['theme'];	
}
if (isset($_GET['start_offset'])){
	$start_offset = $_GET['start_offset'];	
}else{
	$start_offset = 0;
}
$id = ( isset($_GET['id']) ? $_GET['id'] : '');
$type = $_GET['type']; // type, either search, get, get_all
require_once('../wrapper/wrapper/okhubwrapper.wrapper.inc');
$valid_api_key = $_GET['token_guid'];
$okhubapi = new OkhubApiWrapper;
$sources_options = $okhubapi->okhubapi_get_sources_options($valid_api_key);
$sources = array_keys($sources_options);
if ($type == "search"){
	$response = $okhubapi->search('documents', 'hub', $valid_api_key, 'full', 10, 0, $start_offset, $params);
	$json = json_encode($response->getArrayTitles());
}
if ($type == "details"){
	$response = $okhubapi->get('documents', 'hub', $valid_api_key, 'full', $id);
	$json = json_encode($response->getDocumentVersion($sources));
}
header("Content-type: application/javascript");
$callback = $_GET['callback'];

echo "$callback($json);";
?>
