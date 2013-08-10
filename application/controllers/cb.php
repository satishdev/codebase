<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CB extends MY_Controller {

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
		$this->load->model('clubs_model');
		$this->load->model('gallery_model','gallery_tbl');
		$this->load->model('users_model');
		$this->load->model('teams_model');
		$this->load->library('pagination');
		session_check();
    }

  /* function index() {
       $data['active_tab'] = '1';
		$data['left_nav'] =  'clubs/club_left_search.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/add_club.php';
		$this->load->view('common/base_template', $data);
    }*/
	 function clubs($pagenumber=0) {
	   $cname='';
	    $zip='';
	   if(isset($_POST['cname'],$_POST['zip'])){
	    $cname=$_POST['cname'];
	    $zip=$_POST['zip'];
	   }
       $data['active_tab'] = '6';
	   $records=$this->clubs_model->clublists($this->userId,$pagenumber=0,100,$cname,$zip);
	  	$data['club_data']=$records['records'];
		$data['total']=$records['total'];
		$data['cname']=$cname;
		$data['zip']=$zip;
		$data['left_nav'] =  'clubs/club_left_search.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/clubs.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
    }
	function allclubs($pagenumber=0) {
	   $cname='';
	    $zip='';
	   if(isset($_POST['serchKey'])){
	    $cname=$_POST['serchKey'];
	    $zip=$_POST['serchKey'];
	   } $data['active_tab'] = '6';
	   $records=$this->clubs_model->clublists($this->userId,$pagenumber=0,100,$cname,$zip);
	  	$data['club_data']=$records['records'];
		$data['total']=$records['total'];
		$data['cname']=$cname;
		$data['zip']=$zip;
		$data['left_nav'] =  'common/left_nav.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/allclubs.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
    }
	function add_club(){
		$data['active_tab'] = '1';
		$data['left_nav'] =  'clubs/club_left_search.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/add_club.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
	}
	
	function club_info($id=0){
	 	$row=$this->clubs_model->clubDetails($id,$this->userId);
		if($row){
		$cname='';
	    $zip='';
		$data['c_data']=$row;
		$data['sp_data']=$this->clubs_model->clubsSports($id,6);
		$teams=$this->teams_model->listofmyteamsOfCourts($id,0,6,'');
		$data['team_data']=$teams['records'];
		//$data['court_data']=$this->clubs_model->courts_list($id,6);
		$memb_data=$this->clubs_model->clubUsers($id,0,6);
		$data['memb_data']=$memb_data['records'];
		$data['f_data']=$this->clubs_model->list_facilities($id,0,100,'','',1);
		$data['h_data']=$this->clubs_model->list_holydays($id,0,100,'','',1);
		$data['n_data']=$this->clubs_model->list_news($id,0,100,'','',1);
		$data['crts_data']=$this->clubs_model->courts_list($id);
		$data['cname']=$cname;
		$data['zip']=$zip;
		 $data['active_tab'] = '6';
		$data['long_right'] = true;
		$data['left_nav'] =  'clubs/club_left.php';
		$data['right_nav'] =  'clubs/club_relations.php';
		$data['content_page'] = 'clubs/club_info.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
		}else{
		echo "error page";
		
		}
	}
	/*function club_info($id=0){
	 	$row=$this->clubs_model->clubDetails($id,$this->userId);
		if($row){
		$cname='';
	    $zip='';
		$data['c_data']=$row;
		$data['f_data']=$this->clubs_model->list_facilities($id,0,100,'','',1);
		$data['h_data']=$this->clubs_model->list_holydays($id,0,100,'','',1);
		$data['n_data']=$this->clubs_model->list_news($id,0,100,'','',1);
		$data['crts_data']=$this->clubs_model->courts_list($id);
		$data['cname']=$cname;
		$data['zip']=$zip;
		 $data['active_tab'] = '6';
		$data['left_nav'] =  'clubs/club_left_search.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/club_info.php';
		$this->load->view('common/base_template', $data);
		}else{
		echo "error page";
		
		}
	}*/
function joincb(){
		
			if($this->input->post('sid')){
				$_POST['players_id']=$this->userId;
				$_POST['clubs_id']=$_POST['sid'];
				if($this->input->post('selected')==0){
					$num=$this->clubs_model->checkClb($_POST['sid'],$this->userId);
					if($num==0){
						$this->my_db_lib->save_record($this->input->post(),'club_players');
						echo 0;
					}else{
						echo 1;
					}
				}else{
					$this->clubs_model->removeClb($_POST['sid'],$_POST['players_id']);
					echo 1;
				}
			}
	
	}

