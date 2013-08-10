<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comments_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

  function listofcomments($pid){
		 
		$qry=$this->db->query("SELECT pc.comments as comment,p.id as pid,CONCAT(p.first_name,' ',p.last_name) as pname,
				pc.created_date as p_time,p.image as img,p.gender FROM photo_comments pc
				INNER JOIN players p on pc.user_id=p.id
				WHERE pc.photo_id='".$pid."'");
		$comments_data=array();
		foreach($qry->result() as $row){
			$c_data=array();
			$c_data['id']=$row->pid;
			$c_data['name']=$row->pname;
			if($row->img==''){
				$image=($row->gender=='m'?'css/images/empty_image.png':'css/images/female_image.png');
			}else{
				$image='images/th_'.$row->img;
			}
			$c_data['img']=base_url().$image;
			$c_data['comment']=$row->comment;
			$c_data['time']=$row->p_time;
			array_push($comments_data,$c_data);
		}	
        return $comments_data;
    }
	
   function imgInfo($pid){
   	$qry=$this->db->query("SELECT ga.img_id,ga.caption,ga.created_date, p.id as pid,CONCAT(p.first_name,' ',p.last_name) as pname,p.image as img,p.gender FROM gallery_assets ga
				INNER JOIN players p on ga.user_id=p.id
				WHERE ga.img_id='".$pid."'");
			$u_data=array();
			foreach($qry->result() as $row){
				$u_data['img_id']=$row->img_id;
				$u_data['desc']=$row->caption;
				$u_data['time']=$row->created_date;	
				$u_data['id']=$row->pid;
				$u_data['name']=$row->pname;
				if($row->img==''){
					$image=($row->gender=='m'?'css/images/empty_image.png':'css/images/female_image.png');
				}else{
					$image='images/th_'.$row->img;
				}
				$u_data['img']=base_url().$image;
		}	
			
        return $u_data;
    }
  
}

?>
