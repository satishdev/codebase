<?php //print_r($sports_data);?>

<div id='content_header'>
	<div class='hdr-text'>Players</div>
</div>

<div id="content_wrapper" class="contacts">
		
    <div class="opt_box_wrapper">
    <form id="appl_form" method="post" action="<?php echo site_url('players/advanceplayers');?>" name="appl_form">
                     
		<table width="100%" border="0" cellspacing="10px" >
			<tr>
            	<td>First Name: </td><td><input  type="text" style="padding: 1px;"  class="text" name="fname" value="<?php if(isset($_POST['fname']))echo $_POST['fname']; ?>"/></td>
                <td>Last Name:</td><td> <input type="text" class="text" style="padding: 1px;" name="lname" value="<?php if(isset($_POST['lname']))echo $_POST['lname']; ?>"/></td>
           	</tr>
			<tr>
            	<td>Postcode/City: </td><td><input type="text" class="text" style="padding: 1px;" name="poc" value="<?php if(isset($_POST['poc']))echo $_POST['poc']; ?>"/></td>
                <td>Distance KM:</td>
				<td>
					<?php if(isset($_POST['dist']))$dist=$_POST['dist'];else $dist='5';?><select name='dist' id='dist' class="text search_advance" >
                    <option value="5" <?php if($dist==5)echo "selected='selected'";?>>5</option>
                    <option value="10" <?php if($dist==10)echo "selected='selected'";?>>10</option>
                    <option value="25" <?php if($dist==25)echo "selected='selected'";?>>25</option>
                    <option value="50" <?php if($dist==50)echo "selected='selected'";?>>50</option>
                    <option value="100" <?php if($dist==100)echo "selected='selected'";?>>100</option>
                    <option value="" <?php if($dist=='')echo "selected='selected'";?>>Other</option>
                    </select>
                 </td>
            </tr>
			<tr>
                <td>Sport:</td>
                <td>
                    <select name='sp' id='sp' class="text search_advance" >
                    <?php
                    if(isset($_POST['sp']))$spid=$_POST['sp'];
                    else $spid='';
                    echo selectBox('Select','sports','id,name','status="1"',$spid,' name'); ?>
                    </select>
                </td>
                <td>Level:</td>
                <td>
                    <select name='level' id='level' class="text search_advance" >
                    <?php 
                    if(isset($_POST['level']))$level=$_POST['level'];
                    else $level='';
                    echo selectBox('Select', 'levels', 'id,name', 'status="1"', $level);
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
	<?php foreach($sports_data as $row){?>
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
								$txt = 'sFriend Request Sent';
								$status = 'w';
							}else if($row->is_approved=='1'){
								$txt = 'sFriend Request Sent';
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
    
           
        <?php } ?>	
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div id="pager_wrap">
            <div class="pager fr">
                <!--<div id="pager_prev" class="page_box fl">&nbsp;</div>-->
                <!--<div class="page_box fl">1</div>-->
				<?php echo $this->pagination->create_links();	?>
                <!--<div id="pager_next" class="page_box fl">&nbsp;</div>-->
            </div>
        </div>
</div>