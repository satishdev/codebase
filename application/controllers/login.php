<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        // Call the Parent constructor
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {
        if ($this->db_session->userdata('user_object') != '') {
            $user_obj = @unserialize($this->db_session->userdata('user_object'));

            $userType = $user_obj->getusertype();
            if ($userType == 1) {
                redirect('cp');
            } else if ($userType == 2) {
                redirect('players');
            } else if ($userType == 3) {
                redirect('clubs');
            }
        }
        $data = '';
        (object)$login = '';
        if ($this->input->post('uname')) {
            $username = $this->input->post('uname');
            $password = $this->input->post('psw');
            $remember_me = $this->input->post('remember_me');

            $login->username = $username;
            $login->password = $password;
            $login->remember_me = ($remember_me != '') ? 'on': 'off';

            /*$login->password=$this->encrypt->encode($login->password);
            $data=array('email'=>$login->username,'password'=>$login->password);
            $this->db->where('id','17');
            $this->db->update('players', $data);
            exit;*/
            $data_VloginObject = $this->login_model->SetIvieLoginParameters($login);
            $LoginObject = $this->login_model->login_auth($data_VloginObject);
            if ($LoginObject) {
                $LoginSessionObject = $this->login_model->setLoginSession($LoginObject);
                $this->db_session->set_userdata('user_object', serialize($LoginSessionObject));
                //$this->db_session->set_userdata(array('user_object' => serialize($LoginSessionObject), 'remember' => $login->remember_me));
                $user_obj = @unserialize($this->db_session->userdata('user_object'));
                $user_obj = $LoginSessionObject;

                //print_r($user_obj); exit;
                $userType = $user_obj->getusertype();
                if ($userType == 1) {
                    redirect('cp');
                } else if ($userType == 2) {
                    redirect('players');
                } else if ($userType == 3) {
                    redirect('clubs');
                }
            } else {
                $this->db_session->set_flashdata('msg', '<div class="error">Please check your details.</div>');
                redirect('login');
                //$data['content_page'] =  'login_new';
                // $this->load->view('common/base_template_plain', $data);
            }
        } else {
            $data['my_select'] = 'signin';
            $data['active_tab'] = '0';
            $data['links_js_css'] = 'register/links_js_css';
            $data['content_page'] = 'login_new';
            $this->load->view('common/base_template_plain', $data);
        }
    }

    function forgot()
    {
        (object)$login = '';

        if (isset($_POST['uname'])) {
            $login->username = $this->input->post('uname');
            $LoginObject = $this->login_model->forgot_password($login);

            if ($LoginObject) {
                if (SEND_EMAIL) {
                    $this->load->library('email');
                    $this->email->mailtype = "html";
                    $data['email'] = $LoginObject->email;
                    $data['password'] = $LoginObject->password;
                    $msg = $this->load->view('email/forgot', $data, TRUE);
                    $from = 'noreply@wesport.com'; //'wesportonline@gmail.com';
                    $subject = 'Your password on WESport';
                    $to = $LoginObject->email;
                    $this->email->from($from, 'WeSport');
                    $this->email->to($to);

                    $this->email->subject($subject);
                    $this->email->message($msg);
                    $this->email->send();

                    echo $this->email->print_debugger();
                }
               /* $this->db_session->set_flashdata('msg', '<div class="success">Your Password is sent to your Email.</div>');
                redirect('login');*/
            } else {
                $this->db_session->set_flashdata('msg', '<div class="error">Please check your details.</div>');
                redirect('login');
            }
        } else {
            $this->db_session->set_flashdata('msg', '<div class="error">Please check your details.</div>');
            redirect('login');
        }
    }

    function logout()
    {
        $this->db_session->sess_destroy();
        delete_cookie("remember_me_token");
        redirect('login');
    }
}

?>
