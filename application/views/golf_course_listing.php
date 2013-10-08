<? $this->session->set_userdata('no_record_found','');?>



<div class="navigation_right"> </div>



  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

    <script type="text/javascript" src="<?=base_url()?>asserts/js/googlemap/gmap3.js"></script> 

    <style>

     .li_first{margin-left: 14px;!Important}

	 p{margin: 0;

    padding: 0 15px;line-height:14px;}

	

    </style>

	

	











<link type="text/css" href="<?=base_url()?>asserts/css/menu/menu.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url()?>asserts/css/menu/menu.js">

</script>

<style>

.navigation_right ul li {height:21px!important;}

</style>

<script>

function get_state()

{

   $.ajax({

   type:'post',

   url:'<?=base_url()?>teetime_golfcourse/dropdown_golfcorse/',

   success:function(data){

	  $('#hirarchy_golfcorse').html(data);

   }

   });

}



$(document).ready(function()

{

	get_state();

});









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





<div id="copyright"><a href="http://apycom.com/"></a></div>



<div id="photo_view"></div>

<style>

#hirarchy_golfcorse{margin: -22px 0 22px;!important}

</style>



<!--///////////////////////////-->

<div id="contents">

<div id="hirarchy_golfcorse"></div>



<?

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		if($state_id=='' || $country_id=='')

		{

			$country_id='USA';

			$state_id='CA';

		}

		

		//showing full name of state

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

	    $response = $client->Areas(array("Hdr"=>array("ResellerId"=>"WPA",

													"PartnerId"=>"",

													"SourceCd"=>"A",

													"Lang"=>"en",

													"UserIp"=>"66.147.244.227",

													"UserSessionId"=>"",

													"AccessKey"=>"",

													"Agent"=>"",

													"gsSource"=>"",

													"gsDebug"=>true),

									"Req"=>array("CountryId"=>$country_id,

													"RegionId"=>$state_id)));

	

	    $state_name = $response->AreasResult->Countries->Country->Regions->Region->nm;

		$this->session->set_userdata('my_golfcourse_heading',$state_name);

		//end showing full name of state

		?>



<? $this->load->view('golf_course_listing_left_menu');?>



	  

      <div id="content_right">

        <div class="tee_time">

          <div class="tee_time_top">

            <h3><?=@$state_name?> Golf Courses</h3>

          </div>

          <div class="course_time_mid">

            <div class="course_time_mid_left">

              

	



			<script>

			$(document).ready(function(){

			$("#my").addClass("hid");

			});

			

			function hide_show(vars)

			{

				if(vars=='map')

				{

				  $('.list_view').hide();

				  $("#my").removeClass("hid");

				}

				if(vars=='list')

				{

				  $('.list_view').show();

				  $("#my").addClass("hid");

				}

			}

			</script>

		  

			  <ul>

                <li><a href="#." onclick="hide_show('list')">List View</a></li>

                <!--<li><a href="#." onclick="hide_show('map')">Map View</a></li>-->

              </ul>

            </div>

            <div class="course_time_mid_right">

              <ul>

                <li>

                  <label>Within</label>

                </li>

                <li>

                  <div class="mile">

		<form method="post" action="<?=base_url()?>teetime_golfcourse/miles_distance">

                    <select name="miles">

<option value="5" <?php if(@$select_miles=='5'){?> selected="selected"<? } ?>>5 miles</option>

<option value="10" <?php if(@$select_miles=='10'){?> selected="selected"<? } ?>>10 miles</option>

<option value="25" <?php if(@$select_miles=='25'){?> selected="selected"<? } ?>>25 miles</option>

<option value="50" <?php if(@$select_miles=='50'){?> selected="selected"<? } ?>>50 miles</option>

<option value="100" <?php if(@$select_miles=='100'){?> selected="selected"<? } ?>>100 miles</option>

</select>

                  </div>

                </li>

                <li>

                  <label>of Postal Code</label>

                </li>

                <li>

                  <div class="mile3">

                    <input type="text" id="zipcode" name="zipcode" value="<?php echo @$select_zipcode?>"  />

                  </div>

                </li>

                <li class="last_li">

                  <div class="mile2"><input type="submit" value="Search" /></form></div>

                </li>

              </ul>

              <div class="clr"></div>

            </div>

            <div class="clr"></div>

          </div>

          <div class="tee_time_bottom">

            <div class="tee_time_bottom_date"> <a href="#">[+] Sport Courses</a> </div>

            

			

			

			<!--google map-->

			<div id="my" >

			<div class="mape_large">

			<div id="test1" class="gmap3"  ></div>

			</div>

			</div>

			<!--end google map-->

			

			

			

			

			<div class="tee_time_bottom_time list_view">

              <? 

			  if(@$records!='empty')

			  {

				if(@$last_no<@$total_no)

				{

				   @$last_no=@$last_no;

				} 

				else

				{

				   @$last_no=@$total_no;

				}

			  ?>

			  <div class="time_left"><label>Showing</label> <a href="#"> <?=@$first_no?> - <?=@$last_no?> of <?=@$total_no?></a> </div>

             <? }?> 

			  

			  <div class="time_right">

               

