<!--menu of country state area, golf.-->
<link type="text/css" href="<?=base_url()?>asserts/css/menu/menu.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>asserts/js/jquery-1.8.1.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/css/menu/menu.js"></script>
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
</script>

<div id="hirarchy_golfcorse">
</div>
<div id="copyright"><a href="http://apycom.com/"></a></div>
<!--end menu of country state area, golf.-->





<!--this is the header of this detail page.-->

<script>

function hide_show(para)
{
	if(para=='overview')
	{
		$('#golf_detail_review').hide();
		$('#golf_detail_photo').hide();
		$('#golf_detail').show();
	}
	
	if(para=='photo')
	{
		$('#golf_detail').hide();
		$('#golf_detail_review').hide();
		$('#golf_detail_photo').show();
	}
	
	
	if(para=='review')
	{
	  $('#golf_detail').hide();
	  $('#golf_detail_photo').hide();
	  $('#golf_detail_review').show();
	}


}

</script>


<table>
<tr>
<td>
<strong><?php echo $result->nm;?></strong>

<?php 
$html_star='';
$total=$result->rating; 
$round=round($total);
for($k=1;$k<=$round;$k++)
{
$html_star.='*';
}
if($total>$round)
{
$html_star.='^';
}
echo $html_star;
?></td>
</tr>


<tr>
<td>
<!--Images view-->
<div id="panel">
		<?php 
		if(isset($result->Imgs))
		{
			$images=$result->Imgs->img;
			if($images>1)
			{
				for($i=0;$i<1;$i++)
				{
					echo '<img id="largeImage"  width="200" height="150" alt="#" src="http://xml.golfswitch.com/img/course/'.@$result->id.'/'.@$images[$i].'">';
				}
			}else{
				   echo '<img id="largeImage"  width="200" height="150" alt="#" src="http://xml.golfswitch.com/img/course/'.@$result->id.'/'.@$images.'">';    
				 }
		}
		else
		{
		echo '<img  width="200" height="150" alt="#" src="'.base_url().'asserts/images/no_image.jpeg"> &nbsp;';
		}
		?>
	</div>
	<div id="thumbs">
		<?php 
		if(isset($result->Imgs))
		{
			$images=$result->Imgs->img;
			if($images>1)
			{
				for($i=0;$i<count($images);$i++)
				{
				echo '<img  width="45" height="35" alt="#" src="http://xml.golfswitch.com/img/course/'.@$result->id.'/'.@$images[$i].'"> &nbsp;';
				}
			}else{
				   echo '<img id="largeImage"  width="45" height="35" alt="#" src="http://xml.golfswitch.com/img/course/'.@$result->id.'/'.@$images.'">';    
				 }
		}
			?>
	</div>

<script>
$('#thumbs').delegate('img','click', function(){
	$('#largeImage').attr('src',$(this).attr('src'));
});
</script>
<!--end Images view-->

<?php $num=$result2->num_rows();?>
<?php echo @$result->nm;?><br />
<?php echo @$result->addr1;?><br />
<?php echo @$result->cty .', '.@$result->st.' '.@$result->zip.' '.@$result->cou;?><br />
<?php echo @$html_star.' ('.@$num.' member review )' ; ?>
</td>
</tr>


<tr>
<td>
<br /><br />
<a href="#." onclick="hide_show('overview')"><strong>Overview</strong></a> |
<a href="#." onclick="hide_show('review')"><strong>Review</strong></a> | 
<a href="#." onclick="hide_show('photo')"><strong>Photos</strong></a> |
<br /><br />
</td>
</tr>
</table>
<!--end of this is the header of this detail page.-->




<?





$curPageURL=$curPageURL;
$lat=$result->lat;
$lon=$result->lon;

$nm=$result->nm;
$nm=str_replace("'","\'",$nm);

$shortPromo=$result->shortPromo;
$shortPromo=str_replace("'","\'",@$shortPromo);


?>



<!--google map show on this div-->
<div style="float:right">
 <!--<script type="text/javascript" src="../jquery/jquery-1.4.4.min.js"></script>   -->    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url()?>asserts/js/googlemap/gmap3.js"></script> 
    <style>
      body{
        text-align:center;
      }
      .gmap3{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        width: 400px;
        height: 200px;
      }
    </style>
    
    
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
              {lat:'<?=$lat?>', lng:'<?=$lon?>', data:'<a href="<?=$curPageURL?>"><?=$nm?></a><br><?=$shortPromo?>'},
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
	<div id="test1" class="gmap3"></div>
</div>
<!--end google map show on this div-->







<!--after clicking on overview link this div show
this is the detail page-->
<div id="golf_detail">
<table>
<tr>
<td >
<strong>Overview of <?php echo @$result->nm;?></strong><br />
<?php echo @$result->promo;?>
</td>
</tr>

