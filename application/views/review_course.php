
<?php echo validation_errors(); ?>

<form action="" method="post" enctype="multipart/form-data">
<table>

<tr>
<td>

<img src="http://xml.golfswitch.com/img/course/<?php echo $course_id;?>/<?php echo $course_img;?>" width="200" height="150" alt="#" />

</td>
</tr>


<tr>
<td>
Review Title: <br />
<input type="text" name="title" id="title" value="<?php if($this->input->post('title')!=''){ echo $this->input->post('title');} ?>" />
</td>
</tr>


<tr>
<td>
Comments: <br />
<textarea name="coment" id="coment"><?php if($this->input->post('coment')!=''){ echo $this->input->post('coment');} ?></textarea>
</td>
</tr>


<tr>
<td>
Course Conditions:
Was the course well-kept and the grass healthy? Could you distinguish fairway from rough? Were the greens healthy, well cared-for and clean?<br />
<input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==5){?> checked="checked"<?php }?> value="5" />******Excellent<br />
<input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==4){?> checked="checked"<?php }?> value="4" />****Very Good<br />
<input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==3){?> checked="checked"<?php }?> value="3" />***Average<br />
<input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==2){?> checked="checked"<?php }?> value="2" />**Poor<br />
<input type="radio" name="conditin" id="conditin" <?php if($this->input->post('conditin')!='' && $this->input->post('conditin')==1){?> checked="checked"<?php }?> value="1" />*Awful<br />
</td>
</tr>


<tr>
<td>
Service & Facilities:
Was the staff friendly and attentive? Was the pace of play satisfactory? Did the facilities create a welcoming atmosphere?<br />
<input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==5){?> checked="checked"<?php }?> value="5" />******Excellent<br />
<input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==4){?> checked="checked"<?php }?> value="4" />****Very Good<br />
<input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==3){?> checked="checked"<?php }?> value="3" />***Average<br />
<input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==2){?> checked="checked"<?php }?> value="2"  />**Poor<br />
<input type="radio" name="facilits" id="facilits" <?php if($this->input->post('facilits')!='' && $this->input->post('facilits')==1){?> checked="checked"<?php }?> value="1" />*Awful<br />
</td>
</tr>


<tr>
<td>
Overall Rating:
From the time you checked-in until the walk back to your vehicle, what was your overall experience with this course? What impression did it leave on you?<br />
<input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==5){?> checked="checked"<?php }?> value="5" />******Excellent<br />
<input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==4){?> checked="checked"<?php }?> value="4" />****Very Good<br />
<input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==3){?> checked="checked"<?php }?> value="3" />***Average<br />
<input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==2){?> checked="checked"<?php }?> value="2" />**Poor<br />
<input type="radio" name="overall" id="overall" <?php if($this->input->post('overall')!='' && $this->input->post('overall')==1){?> checked="checked"<?php }?> value="1" />*Awful<br />
</td>
</tr>



<tr>
<td>
<input type="submit" value="Submit" name="submit" />
</td>
</tr>

</table>
</form>