<ul class="list_view">

				 

				 <?php 

if(@$city_wise!='yes' && @$area_wise!='yes')

{

	if(@$select_miles!='' && @$select_zipcode!=''){ ?>

	 <h5>Sort By:</h5>

	<li>|<a href="<?php echo base_url()?>teetime_golfcourse/sorting_mile/alpha/<?php echo @$select_miles ;?>/<?php echo @$select_zipcode;?>">Alphabetical</a></li>

	<li>|<a href="<?php echo base_url()?>teetime_golfcourse/sorting_mile/price/<?php echo @$select_miles ;?>/<?php echo @$select_zipcode;?>">Price</a> </li>

	<li>|<a href="<?php echo base_url()?>teetime_golfcourse/sorting_mile/rating/<?php echo @$select_miles ;?>/<?php echo @$select_zipcode;?>">User Rating</a> </li>

	<li class="last_li">|<a href="<?php echo base_url()?>teetime_golfcourse/sorting_mile/favorite/<?php echo @$select_miles ;?>/<?php echo @$select_zipcode;?>">Favorite</a></li>

	<?php }else if(@$select_zipcode==''){ ?>

	

	<h5>Sort By:</h5>

	<li>|<a href="<?php echo base_url()?>teetime_golfcourse/sorting/alpha">Alphabetical</a></li>

	<li>|<a href="<?php echo base_url()?>teetime_golfcourse/sorting/price">Price</a> </li>

	<!--<li>|<a href="<?php echo base_url()?>teetime_golfcourse/sorting/rating">User Rating</a></li>-->

	<li class="last_li">|<a href="<?php echo base_url()?>teetime_golfcourse/sorting/favorite">Favorite</a></li>

	<?php }



}

else if(@$city_wise=='yes')

{?>

<h5>Sort By:</h5> 

<li>|<a href="<?php echo base_url()?>teetime_golfcourse/city_wise_sorting/alpha/<?=@$area_id?>/<?=@$city?>">Alphabetical</a> </li>

<li>|<a href="<?php echo base_url()?>teetime_golfcourse/city_wise_sorting/price/<?=@$area_id?>/<?=@$city?>">Price</a></li>

<li>|<a href="<?php echo base_url()?>teetime_golfcourse/city_wise_sorting/rating/<?=@$area_id?>/<?=@$city?>">User Rating</a></li>

<li class="last_li">|<a href="<?php echo base_url()?>teetime_golfcourse/city_wise_sorting/favorite/<?=@$area_id?>/<?=@$city?>">Favorite</a></li>

<? }

else if(@$area_wise=='yes')

{?>

<h5>Sort By:</h5> 

<li>|<a href="<?php echo base_url()?>teetime_golfcourse/area_wise_sorting/alpha/<?=@$area_val?>">Alphabetical</a> </li>

<li>|<a href="<?php echo base_url()?>teetime_golfcourse/area_wise_sorting/price/<?=@$area_val?>">Price</a></li>

<li>|<a href="<?php echo base_url()?>teetime_golfcourse/area_wise_sorting/rating/<?=@$area_val?>">User Rating</a></li>

<li class="last_li">|<a href="<?php echo base_url()?>teetime_golfcourse/area_wise_sorting/favorite/<?=@$area_val?>">Favorite</a></li>

<? }?>





				 

</ul>

                <div class="clr"></div>

              </div>

              <div class="clr"></div>

            </div>

            <div class="clr"></div>

          </div>

          <div class="clr"></div>

        </div>

        <div class="golf_outer space list_view">

          

 	 

<!--///////////////////////////-->







	







<?php

################################

#No this section is not working# 

################################

//if course id is available and get data from course_info function....

$u=0;

