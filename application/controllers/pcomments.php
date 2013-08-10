<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pcomments extends MY_Controller {

    function __construct()
    {
	
        // Call the Parent constructor
        parent::__construct();
		$this->load->model('comments_model');
		session_check();
    }
    
    public function index(){
	
	}
	  function _comments_data($img_id){
			$data['comments']=$this->comments_model->listofcomments($img_id);
			$data['image']=$this->comments_model->imgInfo($img_id);
			$data['user']=array("id"=>$this->userId,"name"=>$this->userFname,"img"=>$this->image);
			return $data;
		}
    public function comments(){
		$data=array();
		if($this->input->post('img_id')){
			$data=$this->_comments_data($this->input->post('img_id'));
		}
		echo json_encode($data);
	}
 	public function addcomments(){
		$data=array();
		if($this->input->post('img_id')){
			 $_POST['user_id']=$this->userId;
			 $_POST['photo_id']=$this->input->post('img_id');
			  $_POST['comments']=$this->input->post('comment');
			$this->my_db_lib->save_record($this->input->post(),'photo_comments');
			$data=$this->_comments_data($this->input->post('img_id'));
		}
			echo json_encode($data);
	}


  

}

?>
