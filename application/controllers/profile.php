<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
		/*if($this->userType!=2){	
				      redirect('');
					  }*/
         $this->load->model('admin_model');
		 $this->load->model('users_model');
		 $this->load->model('sports_model');
		 $this->load->model('teams_model');
		$this->load->model('gallery_model','gallery_tbl');
		session_check(); 
    }

    function view($id=0) {
	
        $data['u_details']=$this->users_model->players_details($id);
		$data['e_details']=$this->users_model->education_details($id);
		$data['a_details']=$this->users_model->alert_details($id);
		$data['i_details']=$this->users_model->interest_details($id);
		$data['w_details']=$this->users_model->work_details($id);
		$data['f_count']=$this->users_model->players_frd_count($id);
		$data['s_count']=$this->users_model->players_sports_count($id);
		$data['t_count']=$this->users_model->players_teams_count($id);
		$data['is_frd']=$this->users_model->players_is_friend($this->userId,$id);
		$data['u_sprts']=$this->users_model->userschedule_spports($id);
		
		
		$sdata=$this->sports_model->listofmysports($id,0,3,'');
		$fdata=$this->users_model->listofmyplayers($id,0,3,'');
		$tdata=$this->teams_model->listofmyteams($id,$this->userId,0,3,'');
		$isfrd=$this->users_model->isfriend($id,$this->userId);
		
		$data['s_details']=$sdata['records'];
		$data['t_details']=$tdata['records'];
		$data['f_details']=$fdata['records'];
		$data['s_cnt']=$sdata['total'];
		$data['t_cnt']=$tdata['total'];
		$data['f_cnt']=$fdata['total'];
		$data['isfrd']=$isfrd;
		$data['id']=$id;
		//print_r($data['s_details']);exit;
			if($this->userId==$id){
			$data['left_nav'] = 'common/left_nav';
			$data['active_tab'] = '0';
		}
		else{
			$data['left_nav'] = 'profile/profile_image';
			$data['active_tab'] = '2';
		}
		$data['right_nav'] = 'profile/profile_relations';
		$data['long_right'] = true;
        //$data['content_page'] =  'profile/player_profiles';
		 $data['content_page'] =  'players/profile';
		$data['links_js_css']='players/links_js_css';
        $this->load->view('common/base_template', $data);
    }

function gallery($id=0) {
        $data['u_details']=$this->users_model->players_details($id);
		$sdata=$this->sports_model->listofmysports($id,0,3,'');
		$fdata=$this->users_model->listofmyplayers($id,0,3,'');
		$tdata=$this->teams_model->listofmyteams($id,$this->userId,0,3,'');
		$isfrd=$this->users_model->isfriend($id,$this->userId);
		$data['s_details']=$sdata['records'];
		$data['t_details']=$tdata['records'];
		$data['f_details']=$fdata['records'];
		$data['s_cnt']=$sdata['total'];
		$data['t_cnt']=$tdata['total'];
		$data['f_cnt']=$fdata['total'];
		$data['isfrd']=$isfrd;
		$data['id']=$id;
		$data['rows'] = $this->gallery_tbl->viewAlbums($id,1,$id);
		//print_r($data['s_details']);exit;
		
		if($this->userId==$id){
			$data['left_nav'] = 'common/left_nav';
			$data['active_tab'] = '0';
		}
		else{
			$data['left_nav'] = 'profile/profile_image';
			$data['active_tab'] = '2';
		}
		$data['right_nav'] = 'profile/profile_relations';
		$data['long_right'] = true;
        $data['content_page'] =  'profile/player_gallery';
		
		$data['links_js_css']='players/links_js_css';
        $this->load->view('common/base_template', $data);
    }
