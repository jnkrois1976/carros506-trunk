<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed carajo');

	class Email_test extends CI_Controller {
		
		public function hourly_test_email(){
			
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
											<td>Auto emails are working properly</td>
										</tr>
									</table>
								</body>
							</html>
						';
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['smtp_host'] = 'relay-hosting.secureserver.net';
            $config['smtp_port'] = '25';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from('manager@carros506.com', 'Carros506.com');
            $this->email->to($get_son_to_expire_row->ad_sellerEmail);
            //$this->email->to('jnkrois@gmail.com');
            $this->email->reply_to('noreply@carros506.com');
            $this->email->subject('Auto emails are working properly');
            $this->email->message($email_template);
            $send_message = $this->email->send();
		}
	}
?>
