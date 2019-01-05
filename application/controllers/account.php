<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
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
	
	public function create(){
		$this->load->model('account_model');
		$query = $this->account_model->create_member();
		if($query){
			
			$this->load->model('login_model');
			$querylogin = $this->login_model->validate();
			$sellerId = $querylogin['contact_prefix'].$querylogin['contact_id'];
			$username = $this->input->post('name');
			$userfirstname = explode(" ", $username);
			$formatted_first_name = mb_convert_case($userfirstname[0], MB_CASE_TITLE, "UTF-8");
			$data = array(
				'username' => $formatted_first_name,
				'accountcreated' => true,
				'member_id' => $sellerId,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			
			if(site_url() == 'http://carros506.local/'){
				$mail_server = 'localhost';
			}elseif(site_url() == 'http://carros506.com/'){
				$mail_server = 'relay-hosting.secureserver.net';
			}
			
			$new_member_email = $this->input->post('email');
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
									Su cuenta en Carros506.com ha sido creada. Sin embargo debe ser autenticada para poder crear anuncios.<br /><br />
									Por favor haga click <a href="'.base_url("misc/authenticate_account/".$sellerId).'">AQU&Iacute;</a> para autenticar su cuenta.<br /><br />
									O bien puede copiar y pegar el siguiente link en la barra de direcci&oacute;n de su navegador:<br />
									'.base_url("misc/authenticate_account/".$sellerId).'<br /><br />
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
			$this->email->to($new_member_email);
			//$this->email->to('jnkrois@gmail.com');
			$this->email->reply_to('noreply@carros506.com');
			$this->email->subject('Su cuenta en Carros506.com ha sido creada.');
			$this->email->message($email_template);
			$send_message = $this->email->send();
			redirect('profile/new_member');
			/*if($send_message){
				redirect('profile/new_member');
			}else{
				echo "something went wrong";
			}*/
		}
	}
}
