<?php //print_r($sports_data);?>
<div id='content_header'>
	<div class='hdr-text'>All Players</div>
</div>

<div id="content_wrapper" class="players">
<div id="notifications" class="notifications">
	<?php if(count($sports_data)>0){ foreach($sports_data as $row){
	$rec_p=$this->sports_model->listofmysports($row->pid,0,3,'','');
	 ?>
        <div class="msg_item player">
       <a href="<?php echo site_url('profile/view/'.$row->pid);?>"> <img class="u_icn" src="<?php echo base_url(); ?><?php if($row->image!='') echo 'images/th_'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>"></a>
        <div class="msg_data">
            <a href="<?php echo site_url('profile/view/'.$row->pid);?>"><div class="u_name"><?php echo $row->pname;?></div></a>
            <div class="u_msg"><?php echo $row->cname;?></div>
            <div class="u_sports"><?php $sp_name=''; foreach($rec_p['records'] as $sp){ $sp_name.= $sp->sname.',';  } echo trim($sp_name,','); 
			if($rec_p['total']!=0) {?> & <a class='more_player_sports' rel='<?php echo $row->pid;?>'>more</a><? } ?></div>
            <div class="u_f_count"><?php if($row->frd_cnt!=0) echo $row->frd_cnt.' sPartners';?></div>
            <div class="msg_actions" rel='<?php echo $row->pid;?>'>
                <div class='n_actions'>
                	<?php
						$txt = 'Add';
						$status = 'a';
                                                $showlink = true;
						if($row->is_approved!=''){
							if($row->is_approved=='0' && $row->from==$this->userId){
								$txt = 'sFriend Request Sent';
								$status = 'w';
                                                                $showlink = false;
							}else if($row->is_approved=='0' && $row->to==$this->userId){
								$txt = 'Approve';
								$status = 'w';
							}
							else if($row->is_approved=='1'){
								$txt = $row->rname;
								$status = 'w';
							}
						}

                    if($showlink)
                    {?>
                    <div class='act_wrap center_wrap_all'><a class='n_act btn act-status ' rel='<?php echo $row->pid;?>' status='<?php echo $status; ?>'><?php echo $txt; ?></a></div>
                    <?php
                    }
                    else
                    {
                    ?>
                    <div class='act_wrap center_wrap_all'><a class='n_act btn act-status ' style="cursor:default" rel='<?php echo $row->pid;?>' status='<?php echo $status; ?>'><?php echo $txt; ?></a></div>
                    <?php
                    }
                    ?>
                    <div class='clear'></div>
                </div>
            </div>
           <!-- <div class='more'><a href="<?php echo site_url('profile/view/'.$row->pid);?>">More..</a></div>-->
        </div>
        </div>
		
    <?php } }else{?>
        <div class="msg_item">
        No records found
        </div>
    <?php } ?>
	<div class="ca_page">	
		<?php echo $this->pagination->create_links();	?>
	</div>
</div>
    
       
</div>