function clubinfo($id=0){
	 	$row=$this->clubs_model->clubDetails($id,$this->userId);
		if($row){
		$cname='';
	    $zip='';
		$data['c_data']=$row;
		$data['f_data']=$this->clubs_model->list_facilities($id,0,100,'','',1);
		$data['h_data']=$this->clubs_model->list_holydays($id,0,100,'','',1);
		$data['n_data']=$this->clubs_model->list_news($id,0,100,'','',1);
		$data['u_data']=$this->clubs_model->clubUsers($id,0,6);
		$data['crts_data']=$this->clubs_model->courts_list($id);
		$data['cname']=$cname;
		$data['zip']=$zip;
		 $data['active_tab'] = '6';
		$data['left_nav'] =  'clubs/club_left_search.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/club_info.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
		}else{
		echo "error page";
		
		}
	}	
	function scheduler($id=0){
	
	$row=$this->clubs_model->clubDetails($id,$this->userId);
		if($row){
			$user_calender_events=$this->users_model->get_user_calender_events($row->plid);
		$parsed_events=array();
		if(count($user_calender_events)>0){
			foreach($user_calender_events as $k=>$v){
				$event=array(
					'id' => $v->id,
					'title' => $v->description,
					'start' => date('Y-m-d H:i',strtotime($v->start_date)),//dateFormat($v->start_date, 'Y-m-d'),
					'end' => date('Y-m-d H:i',strtotime($v->end_date))//dateFormat($v->end_date, 'Y-m-d')
				);
				$parsed_events[]=$event;
			}
		}
		
		$cname='';
	    $zip='';
		$data['c_data']=$row;
		$data['sp_data']=$this->clubs_model->clubsSports($id,6);
		$teams=$this->teams_model->listofmyteamsOfCourts($id,0,6,'');
		$data['team_data']=$teams['records'];
		//$data['court_data']=$this->clubs_model->courts_list($id,6);
		$memb_data=$this->clubs_model->clubUsers($id,0,6);
		$data['memb_data']=$memb_data['records'];
		$data['user_calender_events']=$parsed_events;
		 $data['active_tab'] = '6';
		$data['long_right'] = true;
		$data['left_nav'] =  'clubs/club_left.php';
		$data['right_nav'] =  'clubs/club_relations.php';
		//$data['content_page'] = 'clubs/club_info.php';
		$data['content_page'] =  'clubs/scheduler';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
		
		}else{
		echo "error page";
		
		}
	
		
	}
	
	function gallery($id=0){
	
	$row=$this->clubs_model->clubDetails($id,$this->userId);
		if($row){
		$cname='';
	    $zip='';
		$data['c_data']=$row;
		 $data['rows'] = $this->gallery_tbl->viewAlbums($row->plid,3,$row->plid);
		$data['sp_data']=$this->clubs_model->clubsSports($id,6);
		$teams=$this->teams_model->listofmyteamsOfCourts($id,0,6,'');
		$data['team_data']=$teams['records'];
		//$data['court_data']=$this->clubs_model->courts_list($id,6);
		$memb_data=$this->clubs_model->clubUsers($id,0,6);
		$data['memb_data']=$memb_data['records'];
		
		$data['cname']=$cname;
		$data['zip']=$zip;
		 $data['active_tab'] = '6';
		$data['left_nav'] =  'clubs/club_left.php';
		$data['long_right'] = true;
		$data['right_nav'] =  'clubs/club_relations.php';
		$data['content_page'] = 'clubs/cb_albums.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
		}else{
		echo "error page";
		
		}
	  }
	  function galimages($id=0,$im_id=0){
	  $row=$this->clubs_model->clubDetails($id,$this->userId);
		if($row){
		$data['info'] = $this->gallery_tbl->viewParticularGallery($im_id,$this->userId);
		$data['rows'] = $this->gallery_tbl->showGalImages($im_id);
		
		$data['c_data']=$row;
		$data['sp_data']=$this->clubs_model->clubsSports($id,6);
		$teams=$this->teams_model->listofmyteamsOfCourts($id,0,6,'');
		$data['team_data']=$teams['records'];
		//$data['court_data']=$this->clubs_model->courts_list($id,6);
		$memb_data=$this->clubs_model->clubUsers($id,0,6);
		$data['memb_data']=$memb_data['records'];
		 $data['active_tab'] = '6';
		$data['left_nav'] =  'clubs/club_left.php';
		$data['long_right'] = true;
		$data['right_nav'] =  'clubs/club_relations.php';
		$data['content_page'] = 'clubs/cb_albums_images.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
		}else{
		echo "error page";
		
		}
	  } 
}

?>
