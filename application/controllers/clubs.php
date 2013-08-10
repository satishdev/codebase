<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clubs extends MY_Controller {

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
		if($this->userType!=3){	
			redirect('login');
		}
		$this->load->model('clubs_model');
		$this->load->model('gallery_model','gallery_tbl');
		$this->load->model('users_model');
		$this->load->library('pagination');
		$this->load->model('schedule_model');
		session_check();
    }

   function index() {
        $data['u_details']=$this->clubs_model->club_details($this->userId);
		$data['active_tab'] = '0';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
        $data['content_page'] =  'clubs/profile';
		$data['links_js_css']='clubs/links_js_css';
        $this->load->view('common/base_template', $data);
    }
	function edit() {
        $data['u_details']=$this->clubs_model->club_details($this->userId);
		if($this->input->post('submit')){
		   $_POST['id']=$this->clubId;
		  // print_r($_POST);exit;
		  $_POST['created_by']=$this->userId;
			$this->my_db_lib->save_record($this->input->post(),'clubs');
			$_POST['id']=$this->userId;
			$this->my_db_lib->save_record($this->input->post(),'players');
			$cdId=$this->clubs_model->club_dimensions_id($this->clubId);
			$_POST['clubs_id']=$this->clubId;
			if($cdId)
			$_POST['id']=$cdId;
			else
			unset($_POST['id']);
			$this->my_db_lib->save_record($this->input->post(),'club_dimensions');
			$this->db_session->set_flashdata('msg', '<div class="success">Successfully updated </div>');
			redirect('clubs');
		}else{
			$data['content_page'] =  'clubs/edit';
			$data['active_tab'] = '1';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }
	function editinfo() {
        $data['u_details']=$this->clubs_model->club_details($this->userId);
		if($this->input->post('submit')){
			$_POST['id']=$this->userId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'players');
			$this->db_session->set_flashdata('msg', '<div class="success">Successfully updated </div>');
			redirect('clubs');
		}else{
			$data['content_page'] =  'clubs/editinfo';
			$data['active_tab'] = '1';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }
	function add_facilities() {
		if($this->input->post('submit')){
			$facility_exists = $this->clubs_model->check_club_facility($_POST['name'], $this->clubId);
			if($facility_exists == 0){
				$facilities_id=$this->my_db_lib->save_record($this->input->post(),'facilities');
				unset($_POST);
				$_POST['created_by']=$this->userId;
				$_POST['clubs_id']=$this->clubId;
				$_POST['facilities_id']=$facilities_id;
				$this->my_db_lib->save_record($this->input->post(),'club_facilities');
				$this->db_session->set_flashdata('msg', '<div class="success">Facility created Successfully</div>');			
			}else{
				$this->db_session->set_flashdata('msg', '<div class="error">Facility already exists for this club</div>');
			}
			redirect('clubs/add_facilities');
		}else{
			$data['content_page'] =  'clubs/add_facilities';
			$data['active_tab'] = '4';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		}
	}
	function edit_facilities($id=0) {
		if($this->input->post('submit')){
			$facility_exists =0;// $this->clubs_model->check_club_facility($_POST['name'], $this->clubId);
			if($facility_exists == 0){
				$facilities_id=$this->my_db_lib->save_record($this->input->post(),'facilities');
				
				$this->db_session->set_flashdata('msg', '<div class="success">Facility updated Successfully</div>');			
			}else{
				$this->db_session->set_flashdata('msg', '<div class="error">Facility already exists for this club</div>');
			}
			redirect('clubs/edit_facilities/'.$_POST['id']);
		}else{
		$row=$this->clubs_model->club_facility_details($id,$this->clubId);
		if($row){
		    $data['f_data'] =$row;
			$data['content_page'] =  'clubs/edit_facilities';
			$data['active_tab'] = '4';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
			}else{
			echo "error page";
			}
		}
	}
	function delete_facilities($id=0) {
		$this->clubs_model->delete_club_facility($id, $this->clubId);
		$this->db_session->set_flashdata('msg', '<div class="success">Facility deleted Successfully</div>');			
		redirect('clubs/list_facilities');
	}
	function list_facilities() {
		$rec=$this->clubs_model->list_facilities($this->clubId,0,10,'',$search='');
		$config['total_rows'] = $rec['total'];
		$data['club_data']=$rec['records'];
		$data['total']=$rec['total'];
		$this->pagination->initialize($config);
		$data['content_page'] =  'clubs/list_facilities';
		$data['active_tab'] = '4';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
    }
	
	function add_holidays() {
		if($this->input->post('submit')){
			$holiday_exists = $this->clubs_model->check_club_holiday($_POST['name'], $_POST['holiday_date'], $this->clubId);
			if($holiday_exists == 0){
				$_POST['created_by']=$this->userId;
				$_POST['clubs_id']=$this->clubId;
				$this->my_db_lib->save_record($this->input->post(),'club_holidays');
				$this->db_session->set_flashdata('msg', '<div class="success">Holiday created Successfully</div>');
			}else{
				$this->db_session->set_flashdata('msg', '<div class="error">Holiday already exists</div>');
			}
			redirect('clubs/add_holidays');
		}else{
			$data['content_page'] =  'clubs/add_holidays';
			$data['active_tab'] = '5';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }
	function delete_holidays($id=0) {
	
			 $this->clubs_model->delete_club_holiday($id, $this->clubId);
			 $this->db_session->set_flashdata('msg', '<div class="success">Holiday deleted Successfully</div>');
			redirect('clubs/list_holidays');
		
    }
	function edit_holidays($id=0) {
		if($this->input->post('submit')){
			//$holiday_exists = $this->clubs_model->check_club_holiday($_POST['name'], $_POST['holiday_date'], $this->clubId);
			if($holiday_exists == 0){
				$_POST['modified_by']=$this->userId;
				$_POST['clubs_id']=$this->clubId;
				$this->my_db_lib->save_record($this->input->post(),'club_holidays');
				$this->db_session->set_flashdata('msg', '<div class="success">Holiday updated Successfully</div>');
			}else{
				$this->db_session->set_flashdata('msg', '<div class="error">Holiday already exists</div>');
			}
			redirect('clubs/edit_holidays/'.$_POST['id']);
		}else{
			$row = $this->clubs_model->club_holiday_details($id, $this->clubId);
			if($row){
			$data['h_data'] = $row;
			$data['content_page'] =  'clubs/edit_holidays';
			$data['active_tab'] = '5';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
			}else{
			echo "error page";
			}
		}
    }
	function list_holidays() {
        $rec=$this->clubs_model->list_holydays($this->clubId,0,10,'',$search='');
		$config['total_rows'] = $rec['total'];
		$data['club_data']=$rec['records'];
		$data['total']=$rec['total'];
		$this->pagination->initialize($config);
		$data['content_page'] =  'clubs/list_holidays';
		$data['active_tab'] = '5';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
    }
	
	function add_news() {
		if($this->input->post('submit')){
			$_POST['created_by']=$this->userId;
			$_POST['clubs_id']=$this->clubId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'club_news');
			$this->db_session->set_flashdata('msg', '<div class="success">News created Successfully</div>');
			redirect('clubs/add_news');
		}else{
			$data['content_page'] =  'clubs/add_news';
			$data['active_tab'] = '6';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }
	
	function edit_news($id=0) {
		if($this->input->post('submit')){
			$_POST['modified_by']=$this->userId;
			$_POST['clubs_id']=$this->clubId;
			$player_id=$this->my_db_lib->save_record($this->input->post(),'club_news');
			$this->db_session->set_flashdata('msg', '<div class="success">News updated Successfully</div>');
			redirect('clubs/edit_news/'.$_POST['id']);
		}else{
			$row = $this->clubs_model->club_news_details($id, $this->clubId);
			if($row){
			$data['n_data'] =  $row;
			$data['content_page'] =  'clubs/edit_news';
			$data['active_tab'] = '6';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
			}else{
			echo "error page";
			}
		}
    }
	function delete_news($id=0) {
			$this->clubs_model->delete_club_news($id, $this->clubId);
			$this->db_session->set_flashdata('msg', '<div class="success">News deleted Successfully</div>');
			redirect('clubs/add_news');
		
    }
	function list_news() {
        $rec=$this->clubs_model->list_news($this->clubId,0,10,'',$search='');
		$config['total_rows'] = $rec['total'];
		$data['club_data']=$rec['records'];
		$data['total']=$rec['total'];
		$this->pagination->initialize($config);
		$data['content_page'] =  'clubs/list_news';
		$data['active_tab'] = '6';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
    }
	
	function add_teams(){
		$data['content_page'] =  'clubs/add_teams';
		$data['active_tab'] = '2';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
	}
	
	function search_teams(){
		$data = $this->clubs_model->search_teams($_POST['search'], 0, 10);
		echo json_encode($data);
	}
	
	function add_sports(){
		$data['content_page'] =  'clubs/add_sports';
		$data['active_tab'] = '3';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
		
	}
	
	function search_sports(){
		$data = $this->clubs_model->search_sports($_POST['search'], 0, 10);
		echo json_encode($data);
	}
	
	function imageupload(){
	
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
				createThumbnail($data['file_name']);
				//$opt->logo=$data['file_name'];
			 	$_POST['id']=$this->userId;
			 	$_POST['image']=$data['file_name'];
		  		$player_id=$this->my_db_lib->save_record($this->input->post(),'players');
			}
		
		redirect('clubs');
		}
		else{				
				$data['left_nav'] =  'common/left_nav_cl.php';
				$data['active_tab'] = '0';
				$data['right_nav'] =  'common/ads.php';
				$data['content_page'] =  'clubs/imageupload';
				$data['links_js_css']='clubs/links_js_css';
				$this->load->view('common/base_template', $data);
		}
	}
	 function gallery(){
	  $data['rows'] = $this->gallery_tbl->viewAlbums($this->userId,3,$this->userId);
		//$data['content_page'] = 'players/gallery_view.php';
		$data['active_tab'] = '1';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/albums.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
	  
	  }
	  function galimages($id=0){
	 	$data['info'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
		$data['rows'] = $this->gallery_tbl->showGalImages($id);
		//$data['content_page'] = 'players/galleryimage_view.php';
		$data['active_tab'] = '1';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/albums_images.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
	  
	  } 
	  
	  function addgalleryimage($id=0){
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
				redirect('clubs/addgalleryimage/'.$_POST['id']);
				exit();
			}
			
			$fname = $_FILES['filename']['name'];
			$ext = strtolower(substr($fname, strrpos($fname,'.')+1));
			$md5Date = Date("Y_m_d_H_i_s");
			$newname = $md5Date.'.'.$ext;
			$thumbname = $md5Date.'_thumb.'.$ext;
			$name = basename($_FILES['filename']['name']);
			if ($ext!="jpg"&&$ext&&"jpeg"&&$ext!="png"&&$ext!="gif") {
				redirect('gallery/images/'.$_POST['id']);
			}
			$uploadImage = './uploads/'.$newname;
			write_file($uploadImage, $file);
			$this->_al_imageupload();
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Gallery created </div>');
			
				redirect('clubs/gallery');
			}
			}else{
			$data['info'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
			$data['active_tab'] = '1';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'clubs/add_albumimage.php';
 			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		  } 
	  }
	  function editgalleryimage($id=0){
	    if($this->input->post()){
		   if($this->input->post('img_id')!=''){
		  // $_POST['created_by']=$this->userId;
				$id=$this->gallery_tbl->updategalImage();
				if($id){
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Image updated </div>');
				}else{
					$this->db_session->set_flashdata('msg', '<div class="error">The Gallery Image update Fail</div>');
				}
				redirect('clubs/editgalleryimage/'.$this->input->post('img_id'));
			}
			}else{
			$data['rows'] = $this->gallery_tbl->galparticularImage($id);
			$data['active_tab'] = '1';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'clubs/edit_albumimage.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		  } 
	   }
	  function viewgallery($id=0){
	  $data['rows'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
		//$this->load->view('gallery/gallery_view', $data);
		$data['active_tab'] = '1';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'clubs/gallery_details.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
	  
	  } 
	  function addgallery(){
		 if($this->input->post()){
		   if($this->input->post('name')!=''){
		   $_POST['created_by']=$this->userId;
		    $_POST['related_id']=$this->userId;
			 $_POST['gallery_type']=3;
				$id=$this->gallery_tbl->insertGallery();
				if($id!=0){
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Gallery created </div>');
				}else{
					$this->db_session->set_flashdata('msg', '<div class="error">The Gallery name already Exist</div>');
				}
				redirect('clubs/gallery');
			}
			}else{
			$data['active_tab'] = '1';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'clubs/add_album.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		  } 
	  }
	   function updategallery($id=0){
		 if($this->input->post()){
		   if($this->input->post('name')!='' and $this->input->post('id')!=''){
		   //$_POST['created_by']=$this->userId;
				$this->my_db_lib->save_record($_POST,'albums');
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Gallery updated </div>');
				redirect('clubs/updategallery/'.$this->input->post('id'));
			}
			}else{
			$data['rows'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
			$data['active_tab'] = '1';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'clubs/update_album.php';
			$data['links_js_css']='clubs/links_js_css';
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
		 public function scheduler() {
	    $data['u_details']=$this->users_model->players_details($this->userId);
		$data['active_tab'] =  '1';
		$data['content_page'] =  'cal/club_scheduler';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		   $data['right_nav'] =  'common/ads.php';
		   $data['links_js_css']='clubs/links_js_css';
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
	function scheduler_back(){
		$user_calender_events=$this->users_model->get_user_calender_events($this->userId);
		$parsed_events=array();
		if(count($user_calender_events)>0){
			foreach($user_calender_events as $k=>$v){
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
		$data['content_page'] =  'clubs/scheduler';
		$data['left_nav'] =  'common/left_nav_cl.php';
		$data['links_js_css']='clubs/links_js_css';
		$this->load->view('common/base_template', $data);
	}
function save_event(){
		$post=$this->input->post();
		if($post){
			$post['players_id']=$this->userId;
			$post['created_by']=$this->userId;
			$post['start_date']=date('Y-m-d H:i:s',strtotime($post['CalendarStartTime']));
			$post['end_date']=date('Y-m-d H:i:s',strtotime($post['CalendarEndTime']));
			$post['name']=$post['CalendarTitle'];
			$post['description']=$post['CalendarTitle'];
			$post['isalldayevent']=$post['IsAllDayEvent'];
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

	function add_courts(){
		if($this->input->post('submit')){
		   $_POST['clubs_id']=$this->clubId;
		  // print_r($_POST);exit;
		  $_POST['created_by']=$this->userId;
			$court_id=$this->my_db_lib->save_record($this->input->post(),'courts');
			$_POST['courts_id']=$court_id;
			$this->my_db_lib->save_record($this->input->post(),'court_dimensions');
			$this->db_session->set_flashdata('msg', '<div class="success">Successfully created </div>');
			redirect('clubs/list_courts');
		}else{
			$data['s_data'] = $this->clubs_model->clubsSports($this->clubId);
			$data['content_page'] =  'clubs/add_courts';
			$data['active_tab'] = '7';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		}
		}
		
	function list_courts(){
		
			$data['content_page'] =  'clubs/list_courts';
			$data['active_tab'] = '7';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
		}
function courts_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="SELECT crt.id,crt.name,crt.court_no,crt.start_date,crt.end_date,s.name as sname,ct.name as ctname
				FROM courts AS crt
				INNER JOIN court_dimensions AS crtd ON crt.id=crtd.courts_id
				INNER JOIN clubs AS clb ON crt.clubs_id=clb.id
				LEFT JOIN sports AS s ON crt.sports_id=s.id
				LEFT JOIN court_types AS ct ON crt.court_types_id=ct.id
				WHERE clb.id='".$this->clubId."'";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $data->rows[$i]['cell']=array(
                                            '<div><a href="'.site_url('clubs/court_view/'.$v['id']).'" style="display: block;">'.$v['name'].'</a></div>',
											 '<div><a href="'.site_url('clubs/edit_courts/'.$v['id']).'" style="display: block;">'.$v['court_no'].'</a></div>',
											  '<div>'.$v['sname'].'</div>',
											   '<div>'.$v['ctname'].'</div>',
                                            '<div>'.$v['start_date'].' - '.$v['end_date'].'</div>'
                                        );
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No Courts Found','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }
    }
	function edit_courts($id=0){
		if($this->input->post('submit')){
		  
			$court_id=$this->my_db_lib->save_record($this->input->post(),'courts');
			$_POST['id']=$_POST['cd_id'];
			$this->my_db_lib->save_record($this->input->post(),'court_dimensions');
			$this->db_session->set_flashdata('msg', '<div class="success">Successfully updated </div>');
			redirect('clubs/list_courts');
		}else{
			$row = $this->clubs_model->courts_details($id,$this->clubId);
			if($row){
			$data['c_data'] = $row;
			$data['s_data'] = $this->clubs_model->clubsSports($this->clubId);
			$data['content_page'] =  'clubs/edit_courts';
			$data['active_tab'] = '7';
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['links_js_css']='clubs/links_js_css';
			$this->load->view('common/base_template', $data);
			}else{
			echo "error page";
			}
		}
		}
	function club_users($pagenumber=0){
		$config['base_url'] = site_url('clubs/club_users');
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
		$rec=$this->clubs_model->clubUsers($this->clubId,$pagenumber,100,$serchKey);
		$config['total_rows'] = $rec['total'];
		$data['sports_data']=$rec['records'];
		$this->pagination->initialize($config);
		
		$data['plrelation'] = json_encode($this->users_model->friendsrelations());
		$data['active_tab'] = '8';
	    $data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php'; 
        $data['content_page'] = 'clubs/clubs_users.php';
		$data['links_js_css']='clubs/links_js_css';
        $this->load->view('common/base_template', $data);
      }
}

?>
