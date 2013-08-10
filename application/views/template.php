<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo @$my_title;?></title>
<link rel="shortcut icon" type="image/png" href="<?=base_url()?>css/images/wspt.png" />
<style type="text/css">
*{ margin:0px; padding:0px;}
<!--body{ min-height:900px;}-->
</style>
<link href="<?=base_url()?>asserts/css/site_css/stylesheet.css" rel="stylesheet" type="text/css" />

<link href="<?=base_url()?>asserts/css/view_golfcourse_dialogbox/wt-gallery.css" rel="stylesheet" type="text/css" />


<?php
$links_js_css='players/links_js_css';

	 if(isset($links_js_css)){ 

		if(is_array($links_js_css)){ 

			foreach($links_js_css as $links_js_css_view){

				$this->load->view($links_js_css_view);

			}

	}else{ 

		$this->load->view($links_js_css);

		 } 

	 }

	 if(isset($add_js_css) && is_array($add_js_css)){ 

			foreach($add_js_css as $add_js_css_l){

				echo $add_js_css_l;

			}

	} ?>










<script type="text/javascript" src="<?=base_url()?>asserts/js/jquery-1.8.1.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/js/view_golfcourse_dialogbox/jquery.wt-gallery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/js/view_golfcourse_dialogbox/preview.js"></script>


<script type="text/javascript">
function hide_shows()
{
 $('#dash-loader').show();
}
</script>

</head>

<body>

<div id="dialog-pic"></div>


<!--background-color:#CCCCCC;opacity: 0.5;z-index:1000;-->
<div id="dash-loader" style="display:none; position:fixed;width: 1000px; height: 800px;z-index:1000;" align="center">
<img style="margin-top: 189px;" src="<?=base_url()?>asserts/images/ajax-loader2.gif" />
</div>


<?php



$this->load->view('header');

echo $contents;
$this->load->view('footer');
?>





</body>
</html>

