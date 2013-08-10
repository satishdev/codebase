<?php if ( ! defined('BASEPATH')) exit ('No direct script  allow'); 

class Common_model extends  CI_Model
{
	
	
	function pagination()
	{
		$this->db->select( 'pagination' );
		$this->db->from( 'setting' );
		$this->db->where('setting_id',1 );
		$sql=$this->db->get();
		$sql=$sql->row();
		$res=$sql->pagination;
		return $res;
	} 
	
	
	
	
	
	/////////////////////////////////
	///////simple querys////////////
	///////////////////////////////
	function select_all($select,$table)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		return $this->db->get();
	}
	
	
	function select_where($select,$table,$where)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		return $this->db->get();
	}
		function join_two_tab_order_where( $select,$from,$jointab,$condition,$where,$orderBy_columName, $ASC_DESC )
	{
		$this->db->select( $select );
		$this->db->from( $from );
		$this->db->join( $jointab, $condition );
		$this->db->where( $where );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );			
		return $this->db->get();
	}

	
	
	function select_all_num($select,$table)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	
	function select_where_num($select,$table,$where)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$query=$this->db->get();
		return $query->num_rows();
	}

	
	function select_all_limit($select,$table,$page_start_from,$record_per_page)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->limit( $record_per_page , $page_start_from );
		$result=$this->db->get();
		return $result;	
	}
	
	
	function select_all_order($select,$table,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
	}
	
	
	function select_where_order( $select,$table,$where,$orderBy_columName,$ASC_DESC )
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
	}
	
	
	function select_all_limit_order($select,$table,$page_start_from,$record_per_page,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->limit( $record_per_page , $page_start_from );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
	}
	
	
	function select_where_limit_order($select,$table,$where,$page_start_from,$record_per_page,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->limit( $record_per_page , $page_start_from );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
	}
	
	
	function select_where_or($select,$table,$where,$or_where)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->or_where($or_where); 
		return $this->db->get();
	}
	
	
	/////////////////////////////
	////////operation perform////
	/////////////////////////////
	function insert_array($table,$data)
	{
		$this->db->insert( $table , $data );
		return $this->db->insert_id();	
	}
	
	/*function update_array($where,$table,$data)
	{
		$this->db->where( $where );
		$this->db->update( $table , $data);	
	}
	
	
	function delete_where($where,$tbl_name)
	{
		$this->db->where($where);
		$this->db->delete($tbl_name);
	}*/
	function update_array($where,$table,$data)
	{
		$this->db->where( $where );
		return $this->db->update( $table , $data);	
	}
	
	
	function delete_where($where,$tbl_name)
	{
		$this->db->where($where);
		return $this->db->delete($tbl_name);
	}
	
	
	function delete_all($tbl_name)
	{
		$this->db->empty_table($tbl_name);
	}
	
	
	////////////////////////////
	///////sum querys////////////
	////////////////////////////
	function sum_all($select_sum,$table)
	{
		$this->db->select_sum($select_sum);
		$this->db->from( $table );
		$result=$this->db->get();
		return $result;	
	}
	
	
	function select_sum_where($select,$table,$where)
	{
		$this->db->select_sum($select);
		$this->db->from( $table );
		$this->db->where( $where );
		return $this->db->get();
	}
	
	
	///////////////////////////////
	///////join two tables/////////
	//////////////////////////////
	function join_two_tab_order( $select,$from,$jointab,$condition,$orderBy_columName, $ASC_DESC )
	{
		$this->db->select( $select );
		$this->db->from( $from );
		$this->db->join( $jointab, $condition );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );			
		return $this->db->get();
	}
	
	
	
	
	
	
	function join_two_tab_where_num( $select, $from, $jointable, $condition, $where )
	{
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable , $condition );
		$this->db->where( $where );
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	
	function join_two_tab_where_limit_order( $select, $from, $jointable, $condition, $where, $record_per_page, $page_start_from, $orderBy_columName, $ASC_DESC )
	{
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable , $condition );
		$this->db->where( $where );
		$this->db->limit( $record_per_page , $page_start_from );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );	
		return $this->db->get();
	}
	
	

	
	
	
	function join_two_tab_count_group_where_num( $select, $from, $jointable, $condition,$group_by, $where )
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->join($jointable,$condition);
		$this->db->group_by($group_by);
		$this->db->where( $where );
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	
	
	
	
	function join_two_tab_count_group_order_where( $select, $from, $jointable, $condition, $where,$group_by, $record_per_page, $page_start_from, $orderBy_columName, $ASC_DESC )
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->join($jointable, $condition);
		$this->db->group_by($group_by);
		$this->db->where( $where );
		$this->db->order_by($orderBy_columName, $ASC_DESC);
		$this->db->limit( $record_per_page , $page_start_from );
		return $this->db->get();
	}
	
	
	/////////////////////////////
	////////like querys///////////
	//////////////////////////////
	function select_where_or_like_num( $select,$table,$where,$orcondition )
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->or_like($orcondition); 		
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	
	function select_where_or_like_order( $select,$table,$where,$like,$orderBy_columName,$ASC_DESC )
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->or_like($like); 
		$this->db->order_by( $orderBy_columName , $ASC_DESC );			
		return $this->db->get();
	}
	
	
	function select_where_or_like_limit_order( $select,$table,$where,$orcondition,$record_per_page,$page_start_from,$orderBy_columName,$ASC_DESC )
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->or_like($orcondition);
		$this->db->limit( $record_per_page , $page_start_from );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );			
		return $this->db->get();
	}
	
	
	function select_where_like_limit($select,$table,$where_con,$where,$limit)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where_con );
		$this->db->like($where); 
		$this->db->limit($limit);
		return $this->db->get();
	}
	
	
	////////////////////////////////
	///////join three tables////////
	//////////////////////////////
	function join_three_tab_where_num( $select, $from, $jointable1, $condition1, $jointable2, $condition2,  $where )
	{
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable1 , $condition1 );
		$this->db->join( $jointable2 , $condition2 );
		$this->db->where( $where );
		$query=$this->db->get();
		return 	$query->num_rows();
	}
	
	
	function join_three_tab_where_limit_order( $select, $from, $jointable1, $condition1, $jointable2, $condition2,  $where, $record_per_page, $page_start_from, $orderBy_columName, $ASC_DESC )
	{
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable1 , $condition1 );
		$this->db->join( $jointable2 , $condition2 );
		$this->db->where( $where );
		$this->db->limit( $record_per_page , $page_start_from );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );	
		return $this->db->get();
	}
	
	
	///////////////////////////////////
	////////sum group by///////////////
	//////////////////////////////////
	function sum_group_order($select,$select_sum,$table,$group_by,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select($select);
		$this->db->select_sum($select_sum);
		$this->db->from( $table );
		$this->db->group_by($group_by);
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
	}
	
	
	function sum_group_order_limit($select,$select_sum,$table,$group_by,$orderBy_columName,$ASC_DESC,$limit)
	{
		$this->db->select($select);
		$this->db->select_sum($select_sum);
		$this->db->from( $table );
		$this->db->group_by($group_by);
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$this->db->limit($limit); 
		$result=$this->db->get();
		return $result;	
	}
	
	
	function sum_where_group($select,$select_sum,$table,$where,$group_by)
	{
		$this->db->select($select);
		$this->db->select_sum($select_sum);
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->group_by($group_by);
		$result=$this->db->get();
		return $result;	
	}

	
	////////////////////////////////////
	//////max and min values////////////
	//////////////////////////////////
	function max_val_return($field,$table)
	{
		$this->db->select_max($field);
		$this->db->from($table);
		$val=$this->db->get();
		$val=$val->row_array();
		return $val['order_no'];	
	}
	
	
	
	function select_where_limit($select,$table,$where,$page_start_from,$record_per_page)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->limit( $record_per_page , $page_start_from );
		$result=$this->db->get();
		return $result;	
	}
	
	
	
	
	
	//////////////////////
	/////////////////////
	////////////////////
	
	
	
	function subquery_where($idea_cat_id,$page_start_from,$record_per_page)
	{
	$CI = &get_instance();
	$sql = 'select * FROM idea WHERE 
	idea_cat_id IN ( SELECT idea_cat_id FROM idea_cat WHERE parent_id="'.$idea_cat_id.'") ORDER BY date_added DESC LIMIT '.$page_start_from.','.$record_per_page.'';
$result_query = $CI->db->query($sql); 
	return $result_query;
	}
	
	
	function subquery_where_num_val2($idea_cat_id)
	{
	$CI = &get_instance(); 
	$sql = 'select idea.*, COUNT(idea.idea_id) as num FROM idea,idea_voting WHERE 
	idea_cat_id IN ( SELECT idea_cat_id FROM idea_cat WHERE parent_id="'.$idea_cat_id.'") GROUP BY idea.idea_id';
$result_query = $CI->db->query($sql);
$result_query=$result_query->num_rows(); 
	return $result_query;
	}
	function subquery_where_val2($idea_cat_id,$page_start_from,$record_per_page)
	{
		$CI = &get_instance();
		$sql = 'select idea.*, COUNT(idea.idea_id) as num FROM idea,idea_voting WHERE 
		idea_cat_id IN ( SELECT idea_cat_id FROM idea_cat WHERE parent_id="'.$idea_cat_id.'") GROUP BY idea.idea_id ORDER BY idea.num_votes DESC  LIMIT '.$page_start_from.','.$record_per_page.'';
		$result_query = $CI->db->query($sql); 
		return $result_query;
	}
	function subquery_where_val4($idea_cat_id,$page_start_from,$record_per_page)
	{
		$CI = &get_instance();
		$sql = 'select idea.*,coment.*, COUNT(idea.idea_id) as num FROM idea,coment WHERE 
		idea_cat_id IN ( SELECT idea_cat_id FROM idea_cat WHERE parent_id="'.$idea_cat_id.'") and idea.idea_id=coment.id GROUP BY idea.idea_id ORDER BY idea.num_votes DESC  LIMIT '.$page_start_from.','.$record_per_page.'';
		$result_query = $CI->db->query($sql); 
		return $result_query;
	}
	function subquery_where_num_val4($idea_cat_id)
	{
	$CI = &get_instance(); 
	$sql = 'select idea.*,coment.*, COUNT(idea.idea_id) as num FROM idea,coment WHERE 
	idea_cat_id IN ( SELECT idea_cat_id FROM idea_cat WHERE parent_id="'.$idea_cat_id.'")   and idea.idea_id=coment.id GROUP BY idea.idea_id';
$result_query = $CI->db->query($sql);
$result_query=$result_query->num_rows(); 
	return $result_query;
	}
	
	
	function subquery_where1($idea_cat_id)
	{
	$CI = &get_instance(); 
	$sql = 'select * FROM idea WHERE 
	idea_cat_id IN ( SELECT idea_cat_id FROM idea_cat WHERE parent_id="'.$idea_cat_id.'")';
$result_query = $CI->db->query($sql);
$result_query=$result_query->num_rows(); 
	return $result_query;
	}
	
		function subquery_where_val3($idea_cat_id,$page_start_from,$record_per_page)
	{
		$CI = &get_instance();
		$sql = 'select * FROM idea WHERE 
		idea_cat_id IN ( SELECT idea_cat_id FROM idea_cat WHERE parent_id="'.$idea_cat_id.'")  ORDER BY num_see_detail DESC  LIMIT '.$page_start_from.','.$record_per_page.'';
		$result_query = $CI->db->query($sql); 
		return $result_query;
	}
