<?php
 
if ( ! function_exists('createdynamicobject'))
{
	function createdynamicobject($postarray)
	{
		 
		if (isset($postarray) && count($postarray) > 0)
		{
			 
			
			$rfqInstance ;
			
			foreach($postarray as $key => $value)
			{
				$obj_neme_array = explode("_",$key);			 
				$rfqInstance->$obj_neme_array[0]->{$obj_neme_array[1]} = $value;
			}	
			 
			return $rfqInstance;
		}

		return null;
	}	
}

if ( ! function_exists('filterString'))
{
	function filterString($str)
	{
           // $str=mb_ucwords($str);
		if (isset($str) && $str!='' )
		{
				$str=addslashes(trim(htmlspecialchars($str,ENT_QUOTES, "UTF-8"))); 
				//$str=mysql_real_escape_string(trim(htmlspecialchars($str,ENT_QUOTES, "UTF-8")));
				return $str; 
		
			
        }
	}	
}
if ( ! function_exists('mb_ucwords'))
{
function mb_ucwords($str) {
        $str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
        return ($str);
    }

}
if (!function_exists('dateFormat')){
	function dateFormat(){
		return "m-d-Y h:i A";
	}
}

if ( ! function_exists('randompassword'))
{
	function randompassword()
	 {
	 $r_pass='';
	 for ($i=0; $i<6; $i++) {
	    $d=rand(1,30)%2;
	    $r_pass.= $d ? chr(rand(65,90)) : chr(rand(48,57));
	   // $c.= chr(rand(65,90));
	}

		return $r_pass;

	 }
}
if ( ! function_exists('createjobnumber'))
{
	function createjobnumber($job_id)
	 {
		$zero_com="";
		for($i=strlen($job_id);$i<7;$i++)
		{
			$zero_com.="0";
		}
		$Maskjob_id=$zero_com.$job_id;
		return $Maskjob_id;
	 }
}
if ( ! function_exists('filterStringDecode'))
{

	function filterStringDecode($str)//used varable $useUtf in message_model a href

	{       
           
		if (isset($str) && $str!='' )
		{
			$str=trim(stripslashes($str)); 
			//$str=trim($str);
			return $str; 
		
        }
		else if (isset($str)){
			return trim($str); 
		}
	}	
}

if ( ! function_exists('sortTwoDimenArray'))
{
function sortTwoDimenArray ($array, $index, $order='asc', $natsort=FALSE, $case_sensitive=FALSE)
    {
        if(is_array($array) && count($array)>0)
        {
           foreach(array_keys($array) as $key)
               $temp[$key]=$array[$key][$index];
               if(!$natsort)
                   ($order=='asc')? asort($temp) : arsort($temp);
              else
              {
                 ($case_sensitive)? natsort($temp) : natcasesort($temp);
                 if($order!='asc')
                     $temp=array_reverse($temp,TRUE);
           }
           foreach(array_keys($temp) as $key)
               (is_numeric($key))? $sorted[]=$array[$key] : $sorted[$key]=$array[$key];
           return $sorted;
      }
      return $array;
    }
}

if ( ! function_exists('sortTwoDimenArrayChild'))
{
function sortTwoDimenArrayChild ($array, $index, $order='asc', $natsort=FALSE, $case_sensitive=FALSE,$childrenSort)
    {
         $childSort = array();
           foreach($array as $key => $value)
           {
               if(isset($value[$childrenSort])){
                    $t = sortTwoDimenArray($value[$childrenSort], $index, $order='asc', $natsort=FALSE, $case_sensitive=FALSE);
                    $childSort[$key] = $value;
                    $childSort[$key][$childrenSort] = $t;
               }else
                   $childSort[$key] = $value;
           }
      return sortTwoDimenArray($childSort, $index, $order='asc', $natsort=FALSE, $case_sensitive=FALSE) ;;
    }
}

if ( ! function_exists('inboxMsgDate'))
{
	function inboxMsgDate($seconds = 1, $time = '')
	{

		if ( ! is_numeric($seconds))
		{
			$seconds = 1;
		}
	
		if ( ! is_numeric($time))
		{
			$time = time();
		}
	  
		if (date('Y-m-d',$time)==date('Y-m-d',$seconds))
		{
			$out =date('h:i A',$seconds);
		}
		else if (date('Y-m-d',$seconds)==date('Y-m-d', gmmktime(0, 0, 0, date("m") , date("d") - 1, date("Y"))))
		{
			$out ='Yesterday';
		}
		else if (date('Y',$seconds)!=date('Y'))
		{
			$out =date('M d, Y',$seconds);
		}
		else 
		{
			$out =date('M d',$seconds);
		}
		 return $out;
		
	}
}
	if ( ! function_exists('inboxInnerMsgDate'))
{
	function inboxInnerMsgDate($seconds = 1, $time = '')
	{

		if ( ! is_numeric($seconds))
		{
			$seconds = 1;
		}
	
		if ( ! is_numeric($time))
		{
			$time = time();
		}
		$d_seconds=$time-$seconds;
	  $days = floor($d_seconds / 86400);
		if ($days<=0)
		{
			//$out =date('h:i A',$seconds);
			$h_seconds=$time-$seconds;
			 $hours = floor($h_seconds / 3600);
			 if($hours<=0)
			 {
				 $minutes = floor($h_seconds / 60);
				 if($minutes<=0)
				 {
					 $seconds = $h_seconds;
					 if($seconds==1)
						 $out =$seconds." second ago"; 
					 else
						$out =$seconds." seconds ago";  
				 }
				 else{
					 if($minutes==1)
					 	$out =$minutes." minute ago"; 
					 else
						 $out =$minutes." minutes ago"; 					 
				 }
				
			 }
			 else{
				 if($hours==1)
					 $out =$hours." hour ago"; 
				 else
				 	$out =$hours." hours ago"; 
			 }
			
		}
		else if (date('Y-m-d',$seconds)==date('Y-m-d', gmmktime(0, 0, 0, date("m") , date("d") - 1, date("Y"))))
		{
			$out ='Yesterday at '.date('h:i A',$seconds);
		}
		else if (date('Y-m-d',$seconds)>=date('Y-m-d', gmmktime(0, 0, 0, date("m") , date("d") - 6, date("Y"))))
		{
			$out =date('l',$seconds)." at ".date('h:i A',$seconds);
		}
		else if (date('Y',$seconds)!=date('Y'))
		{
			$out =date('M d, Y',$seconds);
		}
		else 
		{
			$out =date('M d',$seconds);
		}
		 return $out;
		
	}

if ( ! function_exists('phoneNumberFormat'))
{
	function phoneNumberFormat($str)
	{
		return str_replace(array('(', ')','-',' '), '', $str);
	}
}

if ( ! function_exists('FileListDate'))
{
	function FileListDate($seconds = 1, $time = '')
	{

		if ( ! is_numeric($seconds))
		{
			$seconds = 1;
		}
	
		if ( ! is_numeric($time))
		{
			$time = time();
		}
	  
	  if (date('Y',$seconds)==date('Y'))
		{
			$out =date('M d, h:i A',$seconds);
		}
		else 
		{
			$out =date('M d, Y h:i A',$seconds);
		}
		 return $out;
		
	}
}
}

if(!function_exists('firstUpper'))
{
	
function firstUpper($str)
{
	$str_first=substr(trim($str),0,1);
		if(!preg_match('/[a-zA-Z]/', $str_first)){
			$str_out=trim($str);
		}else{
			$str_out=ucfirst($str);
		}
    return $str_out;
}
}




?>