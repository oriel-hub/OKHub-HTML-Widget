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
if (isset($_GET['sort_desc'])){
	$params['sort_desc'] = $_GET['sort_desc'];	
}
if (isset($_GET['sort_asc'])){
	$params['sort_asc'] = $_GET['sort_asc'];	
}
if (isset($_GET['start_offset'])){
	$start_offset = $_GET['start_offset'];	
}else{
	$start_offset = 0;
}
$id = ( isset($_GET['id']) ? $_GET['id'] : '');
$type = $_GET['type']; // type, either search, get, get_all
require_once('../wrapper/okhubwrapper.wrapper.inc');
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
	$details_obj = new stdClass();
	$details_obj->data = $response->getDocumentVersion($sources);
	$details_obj->sources = $sources_options;
	$json = json_encode($details_obj);
}
$callback = $_GET['callback'];

header("Content-type: application/javascript");

echo "$callback($json);";
?>
