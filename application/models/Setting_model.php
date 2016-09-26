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
	function saveAminity($data,$id=null){
		if(!empty($id)){
			$this->db->where('id',$id);
			$result = $this->db->update('services',$data);
		}else{
			$this->db->insert('services',$data);
			$result = $this->db->insert_id();
		}

		return $result;
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

	/**
	 * @Method		-: saveHotelChain()
	 * @Description	-: This function is used to save Hotel Chain
	 * @Created on	-: 20-09-2016
	 * @Return 		-: array()
	 */
	function saveHotelChain($data,$id=null){
		if(!empty($id)){
			$this->db->where('id',$id);
			$result = $this->db->update('hotel_chain',$data);
		}else{
			$this->db->insert('hotel_chain',$data);
			$result = $this->db->insert_id();
		}

		return $result;
	}

	/**
	 * @Method		-: getHotelChainById()
	 * @Description	-: This function is used to get hotel chain details
	 * @Created on	-: 20-09-2016
	 * @Return 		-: array()
	 */
	function getHotelChainById($id){
		$this->db->where('id',$id);
		$result = $this->db->get('hotel_chain')->row_array();
		return $result;
	}

	/**
	 * @Method		-: deleteHotelChain()
	 * @Description	-: This function is used to delete hotel chain
	 * @Created on	-: 20-09-2016
	 */
	function deleteHotelChain($id){
		$this->db->where('id',$id);
		$result = $this->db->delete('hotel_chain');
		return $result;
	}

	/**
	 * @Method		-: getHotelCategories()
	 * @Description	-: This function is used to get hotel categories
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function getHotelCategories(){
		$result = $this->db->get('hotel_categories')->result_array();
		return $result;
	}

	/**
	 * @Method		-: saveHotelCategory()
	 * @Description	-: This function is used to save Hotel Category
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function saveHotelCategory($data,$id=null){
		if(!empty($id)){
			$this->db->where('id',$id);
			$result = $this->db->update('hotel_categories',$data);
		}else{
			$this->db->insert('hotel_categories',$data);
			$result = $this->db->insert_id();
		}

		return $result;
	}

	/**
	 * @Method		-: getHotelCategoryById()
	 * @Description	-: This function is used to get hotel category details
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function getHotelCategoryById($id){
		$this->db->where('id',$id);
		$result = $this->db->get('hotel_categories')->row_array();
		return $result;
	}

	/**
	 * @Method		-: deleteHotelCategory()
	 * @Description	-: This function is used to delete hotel category
	 * @Created on	-: 23-09-2016
	 */
	function deleteHotelCategory($id){
		$this->db->where('id',$id);
		$result = $this->db->delete('hotel_categories');
		return $result;
	}

	/**
	 * @Method		-: getHotelTypes()
	 * @Description	-: This function is used to get hotel types
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function getHotelTypes(){
		$result = $this->db->get('hotel_type')->result_array();
		return $result;
	}

	/**
	 * @Method		-: saveHotelType()
	 * @Description	-: This function is used to save Hotel type
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function saveHotelType($data,$id=null){
		if(!empty($id)){
			$this->db->where('id',$id);
			$result = $this->db->update('hotel_type',$data);
		}else{
			$this->db->insert('hotel_type',$data);
			$result = $this->db->insert_id();
		}

		return $result;
	}

	/**
	 * @Method		-: getHotelTypeById()
	 * @Description	-: This function is used to get hotel type details
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function getHotelTypeById($id){
		$this->db->where('id',$id);
		$result = $this->db->get('hotel_type')->row_array();
		return $result;
	}

	/**
	 * @Method		-: deleteHotelType()
	 * @Description	-: This function is used to delete hotel type
	 * @Created on	-: 23-09-2016
	 */
	function deleteHotelType($id){
		$this->db->where('id',$id);
		$result = $this->db->delete('hotel_type');
		return $result;
	}

	/**
	 * @Method		-: getRoomTypes()
	 * @Description	-: This function is used to get room types
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function getRoomTypes(){
		$result = $this->db->get('room_type')->result_array();
		return $result;
	}

	/**
	 * @Method		-: saveRoomType()
	 * @Description	-: This function is used to save Room type
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function saveRoomType($data,$id=null){
		if(!empty($id)){
			$this->db->where('id',$id);
			$result = $this->db->update('room_type',$data);
		}else{
			$this->db->insert('room_type',$data);
			$result = $this->db->insert_id();
		}

		return $result;
	}

	/**
	 * @Method		-: getRoomTypeById()
	 * @Description	-: This function is used to get room type details
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function getRoomTypeById($id){
		$this->db->where('id',$id);
		$result = $this->db->get('room_type')->row_array();
		return $result;
	}

	/**
	 * @Method		-: deleteRoomType()
	 * @Description	-: This function is used to delete room type
	 * @Created on	-: 23-09-2016
	 */
	function deleteRoomType($id){
		$this->db->where('id',$id);
		$result = $this->db->delete('room_type');
		return $result;
	}

	/**
	 * @Method		-: getRateCategories()
	 * @Description	-: This function is used to get rate categories
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function getRateCategories(){
		$result = $this->db->get('rate_categories')->result_array();
		return $result;
	}

	/**
	 * @Method		-: saveRateCategory()
	 * @Description	-: This function is used to save rate category
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function saveRateCategory($data,$id=null){
		if(!empty($id)){
			$this->db->where('id',$id);
			$result = $this->db->update('rate_categories',$data);
		}else{
			$this->db->insert('rate_categories',$data);
			$result = $this->db->insert_id();
		}

		return $result;
	}

	/**
	 * @Method		-: getRateCategoryById()
	 * @Description	-: This function is used to get rate category details
	 * @Created on	-: 23-09-2016
	 * @Return 		-: array()
	 */
	function getRateCategoryById($id){
		$this->db->where('id',$id);
		$result = $this->db->get('rate_categories')->row_array();
		return $result;
	}

	/**
	 * @Method		-: deleteRateCategory()
	 * @Description	-: This function is used to delete rate category
	 * @Created on	-: 23-09-2016
	 */
	function deleteRateCategory($id){
		$this->db->where('id',$id);
		$result = $this->db->delete('rate_categories');
		return $result;
	}




}
?>