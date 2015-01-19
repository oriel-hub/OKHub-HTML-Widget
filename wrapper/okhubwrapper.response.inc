<?php

/**
* Class OkhubApiResponse.
*
* Objects of this class contain the data retrieved by the Okhub API calls.
*
*/

class OkhubApiResponse {

  // These properties should be protected, but we need to check first where this class is
  // currently being used, to make sure we don't break the plugins, etc. 

  // Results. Array of IdsApiObject (or its subclasses).
  public $results = array();

  // If the API called did not respond with a well-structured response.
  public $is_error = FALSE;
  public $next_page='';
  public $prev_page='';
  // Flag to indicate if the response is from the cache.
  public $cached = FALSE;

  // Error message, in case an error was produced.
  public $error_message = '';

  // Total results. Number of total results available in the collection.
  public $total_results;

  /**
  * Constructor.
  * 
  * Is called by OkhubApiCall::makeRequest().
  * @param array $results - array with the decoded output of the API call.
  * @param string $format - format of the responses (short, full) (default 'full').
  * @param string $type_results - type of object(s) (documents, organisations, themes, regions, countries).
  * @param string $total_results - total number of results available in the dataset.
  * @param string $default_site - dataset ('eldis', 'bridge').
  * @param bool $cached - indicates if the response was retrieved from the cache.
  */
  //function __construct($results, $format, $type_results, $total_results, $default_site, $cached = FALSE) {
  function __construct($results, $type_results, $total_results, $default_site, $cached = FALSE, $next_page, $prev_page) {
    $this->results = array();
    $this->next_page=$next_page;
    $this->prev_page=$prev_page;
    if (!is_array($results)) {
      $this->is_error = TRUE;
      if (is_string($results)) {
        $this->error_message = $results;
      }
    }
    else {
      $this->is_error = FALSE;
      foreach ($results as $object) {      	
        if (!isset($object['site'])) {
          $object['site'] = $default_site;
        }
        
        $ids_api_object = OkhubApiObject::factory($object, $type_results);
        array_push($this->results, $ids_api_object);
        
      }
    }
    if (isset($total_results)) {
      $this->total_results = $total_results;
    }
    else {
      $this->total_results = 0;
    }
    $this->cached = $cached;
  }

  /**
  * Indicate if the response is empty.
  * @return bool
  */
  function isEmpty() {
    return empty($this->results);
  }

  /**
  * Indicate if the response is an error.
  * @return bool
  */
  function isError() {
    return $this->is_error;
  }

  /**
  * Indicate if the response is from the cache.
  * @return bool
  */
  function isCached() {
    return $this->cached;
  }

  /**
  * Return the error message.
  * @return string.
  */
  function getErrorMessage() {
    return $this->error_message;
  }

  /**
  * Return the results of the response.
  * @return array.
  */
  function getResults() {
    return $this->results;
  }

  /**
  * Return the total results of the response.
  * @return int.
  */
  function getTotalResults() {
    return $this->total_results;
  }

  /**
  * Return an array with an array of retrieved non-archived object's titles.
  * @return array - titles of retrieved items indexed by object_id.
  */
  function getArrayTitles($padding_str = '') {
    $array_objects = array();
    foreach ($this->results as $object) {
      if ((!isset($object->archived)) || ($object->archived !== 'true')) {
        $title = $object->title;
        if ($padding_str) {
          if (isset($object->level)) {
            $level = $object->level;
            $padding = strlen($title) + strlen($padding_str)*($level - 1);
            $title = str_pad($object->title, $padding, $padding_str, STR_PAD_LEFT);
          } 
        }
        $array_objects['results'][$object->object_id['hub']]['title'] = $title;
        $array_objects['results'][$object->object_id['hub']]['publication_year'] = $object->publication_year;
        $array_objects['results'][$object->object_id['hub']]['publisher'] = $object->publisher;
	$array_objects['results'][$object->object_id['hub']]['metadata_url'] = $object->metadata_url;
      }
    }
    if ($this->next_page !== 0){	 
    	 $array_objects['metadata']['next_page']=$this->next_page;
    	 //$array_objects['metadata']['next_page_params'] = getUrlParams($this->next_page);
    }
    if ($this->prev_page !== 0){
	 $array_objects['metadata']['prev_page']=$this->prev_page;
    }
    $array_objects['metadata']['total_results'] = $this->total_results;
    return $array_objects;
  }

