<script type="text/javascript" src="<?=base_url()?>asserts/js/jquery-1.8.1.js"></script>



<link href="<?=base_url()?>asserts/css/view_golfcourse_dialogbox/wt-gallery.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="<?=base_url()?>asserts/js/view_golfcourse_dialogbox/jquery.wt-gallery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/js/view_golfcourse_dialogbox/preview.js"></script>


<script src="<?php echo base_url()?>asserts/js/ui/jquery-ui-1.8.23.custom.js"></script>
<script src="<?php echo base_url()?>asserts/js/js_model/jquery.bgiframe-2.1.2.js"></script>
	<!--end for dialog box-->
		
	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.button.js"></script>
	<!--for dialog box-->
	<script src="<?php echo base_url()?>asserts/js/js_model/jquery.ui.position.js"></script>
	<script src="<?php echo base_url()?>asserts/js/js_model/jquery.ui.dialog.js"></script>
	<!--end for dialog box-->
<script>
//start for photos view in dialogbox
function golf_photo(course_id)
{
   $.ajax({
   type:'post',
   data:'course_id='+course_id,
   url:'<?=base_url()?>teetime_golfcourse/golf_photo/',
   success:function(data){
    $('#dialog-pic').html(''); 
	$('#dialog-pic').html(data); 
   }
   });
   var myFunc = function() {
		$container = $(".container");
		$container.wtGallery({
			num_display:4,
			screen_width:590,
			screen_height:360,
			padding:10,
			thumb_width:125,
			thumb_height:70,
			thumb_margin:5,
			text_align:"top",
			caption_align:"bottom",
			auto_rotate:false,
			delay:5000,					
			cont_imgnav:true,
			cont_thumbnav:true,
			display_play:true,
			display_imgnav:true,
			display_imgnum:false,
			display_thumbnav:true,
			display_thumbnum:false,					
			display_arrow:true,
			display_tooltip:false,
			display_timer:true,
			display_indexes:true,
			mouseover_pause:false,
			mouseover_text:false,
			mouseover_info:false,
			mouseover_caption:true,
			mouseover_buttons:false,
			transition:"h.slide",
			transition_speed:800,
			scroll_speed:600,
			vert_size:45,
			horz_size:45,					
			vstripe_delay:90,
			hstripe_delay:90,
			move_one:false,
			shuffle:false
		});
		
		var $submitButton = $("#submit-btn");
		var $resetButton =  $("#reset-btn");
		var $effects = $("#effects");		
		var $textAlign = $("input[name='text-align']");
		var $captionType = $("input[name='cap-type']");
		var $thumbsAlign = $("input[name='thumbs-align']");
		var $playCB = $("#play-cb");
		var $imgnavCB = $("#imgnav-cb");
		var $imgNumCB = $("#imgnum-cb");
		var $thumbnavCB = $("#thumbnav-cb");
		var $thumbnumCB = $("#thumbnum-cb");
		var $indexCB = $("#page-cb");
		var $timerCB = $("#timer-cb");
		var $arrowCB = $("#arrow-cb");
		var $mouseoverText = $("#mouseover-text");
		var $mouseoverCaption = $("#mouseover-caption");
		var $mouseoverInfo = $("#mouseover-info");
		var $mouseoverBtns = $("#mouseover-btns");
				
		$submitButton.click(function() {
			$container.undoChanges()
			.setEffect($effects.val())
			.setTextAlign($textAlign.filter(":checked").val())
			.setCaptionType($captionType.filter(":checked").val())
			.setThumbsAlign($thumbsAlign.filter(":checked").val())
			.setPlayButton($playCB.prop("checked"))
			.setDButtons($imgnavCB.prop("checked"))	
			.setImageNumber($imgNumCB.prop("checked"))
			.setTimerBar($timerCB.prop("checked"))
			.setIndexes($indexCB.prop("checked"))
			.setThumbButtons($thumbnavCB.prop("checked"))	
			.setThumbNumber($thumbnumCB.prop("checked"))
			.setSelectArrow($arrowCB.prop("checked"))
			.setMouseoverText($mouseoverText.prop("checked"))
			.setMouseoverCaption($mouseoverCaption.prop("checked"))
			.setMouseoverInfo($mouseoverInfo.prop("checked"))
			.setMouseoverButtons($mouseoverBtns.prop("checked"))
			.updateChanges();	
		});
		
		$resetButton.click(function() {
			init();
			$submitButton.trigger("click");
		});
		
		var init = function() {
			$effects.val("h.slide");
			$("input#top-align").prop("checked", true);
			$("input#inside-cap").prop("checked", true);
			$("input#thumbs-bottom-align").prop("checked", true);
			$playCB.prop("checked", "checked");
			$imgnavCB.prop("checked", "checked");
			$imgNumCB.prop("checked", "");
			$timerCB.prop("checked", "checked");
			$indexCB.prop("checked", "checked");
			$thumbnavCB.prop("checked", "checked");
			$thumbnumCB.prop("checked", "");
			$arrowCB.prop("checked", "checked");
			$mouseoverText.prop("checked", "");
			$mouseoverCaption.prop("checked", "checked").attr("disabled", false);
			$mouseoverInfo.prop("checked", "").attr("disabled", false);
			$mouseoverBtns.prop("checked", "").attr("disabled", false);
		}
		init();};
	
   $('#dash-loader').show().delay(5100).fadeOut(300);
   setTimeout(function(){$( "#dialog-pic" ).dialog( "open" );$("#dialog-pic").dialog('option', 'title', "Golf Course Photo's"); myFunc();}, 5100);
}
//end for photos view in dialogbox

