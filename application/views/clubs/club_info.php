<div id='content_header'>
	<div class='hdr-text'><?php echo $c_data->name;?></div>
</div>

<div id="content_wrapper">
<div class="opt_box_wrapper clubs">

<div class="info_wrap">
<div class="info_left fl"><img class="image_it" src="<?php echo base_url(); ?><?php if($c_data->logo!='')echo 'images/'.$c_data->logo;else echo "css/images/no_image.png";?>" height="180px" width="230" /></div>
<div class="info_right fr"><h3><?php echo $c_data->name;?></h3>
<?php echo nl2br($c_data->description1);?>
</div>
<div class="clear"></div>
</div>
<?php if(count($crts_data)>0){ ?>
<div class="info_wrap">
<h3>Courts</h3>
<ul class="org_list">
<?php foreach($crts_data as $crt){ ?>
<li><?php echo $crt->name;?></li>
<?php } ?>
</ul>
</div>
<?php } ?>

<?php if(count($f_data)>0){ ?>
<div class="info_wrap">
<h3>Facilities</h3>
<ul class="org_list">
<?php foreach($f_data as $f){ ?>
<li><?php echo $f->name;?></li>
<?php } ?>
</ul>
</div>
<?php } ?>
<?php if(count($n_data)>0){ ?>
<div class="info_wrap">
<h3>News</h3>
<ul class="org_list">
<?php foreach($n_data as $n){ ?>
<li><?php echo $n->headline;?></li>
<?php } ?>
</ul>
</div>
<?php } ?>
<?php if(count($h_data)>0){ ?>
<div class="info_wrap">
<h3>Holidays</h3>
<ul class="org_list">
<?php foreach($h_data as $h){ ?>
<li><?php echo $h->name.' ('.date("d-m-Y",strtotime($h->holiday_date)).")";?></li>
<?php } ?>
</ul>
</div>
<?php } ?>

</div>
</div>