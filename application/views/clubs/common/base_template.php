<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--Design by http://www.wesport.org-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<link rel="shortcut icon" type="image/png" href="<?= base_url();?>css/images/wspt.png" />
 <meta name="viewport" content = "width = device-width, initial-scale = 1, minimum-scale = 1, maximum-scale = 1" />
    <title>Welcome to WESport, The First social Network for sports</title>
    <?php
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
	<script>
	var base_url="<?=base_url()?>";
	</script>
	
	
	
	
	<script>
function hide_show()
{
  $('#dash-loader').show();
}

</script>


</head>
<body>


<!--background-color:#CCCCCC;opacity: 0.5;z-index:1000;-->
<div id="dash-loader" style="display:none; position:fixed;width: 1000px; height: 800px;z-index:1000;" align="center">
<img style="margin-top: 189px;" src="<?=base_url()?>asserts/images/ajax-loader2.gif" />
</div>


<div id="dialog-pic"></div>


<div class="main_body">
    <div id="body_wrap">
        <?php $this->load->view('common/header'); ?>
        
        <div class="clr"></div>
        <div id="system_notification" class="header_resize"> <?php echo $this->db_session->flashdata('msg')?></div>
        <div class="clr"></div>
        
        <div class="content">
            <div class="content_resize">
                <div class="mainbar<?php if(isset($left_nav)){echo ' left_true';} if(isset($right_nav)){if(isset($long_right)) echo ' long_right_true'; else echo ' right_true';} ?>">

                    <?php if(isset($left_nav)){?>
                        <div class="left_nav">
						<?php if(is_array($left_nav)){ foreach($left_nav as $left_nav_view){?>
                        	<?php $this->load->view($left_nav_view); }
							}else{?>
							<?php $this->load->view($left_nav); }?>
                        </div>
                    <?php } ?>
                    
                    <?php if (isset($content_page)) { ?>
                    <div class="article" id="main_content">                            
                            <?php $this->load->view($content_page); ?>
                     </div>
                     <?php } ?>
                     
                     <?php if(isset($right_nav)){ ?>
                        <div class="right_nav">
							<?php if(is_array($right_nav)){ foreach($right_nav as $right_nav_view){?>
                        	<?php $this->load->view($right_nav_view); }
							}else{?>
							<?php $this->load->view($right_nav); }?>
                        </div>
                    <?php } ?>
                     
                     <?php if(isset($left_nav)){?>
                     	<div class='s-line left'></div>
                     <?php } ?>
                     <?php if(isset($right_nav)){?>
                     	<div class='s-line right'></div>
                     <?php } ?>
                     
                     <div class="clr"></div>
                    
                </div>
                <!--<div class="clr"></div>-->
            </div>
        </div>
        <!-- Footer -->
        <div class="clear"></div>
        <div id="footer_wrap">
            <div id="footer_content">
                <span class="fc fl" style="padding-right:25px;">WESport Corporation 2012</span>
                <span class="fc fl"> User Agreement | </span>
                <span class="fc fl"> &nbsp; Privacy Policy | </span>
                <span class="fc fl"> &nbsp; Copyright Policy</span>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clr clear"></div>
</div>

</body>
    
</html>