if(@$option=='second'){

if($course_listing->RetCd==0){

//if city wise listing require

if(@$city_wise=='yes')

{

	//echo $city;

	//print_r($course_listing->Course);

	//exit;

	$city_name=$course_listing->Course->cty;

	$null=strcmp($city,$city_name);

	if($null!=0)

	{

	continue;

	}

$u++;

}

//end if city wise listing require





//if area wise listing require

if(@$area_wise=='yes')

{

	$area_name=$course_listing->Course->sAr;

	$null=strcmp(@$area_val,@$area_name);

	if($null!=0)

	{

	   continue;

	}

	$u++;

}

//end if area wise listing require





echo '<div class="golf"><div class="golf_top"></div><div class="golf_rpt"><div class="golf_mid"><div class=" club_div1">';

$path=explode('dev',$course_listing->imgBase);

$course_id=$course_listing->Course->id;

$img_name=$course_listing->Course->Imgs->img[0];

$image_path=$path[1].'/'.$course_id.'/'.$img_name;

echo '<a href="'.base_url().'golfcourse_detail/golf_detail_page/'.$course_listing->Course->id.'"><h4>'.$course_listing->Course->nm.'</h4></a>';

echo '<div class="club_div2"><img src="http://'.$image_path.'" height="65" width="85" alt="#" /></div>';







/*$rating=$course_listing->Course->rating;

$round=round($rating);

for($i=1;$i<=$round;$i++){

echo '*';

}

if($rating>$round){

echo '^';

}

'.base_url().'golfcourse_detail/golf_detail_page/'.$course_listing->Course->id.'*/





echo '<div class="club_div3">';

echo '<p><b>'.$course_listing->Course->cty. ',' .$course_listing->Course->st.'</b>'.$course_listing->Course->shortPromo.'</p>';



		echo '<ul>

			  <li class="li_first"><a href="#." onclick="golf_overview('.$course_listing->Course->id.')">Overview</a>|</li>

			  <li><a href="'.base_url().'golfcourse_detail/all_review_listing/'.$course_listing->Course->id.'">Reviews</a>|</li>

			  <li><a href="'.base_url().'golfcourse_detail/view_photo/'.$course_listing->Course->id.'">Photos</a></li>

			</ul>

			<div class="clr"></div>

		  </div>';

				  

		echo '<div class="clr"></div></div>';



echo '<div class="club_div4"><ul><li>Starting From</li>

                    <li class="second_li">'.$course_listing->Course->curr.number_format($course_listing->Course->fromPrice, 2).'</li>';

echo '<li><span>Earn up to 572 Point</span></li>';

		echo '<li><a href="'.base_url().'search_golfcourse/search_teetimes_two/'.$course_listing->Course->id.'">Search Tee Time</a></li></ul>';



  echo '<div class="clr"></div>

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







$id=$course_listing->Course->id;

$nm=$course_listing->Course->nm;

$lat=$course_listing->Course->lat;

$lon=$course_listing->Course->lon;

$shortPromo=$course_listing->Course->shortPromo;





}else{

echo 'No Record Found.';

}





?>





<!--

////////////////////////////////////////////////////////////////////////////////////////

//show Map View if course id is available and get data from course_info function////////

////////////////////////////////////////////////////////////////////////////////////////



	<script type="text/javascript">

      $(function(){

      

        $('#test1')

          .gmap3(

          { action:'init',

            options:{

              center:['<?=$lat?>','<?=$lon?>'],

              zoom: 5

            }

          },

          { action: 'addMarkers',

		   markers:[

		   <?php 

			 $shortPromo=addslashes($shortPromo);

			 $shortPromo = preg_replace("/[\r\n]+/","", $shortPromo);

			  ?>

			  {lat:'<?=$lat?>', lng:'<?=$lon?>', data:'<a href="<?=base_url()?>golfcourse_detail/golf_detail_page/<?=$id?>"><?=$nm?></a><br><?=$shortPromo?>'},

			],

            marker:{

              options:{

                draggable: false

              },

              events:{

                click: function(marker, event, data){

                  var map = $(this).gmap3('get'),

                      infowindow = $(this).gmap3({action:'get', name:'infowindow'});

                  if (infowindow){

                    infowindow.open(map, marker);

                    infowindow.setContent(data);

                  } else {

                    $(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});

                  }

                },

               

              }

            }

          }

        );

      });

    </script>

	



////////////////////////////////////////////////////////////////////////////////////////

//end show Map View if course id is available and get data from course_info function////

////////////////////////////////////////////////////////////////////////////////////////

-->



<?

}//end if course id is available and get data from course_info function

####################################

#end No this section is not working# 

####################################







