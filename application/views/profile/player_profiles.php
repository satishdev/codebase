<?php if($u_details){ ?>
<div id='content_header'>
	<div class='hdr-text'><?php  echo anchor('profile/view/'.$id,$u_details->first_name.' '.$u_details->last_name); ?> info</div>
    <?php
	//$obj = array();
	//$obj['options'][] = array('id'=>'player_profile', 'label'=>'Profile', 'href'=>site_url('profile/view/'.$id), 'active'=>true);
	//$obj['options'][] = array('id'=>'gallery', 'label'=>'Gallery', 'href'=>site_url('profile/gallery/'.$id));
    //echo horizontalTab($obj);
	?>
</div>

<div id='content_wrapper' class="pad profile_wrapper">         
    <ul class='profile-form wesp-form'>
        <li>
            <label>First Name:</label>
            <div class="field no-b"><?php echo $u_details->first_name;?></div>
        </li>
        <li>
            <label>Last Name:</label>
            <div class="field no-b"><?php echo $u_details->last_name;?></div>
        </li>
        <li>
            <label>Email:</label>
            <div class="field no-b"><?php echo $u_details->email;?></div>
        </li>
        <li>
            <label>Mobile:</label>
            <div class="field no-b"><?php echo $u_details->mobile!=0? $u_details->mobile:'--';?></div>
        </li>
        <li>
            <label>Phone:</label>
            <div class="field no-b"><?php echo $u_details->phone!=0? $u_details->phone:'--';?></div>
        </li>
        <li>
            <label>Zip Code:</label>
            <div class="field no-b"><?php echo $u_details->zip!=0? $u_details->zip:'--';?></div>
        </li>
        <li>
            <label>City:</label>
            <div class="field no-b"><?php echo $u_details->city!='0'? $u_details->city:'--';?></div>
        </li>
        <li>
            <label>State:</label>
            <div class="field no-b"><?php echo $u_details->state!=''? $u_details->state:'--';?></div>
        </li>
        <li>
            <label>Website:</label>
            <div class="field no-b"><?php echo $u_details->web_site!=''? $u_details->web_site:'--';?></div>
        </li>
        <li>
            <label>Height:</label>
            <div class="field no-b"><?php echo $u_details->height!=''? $u_details->height:'--';?></div>
        </li>
        <li>
            <label>weight:</label>
            <div class="field no-b"><?php echo $u_details->weight!=''? $u_details->weight:'--';?></div>
        </li>
        <li>
            <label>Address:</label>
            <div class="field no-b"><?php echo $u_details->address!=''? $u_details->address:'--';?></div>
        </li>
        <li>
            <label>About me:</label>
            <div class="field no-b"><?php echo $u_details->about_me!=''? $u_details->about_me:'--';?></div>
        </li>
        <li>
            <label>Country:</label>
            <div class="field no-b"><?php echo $u_details->cname!=''? $u_details->cname:'--';?></div>
        </li>					
    </ul>

</div>
<?php }?>