/******************** CALENDAR FUNCTIONS *********************/
	
		 public function scheduler($id=0) {
	    $data['u_details']=$this->users_model->players_details($id);
		$sdata=$this->sports_model->listofmysports($id,0,3,'');
		$fdata=$this->users_model->listofmyplayers($id,0,3,'');
		$tdata=$this->teams_model->listofmyteams($id,$this->userId,0,3,'');
		$isfrd=$this->users_model->isfriend($id,$this->userId);
		$data['s_details']=$sdata['records'];
		$data['t_details']=$tdata['records'];
		$data['f_details']=$fdata['records'];
		$data['s_cnt']=$sdata['total'];
		$data['t_cnt']=$tdata['total'];
		$data['f_cnt']=$fdata['total'];
		$data['isfrd']=$isfrd;
		 $data['id']=$id;
		$data['active_tab'] =  '1';
		$data['content_page'] =  'cal/pr_scheduler';
		if($this->userId==$id){
			$data['left_nav'] = 'common/left_nav';
			$data['active_tab'] = '0';
		}
		else{
			$data['left_nav'] = 'profile/profile_image';
			$data['active_tab'] = '2';
		}
		  $data['right_nav'] = 'profile/profile_relations';
		$data['long_right'] = true;
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);
		

    }
	function datafeed($id=0){
		$ret = array();
		//$id=$_POST["id"];
		$info=listCalendar($_POST["showdate"], $_POST["viewtype"]);
		  $ret['events'] = array();
		  $ret["issort"] =true;
		  $ret["start"] = php2JsTime($info['st']);
		  $ret["end"] = php2JsTime($info['et']);
		  $ret['error'] = null;
	 	$data['u_details']=$this->users_model->players_details($id);
		$user_calender_events=$this->users_model->get_user_calender_events($id,$info['st'],$info['et']);
		$parsed_events=array();
		$editable=0;
		if($this->userId==$id){
			$editable=1;
		}
		if(count($user_calender_events)>0){
			foreach($user_calender_events as $k=>$v){
			if($v->schedule_type=='2'){
				$description=$this->users_model->scheduleUsers($v->id);
			}else{
				$description=$v->description;
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
	function scheduler_back($id=0){
	$data['u_details']=$this->users_model->players_details($id);
		$sdata=$this->sports_model->listofmysports($id,0,3,'');
		$fdata=$this->users_model->listofmyplayers($id,0,3,'');
		$tdata=$this->teams_model->listofmyteams($id,$this->userId,0,3,'');
		$isfrd=$this->users_model->isfriend($id,$this->userId);
		$data['s_details']=$sdata['records'];
		$data['t_details']=$tdata['records'];
		$data['f_details']=$fdata['records'];
		$data['s_cnt']=$sdata['total'];
		$data['t_cnt']=$tdata['total'];
		$data['f_cnt']=$fdata['total'];
		$data['isfrd']=$isfrd;
		$data['id']=$id;
		$user_calender_events=$this->users_model->get_user_calender_events($id);
		$parsed_events=array();
		if(count($user_calender_events)>0){
			foreach($user_calender_events as $k=>$v){
			if($v->schedule_type=='2'){
				$description=$this->users_model->scheduleUsers($v->id);
			}else{
				$description=$v->description;
			}
				if($v->start_date==$v->end_date){
				$allday=true;
				}else{
					$allday=false;
				}
				$event=array(
					'id' => $v->id,
					'title' => $description,
					'start' => date('Y-m-d H:i',strtotime($v->start_date)),//dateFormat($v->start_date, 'Y-m-d'),
					'end' => date('Y-m-d H:i',strtotime($v->end_date)),//dateFormat($v->end_date, 'Y-m-d')
					'allDay' => $allday//dateFormat($v->end_date, 'Y-m-d')
				);
				$parsed_events[]=$event;
			}
		}
		$data['user_calender_events']=$parsed_events;
		$data['active_tab'] =  '1';
		$data['content_page'] =  'profile/scheduler';
		if($this->userId==$id){
			$data['left_nav'] = 'common/left_nav';
			$data['active_tab'] = '0';
		}
		else{
			$data['left_nav'] = 'profile/profile_image';
			$data['active_tab'] = '2';
		}
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);
	}
	 function galimages($uid=0,$id=0){
	    $data['u_details']=$this->users_model->players_details($uid);
		$sdata=$this->sports_model->listofmysports($uid,0,3,'');
		$fdata=$this->users_model->listofmyplayers($uid,0,3,'');
		$tdata=$this->teams_model->listofmyteams($uid,$this->userId,0,3,'');
		$isfrd=$this->users_model->isfriend($uid,$this->userId);
		$data['s_details']=$sdata['records'];
		$data['t_details']=$tdata['records'];
		$data['f_details']=$fdata['records'];
		$data['s_cnt']=$sdata['total'];
		$data['t_cnt']=$tdata['total'];
		$data['f_cnt']=$fdata['total'];
		$data['isfrd']=$isfrd;
		$data['id']=$uid;
	 	$data['info'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
		$data['rows'] = $this->gallery_tbl->showGalImages($id);
		//$data['content_page'] = 'players/galleryimage_view.php';
		if($this->userId==$uid){
			$data['left_nav'] = 'common/left_nav';
			$data['active_tab'] = '0';
		}
		else{
			$data['left_nav'] = 'profile/profile_image';
			$data['active_tab'] = '2';
		}
		$data['right_nav'] = 'profile/profile_relations';
		$data['long_right'] = true;
		$data['content_page'] = 'profile/albums_images.php';
		$data['links_js_css']='players/links_js_css';
		$this->load->view('common/base_template', $data);
	  
	  } 
}

?>
