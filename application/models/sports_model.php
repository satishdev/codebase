<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sports_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

  function listofsports($uid,$pagenumber=0,$limit,$serch_key,$search=''){
  			
		  if($serch_key!=''){
		  	$serch_key=" AND s.name like '%".$serch_key."%'";
		  }
		   if($search!=''){
		  	$serch_key=" AND s.name like '".$search."%'";
		  }
		$sql="SELECT s.id AS sid,s.name AS sname,s.logo, st.name AS stname, sd.*,
				IFNULL(ps.id,0) AS pid, IF(p.id='".$uid."',1,0) AS is_owner
				FROM sports s
				INNER JOIN sports_types st ON s.sports_type_id=st.id
				LEFT JOIN sports_dimensions sd ON s.id=sd.sports_id
				INNER JOIN players p ON s.user_id=p.id
				LEFT JOIN player_sports ps ON s.id=ps.sports_id AND ps.players_id='".$uid."'
				WHERE s.status='1' ".$serch_key."
				GROUP BY s.id
				ORDER BY s.name";
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	function listofmysports($uid,$pagenumber=0,$limit,$serch_key,$search=''){
  			
		  if($serch_key!=''){
		  	$serch_key=" and s.name like '%".$serch_key."%'";
		  }
		  if($search!=''){
		  	$serch_key=" and s.name like '".$search."%'";
		  }
		$sql="SELECT s.id AS sid,s.name AS sname, IFNULL(s.logo,'') AS logo, st.name AS stname, sd.*,
				IFNULL(ps.id,0) AS pid, IF(p.id='".$uid."',1,0) AS is_owner,l.name AS lname
				FROM sports s
				INNER JOIN sports_types st ON s.sports_type_id=st.id
				LEFT JOIN sports_dimensions sd ON s.id=sd.sports_id
				INNER JOIN players p ON s.user_id=p.id
				INNER JOIN player_sports ps ON s.id=ps.sports_id
				INNER JOIN levels l ON l.id=ps.expert_id
				WHERE s.status='1' AND ps.players_id='".$uid."' ".$serch_key." 
				GROUP BY s.id
				ORDER BY s.name";
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	function listofmysportsClubs($club_id,$pagenumber=0,$limit,$serch_key,$search=''){
  			
		  if($serch_key!=''){
		  	$serch_key=" and s.name like '%".$serch_key."%'";
		  }
		  if($search!=''){
		  	$serch_key=" and s.name like '".$search."%'";
		  }
		$sql="SELECT s.id AS sid,s.name AS sname, IFNULL(s.logo,'') AS logo, 
				st.name AS stname
				FROM sports s
				INNER JOIN sports_types st ON s.sports_type_id=st.id
				LEFT JOIN sports_dimensions sd ON s.id=sd.sports_id
				INNER JOIN club_sports cs ON s.id=cs.sports_id
				INNER JOIN clubs clb ON cs.clubs_id=clb.id
				WHERE s.status='1' AND cs.clubs_id='".$club_id."' ".$serch_key."
				GROUP BY s.id
				ORDER BY s.name";
				//echo $sql;exit;
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	function listofmoresports($uid,$owner_id,$pagenumber=0,$limit,$serch_key,$search=''){
  			
		  if($serch_key!=''){
		  	$serch_key=" AND s.name like '%".$serch_key."%'";
		  }
		  if($search!=''){
		  	$serch_key=" and s.name like '".$search."%'";
		  }
		$sql="SELECT s.id AS sid,s.name AS sname, IFNULL(s.logo,'') AS logo, st.name AS stname, 
				IFNULL(ps.id,0) AS pid, IF(p.id='".$owner_id."',1,0) AS is_owner,IFNULL(ps_o.id,0) AS ps_o_id
				FROM sports s
				INNER JOIN sports_types st ON s.sports_type_id=st.id
				INNER JOIN players p ON s.user_id=p.id
				INNER JOIN player_sports ps ON s.id=ps.sports_id
				left JOIN player_sports ps_o ON s.id=ps_o.sports_id and ps_o.players_id='".$owner_id."'
				WHERE s.status='1' AND ps.players_id='".$uid."' ".$serch_key."
				GROUP BY s.id
				ORDER BY s.name";
        //$res = $this->db->query($sql);
        return $this->pageQuery($sql,$pagenumber,$limit);
    }
	 function checkSp($sid,$uid){
        $num=$this->db->query("select id from player_sports WHERE players_id='".$uid."' AND sports_id='".$sid."'")->num_rows();
        //$res = $this->db->query($sql);
        return $num;
    }
	function checkSpName($sp_name,$sid=0){
		$sql='';
		if($sid!=0){
			$sql=" AND id!='".$sid."' ";
		}
        $num=$this->db->query("select id from sports WHERE  name='".$this->db->escape_str($sp_name)."'".$sql)->num_rows();
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
   function removeSp($sp_id,$uid){
   				$this->db->query("delete from player_sports WHERE players_id='".$uid."' AND sports_id='".$sp_id."'");
				return true;
   }
   function viewSports($sp_id,$uid){
   				$sql=$this->db->query("select s.id as sid, s.name as sname,s.sports_type_id, s.description, sd.id as sdid, sd.no_of_players,
					sd.played_players, sd.`duration`, sd.`width`, sd.`height`, sd.`area`, sd.`terms`, sd.`notes` from sports s 
					LEFT JOIN sports_dimensions sd on s.id=sd.sports_id
				 	WHERE s.user_id='".$uid."' AND s.id='".$sp_id."' LIMIT 1");
				 if($sql->num_rows()>0){
				 	return $sql->row();;
				 }else{
					return false;
				}
   }
   
  function patnersSports($uid,$fid){
   				$sql=$this->db->query("SELECT s.id AS sid,s.name AS sname
					FROM sports s
					INNER JOIN player_sports ps ON s.id=ps.sports_id 
					/*INNER JOIN player_sports ps2 ON s.id=ps2.sports_id and ps2.players_id='".$fid."'*/
					WHERE s.status='1' and ps.players_id='".$uid."'
					group by s.id 
					ORDER BY s.name");
				return $sql->result();
   }
}

?>
