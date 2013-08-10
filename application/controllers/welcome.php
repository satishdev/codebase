<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(SEND_EMAIL){
				$this->load->library('email');
				$this->email->mailtype="html";
				/*$data['email']=$club_details->email;
				$data['password']=$club_details->password;
				$data['active_link']=$club_details->activation_code;
				$msg=$this->load->view('email/club_register_actlink',$data,TRUE);*/
				$msg='test test';
				$from='member@wesport.com';//'wesportonline@gmail.com';
				$subject='Your Club Registration on WESport';
				$to='shankaranand001@gmail.com';
				$this->email->from($from,'WeSport');
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($msg);
				$this->email->send();
				echo $this->email->print_debugger();
				$headers = 'From: member@wesport.com' . "\r\n" .
    'Reply-To: shankaranand001@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
				mail($to,$subject,$msg,$headers);
				}
		//$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */