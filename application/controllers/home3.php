<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
		 if($this->db_session->userdata('user_object')!=''){
		    redirect('players');
		}
        $this->load->model('users_model');
		$this->load->library('form_validation');
		
    }
    
    public function index()
    {
			// Validation rules matches[passconf]
		$validation = array(
			/*array(
				'field' => 'user_name',
				'label' => lang('user_username'),
				'rules' => 'required|alpha_dot_dash|min_length[3]|max_length[20]|callback__username_check',
			),*/				
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|min_length[6]|max_length[20]|matches[cp_password]'
			),
			array(
				'field' => 'cp_password',
				'label' => 'Confirm Password',
				'rules' => 'required|min_length[6]|max_length[20]'
			),
			array(
				'field' => 'first_name',
				'label' => 'First Name',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'last_name',
				'label' => 'Last Name',
				'rules' => 'trim|required',
			),
			
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|max_length[60]|valid_email|callback__email_check',
			),
			array(
				'field' => 'country_id',
				'label' => 'Country',
				'rules' => 'trim|required',
			)
		);
			// Set the validation rules
			$this->form_validation->set_rules($validation);
		   if ($_POST)
			{

               //print_r($_POST);exit;
			if ($this->form_validation->run())
			{
                    $_POST['player_types_id']=2;
					 $_POST['password']=$this->encrypt->encode($this->input->post('password'));
					 $_POST['activation_code']=$this->users_model->activation_code_user();
					 $_POST['status']='0';
                    $player_id=$this->my_db_lib->save_record($this->input->post(),'players');
                    $player_details=$this->users_model->players_details($player_id);
					if(SEND_EMAIL){
                    $this->load->library('email');
                    $this->email->mailtype="html";
					$data['id']=$player_details->id;
                    $data['email']=$player_details->email;
                    $data['password']=$player_details->password;
                    $msg=$this->load->view('email/player_activate_link',$data,TRUE);
                    $from='noreply@wesport.com';//'wesportonline@gmail.com';
                    $subject='Your Registration on WESport';
                    $to=$player_details->email;
                    $this->email->from($from,'WESport');
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($msg);
                    $this->email->send();
					}
                   // $this->db_session->set_flashdata('msg', '<div class="success">Successfully registered and send the details to your email address</div>');
                   echo json_encode(array('status' => true, 'message' => 'Successfully registered and send the details to your email address'));
                }else{
                  
				// Return the validation error
				//$data = $this->form_validation->error_string();
				echo json_encode(array('status' => false, 'message' => validation_errors()));
			
        	}
		}else{
			$view_data['active_tab'] = '0';
			$view_data['links_js_css']='register/links_js_css';
            $view_data['content_page']='register/player_register_slider';
			$view_data['header_login']=true;
            $this->load->view('common/base_template',$view_data);
        }
    }
	
	
	
	
	
	
	
	
	public function index2()

    {

        $this->load->helper(array('form','url'));

        if($this->input->post('submit') && $this->formValidator()){
		

                if($this->users_model->validate_player_email($this->input->post())==0){

                    $_POST['player_types_id']=2;

                    $player_id=$this->my_db_lib->save_record($this->input->post(),'players');

                    $player_details=$this->users_model->players_details($player_id);

                    $this->load->library('email');

                    $this->email->mailtype="html";

                    $data['email']=$player_details->email;

                    $data['password']=$player_details->password;

                    $msg=$this->load->view('email/player_register',$data,TRUE);

                    $from='wesportonline@gmail.com';

                    $subject='Player Register';

                    $to=$player_details->email;

                    $this->email->from($from,'WeSport');

                    $this->email->to($to);

                    $this->email->subject($subject);

                    $this->email->message($msg);

                    $this->email->send();

                    $this->db_session->set_flashdata('msg', '<div class="success">Successfully registered and send the details to your email address</div>');

                    redirect('login');

                }else{
				

                    redirect('home/index2');

                }

        }else{

            
			
			$view_data['active_tab'] = '0';

			$view_data['links_js_css']='register/links_js_css';

            $view_data['content_page']='register/login_registration';

			$view_data['header_login']=true;

            $this->load->view('template',$view_data);

        }
		

    }
	
	
	
	
	
	
	
	
	
	
/**
	 * Email check
	 *
	 * @param string $email The email to check.
	 *
	 * @return bool
	 */
	public function _email_check($email)
	{
		if ($this->users_model->get_user_by_email_num($email))
		{
			$this->form_validation->set_message('_email_check', 'User email is already used');
			return false;
		}

		return true;
	}

   public function activate($id = 0, $code = NULL)
	{
		$code = ($this->input->post('activation_code')) ? $this->input->post('activation_code') : $code;

		// If user has supplied both bits of information
		if ($id AND $code)
		{
			// Try to activate this user
			if ($this->users_model->activate($id, $code))
			{
				$player_details=$this->users_model->players_details($id);
					if(SEND_EMAIL){
                    $this->load->library('email');
                    $this->email->mailtype="html";
					$data['id']=$player_details->id;
                    $data['email']=$player_details->email;
                    $data['password']=$player_details->password;
                    $msg=$this->load->view('email/player_register',$data,TRUE);
                    $from='noreply@wesport.com';//'wesportonline@gmail.com';
                    $subject='Your account on WESport is activated';
                    $to=$player_details->email;
                    $this->email->from($from,'WESport');
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($msg);
                    $this->email->send();
					}
				$this->db_session->set_flashdata('activated_email', 'success');
				redirect('home');
			}
			else
			{
				echo 'error';
			}
		}

	
	} 
	
	
	
	
	 
	 
	 public function formValidator() {



        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');



        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

        $this->form_validation->set_rules('country_id', 'Country', 'trim|required');

        //$this->form_validation->set_rules('dob', 'Birthday', 'trim|required');

        $this->form_validation->set_rules('cp_password', 'Confirm Password', 'trim|required|matches[password]|');



        if ($this->form_validation->run() == FALSE)

        {

            return false;

        }

        else

        {

            return true;

        }



    }
	
	
	
	
	
}

?>
