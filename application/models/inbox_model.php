<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

 function add_inbox_users($inbox_id,$user_id){
      $sql='';
	 foreach($user_id as $uid){
	 	$sql.="('".$inbox_id."','".$uid."'),";
	 }
	 if($sql!=''){
	 	$this->db->query('insert into inbox_users (inbox_id,user_id) values '.trim($sql,','));
	 }
 }
 function view_message($inbox_id,$user_id){
     $sql="select i.*,u.first_name,u.email from inbox i
			inner join players u on i.`from`=u.id
			inner join inbox_users iu on i.id=iu.inbox_id
                    where iu.user_id='".$user_id."' and i.id='".$inbox_id."' limit 1 ";
        $res = $this->db->query($sql);
        return $res->row();
 }
 function sent_view_message($inbox_id,$user_id){
     $sql="select i.*,group_concat(concat(u.first_name,'(',u.email,')')) as reciep from inbox i
			inner join inbox_users iu on i.id=iu.inbox_id
						inner join players u on iu.`user_id`=u.id
                    where i.`from`='".$user_id."' and i.id='".$inbox_id."' group by iu.inbox_id  ";
        $res = $this->db->query($sql);
        return $res->row();
 }
 function notifications($user_id){
     $sql="SELECT *
FROM (SELECT ps.id as sch_id,su.id,ps.start_date,ps.end_date, CONCAT(p.first_name,' ',p.last_name) AS pname,
				c.name AS cname,crts.name AS crtsname, ps.schedule_type,0 as team_cpt,IFNULL(p.image,'') as image,p.gender,'' as score
				FROM player_schedule ps
				INNER JOIN players p ON ps.created_by=p.id
				INNER JOIN schedule_users su ON ps.id=su.schedule_id
				INNER JOIN schedule_details sd ON ps.id=sd.schedule_id
				LEFT JOIN clubs c ON sd.club_id=c.id
				LEFT JOIN courts crts ON c.id=crts.clubs_id AND sd.court_id=crts.id
				WHERE su.user_id='".$user_id."' AND su.is_approve='0' AND su.user_type='1' AND ps.schedule_type='2'
				 UNION
				SELECT ps.id as sch_id,su.id,ps.start_date,ps.end_date, CONCAT(p.first_name,' ',p.last_name) AS pname,
								c.name AS cname,crts.name AS crtsname
								, ps.schedule_type, t.created_by as team_cpt,IFNULL(p.image,'') as image,p.gender,'' as score
				FROM player_schedule ps
				INNER JOIN players p ON ps.created_by=p.id
				INNER JOIN schedule_users su ON ps.id=su.schedule_id
				INNER JOIN teams t ON ps.players_id=t.id
				INNER JOIN player_teams pt ON t.id=pt.teams_id
				INNER JOIN schedule_details sd ON ps.id=sd.schedule_id
				LEFT JOIN clubs c ON sd.club_id=c.id
				LEFT JOIN courts crts ON c.id=crts.clubs_id AND sd.court_id=crts.id
				WHERE pt.players_id='".$user_id."' AND su.is_approve='0' AND su.user_type='2' AND ps.schedule_type='3'
				UNION
				SELECT pt.id AS sch_id,
				p.id AS id,
				p.gender AS start_date,
				pt.teams_id AS end_date, CONCAT(p.first_name,' ',p.last_name) AS pname,
				t.name AS cname, IFNULL(pt.is_approved,'') AS crtsname,
				5 AS schedule_type,
				pt.players_id AS team_cpt, IFNULL(p.image,'') AS image,p.gender,'' as score
			FROM player_teams pt
			INNER JOIN teams t ON pt.teams_id =t.id
			INNER JOIN sports s ON t.sports_id=s.id
			INNER JOIN players p ON pt.players_id=p.id
			WHERE t.status='1' AND pt.request_from='1' AND pt.is_approved='0' AND t.created_by='".$user_id."'
			UNION
			SELECT ps.id AS sch_id,su.id,ps.start_date,ps.end_date,
'' AS pname,
'' AS cname,'' AS crtsname, 
6 AS schedule_type,
0 AS team_cpt,
'' AS image,'' AS gender
,ifnull(ps.score,'cplt') as score
FROM player_schedule ps
INNER JOIN schedule_users su ON ps.id=su.schedule_id
WHERE su.user_id='".$user_id."' AND ps.schedule_type='2' AND ps.is_over='0' AND su.is_approve='1' AND su.match_result='0' AND ps.end_date < NOW()
UNION
SELECT ps.id AS sch_id,su.id,ps.start_date,ps.end_date, 
'' AS pname,
'' AS cname,'' AS crtsname
,7 AS schedule_type,
 t.created_by AS team_cpt, 
'' AS image,'' AS gender
,ifnull(ps.score,'cplt') as score
FROM player_schedule ps
INNER JOIN schedule_users su ON ps.id=su.schedule_id
INNER JOIN teams t ON t.id=su.user_id
INNER JOIN player_teams pt ON t.id=pt.teams_id
WHERE pt.players_id='".$user_id."' AND pt.team_player_relations_id='1' AND su.is_approve='1' AND ps.schedule_type=3 AND ps.is_over='0' AND su.match_result='0' AND ps.end_date < NOW()
GROUP BY pt.players_id
			) as t";
        $res = $this->db->query($sql);
		$data['records']=$res->result();
		$data['total']=$res->num_rows();
        return $data;
 }
  function schedulematch_teams($sch_id){
     $sql="select t.name as tname from teams t 
			inner join schedule_users su on t.id=su.user_id
			where su.schedule_id='".$sch_id."' ";
        $res = $this->db->query($sql);
        return $res->result();
 }
}

?>