function subquery_where_num_val3($idea_cat_id)
	{
	$CI = &get_instance(); 
	$sql = 'select * FROM idea WHERE 
	idea_cat_id IN ( SELECT idea_cat_id FROM idea_cat WHERE parent_id="'.$idea_cat_id.'")';
$result_query = $CI->db->query($sql);
$result_query=$result_query->num_rows(); 
	return $result_query;
	}
	
	
	
	
	function select_where_like_limit_order($select,$table,$where,$like,$page_start_from,$record_per_page,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->like( $like );
		$this->db->limit( $record_per_page , $page_start_from );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
	}
	function select_where_like_num($select,$table,$where,$like)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->like( $like );
		$result=$this->db->get();
		return $result->num_rows();	
	}
	function join_two_tab_count_group_where_like_num( $select, $from, $jointable, $condition,$group_by, $where,$like )
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->join($jointable,$condition);
		$this->db->group_by($group_by);
		$this->db->where( $where );
		$this->db->like( $like );
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	
	
	
	
	function join_two_tab_count_group_order_where_like( $select, $from, $jointable, $condition, $where,$group_by, $record_per_page, $page_start_from, $orderBy_columName, $ASC_DESC,$like )
	{
		$this->db->select($select);
		$this->db->from($from);
		$this->db->join($jointable, $condition);
		$this->db->group_by($group_by);
		$this->db->where( $where );
		$this->db->like( $like );
		$this->db->order_by($orderBy_columName, $ASC_DESC);
		$this->db->limit( $record_per_page , $page_start_from );
		return $this->db->get();
	}
	
	function select_where_limit_order_like($select,$table,$where,$page_start_from,$record_per_page,$orderBy_columName,$ASC_DESC,$like)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->like( $like );
		$this->db->limit( $record_per_page , $page_start_from );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
	}
	function select_where_limit_order_like_num($select,$table,$where,$orderBy_columName,$ASC_DESC,$like)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->like( $like );
		 
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result->num_rows();	
	}
	
	
	function num_users()
	{
	  
	      $query='SELECT count(user_id) as num_user FROM user';
	       return $this->db->query($query);
	}
	
	
	
	/// methods for basta database...
	function add_record_basta($table,$data)
	{
		$basta	=	$this->load->database('basta', TRUE); 
		$basta->insert( $table , $data );	
		$this->db->close();
	}
	function update_array_basta($where,$table,$data)	{
		$basta	=	$this->load->database('basta', TRUE); 
		$basta->where( $where );
		$basta->update( $table , $data);	
		$this->db->close();
	}
	
	function delete_where_basta($where,$tbl_name)
	{
	    $basta	=	$this->load->database('basta', TRUE); 
		$basta->where($where);
		$basta->delete($tbl_name);
		$this->db->close();
	}
	
	
	function select_where_basta($select,$table,$where)
	{
	 	$basta	=	$this->load->database('basta', TRUE); 
		$basta->select( $select );
		$basta->from( $table );
		$basta->where( $where );
		return $basta->get();
		
	}
	
	
	
	
	function count_rating($course_id,$page_start_from,$record_per_page)
	{
	$query='SELECT *,review_rating_condition+review_rating_facilities+review_rating_all as total FROM gama_golf_review where status=1 and course_id='.$course_id.' ORDER BY total DESC LIMIT '.$page_start_from.','.$record_per_page;
	       return $this->db->query($query);
	}
	
	
	
	
	
}?>