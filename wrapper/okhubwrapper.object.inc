<?php

/**
 * OkhubApiObject class.
 *
 * Objects of this class' inherited classes contain the information of assets (documents and organisations), categories (regions and themes)
 * and countries available in the Okhub datasets.
 *
 */
class OkhubApiObject {

  // Unique identifier of this object (for example, A1417)
  public $object_id;

  // Type of object. String. (Document, Publication, Theme, Region, Country).
  public $object_type;
  public $item_type;
  public $timestamp;

  // Readable identifier of this object.
 
  // Web-accessible uri for this object 
  public $metadata_url;

  // Indicates when record was indexed in the API.
 

  // URL for the asset on the collection website.
 /* public $website_url;
  public $title;
  public $titles;

  public $site;*/

  // Name of the object.
  public $name;

  /**
   * Factory method used to create OkhubApiObject objects, depending on its type.
   *
   * @return a new OkhubApiObject object
   */
  // TODO: Check parameters. $format not used any more???
  public static function factory($object, $object_type) {
    switch ($object_type) {
      case 'assets': //not in use for okhub
        return new OkhubApiObjectAsset($object);
      case 'documents':
        return new OkhubApiObjectAssetDocument($object);
      case 'organisations':
        return new OkhubApiObjectAssetOrganisation($object);
      case 'themes':
        return new OkhubApiObjectCategory($object);
      case 'subjects':
        return new OkhubApiObjectCategory($object);
      case 'regions':
        return new OkhubApiObjectCategory($object);
      case 'countries':
        return new OkhubApiObjectCountry($object);
      case 'country_count':
      case 'theme_count':
      case 'region_count':
      case 'subject_count':
      case 'keyword_count':
        return new OkhubApiCount($object, $object_type);
      default:
        return new OkhubApiObject($object);
    }
  }
 
  /**
   * Constructor.
   */
  public function __construct($object) {
    // Basic fields, present in all responses.
    if (isset($object['object_id'])) {
      $this->object_id = $object['object_id'];
    }
    if (isset($object['item_type'])) {
      $this->item_type = $object['item_type'];
    }
    if (isset($object['object_type'])) {
      $this->object_type = $object['object_type'];
    }
    if (isset($object['metadata_url'])) {
      $this->metadata_url = $object['metadata_url'];
    }
    // Additional properties common to all objects that might be present.
    if (isset($object['site'])) {
       $this->site = $object['site'];
    }
    //title
    if (isset($object['title'])) {
      foreach($object['title'] as $s=>$v){
      	if (!empty($v['en'][0])){      
      		$this->title = $v['en'][0];
      		break;
      	} 
	if (!empty($v['fr'][0])){      
      		$this->title = $v['fr'][0];
      		break;
      	} 
      }
    }
    //titles
    if(isset($object['title'])){
    	foreach($object['title'] as $s=>$v){
		if (!empty($v['en'][0])){      
			$this->titles[$s] = $v['en'][0];
		}
		if (!empty($v['fr'][0])){      
			$this->titles[$s] = $v['fr'][0];
		}
      	}
     }
    if (isset($object['timestamp'])) {
      $this->timestamp = $object['timestamp'];
    }
    if (isset($object['website_url'])) {
      foreach($object['website_url'] as $s=>$v){
      	      $this->website_url[$s] = $v[0];
      }
    }
    if (isset($object['name'])) {
      $this->name = $object['name'];
    }
    elseif (isset($object['object_name'])) {
      $this->name = $object['object_name'];
    }
    else {
      $this->name = $this->title;
    }
  }

}

/**
 * OkhubApiObjectAsset class.
 * 
 * This class extends OkhubApiObject and is inherited by OkhubApiObjectAssetDocument and OkhubApiObjectAssetOrganisation.
 *
 */
abstract class OkhubApiObjectAsset extends OkhubApiObject {

  // Asset identifier (for example, 12345).
  public $item_id;

  // Creation date. String. (Example: 2012-02-09 14:36:21). Date in which the object was added to the collection.
  public $date_created;

  // Modification date. String. (Example: 2012-02-09 14:36:21). Date in which the object was last modified.
  public $date_updated;

  // Themes. Array of themes (OkhubObjectCategory). Thematic categories which apply to the document or organisation.
  public $category_theme_array;

  // Subjects. Array of subjects (OkhubObjectCategory). Subject-based categories which apply to the document or organisation.
  public $category_subject_array;

  // Regions. Array of regions (OkhubApiObjectCategory). Regions in which the organisation operates or which apply to the document.
  public $category_region_path;

  // Countries. Array of countries (OkhubApiObjectCountry). Countries in which the organisation operates or which apply to the document.
  public $country_focus;

