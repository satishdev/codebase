<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clubs_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
protected function pageQuery($sql,$offset=0,$limit=0,$type='object'){
		
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
function club_details($player_id){
        $sql="SELECT u.*, IFNULL(c.name,'') AS countryname,cl.name AS clname,cl.description1,cd.no_of_courts,cd.width,cd.height,cd.area,cd.terms,cd.notes
				FROM players AS u
				INNER JOIN clubs cl ON u.id=cl.club_owner
				LEFT JOIN club_dimensions cd ON cd.clubs_id=cl.id
				LEFT JOIN country c ON u.country_id=c.id
				WHERE u.id='".$player_id."'
				LIMIT 1";
        $res = $this->db->query($sql);
		if($res->num_rows()>0)
        return $res->row();
		else
		 return false;
    }
function club_dimensions_id($cb_id){
        $sql="SELECT id from club_dimensions 
				WHERE clubs_id='".$cb_id."'	LIMIT 1";
        $res = $this->db->query($sql);
		if($res->num_rows()>0)
        return $res->row()->id;
		else
		 return false;
    }	
function list_facilities($c_id,$pagenumber=0,$limit,$serch_key,$search='',$type=0){
		$sql="SELECT f.id,f.name, f.description
				FROM club_facilities cf
				INNER JOIN clubs c ON cf.clubs_id=c.id
				INNER JOIN facilities f ON cf.facilities_id=f.id
				WHERE cf.clubs_id='".$c_id."'";
		if($type){
				return $this->db->query($sql)->result();
			}else{	
		 		return $this->pageQuery($sql,$pagenumber,$limit);
		 }
    }
	
function list_holydays($c_id,$pagenumber=0,$limit,$serch_key,$search='',$type=0){
		$sql="SELECT ch.id,ch.name, ch.description, ch.holiday_date
				FROM club_holidays ch
				INNER JOIN clubs c ON ch.clubs_id=c.id
				WHERE ch.clubs_id='".$c_id."'";
			if($type){
				return $this->db->query($sql)->result();
			}else{	
		 		return $this->pageQuery($sql,$pagenumber,$limit);
		 }
    }
	
function list_news($c_id,$pagenumber=0,$limit,$serch_key,$search='',$type=0){
		$sql="SELECT cn.id,cn.headline, cn.description
				FROM club_news cn
				INNER JOIN clubs c ON cn.clubs_id=c.id
				WHERE cn.clubs_id='".$c_id."'";
		if($type){
				return $this->db->query($sql)->result();
			}else{	
		 		return $this->pageQuery($sql,$pagenumber,$limit);
		 }
    }

function check_club_facility($facility_name, $club_id){
		$sql = "select f.id from facilities f
				inner join club_facilities cf on (f.id=cf.facilities_id and cf.clubs_id='".$club_id."')
				where f.name='".$facility."'";
		$num = $this->db->query($sql)->num_rows();
		return $num;
	}
function club_facility_details($fid, $club_id){
		$sql =  $this->db->query("select f.*,c.name as cname from facilities f
				inner join club_facilities cf on f.id=cf.facilities_id
				inner join clubs c on cf.clubs_id=c.id
				where f.id='".$fid."' and cf.clubs_id='".$club_id."' limit 1");
		if($sql->num_rows()>0){
			$row=$sql->row();
		}else{
			$row=0;
		}
		return $row;
	}	
	function delete_club_facility($fid, $club_id){
		  $this->db->query("delete f,cf from facilities f
				inner join club_facilities cf on f.id=cf.facilities_id
				where f.id='".$fid."' and cf.clubs_id='".$club_id."'");
		
		return true;
	}
function check_club_holiday($holiday_name, $holiday_date, $club_id){
		$sql = "select id from club_holidays where name='".$holiday_name."' and holiday_date='".$holiday_date."' and clubs_id='".$club_id."'";
		$num = $this->db->query($sql)->num_rows();
		return $num;
	}
function club_holiday_details($hid, $club_id){
		$sql =  $this->db->query("select * from club_holidays where id='".$hid."' and clubs_id='".$club_id."' limit 1");
		if($sql->num_rows()>0){
			$row=$sql->row();
		}else{
			$row=0;
		}
		return $row;	
		}	
function delete_club_holiday($hid, $club_id){
		$this->db->query("delete  from club_holidays where id='".$hid."' and clubs_id='".$club_id."'");
		return true;	
		}		
function club_news_details($nid, $club_id){
		$sql =  $this->db->query("select * from club_news where id='".$nid."' and clubs_id='".$club_id."' limit 1");
		if($sql->num_rows()>0){
			$row=$sql->row();
		}else{
			$row=0;
		}
		return $row;	
		}	
	function delete_club_news($nid, $club_id){
		$this->db->query("select * from club_news where id='".$nid."' and clubs_id='".$club_id."'");
		return true;	
		}			
function search_teams($search, $pagenumber, $limit){
		$sql = "select id, name, description, logo
				from teams as t
				where t.name like '%".$search."%'";
		return $this->pageQuery($sql,$pagenumber,$limit);
	}
	
function search_sports($search, $pagenumber, $limit){
		$sql = "select id, name, description, logo
				from sports as t
				where t.name like '%".$search."%'";
		return $this->pageQuery($sql,$pagenumber,$limit);
	}
function list_cb($c_id,$pagenumber=0,$limit,$serch_key,$search=''){
		$sql="SELECT u.*, IFNULL(c.name,'') AS countryname,cl.name AS clname
				FROM players AS u
				INNER JOIN clubs cl ON u.id=cl.club_owner
				LEFT JOIN country c ON u.country_id=c.id
				WHERE c.`status`='1'";
		return $this->pageQuery($sql,$pagenumber,$limit);
    }
	function clublists($uid,$pagenumber=0,$limit,$cname,$zip){
			
				$sql="SELECT cb.id as clbid,cb.name as name,ifnull(cb.city,'') as city,ifnull(cb.state,'') as state,cb.description1,cd.*,c.name AS cname,
				ifnull(pl.image,'') as logo,ifnull(cp.id,0) as cpid,cp.is_approved
				FROM clubs cb
				INNER JOIN players pl ON cb.created_by=pl.id
				INNER JOIN club_dimensions cd ON cb.id=cd.clubs_id
				LEFT JOIN country c ON cb.country_id=c.id
				LEFT JOIN club_players cp ON cb.id=cp.clubs_id and cp.players_id='".$uid."'
				WHERE cb.`status`='1'";
				if($cname!='' && $cname!='Search...'){
					$sql.=" and (cb.name like '%".$cname."%'";
				}
				if($zip!='' && $zip!='Search...'){
					$sql.=" OR cb.zip='".$zip."' OR cb.city like '%".$zip."%' OR cb.state like '%".$zip."%' OR c.name like '%".$zip."%')";
				}
		return $this->pageQuery($sql,$pagenumber,$limit);
    }
		function clubDetails($clb_id,$uid){
			
				$sql=$this->db->query("SELECT cb.id as clbid,cb.name as name,ifnull(cb.city,'') as city,
				ifnull(cb.state,'') as state,cb.description1,cd.*,c.name AS cname,
				ifnull(pl.image,'') as logo,ifnull(cp.id,0) as cpid,pl.id as plid
				FROM clubs cb
				INNER JOIN players pl ON cb.created_by=pl.id
				INNER JOIN club_dimensions cd ON cb.id=cd.clubs_id
				LEFT JOIN country c ON cb.country_id=c.id
				LEFT JOIN club_players cp ON cb.id=cp.clubs_id and cp.players_id='".$uid."'
				WHERE cb.`status`='1' and cb.id='".$clb_id."' limit 1");
				if($sql->num_rows()>0){
					$row=$sql->row();
				}else{
					$row=0;
				}
				return $row;
    }
	function clubsSports($cid,$limit=0){
				$qry="SELECT s.id,s.name,s.logo
						FROM sports AS s
						INNER JOIN club_sports AS cs ON s.id=cs.sports_id
						WHERE cs.clubs_id='".$cid."' order by s.name";
					if($limit){
						$qry.=" LIMIT 0,".$limit;
					}	
				$sql=$this->db->query($qry)->result();	
		return $sql;
    }
	function courts_details($c_id,$cl_id){
		$sql=$this->db->query("SELECT crt.id,  crt.name,  crt.court_no,  crt.start_date,  crt.end_date,  crt.sports_id, 
		 crt.court_types_id,crtd.id as crtd_id,  crtd.courts_id, crtd.width,  crtd.height,  crtd.area, crtd.terms,  crtd.notes
				FROM courts AS crt
				INNER JOIN court_dimensions AS crtd ON crt.id=crtd.courts_id
				INNER JOIN clubs AS clb ON crt.clubs_id=clb.id
				LEFT JOIN sports AS s ON crt.sports_id=s.id
				LEFT JOIN court_types AS ct ON crt.court_types_id=ct.id
				WHERE clb.id='".$c_id."' and crt.clubs_id='".$cl_id."' limit 1");
				
		if($sql->num_rows()>0){
			$row=$sql->row();
		}else{
			$row=0;
		}
		return $row;
    }
	function checkClb($sid,$uid){
        $num=$this->db->query("select id from club_players WHERE players_id='".$uid."' AND clubs_id='".$sid."'")->num_rows();
        //$res = $this->db->query($sql);
        return $num;
    }
	 function removeClb($sp_id,$uid){
   				$this->db->query("delete from club_players WHERE players_id='".$uid."' AND clubs_id='".$sp_id."'");
				return true;
   }
    function courts_list($clb_id,$limit=0){
	$qry="SELECT crt.id,crt.name,crt.court_no,crt.start_date,crt.end_date,s.name as sname,ct.name as ctname
				FROM courts AS crt
				INNER JOIN court_dimensions AS crtd ON crt.id=crtd.courts_id
				INNER JOIN clubs AS clb ON crt.clubs_id=clb.id
				LEFT JOIN sports AS s ON crt.sports_id=s.id
				LEFT JOIN court_types AS ct ON crt.court_types_id=ct.id
				WHERE clb.id='".$clb_id."'";
			if($limit){
				$qry.=" LIMIT 0,".$limit;	
			}	
   			$sql=$this->db->query($qry);
		return $sql->result();		
				
	}
	function clubUsers($clubId,$pagenumber,$limit){
	$sql="SELECT p.id as pid,p.gender,CONCAT(p.first_name,' ',p.last_name) as pname,
				 IFNULL(p.image,'') as image,c.name as cname
							FROM club_players cp
							INNER JOIN players p ON cp.players_id=p.id
							INNER JOIN clubs clb ON cp.clubs_id=clb.id
							INNER JOIN country c ON p.country_id=c.id
							WHERE clb.id='".$clubId."' and cp.is_approved='1'";	
							return $this->pageQuery($sql,$pagenumber,$limit);
	}
	function scheduleClubList($sid){
	/*$sql="SELECT cb.id AS clbid,cb.name AS name
			FROM clubs cb
			INNER JOIN club_sports cs ON cb.id=cs.clubs_id
			WHERE cb.`status`='1' AND cs.sports_id='".$sid."'";	*/
	$sql="SELECT cb.id AS clbid,cb.name AS name
			FROM clubs cb
			WHERE cb.`status`='1'";			
			return $this->db->query($sql)->result();
	
	
	}
	
}

?>
