<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function load_select($table,$selected_val=0){
    $CI =& get_instance();
    $CI->db->where('status','1');
    $res=$CI->db->get($table);
    $data=$res->result();
    $html='';
    //print_r($data); return true;
    foreach($data as $k=>$v){
        $html.="<option value='$v->id'";
        if($selected_val==$v->id){ $html.=" selected='selected' "; }
        $html.=">$v->name</option>";
    }
    return $html;
}

function get_select_name($id,$table){
    $CI=& get_instance();
    $CI->db->where('id',$id);
    $res=$CI->db->get($table);
    $data=$res->result();
    return $data[0]->name;
}

function month_select($selected_month=0,$no_future=false){
    $html='';

    for($i=1;$i<=12;$i++){
        $html.="<option value='$i'";
        if($selected_year==$i){ $html.=" selected='selected' "; }
        $html.=">$i</option>";
    }
    return $html;
}
function year_select($selected_year=0,$no_future=false){
    $html='';
    $limit=($no_future)?date('Y'):date('Y')+5;

    for($i=date('Y')-20;$i<=$limit;$i++){
        $html.="<option value='$i'";
        if($selected_year==$i){ $html.=" selected='selected' "; }
        $html.=">$i</option>";
    }
    return $html;
}

function dateFormat($db_date_time,$format='Y-m-d'){
    $str_time=strtotime($db_date_time);
    return date($format,$str_time);
}

function get_graduation_json($ids){
    $CI=& get_instance();
    $sql="select * from branches where id not in($ids)";
    $res=$CI->db->query($sql);
    $data=$res->result();
    return json_encode($data); //$data[0]->name;
}


function get_post_graduation_json($ids){
    $CI=& get_instance();
    $sql="select * from branches where id in($ids)";
    $res=$CI->db->query($sql);
    $data=$res->result();
    return json_encode($data); //$data[0]->name;
}


?>