  // Keywords. Array of strings. Subject keywords that relate to the asset.
  public $keywords;

  // Description. String. Description of the document or organisation.
  public $description;
  public $hub_themes;


  /**
   * Constructor.
   */
  public function __construct($object) {
    parent::__construct($object);
    if (isset($object['item_id'])) {
      $this->item_id = $object['item_id'];
    }
    if (isset($object['date_created'])) {
      $this->date_created = $object['date_created'];
    }
    if (isset($object['date_updated'])) {
      $this->date_updated = $object['date_updated'];
    }
    if (isset($object['category_theme_array'])) {
      $this->category_theme_array = build_array_categories($object['category_theme_array']);
    }
    if (isset($object['category_subject_array'])) {
      $this->category_subject_array = build_array_categories($object['category_subject_array']);
    }
    if (isset($object['category_region_path'])) {
      $this->category_region_path = $object['category_region_path'];
    }
    if (isset($object['country_focus'])) {
      $this->country_focus = $object['country_focus'];
    }
    if (isset($object['keyword'])) {
      $this->keywords = $object['keyword'];
    }
    if (isset($object['description'])) {
      foreach($object['description'] as $s=>$v){ 
      	      if (!empty($v['en'][0])){
      	      	      $this->description[$s] = $v['en'][0];
      	      }
      	      if (!empty($v['fr'][0])){
      	      	      $this->description[$s] = $v['fr'][0];
      	      }
      }
    }
    
    if (isset($object['hub_theme'])){
    	foreach($object['hub_theme'] as $s=>$v){
    		if (!empty($v['en'])){
    			$this->hub_themes[$s] = $v['en'];
    		}
		if (!empty($v['fr'])){
    			$this->hub_themes[$s] = $v['fr'];
    		}
    	}
    }
    
  }

}

/**
 * OkhubApiObjectAssetDocument class.
 * 
 * The objects of this class contain the information of documents in the IDS collection.
 *
 */
class OkhubApiObjectAssetDocument extends OkhubApiObjectAsset {

  /*
  Inherited:

  OkhubApiObject properties:
  public $object_id;
  public $object_type;
  public $title;
  public $site = 'eldis';
  public $metadata_url;
  public $timestamp;
  public $website_url;
  public $name;

  OkhubApiObjectAsset properties:
  public $asset_id;
  public $date_created;
  public $date_updated;
  public $category_theme_array;
  public $category_subject_array;
  public $category_region_array;
  public $country_focus_array;
  public $keyword;
  public $description;
  */

  // Authors (First initial. Surname). Array of strings. 
  public $authors;

  // Language. String. The language in which the title, headline and description are written.
  public $language_name;

  // Language ID. Int. The language in which the title, headline and description are written (language IDS numeric code corresponding to language_name).
  public $language_id;

  // Metadata languages. Languages (two-letter code) in which the translatable metadata (title, description) is available. Array of strings.
  public $metadata_languages;

  // Language array. Holds translatable metadata (title, description) in all available languages.
  public $language_array;

  // Publication date. Date (example: 2004-01-01 00:00:00). Year that the research document was first published.
  public $publication_date;

  // Publication year.
  public $publication_year;

  // Publisher.
  public $publisher;

  // Publisher ID.
  public $publisher_id;

  // Publisher country.
  public $publisher_country;

  // Publishers. Array of OkhubApiObjectAssetOrganisation. Organisations that published the research.
  public $publisher_array;

  // Licence type. String.
  // This is not documented. Will not be used? It's now being retrieved with the documents' data.
  public $licence_type;

  // External URLs. Array of strings. URLs of the full text document. 
  public $urls;
  public $url;

  // Type of document. Array of strings.
  public $document_type;
  
   // Type of document. Array of strings.
  //public $bridge_document_type;

  // Headline. String. A short version of the title or description of the research document.
 // public $headline;

  
  //new
  
  public $website_url;
  public $title;
  public $titles;

