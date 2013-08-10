<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function sample(){
        $sql="";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_players_types(){
        $sql="select * from player_types where status='1'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_user_types_users($user_type_id){
        $sql="select * from users where users_type_id='$user_type_id'";
        $res = $this->db->query($sql);
        return $res->result_array();
    }

    function get_user_details($id){
        $sql="select * from users where id='$id'";
        $res = $this->db->query($sql);
        $user_info=$res->result_array();
        if($user_info[0]['users_type_id']==1){
            // Get & append Srudent Details
            $sql="select sr.*,ifnull(sf.fee1,'-') as fee1,ifnull(sf.fee2,'-') as fee2,ifnull(sf.fee3,'-') as fee3,ifnull(sf.fee4,'-') as fee4
                    from student_records as sr
                    left join student_fees as sf on sf.user_id=sr.user_id
                    where sr.user_id='".$id."' and status='1'";
            $res = $this->db->query($sql);
            $user_info['student_details']=$res->result();
        }
        if($user_info[0]['users_type_id']==2 || $user_info[0]['users_type_id']==3){
            // Get & Staff/Hod Details
            $sql="select * from staff_records where user_id='$id'";
            $res = $this->db->query($sql);
            $user_info['staff_details']=$res->result();
        }
        return $user_info;
    }


    function deactive_notice($id){
        $sql="update students_notice_board set status='0' where id=$id";
        $this->db->query($sql);
    }

    function get_notice_details($id){
        $sql="select * from students_notice_board where id=$id";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    
}

?>