if(@$option=='first'){

     

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

				

				

				

				

				<!--

	/////////////////////////////////////////////////

	//show Map View if record are more than single///

	/////////////////////////////////////////////////



	<script type="text/javascript">

      $(function(){

      

        $('#test1')

          .gmap3(

          { action:'init',

            options:{

              <? for($g=0;$g<count($result);$g++)

		         {

				    if($result[$g]->lat==0 || $result[$g]->lon==0)

					{

				      continue;

				    }?>

			  center:['<?=$result[$g]->lat?>','<?=$result[$g]->lon?>'],

              <? break;

			     }?>

			  zoom: 5

            }

          },

          { action: 'addMarkers',

		   markers:[

		   <?php 

		   for($g=0;$g<count($result);$g++)

		   {

			 if($result[$g]->lat==0 || $result[$g]->lon==0)

			 {

			   continue;

			 }

			 $promo=addslashes($result[$g]->promo);

			 $promo = preg_replace("/[\r\n]+/","", $promo);

			  ?>

			  {lat:'<?=$result[$g]->lat?>', lng:'<?=$result[$g]->lon?>', data:'<a href="<?=base_url()?>golfcourse_detail/golf_detail_page/<?=$result[$g]->id?>"><?=str_replace("'"," ",$result[$g]->nm)?></a><br><?=str_replace("'"," ",$promo)?>'},

	 <?php }?>

			],

            marker:{

              options:{

                draggable: false,

				icon:'<?=base_url()?>asserts/images/icon_green.png'

              },

              events:{

                click: function(marker, event, data){

                  var map = $(this).gmap3('get'),

                      infowindow = $(this).gmap3({action:'get', name:'infowindow'});

                  if (infowindow){

                    infowindow.open(map, marker);

                    infowindow.setContent(data);

                  } else {

                    $(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});

                  }

                },

               

              }

            }

          }

        );

      });

    </script>

	

	

	/////////////////////////////////////////////////////

	//end show Map View if record are more than single///

	/////////////////////////////////////////////////////

	-->

		<?		

			}

			if(@$city_wise=='no')

			{

			?>  <div class="pagination"> <? echo @$paginglink;?> </div><?

			}

		?>

		</div>

	

	<?	

		}//end if record are more than single

		//if record is single

		else if($total==1)

		{?>

		<?	

			//if city wise listing require

			if(@$city_wise=='yes')

			{

				$city_name=$result->cty;

				$null=strcmp($city,$city_name);

				if($null!=0)

				{

				   continue;

				}

			    $u++;

			}

			

			//end if city wise listing require

			

			//if area wise listing require

			if(@$area_wise=='yes')

			{

				$area_name=$result->sAr;

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

						

						if($result->fPrc>=$key && $result->fPrc<=$val)

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

                      <li class="li_first"><a href="#." onclick="golf_overview('.$result->id.')">Overview</a>|</li>

		  

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

			

		 ?>

		 

		 <!--

		 //////////////////////////////////////

		 //show Map View if record is single///

		 //////////////////////////////////////

		 

	<script type="text/javascript">

      $(function(){

      

        $('#test1')

          .gmap3(

          { action:'init',

            options:{

              center:['<?=$result->lat?>','<?=$result->lon?>'],

              zoom: 5

            }

          },

          { action: 'addMarkers',

		   markers:[

		   <?php 

			 $promo=addslashes($result->promo);

			 $promo = preg_replace("/[\r\n]+/","", $promo);

			  ?>

			  {lat:'<?=$result->lat?>', lng:'<?=$result->lon?>', data:'<a href="<?=base_url()?>golfcourse_detail/golf_detail_page/<?=$result->id?>"><?=$result->nm?></a><br><?=$promo?>'},

			],

            marker:{

              options:{

                draggable: false,

				icon:'<?=base_url()?>asserts/images/icon_green.png'

              },

              events:{

                click: function(marker, event, data){

                  var map = $(this).gmap3('get'),

                      infowindow = $(this).gmap3({action:'get', name:'infowindow'});

                  if (infowindow){

                    infowindow.open(map, marker);

                    infowindow.setContent(data);

                  } else {

                    $(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});

                  }

                },

               

              }

            }

          }

        );

      });

    </script>

	

	//////////////////////////////////////////

	//end show Map View if record is single///

	//////////////////////////////////////////

	-->	 

		<? 

		 }//end if record is single

		

		}//end of records not_empty if

		else

		{

			echo 'No Record Found.';

			$this->session->set_userdata('no_record_found',1);

		}

		

   }//end of option first if

   

    if(@$city_wise=='yes' || @$area_wise=='yes' || @$hid_filter=='TRUE')

	{

		if($u==0)

		{

		  echo 'No Record Found.';

		  $this->session->set_userdata('no_record_found',1);

		}

	}

   

  ?> 

   

   



 <div class="clr"></div>

        </div>

        <div class="clr"></div>

      </div>

      <div class="clr"></div>

    </div>

	</div>

	

	