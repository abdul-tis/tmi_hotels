<?php
Class Setting_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	/**
	 * @Method		-: getHotelType()
	 * @Description	-: This function is used to fetch all hotel types
	 * @Created on	-: 06-09-2016
	 * @Return 		-: array()
	 */ 
	function getHotelType()
	{
		
	}

	/**
	 * @Method		-: getAmenities()
	 * @Description	-: This function is used to fetch all amenities
	 * @Created on	-: 19-09-2016
	 * @Return 		-: array()
	 */

	function getAmenities()
	{
		$result = $this->db->get('services')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getMainServices()
	 * @Description	-: This function is used to fetch main services
	 * @Created on	-: 19-09-2016
	 * @Return 		-: array()
	 */
	function getMainServices(){
		$result = $this->db->where('parent_id','0')->get('services')->result_array();
		return $result;
	}

	/**
	 * @Method		-: saveAminity()
	 * @Description	-: This function is used to save amenities
	 * @Created on	-: 19-09-2016
	 * @Return 		-: array()
	 */

	function saveAminity($data){
		if(!empty($data)){
			$this->db->insert('services',$data);
			return $this->db->insert_id();
		}
	}

	/**
	 * @Method		-: getAminityById()
	 * @Description	-: This function is used to get amenity details
	 * @Created on	-: 19-09-2016
	 * @Return 		-: array()
	 */

	function getAminityById($id){
		$this->db->where('id',$id);
		$result = $this->db->get('services')->row_array();
		return $result;
	}

	/**
	 * @Method		-: deleteAmenity()
	 * @Description	-: This function is used to delete amenity
	 * @Created on	-: 19-09-2016
	 * @Return 		-: array()
	 */

	function deleteAmenity($id){
		$this->db->where('id',$id);
		$result = $this->db->delete('services');
		return $result;
	}

	/**
	 * @Method		-: deleteAmenity()
	 * @Description	-: This function is used to delete amenity
	 * @Created on	-: 19-09-2016
	 * @Return 		-: array()
	 */

	function getHotelChains(){
		$result = $this->db->get('hotel_chain')->result_array();
		return $result;
	}
}
?>