$(function() {
		$( "#dialog-pic" ).dialog({
			autoOpen: false,
			height: 900,
			width: 950,
			modal: true,
			buttons: {
				//"Create an account": function() {
				//},
				//Cancel: function() {
				//$( this ).dialog( "close" );
				//}
			},
			/*close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}*/
		});

		//$( "#create-user" ).click(function() {
			//	$( "#dialog-form" ).dialog( "open" );
			//});
	});


//start for review view in dialogbox
function golf_review(course_id)
{
	$.ajax({
	type:'post',
	data:'course_id='+course_id,
	url:'<?=base_url()?>golfcourse_detail/all_review_listing/',
	success:function(data){
	$('#dialog-pic').html(''); 
	$('#dialog-pic').html(data); 
	}
	});
	
   $('#dash-loader').show().delay(6100).fadeOut(300);
   setTimeout(function(){$( "#dialog-pic" ).dialog( "open" );$("#dialog-pic").   dialog('option', 'title', "Golf Course Review's");}, 6100);
}
//end for review view in dialogbox


//start for add review view in dialogbox
function golf_add_review(course_id)
{
  
	$.ajax({
	type:'post',
	data:'course_id='+course_id+'&submit=FALSE',
	url:'<?=base_url()?>golfcourse_detail/review_course/',
	success:function(data){
	$('#dialog-pic').html(''); 
	$('#dialog-pic').html(data); 
    }
    });
	
   $('#dash-loader').show().delay(6100).fadeOut(300);
   setTimeout(function(){$( "#dialog-pic" ).dialog( "open" );$("#dialog-pic").dialog('option', 'title', "Golf Course Add Review's");}, 6100);

}
//end for add review view in dialogbox




function golf_overview(course_id)
{
  	$.ajax({
	type:'post',
	data:'course_id='+course_id,
	url:'<?=base_url()?>golfcourse_detail/golf_detail_page/',
	success:function(data){
	$('#dialog-pic').html(''); 
	$('#dialog-pic').html(data); 
    }
    });
	
   $('#dash-loader').show().delay(6100).fadeOut(300);
   setTimeout(function(){$( "#dialog-pic" ).dialog( "open" );$("#dialog-pic").dialog('option', 'title', "Golf Course Overview");}, 6100);
}




</script>


<link href="<?=base_url()?>asserts/css/site_css/stylesheet.css" rel="stylesheet" type="text/css" />
<style>
.notifications .msg_item {
min-height: 60px;
}
.club_div3 p 
{line-height: 14px;}

.space
{ margin-left:13px;
}
</style>
<div id='content_header'>
	<div class='hdr-text'>Golf Courses Search</div>
</div>
<div id="content_wrapper" class="contacts">
    <div class="opt_box_wrapper">
	</div>
	 <div class="adv_search_results notifications">
	
	
	
	
	
	
	
	
	
	
	
	<div class="golf_outer space list_view">
          
 	 
<!--///////////////////////////-->



	



