<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sports extends MY_Controller {

	function __construct() {
			// Call the Parent constructor
			parent::__construct();
			$this->load->model('sports_model');
			$this->load->model('teams_model');
			$this->load->model('users_model');
			$this->load->library('pagination');
			$this->load->library('form_validation');
			session_check();
	}

	public function allsports($search='',$pagenumber=0) {
	
			$config['per_page'] = '10'; 
			if($search!=''){
				$config['base_url'] = site_url('sports/allsports/'.$search);
				$config['uri_segment'] = '4';
			}else{
				$config['base_url'] = site_url('sports/allsports/all');
				$config['uri_segment'] = '4';
			}
			if($search=='all'){
				$search='';
			}
			//$pagenumber=0;
			 $config['num_links'] = 1; // ridiculous high number to show all the links
			$config['full_tag_open'] = '<div class="page_box fl">';
			$config['full_tag_close'] = '</div>';
			if(isset($_POST['serchKey']) and trim($_POST['serchKey'])!='Search...'){
				$serchKey=trim($_POST['serchKey']);
			}else{
				$serchKey='';
			}
			if($pagenumber==0){
				$this->db_session->set_userdata('spallserchKey',$serchKey);
			}
			$rec=$this->sports_model->listofsports($this->userId,$pagenumber,10,$serchKey,$search);
			$config['total_rows'] = $rec['total'];
			$data['sports_data']=$rec['records'];
			$data['total']=$rec['total'];
			$this->pagination->initialize($config);
			if($this->userType==2)
			$data['active_tab'] = '3';
			else
			$data['active_tab'] = '1';
			if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'sports/view.php';
			$data['links_js_css']='sports/links_js_css';
			$this->load->view('common/base_template', $data);
	}
	public function mysports($search='',$pagenumber=0) {
			$data['u_details']=$this->users_model->players_details($this->userId);
			
			$config['per_page'] = '10'; 
			if($search!=''){
				$config['base_url'] = site_url('sports/mysports/'.$search);
				$config['uri_segment'] = '4';
			}else{
				$config['base_url'] = site_url('sports/mysports/all');
				$config['uri_segment'] = '4';
			}
			if($search=='all'){
			$search='';
			}
			//$pagenumber=0;
			$config['full_tag_open'] = '<div class="page_box fl">';
			$config['full_tag_close'] = '</div>';
			if(isset($_POST['serchKey']) and trim($_POST['serchKey'])!='Search...'){
				$serchKey=trim($_POST['serchKey']);
			}else{
				$serchKey='';
			}
			if($pagenumber==0){
				$this->db_session->set_userdata('spmyserchKey',$serchKey);
			}
			if($this->userType==2){
			$rec=$this->sports_model->listofmysports($this->userId,$pagenumber,10,$serchKey,$search);
			}else if($this->userType==3){
				$rec=$this->sports_model->listofmysportsClubs($this->clubId,$pagenumber,10,$serchKey,$search);
			}
			
			$config['total_rows'] = $rec['total'];
			$data['sports_data']=$rec['records'];
			$data['total']=$rec['total'];
			$this->pagination->initialize($config);
			if($this->userType==2)
			$data['active_tab'] = '3';
			else
			$data['active_tab'] = '1';
			if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] = 'sports/mysports.php';
			$data['links_js_css']='sports/links_js_css';
			$this->load->view('common/base_template', $data);
	}	
		public function moresports($id=0,$search='',$pagenumber=0) {
			$data['u_details']=$this->users_model->players_details($id);
			$data['id']=$id;
			if($search!='')
			$config['base_url'] = site_url('sports/moresports/'.$id.'/'.$search);
			else
			$config['base_url'] = site_url('sports/moresports/'.$id);
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
				$this->db_session->set_userdata('spmyserchKey',$serchKey);
			}
			$rec=$this->sports_model->listofmoresports($id,$this->userId,$pagenumber,10,$serchKey,$search);
			$config['total_rows'] = $rec['total'];
			$data['sports_data']=$rec['records'];
			$data['total']=$rec['total'];
			$this->pagination->initialize($config); 
			$data['content_page'] = 'sports/moresports.php';
			$data['active_tab'] = '6';
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
			$data['links_js_css']='sports/links_js_css';
			$this->load->view('common/base_template', $data);
	}	
	public function joinsp() {
			if($this->input->post('sid')){
				$_POST['players_id']=$this->userId;
				$_POST['sports_id']=$_POST['sid'];
				$_POST['expert_id']=1;
				
				if($this->input->post('selected')==0){
					$num=$this->sports_model->checkSp($_POST['sid'],$this->userId);
					if($num==0){
						$sports_id=$this->my_db_lib->save_record($this->input->post(),'player_sports');
						echo 0;
					}else{
						echo 1;
					}
				}else{
					$this->sports_model->removeSp($_POST['sid'],$_POST['players_id']);
					echo 1;
				}
			}
	}
	function add_sports() {
			if($this->input->post('submit')){
					$_POST['user_id']=$this->userId;
					if($_POST['sports_id']!='custom' && $_POST['sports_id']!=''){
						$_POST['players_id']=$this->userId;
						//$_POST['sports_id']=$_POST['sports_id'];
						$_POST['expert_id']=$_POST['expert_id'];
						if($this->userType==2){
						$num=$this->sports_model->checkSp($_POST['sports_id'],$this->userId);
						if($num==0){
							$sports_id=$this->my_db_lib->save_record($this->input->post(),'player_sports');
							$this->db_session->set_flashdata('msg', '<div class="success">Successfully sport added </div>');
						}else{
						$this->db_session->set_flashdata('msg', '<div class="success">Already sport added </div>');
					}
					} else if($this->userType==3){
								$_POST['clubs_id']=$this->clubId;
								$_POST['sports_id']=$_POST['sports_id'];
								$_POST['created_by']=$this->userId;
								$this->my_db_lib->save_record($this->input->post(),'club_sports');
								$this->db_session->set_flashdata('msg', '<div class="success">Successfully sport added </div>');
							}
					}else if($this->input->post('name')!=''){
					$num=$this->sports_model->checkSpName($this->input->post('name'));
					if($num==0){
						if($_POST['expert_id']=='custom'){
							if(isset($_POST['ex_recommend']))
								$reco=$_POST['ex_recommend'];
							else
								$reco=2;
							$lid=$this->teams_model->addLevel($_POST['custom_name'],$reco);
							$expert_id=$lid;
						}else{
							$expert_id=$_POST['expert_id'];
						}
							$sports_id=$this->my_db_lib->save_record($this->input->post(),'sports');
							$_POST['sports_id']=$sports_id;
							$_POST['created_by']=$this->userId;
							$this->my_db_lib->save_record($this->input->post(),'sports_dimensions');
							$this->_imageupload($sports_id);
							if($this->userType==2){	
								unset($_POST);
								$_POST['expert_id']=$expert_id;
								$_POST['players_id']=$this->userId;
								$_POST['sports_id']=$sports_id;
								$this->my_db_lib->save_record($this->input->post(),'player_sports');
							}else if($this->userType==3){
								unset($_POST);
								$_POST['clubs_id']=$this->clubId;
								$_POST['sports_id']=$sports_id;
								$_POST['created_by']=$this->userId;
								$this->my_db_lib->save_record($this->input->post(),'club_sports');
							}
							$this->db_session->set_flashdata('msg', '<div class="success">Successfully sport created </div>');
					}else{
							$this->db_session->set_flashdata('msg', '<div class="error">The sport name already Exist</div>');
					}
				}
					redirect('sports/add_sports');
			}else{
			if($this->userType==2)
			$data['active_tab'] = '3';
			else
			$data['active_tab'] = '1';
					if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
					$data['right_nav'] =  'common/ads.php';
					$data['content_page'] =  'sports/add_sports';
					$data['links_js_css']='sports/links_js_css';
					$this->load->view('common/base_template', $data);
			}
	}
	function edit_sports($id=0) {
	//print_r($_POST);exit;
			if($this->input->post('submit')){
				$_POST['user_id']=$this->userId;
				$num=$this->sports_model->checkSpName($this->input->post('name'),$_POST['id']);
				if($num==0){
					$sports_id=$this->my_db_lib->save_record($this->input->post(),'sports');
					$this->_imageupload($this->input->post('id'));
					//$_POST['id']=$_POST['sdid'];
				//$_POST['created_by']=$this->userId;
					$sports_id=$this->my_db_lib->save_record($this->input->post(),'sports_dimensions');
				
					$this->db_session->set_flashdata('msg', '<div class="success">Successfully sport updated </div>');
				}else{
					$this->db_session->set_flashdata('msg', '<div class="error">The sport name already Exist</div>');
				}
				redirect('sports/edit_sports/'.$this->input->post('id'));
			}else{
				$data['sp_data']=$this->sports_model->viewSports($id,$this->userId);
				if($this->userType==2)
			$data['active_tab'] = '3';
			else
			$data['active_tab'] = '1';
				if($this->userType==2)
			$data['left_nav'] =  'common/left_nav.php';
			else
			$data['left_nav'] =  'common/left_nav_cl.php';
				$data['right_nav'] =  'common/ads.php';
				$data['content_page'] =  'sports/edit_sports';
				$data['links_js_css']='sports/links_js_css';
				$this->load->view('common/base_template', $data);
			}
	}
	function _imageupload($tid=0){
			if($tid!=0){ 
				$config['upload_path'] = './images/sports/';
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
					$this->_createThumbnail($data['file_name']);
					//$opt->logo=$data['file_name'];
					unset($_POST);
					$_POST['id']=$tid;
					$_POST['logo']=$data['file_name'];
					$this->my_db_lib->save_record($this->input->post(),'sports');
				}
				
				return true;
		}
	
	}
	function _createThumbnail($fileName) {
			$config['image_library'] = 'gd2';
			$config['source_image'] = './images/sports/'.$fileName;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 150;
			$config['height'] = 150;
			
			$this->load->library('image_lib');
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
} 
}

?>
