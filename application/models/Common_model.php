<?php
Class Common_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	/**
	 * @Method		-: getAllCountry()
	 * @Description	-: This function is used to fetch all countries
	 * @Created on	-: 06-09-2016
	 * @Return 		-: array()
	 */ 

	function getAllCountry()
	{
		$result = $this->db->get('country')->result_array();

		return $result;
	}

	/**
	 * @Method		-: getStatesByCountry()
	 * @Description	-: This function is used to fetch all states by country
	 * @Created on	-: 06-09-2016
	 * @Return 		-: array()
	 */ 

	function getStatesByCountry($country_id=null)
	{
		$this->db->where('country_id',$country_id);
		$this->db->where('status','1');
		$result = $this->db->get('state')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getCitiesByState()
	 * @Description	-: This function is used to fetch all cities by state
	 * @Created on	-: 06-09-2016
	 * @Return 		-: array()
	 */

	function getCitiesByState($state_id=null)
	{
		$this->db->where('state_id',$state_id);
		$this->db->where('status','1');
		$result = $this->db->get('cities')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getHotelTypes()
	 * @Description	-: This function is used to fetch all hotel types
	 * @Created on	-: 06-09-2016
	 * @Return 		-: array()
	 */

	function getHotelTypes()
	{
		$result = $this->db->get('hotel_type')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getAmenities()
	 * @Description	-: This function is used to fetch all amenities
	 * @Created on	-: 06-09-2016
	 * @Return 		-: array()
	 */

	function getAmenities($type)
	{
		/*$query = $this->db->query("select p.id as parent_id,p.service_name as parent_service,c.id as child_id,c.service_name as child_service from services p LEFT JOIN services c ON c.parent_id = p.id where p.parent_id=0 AND p.type='".$type."'");
		$result = $query->result_array();*/
		$this->db->where('parent_id','0');
		$this->db->where('type',$type);
		$result = $this->db->get('services')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getRoomTypes()
	 * @Description	-: This function is used to fetch all room types
	 * @Created on	-: 12-09-2016
	 * @Return 		-: array()
	 */

	function getRoomTypes()
	{
		$this->db->where('status','1');
		$result = $this->db->get('room_type')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getRateCategories()
	 * @Description	-: This function is used to fetch all room types
	 * @Created on	-: 12-09-2016
	 * @Return 		-: array()
	 */

	function getRateCategories()
	{
		$this->db->where('status','1');
		$result = $this->db->get('rate_categories')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getCancellationRules()
	 * @Description	-: This function is used to fetch cancellation rules
	 * @Created on	-: 15-09-2016
	 * @Return 		-: array()
	 */

	function getCancellationRules()
	{
		$this->db->where('status','1');
		$result = $this->db->get('cancellation_rules')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getDesignation()
	 * @Description	-: This function is used to fetch Designation
	 * @Created on	-: 17-09-2016
	 * @Return 		-: array()
	 */

	function getDesignation()
	{
		$this->db->where('status','1');
		$result = $this->db->get('designation')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getHotelChain()
	 * @Description	-: This function is used to fetch hotel chain
	 * @Created on	-: 19-09-2016
	 * @Return 		-: array()
	 */

	function getHotelChains()
	{
		$this->db->where('status','1');
		$result = $this->db->get('hotel_chain')->result_array();
		return $result;
	}

	function getRoomDetailsByHotel($hotel_id)
	{
		$this->db->select('r.price,rc.meal_plan,rc.category_type,rt.room_type');
		$this->db->join('room_type as rt','r.room_type=rt.id');
		$this->db->join('rate_categories as rc','r.rate_category=rc.id');
		$this->db->where('r.hotel_id',$hotel_id);
		$result = $this->db->get('room_info as r')->result_array();
		return $result;
	}


	/**
	 * @Method		-: getHotelCategories()
	 * @Description	-: This function is used to fetch hotel categories
	 * @Created on	-: 20-09-2016
	 * @Return 		-: array()
	 */
	function getHotelCategories()
	{
		$this->db->where('status','1');
		$result = $this->db->get('hotel_categories')->result_array();
		return $result;
	}
}

?>