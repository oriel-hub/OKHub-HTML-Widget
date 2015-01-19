<?php

/*
*
* NOTE: A valid API key is needed in order to run these examples.
* Please go to http://www.okhub.org/ and request an API key. Once you get it, set the $valid_api_key variable with it.
*
*/

/*
* STEP 1: The IdsApiWrapper class definition is included.
*/
require_once('okhubwrapper.wrapper.inc');
/*
* STEP 2: A new OkhubApiWrapper object is created.
*/
$okhubapi = new OkhubApiWrapper;

/*your api key*/
$valid_api_key = '77d11dd5-c3c5-4e27-b3f4-8227bccbed01';

header('Content-Type: text/html');

echo "<b>A new wrapper object is created</b>\n";
echo '<pre>';
echo '$okhubapi = new OkhubApiWrapper;';
echo '</pre>';
echo '<hr>';

/*
* STEP 3: We call to IdsApiWrapper::search, IdsApiWrapper::get and IdsApiWrapper::get_all to retrieve data from the IDS collections.
*/

/*
* Example 1: Get titles, with filters.
*/
echo "<b>Example 1:</b> Get an array, indexed by object_id, with the titles of Okhub documents about poverty in the Philippines.\n\n";
echo '<pre>';
echo '$response = $okhubapi->search(\'documents\', \'hub\', $valid_api_key, \'short\', 0, 0, array(\'q\' => \'Poverty\', \'country\' => \'Philippines\'))' . "\n";
$response = $okhubapi->search('documents', 'hub', $valid_api_key, 'full', 3, 0, array('q' => 'Poverty','country'=>'Philippines'));
echo '$response->getArrayTitles(): ';
print_r($response->getArrayTitles());
echo '$response->getArrayLinks(): ';
print_r($response);
echo '</pre>';
echo '<hr>';

/*
* Example 2: Get links, with filters.
*/
echo "<b>Example 2:</b> Get an array with links to the 15 most recent Eldis documents related to climate change in India.\n\n";
echo '<pre>';
echo '$response = $okhubapi->search(\'documents\', \'hub\', $valid_api_key, \'full\', 15, 0, array(\'country\' => \'India\',\'theme\'=>\'climate change\'))' . "\n";
$response = $okhubapi->search('documents','hub', $valid_api_key, 'full', 15, 0, array('country' => 'India','theme'=>'climate change')); //array('country' => 'Philippines', 'theme' => 'climate change')
echo '$response->getArrayLinks(): ';
print_r($response->getArrayTitles());
print_r($response->getArrayLinks());
echo '</pre>';
echo '<hr>';

/*
* Example 3: "OR" in filters and extra fields.
*/
echo "<b>Example 3:</b> Search the two most recent Okhub organisations .\n\n";
echo '<pre>';
echo '$response = $idsapi->search(\'organisations\', \'hub\', $valid_api_key, \'short\', 2, 0)' . "\n";
$response = $okhubapi->search('organisations', 'hub', $valid_api_key, 'short', 2, 0);
echo '$response: ';
print_r($response);
echo '</pre>';
echo '<hr>';

/*
* Example 4: get.
*/
echo "<b>Example 4:</b> Get 'full' record for Okhub theme with object_id=C54.\n\n";
echo '<pre>';
echo '$response = $idsapi->get(\'themes\', \'hub\', $valid_api_key, \'full\', \'10640\')' . "\n";
$response = $okhubapi->get('themes', 'hub', $valid_api_key, 'full', 10640);
echo '$response: ';
print_r($response);
echo '</pre>';
echo '<hr>';

/*
* Example 5: get_all.
*/
echo "<b>Example 5:</b> Get all 'short' records for Okhub countries.\n\n";
echo '<pre>';
echo '$response = $okhubapi->get_all(\'countries\', \'hub\', $valid_api_key, \'short\')' . "\n";
$response = $okhubapi->getAll('countries', 'hub', $valid_api_key, 'short');
echo '$response->results[0]: ';
print_r($response->results[0]);
echo '</pre>';
echo '<hr>';

/*
* Example 5: count.
*/
echo "<b>Example 6:</b> How many documents related to Germany are in each theme in Okhub.\n\n";
echo '<pre>';
echo '$response = $okhubapi->count(\'documents\', \'hub\', $valid_api_key, \'theme\', 0, array(\'country\'=>\'Germany\'))' . "\n";
$response = $okhubapi->count('documents', 'hub', $valid_api_key, 'theme', 0, array('country'=>'Germany'));
echo '$response: ';
print_r($response);
echo '</pre>';
echo '<hr>';

/*
* Example 7: Empty response.
*/
echo "<b>Example 6:</b> Bridge organisations (empty set).\n\n";
echo '<pre>';
echo '$response = $okhubapi->search(\'organisations\', \'bridge\', $valid_api_key)' . "\n";
$response = $okhubapi->search('organisations', 'bridge', $valid_api_key);
echo '$response->isEmpty(): ' . $response->isEmpty() . "\n";
echo '$response->isError(): ' . $response->isError() . "\n";
echo '</pre>';
echo '<hr>';

/*
* Example 8: Wrong API key.
*/
echo "<b>Example 7:</b> Using a wrong API key.\n\n";
echo '<pre>';
echo '$response = $okhubapi->search(\'documents\', \'hub\', $wrong_api_key)' . "\n";
$response = $okhubapi->search('documents', 'hub', $wrong_api_key);
echo '$response->isEmpty(): ' . $response->isEmpty() . "\n";
echo '$response->isError(): ' . $response->isError() . "\n";
echo '$response->getErrorMessage(): ' . $response->getErrorMessage() . "\n";
echo '</pre>';
echo '<hr>';



/*
* We flush all the cached requests as we are testing it and don't want to get the responses from the cache the next time we run it.
*/
$okhubapi->cacheFlush();

