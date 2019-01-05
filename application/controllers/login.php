<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Login extends CI_Controller {
		public function validate(){
			$this->load->model('login_model');
			$query = $this->login_model->validate();
			if($query){
				$sellerId = $query['contact_prefix'].$query['contact_id'];
				$data = array(
					'username' => $this->input->post('username'),
					'member_name' => $query['contact_firstname'],
					'member_id' => $sellerId,
					'is_logged_in' => true
				);
				$this->session->set_userdata($data);
				$member_name = $this->session->userdata('member_name');
				if($member_name){
					$this->load->view('/includes/member_links');
				}else{
					$this->load->view('/includes/member_links');
				}
			}else{
				return false;
			}
		}
	}
?>
