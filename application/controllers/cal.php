<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cal extends MY_Controller {

    function __construct() {
		// Call the Parent constructor
		parent::__construct();
		$this->load->library('albumfileupload_library'); 
		$this->load->model('admin_model');
		$this->load->model('users_model');
		$this->load->model('sports_model');
		$this->load->model('teams_model');
		$this->load->library('pagination');
		$this->load->model('gallery_model','gallery_tbl');
		$this->load->model('schedule_model');
		session_check();
    }
   
    public function index() {	    
		$data['active_tab'] = '0';
         $data['left_nav'] = 'common/left_nav';
		//$data['left_nav'] = 'common/left_nav';
		$data['right_nav'] = 'common/ads.php';
		//$data['long_right'] = true;
        $data['content_page'] =  'cal/cal';
		$data['links_js_css']='teams/links_js_css';
        $this->load->view('common/base_template', $data);
        //$this->load->view('cal/cal');
    }
function datafeed(){
		$ret = array();
		$info=$this->listCalendar($_POST["showdate"], $_POST["viewtype"]);
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
											1, //editable
											'hyderabad', 
											''//$attends
										  );
			}
		}
		//$data['events']=$parsed_events;
		 echo json_encode($ret);
	


}
function listCalendar($day, $type){
  $phpTime = js2PhpTime($day);
  //echo $phpTime . "+" . $type;
  switch($type){
    case "month":
      $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime)+1, 1, date("Y", $phpTime));
      $cnt = 3;
      break;
    case "week":
      //suppose first day of a week is monday 
      $monday  =  date("d", $phpTime) - date('N', $phpTime) + 1;
      //echo date('N', $phpTime);
      $st = mktime(0,0,0,date("m", $phpTime), $monday, date("Y", $phpTime));
      $et = mktime(0,0,-1,date("m", $phpTime), $monday+7, date("Y", $phpTime));
      $cnt = 2;
      break;
    case "day":
      $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime)+1, date("Y", $phpTime));
      $cnt = 2;
      break;
  }
  //echo $st . "--" . $et;
  $data['st']=$st;
  $data['et']=$et;
  $data['cnt']=$cnt;
  return $data;
}
function details($id=0){
$sql=$this->db->query("select * from player_schedule where id='".$id."'");
if($sql->num_rows()>0){
	$data['event']=$sql->row();
}else{
$data['eventss']='';
}
$data['id']=$id;

$teams_sql=$this->db->query("select id,name from teams where status='1' order by name");
if($teams_sql->num_rows()>0){
	$data['teams']=$teams_sql->result_array();
}else{
$data['teams']='';
}
$this->load->view('cal/edit', $data);
}

function export_view($id=0){
 $this->load->view('cal/export_view');
}

function viewdetails($id=0){
    $sql=$this->db->query("select * from player_schedule where id='".$id."'");
    if($sql->num_rows()>0){
        $data['event']=$sql->row();
    }else{
    $data['eventss']='';
    }
     $this->load->view('cal/view', $data);
}
function update(){
$post=$this->input->post();
		if($post){
			$post['id']=$this->input->post('calendarId');
			$post['start_date']=date('Y-m-d H:i:s',strtotime($post['CalendarStartTime']));
			$post['end_date']=date('Y-m-d H:i:s',strtotime($post['CalendarEndTime']));
			
			if(!empty($post['id'])){
				$return = $this->my_db_lib->save_record($post,'player_schedule');
			}
			$data['IsSuccess']=true;
			$data['Msg']='add success';
			$data['Data']=$return;
			echo json_encode($data);
		}
}
function remove(){
$id=$this->input->post('calendarId');
$sql=$this->db->query("delete from player_schedule where id='".$id."'");
$data['IsSuccess']=true;
			$data['Msg']='add success';
			$data['Data']=$id;
			echo json_encode($data);
}
}

?>
