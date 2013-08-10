<?php
class Schedule_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


	function add_schedule($data=array()){
	
		$player_schedule=array(
			'name' =>isset($data['name'])?$data['name']:'',
			'players_id' =>$data['players_id'],
			'description' =>isset($data['description'])?$data['description']:'',
			'start_date' =>date('Y-m-d H:i:s',strtotime($data['start_date'])),
			'end_date' =>date('Y-m-d H:i:s',strtotime($data['end_date'])),
			'schedule_type'  =>$data['schedule_type'],
			'created_by' =>$data['created_by'],
			'isalldayevent' =>isset($data['isalldayevent'])?$data['isalldayevent']:1,
			'color' =>isset($data['color'])?$data['color']:''
		);
		/*if($data['schedule_type']=='2'){
			$user_type='2';
		}else{
			$user_type='1';
		}*/
		$this->db->insert('player_schedule',$player_schedule);
		$ps_id=$this->db->insert_id();
		$schedule_users=array(
			'schedule_id' =>$ps_id,
			'user_id' =>$data['players_id'],
			'is_approve' =>'1',
			'user_type' =>$data['user_type']
		);
		$this->db->insert('schedule_users',$schedule_users);
		/*$schedule_details=array(
			'schedule_id' =>$ps_id,
			'club_id' =>!empty($data['club_id'])?$data['club_id']:1,
			'court_id' =>!empty($data['court_id'])?$data['court_id']:1,
			'sport_id' =>!empty($data['sport_id'])?$data['sport_id']:1,
			'referee_name' =>!empty($data['referee_name'])?$data['referee_name']:'',
			'location' =>!empty($data['location'])?$data['location']:''
		);
		$this->db->insert('schedule_details',$schedule_details);
		$psd_id=$this->db->insert_id();*/
		
		
		return $ps_id;
	}
	 
