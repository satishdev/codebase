<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	/**
	 * login
	 *
	 * @return bool
	 * @author shankar
	 **/
	public  function activation_code_user()
	{
		$activation_code       = sha1(md5(microtime()));
		return $activation_code;
	}
	/**
	 * login
	 *
	 * @return bool
	 * @author shankar
	 **/
	public  function activate($id,$code,$auto_login=true)
	{
		$qry=$this->db->query("SELECT id from players where id='".$this->db->escape_str($id)."' 
												   and activation_code='".$this->db->escape_str($code)."'");
			if($qry->num_rows() > 0)
			{
				$this->db->query("UPDATE players SET status='1', activation_code='' where id='".$this->db->escape_str($id)."'");
				/*if($auto_login)
				{
					$row=$this->get_user_by_id($id);
					$this->login($row->login, $row->password);
					
				}*/
				 return true;
			}
			else
			{
				return false;
			}
	}
	public  function get_user_by_email_num($email,$user_id=0)
	{	
			$qry="SELECT id from players where email='".$this->db->escape_str($email)."'";
			if($user_id!=0)
			$qry.=" AND id!='".$user_id."'";
			$sql=$this->db->query($qry);

	    return $sql->num_rows();
	}
  function update_user_image($post){
        $sql="select u.id from players as u where u.id='".$post['id']."' and u.password='".$post['psw']."' and u.status='1'";
        $res = $this->db->query($sql);
        return $res->result();
    }

    function validate_user($post){
        $sql="select u.* from players as u where u.id='".$post['id']."'  and u.status='1'";
        $res = $this->db->query($sql);
		if($res->num_rows()>0){
			$row=$res->row();
			if($this->encrypt->decode($row->password)==$post['psw']){
				return $row;
			}else{
				return false;
			}
		}
        return false;
    }
function players_details($player_id){
        $sql="select u.*,IFNULL(c.name,'') as cname from players as u 
		left join country c on u.country_id=c.id where u.id='".$player_id."' limit 1";
        $res = $this->db->query($sql);
		if($res->num_rows()>0)
        return $res->row();
		else
		 return false;
    }
	function alert_details($player_id,$a=0){
        $sql="select pa.id, pa.players_id, pa.keywords,IFNULL(sp.id,0) as spid, IFNULL(sp.name,'') as spname from players as u
		inner join player_alerts pa on u.id=pa.players_id 
		left join sports sp on pa.sports_id=sp.id where u.id='".$player_id."'";
		if($a!=0){
		 $sql.=" and pa.id='".$a."'";
		}
        $res = $this->db->query($sql);
        return $res->result();
    }
	
	function interest_details($player_id,$id=0){
       $sql="select pint.*,IFNULL(i.name,'') as iname from players as u
		inner join player_interests pint on u.id=pint.players_id 
		left join interests i on pint.intersts_id=i.id where u.id='".$player_id."'";
		if($id!=0){
			$sql.=" and pint.id='".$id."'";
		}
        $res = $this->db->query($sql);
        return $res->result();
    }
	function work_details($player_id,$id=0){
        $sql="select pe.*,c.name as cname from players as u
		inner join player_expierence pe on u.id=pe.players_id 
		left join country c on pe.country_id=c.id where u.id='".$player_id."'";
		if($id!=0){
			$sql.=" and pe.id='".$id."'";
		}
        $res = $this->db->query($sql);
        return $res->result();
    }
	function education_details($player_id,$eid=0){
        $sql="select pe.*,IFNULL(c.name,'') as cname,IFNULL(e.name,'') as ename from players as u
		inner join player_education pe on u.id=pe.players_id
		left join country c on pe.country_id=c.id 
		left join education e on pe.educations_id=e.id
		where u.id='".$player_id."'";
		if($eid!=0){
			$sql.=" and pe.id='".$eid."'";
		}
        $res = $this->db->query($sql);
        return $res->result();
    }
function validate_player_email($post){
        $sql="select u.id from players as u where u.id='".$post['email']."'";
        $res = $this->db->query($sql);
        	return $res->num_rows();
    }
   function alert_delete($uid,$id){
        $sql="delete from player_alerts where players_id='".$uid."' and id='".$id."'";
         $this->db->query($sql);
        	return true;
    }
	function education_delete($uid,$id){
        $sql="delete from player_education where players_id='".$uid."' and id='".$id."'";
         $this->db->query($sql);
        	return true;
    }
	function expierence_delete($uid,$id){
        $sql="delete from player_expierence where players_id='".$uid."' and id='".$id."'";
         $this->db->query($sql);
        	return true;
    }
	function interest_delete($uid,$id){
        $sql="delete from player_interests where players_id='".$uid."' and id='".$id."'";
         $this->db->query($sql);
        	return true;
    }

    function get_user_calender_events($user_id,$ed,$sd){
        //$sql="select * from player_schedule where players_id='".$user_id."' ";
		 $sql="SELECT ps.*
				FROM player_schedule ps
				INNER JOIN schedule_users su ON ps.id=su.schedule_id
				INNER JOIN players p ON su.user_id=p.id and su.user_type='1'
				WHERE is_approved='1' and su.user_id='".$user_id."' AND ps.start_date between '"
      .php2MySqlTime($ed)."' and '". php2MySqlTime($sd)."' group by ps.id";
        $res=$this->db->query($sql);
        return $res->result();
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
   function listofmyplayers($uid,$pagenumber=0,$limit,$serch_key){
  			
		  if($serch_key!=''){
		  	$serch_key=" and (p.first_name like '%".$serch_key."%' or p.last_name like '%".$serch_key."%')";
		  }
        $sql="select p.id as pid,p.gender as gender,CONCAT(p.first_name,' ',p.last_name) as pname,IFNULL(pf.is_approved,'') as is_approved,IFNULL(p.image,'') as image,c.name as cname
						from players p 
						inner join country c on p.country_id=c.id
						left join player_friends pf on p.id=pf.`to` and pf.`from`='".$uid."' 
						where p.status='1' and p.player_types_id='2' and p.id!='".$uid."' and pf.is_approved='1' 
						and `from`='".$uid."' ".$serch_key." group by p.id order by pname";
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
    function listofplayers($uid,$pagenumber=0,$limit,$serch_key){
  			
		  if($serch_key!=''){
		  	$serch_key=" and (p.first_name like '%".$serch_key."%' or p.last_name like '%".$serch_key."%')";
		  }
       
		$sql="select  p.id as pid,p.gender,CONCAT(p.first_name,' ',p.last_name) as pname,
				IFNULL(pf.is_approved,'') as is_approved,IFNULL(p.image,'') as image
				,pf.`from`,pf.`to`,pr.name as rname,c.name as cname
				,(
					SELECT COUNT(pf_c.id) AS cnt
					FROM player_friends pf_c
					WHERE pf_c.`from`=p.id AND pf_c.is_approved='1') AS frd_cnt
				from players p
				inner join country c on p.country_id=c.id
				left join player_friends pf on (p.id=pf.`to` or p.id=pf.`from`) and (pf.`to`='".$uid."' or pf.`from`='".$uid."')
				left join player_relations pr on pf.player_relations_id=pr.id
				where p.status='1' and
				p.player_types_id='2' 
				and p.id!='".$uid."' and p.id not in (select `from` from player_friends where `from`='".$uid."' or `to`='".$uid."' ) ".$serch_key."  group by p.id
				order by pname";		
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	function checkPl($pid,$uid){
        $num=$this->db->query("select id from player_friends where (`from`='".$uid."' and `to`='".$pid."') or (`to`='".$uid."' and `from`='".$pid."')")->num_rows();
        //$res = $this->db->query($sql);
        return $num;
    }
	function removePl($pid,$uid){
   				$this->db->query("delete from player_friends where (`from`='".$uid."' and `to`='".$pid."') or (`to`='".$uid."' and `from`='".$pid."')");
				return true;
   }
    function approvePl($pid,$uid){
   			$sql=$this->db->query("update player_friends set is_approved='1',player_relations_id='1' where `from`='".$pid."' and `to`='".$uid."'");
				return true;
   }
   function setrelationPl($pid,$uid,$rel_id){
   			$sql=$this->db->query("update  player_friends set player_relations_id='".$rel_id."' where `from`='".$uid."' and `to`='".$pid."'");
				return true;
   }
   function isfriend($uid,$pid){
   			$sql=$this->db->query("select * from player_friends where (`from`='".$uid."' and `to`='".$pid."') or (`to`='".$uid."' and `from`='".$pid."')");
			if($sql->num_rows()>0){
				return $sql->row();
			}else{
				return false;
			}
   }
   function friends($uid,$pagenumber=0,$limit,$serch_key){
  			
		  if($serch_key!=''){
		  	$serch_key=" and (p.first_name like '%".$serch_key."%' or p.last_name like '%".$serch_key."%')";
		  }
    
		 $sql="select  p.id as pid,p.gender,CONCAT(p.first_name,' ',p.last_name) as pname,IFNULL(pf.is_approved,'') as is_approved, 
				 IFNULL(p.image,'') as image,pf.`from`,pf.`to`,pr.name as rname,pr.id as prid,c.name as cname
				,(
					SELECT COUNT(pf_c.id) AS cnt
					FROM player_friends pf_c
					WHERE pf_c.`from`=p.id AND pf_c.is_approved='1') AS frd_cnt
				from players p
				inner join player_friends pf on p.id=pf.`to` 
				inner join country c on p.country_id=c.id
				left join player_relations pr on pf.player_relations_id=pr.id
				where p.status='1' and
				p.player_types_id='2' and p.id!='".$uid."' and pf.is_approved='1'
				and   `from`='".$uid."' ".$serch_key." 
				order by p.first_name";
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	 function morefriends($uid,$pagenumber=0,$limit,$serch_key){
  			
		  if($serch_key!=''){
		  	$serch_key=" and (p.first_name like '%".$serch_key."%' or p.last_name like '%".$serch_key."%')";
		  }
        $sql="select  p.id as pid,p.gender,CONCAT(p.first_name,' ',p.last_name) as pname,IFNULL(p.image,'') as image,c.name as cname
				from players p
				inner join country c on p.country_id=c.id
				inner join player_friends pf on p.id=pf.`to` or  p.id=pf.`from`
				where p.status='1' and
				p.player_types_id='2' 
				and p.id!='".$uid."' and pf.is_approved='1'  and (`from`='".$uid."' or `to`='".$uid."')  ".$serch_key." 
				order by p.first_name";
        //$res = $this->db->query($sql);
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
	function getPlayers($uid,$skey,$pagenumber=0,$limit=10){
	        $query='';
            if($skey['dist']!='' and $skey['poc']!=''){
			
           	 $zipStores=$this->inradius($skey['poc'], $skey['dist']);
			if(is_array($zipStores) && count($zipStores)>0)
           		 {
                 	$zipComas=implode(',',$zipStores);
					$query.=" and p.id in (".$zipComas.")";
				 }
				 else{
				 	$query.=" and p.id in (0)";
				 }
			}
			if($skey['fname']!=''){
				$query.=" and p.first_name like '%".$skey['fname']."%' ";
			}
			if($skey['lname']!=''){
				$query.=" and p.last_name like '%".$skey['lname']."%' ";
			}
			
			
				 
			$sql="select  p.id as pid,p.gender,CONCAT(p.first_name,' ',p.last_name) as pname,IFNULL(pf.is_approved,'') as is_approved,IFNULL(p.image,'') as image,c.name as cname
					from players p 
					inner join country c on p.country_id=c.id";
			if($skey['sp']!=''){
					$sql.=" inner join player_sports ps on p.id=ps.players_id ";
			}
				$sql.=" left join player_friends pf on p.id=pf.`to` and pf.`from`='".$uid."'
					where p.status='1' and
					p.player_types_id='2' 
					and p.id!='".$uid."' ".$query; 
			if($skey['sp']!=''){
					$sql.=" and ps.sports_id='".$skey['sp']."' ";
			}
					$sql.=" group by p.id order by p.first_name";
               
               //return $this->db->query($sql);
			    return $this->pageQuery($sql,$pagenumber,$limit);
                
            
	}
	function requestfriends($uid,$pagenumber=0,$limit){
  			
	
				$sql="(select  p.id as pid,p.gender,CONCAT(p.first_name,' ',p.last_name) as pname,
						IFNULL(pf.is_approved,'') as is_approved,IFNULL(p.image,'') as image,pf.`from` as from_id,
						pf.`to` as to_id,'1' as is_type, p.date_added
						from players p
						inner join player_friends pf on p.id=pf.`from`
						where p.status='1' and
						p.player_types_id='2' 
						and p.id!='".$uid."' and `to`='".$uid."' and pf.is_approved='0'  order by p.date_added)
						UNION
						(select  pt.teams_id as pid,p.gender,t.name as pname,
						IFNULL(pt.is_approved,'') as is_approved,IFNULL(t.logo,'') as image,
						pt.teams_id as from_id,pt.players_id as to_d,'2' as is_type, p.date_added
						from player_teams pt 
						inner join teams t on pt.teams_id =t.id
						inner join sports s on t.sports_id=s.id 
						inner join players p on pt.players_id=p.id
						where t.status='1' and pt.request_from='0' and pt.is_approved='0' and  pt.players_id='".$uid."' order by p.date_added)";
						if($this->userType==3){
						$sql.=" UNION (SELECT cp.id AS pid,p.gender, CONCAT(p.first_name,' ',p.last_name) AS pname,
						 IFNULL(cp.is_approved,'') AS is_approved, IFNULL(p.image,'') AS image,'2' AS from_id,
								'3' AS to_id,'3' AS is_type, p.date_added
							FROM club_players cp
							INNER JOIN players p ON cp.players_id=p.id
							INNER JOIN clubs clb ON cp.clubs_id=clb.id
							WHERE clb.id='".$this->clubId."' and is_approved='0' order by p.date_added ) as allrecords)";
							}
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
		
    }
	function requestteams($uid,$pagenumber=0,$limit){
  			
		  
        $sql="select  p.id as pid,t.name as pname,
						IFNULL(pt.is_approved,'') as is_approved,IFNULL(t.logo,'') as image,
						pt.teams_id as from_id,pt.players_id as to_d,'2' as is_type
						from player_teams pt 
						inner join teams t on pt.teams_id =t.id
						inner join sports s on t.sports_id=s.id 
						inner join players p on pt.players_id=p.id
						where t.status='1' and  pt.players_id='".$uid."'";
				
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
    function get_teams_calender_events($teams_id,$ed,$sd){
      //$sql="select * from player_schedule where players_id='".$user_id."' ";
		 $sql="SELECT ps.id, ps.description,ps.start_date,ps.end_date,ps.schedule_type,ps.isalldayevent,ps.color
				FROM player_schedule ps
				INNER JOIN schedule_users su ON ps.id=su.schedule_id
				INNER JOIN teams t ON su.user_id=t.id 
				WHERE su.user_id='".$teams_id."' AND su.user_type='2' AND ps.start_date between '"
      .php2MySqlTime($ed)."' and '". php2MySqlTime($sd)."' group by ps.id";
        $res=$this->db->query($sql);
        return $res->result();
    }
	
	function myfriends($uid){
        $sql="select  p.id as pid,p.gender,CONCAT(p.first_name,' ',p.last_name) as pname,IFNULL(pf.is_approved,'') as is_approved,IFNULL(p.image,'') as image,pf.`from`,pf.`to`
				from players p
				inner join player_friends pf on p.id=pf.`to` 
				where p.status='1' and
				p.player_types_id='2' and p.id!='".$uid."'
				and   `from`='".$uid."' and pf.is_approved='1' order by p.first_name";
        //$res = $this->db->query($sql);
        return $this->db->query($sql)->result();
    }
	function friendsrelations(){
        $sql="select  id,name as label
				from player_relations where status='1' order by name";
        //$res = $this->db->query($sql);
        return $this->db->query($sql)->result();
    }
	function teamrelations(){
        $sql="select  id,name as label
				from team_player_relations where status='1' order by name";
        //$res = $this->db->query($sql);
        return $this->db->query($sql)->result();
    }
	function scheduleUsers($id){
        $sql="SELECT CONCAT(p.first_name,' ',p.last_name) AS name
				FROM player_schedule ps
				INNER JOIN schedule_users su ON ps.id=su.schedule_id
				INNER JOIN players p ON su.user_id=p.id
				WHERE ps.id='".$id."'";
        //$res = $this->db->query($sql);
       $res=$this->db->query($sql)->result();
	   $retrn='';
	   foreach($res as $row){
	   		$retrn.=$row->name.' Vs ';
	   }
	   return trim($retrn,' Vs ');
    }
	function scheduleTeams($id){
        $sql="SELECT t.name AS name
			FROM player_schedule ps
			INNER JOIN schedule_users su ON ps.id=su.schedule_id
			INNER JOIN teams t ON su.user_id=t.id
			WHERE ps.id='".$id."'";
        //$res = $this->db->query($sql);
       $res=$this->db->query($sql)->result();
	   $retrn='';
	   foreach($res as $row){
	   		$retrn.=$row->name.' Vs ';
	   }
	   return trim($retrn,' Vs ');
    }
	
	function inviteTeamPlayers($tid,$user_id){
	/* $sql="SELECT p.id AS pid,p.gender, CONCAT(p.first_name,' ',p.last_name) AS pname, IFNULL(p.image,'') AS image
			FROM players p
			WHERE p.player_types_id='2' AND p.id NOT IN (
			SELECT pt.players_id
			FROM player_teams pt
			WHERE pt.teams_id='".$tid."')
			ORDER BY pname";*/
			$sql="SELECT p.id AS pid,p.gender, CONCAT(p.first_name,' ',p.last_name) AS pname, IFNULL(p.image,'') AS image, IFNULL(pt.players_id,0) AS tuser
					FROM players p
					INNER JOIN player_friends pf ON p.id=pf.`to`
					LEFT JOIN player_teams pt ON p.id=pt.players_id AND pt.teams_id='".$tid."'
					WHERE p.player_types_id='2' AND pf.is_approved='1' AND (pf.`from`='".$user_id."')
					GROUP BY p.id
					ORDER BY pname";
        //$res = $this->db->query($sql);
        return $this->db->query($sql)->result();
	}
	  function composeFriends($uid){
  		
    
		 $sql="select  p.id as pid,CONCAT(p.first_name,' ',p.last_name) as pname,p.email
				from players p
				inner join player_friends pf on p.id=pf.`to` 
				inner join country c on p.country_id=c.id
				left join player_relations pr on pf.player_relations_id=pr.id
				where p.status='1' and
				p.player_types_id='2' and p.id!='".$uid."' and pf.is_approved='1'
				and   `from`='".$uid."' 
				order by pname";
        //$res = $this->db->query($sql);
        return $this->db->query($sql)->result();
    }
 function userschedule_spports($uid){
	$sql=$this->db->query("SELECT COUNT(DISTINCT(ps.id)) AS total,
							s.name AS sname,ifnull(l.name,'--') AS ename,s.id as sid
							FROM player_schedule ps
							INNER JOIN schedule_users su ON ps.id=su.schedule_id
							INNER JOIN schedule_details sd ON sd.schedule_id=ps.id
							INNER JOIN sports s ON s.id=sd.sport_id
							left JOIN player_sports psrts ON s.id=psrts.sports_id  
							left JOIN levels l ON l.id=psrts.expert_id
							WHERE su.user_id='".$uid."' AND ps.schedule_type='2' AND ps.is_over!='0' 
							AND su.is_approve='1' AND su.match_result!='0'
							GROUP BY s.id");
			
	return $sql->result();
	}
	function userschedule_win_loss($uid,$sid){
	$sql=$this->db->query("SELECT COUNT(DISTINCT(su.id)) AS total,su.match_result
							FROM player_schedule ps
							INNER JOIN schedule_users su ON ps.id=su.schedule_id
							INNER JOIN schedule_details sd ON sd.schedule_id=ps.id
							INNER JOIN sports s ON s.id=sd.sport_id
							WHERE su.user_id='".$uid."' AND s.id='".$sid."' AND ps.schedule_type='2' AND ps.is_over!='0' AND su.is_approve='1' AND su.match_result!='0'
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
	function players_frd_count($uid){
	$sql=$this->db->query("SELECT COUNT(pf_c.id) AS cnt
					FROM player_friends pf_c
					WHERE pf_c.`from`='".$uid."' AND pf_c.is_approved='1' limit 1")->row();
					return $sql->cnt;
	}
	function players_sports_count($uid){
	$sql=$this->db->query("SELECT COUNT(ps.id) AS cnt
							FROM player_sports ps
							INNER JOIN sports s ON ps.sports_id=s.id
							WHERE ps.players_id='".$uid."' AND s.`status`='1' limit 1")->row();
					return $sql->cnt;
	}
	function players_teams_count($uid){
	$sql=$this->db->query("SELECT COUNT(pt.id) AS cnt
							FROM player_teams pt
							INNER JOIN teams t ON t.id=pt.teams_id
							WHERE pt.players_id='".$uid."' AND t.`status`='1' AND pt.is_approved='1' limit 1")->row();
					return $sql->cnt;
	}
	function players_is_friend($uid,$frd_id){
	$sql=$this->db->query("select * from player_friends where `from`='".$uid."' and `to`='".$frd_id."' and is_approved='1'");
					return $sql->num_rows();
	}
	function playersschedulesports($uid,$sid){
	$sql=$this->db->query("SELECT s.name AS sname,ps.start_date,ps.end_date,sd.referee_name,
							sd.location,l.name as level, 
							CASE su.match_result WHEN '1' THEN 'W' WHEN '2' THEN 'L' WHEN '3' THEN 'NR' ELSE 'W' END AS match_result, 
							CONCAT(p.first_name,' ',p.first_name) AS pname
						FROM player_schedule ps
						INNER JOIN schedule_users su ON ps.id=su.schedule_id
						INNER JOIN schedule_details sd ON sd.schedule_id=ps.id
						INNER JOIN sports s ON s.id=sd.sport_id
						INNER JOIN player_schedule ps2 ON ps2.id=su.schedule_id
						INNER JOIN schedule_users su2 ON ps2.id=su2.schedule_id
						INNER JOIN players p ON p.id=su2.user_id AND su2.user_id!='".$uid."'
						LEFT JOIN player_sports psrts ON s.id=psrts.sports_id
						LEFT JOIN levels l ON l.id=psrts.expert_id
						WHERE su.user_id='".$uid."' AND s.id='".$sid."' AND ps.schedule_type='2' AND ps.is_over!='0' AND su.is_approve='1' AND su.match_result!='0'
						GROUP BY ps.id
						ORDER BY s.name");
			
	return $sql->result();
	}
	
	//Emails
	
	function friend_request($uid){
		if(SEND_EMAIL){
		$this->load->library('email');
		$this->email->mailtype="html";
		$data['u_details']=$this->players_details($uid);
		$msg=$this->load->view('email/friend_request',$data,TRUE);
		 $from='member@wesport.com';//'wesportonline@gmail.com';
		//$subject='sPartner Request from '.$this->userFname.' '.$this->userLname;
		$subject='Join me on WESport';
		$to=$data['u_details']->email;
		$this->email->from($from,'WESport');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($msg);
		//$this->email->send();
		}
	}
	//Emails
	
	function friend_accept($uid){
		if(SEND_EMAIL){
		$this->load->library('email');
		$this->email->mailtype="html";
		$data['u_details']=$this->players_details($uid);
		$msg=$this->load->view('email/friend_accept',$data,TRUE);
		 $from='member@wesport.com';//'wesportonline@gmail.com';
		//$subject='sPartner Request from '.$this->userFname.' '.$this->userLname;
		$subject='You are connected with sPartner on WESport';
		$to=$data['u_details']->email;
		$this->email->from($from,'WESport');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($msg);
		//$this->email->send();
		}
	}
	//Email
	function team_invite($tid,$uid){
	if(SEND_EMAIL){
			$this->load->library('email');
			$this->email->mailtype="html";
			$data['u_details']=$this->players_details($uid);
			$data['t_details']=$this->getTeamProfile($tid);
			$msg=$this->load->view('email/team_invite',$data,TRUE);
			 $from='member@wesport.com';//'wesportonline@gmail.com';
			//$subject='Team Invite from '.$this->userFname.' '.$this->userLname;
			$subject='Join our team '.ucwords($data['t_details']->name).' on WESport';
			$to=$data['u_details']->email;
			$this->email->from($from,'WESport');
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($msg);
			//$this->email->send();
		}
	}
	//Email
	function team_request_accept($tid,$uid){
	if(SEND_EMAIL){
			$this->load->library('email');
			$this->email->mailtype="html";
			$data['u_details']=$this->players_details($uid);
			$data['t_details']=$this->getTeamProfile($tid);
			$msg=$this->load->view('email/team_request_accept',$data,TRUE);
			 $from='member@wesport.com';//'wesportonline@gmail.com';
			//$subject='Team Invite from '.$this->userFname.' '.$this->userLname;
			$subject=ucwords($data['u_details']->first_name.' '.$data['u_details']->last_name).' sParnter has accepted your '.ucwords($data['t_details']->name).' Request on WESport';
			$to=$data['t_details']->email;
			$this->email->from($from,'WESport');
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($msg);
			//$this->email->send();
		}
	}
	//Email
	function team_request($tid,$uid){
	if(SEND_EMAIL){
		$this->load->library('email');
		$this->email->mailtype="html";
		$data['u_details']=$this->players_details($uid);
		$data['t_details']=$this->getTeamProfile($tid);
		$msg=$this->load->view('email/team_request',$data,TRUE);
		 $from='member@wesport.com';//'wesportonline@gmail.com';
		$subject='Request to Join '.ucwords($data['t_details']->name).' on WESport';
		$to=$data['t_details']->email;
		$this->email->from($from,'WESport');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($msg);
		//$this->email->send();
		}
	}
	 function getTeamProfile($tid){
			$sql=$this->db->query("SELECT t.*,p.id as pid,p.email,p.first_name,p.last_name
									FROM teams t
									INNER JOIN players p on p.id=t.created_by
									LEFT JOIN sports s on t.sports_id=s.id
									LEFT JOIN levels l on t.level_id=l.id
									WHERE t.status='1' AND t.id='".$tid."' limit 1");
			 if($sql->num_rows()>0){
				 		return $sql->row();;
				 }else{
						return false;
				}
}
//Email
	function player_schedule_match($uid,$sid){
	if(SEND_EMAIL){
		$this->load->library('email');
		$this->email->mailtype="html";
		$data['sh']=$this->db->query("SELECT * FROM player_schedule WHERE id='".$sid."' limit 1")->row();
		$data['u_details']=$this->players_details($uid);
		$msg=$this->load->view('email/schedule_player_match',$data,TRUE);
		$from='member@wesport.com';//'wesportonline@gmail.com';
		//$subject='Player Match from '.$this->userFname.' '.$this->userLname;
		$subject='Match Agenda ('.ucwords($this->userFname.' '.$this->userLname).' vs '.ucwords($data['u_details']->first_name. ' '.$data['u_details']->last_name).') on  '.date('m-d-Y',strtotime($data['sh']->start_date)).' at '.date('H:i a',strtotime($data['sh']->start_date));
		$to=$data['u_details']->email;
		$this->email->from($from,'WESport');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($msg);
		//$this->email->send();
		}
	}
	function team_schedule_match($tid){
		$this->load->library('email');
		$this->email->mailtype="html";
		$data['t_details']=$this->getTeamProfile($tid);
		$msg=$this->load->view('email/schedule_team_match',$data,TRUE);
		$from='wesportonline@gmail.com';
		$subject='Team Match from '.$this->userFname.' '.$this->userLname;
		$to=$data['t_details']->email;
		$this->email->from($from,'WESport');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($msg);
		//$this->email->send();
	}
	function is_schedule_win_loss($id,$uid)
	{
		$sql=$this->db->query("SELECT su.match_result,su.id
								FROM player_schedule ps
								INNER JOIN schedule_users su ON ps.id=su.schedule_id
								WHERE ps.id='".$id."' AND su.user_id!='".$uid."'
								LIMIT 1");
		if($sql->num_rows()>0)
		{
			return $sql->row()->match_result;
		}
		else
		{
			return 0;
		}						
	}
}
?>
