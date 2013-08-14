<div class="header-bg">

    <div class="header ca">

        <div class="logo fl"><a href="#"><img src="<?= base_url() ?>asserts/new_images/logo.png" alt="logo"

                                              class="logo_icn"/></a></div>

        <?php if (isset($header_login) && $header_login) { ?>

            <div class="email-pwd fr">

                <form method="POST" action="<?php echo site_url('login'); ?>" name="login_frm" id="login_frm">

                    <div class="flds fl">

                        <label>Email ID</label>

                        <input type="text" id="uname" name="uname" class="text"/>

                        <div class="txt_below"><label><input type="checkbox" name="remember_me" class="f3"><span>Keep me logged in</span></label></div>

                    </div>

                    <div class="flds fld_center fl">

                        <label>Password</label>

                        <input type="password" id="psw" name="psw" class="text"/>



                        <div class="txt_below">Forgot your password?</div>

                    </div>

                    <div class="fl">

                        <div class="login"><input type="submit" class="button_img" id="login_btn" value="Login"

                                                  name="submit"/></div>

                        <input type="hidden" name="test" value="12345">

                        <div class="txt_below">
						<a href="<?php echo base_url() . 'signup';?>">
						<input type="submit" class="button_img" id="signup" value="Sign Up" name="signup"/></a>
						</div>

                    </div>

                </form>

            </div>

        <? } ?>



        <?php if (isset($this->userType)) { ?>

            <input type="hidden" id="user_id" value="<?php echo $this->userId; ?>">

            <input type="hidden" id="user_name" value="<?php echo substr(ucwords($this->userFname), 0, 10); ?>">

            <div id="settings_drop_wrap">

                <div class="settings">

                    <a id="user_settings"><?php echo substr(ucwords($this->userFname . ' ' . $this->userLname), 0, 100); ?></a>



                    <div class="settins_drop">

                        <div class="menu_item user_ico_container">

                            <div class="user_logo fl">

                                <?php if (!empty($this->image)) { ?>

                                    <img width="50px" height="50px" src="<?php echo base_url() . $this->image; ?>"/>

                                <?php } else { ?>

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

                            <a class="menu_link" href="javascript:void(0)" onclick="javascript:change_password();">Change

                                Password</a>

                        </div>

                        <?php if ($this->userType == 1) { ?>

                            <div class="menu_item">

                                <a class="menu_link" href="<?php echo site_url('cp/profile'); ?>">My Account</a>

                            </div>

                        <?php

                        } else if ($this->userType == 2) {



                            ?>



                            <div class="menu_item">



                                <a class="menu_link" href="<?php echo site_url('players/profile'); ?>">My Account</a>



                            </div>



                            <div class="menu_item">



                                <a class="menu_link" href="<?php echo site_url('players/imageupload'); ?>">Change

                                    Image</a>



                            </div>



                            <div class="menu_item">



                                <a class="menu_link" href="<?php echo base_url(); ?>reserve_golfcourse/check_out">My

                                    Cart</a>



                            </div>



                        <?php



                        } else if ($this->userType == 3) {



                            ?>



                            <div class="menu_item">



                                <a class="menu_link" href="<?php echo site_url('clubs'); ?>">My Account</a>



                            </div>



                            <div class="menu_item">



                                <a class="menu_link" href="<?php echo site_url('clubs/imageupload'); ?>">Change

                                    Image</a>



                            </div>



                            <div class="menu_item">



                                <a class="menu_link" href="<?php echo base_url(); ?>reserve_golfcourse/check_out">My

                                    Cart</a>



                            </div>



                        <?php } ?>

                        <div class="menu_item last">

                            <a class="menu_link last" href="<?php echo site_url('login/logout'); ?>">Logout</a>

                        </div>

                    </div>

                </div>





                <div class="cart_system">

                    <a href="<?php echo base_url(); ?>reserve_golfcourse/check_out">My Cart</a>

                </div>

            </div>

        <?php } ?>

        <div class="cb">&nbsp;</div>

    </div>

</div>

<?php $this->load->view('common/menu_items_new'); ?>

