<div id='content_header'>
	<div class='hdr-text'>Clubs <?php if(isset($_POST['serchKey']) and $_POST['serchKey']!='' and $_POST['serchKey']!='Search...' and $total!=0){ echo "With ".$_POST['serchKey']." we think you're looking for one of these ".$total." Clubs";   }?></div>
</div>

<div id="content_wrapper">
<!--<div>test</div>-->
<div class="opt_box_wrapper clubs">
    
   <?php if($total>0){ foreach($club_data as $row){ ?>
    <div class="welst_vw">
        <a class="welst_vwLeft" href="#">
        <img width="162" height="123" itemprop="photos" alt="" src="<?php echo base_url(); ?><?php if($row->logo!='')echo 'images/'.$row->logo;else echo "css/images/no_image.png";?>">
        </a>
        <div class="keyInfo clearfix">
        <div class="nameAndLocation partWidth clearfix">
            <div class="jsEnabled">
                <h2><a  href="#" ><span><?php echo $row->name;?></span></a></h2>
               <!-- <a href="#">The Warwickshire Golf Club</a><br />-->
               <?php $text="(";
				if($row->city!='')$text.=$row->city;
				if($row->city!='' && $row->state!='')$text.=', '.$row->state;else if($row->state!='')$text.=$row->state;
				if($row->city!='' || $row->state!='')$text.=', '.$row->cname.")";else $text.=$row->cname.")";
				echo $text;?>
            </div>
        </div>
        <!--<div class="keyStats clearfix">
                <div class="pricingInfo ">
                    <span class="priceText">From £12.50</span>
                    <span class="dealText"> Save 75%</span>
                </div>
            <div class="courseType">18 Holes, Par 72, 7,108 Yards</div>
        </div>-->
        </div>
        <p><?php echo nl2br($row->description1);?></p>
        <div class="reviewCtaContainer clearfix">
            <div class="courseReviews">
                <div class="gsReview">
                   <!-- <div class="reviewRating ir rated4"></div>-->
					
					<?php  if($row->cpid!=0 and $row->is_approved=='0'){ ?>
                    		Waiting for approval
							<?php } else if($row->cpid!=0 and $row->is_approved=='1'){ ?>
                    		<a class='button_img act-status' rel='<?php echo $row->clbid; ?>' status='r'>Unjoin</a>
					<?php }else{ ?>
                    		<a class='button_img act-status' rel='<?php echo $row->clbid; ?>' status='a'>Join</a>
                    <?php } ?>
                </div>
            </div>	
                   
            <a class="button_img fr" href="<?php echo site_url('cb/club_info/'.$row->clbid);?>" >View</a>
            <div style="clear:both"></div>
        </div>
    
    </div>
    <?php } }else{?>
	No Records Found
	
	<?php }?>
    
</div>
</div>