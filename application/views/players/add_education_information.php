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

        $('#month').change(function(){
            if(($('#year2').val() != '') && ($('#year').val() != '') && ($('#year2').val() <= $('#year').val()))
            {
                if($('#month').val() > $('#month2').val())
                {
                    $(this).val('');
                    alert('start date should be less than end date');
                }
            }
        });
        $('#year').change(function(){
            if(($('#year2').val() != '') && ($('#year2').val() < $('#year').val()))
            {
                $(this).val('');
                alert('start date should be less than end date');
            }
        });
        $('#month2').change(function(){
            if(($('#year').val() != '') && ($('#year2').val() != '') && ($('#year2').val() <= $('#year').val()))
            {
                if($('#month').val() > $('#month2').val())
                {
                    $(this).val('');
                    alert('start date should be less than end date');
                }
            }
        });
        $('#year2').change(function(){
            if(($('#year').val() != '') && ($('#year2').val() < $('#year').val()))
            {
                $(this).val('');
                alert('start date should be less than end date');
            }
        });
    });
</script>

<div id='content_header'>
    <div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name.' '.$pedu_data->sub_heading.' '; ?>Educational Info</div>
</div>

<div id="content_wrapper" class="pad">
    <form id="appl_form" method="post" action="<?php echo site_url('players/add_education_information');?>" name="appl_form" >
 		<input type='hidden' name='id' id='id' value='<?php echo $pedu_data->id;?>'/> 
		<ul class='wesp-form'>
            <!--  <li>
                  <label for="educations_id">Education Type</label>
                              <select name='educations_id' id='educations_id' class="field">
            <?php echo selectBox('Select','education','id,name','status="1"','1'); ?>
	  		</select>
              </li>-->
            <li>
                <label for="course_name">School/Course Name</label>
                <input id="course_name" name="course_name" class="text field" value="<?php echo $pedu_data->course_name;?>"/>
            </li>
            <li>
                <label for="degree">Degree</label>
                <input id="degree" name="degree" class="text field" value="<?php echo $pedu_data->degree;?>"/>
            </li>
            <li>
                <label for="major">Study</label>
                <input id="major" name="major" class="text field" value="<?php echo $pedu_data->major;?>"/>
            </li>
            <li>
                <label for="month">Attended From</label>
                <select name='month' id='month' class="text field" style="width:80px; margin-right:20px;">
                    <option value="">Month</option>
                    <?php echo month_select($pedu_data->month); ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;<select name='year' id='year' class="field" style="width:80px;">
                    <option value="">Year</option>
                    <?php echo year_select($pedu_data->from_date); ?>
                </select>
            </li>
            <li>
                <label for="month2">Attended To</label>
                <select name='month2' id='month2' class="text field" style="width:80px; margin-right:20px;">
                    <option value="">Month</option>
                    <?php echo month_select($pedu_data->month2); ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;<select name='year2' id='year2' class="field" style="width:80px;">
                    <option value="">Year</option>
                    <?php echo year_select($pedu_data->to_date); ?>
                </select>
            </li>
            <li>
                <label for="notes">Additional Notes</label>
                <textarea id="notes" name="notes"><?php echo $pedu_data->notes;?></textarea>

            </li>
            <!--<li>
        <label for="from_date">Dates Attended</label>
       <select name='from_date' id='from_date' class="field">
            <?php //echo year_select(0); ?>
	  		</select>
    </li>
		<li>
        <label for="to_date">To</label>
       <select name='to_date' id='to_date' class="field">
            <?php //echo year_select(0); ?>
	  		</select>
    </li>
		<li>
        <label for="country_id">Country</label>
                    <select name='country_id' id='country_id' class="field">
            <?php //echo selectBox('Select','country','id,name','status="1"',''); ?>
	  		</select>
    </li>
		<li>
        <label for="state">State</label>
        <input id="state" name="state" class="text field" value=""/>
    </li>
		<li>
        <label for="zip">Zip Code</label>
        <input id="zip" name="zip" class="text field" value=""/>
    </li>		-->
            <li class='frm-btns'>
                <input class="button_img" type="submit" value="submit" name="submit" />
            </li>
        </ul>
    </form>
</div>