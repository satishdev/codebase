<?php

function session_check()
{
    $ci =& get_instance();
    if (!checkRemember()) {
        if ($ci->db_session->userdata('user_object') == '') {
            redirect('login');
        }
    }
}

function admin_session_check()
{
    $CI =& get_instance();
    if ($CI->session->userdata('session_admin_id') == '') {
        redirect('admin/user_golf_booking');
    }
}

function checkRemember()
{
    $ci =& get_instance();
    $cookie = $ci->input->cookie('remember_me_token'); //get cookie save from browser

    //create user login
    if ($cookie != '') {
        $sql = "SELECT * FROM players WHERE remember_me_token = '$cookie'";
        $query = $ci->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row();
            $ci->load->model('login_model');

            $LoginSessionObject = $ci->login_model->setLoginSession($result);
            $ci->db_session->unset_userdata('user_object');
            $ci->db_session->set_userdata('user_object', serialize($LoginSessionObject));
        }
    } else {
        //$ci->db_session->unset_userdata('user_object');
        delete_cookie("remember_me_token");
    }
}
