<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password_reset extends CI_Controller {
	
	public function reset_pwd(){
		$current_email = $this->input->post("userEmail");
		$this->load->model("profile_model");
		$save_new_password = $this->profile_model->save_new_password();
		if(site_url() == 'http://carros506.local/'){
			$mail_server = 'localhost';
		}elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
			$mail_server = 'relay-hosting.secureserver.net';
		}
		if($save_new_password){
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
								Le estamos enviando este mensaje para notificarle que su contrase&ntilde;a ha sido restablecida satisfactoriamente.<br /><br />
								Si usted esta al tanto de este cambio, por favor ignore este mensaje, de lo contrario, por favor contacte al administrador del sitio.<br /><br />
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
			$this->email->to($current_email);
			//$this->email->to('jnkrois@gmail.com');
			$this->email->reply_to('noreply@carros506.com');
			$this->email->subject('Notificación de cambio de contraseña de su cuenta en Carros506.com');
			$this->email->message($email_template);
			$send_message = $this->email->send();
			redirect('/misc/new_password');
		}
	}
	
	public function validate_email(){
		$this->load->model('ajax_model');
		$validate_email = $this->ajax_model->validate_email();
		if($validate_email){
			echo "success";
		}else{
			echo "failed";
		}
	}
	
}
