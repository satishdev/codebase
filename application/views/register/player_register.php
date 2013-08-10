<div class="left_column">
    <div class="left_column_box">
        <img src="<?php echo base_url(); ?>css/images/sample_slide.png" width="580" height="403" style="float: none;"/>
    </div>
</div>
<div class="right_column">
    <div class="player_registration_form">
    <form id="appl_form" method="post" action="<?php echo site_url('home'); ?>" suc_msg="Player Register: Submited Successfully.">
        <input id="" name="rel" class="text" type="hidden" value="player_reg"/>
        <ol>
            <li>
                <h3 class="fl">Sign Up</h3> <span><a  class="fr" style="margin-top:10px;" href="<?php echo site_url('club_register'); ?>">Register as club?</a></span>
                <div class="clear"></div>
            </li>
            <li><hr/></li>
            <li>
                <label for="first_name">First Name</label>
                <input id="first_name" name="first_name" class="text" value=""/>
            </li><li>
                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" class="text" value=""/>
            </li>
            <li>
                <label for="stu_number">Email</label>
                <input id="email" name="email" class="text" value=""/>
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="text" value=""/>
            </li>
            <li>
                <label for="cp_password">Confirm</label>
                <input type="password" id="cp_password" name="cp_password" class="text" value=""/>
            </li>
            <li>
                <label for="country_id">Country</label>
                <select id="country_id" name="country_id" class="text">
                    <?php echo selectBox('Select', 'country', 'id,name', 'status="1"', ''); ?>
                </select>
            </li>
            <li>
                <label for="dob">Birthday</label>
                <input type="text" id="dob" name="dob" class="text apply_datepicker" value=""/>
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

                       