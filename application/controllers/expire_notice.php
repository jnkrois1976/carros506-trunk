<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed carajo');

	class Expire_notice extends CI_Controller {
		
		public function auto_email(){
			
			/*if($_SERVER['REMOTE_ADDR'] == "10.0.1.17"){*/
				
				$this->load->model('resultados_model');
				$get_son_to_expire = $this->resultados_model->get_son_to_expire();
				
				if($get_son_to_expire){
					if(site_url() == 'http://carros506.local/'){
						$mail_server = 'localhost';
					}elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
						$mail_server = 'relay-hosting.secureserver.net';
					}
					foreach($get_son_to_expire as $get_son_to_expire_row){
					
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
											Le estamos enviando este mensaje para recordarle que su anuncio publicado en Carros506.com, acerca de su '.$get_son_to_expire_row->ad_marca.' '.$get_son_to_expire_row->ad_modelo.' '.$get_son_to_expire_row->ad_year.', vencer&aacute; 
											en 7 dias a partir de la fecha de este correo.<br /><br />
											<img src="'.base_url().'cars/large_thumb/'.strtolower($get_son_to_expire_row->ad_fullid).'/'.strtolower($get_son_to_expire_row->ad_fullid).'_1.jpg" /><br /><br />
											En caso de que su carro no se haya vendido, usted puede renovar su anuncio por un mes mas si lo desea.<br /><br />
											Su anuncio NO ser&aacute; eliminado al vencerse, simplemente ser&aacute; desactivado hasta que usted decida reactivarlo en caso de ser necesario.
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
						$this->email->to($get_son_to_expire_row->ad_sellerEmail);
						//$this->email->to('jnkrois@gmail.com');
						$this->email->reply_to('noreply@carros506.com');
						$this->email->subject('Su anuncio en Carros506.com se vence en 7 dias.');
						$this->email->message($email_template);
						$send_message = $this->email->send();
					
					}
				}
			/*}else{
				die('Permission denied.');
			}*/
		}
	}
?>
