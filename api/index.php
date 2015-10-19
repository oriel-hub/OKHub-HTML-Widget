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
$sources_options = $okhubapi->okhubapi_get_sources_options_objects($valid_api_key);
$sources_option_details = array();
foreach($sources_options as $source_code => $so){
	$sources_option_details[$source_code] = new stdClass();
	$sources_option_details[$source_code]->name =$so->get_value(OKHUB_API_FN_NAME);
	$source_description = $so->get_value(OKHUB_API_FN_DESCRIPTION);
	$sources_option_details[$source_code]->description = $source_description;
	$source_description_arr = explode('<img', $source_description);
	if(count($source_description_arr)){
		$source_description = $source_description_arr[0];
	}
	$sources_option_details[$source_code]->description_clean = $source_description;
    $source_logo_obj = $so->get_value('logo');
    $source_logo_url = (isset($source_logo_obj[OKHUB_API_LOGO_ARR_POS_URL])) ? $source_logo_obj[OKHUB_API_LOGO_ARR_POS_URL]:FALSE;
	$sources_option_details[$source_code]->logo_url = $source_logo_url;
}
$sources = array_keys($sources_options);
if ($type == "search"){
	$response = $okhubapi->search('documents', 'hub', $valid_api_key, 'short', 10, 0, $start_offset, $params);
	$json = json_encode($response->getArrayTitles());
}
if ($type == "details"){
	$response = $okhubapi->get('documents', 'hub', $valid_api_key, 'full', $id);
	$details_obj = new stdClass();
	$details_obj->data = $response->getDocumentVersion($sources);
	$details_obj->sources = $sources_option_details;
	$json = json_encode($details_obj);
}
$callback = $_GET['callback'];

header("Content-type: application/javascript");

echo "$callback($json);";
?>
