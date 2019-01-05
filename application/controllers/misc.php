<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Misc extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		//$this->browser();
		$this->totallisting();
	}
	
	//public function browser(){
	//	if($this->agent->is_browser('MSIE')){
	//		if(floor($this->agent->version()) < 9){
	//			redirect('/misc/browser_upgrade');
	//		}
	//	}
	//}
	
	public function totallisting(){
		$this->load->model('site_model');
		$allrows = $this->site_model->allrows();
		$data = array('total_ads' => $allrows);
		$this->session->set_userdata($data);
	}
	
	public function profile_locked(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('misc/content_profile_locked', array('allmakes' => $allmakes));
	}
	
	public function browser_upgrade(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('misc/browser_upgrade', array('allmakes' => $allmakes));
	}
	
	public function pwd_reset(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('misc/reset_password', array('allmakes' => $allmakes));
	}
	
	public function new_password(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('misc/new_password', array('allmakes' => $allmakes));
	}
	
	public function authenticate_account(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$authenticate;
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(isset($is_logged_in) || $is_logged_in == true){
			$this->load->model('profile_model');
			$authenticate = $this->profile_model->authenticate();
			$this->load->view('misc/authenticate', array('allmakes' => $allmakes, 'authenticate' => $authenticate));
		}else{
			$authenticate == FALSE;
			$this->load->view('misc/authenticate', array('allmakes' => $allmakes, 'authenticate' => $authenticate));
		}
	}
	
}

