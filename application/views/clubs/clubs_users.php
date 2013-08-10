<?php //print_r($sports_data);?>
<script type="text/javascript" language="javascript">
	wesport = {};
	wesport.relations = <?php echo isset($plrelation)?$plrelation:"[]"; ?>;
	wesport.team_relations = <?php echo isset($teamrelation)?$teamrelation:"[]"; ?>
</script>
<div id='content_header'>
	<div class='hdr-text'>Club Users</div>
</div>

<div id="content_wrapper" class="contacts friends">
<div id="notifications" class="notifications">
	<?php if(count($sports_data)>0){ foreach($sports_data as $row){ ?>
        <div class="msg_item player">
       <a href="<?php echo site_url('profile/view/'.$row->pid);?>">  <img class="u_icn" src="<?php echo base_url(); ?><?php if($row->image!='') echo 'images/th_'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>"></a>
        <div class="msg_data">
            <div class="u_name"><?php echo anchor('profile/view/'.$row->pid,ucwords($row->pname));?></div>
            <div class="u_msg"><?php echo $row->cname;?></div>
            <div class="msg_actions" rel='<?php echo $row->pid;?>'>
                <div class='n_actions'>
                	
                            <div class='act_wrap'><a class='n_act btn relation' rel='<?php echo $row->pid;?>' status='r'><?php //echo $row->rname; ?>Unjoin</a></div>
                    <div class='clear'></div>
                </div>
            </div>
            <div class='more'><a href="<?php echo site_url('profile/view/'.$row->pid);?>">More..</a></div>
        </div>
        </div>
    <?php } }else{?>
        <div class="msg_item">
        No records found
        </div>
    <?php } ?>
    
       <!--<div id="pager_wrap">
        <div class="pager fr">
            <div id="pager_prev" class="page_box fl">&nbsp;</div>
            <div class="page_box fl">1</div>
            <?php echo $this->pagination->create_links();	?>
            <div id="pager_next" class="page_box fl">&nbsp;</div>
        </div>
    </div>-->
</div>
</div>