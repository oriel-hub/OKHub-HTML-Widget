<?php
//77d11dd5-c3c5-4e27-b3f4-8227bccbed01
$type= $_GET['type'];
$token_guid = $_GET['token_guid'];
$param=$_GET['param'];
$start_offset = $_GET['start_offset'];
$extraparam = "?_token_guid=".$token_guid."&format=json";
$okhubURL = "http://api.okhub.org/v1"; //main hub api
/*search API generic*/
$searchAPI ="/hub/search/documents/short/";
/*get all resources*/
$documentsAPI ="/hub/get_all/documents/";
$themesAPI ="/hub/get_all/themes/";
$countriesAPI ="/hub/get_all/countries/";
$regionsAPI ="/hub/get_all/regions/";
$organisationsAPI ="/hub/get_all/organisations/";
/*details:
documents,themes,countries,regions,organisation
*/
$docsdetailsAPI ="/hub/get/documents/";

switch($type){
	case "search":
		$url = $okhubURL.$searchAPI.$extraparam."&q=".$param;
		break;
	case "navigate":
		$url = $okhubURL.$searchAPI.$extraparam."&q=".$param."&start_offset=".$start_offset;
		break;
	case "details":
		$docdetailsAPI="/hub/get/".$_GET['subtype'];
		$url=$okhubURL.$docsdetailsAPI.$param."/full/".$extraparam;
		break;
	case "documents":
		$url = $okhubURL.$documentsAPI."/short/".$extraparam;
		break;
	case "themes":
		$url = $okhubURL.$themesAPI."/short/".$extraparam;
		break;
	case "countries":
		$url = $okhubURL.$countriesAPI."/short/".$extraparam;
		break;
	case "regions":
		$url = $okhubURL.$regionsAPI."/short/".$extraparam;
		break;
	case "organisations":
		$url = $okhubURL.$organisationsAPI."/short/".$extraparam;
		break;	
	default:
		break;
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