  /**
  * Create an array with a list of HTML links to the retrieved non-archived objects (eg. titles with links to URLs of OKhub documents/organisations).
  * @return array - titles of retrieved items linked to the online documents (on Eldis or BRIDGE).
  */
  function getArrayLinks() {
    $list_objects = array();
    foreach ($this->results as $object) {
      if ((!isset($object->archived)) || ($object->archived !== 'true')) {
        $list_objects[$object->object_id['hub']] = '<a class="' . OKHUB_API_CSS_OBJECT .'" href="' . htmlspecialchars_decode($object->url) . '">'. $object->title. '</a>';
      }
    }
    return $list_objects;
  }
  function getBlogEntries($source){
  	$blog_entries =array();
  	foreach($this->results as $i=>$object){
  		if (is_array($source)){
  			foreach($source as $s){
  				if (!empty($object->titles[$s])){
					$blog_entries[$s][$object->object_id['hub']]['title'] = $object->titles[$s];
					$blog_entries[$s][$object->object_id['hub']]['description'] = $object->description[$s];
					$blog_entries[$s][$object->object_id['hub']]['url'] = $object->urls[$s];
					$blog_entries[$s][$object->object_id['hub']]['authors'] = $object->authors[$s];
					$blog_entries[$s][$object->object_id['hub']]['publisher_country'] = $object->publisher_country[$s][0];
					$blog_entries[$s][$object->object_id['hub']]['publisher'] = $object->publisher[$s][0];
					$blog_entries[$s][$object->object_id['hub']]['publication_year'] = $object->publication_year[$s][0];
					$blog_entries[$s][$object->object_id['hub']]['metadata_url'] = $object->metadata_url;
					$blog_entries[$s][$object->object_id['hub']]['hub_themes'] = implode(", ",$object->hub_themes[$s]);
				}	
  			}			
  		}else{
  			if (!empty($object->titles[$source])){
				$blog_entries[$source][$object->object_id['hub']]['title'] = $object->titles[$source];
				$blog_entries[$source][$object->object_id['hub']]['description'] = $object->description[$source];
				$blog_entries[$source][$object->object_id['hub']]['url'] = $object->urls[$source];
				$blog_entries[$source][$object->object_id['hub']]['authors'] = $object->authors[$source];
				$blog_entries[$source][$object->object_id['hub']]['publisher_country'] = $object->publisher_country[$source][0];
				$blog_entries[$source][$object->object_id['hub']]['publisher'] = $object->publisher[$source][0];
				$blog_entries[$source][$object->object_id['hub']]['publication_year'] = $object->publication_year[$source][0];
				$blog_entries[$source][$object->object_id['hub']]['metadata_url'] = $object->metadata_url;
				$blog_entries[$source][$object->object_id['hub']]['hub_themes'] = implode(", ",$object->hub_themes[$source]);
			}
		}
  	}
  	if ($this->next_page !== 0){
  		$blog_entries['metadata']['next_page']=$this->next_page;
  	}
  	if ($this->prev_page !== 0){
  		$blog_entries['metadata']['prev_page']=$this->prev_page;
  	}
  	$blog_entries['metadata']['total_results'] = $this->total_results;
  	return $blog_entries;  
  }
 function getDocumentVersion($source){
  	$blog_entries =array();
  	foreach($this->results as $i=>$object){
  		if (is_array($source)){
  			foreach($source as $s){
  				if (!empty($object->titles[$s])){
					$blog_entries['results'][$object->object_id['hub']][$s]['title'] = $object->titles[$s];
					$blog_entries['results'][$object->object_id['hub']][$s]['description'] = $object->description[$s];
					$blog_entries['results'][$object->object_id['hub']][$s]['url'] = $object->urls[$s];
					$blog_entries['results'][$object->object_id['hub']][$s]['authors'] = $object->authors[$s];
					$blog_entries['results'][$object->object_id['hub']][$s]['publisher_country'] = $object->publisher_country[$s][0];
					$blog_entries['results'][$object->object_id['hub']][$s]['publisher'] = $object->publisher[$s][0];
					$blog_entries['results'][$object->object_id['hub']][$s]['publication_year'] = $object->publication_year[$s][0];
					$blog_entries['results'][$object->object_id['hub']][$s]['metadata_url'] = $object->metadata_url;
					//$blog_entries['results'][$object->object_id['hub']][$s]['hub_themes_inline'] = implode(",",$object->hub_themes[$s]);
					$blog_entries['results'][$object->object_id['hub']][$s]['hub_themes'] = $object->hub_themes[$s];
					$blog_entries['results'][$object->object_id['hub']][$s]['hub_country'] = $object->hub_country;
					
				}	
  			}			
  		}
  	}
  	if ($this->next_page !== 0){
  		$blog_entries['metadata']['next_page']=$this->next_page;
  	}
  	if ($this->prev_page !== 0){
  		$blog_entries['metadata']['prev_page']=$this->prev_page;
  	}
  	$blog_entries['metadata']['total_results'] = $this->total_results;
  	return $blog_entries;  
  }
  function getAllList($source_type){
  	$list = array();
  	foreach($this->results as $object){
  		$id = $object->object_id['hub'];
  		if (!empty($object->title)){
  			$list[$source_type][$id]['title'] =$object->title;
  			if ((!empty($object->iso_two_letter_code)) && ($source_type=="countries")){
  				$list[$source_type][$id]['iso_two_letter_code'] =$object->iso_two_letter_code;
			}
			$list[$source_type][$id]['metadata_url'] = $object->metadata_url;
  		}
		
  	}
  	return $list;
  }


} // OkhubApiResponse










  
