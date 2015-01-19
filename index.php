<html>
<head>
<title>Open Knowledge Hub - OkHub Wrapper Class and Widget</title>
</title>
<style>
#open-knowledge-hub-widget{	
	right:20px;
	top:10px;
	width:20%;
	height:650px;
	font-size:13px;
	padding:20px;
	color: #2b2b2b;
	font-family: Lato, sans-serif;
	line-height: 1.25;
	border:1px dotted gray;
	float:right;
}
#main_container{
	width:70%;
	float:left;
	
}
#okhub-overlay {
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: 0.5;
    filter: alpha(opacity=50);
}
#okhub-modal {
    position:absolute;
    top:10px;
    left:10px;
    background:rgba(0,0,0,0.2);
    border-radius:14px;
    padding:8px;
    width:400px;
    min-height:500px;
}
#okhub-content-header {
    border-radius:8px;
    background:#fff;
    padding-left:20px;
    padding-right:20px;
    padding-top:2px;
    padding-bottom:2px;


}
#okhub-content {
    border-radius:8px;
    background:#fff;
    padding:20px;
    padding-top:2px;
    max-height:350px;
    overflow-y:scroll;
}
#okhub-content-footer {
    border-radius:8px;
    background:#fff;
    padding-left:20px;
    padding-right:20px;
    padding-top:12px;
    padding-bottom:12px;
    min-height:50px;


}
#okhub-close {
	float:right;

}
ul{
	margin:0;
	padding:0;	
}
ul.okhub_sources li{
    list-style-type: none;
    margin-right:5px;
    padding: 0;
    display:inline;
    width:40px;
    background-color:yellow;
    font-size:10px;

	
}
a {
  color: blue;
  text-decoration: none;
 
}

ul.okhub_list li{
    list-style-type: none;
    margin-top:10px;
    padding: 0;
    display:block;
    width:90%;
	
}
</style>
</head>
<body>
<!--<script src="http://localhost/okhub_wrapper/okhub_widget.js?type=search&token_guid=5c96d95b-c729-4624-b1c2-14c6b98dc9ce" type="text/javascript"></script>-->
<script src="http://opendataph.com/okhub/okhub_widget.js?type=search&_token_guid=5c96d95b-c729-4624-b1c2-14c6b98dc9ce" type="text/javascript"></script>

<div id="open-knowledge-hub-widget">Sample Widget</div>
<div id="main_container">
<?php
require_once('wrapper/okhubwrapper.wrapper.inc');
$valid_api_key = '5c96d95b-c729-4624-b1c2-14c6b98dc9ce';
$okhubapi = new OkhubApiWrapper;
$sources = array('opendocs','eldis','observaction','bridge','heart','pids','ccccc','ella','serpp');

echo "<h2>OkHub Javascript Web Widget</h2>";
echo "<p><a href='http://api.okhub.org/accounts/login/?next=/profiles/view/' target=_new>Register to get your API key</a>. The API key is required both on the widget and wrapper class.</p>";
echo "<textarea style='width:100%;height:50px;' disabled><script src=\"http://opendataph.com/okhub/okhub_widget.js?type=search&_token_guid={your-api-key}\" type=\"text/javascript\"></script>
<div id=\"open-knowledge-hub-widget\"></div>
</textarea><br><br/>";
echo "<h3>Other Parameters</h3>";
echo "<ul><li>q={search_parameter}, e.g. <pre>&q=ICT</pre></li>";
echo "<li>country={country_name}, e.g. <pre>&country=India</pre></li>";
echo "<li>theme={theme_name}, e.g. <pre>&theme=Education</pre></li>";
echo "<li>Or Combination of any two or all three paramaters, e.g. <pre>&theme=Education&q=ICT&country=India</pre></li></ul><br/>";
echo "<a href='okhub.css' target=_new>Link to sample css</a><br/><br/>";
echo "<a href='admin/'>Customise the widget</a><br/>";
echo "<hr>";
echo "<h2>OkHub PHP Wrapper Class</h2>";
echo '$sources = array(\'opendocs\',\'eldis\',\'observaction\',\'bridge\',\'heart\',\'pids\',\'ccccc\',\'ella\',\'serpp\')';

