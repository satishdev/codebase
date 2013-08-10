<?php


function smallButton($settings){
    $id = false;
    $class = false;
    $rel = false;
    $href = false;
    extract($settings);
	$btn = '<a class="btnRC'.($class?" ".$class:"").'"'.($href?" href='".$href."'":"").($id?" id='".$id."'":"").($rel?" rel='".$rel."'":"").'>';
	$btn .= '<span class="inner-btn"><span class="label">'.$settings['label'].'</span></span>';
	$btn .= '</a>';
	
	return $btn;
}

function horizontalTab($settings){
	$tab = '<ul class="horizontal_tab">';
	foreach($settings['options'] as $row){
		$tab .= '<li><a '.(isset($row['active'])?'class="active_tab"':'').' '.(isset($row['id'])?'id="'.$row['id'].'"':'').' '.(isset($row['href'])?'href="'.$row['href'].'"':'').' '.(isset($row['rel'])?'rel="'.$row['rel'].'"':'').'>';
		$tab .= '<span class="inner_span"><span class="label_span">'.$row['label'].'</span></span>';
		$tab .= '</a></li>';
	}
	$tab .= '</ul>';
	
	return $tab;
}

function js2PhpTime($jsdate){
  if(preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches)==1){
    $ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
    //echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }else if(preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches)==1){
    $ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
    //echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }
  return $ret;
}

function php2JsTime($phpDate){
    //echo $phpDate;
    //return "/Date(" . $phpDate*1000 . ")/";
    return date("m/d/Y H:i", $phpDate);
}

function php2MySqlTime($phpDate){
    return date("Y-m-d H:i:s", $phpDate);
}

function mySql2PhpTime($sqlDate){
    $arr = date_parse($sqlDate);
    return mktime($arr["hour"],$arr["minute"],$arr["second"],$arr["month"],$arr["day"],$arr["year"]);

}
function listCalendar($day, $type){
  $phpTime = js2PhpTime($day);
  //echo $phpTime . "+" . $type;
  switch($type){
    case "month":
      $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime)+1, 1, date("Y", $phpTime));
      $cnt = 3;
      break;
    case "week":
      //suppose first day of a week is monday 
      $monday  =  date("d", $phpTime) - date('N', $phpTime) + 1;
      //echo date('N', $phpTime);
      $st = mktime(0,0,0,date("m", $phpTime), $monday, date("Y", $phpTime));
      $et = mktime(0,0,-1,date("m", $phpTime), $monday+7, date("Y", $phpTime));
      $cnt = 2;
      break;
    case "day":
      $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime)+1, date("Y", $phpTime));
      $cnt = 2;
      break;
  }
  //echo $st . "--" . $et;
  $data['st']=$st;
  $data['et']=$et;
  $data['cnt']=$cnt;
  return $data;
}