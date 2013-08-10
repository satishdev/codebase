<div class="pop">
  <div class="pop_top"></div>
  <div class="pop_rpt">
    <div class="review2">
      <h3>Review of <?=@$course_name?></h3>
      <h5 style="float:right;" ><a href="#." onclick="golf_review(<?=$course_id?>)" >Back to Review Listing</a></h5>
	  <script>
	  function form_submit()
	  {
		var my_title=$('#my_title').val();
		var my_coment=$('#my_coment').val();
		//var my_conditin=$('#conditin:checked').val();
		//var my_facilits=$("#facilits:checked").val();
		//var my_overall=$('#overall:checked').val();
		
		if(my_title=='')
		{
		   $('#error').text('Title Field is required.');
		   return false;
		}
		if(my_coment=='')
		{
		   $('#error').text('Comment Field is required.');
		   return false;
		}
		if( $("#conditin:checked").length == 0)
		{
		   $('#error').text('Course Conditions Field is required.');
		   return false;
		}
		if($("#facilits:checked").length == 0)
		{
		   $('#error').text('Service & Facilities Field is required.');
		   return false;
		}
		if($("#overall:checked").length == 0)
		{
		   $('#error').text('Overall Rating Field is required.');
		   return false;
		}
		
		if(my_title=='' && my_coment=='' && $("#conditin:checked").length == 0 && $("#facilits:checked").length == 0 && ("#overall:checked").length == 0)
		{
		  $('#error').text('All Field is required.');
		  return false;
		}
		
		$('#error').text('');
		$('#error').html('<img src="<?=base_url()?>asserts/images/ajax-loader2.gif">');
		$.ajax({
		type:'post',
		data:$('#my_form').serialize(),
		url:'<?=base_url()?>golfcourse_detail/review_course',
		success:function(data){
		$('#error').html(data);
		}
		});
		
		//.val();
		
	  }
	  
	  </script>


<form id="my_form">
	  <ul>
        
		<li class="first_li">
        
		<div id="error" style="color:#FF0000"></div>
		 <?php 
		// if($this->input->post('submit')=='TRUE')
		// echo validation_errors(); 
		/*echo $this->session->userdata('my_msg');
		if($this->session->userdata('my_msg')!='')
		{
			echo '<p style="color:#FF0000">'.$this->session->userdata('my_msg').'</p>';
			$this->session->set_userdata('my_msg','');
		}*/
		
		?>
        </li>
		<?php //if($this->input->post('title')!=''){ echo $this->input->post('title');} ?>
		<li class="first_li">
          <label><b>Review Title:</b></label>
          <input type="text" name="my_title" id="my_title" value="" />
         <!-- <a href="#"><img src="images/club_image.png" alt="#" /></a>-->
        </li>
		
		<li>
          <h3>Comments: </h3>
<?php //if($this->input->post('coment')!=''){ echo $this->input->post('coment');} ?>
         <textarea name="my_coment" id="my_coment"></textarea>
        </li>
	   
	    
		<li>
		 <h3>Course Conditions:</h3>
          <p> Was the course well-kept and the grass healthy? Could you distinguish fairway from rough? Were the greens healthy, well cared-for and clean?</p>
          <p>
		 <input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==1){?> checked="checked"<?php }?> value="1" />
            <label>******Excellent</label>
          </p> 
        <p>
           <input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==2){?> checked="checked"<?php }?> value="2" />
            <label>****Very Good</label>
          </p>
          <p>
          <input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==3){?> checked="checked"<?php }?> value="3" />
            <label>***Average</label>
          </p>
          <p>
           <input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==4){?> checked="checked"<?php }?> value="4" />
            <label>**Poor</label>
          </p>
          <p>
            <input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==5){?> checked="checked"<?php }?> value="5" />
            <label>*Awful</label>
          </p>
        </li>
        
		
		<li>
          <h3>Service &amp; Facilities:</h3>
          <p> Was the staff friendly and attentive? Was the pace of play satisfactory? Did the facilities create a welcoming atmosphere?</p>
          <p>
          <input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==1){?> checked="checked"<?php }?> value="1" />
            <label>******Excellent</label>
          </p>
          <p>
           <input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==2){?> checked="checked"<?php }?> value="2" />
            <label>****Very Good</label>
          </p>
          <p>
         <input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==3){?> checked="checked"<?php }?> value="3" />
            <label>***Average</label>
          </p>
          <p>
            <input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==4){?> checked="checked"<?php }?> value="4"  />
            <label>**Poor</label>
          </p>
          <p>
           <input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==5){?> checked="checked"<?php }?> value="5" />
            <label>*Awful</label>
          </p>
        </li>
		
		
		<li>
          <h3>Overall Rating:</h3>
          <p> From the time you checked-in until the walk back to your vehicle, what was your overall experience with this course? What impression did it leave on you?</p>
          <p>
          <input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==1){?> checked="checked"<?php }?> value="1" />
            <label>******Excellent</label>
          </p>
          <p>
            <input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==2){?> checked="checked"<?php }?> value="2" />
            <label>****Very Good</label>
          </p>
          <p>
           <input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==3){?> checked="checked"<?php }?> value="3" />
            <label>***Average</label>
          </p>
          <p>
            <input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==4){?> checked="checked"<?php }?> value="4" />
            <label>**Poor</label>
          </p>
          <p>
            <input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==5){?> checked="checked"<?php }?> value="5" />
            <label>*Awful</label>
          </p>
        </li>
        
		
		<li>
          <div class="mile3">
		  <input type="hidden" name="course_id" value="<?=$course_id?>" />
		  <input type="hidden" name="submit" value="TRUE" />
           <input type="button" value="Send"  onclick="form_submit()" />
          </div>
        </li>
      </ul>
	  </form>
    </div>
  </div>
  <div class="pop_bottom">
    <div class="clr"></div>
  </div>
  <div class="clr"></div>
</div>











<!--<img src="http://xml.golfswitch.com/img/course/<?php echo $course_id;?>/<?php echo $course_img;?>" width="200" height="150" alt="#" />-->

