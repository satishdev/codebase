<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Players extends MY_Controller {

    function __construct() {
		// Call the Parent constructor
		parent::__construct();
		/*if($this->userType!=2){
			redirect('login');exit;
		}*/
		$this->load->library('albumfileupload_library');
		$this->load->model('admin_model');
		$this->load->model('users_model');
		$this->load->model('sports_model');
		$this->load->model('teams_model');
		$this->load->library('pagination');
		$this->load->model('gallery_model','gallery_tbl');
		$this->load->model('schedule_model');
		$this->load->library('form_validation');
		session_check();
    }

    public function index() {
	    $id=$this->userId;
        $data['u_details']=$this->users_model->players_details($id);
		$sdata=$this->sports_model->listofmysports($id,0,3,'');
		$fdata=$this->users_model->listofmyplayers($id,0,3,'');
		$tdata=$this->teams_model->listofmyteams($id,$this->userId,0,3,'');
		$isfrd=$this->users_model->isfriend($id,$this->userId);
		$data['e_details']=$this->users_model->education_details($this->userId);
		$data['a_details']=$this->users_model->alert_details($this->userId);
		$data['i_details']=$this->users_model->interest_details($this->userId);
		$data['w_details']=$this->users_model->work_details($this->userId);
		$data['f_count']=$this->users_model->players_frd_count($this->userId);
		$data['s_count']=$this->users_model->players_sports_count($this->userId);
		$data['t_count']=$this->users_model->players_teams_count($this->userId);
		$data['is_frd']=$this->users_model->players_is_friend($this->userId,$this->userId);
		$data['u_sprts']=$this->users_model->userschedule_spports($this->userId);
		$data['s_details']=$sdata['records'];
		$data['t_details']=$tdata['records'];
		$data['f_details']=$fdata['records'];
		$data['s_cnt']=$sdata['total'];
		$data['t_cnt']=$tdata['total'];
		$data['f_cnt']=$fdata['total'];
		$data['isfrd']=$isfrd;
		$data['id']=$id;
		$data['active_tab'] = '0';
		$data['links_js_css']='players/links_js_css';
		$data['left_nav'] = 'common/left_nav';
		$data['right_nav'] = 'profile/profile_relations';
		$data['long_right'] = true;
		 $data['content_page'] =  'players/profile';
		$data['links_js_css']='players/links_js_css';
        $this->load->view('common/base_template', $data);
    }

    function profile() {
        $data['u_details']=$this->users_model->players_details($this->userId);
		$data['e_details']=$this->users_model->education_details($this->userId);
		$data['a_details']=$this->users_model->alert_details($this->userId);
		$data['i_details']=$this->users_model->interest_details($this->userId);
		$data['w_details']=$this->users_model->work_details($this->userId);
		$data['f_count']=$this->users_model->players_frd_count($this->userId);
		$data['s_count']=$this->users_model->players_sports_count($this->userId);
		$data['t_count']=$this->users_model->players_teams_count($this->userId);
		$data['is_frd']=$this->users_model->players_is_friend($this->userId,$this->userId);
		$data['u_sprts']=$this->users_model->userschedule_spports($this->userId);
        $data['content_page'] =  'players/profile';
		$data['active_tab'] = '1';
		$data['id'] = $this->userId;
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
        $this->load->view('common/base_template', $data);
    }

	function edit() {
        $data['u_details']=$this->users_model->players_details($this->userId);
		if($this->input->post('submit')){
		   $_POST['id']=$this->userId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'players');
			redirect('players/profile');
		}else{
			$data['content_page'] =  'players/edit';
			$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }
	function edit_personal() {
        $data['u_details']=$this->users_model->players_details($this->userId);
		if($this->input->post('submit')){
		   $_POST['id']=$this->userId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'players');
			redirect('players/profile');
		}else{
			$data['content_page'] =  'players/edit_personal';
			$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }
	function add_education_information() {
       $data['u_details']=$this->users_model->players_details($this->userId);
		if($this->input->post('submit')){
		    $_POST['players_id']=$this->userId;
			 $_POST['from_date']=$_POST['year'].'-'.$_POST['month'].'-01';
		 $_POST['to_date']=$_POST['year2'].'-'.$_POST['month2'].'-01';
			$player_id=$this->my_db_lib->save_record($this->input->post(),'player_education');
			redirect('players/profile');
		}else{

		$data['content_page'] =  'players/add_education_information';
		$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }

	function edit_education_information($eid=0) {
	$data['u_details']=$this->users_model->players_details($this->userId);
        $data['e_details']=$this->users_model->education_details($this->userId,$eid);
		if($this->input->post('submit')){
		    $_POST['players_id']=$this->userId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'player_education');
			redirect('players/profile');
		}else{

		$data['content_page'] =  'players/edit_education_information';
		$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }

	function add_interests() {
       $data['u_details']=$this->users_model->players_details($this->userId);
		if($this->input->post('submit')){
		 $_POST['players_id']=$this->userId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'player_interests');
			redirect('players/profile');
		}else{

			$data['content_page'] =  'players/add_interests';
			$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }

	function edit_interests($iid=0) {
		$data['u_details']=$this->users_model->players_details($this->userId);
       $data['i_details']=$this->users_model->interest_details($this->userId,$iid);
		if($this->input->post('submit')){
		 	$_POST['players_id']=$this->userId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'player_interests');
			redirect('players/profile');
		}else{

			$data['content_page'] =  'players/edit_interests';
			$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }

	function add_personal_information() {
        $data['u_details']=$this->users_model->players_details($this->userId);
		if($this->input->post('submit')){
		 $_POST['players_id']=$this->userId;

			$player_id=$this->my_db_lib->save_record($this->input->post(),'players');
			redirect('players/profile');
		}else{

		$data['content_page'] =  'players/add_personal_information';
		$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }

	function add_working_expierence() {
        $data['u_details']=$this->users_model->players_details($this->userId);
		if($this->input->post('submit')){
		 $_POST['players_id']=$this->userId;
		 $_POST['from_date']=$_POST['year'].'-'.$_POST['month'].'-01';
		 $_POST['to_date']=$_POST['year2'].'-'.$_POST['month2'].'-01';
			$player_id=$this->my_db_lib->save_record($this->input->post(),'player_expierence');
			redirect('players/profile');
		}else{

		$data['content_page'] =  'players/add_working_expierence';
		$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }

	function edit_working_expierence($wid=0) {
		$data['u_details']=$this->users_model->players_details($this->userId);
       $data['w_details']=$this->users_model->work_details($this->userId,$wid);
		if($this->input->post('submit')){
		 $_POST['players_id']=$this->userId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'player_expierence');
			redirect('players/profile');
		}else{

		$data['content_page'] =  'players/edit_working_expierence';
		$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }

	function add_alerts() {
        $data['u_details']=$this->users_model->players_details($this->userId);
		if($this->input->post('submit')){
		 $_POST['players_id']=$this->userId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'player_alerts');
			redirect('players/profile');
		}else{

			$data['content_page'] =  'players/add_alerts';
			$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }

	function edit_alerts($a_id=0) {
		$data['u_details']=$this->users_model->players_details($this->userId);
       $data['a_details']=$this->users_model->alert_details($this->userId,$a_id);
		if($this->input->post('submit')){
		 $_POST['players_id']=$this->userId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'player_alerts');
			redirect('players/profile');
		}else{
			$data['content_page'] =  'players/edit_alerts';
			$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }

	function imageupload()
	{
	$data['u_details']=$this->users_model->players_details($this->userId);

		if($this->input->post('submit')){
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['max_size']	= '1024';
			$this->load->library('upload', $config);


			if( ! $this->upload->do_upload('image'))
			{

			}
			else
			{
				// Build a file array from all uploaded files

				$data =$this->upload->data();
				createThumbnail($data['file_name'],'./images/');
				//$opt->logo=$data['file_name'];
			 	$_POST['id']=$this->userId;
			 	$_POST['image']=$data['file_name'];
		  		$player_id=$this->my_db_lib->save_record($this->input->post(),'players');
			}

		redirect('players/profile');
		}
		else{
				if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
				$data['right_nav'] =  'common/ads.php';
				$data['active_tab'] = '1';
				$data['content_page'] =  'players/imageupload';
				$data['links_js_css']='players/links_js_css';
				$this->load->view('common/base_template', $data);
		}
	}


	function delete_alert($id=0){
		$this->users_model->alert_delete($this->userId,$id);
		redirect('players/profile');
	}

	function delete_expierence($id=0){

		$this->users_model->expierence_delete($this->userId,$id);
		redirect('players/profile');
	}

	function delete_education($id=0){

		$this->users_model->education_delete($this->userId,$id);
		redirect('players/profile');
	}

	function delete_interest($id=0){

		$this->users_model->interest_delete($this->userId,$id);
		redirect('players/profile');
	}



	/******************** CALENDAR FUNCTIONS *********************/

	 public function scheduler() {
	    $data['u_details']=$this->users_model->players_details($this->userId);
		$data['active_tab'] =  '1';
		$data['content_page'] =  'cal/pl_scheduler';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		   $data['right_nav'] =  'common/ads.php';
		   $data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);


    }
	function datafeed(){
		$ret = array();
		$info=listCalendar($_POST["showdate"], $_POST["viewtype"]);
		  $ret['events'] = array();
		  $ret["issort"] =true;
		  $ret["start"] = php2JsTime($info['st']);
		  $ret["end"] = php2JsTime($info['et']);
		  $ret['error'] = null;
	 	$data['u_details']=$this->users_model->players_details($this->userId);
		$user_calender_events=$this->users_model->get_user_calender_events($this->userId,$info['st'],$info['et']);
		$parsed_events=array();
		if(count($user_calender_events)>0){
			foreach($user_calender_events as $k=>$v){
			if($v->schedule_type=='2'){
				$editable=0;
				$description=$this->users_model->scheduleUsers($v->id);
			}else{
				$description=$v->description;
				$editable=1;
			}
			if(rand(0,10) > 8){
				  $alld = 1;
			  }else{
				  $alld=0;
			  }
				 $ret['events'][] = array(
											$v->id,
											$description,
											php2JsTime(strtotime($v->start_date)),
											php2JsTime(strtotime($v->end_date)),
											$v->isalldayevent,
											0, //more than one day event
											0,//Recurring event
											$v->color,
											$editable, //editable
											'hyderabad',
											''//$attends
										  );
			}
		}
		//$data['events']=$parsed_events;
		 echo json_encode($ret);
}


	function save_event(){
		$post=$this->input->post();
		if($post){
			$post['players_id']=$this->userId;
			$post['created_by']=$this->userId;
			$post['start_date']=date('Y-m-d H:i:s',strtotime($post['CalendarStartTime']));
			$post['end_date']=date('Y-m-d H:i:s',strtotime($post['CalendarEndTime']));
			if(date('H:i:s',strtotime($post['CalendarStartTime']))!='00:00:00' || date('H:i:s',strtotime($post['CalendarEndTime']))!='00:00:00'){
			$post['isalldayevent']=0;
			}else{
			$post['isalldayevent']=$post['IsAllDayEvent'];
			}
			$post['name']=$post['CalendarTitle'];
			$post['description']=$post['CalendarTitle'];

			//$return = $this->my_db_lib->save_record($post,'player_schedule');
			if(!empty($post['id'])){
				$return = $this->my_db_lib->save_record($post,'player_schedule');
			}else{
				$post['schedule_type']='1';
				$post['user_type']='1';
				$return = $this->schedule_model->add_schedule($post);
			}
			$data['IsSuccess']=true;
			$data['Msg']='add success';
			$data['Data']=$return;
			echo json_encode($data);
		}
	}

function schedule_edit(){
		$post=$this->input->post();
		if($post){
			$post['players_id']=$this->userId;
			$post['created_by']=$this->userId;
			$post['start_date']=date('Y-m-d',strtotime($post['stpartdate']));
			$post['end_date']=date('Y-m-d',strtotime($post['etpartdate']));
			$post['end_date'].=' '.$post['etparttime'].':00';
			$post['start_date'].=' '.$post['stparttime'].':00';
			$post['name']=$post['Subject'];
			$post['description']=$post['Subject'];
			$post['isalldayevent']=!empty($post['IsAllDayEvent'])?$post['IsAllDayEvent']:0;
			$post['color']=$post['colorvalue'];

			//$return = $this->my_db_lib->save_record($post,'player_schedule');
			if(!empty($post['id']) and $post['id']!=''){
			//print_r($post);exit;
				$return = $this->my_db_lib->save_record($post,'player_schedule');
			}
			else{
				$post['schedule_type']='1';
				$post['user_type']='1';
				$return = $this->schedule_model->add_schedule($post);
			}
			$data['IsSuccess']=true;
			$data['Msg']='Succefully';
			$data['Data']=$return;
			echo json_encode($data);
		}
	}

	function allplayers($pagenumber=0){
		$config['base_url'] = site_url('players/allplayers');
		$config['per_page'] = '10';
		$config['uri_segment'] = '3';
		//$pagenumber=0;
		//$config['full_tag_open'] = '<div class="page_box fl">';
		//$config['full_tag_close'] = '</div>';
		$config['full_tag_open'] = '<div class="page_box fl">';
			$config['full_tag_close'] = '</div>';
		if(isset($_REQUEST['serchKey']) and trim($_REQUEST['serchKey'])!='Search...'){
			$serchKey=trim($_REQUEST['serchKey']);
		}else{
			$serchKey='';
		}
		$rec=$this->users_model->listofplayers($this->userId,$pagenumber,10,$serchKey);
		$config['total_rows'] = $rec['total'];
		$this->pagination->initialize($config);

		$data['sports_data']=$rec['records'];
		$data['active_tab'] = '2';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'players/allplayers.php';
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);
	}

	public function joinpl() {
		if($this->input->post('pid')){
			$_POST['from']=$this->userId;
			$_POST['to']=$_POST['pid'];
			$_POST['created_by']=$this->userId;
			$_POST['created_by']=date('Y-m_d H:s:i');
			if($this->input->post('selected')==0){
				$num=$this->users_model->checkPl($_POST['pid'],$this->userId);
				if($num==0){
					$tid=$this->my_db_lib->save_record($this->input->post(),'player_friends');
					 $this->users_model->friend_request($_POST['pid']);
					echo 0;
				}else{
					echo 1;
				}
			}else if($this->input->post('selected')==1){
				$this->users_model->removePl($_POST['pid'],$this->userId);
				echo 1;
			}else if($this->input->post('selected')==2){
			if($this->userType==2){
				$this->users_model->approvePl($_POST['pid'],$this->userId);
				$_POST['from']=$this->userId;
				$_POST['to']=$_POST['pid'];
				$_POST['is_approved']='1';
				$_POST['player_relations_id']='1';
				$_POST['created_by']=$this->userId;
				$_POST['created_by']=date('Y-m_d H:s:i');
				$tid=$this->my_db_lib->save_record($this->input->post(),'player_friends');
				 $this->users_model->friend_accept($_POST['pid']);
				echo 2;
				}else if($this->userType==3){
					$_POST['id']=$_POST['pid'];
					$_POST['is_approved']=1;
					$this->my_db_lib->save_record($this->input->post(),'club_players');
				}
			}
			else if(isset($_POST['relation_id'],$_POST['pid']) && $this->input->post('selected')==3){
				$this->users_model->setrelationPl($_POST['pid'],$this->userId,$_POST['relation_id']);
				echo 3;
			}
		}
    }

	function friends($pagenumber=0){
		$data['u_details']=$this->users_model->players_details($this->userId);
		$config['base_url'] = site_url('players/friends');
		$config['per_page'] = '10';
		$config['uri_segment'] = '3';
		//$pagenumber=0;
		$config['full_tag_open'] = '<div class="page_box fl">';
		$config['full_tag_close'] = '</div>';
		if(isset($_POST['serchKey']) and trim($_POST['serchKey'])!='Search...'){
					 $serchKey=trim($_POST['serchKey']);
		}else{
					$serchKey='';
		}
		if($pagenumber==0){
		 	$this->db_session->set_userdata('fserchKey',$serchKey);
		 }
		$rec=$this->users_model->friends($this->userId,$pagenumber,10,$serchKey);
		$config['total_rows'] = $rec['total'];
		$data['sports_data']=$rec['records'];
		$this->pagination->initialize($config);

		$data['plrelation'] = json_encode($this->users_model->friendsrelations());
		$data['active_tab'] = '2';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
        $data['content_page'] = 'players/friends.php';
		$data['links_js_css']='players/links_js_css';
        $this->load->view('common/base_template', $data);
      }

	function advanceplayers($pagenumber=0){
		$total=0;



		if($this->input->request()){

		if(empty($_REQUEST['fname']))
		$_REQUEST['fname']='';

		if(empty($_REQUEST['lname']))
		$_REQUEST['lname']='';

		if(empty($_REQUEST['poc']))
		$_REQUEST['poc']='';

		if(empty($_REQUEST['dist']))
		$_REQUEST['dist']='';

		if(empty($_REQUEST['sp']))
		$_REQUEST['sp']='';

		if(empty($_REQUEST['level']))
		$_REQUEST['level']='';


			$search_array=array(
								'fname'=>$_REQUEST['fname'],
								'lname'=>$_REQUEST['lname'],
								'poc'=>$_REQUEST['poc'],
								'dist'=>$_REQUEST['dist'],
								'sp'=>$_REQUEST['sp'],
								'level'=>$_REQUEST['level'],
							);
			$rec=$this->users_model->getPlayers($this->userId,$search_array,$pagenumber,10);
			$total=$rec['total'];
			$data['sports_data']=$rec['records'];
		}else{
			$data['sports_data']=array();
		}
		$config['base_url'] = site_url('players/advanceplayers');
		$config['per_page'] = '10';
		$config['uri_segment'] = '3';
		//$pagenumber=0;
		$config['full_tag_open'] = '<div class="page_box fl">';
		$config['full_tag_close'] = '</div>';
		$config['total_rows'] = $total;
		$this->pagination->initialize($config);
		$data['active_tab'] = '2';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'players/advanceplayers.php';
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);
	}






	function advteetimes($pagenumber=0)
	{



		if($this->input->post()){

			if(empty($_POST['fname']))
			$_POST['fname']='';
			if(empty($_POST['lname']))
			$_POST['lname']='';
			if(empty($_POST['poc']))
			$_POST['poc']='';
			if(empty($_POST['dist']))
			$_POST['dist']='';
			if(empty($_POST['sp']))
			$_POST['sp']='';
			if(empty($_POST['level']))
			$_POST['level']='';


			$search_array=array(

								'fname'=>$_POST['fname'],

								'lname'=>$_POST['lname'],

								'poc'=>$_POST['poc'],

								'dist'=>$_POST['dist'],

								'sp'=>$_POST['sp'],

								'level'=>$_POST['level'],

							);

			$rec=$this->users_model->getPlayers($this->userId,$search_array);
			//$rec->result()
			$data['sports_data']=$rec;
		}else{

			$data['sports_data']=array();

		}

		$data['active_tab'] = '2';

		if($this->userType==2)

			$data['left_nav'] =  'common/left_nav.php';

			else

			$data['left_nav'] =  'common/left_nav_cl.php';

		$data['right_nav'] =  'common/ads.php';

		$data['content_page'] = 'players/advteetimes.php';

		$data['links_js_css']='players/links_js_css';

		$this->load->view('common/base_template', $data);



	}








	function golfcourses_name_auto_complete()
	{
	    $search_me=$this->input->post('search_me');

		$country_id=$this->session->userdata('country_id');
		$state_id=$this->session->userdata('state_id');
		$area_id=$this->session->userdata('area_id');

		$fin_date=$this->session->userdata('fin_date');
		if($fin_date=='')
		$fin_date=time();
		//save in session
		$this->session->set_userdata('fin_date',$fin_date);
		$f_date=date('Y-m-d',$fin_date);

		$times=$this->session->userdata('times');
		if($times=='')
		$times='600';
		$players=$this->session->userdata('players');
		if($players=='')
		$players='1';

		$this->session->set_userdata('course_id','');

		if($country_id=='' && $state_id=='')
		{
			$country_id='USA';
			$state_id='CA';
			$f_date=date('Y-m-d',time());

			$this->session->set_userdata('country_id',$country_id);
			$this->session->set_userdata('state_id',$state_id);
		    $this->session->set_userdata('fin_date',time());
		}

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
		$response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",
																"PartnerId"=>"",
															"SourceCd"=>"A",
															"Lang"=>"en",
															"UserIp"=>"66.147.244.227",
															"UserSessionId"=>"",
															"AccessKey"=>"",
															"Agent"=>"",
															"gsSource"=>"",
															"gsDebug"=>true),
											"Req"=>array("CountryId"=>$country_id,
															"RegionId"=>$state_id,
															"Area"=>$area_id,
															"PlayBegDate"=>$f_date."T00:00:00",
															"PlayEndDate"=>$f_date."T00:00:00",
															"Time"=>$times,
															"Players"=>$players,
															"MaxDistance"=>"",
															"FeaturedOnly"=>false,
															"ShowAllTimes"=>true,
															"ShowIfNoTimes"=>true,
															"BarterOnly"=>false,
															"ChargingOnly"=>false,
															"SpecialsOnly"=>false,
															"RegularRateOnly"=>false,
															"ProfileId"=>"")));/**/
			  //check record is empty or not
			  if($response->CourseAvailListResult->RetCd==0)
			  {
					$single_record=count($response->CourseAvailListResult->Courses->alCourse);
					//if record is single
					if($single_record==1)
					{
						$whole_data=$response->CourseAvailListResult->Courses->alCourse;
						$pos = strpos(strtolower($whole_data->nm),strtolower($search_me));
						if ($pos !== false)
						{
						   $match[]=$whole_data;
						}
						$result=$match;
					}
			   		else//if record are more than one
					{
						//start golfcourse name match or not.
						$whole_data=$response->CourseAvailListResult->Courses->alCourse;
						$last=count($whole_data);
						for($i=0;$i<$last;$i++)
						{
						   $pos = strpos(strtolower($whole_data[$i]->nm),strtolower($search_me));
                           if ($pos !== false)
						   {
						      $match[]=$whole_data[$i];
						   }
						}
						//end golfcourse name match or not.

						//start require only five record.
						$j=count($match);
						$result=array();
						for($i=0;$i<5;$i++)
						{
							if($i<$j)
							$result[]=$match[$i];
						}
						//end require only five record.
					}

					//proper html form
					$count=count($result);
					$html='';
					if($count>0)
					{
						echo '<div><ul style="list-style:none;">';
						for($i=0;$i<$count;$i++)
						{
						   $cli="'".$result[$i]->nm."'";
						   $html.='<li id="'.$i.'" style="list-style:none;"  onclick="go_text('.$cli.')">'.$result[$i]->nm.'</li>';
						}
						echo '</ul></div>';
						echo $html;
					}
					else
					{
					    echo 'No Record Found.';
					}
				}
				else
				{
				    echo 'No Record Found.';
				}

		}










	function searchteetimes()
	{
		
		
		
		$serchKey=$this->input->post('serchKey');
		
		$my_course_id=$this->input->post('my_course_id');
		
		
		//if($my_course_id == '' || $my_course_id == null){
			$course_id=$this->session->userdata('course_id');
			$country_id=$this->session->userdata('country_id');
			$state_id=$this->session->userdata('state_id');
			$area_id=$this->session->userdata('area_id');
			$fin_date=$this->session->userdata('fin_date');
		//}else{
			// $course_id=$my_course_id;
			// $country_id=$this->input->post('my_country_id');
			// $state_id=$this->input->post('my_state_id');
			// $area_id=$this->input->post('my_area_id');
			// $fin_date=$this->input->post('my_fin_date');
			
			// $('#serchKey').val(val);
        // $('#my_course_id').val(id);
		// $('#my_country_id').val(id);
		// $('#my_state_id').val(id);
		// $('#my_area_id').val(id);
		// $('#my_fin_date').val(id);
		//}
		
		

		
		if($fin_date=='')
		{
		  $fin_date=time();
		  $this->session->set_userdata('fin_date',$fin_date);
		}
		$fin_date=date('Y-m-d',$fin_date);

		$times=$this->session->userdata('times');
		if($times=='')
		{
			$times='0600';
			$this->session->set_userdata('times',$times);
		}
		$players=$this->session->userdata('players');
		if($players=='')
		{
			$players='1';
			$this->session->set_userdata('players',$players);
		}


			/*if($course_id!='')
			{
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
				$data1['my_title']='TeeTime';$this->load->view('template',$data1);
			}*/
			//else
			//{//if course id post value is empty


	$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
    $response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",
															"PartnerId"=>"",
															"SourceCd"=>"A",
															"Lang"=>"en",
															"UserIp"=>"66.147.244.227",
															"UserSessionId"=>"",
															"AccessKey"=>"",
															"Agent"=>"",
															"gsSource"=>"",
															"gsDebug"=>true),
											"Req"=>array("CountryId"=>$country_id,
															"RegionId"=>$state_id,
															"Area"=>$area_id,
															"PlayBegDate"=>$fin_date."T00:00:00",
															"PlayEndDate"=>$fin_date."T00:00:00",
															"Time"=>$times,
															"Players"=>$players,
															"MaxDistance"=>"",
															"FeaturedOnly"=>false,
															"ShowAllTimes"=>true,
															"ShowIfNoTimes"=>true,
															"BarterOnly"=>false,
															"ChargingOnly"=>false,
															"SpecialsOnly"=>false,
															"RegularRateOnly"=>false,
															"ProfileId"=>"")));


				$RetCd=$response->CourseAvailListResult->RetCd;
				if($RetCd==0)
				{
					$course_arr=$response->CourseAvailListResult->Courses->alCourse;









					$altime=array();
					$tim=array();
					if(count($course_arr)==1)
					{
					   $whole_data=$response->CourseAvailListResult->Courses->alCourse;
					   $pos = strpos(strtolower($whole_data->nm),strtolower($serchKey));
						if ($pos !== false)
						{
						   $match=$whole_data;
						}
						$results['result']=$match;


					    if(!empty($match))
					    {
						   if(isset($match->Dates->alDate->Times->alTime))
						   {
							   $tim=$match->Dates->alDate->Times->alTime;
							   if(count($tim)==1)
							   {
								  $altime[]=$tim;
							   }
							   if(count($tim)>1)
							   {
								   for($j=0;$j< count($tim);$j++)
								   {
									  $altime[]=$tim[$j];
								   }
							   }
						   }
					    }
					    else
					    {
					       $altime='';
					    }
					}
					else if(count($course_arr)>1)
					{


				    //start golfcourse name match or not.
					$whole_data=$response->CourseAvailListResult->Courses->alCourse;
					$last=count($whole_data);
					for($i=0;$i<$last;$i++)
					{
					   $pos = strpos(strtolower($whole_data[$i]->nm),strtolower($serchKey));
					   if ($pos !== false)
					   {
						  $match[]=$whole_data[$i];
					   }
					}
					//end golfcourse name match or not.





						for($i=0;$i< count($match);$i++)
						{
						   if(isset($match[$i]->Dates->alDate->Times->alTime))
						   {
							   $tim=$match[$i]->Dates->alDate->Times->alTime;
							   if(count($tim)==1)
							   {
								  $altime[]=$tim;
							   }
							   for($j=0;$j< count($tim);$j++)
							   {
								  $altime[]=$tim[$j];
							   }
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
				$results['course_arr']=$match;
				$results['altime']=$altime;

				$results['serchKey']=$serchKey;
				$results['active_tab'] = '2';
				if($this->userType==2)
				$results['left_nav'] =  'common/left_nav.php';
				else
				$results['left_nav'] =  'common/left_nav_cl.php';
				$results['right_nav'] =  'common/ads.php';
				$results['content_page'] = 'players/searchteetimes.php';
				$results['links_js_css']='players/links_js_css';
				$this->load->view('common/base_template', $results);

			//}//end if course id post value is empty
	}//end function






	function searchgolfcourse($page_start_from=0)
	{
		$serchKey=$this->input->post('serchKey');

		$country_id=$this->session->userdata('country_id');
		$state_id=$this->session->userdata('state_id');
		$area_id=$this->session->userdata('area_id');

		$fin_date=$this->session->userdata('fin_date');
		if($fin_date=='')
		$fin_date=time();
		//save in session
		$this->session->set_userdata('fin_date',$fin_date);
		$f_date=date('Y-m-d',$fin_date);

		$times=$this->session->userdata('times');
		if($times=='')
		$times='600';
		$players=$this->session->userdata('players');
		if($players=='')
		$players='1';

		$this->session->set_userdata('course_id','');

		if($country_id=='' && $state_id=='')
		{
			$country_id='USA';
			$state_id='CA';
			$f_date=date('Y-m-d',time());

			$this->session->set_userdata('country_id',$country_id);
			$this->session->set_userdata('state_id',$state_id);
		    $this->session->set_userdata('fin_date',time());
		}

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
		$response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",
																"PartnerId"=>"",
															"SourceCd"=>"A",
															"Lang"=>"en",
															"UserIp"=>"66.147.244.227",
															"UserSessionId"=>"",
															"AccessKey"=>"",
															"Agent"=>"",
															"gsSource"=>"",
															"gsDebug"=>true),
											"Req"=>array("CountryId"=>$country_id,
															"RegionId"=>$state_id,
															"Area"=>$area_id,
															"PlayBegDate"=>$f_date."T00:00:00",
															"PlayEndDate"=>$f_date."T00:00:00",
															"Time"=>$times,
															"Players"=>$players,
															"MaxDistance"=>"",
															"FeaturedOnly"=>false,
															"ShowAllTimes"=>true,
															"ShowIfNoTimes"=>true,
															"BarterOnly"=>false,
															"ChargingOnly"=>false,
															"SpecialsOnly"=>false,
															"RegularRateOnly"=>false,
															"ProfileId"=>"")));


				//check record is empty or not


			  if($response->CourseAvailListResult->RetCd==0)
			  {
					$filter_result=0;
					$single_record=count($response->CourseAvailListResult->Courses->alCourse);
					//if record is single
					if($single_record==1)
					{
						$whole_data=$response->CourseAvailListResult->Courses->alCourse;
						$pos = strpos(strtolower($whole_data->nm),strtolower($serchKey));
						if ($pos !== false)
						{
						   $match=$whole_data;
						}
						$results['result']=$match;
						$results['imgpath']=$response->CourseAvailListResult->imgBase;
					}
			   		else//if record are more than one
					{
						$results['imgpath']=$response->CourseAvailListResult->imgBase;
						$record_per_page=20;
						$last_record=$page_start_from+$record_per_page;

						//start golfcourse name match or not.
						$whole_data=$response->CourseAvailListResult->Courses->alCourse;
						$last=count($whole_data);
						for($i=0;$i<$last;$i++)
						{
						   $pos = strpos(strtolower($whole_data[$i]->nm),strtolower($serchKey));
                           if ($pos !== false)
						   {
						      $match[]=$whole_data[$i];
						   }
						}
						//end golfcourse name match or not.

						$j=count($match);
						$result=array();
						for($i=$page_start_from;$i<$last_record;$i++)
						{
							if($i<$j)
							$result[]=$match[$i];
						}

						$results['result']=$result;
						$mypaging['total_rows']=count($match);
						$mypaging['base_url']=base_url()."players/searchgolfcourse/";
						$mypaging['per_page']=$record_per_page;
						$mypaging['uri_segment']=3;
						$this->pagination->initialize($mypaging);
						$results['paginglink']=$this->pagination->create_links();
					}

					if(empty($result))
					$results['records']='empty';
					else
					$results['records']='not_empty';
				    $results['serchKey']=$serchKey;
				    $results['active_tab'] = '2';
					if($this->userType==2)
					$results['left_nav'] =  'common/left_nav.php';
					else
					$results['left_nav'] =  'common/left_nav_cl.php';
					$results['right_nav'] =  'common/ads.php';
					$results['content_page'] = 'players/searchgolfcourses.php';
					$results['links_js_css']='players/links_js_css';
					$this->load->view('common/base_template', $results);

				}
				else
				{
					$results['result']='';
					$results['records']='empty';
				    $results['serchKey']=$serchKey;
					$results['active_tab'] = '2';
					if($this->userType==2)
					$results['left_nav'] =  'common/left_nav.php';
					else
					$results['left_nav'] =  'common/left_nav_cl.php';
					$results['right_nav'] =  'common/ads.php';
					$results['content_page'] = 'players/searchgolfcourses.php';
					$results['links_js_css']='players/links_js_css';
					$this->load->view('common/base_template', $results);
				}
        	}




















	function advgolfcourses($pagenumber=0)
	{

		if($this->input->post()){

		    if(empty($_POST['fname']))
			$_POST['fname']='';
			if(empty($_POST['lname']))
			$_POST['lname']='';
			if(empty($_POST['poc']))
			$_POST['poc']='';
			if(empty($_POST['dist']))
			$_POST['dist']='';
			if(empty($_POST['sp']))
			$_POST['sp']='';
			if(empty($_POST['level']))
			$_POST['level']='';


			$search_array=array(

								'fname'=>$_POST['fname'],

								'lname'=>$_POST['lname'],

								'poc'=>$_POST['poc'],

								'dist'=>$_POST['dist'],

								'sp'=>$_POST['sp'],

								'level'=>$_POST['level'],

							);

			$rec=$this->users_model->getPlayers($this->userId,$search_array);
            //$rec->result()
			$data['sports_data']=$rec;

		}else{

			$data['sports_data']=array();

		}

		$data['active_tab'] = '2';

		if($this->userType==2)

			$data['left_nav'] =  'common/left_nav.php';

			else

			$data['left_nav'] =  'common/left_nav_cl.php';

		$data['right_nav'] =  'common/ads.php';

		$data['content_page'] = 'players/advgolfcourses.php';

		$data['links_js_css']='players/links_js_css';

		$this->load->view('common/base_template', $data);




	}











	function morefriends($id=0,$pagenumber=0){
		$data['u_details']=$this->users_model->players_details($id);
		$data['id']=$id;
		$config['base_url'] = site_url('players/morefriends/'.$id);
		$config['per_page'] = '10';
		$config['uri_segment'] = '4';
		//$pagenumber=0;
		$config['full_tag_open'] = '<div class="page_box fl">';
		$config['full_tag_close'] = '</div>';
		if(isset($_POST['serchKey']) and trim($_POST['serchKey'])!='Search...'){
			$serchKey=trim($_POST['serchKey']);
		}else{
			$serchKey='';
		}
		if($pagenumber==0){
			$this->db_session->set_userdata('mfserchKey',$serchKey);
		}
		$rec=$this->users_model->friends($id,$pagenumber,10,$serchKey);

		$config['total_rows'] = $rec['total'];
		$this->pagination->initialize($config);

		$data['sports_data']=$rec['records'];
		$data['content_page'] = 'players/morefriends.php';
		$data['active_tab'] = '2';
		if($id==$this->userId){
					if($this->userType==2)
					$data['left_nav'] =  'common/left_nav.php';
					else
					$data['left_nav'] =  'common/left_nav_cl.php';
			}
			else{
				$data['left_nav'] = 'profile/profile_image';
				}
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);
      }

	  function gallery(){
	  $data['u_details']=$this->users_model->players_details($this->userId);
	  $data['rows'] = $this->gallery_tbl->viewAlbums($this->userId,1,$this->userId);
		//$data['content_page'] = 'players/gallery_view.php';
		$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'players/albums.php';
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);

	  }

	   function galimages($id=0){
	    $data['u_details']=$this->users_model->players_details($this->userId);
	 	$data['info'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
		$data['rows'] = $this->gallery_tbl->showGalImages($id);
		//$data['content_page'] = 'players/galleryimage_view.php';
		$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'players/albums_images.php';
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);

	  }

	  function addgalleryimage($id=0){
	  $data['u_details']=$this->users_model->players_details($this->userId);
		 if($this->input->post()){
		ini_set("memory_limit","48M");
		$thumbWidth = 100;
		$thumbHeight = 75;
		$crop = '';
		if (isset($_FILES['filename'])) {
			$file = read_file($_FILES['filename']['tmp_name']);
			$maxfilesize = 2000000;
			$uploadsize = ceil($_FILES['filename']['size']);

			if ($uploadsize > $maxfilesize || $uploadsize<5 || !isset($uploadsize)) {
				redirect('players/addgalleryimage/'.$_POST['id']);
				exit();
			}

			$fname = $_FILES['filename']['name'];
			$ext = strtolower(substr($fname, strrpos($fname,'.')+1));
			$md5Date = Date("Y_m_d_H_i_s");
			$newname = $md5Date.'.'.$ext;
			$thumbname = $md5Date.'_thumb.'.$ext;
			$name = basename($_FILES['filename']['name']);
			if ($ext!="jpg"&&$ext!="jpeg"&&$ext!="png"&&$ext!="gif") {
				redirect('gallery/images/'.$_POST['id']);
			}
			$uploadImage = './uploads/'.$newname;
			write_file($uploadImage, $file);
			$this->_al_imageupload();
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Gallery created </div>');

				redirect('players/gallery');
			}
			}else{
			$data['info'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
			$data['active_tab'] = '1';
			if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'players/add_albumimage.php';
			$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		  }
	  }
	   function editgalleryimage($id=0){
	   $data['u_details']=$this->users_model->players_details($this->userId);
	    if($this->input->post()){
		   if($this->input->post('img_id')!=''){
		  // $_POST['created_by']=$this->userId;
				$id=$this->gallery_tbl->updategalImage();
				if($id){
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Image updated </div>');
				}else{
					$this->db_session->set_flashdata('msg', '<div class="error">The Gallery Image update Fail</div>');
				}
				redirect('players/editgalleryimage/'.$this->input->post('img_id'));
			}
			}else{
			$data['rows'] = $this->gallery_tbl->galparticularImage($id);
			$data['active_tab'] = '1';
			if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'players/edit_albumimage.php';
			$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		  }
	   }
	  function viewgallery($id=0){
	  $data['u_details']=$this->users_model->players_details($this->userId);
	  $data['rows'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
		//$this->load->view('gallery/gallery_view', $data);
		$data['active_tab'] = '1';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'players/gallery_details.php';
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);

	  }
	  function addgallery(){

	  	$data['u_details']=$this->users_model->players_details($this->userId);
		// Validation rules matches[passconf]
		$validation = array(
			array(
				'field' => 'name',
				'label' => 'Album Name',
				'rules' => 'required|callback__albumname_check',
			)
		);
			// Set the validation rules
			$this->form_validation->set_rules($validation);
		 if($this->input->post()){
		  if ($this->form_validation->run()){
		   $_POST['created_by']=$this->userId;
		    $_POST['related_id']=$this->userId;
				$id=$this->gallery_tbl->insertGallery();
				if($id!=0){
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Gallery created </div>');
				}else{
					$this->db_session->set_flashdata('msg', '<div class="error">The Gallery name already Exist</div>');
				}
				 echo json_encode(array('status' => true, 'message' => 'Successfully Gallery created'));
                }else{

				// Return the validation error
				//$data = $this->form_validation->error_string();
				echo json_encode(array('status' => false, 'message' => validation_errors()));
				}
				//redirect('players/gallery');
			}else{
			$data['active_tab'] = '1';
			if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'players/add_album.php';
			$data['add_js_css'][]='<script type="text/javascript" src="'.base_url().'js/uploader.js"></script>';
			$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		  }
	  }
	   function updategallery($id=0){
	   	$data['u_details']=$this->users_model->players_details($this->userId);
		$validation = array(
			array(
				'field' => 'name',
				'label' => 'Album Name',
				'rules' => 'required|callback__albumname_id_check',
			),
			array(
				'field' => 'id',
				'label' => 'Album id',
				'rules' => 'required',
			)
		);
			// Set the validation rules
			$this->form_validation->set_rules($validation);
		 if($this->input->post()){
		   if ($this->form_validation->run()){
		   //$_POST['created_by']=$this->userId;
				$this->my_db_lib->save_record($_POST,'albums');
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Gallery updated </div>');
				//redirect('players/updategallery/'.$this->input->post('id'));
				 echo json_encode(array('status' => true, 'message' => 'Successfully Gallery updated'));
			}
			else{
				// Return the validation error
				//$data = $this->form_validation->error_string();
				echo json_encode(array('status' => false, 'message' => validation_errors()));
				}
			}else{
			$data['rows'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
			$data['active_tab'] = '1';
			if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'players/update_album.php';
			$data['links_js_css']='players/links_js_css';
			$this->load->view('common/base_template', $data);
		  }
	  }

	function _al_imageupload(){

		if(isset($_POST['id'])){
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
				$config['max_size']	= '1024';
				$this->load->library('upload', $config);
				if( ! $this->upload->do_upload('filename'))
				{
					return false;
				}
				else
				{
					$data =$this->upload->data();
					createThumbnail($data['file_name'],'./uploads/');
					$thumbname='th_'.$data['file_name'];
					$this->gallery_tbl->insertImage($_POST['id'], $data['file_name'], $thumbname,$this->userId);
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Gallery Image uploaded </div>');
					redirect('players/galimages/'.$_POST['id']);
				}

				return true;
		}

	}
	function add_club(){
		$data['active_tab'] = '1';
		$data['left_nav'] =  'clubs/club_left_search.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/add_club.php';
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);
	}

	function club_info(){
		$data['active_tab'] = '1';
		$data['left_nav'] =  'common/left_nav.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/club_info.php';
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);
	}

	function playersSports(){
	$uid=$this->input->post('pid')?$this->input->post('pid'):0;
		$sp=$this->sports_model->listofmysports($uid,0,10000,'','');
		$u_sp=array();
		foreach($sp['records'] as $row){
			$data=array();
			$data['name']=$row->sname;
			$data['level']=$row->lname;
			array_push($u_sp,$data);
		}
		echo json_encode($u_sp);
	}
	function playersschedulesports(){
	$uid=$this->input->post('pid')?$this->input->post('pid'):0;
	$sid=$this->input->post('sid')?$this->input->post('sid'):0;
		$sp=$this->users_model->playersschedulesports($uid,$sid);
		$u_sp=array();
		foreach($sp as $row){
			$data=array();
			$data['sname']=$row->sname;
			$data['start_date']=date('m-d-Y',strtotime($row->start_date));
			$data['referee_name']=$row->referee_name;
			$data['location']=$row->location;
			$data['match_result']=$row->match_result;
			$data['pname']=$row->pname;
			$data['level']=$row->level;
			array_push($u_sp,$data);
		}
		echo json_encode($u_sp);
	}
	function filesupload()
	{

			if(!empty($_SERVER['HTTP_WESP'])){
				$_REQUEST['filename']=$_SERVER['HTTP_WESP'];
			}

		$allowedExtensions = array('jpg','gif','png','jpeg');
			// max file size in bytes
			$sizeLimit = 20 * 1024 * 1024;
			$myfilename= '';//'attach_'.time();
			//upload the file and validate the size and file type
			$uploader =$this->albumfileupload_library->fileUpload($allowedExtensions, $sizeLimit);
			//return the file original and source name and path
			$result = $this->albumfileupload_library->handleUpload('uploads/',FALSE,$myfilename);
			if (isset($result['success']) && $result['success']==true)/*$this->upload->do_upload()*/
				{
				createThumbnail($result['filename'],'uploads/');
			}
			echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);

	  }
		function rfile()
		{

		if($this->input->post('filename')){
			foreach($this->input->post('filename') as $file){
				if($file!=''){
				if(file_exists("uploads/".$file)){
					unlink("uploads/".$file);
				}
				}
			}
		}
		echo 1;

		}
		function approvent(){
		if($this->input->post('schedule_id')){
			if(isset($_POST['score']))
			$score=$_POST['score'];
			else
			$score='';

			$this->schedule_model->approvent($this->input->post('schedule_id'),$this->input->post('schedule_type'),$this->input->post('status'),$this->userId,$score);
			$data['id']=$this->input->post('schedule_id');
			$data['type']=$this->input->post('schedule_type');
			$data['status']=$this->input->post('status');
			echo json_encode($data);
		}else{
		echo 0;
		}
		}

		/**
	 * Email check
	 *
	 * @param string $email The email to check.
	 *
	 * @return bool
	 */
	public function _albumname_check($name)
	{
		if ($this->gallery_tbl->checkalbum_name($name,$this->userId))
		{
			$this->form_validation->set_message('_albumname_check', 'Album name is already used');
			return false;
		}

		return true;
	}
	/**
	 * Email check
	 *
	 * @param string $email The email to check.
	 *
	 * @return bool
	 */
	public function _albumname_id_check($name)
	{
		if ($this->gallery_tbl->checkalbum_name($name,$this->userId,$_POST['id']))
		{
			$this->form_validation->set_message('_albumname_id_check', 'Album name is already used');
			return false;
		}

		return true;
	}
}

?>
