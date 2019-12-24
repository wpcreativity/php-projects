<?php
class Service_model extends Dbo
{
    const _TABLE = 'asap_service';
    const _ID = 'id';
    const _AUTHOR = 'author';
    const _SERVICE_NAME = 'service_name';
    const _SERVICE_NAME_SLUG = 'service_name_slug';
    const _SERVICE_DESCRIPTION = 'service_description';
    const _FEATUTED_IMAGE = 'featured_image';
    const _SERVICE_IMAGE = 'service_image';
    const _STATUS = 'status';
    const _META_TITLE = 'meta_title';
    const _META_KEYWORD = 'meta_keywords';
    const _META_DESCRIPTION = 'meta_description';
    const _DATE_CREATED = 'date_created';
    const _DATE_MODIFIED = 'date_modified';
    
    
    public function __construct(){
		parent::__construct();
		
		# Load service image model
		$this->load->model('service_image_model');
	}
	
	# Functions specifically used by admin starts
	
	public function get_service_name($id)
	{
	    $condition = array(static::_ID => $id);
	    $fields = array(static::_SERVICE_NAME);
	    
	    $result = $this->get_one(static::_TABLE, $condition, $fields);
	    return $result->{static::_SERVICE_NAME};
	    
	}
	
	public function create_service($author, $serviceName, $serviceDescription, $metaTitle, $metaKeywords, $metaDescription, $featuredImage, $serviceImage)
	{
	    $date = new DateTime();
	    $date = $date->format('Y-m-d H:i:s');
	    
	    $data = array(
            static::_AUTHOR => $author,
	        static::_SERVICE_NAME => $serviceName,
	        static::_SERVICE_NAME_SLUG => create_slug($serviceName, $this->get_slug_array()),
	        static::_SERVICE_DESCRIPTION=>$serviceDescription,   
	        static::_STATUS => 1,
            static::_META_TITLE => $metaTitle,
            static::_META_KEYWORD => $metaKeywords,
            static::_META_DESCRIPTION => $metaDescription,
	        static::_FEATUTED_IMAGE => $featuredImage,
	        static::_SERVICE_IMAGE => $serviceImage,
            static::_DATE_CREATED => $date
	    );
	    
	    return $this->save(static::_TABLE, $data);
	}
	
	public function get_services()
	{
	    return $this->get_all(static::_TABLE);    
	    
	}
	
	public function get_single_service($serviceId)
	{
		$condition = array(static::_ID => $serviceId);
	    
		return $this->get_all(static::_TABLE, $condition);
	}
		
	public function update_service($serviceId, $serviceName, $serviceDescription, $metaTitle, $metaKeywords, $metaDescription, $featuredImage, $serviceImage)
	{
	    $date = new DateTime();
	    $date = $date->format('Y-m-d H:i:s');
	    
// 	    # Get By Slug
// 	    $pageData = $this->get_by_slug($slug);
	    
// 	    $slug = $slug;
// 	    if($pageData->{static::_SERVICE_NAME} != $serviceName){
// 	        $slug = create_slug($serviceName, $this->get_slug_array());
// 	    }
	    
	    
	    $data = array(
	            static::_SERVICE_NAME => $serviceName,
	            static::_SERVICE_DESCRIPTION=>$serviceDescription,
	            static::_STATUS => 1,
	            static::_META_TITLE => $metaTitle,
	            static::_META_KEYWORD => $metaKeywords,
	            static::_META_DESCRIPTION => $metaDescription,
    	        static::_FEATUTED_IMAGE => $featuredImage,
    	        static::_SERVICE_IMAGE => $serviceImage,
	            static::_DATE_CREATED => $date
	    );

	    $condition = array(static::_ID=>$serviceId);
	    
	    return $this->update(static::_TABLE, $data, $condition);
	}
	
	public function publish_service($serviceId)
	{
	    $dateObj = new DateTime();
	    $date = $dateObj->format('Y-m-d H:i:s');
	
	    $data = array( static::_DATE_MODIFIED=>$date, static::_STATUS=>1);
	    # $postId = array_map('intval', explode(',', $postIds));
	
	    return $this->update_many(static::_TABLE, $data, static::_ID, $serviceId);
	}
	
	public function unpublish_service($serviceId)
	{
	    $dateObj = new DateTime();
	    $date = $dateObj->format('Y-m-d H:i:s');
	
	    $data = array( static::_DATE_MODIFIED=>$date, static::_STATUS=>0);
	    # $postId = array_map('intval', explode(',', $postIds));
	
	    return $this->update_many(static::_TABLE, $data, static::_ID, $serviceId);
	}
	
	public function delete_service($serviceId)
	{
	    $condition = array(static::_ID => $postIds);
	    return $this->delete_many(static::_TABLE, static::_ID, $serviceId);
	}
	
	public function block_service($serviceId)
	{
	    $dateObj = new DateTime();
	    $date = $dateObj->format('Y-m-d H:i:s');
	
	    $data = array( static::_DATE_MODIFIED=>$date, static::_STATUS=>2);
	    # $postId = array_map('intval', explode(',', $postIds));
	
	    return $this->update_many(static::_TABLE, $data, static::_ID, $serviceId);
	}
	
	public function get_service_id_by_slug($slug)
	{
	    $condition = array(static::_SERVICE_NAME => $slug);
	    return $this->get_one_field(static::_TABLE, static::_ID, $condition);
	}
	
	public function get_by_slug($slug)
	{
	    $condition = array(static::_SERVICE_NAME_SLUG => $slug);
	    return $this->get_one(static::_TABLE, $condition);
	}
	
	public function get_slug_array()
	{
	    $slugArray = array();
	    $fields = array(static::_SERVICE_NAME_SLUG);
	    $slugObjArray = $this->get_all(static::_TABLE, '',$fields);
	    
	    if(!empty($slugObjArray))
	    {
	        foreach ($slugObjArray as $s)
	        {
	            array_push($slugArray, $s->{static::_SERVICE_NAME_SLUG});
	        }
	    }
	    
	    
	    return $slugArray;
	}
	
	# Functions specifically used by admin ends
	
	
}