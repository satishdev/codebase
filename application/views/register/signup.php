<div class="part2 fl">

    <div class="signup-form">

        <div class="signup-form-heading">Sign Up</div>
		<div class="signup-form-form" style="color:#FF0000"><label><strong>"*"</strong> Marked Fields are Mandatory</label></div>

        <div class="signup-form-form">

            <?

            echo validation_errors();

            if ($this->session->userdata('msg') != '') {

                echo $this->session->userdata('msg');

                $this->session->unset_userdata('msg');

            }

            ?>

            <form method="post" action="#" id="appl_form" name="appl_form" method="post"

                  action=" <?php echo site_url('home'); ?>">

                <label><span style="color:#FF0000">*</span><input type="text" class="form-box first" id="first_name" name="first_name"

                              placeholder="First Name"/></label>

                <label><span style="color:#FF0000">*</span><input type="text" class="form-box" placeholder="Last Name" id="last_name"

                              name="last_name"/></label>

                <label><span style="color:#FF0000">*</span><input type="text" class="form-box form-box-two" id="email" name="email"

                              placeholder="Your Email"/></label>

                <!--<label><input type="text" class="form-box form-box-two" placeholder="Re-enter Email" /></label>-->

                <label><span style="color:#FF0000">*</span><input type="password" id="password" name="password" class="form-box form-box-two"

                              placeholder="Password"/></label>

                <label><span style="color:#FF0000">*</span><input type="Password" id="cp_password" name="cp_password" class="form-box form-box-two"

                              placeholder="Confirm Password"/></label>

                <label><span style="color:#FF0000">*</span><input type="text" id="dob" name="dob" class="form-box form-box-two" placeholder="Date of Birth"></label>

                <label><span style="color:#FF0000">*</span>

                    <select class="select_fld long m0" id="country_id" name="country_id">

                        <?php echo selectBox('Select Country', 'country', 'id,name', 'status="1"', ''); ?>

                    </select>

                </label>

                <label><span style="color:#FF0000">*</span>

                    <select class="select_fld long" id="gender" name="gender">

                        <option>Gender</option>

                        <option>Male</option>

                        <option>Female</option>

                    </select>

                </label>

                <input type="submit" class="submit_btn" name="imageField"/>

            </form>

        </div>

    </div>
</div>