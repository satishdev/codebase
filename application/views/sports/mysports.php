<?php //print_r($sports_data);?>

<div id='content_header'>
	<div class='hdr-text'><?php if($this->userType==2) echo  anchor('',ucwords($this->userFname.' '.$this->userLname)).' Sports'; else echo "Sports";?></div>
    <?php if($this->userType==2) echo smallButton(array('label'=>'Available Sports', 'href'=>site_url('sports/allsports/'))); ?>
</div>

<div id="content_wrapper">

<div class='filter-with'>Filter With:</div>
<div class='alpha-nav'>
<ul>
<li><a  style=" width: 12px;" href="<?php echo site_url('sports/mysports');?>">All</a></li>
<?php for($i=65; $i<=90; $i++){ ?>
	<li><a href="<?php echo site_url('sports/mysports/'.chr($i).'/0');?>"><?php echo chr($i); ?></a></li>
<?php }?>
</ul>
</div>

    <div class="opt_box_wrapper sport">
        <?php if($total>0){ foreach($sports_data as $row){?>
            <div class='contact_card fl'>
                <div class='contact_left'>
                    <div class="image_area">
                    <img class="contact_img" src="<?php echo base_url(); ?><?php if(isset($row->logo) && $row->logo!='') echo 'images/sports/th_'.$row->logo;else echo "css/images/no_img_sp.jpg";?>" height="60px" width="60px" />
                    </div>
                </div>
                <div class='contact_right'>
                    <div class='line c1'><h3><?php echo $row->sname;?></h3></div>
                    <div class='line c2'><?php echo $row->stname;?></div>
                </div>
                <?php if($this->userType==2){?> <div class='contact_ftr'>
                    <?php if($row->is_owner!=0){ ?><div class='owner'>Owner</div><?php }?>

                    <?php if($row->is_owner!=0){ ?>
							<a class='act-status' href='<?php echo site_url('sports/edit_sports/'.$row->sid);?>'>Edit</a>
					<?php }else if($row->pid!=0){ ?>
                    		<a class='act-status' rel='<?php echo $row->sid; ?>' status='r'>Added</a>
					<?php }else{ ?>
                    		<a class='act-status' rel='<?php echo $row->sid; ?>' status='a'>Add</a>
                    <?php } ?>

                </div><?php } ?>
            </div>
        <?php } } else {?>
		<div class='contact_card fl'>
               No Records Found
            </div>
			<?php } ?>
        <div class="clear"></div>
    </div>
<div class="ca_page">	
		<?php echo $this->pagination->create_links();	?>
	</div>
</div>