<tr>
<td>
<strong>Amenities</strong><br />
<?php echo @$result->services; ?>
</td>
</tr>
</table>
</div>
<!--end of after clicking on overview link this div show
this is the detail page-->





<!--after clicking on photo link this div show-->
<div id="golf_detail_photo" style="display:none">

	<script type="text/javascript" src="<?php echo base_url();?>asserts/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asserts/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asserts/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url();?>asserts/js/fancybox/style.css" />
	
	<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
		});
	</script>

<strong>Photo of <?php echo @$result->nm;?></strong><br /><br />
<table><tr>
<td>
<strong>PROFESSIONAL COURSE PHOTOS</strong><br />		
		<?php
		if(isset($result->Imgs))
		{ 
			$images=$result->Imgs->img;
			$k=0;
			for($j=0;$j<count($images);$j++)
			{
				$k++;
				echo '<a rel="example_group" href="http://xml.golfswitch.com/img/course/'.$result->id.'/'.@$images[$j].'"><img   width="75" height="60" alt="#" src="http://xml.golfswitch.com/img/course/'.$result->id.'/'.@$images[$j].'">&nbsp;&nbsp;</a>';
				
				if($k==3)
				{
					echo '<br>';
					$k=0;
				}
			}
		}
		else
		{
		echo '<img  width="200" height="150" alt="#" src="'.base_url().'images/no_image.jpeg"> &nbsp;';
		}
		?>
</td>
<td>
&nbsp;&nbsp;&nbsp;&nbsp;
<strong>USER COURSE PHOTOS</strong><br />&nbsp;&nbsp;&nbsp;&nbsp;		
		<?php 
		foreach($result1->result() as $row1)
		{
			echo '<a rel="example_group" href="'.base_url().'upload_img/user_golf_course/'.$row1->gama_golfcourse_img.'"><img rel="example_group" width="75" height="60" alt="#" src="'.base_url().'upload_img/user_golf_course/'.$row1->gama_golfcourse_img.'"></a>&nbsp;&nbsp;';
			
			if($k==3)
			{
			echo '<br>';
			$k=0;
			}
		}?>
</td>
</tr>

<tr>
<td>
<br /><br /><br />
<a href="<?php echo base_url();?>golfcourse_detail/view_photo/<?php echo $result->id;?>">See All Photo</a>
<a href="<?php echo base_url()?>golfcourse_detail/upload_photo">Upload Photo</a>
</td>
</tr>
</table>		
		
		
</div>
<!--end of this after clicking on photo link this div show-->








<!--after click on review show this div-->
<div id="golf_detail_review" style="display:none">


<table>
<tr>
<td>

<strong>Review of <?php echo $result->nm;?></strong>
<?php 
$html_star='';
$total=$result->rating; 
$round=round($total);
for($k=1;$k<=$round;$k++)
{
$html_star.='*';
}
if($total>$round)
{
$html_star.='^';
}
echo $html_star;
?>
<br />



<?php 


if($num>0)
{
foreach($result2->result() as $row2){?>
<img src="<?php echo base_url();?>" height="100px" width="100px" alt="#" />





<?php

$review_rating_condition=$row2->review_rating_condition;
$review_rating_facilities=$row2->review_rating_facilities;
$review_rating_all=$row2->review_rating_all;
$condition='';
$facilities='';
$all='';
for($f=1;$f<=$review_rating_condition;$f++)
{
$condition.='*';
}

for($f=1;$f<=$review_rating_facilities;$f++)
{
$facilities.='*';
}

for($f=1;$f<=$review_rating_all;$f++)
{
$all.='*';
}


echo '<strong>'.$row2->review_title.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
echo 'Course: '.$condition.'<br />';
 
$user_info=$this->common_model->select_where('user_name','gama_user',array('user_id'=>$row2->user_id));
$user_info=$user_info->row(); 
$user_name=$user_info->user_name;
echo 'Reviewed by: <strong>'.$user_name.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
echo 'Service: '.$facilities.'<br />';



echo date('l,F j,Y',$row2->dates).'&nbsp;&nbsp;&nbsp;&nbsp;';
echo 'Overall: '.$all.'<br />';

echo $row2->review_coment.'<br /><br />';
echo '.......<br><br>';

}
}
else
{

echo 'No review Found.';
}
?>




</td>
</tr>
</table>

<?php if($num>0){ ?>
<a href="<?php echo base_url();?>golfcourse_detail/all_review_listing/<?php echo $result->id;?>">See All Reviews</a>
<?php }?>

<a href="<?php echo base_url();?>golfcourse_detail/review_course/<?php echo $result->id;?>">Review this Course</a>



</div>
<!--end after click on review show this div-->