<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Resultados extends CI_Controller {
	
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
	
	public function anuncios(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$allmodels = $this->site_model->allmodels();
		$minprice = $this->site_model->getminprice();
		$maxprice = $this->site_model->getmaxprice();
		$minyear = $this->site_model->getminyear();
		$this->load->model('resultados_model');
		$requestedposts = $this->resultados_model->getrequestedposts();
		$count_posts = $this->resultados_model->count_requested_posts();
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/";
		$config['total_rows'] = $count_posts;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		$this->load->view('results/content_resultados',
			array('allmakes' => $allmakes,
					'allmodels' => $allmodels,
					'minprice' => $minprice,
					'maxprice' => $maxprice,
					'minyear' => $minyear,
					'requestedposts' => $requestedposts
				)
			);
	}
	
	public function anuncio_premier(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$ad_fullid = $this->uri->segment(3, 0);
		if(!isset($_COOKIE[$ad_fullid])){
			setcookie($ad_fullid, "true", time()+3600);
			$update_visits = $this->resultados_model->update_visits_premier();
		}
		$posting = $this->resultados_model->get_premier_posting();
		$is_rated = $this->resultados_model->is_rated();
		$is_favorite = $this->resultados_model->is_favorite();
		$is_reported = $this->resultados_model->is_reported();
		$self_report_premier = $this->resultados_model->self_report_premier();
		$member_Id = $this->session->userdata('member_id');
		if(!isset($member_Id) || $member_Id == false){
			$this->load->view('results/content_anuncio_premier', array('allmakes' => $allmakes, 'posting' => $posting, 'is_rated' => $is_rated, 'is_favorite' => $is_favorite, 'is_reported' => $is_reported, 'self_report_premier' => $self_report_premier));
		}elseif(isset($member_Id)){
			$this->load->model('profile_model');
			$email_name = $this->profile_model->getcontact();
			$this->load->view('results/content_anuncio_premier', array('allmakes' => $allmakes, 'posting' => $posting, 'is_rated' => $is_rated, 'is_favorite' => $is_favorite, 'is_reported' => $is_reported, 'self_report_premier' => $self_report_premier, 'email_name' => $email_name));
		}
		
	}
		
	public function anuncio(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$ad_fullid = $this->uri->segment(3, 0);
		if(!isset($_COOKIE[$ad_fullid])){
			setcookie($ad_fullid, "true", time()+3600);
			$update_visits = $this->resultados_model->update_visits();
		}
		$posting = $this->resultados_model->getposting();
		$get_public_comments_amount = $this->resultados_model->get_public_comments_amount();
		$get_comments = $this->resultados_model->get_comments();
		$count_comments = $this->resultados_model->count_comments();
		$is_rated = $this->resultados_model->is_rated();
		$is_favorite = $this->resultados_model->is_favorite();
		$is_reported = $this->resultados_model->is_reported();
		$self_report = $this->resultados_model->self_report();
		$advertisement = $this->resultados_model->advertisement();
		$member_Id = $this->session->userdata('member_id');
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/".$this->uri->segment(3, 0)."/";
		$config['total_rows'] = $count_comments;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		if(!isset($member_Id) || $member_Id == false){
			$this->load->view('results/content_anuncio', array(
																'allmakes' => $allmakes, 
																'posting' => $posting, 
																'public_comments_amount' => $get_public_comments_amount,
																'get_comments' => $get_comments, 
																'count_comments' => $count_comments,
																'is_rated' => $is_rated, 
																'is_favorite' => $is_favorite, 
																'is_reported' => $is_reported, 
																'self_report' => $self_report,
																'advertisement' => $advertisement
																)
															);
		}elseif(isset($member_Id)){
			$this->load->model('profile_model');
			$email_name = $this->profile_model->getcontact();
			$this->load->view('results/content_anuncio', array(
																'allmakes' => $allmakes, 
																'posting' => $posting, 
																'public_comments_amount' => $get_public_comments_amount,
																'get_comments' => $get_comments, 
																'count_comments' => $count_comments,
																'is_rated' => $is_rated, 
																'is_favorite' => $is_favorite, 
																'is_reported' => $is_reported, 
																'self_report' => $self_report, 
																'email_name' => $email_name,
																'advertisement' => $advertisement
																)
															);
		}
		
	}
	
	public function anuncio_medio(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$ad_fullid = $this->uri->segment(3, 0);
		if(!isset($_COOKIE[$ad_fullid])){
			setcookie($ad_fullid, "true", time()+3600);
			$update_visits = $this->resultados_model->update_visits();
		}
		$posting = $this->resultados_model->getposting();
		$get_public_comments_amount = $this->resultados_model->get_public_comments_amount();
		$get_comments = $this->resultados_model->get_comments();
		$count_comments = $this->resultados_model->count_comments();
		$is_rated = $this->resultados_model->is_rated();
		$is_favorite = $this->resultados_model->is_favorite();
		$is_reported = $this->resultados_model->is_reported();
		$self_report = $this->resultados_model->self_report();
		$advertisement = $this->resultados_model->advertisement();
		$member_Id = $this->session->userdata('member_id');
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/".$this->uri->segment(3, 0)."/";
		$config['total_rows'] = $count_comments;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		if(!isset($member_Id) || $member_Id == false){
			$this->load->view('results/content_anuncio_medio', array('allmakes' => $allmakes, 'posting' => $posting, 'public_comments_amount' => $get_public_comments_amount, 'get_comments' => $get_comments, 'is_rated' => $is_rated, 'is_favorite' => $is_favorite, 'is_reported' => $is_reported, 'self_report' => $self_report, 'advertisement' => $advertisement));
		}elseif(isset($member_Id)){
			$this->load->model('profile_model');
			$email_name = $this->profile_model->getcontact();
			$this->load->view('results/content_anuncio_medio', array('allmakes' => $allmakes, 'posting' => $posting, 'public_comments_amount' => $get_public_comments_amount, 'get_comments' => $get_comments, 'is_rated' => $is_rated, 'is_favorite' => $is_favorite, 'is_reported' => $is_reported, 'self_report' => $self_report, 'email_name' => $email_name, 'advertisement' => $advertisement));
		}
		
	}

	public function anuncio_basico(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$ad_fullid = $this->uri->segment(3, 0);
		if(!isset($_COOKIE[$ad_fullid])){
			setcookie($ad_fullid, "true", time()+3600);
			$update_visits = $this->resultados_model->update_visits();
		}
		$posting = $this->resultados_model->getposting();
		$is_rated = $this->resultados_model->is_rated();
		$is_favorite = $this->resultados_model->is_favorite();
		$is_reported = $this->resultados_model->is_reported();
		$self_report = $this->resultados_model->self_report();
		$advertisement = $this->resultados_model->advertisement();
		$similar_posting = $this->resultados_model->get_similar_posting();
		$count_similar = $this->resultados_model->count_similar_posting();
		$member_Id = $this->session->userdata('member_id');
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/".$this->uri->segment(3, 0)."/";
		$config['total_rows'] = $count_similar;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		if(!isset($member_Id) || $member_Id == false){
			$this->load->view('results/content_anuncio_basico', array('allmakes' => $allmakes, 'posting' => $posting, 'is_rated' => $is_rated, 'is_favorite' => $is_favorite, 'is_reported' => $is_reported, 'self_report' => $self_report, 'similar_posting' => $similar_posting,  'advertisement' => $advertisement));
		}elseif(isset($member_Id)){
			$this->load->model('profile_model');
			$email_name = $this->profile_model->getcontact();
			$this->load->view('results/content_anuncio_basico', array('allmakes' => $allmakes, 'posting' => $posting, 'is_rated' => $is_rated, 'is_favorite' => $is_favorite, 'is_reported' => $is_reported, 'self_report' => $self_report, 'email_name' => $email_name, 'similar_posting' => $similar_posting, 'advertisement' => $advertisement));
		}
		
	}
	
	public function categorias(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$minprice = $this->site_model->getminprice();
		$maxprice = $this->site_model->getmaxprice();
		$minyear = $this->site_model->getminyear();
		$this->load->model('resultados_model');
		$postbycat = $this->resultados_model->postbycat();
		$send_to_landing = $this->uri->segment(3);
		if($send_to_landing){
			if($postbycat){
				$rowsbycat = $this->resultados_model->rowsbycat();
				$this->load->library('pagination');
				$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/".$this->uri->segment(3, 0)."/";
				$config['total_rows'] = $rowsbycat;
				$config['per_page'] = 10;
				$config['num_links'] = 20;
				$config['uri_segment'] = 4;
				$config['full_tag_open'] = '<div id="pagination" class="pagination">';
				$config['full_tag_close'] = '</div>';
				$config['prev_link'] = 'Anterior';
				$config['next_link'] = 'Siguiente';
				$this->pagination->initialize($config);
				$this->load->view('results/content_categories',
									array(
										  'allmakes' => $allmakes,
										  'minprice' => $minprice,
										  'maxprice' => $maxprice,
										  'minyear' => $minyear,
										  'postbycat' => $postbycat,
										  'rowsbycat' => $rowsbycat
										  )
									);
			}else{
				$this->load->view('results/content_categories',
									array(
										  'allmakes' => $allmakes,
										  'minprice' => $minprice,
										  'maxprice' => $maxprice,
										  'minyear' => $minyear,
										  'postbycat' => $postbycat
										  )
									);
			}
		}else{
			$this->load->view('results/content_cat_landing',
									array(
										  'allmakes' => $allmakes,
										  'minprice' => $minprice,
										  'maxprice' => $maxprice,
										  'minyear' => $minyear
										  )
									);
		}
	}

	public function vendedor(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$minprice = $this->site_model->getminprice();
		$maxprice = $this->site_model->getmaxprice();
		$minyear = $this->site_model->getminyear();
		$this->load->model('resultados_model');
		$post_by_seller = $this->resultados_model->post_by_seller();
		if($post_by_seller){
			$rows_by_seller = $this->resultados_model->rows_by_seller();
			$this->load->library('pagination');
			$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/".$this->uri->segment(3, 0)."/";
			$config['total_rows'] = $rows_by_seller;
			$config['per_page'] = 10;
			$config['num_links'] = 20;
			$config['uri_segment'] = 4;
			$config['full_tag_open'] = '<div id="pagination" class="pagination">';
			$config['full_tag_close'] = '</div>';
			$config['prev_link'] = 'Anterior';
			$config['next_link'] = 'Siguiente';
			$this->pagination->initialize($config);
			$this->load->view('results/content_vendedor',
								array(
									  'allmakes' => $allmakes,
									  'minprice' => $minprice,
									  'maxprice' => $maxprice,
									  'minyear' => $minyear,
									  'post_by_seller' => $post_by_seller,
									  'rows_by_seller' => $rows_by_seller
									  )
								);
		}else{
			$this->load->view('results/content_vendedor',
								array(
									  'allmakes' => $allmakes,
									  'minprice' => $minprice,
									  'maxprice' => $maxprice,
									  'minyear' => $minyear,
									  'post_by_seller' => $post_by_seller
									  )
								);
		}
	}

	public function agencia(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$minprice = $this->site_model->getminprice();
		$maxprice = $this->site_model->getmaxprice();
		$minyear = $this->site_model->getminyear();
		$this->load->model('resultados_model');
		$post_by_dealer = $this->resultados_model->post_by_dealer();
		if($post_by_dealer){
			$rows_by_dealer = $this->resultados_model->rows_by_dealer();
			$this->load->library('pagination');
			$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/".$this->uri->segment(3, 0)."/";
			$config['total_rows'] = $rows_by_dealer;
			$config['per_page'] = 10;
			$config['num_links'] = 20;
			$config['uri_segment'] = 4;
			$config['full_tag_open'] = '<div id="pagination" class="pagination">';
			$config['full_tag_close'] = '</div>';
			$config['prev_link'] = 'Anterior';
			$config['next_link'] = 'Siguiente';
			$this->pagination->initialize($config);
			$this->load->view('results/content_dealer',
								array(
									  'allmakes' => $allmakes,
									  'minprice' => $minprice,
									  'maxprice' => $maxprice,
									  'minyear' => $minyear,
									  'post_by_dealer' => $post_by_dealer,
									  'rows_by_dealer' => $rows_by_dealer
									  )
								);
		}else{
			$this->load->view('results/content_dealer',
								array(
									  'allmakes' => $allmakes,
									  'minprice' => $minprice,
									  'maxprice' => $maxprice,
									  'minyear' => $minyear,
									  'post_by_dealer' => $post_by_dealer
									  )
								);
		}
	}
	
	public function populares(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$get_populares = $this->resultados_model->get_populares();
		$this->load->view('results/content_populares', array('allmakes' => $allmakes, 'get_populares' => $get_populares));
	}
	
	public function destacados(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$get_destacados = $this->resultados_model->get_destacados();
		$this->load->view('results/content_destacados', array('allmakes' => $allmakes, 'get_destacados' => $get_destacados));
	}
	
	public function recientes(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$get_recientes = $this->resultados_model->get_recientes();
		$this->load->view('results/content_recientes', array('allmakes' => $allmakes, 'get_recientes' => $get_recientes));
	}
	
	public function aduanas(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$get_aduanas = $this->resultados_model->get_aduanas();
		$this->load->view('results/content_aduanas', array('allmakes' => $allmakes, 'get_aduanas' => $get_aduanas));
	}
	
	public function subasta(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('results/content_subasta', array('allmakes' => $allmakes));
	}
}