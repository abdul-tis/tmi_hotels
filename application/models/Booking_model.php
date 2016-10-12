<?php
Class Booking_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	/**
	 * @Method		-: getAllBookings()
	 * @Description	-: This function is used to fetch all bookings
	 * @Created on	-: 28-09-2016
	 * @Return 		-: array()
	 */
	function getAllBookings($start=NULL){
		$this->db->select('rd.*,r.hotel_id,r.room_type,r.from_date,r.to_date,r.booked_rooms,c.name,c.email,c.phone');
		$this->db->join('reservation as r','r.id=rd.reservation_id');
		$this->db->join('customers as c','c.id=rd.customer_id');
		if(!empty($start)){
			$start		= ($start=='P') ? 0 : $start;
			$result = $this->db->limit($this->limit,$start)->get('reservation_details as rd')->result_array();
		}else{
			$result = $this->db->get('reservation_details as rd')->num_rows();
		}

		return $result;
	}

	/**
	 * @Method		-: saveCustomer()
	 * @Description	-: This function is used to save customer
	 * @Created on	-: 29-09-2016
	 * @Return 		-: array()
	 */
	function saveCustomer($data){
		$this->db->where('email',$data['email']);
		$row  = $this->db->get('customers')->row_array();
		if(count($row) > 0){
			$this->db->where('id',$row['id']);
			$this->db->update('customers',$data);
			$result = $row['id'];
		}else{
			$this->db->insert('customers',$data);
			$result = $this->db->insert_id();
		}
		
		return $result;
	}

	/**
	 * @Method		-: saveBookingDetails()
	 * @Description	-: This function is used to save booking details
	 * @Created on	-: 29-09-2016
	 * @Return 		-: array()
	 */
	function saveBookingDetails($data){
		$this->db->insert('reservation_details',$data);
		$result = $this->db->insert_id();
		return $result;
	}

	/**
	 * @Method		-: deleteBooking()
	 * @Description	-: This function is used to remove booking
	 * @Created on	-: 01-10-2016
	 * @Return 		-: array()
	 */
	function deleteBooking($id){
		if(!empty($id)){
			$this->db->where('id',$id);
			$result   = $this->db->delete('reservation_details');
			return $result;
		}
	}



}

?>