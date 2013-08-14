<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller
{

    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        //var_dump(checkRemember()); exit;
        checkRemember();
        if ($this->db_session->userdata('user_object') != '') {
            //echo $this->db_session->userdata('user_object');
            redirect('players');
        }

        $this->load->model('users_model');
        $this->load->library('form_validation');
        $this->session->set_userdata('c_id', 'USA');
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
                'field' => 'dob',
                'label' => 'Date of Bith',
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


        if ($_POST) {
            if ($this->form_validation->run()) {
                $_POST['player_types_id'] = 2;
                $_POST['password'] = $this->encrypt->encode($this->input->post('password'));
                //$_POST['activation_code']=$this->users_model->activation_code_user();
                $_POST['status'] = '1';
                $player_id = $this->my_db_lib->save_record($this->input->post(), 'players');
                $player_details = $this->users_model->players_details($player_id);
                if (SEND_EMAIL) {
                    $this->load->library('email');
                    $this->email->mailtype = "html";
                    $data['id'] = $player_details->id;
                    $data['email'] = $player_details->email;
                    $data['password'] = $player_details->password;
                    $data['activation_code'] = $player_details->activation_code;
                    $msg = $this->load->view('email/player_activate_link', $data, TRUE);
                    $from = 'noreply@wesport.com'; //'wesportonline@gmail.com';
                    $subject = 'Your Registration on WESport';
                    $to = $player_details->email;
                    $this->email->from($from, 'WESport');
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($msg);
                    $this->email->send();
                }
                // $this->db_session->set_flashdata('msg', '<div class="success">Successfully registered and send the details to your email address</div>');

                //start my_code
                $this->db_session->set_flashdata('msg', '<div class="success">Successfully registered and send the details to your email address</div>');
                $this->session->set_userdata('msg', '<div class="success">Successfully registered and send the details to your email address</div>');
                //redirect('login');
                //end my_code
                $view_data['my_select'] = 'home';
                $view_data['active_tab'] = '0';
                $view_data['links_js_css'] = 'register/links_js_css';
                $view_data['content_page'] = 'register/signup';
                $view_data['header_login'] = true;
                $this->load->view('common/base_template', $view_data);


                // echo json_encode(array('status' => true, 'message' => 'Successfully registered and send the details to your email address'));
            } else {
                // Return the validation error
                //$data = $this->form_validation->error_string();
                //echo json_encode(array('status' => false, 'message' => validation_errors()));
                //start my_code
                /*$view_data['active_tab'] = '0';
                $view_data['links_js_css']='register/links_js_css';
                $view_data['content_page']='register/player_register_slider';
                $view_data['header_login']=true;
                $this->load->view('common/base_template',$view_data);*/
                //end my_code
                $view_data['my_select'] = 'home';
                $view_data['active_tab'] = '0';
                $view_data['links_js_css'] = 'register/links_js_css';
                $view_data['content_page'] = 'register/signup';
                $view_data['header_login'] = true;
                $this->load->view('common/base_template', $view_data);
            }
        } else {
            $view_data['my_select'] = 'home';
            $view_data['active_tab'] = '0';
            $view_data['links_js_css'] = 'register/links_js_css';
            $view_data['content_page'] = 'register/signup';
            $view_data['header_login'] = true;
            $this->load->view('common/base_template', $view_data);
        }
    }

    
}

?>
