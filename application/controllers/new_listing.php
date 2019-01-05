<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);
class New_listing extends CI_Controller {
	
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
	
	
	// this whole function might not be necesary after the admin panel has been built
	public function listing_notification(){
		if(site_url() == 'http://carros506.local/'){
			$mail_server = 'localhost';
		}elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
			$mail_server = 'relay-hosting.secureserver.net';
		}
		$this->load->model('profile_model');
		$get_member_info = $this->profile_model->getcontact();
		$last_ad = $this->profile_model->last_ad();
		if($last_ad['ad_categoria'] == "A"){
			$ad_type = 'anuncio';
		}elseif($last_ad['ad_categoria'] == "B"){
			$ad_type = 'anuncio_medio';
		}elseif($last_ad['ad_categoria'] == "C"){
			$ad_type = 'anuncio_basico';	
		}
		$email_template = '
			<html>
				<head>
					<title>Su anuncio ha sido publicado en Carros506.com</title>
				</head>
				<body>
					<table cellpadding="1" cellspacing="2" border="0" width="600">
						<tr>
							<td><img src="http://carros506.com/images/carros506.jpg" alt="Carros506.com"></td>
						</tr>
						<tr>
							'.$get_member_info['contact_firstname'].', le enviamos este mensaje para informarle que el anuncio acerda de su '.$last_ad['ad_marca'].' '.$last_ad['ad_modelo'].' - '.$last_ad['ad_year'].', 
							ha sido publicado.<br />
							Para ver el anuncio nada mas haga click <a href="'.base_url().'resultados/'.$ad_type.'/'.$last_ad['ad_fullid'].'">AQUI</a><br />
							<a href="'.base_url().'resultados/'.$ad_type.'/'.$last_ad['ad_fullid'].'">
								<img class="" src="'.base_url().'cars/large_thumb/'.strtolower($last_ad['ad_fullid']).'/'.strtolower($last_ad['ad_fullid']).'_1.jpg" />
							</a><br /><br />
							Si desea modificar su anuncio, lo puede hacer en la seccion "Mis anuncios" de su perfil.<br /><br />
							Gracias.
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
		$this->email->subject('Su anuncio nuevo en carros506.com');
		$this->email->message($email_template);
		$send_message = $this->email->send();
	}
	
	public function single_upload(){
		$this->load->model('single_upload');
		if ($this->input->post('add_pic')) {
			$update_listing = $this->single_upload->update_listing();
			$do_upload = $this->single_upload->do_upload();
		}
		if($update_listing && $do_upload ){
			//$this->listing_update_notification();
			redirect($this->input->post('adUrl'));
		}
	}
	
	public function create_basic_post(){
		$this->load->model('new_basic_listing_model');
		if ($this->input->post('create_basic')) {
			$process_data = $this->new_basic_listing_model->create_listing();
			$upload_images = $this->new_basic_listing_model->do_upload();
		}
		if($process_data && $upload_images ){
			$this->listing_notification();
			redirect("/profile/posted_new_listing");
		}
	}

	public function create_basic_multiple_post(){
		$this->load->model('new_basic_listing_multiple_model');
		if ($this->input->post('create_basic')) {
			$process_data = $this->new_basic_listing_multiple_model->create_listing();
			$upload_images = $this->new_basic_listing_multiple_model->do_upload();
		}
		if($process_data && $upload_images ){
			$this->listing_notification();
			redirect("/profile/posted_new_listing");
		}
	}
	
	public function create_detailed_post(){
		$this->load->model('new_detailed_listing_model');
		if ($this->input->post('create_detailed')) {
			$process_data = $this->new_detailed_listing_model->create_listing();
			$upload_images = $this->new_detailed_listing_model->do_upload();
		}
		if($process_data && $upload_images ){
			$this->listing_notification();
			redirect("/profile/posted_new_listing");
		}
	}
	
	public function create_detailed_multiple_post(){
		$this->load->model('new_detailed_listing_multiple_model');
		if ($this->input->post('create_detailed')) {
			$process_data = $this->new_detailed_listing_multiple_model->create_listing();
			$upload_images = $this->new_detailed_listing_multiple_model->do_upload();
		}
		if($process_data && $upload_images ){
			$this->listing_notification();
			redirect("/profile/posted_new_listing");
		}
	}
	
	public function create_full_post(){
		$this->load->model('new_full_listing_model');
		if ($this->input->post('create_full')) {
			$process_data = $this->new_full_listing_model->create_listing();
			$upload_images = $this->new_full_listing_model->do_upload();
		}
		if($process_data && $upload_images ){
			$this->listing_notification();
			redirect("/profile/posted_new_listing");
		}
	}
	
	public function create_full_multiple_post(){
		$this->load->model('new_full_listing_multiple_model');
		if ($this->input->post('create_full')) {
			$process_data = $this->new_full_listing_multiple_model->create_listing();
			$upload_images = $this->new_full_listing_multiple_model->do_upload();
		}
		if($process_data && $upload_images ){
			$this->listing_notification();
			redirect("/profile/posted_new_listing");
		}
	}
	
	public function create_dealer_multiple_listing(){
		$this->load->model('create_dealer_multiple_listing');
		if($this->input->post("listings")){
			$process_multiple_lisiting = $this->create_dealer_multiple_listing->create_multiple_listing();
		}
		if($process_multiple_lisiting == TRUE){
			echo "success";
		}else{
			echo "failed";
		}
	}
}
