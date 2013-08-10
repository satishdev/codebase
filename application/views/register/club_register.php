<div class="left_column">
    <div class="left_column_box">
        <h3>Sports Club:</h3>
        <p>It was born out of a passion for Cricket! Conceived by a few young minds dreamt of creating a combination of a Clubhouse adjacent with a Cricket stadium in the 50's when Ahmedabad was a small city with a population of 6 lakhs, it took 15 years for the dream to come true! And it has never stood still..."</p>
        <p>In the early 1950's, the Province of Bombay gifted 80,000 sq. yards of land to the Cricket Club of Ahmedabad, to construct a grand Cricket Stadium and a Club House. CCA handed over the project as well as the land to the Ahmedabad Municipal Corporation at a token price. It was agreed to have separate management for the Stadium and the Club House and that the original members of the CCA would from a new club, christened The Sports Club of Gujarat against a surrounding land with legal possession to the Sports Club of Gujarat against a princely sum in that time. And thus emerged the butterfly out of the coccon! The Sports Club of Gujarat was officially inaugurated on July 17, 1965.</p>
        <p>Chinubhai Chimanbhai, leading industrialist and Mayor of Ahmedabad, went out of his way to hire the world-renowned architect Charles Correa to design both the Stadium and the Club House. Charles Correa, a master of modern progressive architecture also happens to be the designer of the Gandhi-Ashram on the banks of Sabarmati, which is standing physical manifestation of the Gandhian philosophy. A horizontal expanse in space providing vertical growth in activity is what the Club building is all about. The whole Clubhouse is designed by Correa on a Waffle-Grid structure. The unique feature of this structure is that it gives great flexibility on all sides for any kind of expansion or modification in space.</p>
        <p></p>
    </div>
</div>
<div class="right_column">
    <form id="appl_form" method="post" action="<?php echo site_url('club_register'); ?>" >
        <input id="" name="rel" class="text" type="hidden" value="player_reg"/>
        <ol class='club_registration'>
            <li>
                <h4>Club Registration</h4>
            </li>

            <li>
			 <div class="msg" id="remote_post"></div>
                <label for="name">Club Name</label>
                <input id="name" name="name" class="text" value=""/>
            </li>
            <li>
                <label for="zip">Zip</label>
                <input id="zip" name="zip" class="text" value=""/>
            </li>
            <li>
                <label for="first_name">Website</label>
                <input id="web_site" name="web_site" class="text" value=""/>
            </li>
            <li>
                <br/>
                <h4>Personal Information</h4>
            </li>
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
                <label for="password">Passworde</label>
                <input type="password" id="password" name="password" class="text" value=""/>
            </li>
            <li>
                <label for="cp_password">Conform Password</label>
                <input type="password" id="cp_password" name="cp_password" class="text" value=""/>
            </li>
		<?php /*?>	<li>
                <label for="city">City</label>
                <input type="text" id="city" name="city" class="text" value=""/>
            </li><?php */?>
            <li>
                <label for="country_id">Country</label>
                <select id="country_id" name="country_id" class="text">
                    <?php echo selectBox('Select', 'country', 'id,name', 'status="1"', '1'); ?>
                </select>
            </li>
            <li>
                <br/>
                <!--<input type="button" name="imageField" class="upload button j_gen_form_submit" value="Get the Id Card"/>-->
                <input type="submit" id="_r_lgn_btn" class="button_img" value="submit" name="submit"/>
                <!--<input type="button" name="imageField" class="upload button j_gen_form_submit" value="Submit"/>-->
            </li>
        </ol>
    </form>
</div>

<script type="text/javascript"  rel="javascript">
var base_url="<?=base_url()?>";
$(document).ready(function() {
		$("#_r_lgn_btn").live("click", function(){		
			var FRM = $("#appl_form");
			$.login_validate(FRM);		
			//$(FRM).submit();
		});
      // $("#appl_form").validate();
});
$.extend({
	login_validate: function(FRM){
		$(FRM).validate({
		rules: {
		name: {
                       required: true

                       },
                       zip: {
                       required: true

                       },
                       web_site: {
                       required: true

                       },
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
				minlength: 6
			},
			cp_password: {
				required: true,
				minlength: 6,
				equalTo: "#password"
			}

			},
		messages: {
                        name: {
				required: "Please enter Club Name"
			},
			zip: {
				required: "Please enter Zip code"
			},
			web_site: {
				required: "Please enter web site"
			},
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
				minlength: "Your password must be at least 6 characters long"
			},
			cp_password: {
				required: "Please provide confirm password",
				minlength: "Your confirm password must be at least 6 characters long",
				equalTo: "Please enter the same password as above"
			}

		},
		 errorPlacement: function(error, element){
               $(element).closest('li').append(error);
            },
            submitHandler: function(form){
            	$.login_post(form);
            }
	});
	},
	login_post: function(FRM){
		var data = $(FRM).serialize();
		$.ajax({
		    type: "POST",
		    url: base_url+"club_register",
		    data: data,
		    dataType: "json",
		    beforeSend: function(){
		        //console.log(data);
		        $("#success_msg").html("");
				$("#error_msg").html("");
		    },
		    success: function(data){

		    	if(data.status){
					 $("#remote_post").addClass('success_msg').html(data.message).show();
		    	}else{
					 $("#remote_post").addClass('error_msg').html(data.message).show();
		    	}
		        
		    },
		    error: function(e, a){
		       // window.location.href = base_url+"home";
		    }
		});
	}
});
</script>
