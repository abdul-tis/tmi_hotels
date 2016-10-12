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
		$this->db->select('r.*,rc.meal_plan,rc.category_type,rt.room_type as room_type_name');
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

	/**
	 * @Method		-: getRoomDetailsById()
	 * @Description	-: This function is used to fetch room details
	 * @Created on	-: 20-09-2016
	 * @Return 		-: array()
	 */
	function getRoomDetailsById($hotel_id,$id)
	{
		$this->db->select('r.*,rt.room_type');
		$this->db->join('room_type as rt','r.room_type=rt.id');
		$this->db->where('r.type_id',$id);
		$this->db->where('r.hotel_id',$hotel_id);
		$result = $this->db->get('room_info as r')->row_array();
		return $result;
	}

	/**
	 * @Method		-: getReservedRoom()
	 * @Description	-: This function is used to fetch reserved room
	 * @Created on	-: 26-09-2016
	 * @Return 		-: array()
	 */
	function getReservedRoom($id,$fromDate,$toDate){
		$query = $this->db->query("select sum(booked_rooms) as booked_rooms,sum(blocked_rooms) as blocked_rooms 
									from reservation where
									room_type='".$id."'
									AND ('".$toDate."' between from_date and to_date 
            						OR to_date between  '".$fromDate."'  and  '".$toDate."'  
            						OR  '".$fromDate."' between from_date and to_date 
            						OR from_date between '".$fromDate."'  and '".$toDate."')
            						");
		
		$result = $query->row_array();
		//echo $this->db->last_query();
		return $result;
	}

	/**
	 * @Method		-: getHotelsByLocality()
	 * @Description	-: This function is used to fetch hotels by locality
	 * @Created on	-: 28-09-2016
	 * @Return 		-: array()
	 */
	function getHotelsByLocality($location){
		$this->db->select('h.*');
		$this->db->join('hotel_location as hl','hl.hotel_id=h.hotel_id');
		$this->db->like('hl.locality',$location);
		$result  = $this->db->get('hotel as h')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getActiveCoupons()
	 * @Description	-: This function is used to fetch active coupons
	 * @Created on	-: 30-09-2016
	 * @Return 		-: array()
	 */
	function getActiveCoupons(){
		$this->db->where('active','1');
		$this->db->where('date(finish_date)>=',date('Y-m-d'));
		$result  = $this->db->get('coupons')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getActiveCampaigns()
	 * @Description	-: This function is used to fetch active campaigns
	 * @Created on	-: 30-09-2016
	 * @Return 		-: array()
	 */
	function getActiveCampaigns(){
		$this->db->where('active','1');
		$this->db->where('date(finish_date)>=',date('Y-m-d'));
		$result  = $this->db->get('campaigns')->result_array();
		return $result;
	}

	/**
	 * @Method		-: getCouponById()
	 * @Description	-: This function is used to get coupon by id
	 * @Created on	-: 30-09-2016
	 * @Return 		-: array()
	 */
	function getCouponById($coupon_id){
		$result = $this->db->where('id',$coupon_id)->get('coupons')->row_array();
		return $result;
	}

	/**
	 * @Method		-: getCampaignById()
	 * @Description	-: This function is used to get campaign by id
	 * @Created on	-: 30-09-2016
	 * @Return 		-: array()
	 */
	function getCampaignById($campaign_id){
		$result = $this->db->where('id',$campaign_id)->get('campaigns')->row_array();
		return $result;
	}

	/**
	 * @Method		-: searchBooking()
	 * @Description	-: This function is used to search bookings
	 * @Created on	-: 01-10-2016
	 * @Return 		-: array()
	 */
	function searchBooking($data){
		$this->db->select('rd.*,r.hotel_id,r.room_type,r.from_date,r.to_date,r.booked_rooms,c.name,c.email,c.phone,h.hotel_name');
		$this->db->join('reservation as r','r.id=rd.reservation_id');
		$this->db->join('customers as c','c.id=rd.customer_id');
		$this->db->join('hotel as h','h.hotel_id=r.hotel_id');
		if(!empty($data['booking_number'])){
			$this->db->where('rd.booking_number',$data['booking_number']);
		}
		if(!empty($data['hotel_name'])){
			$this->db->like('h.hotel_name',$data['hotel_name']);
		}

		if(!empty($data['from_date']) && !empty($data['to_date'])){
			$this->db->where('r.from_date >=',$data['from_date']);
			$this->db->where('r.to_date <=',$data['to_date']);
		}
		$result 	= $this->db->get('reservation_details as rd')->result_array();

		return $result;
	}
}

?>