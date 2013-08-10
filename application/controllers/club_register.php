<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Club_register extends CI_Controller {

    function __construct()
    {
        // Call the Parent constructor

        parent::__construct();
       	$this->load->model('users_model');
        $this->load->library('form_validation');
		
    }
    
    public function index()
    {

		$validation = array(
			array(
				'field' => 'name',
				'label' => 'Club Name',
				'rules' => 'trim|required',
			),	
			array(
				'field' => 'zip',
				'label' => 'Zip',
				'rules' => 'trim|required',
			),	
			array(
				'field' => 'web_site',
				'label' => 'Website',
				'rules' => 'trim|required',
			),	
			/*array(
				'field' => 'gender',
				'label' => 'Gender',
				'rules' => 'trim|required',
			),	*/			
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
			if ($this->form_validation->run())
			{
				$_POST['player_types_id']=3;
				 $_POST['password']=$this->encrypt->encode($this->input->post('password'));
				 $_POST['activation_code']=$this->users_model->activation_code_user();
				$player_id=$this->my_db_lib->save_record($this->input->post(),'players');
				$_POST['club_owner']=$player_id;
				$club_id=$this->my_db_lib->save_record($this->input->post(),'clubs');
				$club_details=$this->users_model->players_details($club_id);
				if(SEND_EMAIL){
				$this->load->library('email');
				$this->email->mailtype="html";
				$data['email']=$club_details->email;
				$data['password']=$club_details->password;
				$data['active_link']=$club_details->activation_code;
				$msg=$this->load->view('email/club_register_actlink',$data,TRUE);
				$from='noreply@wesport.com';//'wesportonline@gmail.com';
				$subject='Your Club Registration on WESport';
				$to=$club_details->email;
				$this->email->from($from,'WeSport');
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($msg);
				$this->email->send();
				}
				//$this->db_session->set_flashdata('msg', '<div class="success">Successfully registered and send the detials to your email address</div>');
				//redirect('login');
				 echo json_encode(array('status' => true, 'message' => 'Successfully registered and send the details to your email address'));
			}else{
				echo json_encode(array('status' => false, 'message' => validation_errors()));
			}
        }else{
			$view_data['active_tab'] = '0';
         	$view_data['links_js_css']='register/links_js_css';
            $view_data['content_page']='register/club_register';
            $this->load->view('common/base_template',$view_data);
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
    
}

?>
