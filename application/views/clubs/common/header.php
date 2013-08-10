<div class="header">
    <div id="logo_wrap">
        <div class="we_logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo site_url('css/images/logo.png'); ?>" /></a></div>
        <?php if(isset($header_login) && $header_login){ ?>
        <div class="fr">
            <div class="header_login_wrap">
                <form method="POST" action="<?php echo site_url('login'); ?>" name="login_frm" id="login_frm">
                <div class="fl field">
                    <div>Email:</div>
                    <div><input type="text" id="uname" name="uname" class="text"/></div>
                </div>
                <div class="fl field">
                    <div>Password:</div>
                    <div><input type="password" id="psw" name="psw" class="text"/></div>
                </div>
                <div class="fl field">
                    <div>&nbsp;</div>
                    <div><input type="submit" class="button_img" id="login_btn" value="Login" name="submit"/></div>
                </div>
                </form>
                <div class="clear"></div>
            </div>
        </div>
        <?php } ?>
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
                        <a class="menu_link last" href="<?php echo site_url('login/logout'); ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    
    <?php $this->load->view('common/menu_items_new'); ?>
</div>