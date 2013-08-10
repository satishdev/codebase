<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams extends MY_Controller {

    function __construct() {
		// Call the Parent constructor
		parent::__construct();
		
		$this->load->model('teams_model');
		$this->load->model('users_model');
		$this->load->library('pagination');
		$this->load->model('schedule_model');
		$this->load->library('form_validation');
		$this->load->model('gallery_model','gallery_tbl');
		session_check();
    }

    public function allteams($pagenumber=0) {	
		$config['base_url'] = site_url('teams/allteams');
		$config['per_page'] = '10'; 
		$config['uri_segment'] = '3'; 
		//$pagenumber=0;
		$config['full_tag_open'] = '<div class="page_box fl">';
		$config['full_tag_close'] = '</div>';
		if(isset($_REQUEST['serchKey']) and trim($_REQUEST['serchKey'])!='Search...'){
			$serchKey=trim($_REQUEST['serchKey']);
		}else{
			$serchKey='';
		}
		
		$rec=$this->teams_model->listofteams($this->userId,$pagenumber,10,$serchKey);
		$config['total_rows'] = $rec['total'];
		$this->pagination->initialize($config);
		
		$data['sports_data']=$rec['records'];
		$data['total']=$rec['total'];
		if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'teams/view.php';
		$data['links_js_css']='teams/links_js_css';
		$this->load->view('common/base_template', $data);
    }
	
	 public function myteams($pagenumber=0) {	
		$config['base_url'] = site_url('teams/myteams');
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
		 	$this->db_session->set_userdata('tmyserchKey',$serchKey);
		 }
		 if($this->userType==2){
			$rec=$this->teams_model->listofmyteams($this->userId,$this->userId,$pagenumber,10,$serchKey);
		}else if($this->userType==3){
			$rec=$this->teams_model->listofmyteamsOfCourts($this->clubId,$pagenumber,10,$serchKey);
		}
		$config['total_rows'] = $rec['total'];
		$data['sports_data']=$rec['records'];
		$data['total']=$rec['total'];
		$this->pagination->initialize($config);
				if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
        $data['content_page'] = 'teams/myteams.php';
		$data['links_js_css']='teams/links_js_css';
        $this->load->view('common/base_template', $data);
    }
	
