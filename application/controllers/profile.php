<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

class Profile extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->browser();
		$this->totallisting();
		$this->is_logged_in();
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
	
	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true){
			redirect('/misc/profile_locked');
		}
	}
	
	function my_ads_only(){
		$this->load->model('profile_model');
		$validate_ads = $this->profile_model->validate_ads();
		if($validate_ads == false){
			redirect('/profile/member');
		}
	}
	
	public function dashboard(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$count_comments = $this->profile_model->count_comments();
		$count_messages = $this->profile_model->count_messages();
		$active_ads_per_member = $this->profile_model->active_ads_per_member();
		$expired_ads_per_member = $this->profile_model->expired_ads_per_member();
		$ads_per_member = $this->profile_model->ads_per_member();
		$get_total_favorites = $this->profile_model->get_total_favorites();
		$get_total_reported = $this->profile_model->get_total_reported();
		$getcontact = $this->profile_model->getcontact();
		$this->load->view('profile/content_profile_dashboard', array(
							'allmakes' => $allmakes,
							'count_comments' => $count_comments,
							'count_messages' => $count_messages,
							'ads_per_member' => $ads_per_member,
							'active_ads_per_member' => $active_ads_per_member,
							'expired_ads_per_member' => $expired_ads_per_member,
							'get_total_favorites' => $get_total_favorites,
							'get_total_reported' => $get_total_reported,
							'getcontact' => $getcontact
							)
						);
	}

	public function myads(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$ads_query = $this->profile_model->getads();
		$active_ads_per_member = $this->profile_model->active_ads_per_member();
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/";
		$config['total_rows'] = $active_ads_per_member;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		$this->load->view('profile/content_profile_myads', array(
							'allmakes' => $allmakes,
							'ads_query' => $ads_query,
							'active_ads_per_member' => $active_ads_per_member
							)
						);
	}
	
	public function expired(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$expired_ads_query = $this->profile_model->expired_ads_query();
		$expired_ads_per_member = $this->profile_model->expired_ads_per_member();
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/";
		$config['total_rows'] = $expired_ads_per_member;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		$this->load->view('profile/content_profile_expired', array(
							'allmakes' => $allmakes,
							'expired_ads_query' => $expired_ads_query,
							'expired_ads_per_member' => $expired_ads_per_member
							)
						);
	}
	
	public function reported(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$reported_ads_query = $this->profile_model->reported_ads_query();
		$get_total_reported = $this->profile_model->get_total_reported();
		$get_all_reports = $this->profile_model->get_all_reports();
		$count_new_reports = $this->profile_model->count_new_reports();
		$count_admin_verified = $this->profile_model->count_admin_verified();
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/";
		$config['total_rows'] = $get_total_reported;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		$this->load->view('profile/content_profile_reported', array(
							'allmakes' => $allmakes,
							'reported_ads_query' => $reported_ads_query,
							'get_total_reported' => $get_total_reported,
							'get_all_reports' => $get_all_reports,
							'count_new_reports' => $count_new_reports,
							'count_admin_verified' => $count_admin_verified
							)
						);
	}
	
	public function member(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$ads_query = $this->profile_model->getads();
		$contact_query = $this->profile_model->getcontact();
		$ads_per_member = $this->profile_model->ads_per_member();
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/";
		$config['total_rows'] = $ads_per_member;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		$this->load->view('profile/content_profile', array(
							'allmakes' => $allmakes,
							'ads_query' => $ads_query,
							'contact_query' => $contact_query,
							'ads_per_member' => $ads_per_member
							)
						);
	}

	public function favorites(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$find_favorites = $this->profile_model->find_favorites();
		$this->load->model('resultados_model');
		$advertisement = $this->resultados_model->advertisement();
		if($find_favorites){
			$get_favorites = $this->profile_model->get_favorites();
			$get_favorites_premier = $this->profile_model->get_favorites_premier();
			$get_total_favorites = $this->profile_model->get_total_favorites();
		}else{
			$get_favorites = FALSE;
			$get_favorites_premier = FALSE;
			$get_total_favorites = 0;
		}
		
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/";
		$config['total_rows'] = $get_total_favorites;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		$this->load->view('profile/content_profile_favorites', array(
							'allmakes' => $allmakes,
							'get_favorites' => $get_favorites,
							'get_favorites_premier' => $get_favorites_premier,
							'get_total_favorites' => $get_total_favorites,
							'advertisement' => $advertisement
							)
						);
	}

	public function mymessages(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$get_post_messages = $this->profile_model->get_post_messages();
		$count_with_messages = $this->profile_model->count_with_messages();
		$all_posts_comments = $this->profile_model->all_posts_comments();
		$all_posts_messages = $this->profile_model->all_posts_messages();
		$count_new_comments = $this->profile_model->count_new_comments();
		$count_private_comments = $this->profile_model->count_private_comments();
		$count_unanswered_comments = $this->profile_model->count_unanswered_comments();
		$count_new_messages = $this->profile_model->count_new_messages();
		$count_unanswered_messages = $this->profile_model->count_unanswered_messages();
		$this->load->library('pagination');
		$config['base_url'] = base_url()."/".$this->uri->segment(1, 0)."/".$this->uri->segment(2, 0)."/";
		$config['total_rows'] = $count_with_messages;
		$config['per_page'] = 10;
		$config['num_links'] = 20;
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<div id="pagination" class="pagination">';
		$config['full_tag_close'] = '</div>';
		$config['prev_link'] = 'Anterior';
		$config['next_link'] = 'Siguiente';
		$this->pagination->initialize($config);
		$this->load->view('profile/content_profile_mymessages', array(
							'allmakes' => $allmakes,
							'get_post_messages' => $get_post_messages,
							'all_posts_comments' => $all_posts_comments,
							'all_posts_messages' => $all_posts_messages,
							'count_new_comments' => $count_new_comments,
							'count_private_comments' => $count_private_comments,
							'count_unanswered_comments' => $count_unanswered_comments,
							'count_new_messages' => $count_new_messages,
							'count_unanswered_messages' => $count_unanswered_messages
							)
						);
	}
	
	public function new_member(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->view('/profile/content_profile_new_member', array('allmakes' => $allmakes));
	}
	
	public function choose_ad(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$is_account_auth = $this->profile_model->is_account_auth();
		if($is_account_auth['auth'] == "1"){
			if($is_account_auth['cat'] == ""){
				$this->load->view('profile/content_profile_choose_seller', array('allmakes' => $allmakes));
			}elseif($is_account_auth['cat'] == "PR"){
				$this->load->view('profile/content_profile_choose_ad', array('allmakes' => $allmakes));
			}elseif($is_account_auth['cat'] == "AG"){
				$this->load->view('profile/content_profile_choose_ad_dealer', array('allmakes' => $allmakes));
			}
		}elseif($is_account_auth['auth'] == "0"){
			$this->load->view('misc/not_authenticated', array('allmakes' => $allmakes));
		}
		
	}
	
	public function new_basic_ad(){
		$referral = $this->agent->is_referral();
		$referrer = $this->agent->referrer();
		$origin_page = base_url()."profile/choose_ad";
		if ($referral && $referrer == $origin_page){
			$this->load->model('site_model');
			$allmakes = $this->site_model->allmakes();
			$this->load->model('profile_model');
			$contact_query = $this->profile_model->getcontact();
			$this->load->view('profile/content_profile_new_basic_ad', array('allmakes' => $allmakes, 'contact_query' => $contact_query));
		}else{
			redirect('/profile/choose_ad');
		}
	}
	
	public function new_detailed_ad(){
		$referral = $this->agent->is_referral();
		$referrer = $this->agent->referrer();
		$origin_page = base_url()."profile/choose_ad";
		//if ($referral && $referrer == $origin_page){
			$this->load->model('site_model');
			$allmakes = $this->site_model->allmakes();
			$this->load->model('profile_model');
			$contact_query = $this->profile_model->getcontact();
			$this->load->view('profile/content_profile_new_detailed_ad', array('allmakes' => $allmakes, 'contact_query' => $contact_query));
		//}else{
			//redirect('/profile/choose_ad');
		//}
	}
	
	public function new_full_ad(){
		$referral = $this->agent->is_referral();
		$referrer = $this->agent->referrer();
		$origin_page = base_url()."profile/choose_ad";
		if ($referral && $referrer == $origin_page){
			$this->load->model('site_model');
			$allmakes = $this->site_model->allmakes();
			$this->load->model('profile_model');
			$contact_query = $this->profile_model->getcontact();
			$this->load->view('profile/content_profile_new_full_ad', array('allmakes' => $allmakes, 'contact_query' => $contact_query));
		}else{
			redirect('/profile/choose_ad');
		}
	}
	
	public function new_multiple_ad(){
		$referral = $this->agent->is_referral();
		$referrer = $this->agent->referrer();
		$origin_page = base_url()."profile/choose_ad";
		if ($referral && $referrer == $origin_page){
			$this->load->model('site_model');
			$allmakes = $this->site_model->allmakes();
			$this->load->model('profile_model');
			$contact_query = $this->profile_model->getcontact();
			if($contact_query['profile_complete'] == '0'){
				redirect('/profile/member');
			}elseif($contact_query['profile_complete'] == '1'){
				$table_headers = $this->profile_model->get_table_headers();
				$this->load->view('profile/content_profile_new_multiple_ad', array('allmakes' => $allmakes, 'contact_query' => $contact_query, 'table_headers' => $table_headers));
			}
		}else{
			redirect('/profile/choose_ad');
		}
	}
	
	public function posted_new_listing(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$last_ad = $this->profile_model->last_ad();
		$this->load->view('/profile/content_profile_posted_listing', array('allmakes' => $allmakes, 'last_ad' => $last_ad));
	}
	
	public function content_posted_multiple_listing(){
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('profile_model');
		$last_multiple_posting = $this->profile_model->last_multiple_posting();
		$this->load->view('/profile/content_profile_posted_multiple_listing', array('allmakes' => $allmakes, 'last_multiple_posting' => $last_multiple_posting));
	}
	
	public function ad_details(){
		$this->my_ads_only();
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$posting = $this->resultados_model->getposting();
		$this->load->model('profile_model');
		$this->load->view('/profile/content_profile_ad', array(
							'allmakes' => $allmakes,
							'posting' => $posting
							)
						);
	}
	
	public function ad_expired_details(){
		$this->my_ads_only();
		$this->load->model('site_model');
		$allmakes = $this->site_model->allmakes();
		$this->load->model('resultados_model');
		$posting = $this->resultados_model->get_expired_posting();
		$this->load->model('profile_model');
		$this->load->view('/profile/content_profile_expired_ad', array(
							'allmakes' => $allmakes,
							'posting' => $posting
							)
						);
	}
	
	function auth_instructions(){
		//$logged_member = $this->session->userdata('member_id');
		$this->load->model('profile_model');
		$get_member_info = $this->profile_model->getcontact();
		if(site_url() == 'http://carros506.local/'){
			$mail_server = 'localhost';
		}elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
			$mail_server = 'relay-hosting.secureserver.net';
		}
		$email_template = '
			<html>
				<head>
					<title>Mensaje de Carros506.com</title>
				</head>
				<body>
					<table cellpadding="1" cellspacing="2" border="0" width="600">
						<tr>
							<td><img src="http://carros506.com/images/carros506.jpg" alt="Carros506.com"></td>
						</tr>
						<tr>
							<td>
								Su cuenta en Carros506.com ya esta activa. Sin embargo debe ser autenticada para poder crear anuncios.<br /><br />
								Por favor haga click <a href="'.base_url("misc/authenticate_account/".$get_member_info['contact_fullid']).'">AQU&Iacute;</a> para autenticar su cuenta.<br /><br />
								O bien puede copiar y pegar el siguiente link en la barra de direcci&oacute;n de su navegador:<br />
								'.base_url("misc/authenticate_account/".$get_member_info['contact_fullid']).'<br /><br />
								Una vez que haya autenticado su cuenta, podr&aacute; crear anuncios sin restricciones.<br /><br />
								Gracias.
							</td>
						</tr>
					</table>
				</body>
			</html>
		';
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['smtp_host'] = $mail_server;
		$config['smtp_port'] = '25';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('manager@carros506.com', 'Carros506.com');
		$this->email->to($get_member_info['contact_email']);
		//$this->email->to('jnkrois@gmail.com');
		$this->email->reply_to('noreply@carros506.com');
		$this->email->subject('Instrucciones para autenticar su cuenta en Carros506.com.');
		$this->email->message($email_template);
		$send_message = $this->email->send();
		if($send_message){
			$this->load->model('site_model');
			$allmakes = $this->site_model->allmakes();
			$this->load->view('/misc/sent_instructions', array('allmakes' => $allmakes));
		}
	}

	public function seller_type_dealer(){
		$this->load->model('profile_model');
		$set_seller_dealer = $this->profile_model->set_seller_dealer();
		if($set_seller_dealer){
			redirect('/profile/choose_ad');
		}
	}
	
	public function seller_type_private(){
		$this->load->model('profile_model');
		$set_seller_private = $this->profile_model->set_seller_private();
		if($set_seller_private){
			redirect('/profile/choose_ad');
		}
	}
	
	function log_out(){
		$this->session->sess_destroy();
		redirect('/site/index');
	}
}