echo "<p><a href='wrapper.tar.gz'>Download Wrapper Class</a></p>";
echo "<b>Create a new wrapper object</b>\n";
echo '<pre>';
echo '$okhubapi = new OkhubApiWrapper;';
echo '</pre>';
echo '<hr>';
echo "<b>Example 1.</b> Get an array, indexed by object_id, with the titles of Okhub documents about poverty in the Philippines.\n\n";
echo '<pre>';
echo '$response = $okhubapi->search(\'documents\', \'hub\', $valid_api_key, \'short\', 3, 0, 0, array(\'q\' => \'Poverty\', \'country\' => \'Philippines\'));' . "\n";
$response = $okhubapi->search('documents', 'hub', $valid_api_key, 'short', 5, 0, 0, array('country' => 'Philippines', 'theme'=>'POverty'));
echo '$response->getArrayTitles(): ';
echo '<textarea style="width:100%;height:400px;" disabled>$response: ';
print_r($response->getArrayTitles());
echo '</textarea></pre>';
echo '<hr>';

echo "<b>Example 2. </b> Get an array with links to the 15 OkHub documents related to climate change in India.\n\n";
echo '<pre>';
echo '$response = $okhubapi->search(\'documents\', \'hub\', $valid_api_key, \'full\', 10, 0, 0, array(\'country\' => \'India\',\'theme\'=>\'climate change\'));' . "\n";
$response = $okhubapi->search('documents','hub', $valid_api_key, 'full', 10, 0, 0, array('country' => 'India','theme'=>'climate change')); //array('country' => 'Philippines', 'theme' => 'climate change')
echo '$response->getDocumentVersion($sources); ';
echo '<textarea style="width:100%;height:400px;" disabled>$response: ';
print_r($response->getDocumentVersion($sources));
echo "</textarea>";
echo '</pre>';
echo '<hr>';

echo "<b>Example 3.</b> Search the two most recent Okhub organisations .\n\n";
echo '<pre>';
echo '$response = $okhubapi->search(\'organisations\', \'hub\', $valid_api_key, \'short\', 2, 0);' . "\n\r";
$response = $okhubapi->search('organisations', 'hub', $valid_api_key, 'short', 2, 0);
echo '<textarea style="width:100%;height:400px;" disabled>$response: ';
print_r($response);
echo '</textarea></pre>';
echo '<hr>';


echo "<b>Example 4.</b> Get 'short' record for Okhub document with object_id=7781.\n\n";
echo '<pre>';
echo '$response = $okhubapi->get(\'documents\', \'hub\', $valid_api_key, \'short\', \'7781\');' . "\n\r";
$response = $okhubapi->get('documents', 'hub', $valid_api_key, 'short', 7781);
echo '<textarea style="width:100%;height:400px;" disabled>$response: ';
print_r($response);
echo '</textarea></pre>';
echo '<hr>';

echo "<b>Example 5.</b> Get 'full' record for Okhub theme with object_id=10640.\n\n";
echo '<pre>';
echo '$response = $okhubapi->get(\'themes\', \'hub\', $valid_api_key, \'full\', \'10640\');' . "\n\r";
$response = $okhubapi->get('themes', 'hub', $valid_api_key, 'full','10640');
echo '<textarea style="width:100%;height:400px;" disabled>$response: ';
print_r($response);
echo '</textarea>'."\n\r". ' To get all themes:'."\n".' $response = $okhubapi->getAll(\'themes\', \'hub\', $valid_api_key, \'full\');</pre>';
echo '<hr>';

echo "<b>Example 6.</b> How many documents related to Vietnam are in each theme in Okhub.\n\n";
echo '<pre>';
echo '$response = $okhubapi->count(\'documents\', \'hub\', $valid_api_key, \'theme\', 0, array(\'country\'=>\'Vietnam\'));' . "\n\r";
$response = $okhubapi->count('documents', 'hub', $valid_api_key, 'theme', 0, array('country'=>'Vietnam'));
echo '<textarea style="width:100%;height:400px;" disabled>$response: ';
print_r($response);
echo '</textarea></pre>';
echo '<hr>';

echo "<b>Example 7:</b> Get all 'short' records for Okhub countries. Display first record, Afganistan.\n\r";
echo '<pre>';
echo '$response = $okhubapi->get_all(\'countries\', \'hub\', $valid_api_key, \'short\');' . "\n\r";
$response = $okhubapi->getAll('countries', 'hub', $valid_api_key, 'short');
echo '<textarea style="width:100%;height:400px;" disabled>$response->results[0]: ';
print_r($response->results[0]);
echo '</textarea></pre>';
echo '<hr>';
$okhubapi->cacheFlush();
?>
</div>
</body>
</html>