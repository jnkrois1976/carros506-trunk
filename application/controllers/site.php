<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Site extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->browser();
		$this->totallisting();
	}
	
	public function browser(){
		if($this->agent->is_browser('MSIE')){
			if(floor($this->agent->version()) < 9){
				redirect('/misc/browser_upgrade');
			}
		}
	}
	
	public function totallisting(){
		$this->load->model('site_model');
		$allrows = $this->site_model->allrows();
		$data = array('total_ads' => $allrows);
		$this->session->set_userdata($data);
	}
	
	public function index(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$minprice = $this->site_model->getminprice();
		$maxprice = $this->site_model->getmaxprice();
		$minyear = $this->site_model->getminyear();
		$get_premier = $this->site_model->get_premier();
		$getpopular = $this->site_model->getpopular();
		$getfeatured = $this->site_model->getfeatured();
		$getrecent = $this->site_model->getrecent();
		$this->load->view('content_index',
			array(
				'allmakes' => $allmakes,
				'minprice' => $minprice,
				'maxprice' => $maxprice,
				'minyear' => $minyear,
				'get_premier' => $get_premier,
				'getpopular' => $getpopular,
				'getfeatured' => $getfeatured,
				'getrecent' => $getrecent
			)
		);
		//$this->load->view('misc/welcome'); // apply the welcome page to the site
	}
	
	public function agencias(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('content_agencias', array('allmakes' => $allmakes));
	}
	
	public function anunciese(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('content_anuncios', array('allmakes' => $allmakes));
	}
	
	public function publicidad(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('content_publicidad', array('allmakes' => $allmakes));
	}
}