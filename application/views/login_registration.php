<div class="navigation_right">

      </div>





	<form method="post" name="" action="<?php echo base_url()?>reserve_golfcourse/login">
		<div id="content">
          <div id="home_content_left">
            <div class="search">
              <div class="search_top">
                <h3>Account Login</h3>
              </div>
              <div class="search_rpt">
			  <?
				if($this->session->userdata('msg_check')=='process_login')
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
				 }?>
                <div class="search_mid">
                  <ul>





					<li>
                      <label>Email:</label>
                      <div class="region3_outer">
                        <div class="region3">
                          <input type="text" name="uname" value="" />
                        </div>
                        </div>
                    </li>


                    <li>
                      <label>Password:</label>
                      <div class="region3_outer">
                        <div class="region3">
                          <input type="password" name="psw" value="" />
                        </div>
                        </div>
                    </li>
                    <li class="spacr">
                      <div class="region4">
					  <input type="hidden" name="login_type" value="TRUE">
					  <input type="submit" style="cursor:pointer" name="submit" value="Sign In"> </div>
                    </li>
                  </ul>
                  <div class="clr"></div>
                </div>
                <div class="clr"></div>
              </div>
              </form>





			  <!--<div class="search_bottom">
                <ul>
                  <li class="first_li"><a href="#">Additional Search Options </a></li>
                  <li>
                    <input type="checkbox" />
                    <label>Show redemption times only </label>
                  </li>
                  <li>
                    <input type="checkbox" />
                    <label>Show tee time specials only </label>
                  </li>
                </ul>
                <div class="clr"></div>
              </div>-->
            </div>
          </div>
          <!--<div id="home_content_right">
			<? if($this->session->userdata('user_object')==''){?>
			<div class="register">
              <div class="register_top">
                <h4>Register now</h4>
              </div>
              <div class=" register_rpt">
                <div class="register_mid">
                  <ul>

				<li>
				 <div class="input_error">
				<?
			/*if($this->session->userdata('msg_check')=='not_login')
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
			 }*/
				?>
					</div>
					</li>



					<li>
                      <form method="post" action="<?=base_url()?>reserve_golfcourse/registration">
					  <label>Name:</label>
                      <div class="male">
                        <?
					   @$first_name=$this->session->userdata('first_name');
						$this->session->set_userdata('first_name','');?>
						<input type="text" name="first_name" value="<?=@$first_name?>" />
                        <div class="clr"></div>
                      </div>
                      <div class="male">
                        <?
					   @$last_name=$this->session->userdata('last_name');
						$this->session->set_userdata('last_name','');?>
						<input type="text" name="last_name" value="<?=@$last_name?>" />
                        <div class="clr"></div>
                      </div>
                    </li>
                    <li>
                      <label>Email:</label>
                      <div class="male2">
                         <?
					   @$email=$this->session->userdata('email');
						$this->session->set_userdata('email','');?>
						<input type="text" name="email" value="<?=@$email?>" />
                      </div>
                    </li>
                    <li>
                      <label>Password:</label>
                      <div class="male2">
                        <?
					   @$pasword=$this->session->userdata('password');
						$this->session->set_userdata('password','');?>
						<input type="password" name="password" value="<?=@$pasword?>" />
                      </div>
                    </li>
                    <li>
                      <label>Gender:</label>
                      <div class="male3">
                        <?
					   @$gender=$this->session->userdata('gender');
						$this->session->set_userdata('gender','');?>
						<select name="gender">
                          <option <? if(@$gender==1){?> selected="selected"<? }?> value="1">Male</option>
						   <option <? if(@$gender==2){?> selected="selected"<? }?> value="0">Female</option>
                        </select>
                      </div>
                      <small>DOB</small>
                      <div class="male4">
                        <?
					   @$days=$this->session->userdata('days');
						$this->session->set_userdata('days','');?>
						<select name="days">
                          <? for($i=1;$i<=30;$i++){?>
						  <option <? if(@$days!=''){if(@$days==$i){?> selected="selected"<? } }?> value="<?=$i?>"><?=$i?></option>
                          <? }?>
						</select>
                      </div>
                      <div class="male4">
					   <?
					   @$months=$this->session->userdata('months');
						$this->session->set_userdata('months','');?>

                        <select name="months">
						  <? for($i=1;$i<=12;$i++){?>
                          <option <? if(@$months!=''){if(@$months==$i){?> selected="selected"<? }}?> value="<?=$i?>"><?=$i?></option>
                          <? }?>
						</select>
                      </div>
                      <div class="male5">
                        <?  @$years=$this->session->userdata('years');
						$this->session->set_userdata('years','');?>

						<select name="years">
                          <? $year=date('Y');
						  $last_year=date('Y', strtotime('-50 year'));
						  for($i=$year;$i>=$last_year;$i--){?>
						  <option <? if(@$years!=''){if(@$years==$i){?> selected="selected"<? }}?> value="<?=$i?>"><?=$i?></option>
						  <? }?>
                        </select>
                      </div>
                    </li>
                    <li>
                      <label>Country</label>
                      <div class="male2">

					<?  $set_country=$this->session->userdata('country');
					$this->session->set_userdata('country','');?>

					  <select name="country_id">
                          <option value="">select any</option>
                    <? $country_info=$this->common_model->select_all('id,name,fips_code','country');
					foreach($country_info->result() as $info)
					{?>
						 <option <? if($set_country!=''){ if($set_country==$info->id){?> selected="selected"<? } }?> value="<?=$info->id ?>"><?=$info->name ?></option>
                 <? }?>
						</select>
                      </div>
                    </li>
                    <li class="last_li">
                      <input type="hidden" name="registration_type" value="TRUE" />

					  <input class="sum" type="submit"  style="cursor:pointer" value="Submit"  />
					  </form>
                    </li>
                  </ul>
                  <div class="clr"></div>
                </div>
                <div class="clr"></div>
              </div>
              <div class="register_bottom"></div>
            </div>
			<? }?>
          </div>-->





		  <div class="right_column">

    <div class="player_registration_form">

    <form id="appl_form" method="post" action="<?php echo base_url();?>home/index2" suc_msg="Player Register: Submited Successfully.">

        <input id="" name="rel" class="text" type="hidden" value="player_reg"/>

        <ol>

            <li>

                <h3 class="fl">Sign Up</h3> <span><a  class="fr" style="margin-top:10px;" href="<?php echo site_url('club_register'); ?>">Register as club?</a></span>

                <div class="clear"></div>

            </li>

            <li><hr/></li>

            <li>

                <label for="first_name">First Name:*</label>

                <input id="first_name" name="first_name" class="text" value=""/>

            </li>

            <li>

                <label for="last_name">Last Name:*</label>

                <input id="last_name" name="last_name" class="text" value=""/>

            </li>

            <li>

                <label for="last_name">Gender:*</label>

                <select id="gender" name="gender" class="text">

                	<option value="m">Male</option>

                    <option value="f">Female</option>

                </select>

            </li>

            <li>

                <label for="stu_number">Email:*</label>

                <input id="email" name="email" class="text" value=""/>

            </li>

            <li>

                <label for="password">Password:*</label>

                <input type="password" id="password" name="password" class="text" value=""/>

            </li>

            <li>

                <label for="cp_password">Confirm:*</label>

                <input type="password" id="cp_password" name="cp_password" class="text" value=""/>

            </li>

            <li>

                <label for="country_id">Country:*</label>

                <select id="country_id" name="country_id" class="text">

                    <?php echo selectBox('Select', 'country', 'id,name', 'status="1"', ''); ?>

                </select>

            </li>

            <li>

                <label for="dob">Birthday:*</label>

                <input type="text" id="dob" name="dob" readonly="readonly" class="text apply_datepicker" value=""/>

            </li>



            <!--<li id="uploaded_image"></li>-->

            <li>

                <!--<input type="button" name="imageField" class="upload button j_gen_form_submit" value="Get the Id Card"/>-->

                <label for="dob">&nbsp;</label>

                <input type="submit" class="button_img" value="Sign Up" name="submit" />

                <!--<input type="button" name="imageField" class="upload button j_gen_form_submit" value="Submit"/>-->

            </li>

            <!--<li><hr/></li>-->

        </ol>

     </form>

    </div>

</div>

	<script type="text/javascript"  rel="javascript">

$(document).ready(function() {



       $("#appl_form").validate({

		rules: {

                           first_name: {

                                required: true



                           },

                         last_name: {

                                   required: true

                           },

                         email: {

                                  required: true,

                                    email: true

			   },



			password: {

				required: true,

				minlength: 5

			},

			cp_password: {

				required: true,

				minlength: 5,

				equalTo: "#password"

			}



			},

		messages: {

			first_name: {

				required: "Please enter First Name"

			},

			last_name: {

				required: "Please enter Last Name"

			},



			email: {

                            required:"Please enter a valid email address",

                            email:"Please enter a valid email address"

                        },

			password: {

				required: "Please provide a password",

				minlength: "Your password must be at least 5 characters long"

			},

			cp_password: {

				required: "Please provide confirm password",

				minlength: "Your confirm password must be at least 5 characters long",

				equalTo: "Please enter the same password as above"

			}



		}

	});

});

</script>

          <div class="clr"></div>
        </div>


		</div><!--wraper div end-->
