<div id='content_header'>
	<div class='hdr-text'>Club Owner Info &nbsp;<a href="<?php echo site_url('clubs/editinfo');?>">Edit</a></div>
</div>
<div id='content_wrapper' class="pad profile_wrapper">
<ul class='profile-form wesp-form'>
    <li>
        <label class="row_label">First Name:</label>
        <div class="field no-b"><?php echo $u_details->first_name;?></div>
    </li>
    <?php if($u_details->last_name!=''){?>
    <li>
        <label class="row_label">Last Name:</label>
        <div class="field no-b"><?php echo $u_details->last_name;?></div>
    </li>
    <?php } ?>
    <li>
       <label class="row_label">Email:</label>
       <div class="field no-b"><?php echo $u_details->email;?></div>
    </li>
</ul>
</div>
<div id='content_header'>
	<div class='hdr-text'>Club Info &nbsp;<a href="<?php echo site_url('clubs/edit');?>">Edit</a></div>
</div>
<div id='content_wrapper' class="pad profile_wrapper">
<ul class='profile-form wesp-form'>
    <li>
        <label class="row_label">Club Name:</label>
        <div class="field no-b"><?php echo $u_details->clname;?></div>
    </li>
    <li>
       <label class="row_label">zip:</label>
       <div class="field no-b"><?php echo $u_details->zip;?></div>
    </li>
    <li>
        <label class="row_label">phone:</label>
        <div class="field no-b"><?php echo ($u_details->phone!=0)? $u_details->phone:'--';?></div>
    </li>
    <li>
       <label class="row_label">mobile:</label>
       <div class="field no-b"><?php echo ($u_details->mobile!=0)? $u_details->mobile:'--';?></div>
    </li>
    <li>
        <label class="row_label">web_site:</label>
        <div class="field no-b"><?php echo $u_details->web_site;?></div>
    </li>
    <li>
        <label class="row_label">city:</label>
        <div class="field no-b"><?php echo ($u_details->city!=0)? $u_details->city:'--';?></div>
    </li>
    <li>
        <label class="row_label">state:</label>
        <div class="field no-b"><?php echo ($u_details->state!='')? $u_details->state:'--';?></div>
    </li>
	<li>
        <label class="row_label">country:</label>
        <div class="field no-b"><?php echo $u_details->countryname;?></div>
    </li>
    <li>
        <label class="row_label">address:</label>
        <div class="field no-b" ><?php echo ($u_details->address!='')? $u_details->address:'--';?></div>
    </li>
	 <li>
        <label class="row_label">No of courts:</label>
        <div class="field no-b" ><?php echo ($u_details->no_of_courts!='')? $u_details->no_of_courts:'--';?></div>
    </li>
	 <li>
        <label class="row_label">Width:</label>
        <div class="field no-b" ><?php echo ($u_details->width!='')? $u_details->width:'--';?></div>
    </li>
	 <li>
        <label class="row_label">Height:</label>
        <div class="field no-b" ><?php echo ($u_details->height!='')? $u_details->height:'--';?></div>
    </li>
	 <li>
        <label class="row_label">Area:</label>
        <div class="field no-b" ><?php echo ($u_details->area!='')? $u_details->area:'--';?></div>
    </li>
	 <li>
        <label class="row_label">Terms:</label>
        <div class="field no-b" ><?php echo ($u_details->terms!='')? nl2br($u_details->terms):'--';?></div>
    </li>
	 <li>
        <label class="row_label">Notes:</label>
        <div class="field no-b" ><?php echo ($u_details->notes!='')? nl2br($u_details->notes):'--';?></div>
    </li>
</ul>
</div>

