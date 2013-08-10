<div id='content_header'>
	<div class='hdr-text'>Clubs</div>
</div>

<div id="content_wrapper">
<div class="opt_box_wrapper clubs">
<?php /*?><?php for($i=0; $i<15; $i++){ ?>
    <div class='box_it fl'>
    	<div class="top_it"><a class="name_it" href="<?php echo base_url()."players/club_info";?>">Club Name 123</a></div>
        <div class='left_it'>
            <div class="image_area">
            <a href="#"><img class="image_it" src="<?php echo base_url()."css/images/no_team.jpg";?>" height="60px" width="60px" /></a>
            </div>
        </div>
        <div class='right_it'>
            <div class='desc_it'>40 of our best and most popular clubs, you're guaranteed a great round of golf at these courses. Grab your friends and save even more with our fabulous four ball offers.</div>
        </div>
    </div>
<?php } ?>
	<div class="clear"></div><?php */?>
    
   <?php for($i=0; $i<15; $i++){ ?>
    <div class="welst_vw">
    
        <a class="welst_vwLeft" href="#">
        <img width="162" height="123" itemprop="photos" alt="" src="http://images.golfbreaks.com/162/123/False/warwickshire-golf-country-club-teeing-off.jpg">
        </a>
        <div class="keyInfo clearfix">
        <div class="nameAndLocation partWidth clearfix">
            <div class="jsEnabled">
                <h2><a  href="#" ><span>Earls Course</span></a></h2>
                <a href="#">The Warwickshire Golf Club</a>
                (Warwickshire, West Midlands, England)
            </div>
        </div>
        <div class="keyStats clearfix">
                <div class="pricingInfo ">
                    <span class="priceText">From £12.50</span>
                    <span class="dealText"> Save 75%</span>
                </div>
            <div class="courseType">18 Holes, Par 72, 7,108 Yards</div>
        </div>
        </div>
        <p>The Earls Course at The Warwickshire Golf Club is made up of the old North and West loops of 9. The golf course is long and fairly narrow with tree lined fairways making accuracy off the tee essential. Book a tee time online and you will be astonished by the remarkable variety of golf the Earls Course has to offer.</p>
        <div class="reviewCtaContainer clearfix">
            <div class="courseReviews">
                <div class="gsReview">
                    <div class="reviewRating ir rated4"></div>
                </div>
            </div>		
            <input type="submit" class="button_img fr" name="submit" value="View">
            <div style="clear:both"></div>
        </div>
    
    </div>
    <?php } ?>
    
</div>
</div>