  public $site;
  /**
   * Constructor.
   */
  public function __construct($object) {
    parent::__construct($object);
    if (isset($object['author'])) {
      foreach($object['author'] as $s=>$v){
      	      $this->authors[$s] = implode(', ',$v);
      }
    }
    if (isset($object['language_name'])) {
      $this->language_name = $object['language_name'];
    }
    if (isset($object['language_id'])) {
      $this->language_id = $object['language_id'];
    }
    if (isset($object['metadata_languages'])) {
      $this->metadata_languages = $object['metadata_languages'];
    }
    if (isset($object['language_array'])) {
      $this->language_array = build_array_languages($object['metadata_languages']);
    }
    if (isset($object['publication_date'])) {
      $this->publication_date = $object['publication_date'];
    }
    if (isset($object['publication_year'])) {
      $this->publication_year = $object['publication_year'];
    }
    if (isset($object['publisher'])) {
      $this->publisher = $object['publisher'];
    }
    if (isset($object['publisher_id'])) {
      $this->publisher_id = $object['publisher_id'];
    }
    if (isset($object['publisher_country'])) {
      $this->publisher_country = $object['publisher_country'];
    }
    if (isset($object['publisher_array'])) {
      //$this->publisher_array = build_array_organisations($object['publisher_array']);
    }
    if (isset($object['licence_type'])) {
      $this->licence_type = $object['licence_type'];
    }
    if (isset($object['urls'])) {
    	    foreach($object['urls'] as $s=>$v){
    	    	if (!empty($v[0])){    
    	    		$this->url=$v[0];
    	    		break;
    	    	}
    	    }   	    	   
    }
    if (isset($object['urls'])) {
    	    foreach($object['urls'] as $s=>$v){
    	    	$this->urls[$s]=$v[0];	    
    	    }   	    	   
    }
    if (isset($object['category_sector'])) {
     // $this->bridge_document_type = $object['category_sector'];
    }
    if (isset($object['document_type'])) {
      $this->document_type = $object['document_type'];
    }
    
  }

}

/**
 * OkhubApiObjectAssetOrganisation class.
 * 
 * The objects of this class contain the information of organisations in the IDS collection.
 *
 */
class OkhubApiObjectAssetOrganisation extends OkhubApiObjectAsset {

  /*
  Inherited:

  OkhubApiObject properties:
  public $object_id;
  public $object_type;
  public $title;
  public $site = 'eldis';
  public $metadata_url;
  public $timestamp;
  public $website_url;
  public $name;

  OkhubApiObjectAsset properties:
  public $asset_id;
  public $date_created;
  public $date_updated;
  public $category_theme_array;
  public $category_subject_array;
  public $category_region_array;
  public $country_focus_array;
  public $keyword;
  public $description;
  */

  // Acronym. String. Acronym of organisation.
  public $acronym;

  // Alternative acronym. String. Alternative acronym of organisation.
  public $alternative_acronym;

  // Alternative name. String. Alternative name of organisation.
  public $alternative_name;

  // Organisation type. String. Primary function or role of the organisation in relation to international development. 
  public $organisation_type;

  // Organisation URL. String. Link to the organisation's website.
  public $organisation_url;

  // Country where the organisation is located. String.
  public $location_country;

  // Is this needed? Organisation type id. String. Numerical ID of the organisation type.
  // public $organisation_type_id;

  // Is this needed? It's only present in organisations. publication_date in documents has another meaning.
  //public $asset_publication_date;

  /**
   * Constructor.
   */
  public function __construct($object) {
    parent::__construct($object);
    if (isset($object['acronym'])) {
      $this->acronym = $object['acronym'];
    }
    if (isset($object['alternative_acronym'])) {
      $this->alternative_acronym = $object['alternative_acronym'];
    }
    if (isset($object['alternative_name'])) {
      $this->alternative_name = $object['alternative_name'];
    }
    if (isset($object['organisation_type'])) {
      $this->organisation_type = $object['organisation_type'];
    }
    if (isset($object['organisation_url'])) {
      $this->organisation_url = $object['organisation_url'];
    }
    if (isset($object['location_country'])) {
      $this->location_country = $object['location_country'];
    }
  }

}

/**
 * OkhubApiObjectObjectCategory class.
 * 
 * The objects of this class contain the information of regions and themes in the IDS collection.
 *
 */
class OkhubApiObjectCategory extends OkhubApiObject  {

  /*extends OkhubApiObject
  Inherited:

  OkhubApiObject properties:
  public $object_id;
  public $object_type;
  public $title;
  public $site = 'eldis';
  public $metadata_url;
  public $timestamp;
  public $website_url;
  public $name;
  */

  // Level of the category in the hierarchy.
  public $level;
 
  // Numerical code of the parent category. Example: 34. [This is no longer included in the API response?].
  //public $cat_parent;

  // Object Id of the parent category. Example: C34.
  //public $parent_object_id;

  // Id of the superparent category. '2' represents the root level.
  //public $cat_superparent;

  // Id of the category. It's a numerical code of the category. 
 // public $category_id;

  // Indicates if the category is archived.
  public $archived = FALSE;
  public $metadata_url;