function add_schedule_match($uid,$data=array()){

			if($data['type']==1){
				$type=$data['type']='2';
				$user_type='1';
			}else{
				$type=$data['type']='3';
				$user_type='2';
			}
	
		$player_schedule=array(
			'name' =>isset($data['name'])?$data['name']:'',
			'players_id' =>$data['p1'],
			'description' =>isset($data['note'])?$data['note']:'',
			'start_date' =>date('Y-m-d H:i:s',strtotime($data['start_time'])),
			'end_date' =>date('Y-m-d H:i:s',strtotime($data['end_time'])),
			'created_by' =>$uid,
			'schedule_type' =>$type,
			'isalldayevent' =>0,
			'location' =>isset($data['location'])?$data['location']:''
		);
		$this->db->insert('player_schedule',$player_schedule);
		$ps_id=$this->db->insert_id();
		$schedule_users=array(
			'schedule_id' =>$ps_id,
			'user_id' =>$data['p1'],
			'is_approve' =>'1',
			'user_type' =>$user_type
		);
		$this->db->insert('schedule_users',$schedule_users);
		$schedule_users2=array(
			'schedule_id' =>$ps_id,
			'user_id' =>$data['p2'],
			'is_approve' =>'0',
			'user_type' =>$user_type
		);
		$this->db->insert('schedule_users',$schedule_users2);
		$schedule_details=array(
			'schedule_id' =>$ps_id,
			'club_id' =>isset($data['club_name'])?$data['club_name']:1,
			'court_id' =>isset($data['court_name'])?$data['court_name']:1,
			'sport_id' =>isset($data['sport_name'])?$data['sport_name']:1,
			'referee_name' =>isset($data['referee_name'])?$data['referee_name']:'',
			'location' =>isset($data['location'])?$data['location']:''
		);
		$this->db->insert('schedule_details',$schedule_details);
		$psd_id=$this->db->insert_id();
		return $ps_id;
	}
   function approvent($sch_id,$type,$status,$user_id,$score){
   if($type==2){
				$check_sche=$this->db->query("select ps.id as psid,su.id,su.user_id,ps.created_by from player_schedule ps 
												INNER JOIN schedule_users su ON ps.id=su.schedule_id
												where su.id='".$sch_id."' and su.user_id='".$user_id."' AND su.is_approve='0'
												 AND ps.schedule_type='2'");
			if($check_sche->num_rows()>0){
			$row=$check_sche->row();
			$this->db->query("UPDATE schedule_users SET is_approve='1' where id='".$sch_id."' AND user_id='".$user_id."'");
			$this->player_schedule_accept($row->created_by,$row->psid);
			}						 
		}else if($type==3){
		
		$check_sche=$this->db->query("SELECT ps.id
				FROM player_schedule ps
				INNER JOIN players p ON ps.created_by=p.id
				INNER JOIN schedule_users su ON ps.id=su.schedule_id
				INNER JOIN teams t ON ps.players_id=t.id
				INNER JOIN player_teams pt ON t.id=pt.teams_id
				WHERE su.id='".$sch_id."' AND t.created_by='".$user_id."'");
			if($check_sche->num_rows()>0){
			$this->db->query("UPDATE schedule_users SET is_approve='1' where id='".$sch_id."'");
			}		
		}else if($type==5){
		
		$check_sche=$this->db->query("SELECT pt.id,t.id as tid,pt.players_id
				FROM teams t
				inner join player_teams pt on t.id=pt.teams_id
				INNER JOIN players p ON t.created_by=p.id
				WHERE pt.id='".$sch_id."' AND t.created_by='".$user_id."'");
			if($check_sche->num_rows()>0){
			$ptd=$check_sche->row();
			if($status==2){
			  $this->db->query("UPDATE player_teams SET is_approved='1' where id='".$sch_id."'");
			  $this->team_captain_accept($ptd->tid,$ptd->players_id);
			  }
			else{
			  $this->db->query("delete from player_teams where id='".$sch_id."'");
			  }
			}		
		}
		else if($type==6 || $type==7){
	        if($status==4)
			$status=1;
			else if($status==5)
			$status=2;
			else if($status==6)
			$status=3;
			$this->db->query("UPDATE schedule_users SET match_result='".$status."',updated_by='".$user_id."' where id='".$sch_id."'");
			$s_id=$this->db->query("select schedule_id from schedule_users where id='".$sch_id."' limit 1");
			if($s_id->num_rows()>0){
			$schedule_id=$s_id->row()->schedule_id;
			if(isset($score) && $score!=''){
				$this->db->query("UPDATE player_schedule SET score='".addslashes($score)."',modified_by='".$user_id."' where id='".$schedule_id."'");
			}
			
			$s_count=$this->db->query("select id from schedule_users where schedule_id='".$schedule_id."' and match_result='0'");
			if($s_count->num_rows()==0){
				$this->db->query("UPDATE player_schedule SET is_over='1',modified_by='".$user_id."' where id='".$schedule_id."'");
			}
			}
		}						   
   } 
   //Emails
	
	function team_captain_accept($tid,$uid){
		$CIS =& get_instance();
		$CIS->load->model('users_model');   
	if(SEND_EMAIL){
			$this->load->library('email');
			$this->email->mailtype="html";
			$data['u_details']=$CIS->users_model->players_details($uid);
			$data['t_details']=$CIS->users_model->getTeamProfile($tid);
			$msg=$this->load->view('email/team_captain_accept',$data,TRUE);
			 $from='member@wesport.com';//'wesportonline@gmail.com';
			//$subject='Team Invite from '.$this->userFname.' '.$this->userLname;
			$subject=ucwords($data['t_details']->name).' has accepted your team Request on WESport';
			$to=$data['u_details']->email;
			$this->email->from($from,'WESport');
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($msg);
			$this->email->send();
		}
	}
	 //Emails
	
	function player_schedule_accept($uid,$sid){
	$CIS =& get_instance();
		$CIS->load->model('users_model'); 
	if(SEND_EMAIL){
			$this->load->library('email');
		$this->email->mailtype="html";
		$data['sh']=$this->db->query("SELECT * FROM player_schedule WHERE id='".$sid."' limit 1")->row();
		$data['u_details']=$CIS->users_model->players_details($uid);
		$msg=$this->load->view('email/schedule_player_accept',$data,TRUE);
		$from='member@wesport.com';//'wesportonline@gmail.com';
		//$subject='Player Match from '.$this->userFname.' '.$this->userLname;
		$subject='Match Agenda ('.ucwords($data['u_details']->first_name. ' '.$data['u_details']->last_name).' vs '.ucwords($this->userFname.' '.$this->userLname).') on  '.date('m-d-Y',strtotime($data['sh']->start_date)).' at '.date('H:i a',strtotime($data['sh']->start_date));
		$to=$data['u_details']->email;
		$this->email->from($from,'WESport');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($msg);
		$this->email->send();
		}
	}
}
?>