public function jointm() {
	if($this->input->post('tid')){
		 	$_POST['players_id']=$this->userId;
			$_POST['teams_id']=$_POST['tid'];
			if($this->input->post('selected')==0){
				$num=$this->teams_model->checkTm($_POST['tid'],$this->userId);
				if($num==0){
					$_POST['is_approved']='0';
					$_POST['team_player_relations_id']='2';
					$_POST['created_by']=$this->userId;
					$tid=$this->my_db_lib->save_record($this->input->post(),'player_teams');
					$this->users_model->team_request($_POST['teams_id'],$this->userId);
					echo 0;
				}else{
					echo 1;
				}
			}else if($this->input->post('selected')==1){
					$this->teams_model->removeTeam($_POST['tid'],$_POST['pid']);
					echo 1;
			}else if($this->input->post('selected')==2){
					$this->teams_model->approveTeam($_POST['tid'],$this->userId);
					$this->users_model->team_request_accept($_POST['teams_id'],$this->userId);
					echo 2;
			}
			
		}
    }
	function add_teams() {
	// Validation rules matches[passconf]
		$validation = array(
					
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|required|max_length[50]|callback__teamname_check'
			),
			array(
				'field' => 'sports_id',
				'label' => 'Sports Name',
				'rules' => 'required'
			),
			array(
				'field' => 'city',
				'label' => 'City',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'level_id',
				'label' => 'Expertise Level',
				'rules' => 'trim|required',
			)
		);
			// Set the validation rules
			$this->form_validation->set_rules($validation);
		if($this->input->post('submit')){
		  //print_r($_POST);exit;
			if ($this->form_validation->run())
			{
		 	$_POST['user_id']=$this->userId;
			//$num=$this->teams_model->checkTmName($this->input->post('name'));
			//if($num==0){
				$_POST['created_by']=$this->userId;
				if($_POST['level_id']=='custom'){
					if(isset($_POST['recommend']))
						$reco=$_POST['recommend'];
					else
						$reco=2;
					$lid=$this->teams_model->addLevel($_POST['custom_name'],$reco);
					$_POST['level_id']=$lid;
				}
				$tid=$this->my_db_lib->save_record($this->input->post(),'teams');
				if($this->userType==2){	
					unset($_POST);
							$_POST['players_id']=$this->userId;
							$_POST['teams_id']=$tid;
							$_POST['is_approved']='1';
							$_POST['team_player_relations_id']='1';
							$_POST['created_by']=$this->userId;
							$this->my_db_lib->save_record($this->input->post(),'player_teams');
					}else if($this->userType==3){
							$_POST['clubs_id']=$this->clubId;
							$_POST['teams_id']=$tid;
							$_POST['club_team_relations_id']='1';
						    $this->my_db_lib->save_record($this->input->post(),'club_teams');
					}
				$this->_imageupload($tid);
				$this->db_session->set_flashdata('msg', '<div class="success">Successfully team created </div>');
				redirect('teams/viewteam/'.$tid);
				/*}else{
					$this->db_session->set_flashdata('msg', '<div class="error">"'.validation_errors().'"</div>');
					redirect('teams/add_teams');
				}*/
			}else{
					$this->db_session->set_flashdata('msg', '<div class="error">'.validation_errors().'</div>');
					redirect('teams/add_teams');
			
			}
			
		}else{
			$data['user_id'] = $this->userId;
					if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
			if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] =  'teams/add_teams';
			$data['links_js_css']='teams/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }
	/**
	 * team name check
	 *
	 * @param string $name The email to check.
	 *
	 * @return bool
	 */
	public function _teamname_check($name)
	{
		if ($this->teams_model->teamname_check($name,$this->input->post('city')))
		{
			$this->form_validation->set_message('_teamname_check', "The Team name '".$name."' is already use in the city");
			return false;
		}

		return true;
	}
	/**
	 * team name check
	 *
	 * @param string $name The email to check.
	 *
	 * @return bool
	 */
	public function _teamname_check_update($name)
	{
		if ($this->teams_model->teamname_check($name,$this->input->post('city'),$this->input->post('id')))
		{
			$this->form_validation->set_message('_teamname_check_update', "The Team name '".$name."' is already use in the city");
			return false;
		}

		return true;
	}
