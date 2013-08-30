<style>
.left_fld{ width:280px;margin-right:10px; float:left}
.left_fld label{ margin-top:4px;display:block; color:#565656}
.d_fds.vm .left_fld label{ margin-top:0;}
.right_fld{ margin-left:290px; color:#000; }
.left_fld.lft_fldsmall{width:120px}
.right_fld.rgt_fldsmall{margin-left:130px}
.validcol,label.error{ color: #F45A51;}
</style>
<div class="part2 fl">
    <div class="signup-form">
        <div class="signup-form-heading">Sign Up</div>
		<div class="signup-form-form legend"><label><strong>*</strong> Marked Fields are Mandatory</label></div>
        <div class="signup-form-form">
            <?
            echo validation_errors();
            if ($this->session->userdata('msg') != '') {
                echo $this->session->userdata('msg');
                $this->session->unset_userdata('msg');
            }
            ?>
            <?php ////////////////// ?>
			<form method="post" action="#" id="appl_form" name="appl_form" method="post" action="">
			   <div class="d_fds">
					<div class="left_fld">
						<label for="first_name"><span class="validcol">*</span> First Name:</label> 
					</div>
					<div class="right_fld">
						  <input type='text' id="first_name" name="first_name" placeholder="First Name" value='' class="form-box required ip"/>
					</div>
					<div class="cb"></div>
				</div>
				
				<div class="d_fds">
					<div class="left_fld">
						<label for="last_name"><span class="validcol">*</span> Last Name:</label> 
					</div>
					<div class="right_fld">
						  <input type='text' placeholder="Last Name" id="last_name" name="last_name" value='' class="form-box required ip"/>
					</div>
					<div class="cb"></div>
				</div>
				<div class="d_fds">
					<div class="left_fld">
						<label for="email"><span class="validcol">*</span> Your Email Id:</label> 
					</div>
					<div class="right_fld">
						<input type='text' id="email" name="email" placeholder="Your Email Id" value='' class="form-box required ip"/>
					</div>
					<div class="cb"></div>
				</div>
				<div class="d_fds">
					<div class="left_fld">
						<label for="password"><span class="validcol">*</span> Password:</label> 
					</div>
					<div class="right_fld">
						<input type="password" id="password" name="password" placeholder="Password" class="form-box required ip"/>
					</div>
					<div class="cb"></div>
				</div>
				<div class="d_fds">
					<div class="left_fld">
						<label for="cp_password"><span class="validcol">*</span> Confirm Password:</label> 
					</div>
					<div class="right_fld">
						<input type="Password" id="cp_password" name="cp_password" placeholder="Confirm Password" value='' class="form-box required ip"/>
					</div>
					<div class="cb"></div>
				</div>
				<div class="d_fds">
					<div class="left_fld">
						<label for="dob"><span class="validcol">*</span> Date of Birth:</label> 
					</div>
					<div class="right_fld">
						<input type="text" id="dob" name="dob"  placeholder="Date of Birth" class="{validate:{date:true}} form-box"/>
					</div>
					<div class="cb"></div>
				</div>
				<div class="d_fds">
					<div class="left_fld">
						<label for="country_id"><span class="validcol">*</span> Country:</label> 
					</div>
					<div class="right_fld">
						<select class="select_fld long m0 required valid" id="country_id" name="country_id">
							<?php echo selectBox('Select Country', 'country', 'id,name', 'status="1"', ''); ?>
						</select>
					</div>
					<div class="cb"></div>
				</div>
				
				
				<div class="d_fds">
					<div class="left_fld">
						<label for="gender"><span class="validcol">*</span> Gender:</label> 
					</div>
					<div class="right_fld">
						<select class="select_fld long required valid" id="gender" name="gender">
							<option>Gender</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</div>
					<div class="cb"></div>
				</div>
				<div class="d_fds">
					<input type="button" id="r_lgn_btn" value='submit' class="submit_btn" name="imageField"/>
					<span class="jerror_msg"></span>
				 </div>
			</form>

			<?php ////////////////// ?>
        </div>
    </div>
</div>

<script type="text/javascript">
var site_url = '<?php echo site_url();?>';
$(document).ready(function() {
$( "#dob" ).datepicker({
		dateFormat:'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		maxDate: "-18Y"
	});
	$("#appl_form").validate({
	rules: {
			first_name: {
				required: true
			},
			last_name: {
				required: true
			},
			gender: {
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
			},
			dob: {
				required: true,
				date: true
			},
			country_id: {
				required: true
			}
		},
        messages: {
		first_name: {
		   required: "Please enter First Name"
		},
		last_name: {
			required: "Please enter Last Name"
		},
		gender: {
			required: "Please select gender"
		},
		email: {
			required: "Please enter a valid email address",
			email: "Please enter a valid email address"
		},
		dob: {
			required: "Please enter date of birth",
			date: "Date of birth should be in date format"
		},
		country_id: {
			required: "Please select country"
		},
		password: {
			required: "Please provide a password",
			minlength: "Your password must be at least 6 characters long"
		},
		cp_password: {
			required: "Please provide confirm password",
			minlength: "Your confirm password must be at least 6 characters long",
			equalTo: "Please enter the same password as above"
		}
	},
	errorPlacement: function(error, element) {
		error.insertAfter(element);
	},
	submitHandler: function()
		{
			var data = $('#appl_form').serialize();
			$.ajax({
				type: "POST",
				url: base_url + "home",
				data: data,
				dataType: "json",
				beforeSend: function () {
					//console.log(data);
					$("#success_msg").html("");
					$("#error_msg").html("");
				},
				success: function (data) {
					if (data.status) {
						//window.location.href = base_url+"home";
						$("#remote_post").addClass('success_msg').html(data.message).show();
						setTimeout(function () {
							window.location.href = base_url + "login";
						}, 3000);
	
					} else {
						//$("#error_msg").html(data.message);
						$("#remote_post").addClass('error_msg').html(data.message).show();
					}
				},
				error: function (e, a) {
					// window.location.href = base_url+"home";
				}
			});
		}
	});
	$('#r_lgn_btn').live('click',function(){
		$("#appl_form").submit();
	})
});
</script>		