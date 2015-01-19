<?php
require_once('wrapper/okhubwrapper.wrapper.inc');
$valid_api_key = '5c96d95b-c729-4624-b1c2-14c6b98dc9ce';
$okhubapi = new OkhubApiWrapper;
echo "<b>Example 4.</b> Get 'short' record for Okhub document with object_id=7781.\n\n";
echo '<pre>';
echo '$response = $okhubapi->get(\'documents\', \'hub\', $valid_api_key, \'short\', \'7781\');' . "\n\r";
$response = $okhubapi->get('documents', 'hub', $valid_api_key, 'short', 7781);
echo '<textarea style="width:100%;height:400px;" disabled>$response: ';
print_r($response);
echo '</textarea></pre>';
echo '<hr>';
?>
