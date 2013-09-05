<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_db_lib {

    private $table_rows=array(
        'players'=>array('id',  'first_name',  'last_name',  'email',  'mobile',  'phone',  'password',  'skype_id',  'facebook_id',  'twitter_id',  'linkedin_id',  'zip',  'city',  'state',  'web_site',  'height',  'weight',  'profile_status',  'address',  'about_me',  'gender',  'dob',  'smoking',  'drinking',  'country_id',  'status',  'image','activation_code', 'player_types_id',  'date_added',  'ip_address'),
        'clubs'=>array('id', 'name', 'club_owner', 'zip', 'phone', 'mobile', 'web_site', 'city', 'state','address', 'privacy', 'terms', 'description1', 'description2','description3', 'country_id', 'establish_date', 'status', 'created_date', 'created_by', 'modified_by', 'modified_date', 'ip_address'),
        'player_alerts'=>array('id', 'players_id', 'keywords', 'sports_id', 'ip_address', 'created_date', 'modified_date'),
        'player_education'=>array('id',  'players_id',  'educations_id',  'course_name',  'degree',  'major', 'month', 'from_date', 'month2', 'to_date', 'notes', 'country_id',  'state',  'zip',  'ip_address',  'created_date',  'modified_date'),
        'player_expierence'=>array('id',  'players_id',  'company',  'designation',  'location',  'additional_notes', 'exp_skill', 'month', 'from_date', 'month2', 'to_date',  'till_now',  'country_id',  'state',  'zip',  'created_date',  'modified_date',  'ip_address'),
        'player_interests'=>array('id', 'players_id', 'intersts_id', 'skills', 'created_date', 'modified_date', 'ip_address'),
        'inbox'=>array('id', 'from', 'to', 'message', 'subject', 'status', 'create_date'),
        'inbox_users'=>array('id','inbox_id', 'user_id', 'status', 'created_date'),
        'player_schedule'=>array( 'id',  'name',  'location',  'players_id', 'description',  'start_date',  'end_date',  'is_approved',  'schedule_type',  'color',  'isalldayevent',  'created_by',  'modified_by',  'created_added',  'modified_date',  'ip_address' ),
		'sports'=>array('id', 'user_id','sports_type_id','name','logo', 'status','recommend','description', 'created_date', 'modified_date', 'ip_address'),
		'sports_dimensions'=>array('id', 'no_of_players', 'sports_id', 'played_players', 'duration', 'width', 'height', 'area','terms', 'notes', 'create_date', 'modified_date', 'created_by', 'modified_by', 'ip_address'),
		'player_sports'=>array('id', 'players_id', 'sports_id', 'expert_id', 'created_date', 'ip_address', 'modified_date'),
		'teams'=>array('id',  'sports_id',  'name',  'city',  'zip',  'state',  'address',  'level_id',  'about_me',  'description',  'logo',  'status',  'ip_address',  'created_date',  'modified_date',  'created_by',  'modified_by'),
		'player_teams'=>array('id', 'teams_id', 'players_id', 'team_player_relations_id', 'is_approved','request_from', 'created_by', 'modified_by', 'created_date', 'modified_date', 'ip_address'),
		'player_friends'=>array('id', 'from', 'to', 'player_relations_id', 'is_approved', 'created_date', 'created_by', 'modified_by', 'modified_date', 'ip_address'),
		'levels'=>array('id',  'name',  'status',  'recommend',  'create_date',  'created_by'),
		'albums'=>array('id',  'name',  'status',  'access',  'gallery_type','related_id', 'description',  'created_date',  'created_by',  'modified_by',  'modified_date',  'ip_address'),
		'gallery_assets'=>array('img_id',  'cat_id',  'order_num',  'filename',  'thumbnail',  'caption'),
		'club_facilities'=>array('id',  'clubs_id',  'facilities_id',  'created_date',  'created_by',  'ip_address'),
		'club_holidays'=>array( 'id',  'clubs_id',  'name', 'description',  'holiday_date',  'ip_address',  'created_by',  'created_date'),
		'club_news'=>array('id',  'clubs_id',  'headline',  'description',  'create_date',  'modified_date',  'created_by',  'modified_by',  'ip_address',  'status'),
		'facilities'=>array('id',  'name',  'description',  'status',  'create_date'),
		'club_dimensions'=>array('id',  'clubs_id',  'no_of_courts',  'width',  'height',  'area', 'terms',  'notes',  'create_date',  'modified_date',  'created_by',  'modified_by',  'ip_address'),
		'courts'=>array('id',  'name',  'court_no',  'start_date',  'end_date',  'sports_id',  'court_types_id',  'clubs_id',  'status',  'created_date',  'modified_date',  'created_by',  'modified_by',  'ip_address'),
		'court_dimensions'=>array( 'id',  'courts_id',  'width',  'height',  'area',  'terms', 'notes',  'create_date'),
		'club_sports'=>array('id',  'clubs_id',  'sports_id',  'created_by',  'created_date',  'ip_address'),
		'club_teams'=>array( 'id',  'clubs_id',  'teams_id',  'club_team_relations_id',  'is_approved',  'created_by',  'created_date',  'ip_address'),
		'club_players'=>array('id',  'clubs_id',  'players_id',  'club_player_relations_id',  'is_approved',  'created_date',  'modified_date',  'created_by',  'modified_by',  'ip_address'),
	'photo_comments'=>array( 'id',  'photo_id',  'user_id',  'comments',  'created_date')	
       
    );
    private $table_comon_rels=array('ip_address');

    function get_table_name($rel){
        $rels_array=$this->table_rels;
        if(isset($rels_array[$rel])){
            return $rels_array[$rel];
        }else{
            return 0;
        }
    }

    function filter_table_rows($post, $table_name) {
        $data = array();
        foreach ($post as $k => $v) {
            if (in_array($k, $this->table_rows[$table_name])) {
                $data[$k] = filterString($v);
            }
        }
        return $data;
    }
 function filter_table_rows_comonfields($post, $table_name) {
        $data = array();
        foreach ($this->table_comon_rels as $v) {
            if (in_array($v, $this->table_rows[$table_name])) {
			if($v=='ip_address'){
                $post[$v] = $_SERVER['REMOTE_ADDR'];
				}
            }
        }
        return $post;
    }
    function filter_post($post_data, $table_name) {
        if(is_object($post_data)){
            $post=(array) $post_data;
        }else{
            $post=(array) $post_data;
        }
        if (isset($this->table_rows[$table_name])) {
            $data = $this->filter_table_rows($post, $table_name);
            return $data;
        }else{
            return 0;
        }
    }

    function save_record($post_data, $table_name) {
        if(is_object($post_data)){
            $post=(array) $post_data;
        }else{
            $post=(array) $post_data;
        }
        if (isset($this->table_rows[$table_name])) {
            $data = $this->filter_table_rows($post, $table_name);
			$data =$this->filter_table_rows_comonfields($data, $table_name);
            if (isset($data['id']) && !empty($data['id'])) {
                $id=$data['id'];
                unset ($data['id']);
                return $this->db_update($data, $id, $table_name);
            } else {
                return $this->db_insert($data,$table_name);
            }
        }else{
            return 0;
        }
    }

    function db_insert($inserts, $table) {
        $CI =& get_instance();
        $CI->db->insert($table, $inserts);
        return $CI->db->insert_id();
        // $values = array_map('mysql_real_escape_string', array_values($inserts));
        // $keys = array_keys($inserts);
        // mysql_query('INSERT INTO '' . $table . '' ('' . implode('','', $keys) . '') VALUES (\'' . implode('\',\'', $values) . '\')') or die("Unable to Connect to Databse" . mysql_error());
        // return mysql_insert_id();
    }

    function db_update($updates,$id,$table) {
        $CI =& get_instance();
        $CI->db->where('id', $id);
        return $CI->db->update($table, $updates);
        //$str = '';
        //foreach ($updates as $k => $v) {
        //    $str.=" " . $k . "='" . $v . "', ";
        //}
        //$str = substr($str, 0, -2);
        //$qry = "UPDATE $table SET $str ";
        //if (trim($condition) != '') {
        //    $qry .= $condition;
        //}
        //return mysql_query($qry);
    }

    function get_jqgrid_data($post,$query){
        $CI =& get_instance();
	$page = $post['page']; // get the requested page
	$limit = $post['rows']; // get how many rows we want to have into the grid
	$sidx = $post['sidx']; // get index row - i.e. user click to sort
	$sord = $post['sord']; // get the direction
	if(!$sidx) $sidx =1;

	// mysql_select_db($database) or die("Error conecting to db.");
	// $result = mysql_query("SELECT COUNT(*) AS count FROM jobs");

        $res=$CI->db->query($query);
        // $result=$res->result_array();

	// $row = mysql_fetch_array($result,MYSQL_ASSOC);
	$count = $res->num_rows();

	if( $count >0 ) {
		$total_pages = ceil($count/$limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit; // do not put $limit*($page - 1)
        if($start<1){ $start=0; }

        // $SQL = "SELECT * FROM jobs ORDER BY $sidx $sord LIMIT $start , $limit";
	// $result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
        $sql2=$query." ORDER BY $sidx $sord LIMIT $start , $limit";
        $res2=$CI->db->query($sql2);
        $result=$res2->result_array();

	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
        $responce->db_data=$result;

        // print_r($responce); die;
        return $responce;
    }

    
}

?>
