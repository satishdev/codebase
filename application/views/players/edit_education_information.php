<script>
$(document).ready(function() {
       $("#appl_form").validate({
		rules: {
		   course_name: {
		   required: true,
		
		   },
             degree: {
			   required: true,
			   },
			    major: {
		   required: true,
		
		   }
			},
		messages: {
			course_name: {
				required: "Please enter Course Name",
			},
			degree: {
				required: "Please enter Degree",
			},
			major: {
				required: "Please enter Major",
			}
			
		}
	});
});	
</script>

<div id='content_header'>
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Edit Educational Info</div>
</div>

<div id="content_wrapper" class="pad">
<form id="appl_form" method="post" action="<?php echo site_url('players/add_education_information');?>" name="appl_form" >
    <ul class='wesp-form'>
	     <?php foreach($e_details as $row){?>
		  <input id="id" name="id" type="hidden" value="<?php echo $row->id;?>"/>
        <li>
            <label for="educations_id">Education Type</label>
			<select name='educations_id' id='educations_id' class="field">
	 		 <?php echo selectBox('Select','education','id,name','status="1"',$row->educations_id); ?>
	  		</select>
        </li>
		<li>
            <label for="course_name">Course Name</label>
            <input id="course_name" name="course_name" class="text field" value="<?php echo $row->course_name;?>"/>
        </li>
		<li>
            <label for="degree">Degree</label>
            <input id="degree" name="degree" class="text field" value="<?php echo $row->degree;?>"/>
        </li>
		<li>
            <label for="major">Major</label>
            <input id="major" name="major" class="text field" value="<?php echo $row->major;?>"/>
        </li>
		<li>
            <label for="from_date">From</label>
           <select name='from_date' id='from_date' class="field">
	 		 <?php echo year_select($row->from_date); ?>
	  		</select>
        </li>
		<li>
            <label for="to_date">To</label>
           <select name='to_date' id='to_date' class="field">
	 		 <?php echo year_select($row->to_date); ?>
	  		</select>
        </li>
		<li>
            <label for="country_id">Country</label>
			<select name='country_id' id='country_id' class="field">
	 		 <?php echo selectBox('Select','country','id,name','status="1"',$row->country_id); ?>
	  		</select>
        </li>
		<li>
            <label for="state">State</label>
            <input id="state" name="state" class="text field" value="<?php echo $row->state;?>"/>
        </li>
		<li>
            <label for="zip">Zip Code</label>
            <input id="zip" name="zip" class="text field" value="<?php echo $row->zip;?>"/>
        </li>
		<?php } ?>
         <li class='frm-btns'>
			<input class="button_img" type="submit" value="submit" name="submit" />
        </li>
    </ul>
</form>
</div>