<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Form token base on Chris Shiflett's implementation
 * @see http://phpsecurity.org
*/

/**
 * Generate Form Token
 * 
 * @access	public
 * @return	string	unique form token
 * 
 */
function selectBox($seloption,$table,$fields,$condition="",$selected_id=0,$order='',$custom=false)
{
	$CI =& get_instance();
	
	$sel_qry="select ".$fields." from ".$table;
	if($condition!=""){
		$sel_qry.=" where ".$condition;
	}
	if($order!=""){
		$sel_qry.=" order by ".$order;
	}
	
	$sel_qry2=$CI->db->query($sel_qry);
	$selFet2=$sel_qry2->result_array();	
	$fields=explode(",",$fields);
	
	$option = "<option value=''>".$seloption."</option>";
	foreach($selFet2 as $selFet){
		$selected="";
		if($selFet[$fields[0]]==$selected_id){
			$selected="selected";
		}
		
		$option .= "<option value='".$selFet[$fields[0]]."' ".$selected.">".$selFet[$fields[1]]."</option>";
	}
	if($custom){
		$option .= "<option value='custom'>Add Custom...</option>";
	}
	
	return $option;
}
  
function selectBox2($seloption,$table,$fields,$condition="",$editCo=0)
{
	$CI =& get_instance();
	
	$sel_qry="select ".$fields." from ".$table;
	if($condition!="")
	$sel_qry.=" where ".$condition;
	echo $sel_qry;
}

function generalId($field,$table,$db_field,$auto_id)
{
	$CI =& get_instance();
	$sel_qry="select ".$field. " from ".$table." where ".$db_field."=".$auto_id;
	$sel_qry2=$CI->db->query($sel_qry);
	$numRows=$sel_qry2->num_rows();
	if($numRows>0)
	{
		$selFet=$sel_qry2->result_array();
		return $selFet[0][$field];
	}
	else
		return "--";
}
function createThumbnail($fileName,$url='./images/') {
$CI =& get_instance();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $url.$fileName;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 150;
		$config['height'] = 150;
		
		$CI->load->library('image_lib');
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
	} 