  /**
   * Constructor.
   */
  function __construct($object) {
    parent::__construct($object);
    if (isset($object['category_id'])) {
     // $this->category_id = $object['category_id'];
    }
    if (isset($object['level'])) {
      $this->level = $object['level'];
    }
    if (isset($object['parent_object_id'])) {
      //$this->parent_object_id = $object['parent_object_id'];
    }
    if (isset($object['cat_parent'])) {
      //$this->cat_parent = $object['cat_parent'];
    }
    elseif (isset($object['parent_object_id'])) {
      //$this->cat_parent = preg_replace('/[a-zA-Z]*(\d+)/', '$1', $this->parent_object_id);
    }
    if (isset($object['cat_superparent'])) {
      //$this->cat_superparent = $object['cat_superparent'];
    }
    if (isset($object['archived'])) {
      $this->archived = $object['archived'];
    }
    if (isset($object['object_id'])) {
      $this->object_id = $object['object_id'];
    }
    if (isset($object['object_type'])) {
      $this->object_type = $object['object_type'];
    }
    if (isset($object['object_name'])) {
      $this->name = $object['object_name'];
    }
    if (isset($object['metadata_url'])) {
      $this->metadata_url = $object['metadata_url'];
    }
  }

}

/**
 * OkhubApiObjectCountry class.
 * 
 * The objects of this class contain the information of countries in the IDS collection.
 *
 */
 
class OkhubApiObjectCountry extends OkhubApiObject {

  /*
  Inherited:

  OkhubApiObject properties:
  public $object_id;
  public $object_type;
  public $title;
  public $site = 'eldis';
  public $metadata_url;
  public $timestamp;
  public $website_url;
  public $name;
  */

  // Alternative name of the country. String.
  public $alternative_name;

  // Id of the country in the IDS collection.
  //public $asset_id;

  // Regions. Array of regions (OkhubApiObjectCategory). Regions to which this country belongs.
  public $category_region_array;  

  // ISO number. Example: 50 (Bangladesh).
  public $iso_number;

  // ISO three-letter code. Example: BGD (Bangladesh).
  public $iso_three_letter_code;

  // ISO two-letter code. Example: BD (Bangladesh).
  public $iso_two_letter_code;

  /**
   * Constructor.
   */
  function __construct($object) {
    parent::__construct($object);
    if (isset($object['alternative_name'])) {
      $this->alternative_name = $object['alternative_name'];
    }
    if (isset($object['asset_id'])) {
      $this->asset_id = $object['asset_id'];
    }
    if (isset($object['category_region_array'])) {
     // $this->category_region_array = build_array_categories($object['category_region_array']);
    }  
    if (isset($object['iso_number'])) {
      $this->iso_number = $object['iso_number'];
    }
    if (isset($object['iso_three_letter_code'])) {
      $this->iso_three_letter_code = $object['iso_three_letter_code'];
    }
    if (isset($object['iso_two_letter_code'])) {
      $this->iso_two_letter_code = $object['iso_two_letter_code'];
    }  
  }

}

/**
 * OkhubApiCount class.
 *
 * Objects of this class hold one result of a count request.
 *
 */
class OkhubApiCount {

  // Number of responses corresponding to the category.
  public $count;

  // This is an OkhubApiObject representing the category (in the case of theme, subject and region OkhubApiObjectCategory and for country OkhubApiObjectCountry).
  public $item;

  /**
   * Constructor.
   */
  function __construct($object, $type) {
    if (isset($object['count'])) {
      $this->count = $object['count'];
    }
    switch ($type) {
      case 'country_count':
        $this->item = new OkhubApiObjectCountry($object);
        break;
      case 'theme_count':
      case 'region_count':
      case 'subject_count':
        $this->item = new OkhubApiObjectCategory($object);
        break;
      default:
        $this->item = new OkhubApiObject($object);
        break;
    }
  }

}



/* --------------------------- Helper functions ------------------------- */

function build_array_categories($array_categories) {
  $categories = array();
  if (is_array($array_categories)) {
    foreach (current($array_categories) as $s=>$category) {
      foreach($category as $m=>$z){
      	      $categories[] = new OkhubApiObjectCategory($z);
      }
    }
  }
  return $categories;
}

function build_array_countries($array_countries) {
  $countries = array();
  if (is_array($array_countries)) {
    foreach (current($array_countries) as $country) {
      $countries[] = new OkhubApiObjectCountry($country);
    }
  }
  return $countries;
}

function build_array_organisations($array_organisations) {
  $organisations = array();
  if (is_array($array_organisations)) {
    foreach (current($array_organisations) as $organisation) {
      $organisations[] = new OkhubApiObjectAssetOrganisation($organisation);
    }
  }
  return $organisations;
}

function build_array_languages($language_array) {
  $languages = array();
  if (is_array($language_array)) {
    foreach (current($language_array) as $language) {
      if (isset($language['isocode'])) {
        $languages[$language['isocode']] = array();
        foreach ($language as $field => $value) {
          $languages[$language['isocode']][$field] = $value;
        }      
      }
    }
  }
  return $languages;
}


