<?php //print_r($sports_data);?>
<script type="text/javascript" language="javascript">
	wesport = {};
	wesport.relations = <?php echo isset($plrelation)?$plrelation:"[]"; ?>;
	wesport.team_relations = <?php echo isset($teamrelation)?$teamrelation:"[]"; ?>
</script>
<div id='content_header'>
	<div class='hdr-text'><?php  echo  anchor('',ucwords($this->userFname.' '.$this->userLname)).' sPartners'; ?> </div>
</div>

<div id="content_wrapper" class="contacts friends players" >
<div id="notifications" class="notifications">
	<?php if(count($sports_data)>0){ foreach($sports_data as $row){ 
	$rec_p=$this->sports_model->listofmysports($row->pid,0,3,'','');?>
        <div class="msg_item player">
       <a href="<?php echo site_url('profile/view/'.$row->pid);?>"> <img class="u_icn" src="<?php echo base_url(); ?><?php if($row->image!='') echo 'images/th_'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>"></a>
        <div class="msg_data">
            <div class="u_name"><a href="<?php echo site_url('profile/view/'.$row->pid);?>"><?php echo $row->pname;?></a></div>
            <div class="u_msg"><?php echo $row->cname;?></div>
			<div class="u_sports"><?php $sp_name=''; foreach($rec_p['records'] as $sp){ $sp_name.= $sp->sname.',';  } echo trim($sp_name,','); 
			if($rec_p['total']!=0) {?> & <a class='more_player_sports' rel='<?php echo $row->pid;?>'>more</a><? } ?></div>
			 <div class="u_f_count"><?php if($row->frd_cnt!=0) echo $row->frd_cnt.' sPartners';?></div>
            <div class="msg_actions" rel='<?php echo $row->pid;?>'>
                <div class='n_actions'>
                	<?php
					$txt = 'Add sFriend';
					$status = 'a';
						if($row->is_approved=='0'){
							?>
                            <div class='act_wrap'><a class='n_act btn act-status center_wrap' rel='<?php echo $row->pid;?>' status='w'>sFriend Request Sent</a></div>
							<?php }else{ ?>
                            <div class='act_wrap center_wrap'><a class='n_act btn relation' rel='<?php echo $row->pid;?>' status='r'><?php echo $row->rname; ?></a></div>
					<?php } ?>
                    <div class='clear'></div>
                </div>
            </div>
          <!--  <div class='more'><a href="<?php echo site_url('profile/view/'.$row->pid);?>">More..</a></div>-->
        </div>
        </div>
    <?php } }else{?>
        <div class="msg_item">
        No records found
        </div>
    <?php } ?>
     <?php echo $this->pagination->create_links();	?>
    
</div>
</div>