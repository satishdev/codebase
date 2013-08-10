<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--Design by http://www.wesport.org-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<link rel="shortcut icon" type="image/png" href="<?= base_url();?>css/images/wspt.png" />
 <meta name="viewport" content = "width = device-width, initial-scale = 1, minimum-scale = 1, maximum-scale = 1" />
<?php
	 if(isset($links_js_css)){ 
		if(is_array($links_js_css)){ 
			foreach($links_js_css as $links_js_css_view){
				$this->load->view($links_js_css_view);
			}
	}else{ 
		$this->load->view($links_js_css);
		 } 
	 } ?>
	 
	 <link href="<?=base_url()?>asserts/css/site_css/stylesheet2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
       <!-- <div class="main">
            <div id="body_wrap">-->
                <?php $this->load->view('common/header'); ?>
                
                <div class="clr"></div>
                <div id="system_notification" class="header_resize"></div>
                <div class="clr"></div>
<div id="system_notification" class="header_resize"> <?php echo $this->db_session->flashdata('msg')?></div>
                <div id="content_wrap">
                    <!--            VARY CONTENT FROM HERE - START-->
                    <?php if (isset($content_page)) {
                        $this->load->view($content_page);
                    } ?>
                    <!--            VARY CONTENT FROM HERE - END-->
                    <div class="clear"></div>
                </div>
                <!-- Footer -->
                <div class="clear"></div>
               
			   
			   
			   
			   <div class="footer-bg">
				<div class="footer ca">
					<div class="logo1"><a><img src="<?=base_url()?>asserts/new_images/logo1.png" alt="Logo" /></a></div>
					<div class="footer_nav">
						<ul class="overhide">
							<li class="home-btn"><a href="#">Home</a></li>
							<li class="play-btn"><a href="#">Play</a></li>
							<li class="navigate-btn"><a href="#">NaviGATE</a></li>
							<li class="travel-btn"><a href="#">Travel</a></li>
							<li class="inspire-btn"><a href="#">Inspire</a></li>
							<li class="myclub-btn"><a href="#">MyClub</a></li>
						</ul>	
					</div>	
					<div class="website">&copy; Wesport.com</div>
				</div>
			</div>
			   
			   
			   
			   
			    <!--<div id="footer_wrap">
                    <div id="footer_content">
                        <span class="fc fl" style="padding-right:25px;">WESport Corporation 2012</span>
                        <span class="fc fl"> User Agreement | </span>
                        <span class="fc fl"> &nbsp; Privacy Policy | </span>
                        <span class="fc fl"> &nbsp; Copyright Policy</span>
                        <div class="clear"></div>
                    </div>
                </div>-->
          <!--  </div>
            <div class="clr clear"></div>
        </div>-->
    </body>
</html>
