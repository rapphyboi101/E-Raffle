<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Raffle_model extends CI_Model {

	public function winner($raffle_no){
		if($raffle_no == 0){
			return false;
		}
	


		$this->db->select("*");
		$this->db->where("(status = 0) AND (raffle_ticket_no != 0)");
		$this->db->order_by("rand()");
		$this->db->limit(1);
		$this->db->from("user_info");
		$query = $this->db->get();
		return $query->result_array();
	
		/*else{
			$this->db->select("raffle_ticket_no,name, department");
			$this->db->where("(raffle_ticket_no = '$raffle_no') AND (status = 0) AND (attendance = 1) AND (raffle_ticket_no IS NOT NULL");
			$this->db->from("user_info");
			$query = $this->db->get();
			if (empty($query)){
				return false;
			}
			else{
			$this->db->set("status","1");
			$this->db->where("raffle_ticket_no = '$raffle_no'");
			$this->db->update("user_info");
				return $query->result();

			}
		}*/

		/*$query = $this->db->query('SELECT name FROM user_info WHERE raffle_ticket_no = "$raffle_no"');
		return $query->result();
		if ($query->num_rows() != 0){

		}*/
	}

	public function update_raffle($prize,$value){
		$this->db->set("status", "1");
		$this->db->set("prize",$prize);
		$this->db->where("raffle_ticket_no",$value);
		$this->db->update("user_info");
	}

	public function getWinners(){
		$this->db->select("*");
		$this->db->join("user_info t", "t.raffle_ticket_no = w.raffle_ticket_no");
		$query = $this->db->get("winners w");
		return $query->result_array();
	}

	public function getAll(){
		$this->db->select("*");
		$query = $this->db->get("user_info");
		return $query->num_rows();
	}

	public function add_winner($raffle_no,$prize){
	$this->db->set("prize",$prize);
	$this->db->set("raffle_ticket_no",$raffle_no);
	$this->db->where("raffle_ticket_no = '$raffle_no");
	$this->db->insert("winners");
	}
}