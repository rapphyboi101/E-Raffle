<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raffle extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Raffle_model');
	}

	public function showWinners(){
		$data = array();
		$data['winners'] = $this->Raffle_model->getWinners();
		$this->load->view('raffle_winners',$data);
	}

	public function index(){
			$data = array();
			$data['all'] = $this->Raffle_model->getAll();
			$this->load->view('index',$data);
		}

	public function send2(){;
		if ($_POST){
			$data_to_pass = array();
			$output = $this->input->post('output');
			$prize = $this->input->post('prize');
			$data = $this->Raffle_model->winner($output);

			foreach($data as $value)
			{
				$ticket_no = $value['raffle_ticket_no'];
				$this->Raffle_model->update_raffle($prize,$ticket_no);
				$this->Raffle_model->add_winner($ticket_no,$prize);

				$data2 = array(
					'raffle_ticket_no' => $value['raffle_ticket_no'],
					'name' => $value['name'],
					'department' => $value['department'],
					'prize' => $prize

				);
				array_push($data_to_pass,$data2);
			}
			echo json_encode($data_to_pass);
			/*if ($data == false){
				$data = 'Play Again';
				echo json_encode($data);
			}
			else{
				$this->Raffle_model->add_winner($output,$prize);
			echo json_encode($data);

			}*/
		}
	}
}
