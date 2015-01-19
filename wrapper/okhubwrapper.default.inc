<?php

/**
* OKHUB Plugins default parameters.
*
* Sets default values to the API URL, documentation URL, cache time, etc.
*/
//error_reporting(E_ERROR | E_PARSE);
// Cache parameters for API responses.
define('OKHUB_API_USE_CACHE', TRUE);
define('OKHUB_API_CACHE_REQUESTS', 'idsapi_cache');
define('OKHUB_API_DEFAULT_CACHE_TIME', 86400); //One day
define('OKHUB_API_CACHE_DIR', 'cache');

// Error levels to display and format of error messages
define('OKHUB_API_SHOW_ERROR_CODES', 'error,warning,notification');
define('OKHUB_API_HTML_ERRORS', TRUE);

// Default API parameters
define('OKHUB_API_DEFAULT_DATASET', 'hub');
define('OKHUB_API_NUM_ITEMS', 20); 
define('OKHUB_API_DEFAULT_FORMAT', 'full');
define('OKHUB_API_DEFAULT_TYPE_REQUEST', 'search');
define('OKHUB_API_AGE_NEW_ASSETS', 0);

// Parameters that shouldn't be changed by the API users, in general
//define('OKHUB_API_URL', 'http://api.ids.ac.uk/openapi/');
define('OKHUB_API_URL', 'http://api.okhub.org/v1/');
define('OKHUB_API_HOME_URL', 'http://www.okhub.org/');
//http://api.okhub.org/v1
define('OKHUB_API_KEY_URL', 'http://www.okhub.org/accounts/register/');
define('OKHUB_API_DOCUMENTATION_URL', 'http://api.ids.ac.uk/docs/');
define('OKHUB_API_SEARCH_FIELDS_URL', 'http://api.ids.ac.uk/docs/functions/search/');
define('OKHUB_API_MAX_NUM_ITEMS', 500); // OKHUB_API_MAX_NUM_ITEMS is the max. page size allowed by the API (http://api.ids.ac.uk/docs/)
define('OKHUB_API_KEY_PAR', '_token_guid');
define('OKHUB_API_CSS_OBJECT', 'okhub-object');
define('OKHUB_API_PREFIX', 'OKHUB');