<?




     
	if(@$records=='not_empty')
	{
		$path=explode('dev',$imgpath);
		$total=count($result);
		//if record are more than single
		if($total>1)
		{ ?>
		<div class="list_view">
		<?	
		for($i=0;$i<$total;$i++)
			{
				
				//if city wise listing require
				if(@$city_wise=='yes')
				{
					$city_name=$result[$i]->cty;
					$null=strcmp($city,$city_name);
					
					if($null!=0)
					{
					   continue;
					}
				    $u++;
				}
				//if city wise listing require
				
				
				//if area wise listing require
				if(@$area_wise=='yes')
				{
					$area_name=$result[$i]->sAr;
					$null=strcmp(@$area_val,@$area_name);
					if($null!=0)
					{
					   continue;
					   
					}
					$u++;
				}
			    //end if area wise listing require
				
				
				
				//price filtration
				@$hid_filter=$this->session->userdata('hid_filter');
				if(@$hid_filter=='TRUE')
				{
					$flag=0;
					@$price_filtration=$this->session->userdata('price_filtration');
					foreach(@$price_filtration as $key=>$val)
					{
						if($val==0)
						{
						   $val=99999;
						}
						
						if($result[$i]->fPrc>=$key && $result[$i]->fPrc<=$val)
						{
						   $flag=1;
						}
					}
					if($flag==0)
					{
					   continue;
					}
					$u++;
				}
				//end price filtration
				
				
				
				$course_id=$result[$i]->id;
				$img_name=$result[$i]->img;
				if($img_name!='')
				$image_path=$path[1].'/'.$course_id.'/'.$img_name;
				else
				{
				  $base_url=base_url();
				  $base_url=str_replace('http://','',$base_url);
				  $image_path=$base_url.'asserts/images/no_image.jpeg';
				}
				echo '<div class="golf"><div class="golf_top"></div><div class="golf_rpt"><div class="golf_mid"><div class=" club_div1">';
/*href="'.base_url().'golfcourse_detail/golf_detail_page/'.$result[$i]->id.'"*/               
			    echo '<a href="'.base_url().'search_golfcourse/search_teetimes_two/'.$result[$i]->id.'"><h4>'.$result[$i]->nm.'</h4></a>';
				echo '<div class="club_div2"><img src="http://'.$image_path.'" height="65" width="85" alt="#" /></div>';
				
				
				
				
				/*$rating=$result[$i]->rating;
				$round=round($rating);
				for($k=1;$k<=$round;$k++){
				echo '*';
				}
				if($rating>$round){
				echo '^';
				}'.base_url().'golfcourse_detail/view_photo/'.$result[$i]->id.'*/
				//	base_url().'golfcourse_detail/all_review_listing/'.$result->id
				//'.base_url().'golfcourse_detail/golf_detail_page/'.$result[$i]->id.'
				
				echo '<div class="club_div3">';
				echo '<p><b>'.$result[$i]->cty.' , '.$result[$i]->st.'</b> '.$result[$i]->promo.'</p>';
                    
				echo '<ul>
                      <li class="li_first"><a href="#." onclick="golf_overview('.$result[$i]->id.')">Overview</a>|</li>
	
			  <li><a href="#."  onclick="golf_review('.$result[$i]->id.')">Reviews</a>|</li>
			 <li><a href="#." onclick="golf_photo('.$result[$i]->id.')">Photos</a></li>
                    </ul>
                    <div class="clr"></div>
                  </div>';
				  
				  echo '<div class="clr"></div></div>';
               
				
				echo '<div class="club_div4"><ul><li>Starting From</li>
                    <li class="second_li">'.$result[$i]->curr.number_format($result[$i]->fPrc, 2).'</li>';
				echo '<li><span>Earn up to 572 Point</span></li>';
				echo '<li><a href="'.base_url().'search_golfcourse/search_teetimes_two/'.$result[$i]->id.'">Search Tee Time</a></li></ul>
                  <div class="clr"></div>
                  </div>';
				  
				  
				  
				  echo '<div class="clr"></div>
                        </div></div>
						<div class="golf_bottom2">
						  <ul>
							<li><a href="#">» Share </a></li>
							<li><a href="#">+ Add to Favorites </a></li>
						  </ul>
						  <div class="clr"></div>
						</div>
						<div class="clr"></div>
					  </div>';
				?>
				
				
				
				
				
	
		<?		
			}
			
			?>  <div class="pagination"> <? echo @$paginglink;?> </div><?
		?>
		</div>
	
	<?	
		}//end if record are more than single
		//if record is single
		else if($total==1)
		{?>
		<?
			
			   
			if(is_object($total))
			{
			
			
			
			
			$course_id=$result->id;
			$img_name=$result->img;
			
			if($img_name!='')
			$image_path=$path[1].'/'.$course_id.'/'.$img_name;
			else
			{
			  $base_url=base_url();
			  $base_url=str_replace('http://','',$base_url);
			  $image_path=$base_url.'asserts/images/no_image.jpeg';
			}
			
			echo '<div class="golf"><div class="golf_top"></div><div class="golf_rpt"><div class="golf_mid"><div class=" club_div1">';
			echo '<a href="'.base_url().'search_golfcourse/search_teetimes_two/'.$result->id.'"><h4>'.$result->nm.'</h4></a>';
			echo '<div class="club_div2"><img src="http://'.$image_path.'" height="65" width="85" alt="#" /></div>';
			
			/*$rating=$result->rating;
			$round=round($rating);
			for($k=1;$k<=$round;$k++){
			echo '*';
			}
			if($rating>$round){
			echo '^';
			}*/
	//	base_url().'golfcourse_detail/all_review_listing/'.$result->id		
			echo '<div class="club_div3">';
		    echo '<p><b>'.$result->cty.' , '.$result->st.'</b> '.$result->promo.'</p>';
			echo '<ul>
                      <li class="li_first"><a href="'.base_url().'golfcourse_detail/golf_detail_page/'.$result->id.'">Overview</a>|</li>
		  
			  <li><a href="#."  onclick="golf_review('.$result->id.')">Reviews</a>|</li>
			  <li><a href="#." onclick="golf_photo('.$result->id.')">Photos</a></li>
                    </ul>
                    <div class="clr"></div>
                  </div>';
			 echo '<div class="clr"></div></div>';
			
			
			echo '<div class="club_div4"><ul><li>Starting From</li>
                    <li class="second_li">'.$result->curr.number_format($result->fPrc, 2).'</li>';
				echo '<li><span>Earn up to 572 Point</span></li>';;
			echo '<li><a href="'.base_url().'search_golfcourse/search_teetimes_two/'.$result->id.'">Search Tee Time</a></li></ul>
                  <div class="clr"></div>
                  </div>';
				  
				  
				  echo '<div class="clr"></div>
                        </div></div>
						<div class="golf_bottom2">
						  <ul>
							<li><a href="#">» Share </a></li>
							<li><a href="#">+ Add to Favorites </a></li>
						  </ul>
						  <div class="clr"></div>
						</div>
						<div class="clr"></div>
					  </div>';
			
		 
		}else
		{
		
		
		
		
		
		
		$course_id=$result[0]->id;
			$img_name=$result[0]->img;
			
			if($img_name!='')
			$image_path=$path[1].'/'.$course_id.'/'.$img_name;
			else
			{
			  $base_url=base_url();
			  $base_url=str_replace('http://','',$base_url);
			  $image_path=$base_url.'asserts/images/no_image.jpeg';
			}
			
			echo '<div class="golf"><div class="golf_top"></div><div class="golf_rpt"><div class="golf_mid"><div class=" club_div1">';
			echo '<a href="'.base_url().'search_golfcourse/search_teetimes_two/'.$result[0]->id.'"><h4>'.$result[0]->nm.'</h4></a>';
			echo '<div class="club_div2"><img src="http://'.$image_path.'" height="65" width="85" alt="#" /></div>';
			
			/*$rating=$result->rating;
			$round=round($rating);
			for($k=1;$k<=$round;$k++){
			echo '*';
			}
			if($rating>$round){
			echo '^';
			}*/
	//	base_url().'golfcourse_detail/all_review_listing/'.$result->id		
			echo '<div class="club_div3">';
		    echo '<p><b>'.$result[0]->cty.' , '.$result[0]->st.'</b> '.$result[0]->promo.'</p>';
			echo '<ul>
                      <li class="li_first"><a href="'.base_url().'golfcourse_detail/golf_detail_page/'.$result[0]->id.'">Overview</a>|</li>
		  
			  <li><a href="#."  onclick="golf_review('.$result[0]->id.')">Reviews</a>|</li>
			  <li><a href="#." onclick="golf_photo('.$result[0]->id.')">Photos</a></li>
                    </ul>
                    <div class="clr"></div>
                  </div>';
			 echo '<div class="clr"></div></div>';
			
			
			echo '<div class="club_div4"><ul><li>Starting From</li>
                    <li class="second_li">'.$result[0]->curr.number_format($result[0]->fPrc, 2).'</li>';
				echo '<li><span>Earn up to 572 Point</span></li>';;
			echo '<li><a href="'.base_url().'search_golfcourse/search_teetimes_two/'.$result[0]->id.'">Search Tee Time</a></li></ul>
                  <div class="clr"></div>
                  </div>';
				  
				  
				  echo '<div class="clr"></div>
                        </div></div>
						<div class="golf_bottom2">
						  <ul>
							<li><a href="#">» Share </a></li>
							<li><a href="#">+ Add to Favorites </a></li>
						  </ul>
						  <div class="clr"></div>
						</div>
						<div class="clr"></div>
					  </div>';
			
		 
		
		
		
		
		
		}
		
		
		
		
		 
		 }//end if record is single
		
		}//end of records not_empty if
		else
		{
			echo 'No Record Found.';
			//$this->session->set_userdata('no_record_found',1);
		}
		
   
   
  ?> 
   
   

 <div class="clr"></div>
        </div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</div>
	
	</div>
