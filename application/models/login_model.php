<?php
class Login_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function login_auth($login)
    {
        $username = $login->getUsername();
        $password = $login->getPassword();
        $remember_me = $login->getRemember_me();

        $VQry = $this->db->query("select * from players where email='" . $username . "' and status='1'");
        if ($VQry->num_rows() > 0) {
            $row = $VQry->row();
            if ($this->encrypt->decode($row->password) == $password){
                if($remember_me == 'on'){
                    $this->setRemember($username, $password);
                }
                return $row;
            } else {
                return 0;
            }
        } else
            return 0;
    }

    function forgot_password($login)
    {
        $username = $login->username;
        $VQry = $this->db->query("select * from players where email='" . $username . "' limit 1");

        if ($VQry->num_rows() > 0) {
            $data = $VQry->row();
            return $data;
        } else {
            return 0;
        }


    }

    function change_password($login)
    {
        $password = $login->old_password;
        $newpassword = $login->new_password;
        $userid = $login->userid;

        $VQry = $this->db->query("select * from players where password='" . $password . "' and id='" . $userid . "' limit 1");


        if ($VQry->num_rows() > 0) {
            $data = $VQry->row();
            $sql = $this->db->query("updateplayers  set password='" . $newpassword . "' where id=" . $userid);
            return 1;
        } else {
            return 0;
        }


    }

    function setLoginSession($userObj)
    {

        $CI =& get_instance();
        $CI->load->library('user_library');
        $user_obj = new $CI->user_library;

        $user_obj->setUserid($userObj->id);
        $user_obj->setEmail($userObj->email);
        $user_obj->setUsername(stripslashes($userObj->first_name));
        $user_obj->setFirstname(stripslashes($userObj->first_name));
        $user_obj->setLastname(stripslashes($userObj->last_name));
        $user_obj->setusertype($userObj->player_types_id);
        $user_obj->setUsergender($userObj->gender);
        if ($userObj->player_types_id == '3') {
            $club_id = $this->db->query("select id from clubs where club_owner='" . $userObj->id . "' LIMIT 1")->row()->id;
            $user_obj->setClubid($club_id);
        }
        return $user_obj;
    }

    function SetIvieLoginParameters($post_obj)
    {
        $CI =& get_instance();
        $CI->load->library('login_library');
        $login_obj = new $CI->login_library;

        $login_obj->setUsername($post_obj->username);
        $login_obj->setPassword($post_obj->password);
        $login_obj->setRemember_me($post_obj->remember_me);

        return $login_obj;
    }

    function setRemember($email, $password){
        $msg = $password. '_' . $email . '_'. date("Ymd");
        $encrypted_string = $this->encrypt->encode($msg);
        $cookie = array(
            'name'   => 'remember_me_token',
            'value'  => $encrypted_string,
            'expire' => '1209600',  // Two weeks
        );

        $update_sql = "UPDATE players SET remember_me_token = '".$encrypted_string."' WHERE email = ".$this->db->escape($email);
        $this->db->query($update_sql);
        $this->input->set_cookie($cookie);
    }
}
