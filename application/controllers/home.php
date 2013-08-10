<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
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
                $view_data['content_page'] = 'register/player_register_slider';
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
                $view_data['content_page'] = 'register/player_register_slider';
                $view_data['header_login'] = true;
                $this->load->view('common/base_template', $view_data);
            }
        } else {
            $view_data['my_select'] = 'home';
            $view_data['active_tab'] = '0';
            $view_data['links_js_css'] = 'register/links_js_css';
            $view_data['content_page'] = 'register/player_register_slider';
            $view_data['header_login'] = true;
            $this->load->view('common/base_template', $view_data);
        }
    }

    function country_select($country_id)
    {
        $this->session->set_userdata('country_id', $country_id);
        if ($country_id == 'USA') {
            $state_id = 'AZ';
            $area_id = 'Phoenix Northeast';
        }
        if ($country_id == 'CA') {
            $state_id = 'AB';
            $area_id = 'Alberta';
        }
        if ($country_id == 'CAR') {
            $state_id = 'BS';
            $area_id = 'Carribean';
        }
        if ($country_id == 'EUR') {
            $state_id = 'EN';
            $area_id = 'Berkshire';
        }
        if ($country_id == 'MX') {
            $state_id = 'BC';
            $area_id = 'AZ';
        }
        if ($country_id == 'NAF') {
            $state_id = 'MA';
            $area_id = 'Marakech';
        }

        if ($country_id == 'PR') {
            $state_id = 'Dorado';
            $area_id = 'Puerto Rico';
        }

        if ($country_id == 'SAF') {
            $state_id = 'ZA';
            $area_id = 'Western Cape';
        }
        $this->session->set_userdata('area_id', $area_id);
        $this->session->set_userdata('state_id', $state_id);
        redirect('home');
    }

    function golfcourses_name_auto_complete()
    {
        $search_me 			= $this->input->post('search_me');
		$hid_country_id		= $this->input->post('hid_country_id');
		$hid_state_id		= $this->input->post('hid_state_id');
		
	#	echo '<script>console.log("'.$hid_state_id.'")</script>';
        $country_id = $this->session->userdata('country_id');
        $f_date = date('Y-m-d', time());
        $times = '600';
        $players = '1';
        $country_id = $this->session->userdata('country_id');
        $state_id = $this->session->userdata('state_id');
        $area_id = $this->session->userdata('area_id');

        $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
        $response = $client->CourseAvailList(array("Hdr" => array("ResellerId" => "WPA",
            "PartnerId" => "",
            "SourceCd" => "A",
            "Lang" => "en",
            "UserIp" => "66.147.244.227",
            "UserSessionId" => "",
            "AccessKey" => "",
            "Agent" => "",
            "gsSource" => "",
            "gsDebug" => true),
            "Req" => array("CountryId" => $hid_country_id,
                "RegionId" => $hid_state_id,
                "Area" => '',
                "PlayBegDate" => $f_date . "T00:00:00",
                "PlayEndDate" => $f_date . "T00:00:00",
                "Time" => $times,
                "Players" => $players,
                "MaxDistance" => "",
                "FeaturedOnly" => false,
                "ShowAllTimes" => true,
                "ShowIfNoTimes" => true,
                "BarterOnly" => false,
                "ChargingOnly" => false,
                "SpecialsOnly" => false,
                "RegularRateOnly" => false,
                "ProfileId" => "")));/**/

        //check record is empty or not
        if ($response->CourseAvailListResult->RetCd == 0) {
            $single_record = count($response->CourseAvailListResult->Courses->alCourse);
            //if record is single
            if ($single_record == 1) {
                $whole_data = $response->CourseAvailListResult->Courses->alCourse;
                $pos = strpos(strtolower($whole_data->nm), strtolower($search_me));
                if ($pos !== false) {
                    $match[] = $whole_data;
                }
                $result = $match;
            } else //if record are more than one
            {
                //start golfcourse name match or not.
                $whole_data = $response->CourseAvailListResult->Courses->alCourse;
                $last = count($whole_data);
                for ($i = 0; $i < $last; $i++) {
                    $pos = strpos(strtolower($whole_data[$i]->nm), strtolower($search_me));
                    if ($pos !== false) {
                        $match[] = $whole_data[$i];
                    }
                }
                //end golfcourse name match or not.

                //start require only five record.
                $j = count($match);
                $result = array();
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $j)
                        $result[] = $match[$i];
                }
                //end require only five record.
            }

            //proper html form
            $count = count($result);
            $html = '';
            if ($count > 0) {
                echo '<div><ul style="list-style:none;">';
                for ($i = 0; $i < $count; $i++) {
                    $cli = "'" . $result[$i]->nm . "'";
                    $course_id = "'" . $result[$i]->id . "'";
					$country_id = "'" . $result[$i]->sCou . "'";
					$state_id = "'" . $result[$i]->st . "'";					
					$area_id = "'" . $result[$i]->sAr . "'";
					$fin_date = "'" . $f_date . "'";
                    $html .= '<li id="' . $i . '" style="list-style:none;"  onclick="go_text(' . $cli . ',' . $course_id . ',' . $country_id . ',' . $state_id . ',' . $area_id . ',' . $fin_date . ')">' . $result[$i]->nm . '</li>';
					
				}
				//echo '<script> console.log("'.$result[1].'")</script>';
				#var_dump($result[1]);
                echo '</ul></div>';
                echo $html;
            } else {
                echo 'No Record Found.';
            }
        } else {
            echo 'No Record Found.';
        }

    }

	
	function searchteetimes()
	{
		$serchKey=$this->input->post('serchKey');
		$course_id=$this->input->post('my_course_id');
		
		$country_id=$this->session->userdata('country_id');
		$state_id=$this->session->userdata('state_id');
		$area_id=$this->session->userdata('area_id');
		$this->session->set_userdata('course_id',$course_id);
		
		$fin_date=$this->input->post('my_date');
		if($fin_date=='')
		{
		  $fin_date=time();
		}
		else
		{
		$fin_date=strtotime($fin_date);
		}
		$this->session->set_userdata('fin_date',$fin_date);
		$fin_date=date('Y-m-d',$fin_date);
		
		
		$times=$this->session->userdata('times');
		if($times=='')
		{
			$times='0600'; 
		}
		$this->session->set_userdata('times',$times);
		
		
		$players=$this->input->post('my_players');
		if($players=='')
		{
			$players='1'; 
			$this->session->set_userdata('players',$players);
		}
				
			
			
				
				
				
				
			$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
			$response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",
																"PartnerId"=>"",
																"SourceCd"=>"A",
																"Lang"=>"en",
																"UserIp"=>"127.0.0.1",
																"UserSessionId"=>"",
																"AccessKey"=>"",
																"Agent"=>"",
																"gsSource"=>"",
																"gsDebug"=>true),
													"Req"=>array("CourseAvailRequest"=>
														   array("CourseId"=>$course_id,
																"PlayBegDate"=>$fin_date."T00:00:00",
																"PlayEndDate"=>$fin_date."T00:00:00",
																"Time"=>$times,
																"Players"=>$players,
																"AltRateType"=>"",
																"PromoCode"=>"",
																"ShowAllTimes"=>true,
																"BarterOnly"=>false,
																"ChargingOnly"=>false,
																"SpecialsOnly"=>false,
																"RegularRateOnly"=>false,
																"ProfileId"=>""))));
		
				
				$RetCd=$response->CourseAvailResult->RetCd;
				if($RetCd==0)
				{
					$course_arr=$response->CourseAvailResult->Courses->caCourse;
					$altime=array();
					$tim=array();
					
					   if(isset($course_arr->Dates->alDate->Times->alTime))
					   {
						   $tim=$course_arr->Dates->alDate->Times->alTime;
						   if(count($tim)==1)
						   {
						      $altime[]=$tim;
						   }
						   if(count($tim)>1)
						   {
							   for($j=0;$j<count($tim);$j++)
							   {
								  $altime[]=$tim[$j];
							   }
						   }
					   }
				 }
				 else
				 {
					 $course_arr='';
					 $altime='';
				 }
					
				$results['RetCd']=$RetCd;
				$results['course_arr']=$course_arr;
				$results['altime']=$altime;
				
				$results['course_id']=$course_id;
				$results['players']=$players;
				$results['fin_date']=$fin_date;
				$results['times']=$times;
				
				$results['sort']='times';
				$results['filter']='all_day';
				
				$data1['contents']=$this->load->view('specific_course_avail_listing',$results,true);
				$data1['my_title']='TeeTime';
				$this->load->view('template',$data1);	
				
				
				
				
				
			//}//end if course id post value is empty
	}//end function 

    //end function

    public function index2()

    {

        $this->load->helper(array('form', 'url'));

        if ($this->input->post('submit') && $this->formValidator()) {


            if ($this->users_model->validate_player_email($this->input->post()) == 0) {

                $_POST['player_types_id'] = 2;

                $player_id = $this->my_db_lib->save_record($this->input->post(), 'players');

                $player_details = $this->users_model->players_details($player_id);

                $this->load->library('email');

                $this->email->mailtype = "html";

                $data['email'] = $player_details->email;

                $data['password'] = $player_details->password;

                $msg = $this->load->view('email/player_register', $data, TRUE);

                $from = 'wesportonline@gmail.com';

                $subject = 'Player Register';

                $to = $player_details->email;

                $this->email->from($from, 'WeSport');

                $this->email->to($to);

                $this->email->subject($subject);

                $this->email->message($msg);

                $this->email->send();

                $this->db_session->set_flashdata('msg', '<div class="success">Successfully registered and send the details to your email address</div>');

                redirect('login');

            } else {


                redirect('home/index2');

            }

        } else {


            $view_data['active_tab'] = '0';

            $view_data['links_js_css'] = 'register/links_js_css';

            $view_data['content_page'] = 'register/login_registration';

            $view_data['header_login'] = true;

            $this->load->view('template', $view_data);

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
        if ($this->users_model->get_user_by_email_num($email)) {
            $this->form_validation->set_message('_email_check', 'User email is already used');
            return false;
        }

        return true;
    }

    public function activate($id = 0, $code = NULL)
    {
        exit;
        $code = ($this->input->post('activation_code')) ? $this->input->post('activation_code') : $code;

        // If user has supplied both bits of information
        if ($id AND $code) {
            // Try to activate this user
            if ($this->users_model->activate($id, $code)) {
                $player_details = $this->users_model->players_details($id);
                if (SEND_EMAIL) {
                    $this->load->library('email');
                    $this->email->mailtype = "html";
                    $data['id'] = $player_details->id;
                    $data['email'] = $player_details->email;
                    $data['password'] = $player_details->password;
                    $msg = $this->load->view('email/player_register', $data, TRUE);
                    $from = 'noreply@wesport.com'; //'wesportonline@gmail.com';
                    $subject = 'Your account on WESport is activated';
                    $to = $player_details->email;
                    $this->email->from($from, 'WESport');
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($msg);
                    $this->email->send();
                }
                $this->db_session->set_flashdata('activated_email', 'success');
                redirect('home');
            } else {
                echo 'error';
            }
        }


    }

    public function formValidator()
    {


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


        if ($this->form_validation->run() == FALSE) {

            return false;

        } else {

            return true;

        }


    }
}

?>
