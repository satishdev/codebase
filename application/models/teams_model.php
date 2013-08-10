<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

  function listofteams($uid,$pagenumber=0,$limit,$serch_key){
  			
	
				
				 if($serch_key!=''){
		  	$serch_key=" and t.name like '%".$serch_key."%'";
		  }
        $sql="SELECT t.id AS tid,t.name AS tname, IFNULL(t.logo,'') AS logo, s.name AS sname, 
				 IF(t.created_by='".$uid."',1,0) AS is_owner, CONCAT(p_w.first_name,' ',p_w.last_name) AS captain,
				(select count(distinct pt_cnt.players_id) 
				from player_teams pt_cnt where pt_cnt.teams_id=t.id and pt_cnt.is_approved='1') as cnt
				,IFNULL(pt_o.is_approved,'') AS is_approved
			FROM teams t
			INNER JOIN sports s ON t.sports_id=s.id
			INNER JOIN players p_w ON t.created_by=p_w.id
			INNER JOIN levels l ON t.level_id=l.id
			LEFT JOIN player_teams pt_o ON t.id=pt_o.teams_id AND pt_o.players_id='".$uid."'
			WHERE t.status='1' ".$serch_key."
			GROUP BY t.id
			ORDER BY t.name";
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	  function listofmyteams($uid,$owner_id,$pagenumber=0,$limit,$serch_key){
  			
		  if($serch_key!=''){
		  	$serch_key=" and t.name like '%".$serch_key."%'";
		  }
        $sql="SELECT t.id AS tid,t.name AS tname, IFNULL(t.logo,'') AS logo, s.name AS sname, tpr.name AS rname,
			 IFNULL(pt_o.id,0) AS pid, IF(t.created_by='".$owner_id."',1,0) AS is_owner, IFNULL(pt_o.is_approved,'') AS is_approved,
			 CONCAT(p_w.first_name,' ',p_w.last_name) AS captain,IFNULL(p_w.image,'') as image,
 (select count(distinct pt_cnt.players_id) from player_teams pt_cnt where pt_cnt.teams_id=t.id and pt_cnt.is_approved='1') as cnt
			FROM teams t
			INNER JOIN sports s ON t.sports_id=s.id
			INNER JOIN players p_w ON t.created_by=p_w.id
			INNER JOIN player_teams pt_o ON t.id=pt_o.teams_id AND pt_o.players_id='".$uid."'
          LEFT JOIN team_player_relations tpr ON pt_o.team_player_relations_id=tpr.id
			WHERE t.status='1' AND pt_o.players_id='".$uid."' AND pt_o.is_approved='1' ".$serch_key."
			GROUP BY t.id
			ORDER BY t.name";
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	function listofmyteamsOfCourts($club_id,$pagenumber=0,$limit,$serch_key){
  			
		  if($serch_key!=''){
		  	$serch_key=" and t.name like '%".$serch_key."%'";
		  }
        $sql="SELECT t.id AS tid,
				t.name AS tname, IFNULL(t.logo,'') AS logo,
				s.name AS sname,
				ctr.name AS rname
				FROM teams t
				INNER JOIN sports s ON t.sports_id=s.id
				INNER JOIN club_teams ct ON t.id=ct.teams_id
				INNER JOIN clubs clb ON ct.clubs_id=clb.id
				INNER JOIN club_team_relations ctr ON ct.club_team_relations_id=ctr.id
				WHERE t.status='1' AND ct.clubs_id='".$club_id."' ".$serch_key."
				GROUP BY t.id
				ORDER BY t.name";
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	 function checkTm($tid,$uid){
        $num=$this->db->query("select id from player_teams where players_id='".$uid."' and teams_id='".$tid."'")->num_rows();
        //$res = $this->db->query($sql);
        return $num;
    }
	function checkTmName($sp_name,$id=0){
		$sql='';
		if($id!=0){
			$sql=" and id!='".$id."' ";
		}
        $num=$this->db->query("select id from teams where  name='".$sp_name."'".$sql)->num_rows();
        //$res = $this->db->query($sql);
        return $num;
    }
	protected function pageQuery($sql,$offset=0,$limit=0,$type='object')
         {
            
            $totQuery=$this->db->query($sql);  
            
   $return['total']=$totQuery->num_rows();
   
   
   if($limit!=0)
   {
       $sql.= " limit ".$offset. " ,".$limit;
	   $query=$this->db->query($sql);
     if($query->num_rows()>0)
         $result=$query->result($type);
     else
      $result=array();
	  
      $return['records']=$result; 
    //return $result;
   }
   else
   {
    if($totQuery->num_rows()>0)
    $result=$totQuery->result($type);
    else
    $result=0;
    //return $result;
    $return['records']=$result;
    
   }
   
   return $return;

   }
   function removeTeam($t_id,$uid){
   				$this->db->query("delete from player_teams WHERE players_id='".$uid."' AND teams_id='".$t_id."'");
				return true;
   }
   function approveTeam($t_id,$uid){
   				$this->db->query("update player_teams set is_approved='1' WHERE players_id='".$uid."' and teams_id='".$t_id."'");
				return true;
   }
   function viewTeam($tid,$uid){
			$sql=$this->db->query("SELECT t.*,ifnull(l.name,'') as lname
									FROM teams t
									LEFT JOIN levels l on t.level_id=l.id
									WHERE t.status='1' AND t.created_by='".$uid."' AND t.id='".$tid."' limit 1");
			 if($sql->num_rows()>0){
				 		return $sql->row();;
				 }else{
						return false;
				}						
   }
   function viewTeamProfile($tid,$uid){
	$sql=$this->db->query("SELECT t.*,s.name as sname,IFNULL(pt.is_approved,'') as is_approved,ifnull(l.name,'') as lname,CONCAT(p.first_name,' ',p.last_name) AS captain
							FROM teams t
							INNER JOIN players p on p.id=t.created_by
							LEFT JOIN sports s on t.sports_id=s.id
							LEFT JOIN levels l on t.level_id=l.id
							LEFT JOIN player_teams pt on t.id=pt.teams_id and pt.players_id='".$uid."'
							WHERE t.status='1' AND t.id='".$tid."' limit 1");
	 if($sql->num_rows()>0){
				return $sql->row();;
		 }else{
				return false;
		}						
   }
   function listofteamusers($tid,$pagenumber=0,$limit,$serch_key){
  			
		  if($serch_key!=''){
		  	$serch_key=" AND p.first_name like '%".$serch_key."%'";
		  }
			$sql="SELECT p.*,t.name,t.id AS tid,tpr.name AS rname
					FROM player_teams pt
					INNER JOIN teams t ON pt.teams_id =t.id
					INNER JOIN sports s ON t.sports_id=s.id
					INNER JOIN players p ON pt.players_id=p.id
					INNER JOIN team_player_relations tpr ON pt.team_player_relations_id=tpr.id
					WHERE t.status='1' AND pt.teams_id='".$tid."' and pt.is_approved='1' ".$serch_key."
					ORDER BY p.first_name";
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	function listofAllteamusers($tid){
  			
		  
			$sql="SELECT p.*,t.name,t.id AS tid,tpr.name AS rname
					FROM player_teams pt
					INNER JOIN teams t ON pt.teams_id =t.id
					INNER JOIN sports s ON t.sports_id=s.id
					INNER JOIN players p ON pt.players_id=p.id
					INNER JOIN team_player_relations tpr ON pt.team_player_relations_id=tpr.id
					WHERE t.status='1' AND pt.teams_id='".$tid."' and pt.is_approved='1' 
					ORDER BY p.first_name";
        $res = $this->db->query($sql);
		$data['total']=$res->num_rows();
		$data['records']=$res->result();
        return $data;
    }
	function sportsSelectBox($uid,$selected_id=0)
	{
			$sel_qry="SELECT s.id AS sid,s.name AS sname
						FROM sports s
						INNER JOIN sports_types st ON s.sports_type_id=st.id
						INNER JOIN player_sports ps ON s.id=ps.sports_id
						INNER JOIN players p ON ps.players_id=p.id
						WHERE s.status='1' AND ps.players_id='".$uid."'
						GROUP BY s.id
						ORDER BY s.name";
	
	
	$sel_qry2=$this->db->query($sel_qry)->result();
	
	$option = "<option value=''>Select Sport</option>";
	foreach($sel_qry2 as $selFet){
		$selected="";
		if($selFet->sid==$selected_id){
			$selected="selected";
		}
		
		$option .= "<option value='".$selFet->sid."' ".$selected.">".$selFet->sname."</option>";
	}
		//$option .= "<option value='custom'>Add Custom...</option>";
	
	return $option;
}
function sportsSelectBoxClub($club_id,$selected_id=0)
	{
			$sel_qry="SELECT s.id AS sid,s.name AS sname
							FROM sports s
							INNER JOIN sports_types st ON s.sports_type_id=st.id
							INNER JOIN club_sports cs ON s.id=cs.sports_id
							INNER JOIN clubs clb ON cs.clubs_id=clb.id
							WHERE s.status='1' AND cs.clubs_id='".$club_id."' 
							GROUP BY s.id
							ORDER BY s.name";
	
	
	$sel_qry2=$this->db->query($sel_qry)->result();
	
	$option = "<option value=''>Select Sport</option>";
	foreach($sel_qry2 as $selFet){
		$selected="";
		if($selFet->sid==$selected_id){
			$selected="selected";
		}
		
		$option .= "<option value='".$selFet->sid."' ".$selected.">".$selFet->sname."</option>";
	}
		//$option .= "<option value='custom'>Add Custom...</option>";
	
	return $option;
}
function addLevel($name,$recomand){
$cheeck=$this->db->query("SELECT id FROM levels WHERE name='".$name."'")->num_rows();
$lid=0;
if($cheeck==0){
$this->db->query("INSERT INTO levels (name,recommend,created_by) VALUES ('".$name."','".$recomand."',".$this->userId.")");
$lid=$this->db->insert_id();
}
return $lid;
}
function usersOfTeams($id){
		$qry=$this->db->query("SELECT p.*,tpr.name
					FROM teams t
					INNER JOIN player_teams pt ON t.id=pt.teams_id
					INNER JOIN players p ON pt.players_id=p.id
					INNER JOIN team_player_relations tpr ON pt.team_player_relations_id=tpr.id
					WHERE t.id='".$id."' AND pt.is_approved='1' order by p.first_name");
			$data['count']=$qry->num_rows();
			$data['records']=$qry->result();
			return $data;
}
function getTeams($uid,$skey,$pagenumber=0,$limit=10){
  			
		  $serch_key='';
            /*if($skey['dist']!='' and $skey['poc']!=''){
			
           	 $zipStores=$this->inradius($skey['poc'], $skey['dist']);
			if(is_array($zipStores) && count($zipStores)>0)
           		 {
                 	$zipComas=implode(',',$zipStores);
					$serch_key.=" and p.id in (".$zipComas.")";
				 }
				 else{
				 	$serch_key.=" and p.id in (0)";
				 }
			}*/
			if($skey['level']!=''){
				$serch_key.=" and l.id ='".$skey['level']."' ";
			}
			if($skey['sp']!=''){
				$serch_key.=" and s.id='".$skey['sp']."' ";
			}
			if($skey['tname']!=''){
				$serch_key.=" and t.name like '%".$skey['tname']."%' ";
			}
			$sql="SELECT t.id AS tid,t.name AS tname, IFNULL(t.logo,'') AS logo, s.name AS sname, 
				 IF(t.created_by='".$uid."',1,0) AS is_owner, CONCAT(p_w.first_name,' ',p_w.last_name) AS captain,
				(select count(distinct pt_cnt.players_id) 
				from player_teams pt_cnt where pt_cnt.teams_id=t.id and pt_cnt.is_approved='1') as cnt
				,IFNULL(pt_o.is_approved,'') AS is_approved
			FROM teams t
			INNER JOIN sports s ON t.sports_id=s.id
			INNER JOIN players p_w ON t.created_by=p_w.id
			INNER JOIN levels l ON t.level_id=l.id
			LEFT JOIN player_teams pt_o ON t.id=pt_o.teams_id AND pt_o.players_id='".$uid."'
			WHERE t.status='1' ".$serch_key."
			GROUP BY t.id
			ORDER BY t.name";
        //$res = $this->db->query($sql);
       // return $this->db->query($sql);
	   return $this->pageQuery($sql,$pagenumber,$limit);
    }
function inradius($zip, $radius) {
        $zipArray = array();
        $zip=addslashes($zip);
        $sql = "SELECT * FROM zipdata WHERE zipcode='" . $zip . "'";
        $result = $this->db->query($sql)->result();
        if ($result) {

            $lat = $result[0]->lat;
            $lon = $result[0]->lon;

            $sql2 = "SELECT z.zipcode,p.id as pid FROM zipdata as z,players p
                        WHERE (POW((69.1*(z.lon-\"$lon\")*cos($lat/57.3)),\"2\")+POW((69.1*(z.lat-\"$lat\")),\"2\"))<($radius*$radius) and p.zip = z.zipcode";
            $result2 = $this->db->query($sql2)->result();
           // print_r( $result2);
                foreach ($result2 as $zData) {
                    $zipArray[] =$zData->pid; //array($zData->storeid, $zData->zipcode);
                }
        }
        return $zipArray;
    }
function notifications($id,$user_id){
     $sql="SELECT pt.teams_id AS tid,p.gender,t.name AS tname, IFNULL(pt.is_approved,'') AS is_approved, IFNULL(t.logo,'') AS image,
			pt.teams_id AS from_id,pt.players_id AS to_d, CONCAT(p.first_name,' ',p.last_name) AS uname,IFNULL(p.image,'') as image
			,p.id as pid
			FROM player_teams pt
			INNER JOIN teams t ON pt.teams_id =t.id
			INNER JOIN sports s ON t.sports_id=s.id
			INNER JOIN players p ON pt.players_id=p.id
			WHERE t.status='1' AND pt.request_from='1' AND pt.is_approved='0' AND t.created_by='".$user_id."' AND t.id='".$id."'";
        $res = $this->db->query($sql);
		$data['records']=$res->result();
		$data['total']=$res->num_rows();
        return $data;
 }
function approveTeamPlayer($ownerid,$id,$user_id,$selected,$relationid=1){
		$sql_check=$this->db->query("SELECT id
										FROM teams WHERE created_by='".$ownerid."' AND id='".$id."'");
		if($sql_check->num_rows()){
			if($selected==2)
				$update="is_approved='1'";
			else
				$update="team_player_relations_id='".$relationid."'";
			$sql="UPDATE player_teams SET ".$update." WHERE teams_id='".$id."' AND players_id='".$user_id."' ";
			$res = $this->db->query($sql);
		}
		return true;
 }
function numofteamusers($tid){
  			
		  
			$sql=$this->db->query("SELECT p.*,t.name,t.id AS tid,tpr.name AS rname
					FROM player_teams pt
					INNER JOIN teams t ON pt.teams_id =t.id
					INNER JOIN sports s ON t.sports_id=s.id
					INNER JOIN players p ON pt.players_id=p.id
					INNER JOIN team_player_relations tpr ON pt.team_player_relations_id=tpr.id
					WHERE t.status='1' AND pt.teams_id='".$tid."' and pt.is_approved='1'");
        //$res = $this->db->query($sql);
        return $sql->num_rows();
    }
	function teamschedule_spports($tid){
	$sql=$this->db->query("SELECT COUNT(DISTINCT(ps.id)) AS total,
							s.name AS sname,ifnull(l.name,'--') AS ename,s.id as sid
							FROM player_schedule ps
							INNER JOIN schedule_users su ON ps.id=su.schedule_id
							INNER JOIN schedule_details sd ON sd.schedule_id=ps.id
							INNER JOIN sports s ON s.id=sd.sport_id
							left JOIN teams t ON t.id=su.user_id 
							left JOIN levels l ON l.id=t.level_id
							WHERE su.user_id='".$tid."' AND ps.schedule_type='3' 
							AND su.is_approve='1' AND su.match_result!='0'
							GROUP BY s.id");
			
	return $sql->result();
	}
	function teamschedule_win_loss($tid,$sid){
	$sql=$this->db->query("SELECT COUNT(DISTINCT(su.id)) AS total,su.match_result
							FROM player_schedule ps
							INNER JOIN schedule_users su ON ps.id=su.schedule_id
							INNER JOIN schedule_details sd ON sd.schedule_id=ps.id
							INNER JOIN sports s ON s.id=sd.sport_id
							WHERE su.user_id='".$tid."' AND s.id='".$sid."' AND ps.schedule_type='3' AND su.is_approve='1' AND su.match_result!='0'
							GROUP BY su.match_result");
			$data['win']=0;
			$data['loss']=0;
			$data['noresult']=0;
	foreach($sql->result() as $row){
	 if($row->match_result=='1')
	 	  $data['win']=$row->total;
		else if($row->match_result=='2')
		  $data['loss']=$row->total;
		else if($row->match_result=='3')
		  $data['noresult']=$row->total;
	}
	return $data;
	}
	function teamschedule_win_loss_team($tid){
	$sql=$this->db->query("SELECT COUNT(DISTINCT(su.id)) AS total,su.match_result
							FROM player_schedule ps
							INNER JOIN schedule_users su ON ps.id=su.schedule_id
							INNER JOIN schedule_details sd ON sd.schedule_id=ps.id
							INNER JOIN sports s ON s.id=sd.sport_id
							WHERE su.user_id='".$tid."'  AND ps.schedule_type='3' AND su.is_approve='1' AND su.match_result!='0'
							GROUP BY su.match_result");
			$data['win']=0;
			$data['loss']=0;
			$data['noresult']=0;
	foreach($sql->result() as $row){
	 if($row->match_result=='1')
	 	  $data['win']=$row->total;
		else if($row->match_result=='2')
		  $data['loss']=$row->total;
		else if($row->match_result=='3')
		  $data['noresult']=$row->total;
	}
	return $data;
	}
	function teamschedulesports($tid,$sid){
	$sql=$this->db->query("SELECT s.name AS sname,ps.start_date,ps.end_date,sd.referee_name,
							sd.location,l.name as level, 
							CASE su.match_result WHEN '1' THEN 'W' WHEN '2' THEN 'L' WHEN '3' THEN 'NR' ELSE 'W' END AS match_result, 
							t.name AS tname
						FROM player_schedule ps
						INNER JOIN schedule_users su ON ps.id=su.schedule_id
						INNER JOIN schedule_details sd ON sd.schedule_id=ps.id
						INNER JOIN sports s ON s.id=sd.sport_id
						INNER JOIN player_schedule ps2 ON ps2.id=su.schedule_id
						INNER JOIN schedule_users su2 ON ps2.id=su2.schedule_id
						INNER JOIN teams t ON t.id=su2.user_id AND su2.user_id!='".$tid."'
						left JOIN teams t2 ON t2.id=su.user_id 
							left JOIN levels l ON l.id=t2.level_id
						WHERE su.user_id='".$tid."' AND s.id='".$sid."' AND ps.schedule_type='3' AND ps.is_over='0' AND su.is_approve='1' AND su.match_result!='0'
						GROUP BY ps.id
						ORDER BY s.name");
	#echo "<pre>"; print_r($sql->result()); echo "</pre>";					
	return $sql->result();
	}
	function teamname_check($name,$city,$id=0){
		$sql="select id from teams where name='".$this->db->escape_str($name)."' and city='".$this->db->escape_str($city)."'";
		if($id!=0 && $id!='')
		$sql.=" and id!='".$this->db->escape_str($id)."'";
		return $this->db->query($sql)->num_rows();
	}
}

?>
