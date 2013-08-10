<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends MY_Controller {

    function __construct() {
		// Call the Parent constructor
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('sports_model');
		$this->load->model('teams_model');
		$this->load->model('clubs_model');
		$this->load->model('schedule_model');
		session_check();
    }
   
    public function index() {
	    $id=$this->userId;
		$f_details=$fdata['records'];
		$result=array();
		foreach($f_details as $row){
			$data=array();
			$data['id']=$row->pid;
			$data['label']=$row->pname;
			array_push($result,$data);
		}
		echo json_encode($result);
    }
	 public function players() {
	    $id=$this->userId;
  		$fdata=$this->users_model->listofmyplayers($id,0,10000000000,'');
		$f_details=$fdata['records'];
		$result=array();
		foreach($f_details as $row){
			$data=array();
			$data['id']=$row->pid;
			$data['label']=$row->pname;
			array_push($result,$data);
		}
		echo json_encode($result);
    }
	 public function sports() {
	    $id=$this->userId;
		$sdata=$this->sports_model->patnersSports($id,$this->input->post('pid'));
		$s_details=$sdata;
		
		
		$result=array();
		foreach($s_details as $row){
			$data=array();
			$data['id']=$row->sid;
			$data['label']=$row->sname;
			array_push($result,$data);
		}
		echo json_encode($result);
    }
	
	public function clubs() {
	    $id=$this->userId;
		if($this->input->post('match_type')==1){
		 	$cdata=$this->clubs_model->scheduleClubList($this->input->post('sid'));
		 }else{
		 	$cdata=$this->clubs_model->scheduleClubList($this->input->post('sid'));
		 }
		$c_details=$cdata;
		
		$result=array();
		foreach($c_details as $row){
			$data=array();
			$data['id']=$row->clbid;
			$data['label']=$row->name;
			array_push($result,$data);
		}
		echo json_encode($result);
    }
   public function courts() {
		$courts=$this->clubs_model->courts_list($this->input->post('cid'));
		$result=array();
		foreach($courts as $row){
		$data=array();
			$data['id']=$row->id;
			$data['label']=$row->name;
			array_push($result,$data);
		}
		echo json_encode($result);
		
    }
	public function teams() {
	    $id=4;
		$rec=$this->teams_model->listofmyteams($this->userId,$this->userId,0,10000000000,'');
		$teams_data=$rec['records'];
		$result=array();
		foreach($teams_data as $row){
			$data=array();
			$data['id']=$row->tid;
			$data['label']=$row->tname;
			array_push($result,$data);
		}
		echo json_encode($result);
		
    }
	public function schedule_match() {
		$rec=$this->schedule_model->add_schedule_match($this->userId,$_POST);
		if($_POST['type']==1){
				$type=$_POST['type']='2';
				$this->users_model->player_schedule_match($_POST['p2'],$rec);
				$this->users_model->player_schedule_match($this->userId,$rec);
			}else{
				$this->users_model->team_schedule_match($_POST['p2']);
			}
		$data['success']=true;
		//$data['error']=true;
	echo json_encode($data);
    }
}

?>
