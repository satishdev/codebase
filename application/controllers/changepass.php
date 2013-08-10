<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class changepass extends MY_Controller {

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model('admin_model');
		$this->load->model('users_model');
		session_check();
    }

   
	function change_password(){
        if($this->input->post()){
			$_POST['password']=$this->encrypt->encode($_POST['password']);
            $post=$this->input->post();
			$post['id']=$this->userId;
            if($this->users_model->validate_user($post)){
                $this->my_db_lib->save_record($post,'players');
				$player_details=$this->users_model->players_details($this->userId);
					if(SEND_EMAIL){
                    $this->load->library('email');
                    $this->email->mailtype="html";
					$data['id']=$player_details->id;
                    $data['email']=$player_details->email;
                    $data['password']=$player_details->password;
                    $msg=$this->load->view('email/change_password',$data,TRUE);
                    $from='noreply@wesport.com';//'wesportonline@gmail.com';
                    $subject='Your password on WESport has been changed';
                    $to=$player_details->email;
                    $this->email->from($from,'WESport');
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($msg);
                    $this->email->send();
					}
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
    }

}

?>
