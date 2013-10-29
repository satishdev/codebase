<?

$header_login=1;
$this->userType=2;

$active_tab = '0';
$left_nav=  'common/left_nav.php';

$right_nav =  'common/ads.php';

$content_page = 'players/advanceplayers.php';

$links_js_css='players/links_js_css';



?>






        <div class="header-bg">
				<div class="header ca">
				<div class="logo fl" style="padding-top:0px;"><a href="#"><img src="<?=base_url()?>asserts/new_images/logo.png" alt="logo" class="logo_icn"/></a></div>

        <?php if(isset($header_login) && $header_login){ ?>




        <?
		if($this->session->userdata('msg_check')=='login')
		{
			if($this->session->userdata('validation_errors')!='')
			{
			   echo $this->session->userdata('validation_errors');
			   $this->session->set_userdata('validation_errors','');
			}
			else
			{
			echo '<div style="color:#000099">'.$this->session->userdata('user_front_msg').'</div>';
			$this->session->set_userdata('user_front_msg','');
			}
			$this->session->set_userdata('msg_check','');
		}
		?>

			<? if($this->db_session->userdata('user_object')==''){?>

					<div class="email-pwd fr" >
						  <form method="POST" action="<?=base_url()?>reserve_golfcourse/login" name="login_frm" id="login_frm">
							<div class="flds fl">
								<label class="first">Email</label>
								<input type="text" id="uname" name="uname" class="text"/>
								<div class="txt_below">
									<label>
										<input type="checkbox" class="f3" >
										<span>Keep me logged in</span>
									</label>
								</div>
							</div>
							<div class="flds fld_center fl">
								<label class="first">Password</label>
								<input type="password" id="psw" name="psw" class="text"/>
								<div class="txt_below">Forgor your password?</div>
							</div>
							<div class="fl">
								<div class="login">
								<input type="hidden" name="login_type" id="login_type" value="FALSE" />
								<input type="submit" id="login_btn" value="Login" name="submit"/> <!--class="button_img"--></div>
								<div class="txt_below">Sign Up</div>
							</div>
							<div class="cb"></div>
						</form>
					</div>

			<? }?>




        <?php } ?>




		<!--<div class="cb">&nbsp;</div>-->



		<? if($this->db_session->userdata('user_object')!=''){?>
		<?php if(isset($this->userType)){ ?>

        <input type="hidden" id="user_id" value="<?php echo $this->userId; ?>">

        <input type="hidden" id="user_name" value="<?php echo substr(ucwords($this->userFname),0,10); ?>">

        <div id="settings_drop_wrap">

            <div class="settings">



                <a id="user_settings"><?php echo substr(ucwords($this->userFname.' '.$this->userLname),0,100); ?></a>

                <div class="settins_drop">

                    <div class="menu_item user_ico_container">

                        <div class="user_logo fl">

                            <?php if(!empty($this->image)){ ?>

                            <img width="50px" height="50px" src="<?php echo base_url().$this->image; ?>"/>

                            <?php }else{ ?>

                            <img src="<?php echo base_url(); ?>css/images/user_pic.png" width="50" height="50"/>

                            <?php } ?>

                        </div>

                        <div class="user_details">

                           <!-- <div>Player &nbsp;</div>-->

                           <!-- <div><?php echo $this->userFname; ?> </div>-->

                        </div>

                        <div class="clear"></div>

                    </div>

                    <div class="menu_item">

                        <a class="menu_link"href="javascript:void(0)" onclick="javascript:change_password();">Change Password</a>

                    </div>

                    <?php if ($this->userType == 1) { ?>

                    <div class="menu_item">

                        <a class="menu_link" href="<?php echo site_url('cp/profile'); ?>">My Account</a>

                    </div>

                    <?php

                        }else if ($this->userType == 2 ) {

                    ?>

                    <div class="menu_item">

                        <a class="menu_link" href="<?php echo site_url('players/profile'); ?>">My Account</a>

                    </div>

                    <div class="menu_item">

                        <a class="menu_link" href="<?php echo site_url('players/imageupload'); ?>">Change Image</a>

                    </div>

					<div class="menu_item">

                       <a class="menu_link" href="<?php echo base_url();?>reserve_golfcourse/check_out">My Cart</a>

                    </div>

                    <?php

                        } else if ( $this->userType == 3) {

                    ?>

                    <div class="menu_item">

                        <a class="menu_link" href="<?php echo site_url('clubs'); ?>">My Account</a>

                    </div>

					<div class="menu_item">

                        <a class="menu_link" href="<?php echo site_url('clubs/imageupload'); ?>">Change Image</a>

                    </div>

					<div class="menu_item">

                      <a class="menu_link" href="<?php echo base_url();?>reserve_golfcourse/check_out">My Cart</a>

                    </div>

                    <?php } ?>

                    <div class="menu_item last">
                         <? if(@$golf_course_page==1)
						 {$para=1;}
						 else{
						 $para=2;}?>
                        <a class="menu_link last" href="<?php echo site_url('reserve_golfcourse/logout/'.$para); ?>">Logout</a>

                    </div>

                </div>

            </div>


	    </div>

        <?php }
		} ?>


	   </div>
			</div>






		 <?php /*?> <div class="header_left">
            <div class="logo"><a href="<?=base_url()?>search_golfcourse/index"></a></div>
          </div>
          <div class="header_right">
		  <div class="input_error2">
		 <?
			if($this->session->userdata('msg_check')=='login')
			{
				$validation_errors=$this->session->userdata('validation_errors');
				if($validation_errors!='')
				{
					echo $validation_errors;
					$this->session->set_userdata('validation_errors','');
				}
				else
				{
					echo $this->session->userdata('user_front_msg');
					$this->session->set_userdata('user_front_msg','');
				}
				$this->session->set_userdata('msg_check','');
			}
			?>
		  </div>


			<?
		if(@$hide_logout!='yes')
		{
			if($this->db_session->userdata('user_object')==''){?>
			<div class="email2">
              <form method="post" action="<?=base_url()?>reserve_golfcourse/login">
			  <input class="log_in"  name="pasword" type="password" placeholder='Password...' value=""  />
              <input class="log" type="submit" style="cursor:pointer" />
            </div>
            <div class="email">
              <input type="text" name="email" value="" placeholder='Email...'  />
			  <input type="hidden" name="login_type" value="FALSE">
			  </form>
            </div>

			<? }else{?>
		<div style="float:right;"> <a href="<?=base_url()?>reserve_golfcourse/logout">Logout</a></div>
		 <? }
		 }?>



          </div><?php */?>


		  <?php $this->load->view('common/menu_items_new'); ?>



        <?php /*?><div id="navigation">
        <div class="navigation_left">
          <ul>
            <li><a class="select" href="<?=base_url()?>">Home</a></li>
           <!-- <li><a href="#">What is WESports?</a></li>
            <li><a href="#">How this Works</a></li>
            <li><a href="#">Join Today</a></li>-->
            <li><a href="#">Club Registration</a></li>
			<li><a href="<?=base_url()?>teetime_golfcourse/golf_course/">Golf Courses</a></li>
			<li><a href="<?=base_url()?>search_golfcourse/teetimes/">Tee Times</a></li>
          </ul>
          </div>

		<div id="helo"></div><?php */?>
<div id="wraper_outer">
  <div id="wraper">
