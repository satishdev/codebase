<?php //print_r($sports_data);?>

<div id='content_header'>
	<div class='hdr-text'>Players</div>
</div>

<div id="content_wrapper" class="contacts players">
		
    <div class="opt_box_wrapper">
    <form id="appl_form" method="post" action="<?php echo site_url('players/advanceplayers');?>" name="appl_form">
                     
		<table width="100%" border="0" cellspacing="10" cellpadding="0" >
			<tr>
            	<td>First Name: </td><td><input  type="text" style="padding: 3px;"  class="text" name="fname" value="<?=$this->input->request('fname')?$this->input->request('fname'):''?>"/></td>
                <td>Last Name:</td><td> <input type="text" class="text" style="padding: 3px;" name="lname" value="<?=$this->input->request('lname')?$this->input->request('lname'):''?>"/></td>
           	</tr>
			<tr>
            	<td>Postcode/City: </td><td><input type="text" class="text" style="padding: 3px;" name="poc" value="<?=$this->input->request('poc')?$this->input->request('poc'):''?>"/></td>
                <td>Distance KM:</td>
				<td>
					<select name='dist' id='dist' class="text search_advance" >
                    <option value="5" <?=$this->input->request('dist')==5?"selected='selected'":''?>>5</option>
                    <option value="10" <?=$this->input->request('dist')==10?"selected='selected'":''?>>10</option>
                    <option value="25" <?=$this->input->request('dist')==25?"selected='selected'":''?>>25</option>
                    <option value="50" <?=$this->input->request('dist')==50?"selected='selected'":''?>>50</option>
                    <option value="100" <?=$this->input->request('dist')==100?"selected='selected'":''?>>100</option>
                    <option value="" <?=$this->input->request('dist')==''?"selected='selected'":''?>>Other</option>
                    </select>
                 </td>
            </tr>
			<tr>
                <td>Sport:</td>
                <td>
                    <select name='sp' id='sp' class="text search_advance" >
                    <?php
                  
                    echo selectBox('Select','sports','id,name','status="1"',$this->input->request('sp')?$this->input->request('sp'):0,'name'); ?>
                    </select>
                </td>
                <td>Level:</td>
                <td>
                    <select name='level' id='level' class="text search_advance" >
                    <?php 
                    echo selectBox('Select', 'levels', 'id,name', 'status="1"', $this->input->request('level')?$this->input->request('level'):0);
                    ?>		
                    </select>
                </td>
             </tr>
			 <tr>
             	<td colspan="4" align="center"><input type="submit" name="submit" value="Search" class="button_img"/></td>
             </tr>
		</table>
	</form>
    </div>
    
    <div class="adv_search_results notifications">
		
	<?php 
		if(isset($sports_data))
		{
			if(!empty($sports_data))
			{
				foreach($sports_data as $row)
				{?>
				<div class="msg_item player">
				<img class="u_icn" src="<?php echo base_url(); ?><?php if($row->image!='') echo 'images/th_'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>">
				<div class="msg_data">
					<div class="u_name"><?php echo $row->pname;?></div>
					<div class="u_msg"><?php echo $row->cname;?></div>
					<div class="msg_actions" rel='<?php echo $row->pid;?>'>
						<div class='n_actions'>
							<?php
								$txt = 'Add';
								$status = 'a';
								if($row->is_approved!=''){
									if($row->is_approved=='0'){
										$txt = 'Waiting for Approval';
										$status = 'w';
									}else if($row->is_approved=='1'){
										$txt = 'Waiting for Approval';
										$status = 'r';
									}
								}
							?>
							<div class='act_wrap'><a class='n_act btn act-status' rel='<?php echo $row->pid;?>' status='<?php echo $status; ?>'><?php echo $txt; ?></a></div>
							<div class='clear'></div>
						</div>
					</div>
					<div class='more'><a href="<?php echo site_url('profile/view/'.$row->pid);?>">More..</a></div>
				</div>
				</div>
			   <?php
				}
			}
			else
			{
				?>
					<div class="msg_data" align='center' style="color:#FF0000; font-size:14px; font-weight:bold">No Record Found</div>
				<?php
			}
		}
		?>
		
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div id="pager_wrap">
            <div class="ca_page">
				<?php echo $this->pagination->create_links();	?>
            </div>
        </div>
</div>