function edit_teams($id=0) {
// Validation rules matches[passconf]
		$validation = array(
					
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|required|max_length[50]|callback__teamname_check_update'
			),
			array(
				'field' => 'sports_id',
				'label' => 'Sports Name',
				'rules' => 'required'
			),
			array(
				'field' => 'city',
				'label' => 'City',
				'rules' => 'trim|required',
			),
			array(
				'field' => 'level_id',
				'label' => 'Expertise Level',
				'rules' => 'trim|required',
			)
		);
			// Set the validation rules
			$this->form_validation->set_rules($validation);
		if($this->input->post('submit')){
		 	//$_POST['user_id']=$this->userId;
			// $num=$this->teams_model->checkTmName($this->input->post('name'),$this->input->post('id'));
			if ($this->form_validation->run())
			{
				//$_POST['created_by']=$this->userId;
				$tid=$this->my_db_lib->save_record($this->input->post(),'teams');
				$this->_imageupload($this->input->post('id'));
			$this->db_session->set_flashdata('msg', '<div class="success">Successfully team updated </div>');
			}else{
			$this->db_session->set_flashdata('msg', '<div class="error">'.validation_errors().'</div>');
			}
				redirect('teams/edit_teams/'.$this->input->post('id'));
		}else{
			$data['team_data']=$this->teams_model->viewTeam($id,$this->userId);
			$data['t_details']=$this->teams_model->viewTeamProfile($id,$this->userId);
					if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
			if($this->userType==2)
			$data['left_nav'] =  'teams/profile_image';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] =  'teams/edit_teams';
			$data['links_js_css']='teams/links_js_css';
			$this->load->view('common/base_template', $data);
		}
    }
 function _imageupload($tid){
			
				if($tid){ 
					$config['upload_path'] = './images/teams/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
					$config['max_size']	= '1024';
					$this->load->library('upload', $config);
					if( ! $this->upload->do_upload('logo1'))
					{ 
						return false;
					}
					else
					{
						// Build a file array from all uploaded files
						$data =$this->upload->data();
						createThumbnail($data['file_name'],'./images/teams/');
						//$opt->logo=$data['file_name'];
						unset($_POST);
					 $_POST['id']=$tid;
					 $_POST['logo']=$data['file_name'];
			      	$player_id=$this->my_db_lib->save_record($this->input->post(),'teams');
					}
				
				return true;
				}
				
		 }
		  
		function viewteam($id=0){
		
			$data['t_details']=$this->teams_model->viewTeamProfile($id,$this->userId);
			$sdata=$this->teams_model->listofAllteamusers($id);
			
			//print_r($sdata);exit;
			$data['f_details']=$sdata['records'];
			$data['f_cnt']=$sdata['total'];
			$data['id']=$id;
			$data['num_t_users']=$this->teams_model->numofteamusers($id);
			$data['t_sprts']=$this->teams_model->teamschedule_spports($id);
			//print_r($data['f_details']);exit;
					if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
			$data['left_nav'] = 'teams/profile_image';
			$data['right_nav'] = 'teams/team_relations';
			$data['long_right'] = true;
			$data['content_page'] =  'teams/team_profiles';
			$data['links_js_css']='teams/links_js_css';
			$this->load->view('common/base_template', $data);
		}
	public function moreteams($id,$pagenumber=0) {
	$data['u_details']=$this->users_model->players_details($id);
	$data['id']=$id;
	$config['base_url'] = site_url('teams/moreteams/'.$id);
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
		 	$this->db_session->set_userdata('tmyserchKey',$serchKey);
		 }
		if($this->userType==2){
			$rec=$this->teams_model->listofmyteams($id,$this->userId,$pagenumber,10,$serchKey);
		}else if($this->userType==3){
			$rec=$this->teams_model->listofmyteamsOfCourts($this->clubId,$pagenumber,10,$serchKey);
		}
		$config['total_rows'] = $rec['total'];
		$data['sports_data']=$rec['records'];
		$data['total']=$rec['total'];
		$this->pagination->initialize($config);
				if($this->userType==2)
			$data['active_tab'] = '4';
			else
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
		 $data['content_page'] = 'teams/moreteams.php';
		 $data['links_js_css']='teams/links_js_css';
        $this->load->view('common/base_template', $data);
    }
	function teamusers($id=0,$pagenumber=0){
		$config['base_url'] = site_url('teams/teamusers');
		$config['per_page'] = '10'; 
		$config['uri_segment'] = '3'; 
		//$pagenumber=0;
		$config['full_tag_open'] = '<div class="page_box fl">';
		$config['full_tag_close'] = '</div>';
		$data['t_details']=$this->teams_model->viewTeamProfile($id,$this->userId);	
			$sdata=$this->teams_model->listofteamusers($id,$pagenumber,10,'');
			//print_r($sdata);exit;
			$config['total_rows'] = $sdata['total'];
			$data['sports_data']=$sdata['records'];
			$data['f_cnt']=$sdata['total'];
			$data['id']=$id;
			//print_r($data['f_details']);exit;
			 $data['content_page'] =  'teams/teamusers';
					if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['left_nav'] =  'teams/profile_image.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='teams/links_js_css';
			$this->load->view('common/base_template', $data);
		}	
		
	 function addgallery($id=0){
	 $data['t_details']=$this->teams_model->viewTeamProfile($id,$this->userId);
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
		    $_POST['gallery_type']=2;
				$id=$this->gallery_tbl->insertGallery();
				if($id!=0){
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Gallery created </div>');
				}else{
					$this->db_session->set_flashdata('msg', '<div class="error">The Gallery name already Exist</div>');
				}
				//redirect('teams/viewteam/'.$this->input->post('related_id'));
				 echo json_encode(array('status' => true, 'message' => 'Successfully Gallery created'));
                }else{
                  
				// Return the validation error
				//$data = $this->form_validation->error_string();
				echo json_encode(array('status' => false, 'message' => validation_errors()));
				}
			}else{
			$data['tid']=$id;
					if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
			if($this->userType==2)
			$data['left_nav'] =  'teams/profile_image';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'teams/add_gallery.php';
			$data['links_js_css']='teams/links_js_css';
			$this->load->view('common/base_template', $data);
		  } 
	  }	
	  function gallery($id=0){
		$data['t_details']=$this->teams_model->viewTeamProfile($id,$this->userId);
		$sdata=$this->teams_model->listofteamusers($id,0,3,'');
		$data['f_details']=$sdata['records'];
		$data['f_cnt']=$sdata['total'];
		$data['rows'] = $this->gallery_tbl->viewAlbums($id,2,$this->userId);
		//$data['content_page'] = 'teams/albums.php';
		$data['content_page'] = 'teams/team_gallery.php';
				if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
		$data['left_nav'] = 'teams/profile_image';
		$data['right_nav'] = 'teams/team_relations';
		$data['long_right'] = true;
		$data['id'] = $id;
		$data['links_js_css']='teams/links_js_css';
		$this->load->view('common/base_template', $data);
	  } 
	  
	 function galimages($tid=0,$albid=0){
	   $data['t_details']=$this->teams_model->viewTeamProfile($tid,$this->userId);
	 	$data['info'] = $this->gallery_tbl->viewParticularGallery($albid,$this->userId);
		$data['rows'] = $this->gallery_tbl->showGalImages($albid);		
		
		$data['content_page'] = 'teams/albums_images.php';
				if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
		if($this->userType==2)
			$data['left_nav'] =  'teams/profile_image';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['links_js_css']='teams/links_js_css';
		$this->load->view('common/base_template', $data);
	  
	  }  
	  function addgalleryimage($tid=0,$albid=0){
	   $data['t_details']=$this->teams_model->viewTeamProfile($tid,$this->userId);
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
				redirect('teams/addgalleryimage/'.$_POST['tid'].'/'.$_POST['id']);
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
				exit();
			}
			$uploadImage = './uploads/'.$newname;
			$this->_al_imageupload();
			write_file($uploadImage, $file);
			$this->db_session->set_flashdata('msg', '<div class="success">Successfully Gallery created </div>');
			
				redirect('teams/gallery');
			}
			}else{
			$data['info'] = $this->gallery_tbl->viewParticularGallery($albid,$this->userId);
					if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
			if($this->userType==2)
			$data['left_nav'] =  'teams/profile_image';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'teams/add_albumimage.php';
			$data['links_js_css']='teams/links_js_css';
			$this->load->view('common/base_template', $data);
		  } 
	  }
	   function editgalleryimage($tid=0,$imgig=0){
	    $data['t_details']=$this->teams_model->viewTeamProfile($tid,$this->userId);
	    if($this->input->post()){
		   if($this->input->post('img_id')!=''){
		  // $_POST['created_by']=$this->userId;
				$id=$this->gallery_tbl->updategalImage();
				if($id){
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully Image updated </div>');
				}else{
					$this->db_session->set_flashdata('msg', '<div class="error">The Gallery Image update Fail</div>');
				}
				redirect('teams/editgalleryimage/'.$this->input->post('tid').'/'.$this->input->post('img_id'));
			}
			}else{
			$data['rows'] = $this->gallery_tbl->galparticularImage($imgig);
					if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
			if($this->userType==2)
			$data['left_nav'] =  'teams/profile_image';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'teams/edit_albumimage.php';
			$data['links_js_css']='teams/links_js_css';
			$this->load->view('common/base_template', $data);
		  } 
	   }
	  function viewgallery($tid=0,$id=0){
	  $data['rows'] = $this->gallery_tbl->viewParticularGallery($id,$this->userId);
		//$this->load->view('gallery/gallery_view', $data);		
		$data['tid'] = $tid;
				if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'teams/gallery_details.php';
		$data['links_js_css']='teams/links_js_css';
		$this->load->view('common/base_template', $data);
	  
	  } 
	   function updategallery($tid=0,$albid=0){
	    $data['t_details']=$this->teams_model->viewTeamProfile($tid,$this->userId);
	   $data['u_details']=$this->users_model->players_details($this->userId);
	    $data['albid']=$albid;
		 $data['tid']=$tid;
	   $validation = array(
			array(
				'field' => 'name',
				'label' => 'Album Name',
				'rules' => 'required|callback__albumname_id_check',
			),
			array(
				'field' => 'related_id',
				'label' => 'Team id',
				'rules' => 'required',
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
				//redirect('teams/updategallery/'.$this->input->post('id'));
			 echo json_encode(array('status' => true, 'message' => 'Successfully Gallery updated'));
			}
			else{
				// Return the validation error
				//$data = $this->form_validation->error_string();
				echo json_encode(array('status' => false, 'message' => validation_errors()));
				}
			}else{
			$data['rows'] = $this->gallery_tbl->viewParticularGallery($albid,$this->userId);
					if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
			if($this->userType==2)
			$data['left_nav'] =  'teams/profile_image';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'teams/update_album.php';
			$data['links_js_css']='teams/links_js_css';
			$this->load->view('common/base_template', $data);
		  } 
	  }
	/*     * ****************** CALENDAR FUNCTIONS ******************** */

	public function scheduler($id=0) {
	    //$data['u_details']=$this->users_model->players_details($this->userId);
		$data['t_details']=$this->teams_model->viewTeamProfile($id,$this->userId);
		$sdata=$this->teams_model->listofAllteamusers($id); # tra ve so thanh vien trong doi
		#echo "<pre>"; print_r($this->teams_model->teamschedule_spports('94')); echo "</pre>";		
			//print_r($sdata);exit;
			$data['f_details']=$sdata['records'];
			$data['f_cnt']=$sdata['total'];
			$data['id']=$id;
		$data['content_page'] =  'cal/team_scheduler';
		if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
		  if($this->userType==2){
			//$data['left_nav'] =  'common/left_nav.php';
			$data['left_nav'] = 'teams/profile_image';
			}
			else{
			$data['left_nav'] =  'common/left_nav_cl.php';
			}
		   $data['right_nav'] =  'common/ads.php';
		   $data['links_js_css']='teams/links_js_css';
		$this->load->view('common/base_template', $data);
		

    }
	
	function datafeed($id=0){
		$ret = array();
		$info=listCalendar($_POST["showdate"], $_POST["viewtype"]);
		  $ret['events'] = array();
		  $ret["issort"] =true;
		  $ret["start"] = php2JsTime($info['st']);
		  $ret["end"] = php2JsTime($info['et']);
		  $ret['error'] = null;
	 	$data['u_details']=$this->users_model->players_details($this->userId);
		$user_calender_events=$this->users_model->get_teams_calender_events($id,$info['st'],$info['et']);
		
		$parsed_events=array();
		if(count($user_calender_events)>0){
			foreach($user_calender_events as $k=>$v){
			if($v->schedule_type=='3'){
				$editable=0;
				$description=$this->users_model->scheduleTeams($v->id);
			}else{
				$description=$v->description;
				$editable=1;
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
		#echo "<pre>"; print_r($ret); echo "</pre>";	
		 echo json_encode($ret);
}

	function save_event($tid=0){
		$post=$this->input->post();
		if($post){
			$post['players_id']=$tid;//$this->userId;
			$post['created_by']=$this->userId;
			$post['start_date']=date('Y-m-d H:i:s',strtotime($post['CalendarStartTime']));
			$post['end_date']=date('Y-m-d H:i:s',strtotime($post['CalendarEndTime']));
			$post['name']=$post['CalendarTitle'];
			$post['description']=$post['CalendarTitle'];
			if(date('H:i:s',strtotime($post['CalendarStartTime']))!='00:00:00' || date('H:i:s',strtotime($post['CalendarEndTime']))!='00:00:00'){
			$post['isalldayevent']=0;
			}else{
			$post['isalldayevent']=$post['IsAllDayEvent'];
			}
			//$return = $this->my_db_lib->save_record($post,'player_schedule');
			if(!empty($post['id'])){
				$return = $this->my_db_lib->save_record($post,'player_schedule');
			}else{
				$post['schedule_type']='1';
				$post['user_type']='2';
				$return = $this->schedule_model->add_schedule($post);
			}
			$data['IsSuccess']=true;
			$data['Msg']='add success';
			$data['Data']=$return;
			echo json_encode($data);
		}
	}
	function sendinvites($id=0){
	$data['t_details']=$this->teams_model->viewTeamProfile($id,$this->userId);
	$data['id']=$id;
		if($this->input->post()){
				//print_r($_POST);
		if(isset($_POST['tid'],$_POST['player_id'])){
		//echo 123;exit;
		$player_id=$_POST['player_id'];
		foreach($player_id as $to){
				$_POST['players_id']=$to;
				$_POST['request_from']='0';
				$_POST['teams_id']=$_POST['tid'];
				$_POST['team_player_relations_id']=2;
				$_POST['created_by']=$this->userId;
				$_POST['created_date']=date('Y-m-d H:s:i');
				
				
				$num=$this->teams_model->checkTm($_POST['tid'],$to);
				if($num==0){
					$_POST['is_approved']='0';
					$tid=$this->my_db_lib->save_record($this->input->post(),'player_teams');
				}
				}
				$this->db_session->set_flashdata('msg', '<div class="success">Successfully players request sent </div>');
				redirect("teams/sendinvites/".$_POST['tid']);
			}
		}else{
				$data['teamDetails']= $this->teams_model->viewTeam($id,$this->userId);
				if($data['teamDetails']){
				$data['teamusers']= $this->users_model->inviteTeamPlayers($id,$this->userId);
				}
						if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '2';
				if($this->userType==2)
			$data['left_nav'] = 'teams/profile_image';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'teams/sendinvites.php';
			$data['links_js_css']='teams/links_js_css';
				$this->load->view('common/base_template', $data);
		}
	}
	function sendinviteuser(){
	
		if($this->input->post()){
				//print_r($_POST);
		if(isset($_POST['tid'],$_POST['player_id'])){
		//echo 123;exit;
		        $player_id=$_POST['player_id'];
				$_POST['players_id']=$player_id;
				$_POST['request_from']='0';
				$_POST['teams_id']=$_POST['tid'];
				$_POST['team_player_relations_id']=2;
				$_POST['created_by']=$this->userId;
				$_POST['created_date']=date('Y-m-d H:s:i');
				$num=$this->teams_model->checkTm($_POST['tid'],$player_id);
				if($num==0){
					$_POST['is_approved']='0';
					$tid=$this->my_db_lib->save_record($this->input->post(),'player_teams');
					 $this->users_model->team_invite($_POST['tid'],$player_id);
					echo 1;
				}else{
				echo 0;
				}
				}
				
			}else{
			echo 0;
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
					redirect('teams/galimages/'.$_POST['tid'].'/'.$_POST['id']);
				}
				
				return true;
		}
	
	}
	
		function advanceteams($pagenumber=0){
		$total=0;
		if($this->input->request()){
			$search_array=array(
								'tname'=>$_REQUEST['tname'],
								'poc'=>$_REQUEST['poc'],
								'dist'=>$_REQUEST['dist'],
								'sp'=>$_REQUEST['sp'],
								'level'=>$_REQUEST['level'],
							);
			$rec=$this->teams_model->getTeams($this->userId,$search_array,$pagenumber,10);
			$total=$rec['total'];
			$data['team_data']=$rec['records'];
			$data['total']=$total;
		}else{
			$data['team_data']=array();
		}
		$config['base_url'] = site_url('teams/advanceteams');
		$config['per_page'] = '10'; 
		$config['uri_segment'] = '3'; 
		//$pagenumber=0;
		$config['full_tag_open'] = '<div class="page_box fl">';
		$config['full_tag_close'] = '</div>';
		$config['total_rows'] = $total;
		$this->pagination->initialize($config);
		$data['active_tab'] = '4';
		if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] = 'teams/advanceteams.php';
		$data['links_js_css']='teams/links_js_css';
		$this->load->view('common/base_template', $data);
	}
	function teamnotifications($id=0){
		//$pagenumber=0;
		$data['teamrelation'] = json_encode($this->users_model->teamrelations());
		$data['t_details']=$this->teams_model->viewTeamProfile($id,$this->userId);
		$rec=$this->teams_model->notifications($id,$this->userId);
		$data['total_rows']=$rec['total'];
		$data['notify_data']=$rec['records'];
		if($this->userType==2)
			$data['active_tab'] = '4';
			else
			$data['active_tab'] = '3';
		$data['left_nav'][] =  'teams/profile_image';
		$data['right_nav'][] =  'common/ads.php';
		$data['content_page'] =  'teams/notifications';
		$data['links_js_css']='teams/links_js_css';
		$this->load->view('common/base_template', $data);
	} 
	function jointeam(){
			if($this->input->post('tid')){
				$this->teams_model->approveTeamPlayer($this->userId,$this->input->post('tid'),$this->input->post('uid'),$this->input->post('selected'),$this->input->post('relation_id'));
			}
	}
	function teamschedulesports(){
	$tid=$this->input->post('tid')?$this->input->post('tid'):0;
	$sid=$this->input->post('sid')?$this->input->post('sid'):0;
		$sp=$this->teams_model->teamschedulesports($tid,$sid);
		$u_sp=array();
		foreach($sp as $row){
			$data=array();
			$data['sname']=$row->sname;
			$data['start_date']=date('m-d-Y',strtotime($row->start_date));
			$data['referee_name']=$row->referee_name;
			$data['location']=$row->location;
			$data['match_result']=$row->match_result;
			$data['pname']=$row->tname;
			$data['level']=$row->level;
			array_push($u_sp,$data);
		}
		echo json_encode($u_sp);
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
		if ($this->gallery_tbl->checkalbum_name($name,$_POST['related_id'],0,2))
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
		if ($this->gallery_tbl->checkalbum_name($name,$_POST['related_id'],$_POST['id'],2))
		{
			$this->form_validation->set_message('_albumname_id_check', 'Album name is already used');
			return false;
		}

		return true;
	}
	function albdelete(){
		$this->gallery_tbl->deleteAlbum($this->input->post('albid'));
	 echo json_encode(array('status' => true, 'message' => 'Successfully Gallery deleted'));
	}
	function imgdelete(){
		$this->gallery_tbl->deleteImage($this->input->post('albid'));
	 echo json_encode(array('status' => true, 'message' => 'Successfully Image deleted'));
	}
}

?>
