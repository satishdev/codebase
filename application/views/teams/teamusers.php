<?php //print_r($sports_data);?>
<div id="content_wrapper" class="pad">
        <div id="header_wrapper">
                <h3 class="fl header_new">Players</h3>
                <div class="search_wrap fr">
                
                </div>
               <div class="clear"></div>
        </div>
        <div class="opt_box_wrapper">
            <?php foreach($sports_data as $row){?>
                <div class="big_opt_box fl">
                        <div class="big_opt_left fl">
                            <div class="section_1">
                                <div class="image_area fl">
                                    <img src="<?php echo base_url(); ?><?php if($row->image!='') echo 'images/th_'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>" width="50" height="50" alt=""/>
                                </div>
                                <div class="box_text fl">
                                    <h3><?php  echo $row->first_name.' '.$row->last_name;?></h3>
                                    <span><?php  echo $row->first_name.' '.$row->last_name;?></span>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="section_2">
                                <h4>Players: 12</h4>
                                <ul class="list">
                                    <li>
                                        <div class="label fl">Captain:</div><div class="label_value fl">Raju</div><div class="clear"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="big_opt_right fl">
                            <div class="opt_ico'>&nbsp;</div>
                            <div class="more_link">
                                <a href="<?php echo site_url('profile/view/'.$row->id);?>">More</a>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
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