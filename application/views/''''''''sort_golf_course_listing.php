<form method="post" action="<?=base_url()?>teetime_golfcourse/miles_distance">
<table align="right"><tr><td>
<td>
Within
</td>
<td>
<select name="miles">
<option value="5" <?php if(@$select_miles=='5'){?> selected="selected"<? } ?>>5 miles</option>
<option value="10" <?php if(@$select_miles=='10'){?> selected="selected"<? } ?>>10 miles</option>
<option value="25" <?php if(@$select_miles=='25'){?> selected="selected"<? } ?>>25 miles</option>
<option value="50" <?php if(@$select_miles=='50'){?> selected="selected"<? } ?>>50 miles</option>
<option value="100" <?php if(@$select_miles=='100'){?> selected="selected"<? } ?>>100 miles</option>
</select>
</td>
<td>
of Zipcode
</td>
<td>
<input type="text" id="zipcode" name="zipcode" value="<?php echo @$select_zipcode?>"  />
</td>
<td>
<input type="submit" value="Submit"    />
</td></tr></table><br /><br />
</form>








<table>
<tr>
<td>
<?php if(@$select_miles!='' && @$select_zipcode!=''){ ?>
Sort By: 
<a href="<?php echo base_url()?>teetime_golfcourse/sorting_mile/alpha/<?php echo @$select_miles ;?>/<?php echo @$select_zipcode;?>">Alphabetical</a> |
<a href="<?php echo base_url()?>teetime_golfcourse/sorting_mile/price/<?php echo @$select_miles ;?>/<?php echo @$select_zipcode;?>">Price</a> |
<a href="<?php echo base_url()?>teetime_golfcourse/sorting_mile/rating/<?php echo @$select_miles ;?>/<?php echo @$select_zipcode;?>">User Rating</a> |
<a href="<?php echo base_url()?>teetime_golfcourse/sorting_mile/favorite/<?php echo @$select_miles ;?>/<?php echo @$select_zipcode;?>">Favorite</a>
<?php }else{ ?>

Sort By: 
<a href="<?php echo base_url()?>teetime_golfcourse/sorting/alpha">Alphabetical</a> |
<a href="<?php echo base_url()?>teetime_golfcourse/sorting/price">Price</a> |
<a href="<?php echo base_url()?>teetime_golfcourse/sorting/rating">User Rating</a> |
<a href="<?php echo base_url()?>teetime_golfcourse/sorting/favorite">Favorite</a>
<?php }?>
</td>
</tr>
</table>









<?php
 	  $path=explode('dev',$imgpath);
	  foreach($save_index as $key=>$val)
	  {
			$course_id=$result[$key]->id;
			$img_name=$result[$key]->img;
			$image_path=$path[1].'/'.$course_id.'/'.$img_name;
			echo '<table><tr><td>';
			echo '<img src="http://'.$image_path.'" height="65" width="85" alt="#" />';
			echo '</td><td>';
			echo '<strong>'.$result[$key]->nm.'</strong>';
			
			$rating=$result[$key]->rating;
			$round=round($rating);
			for($k=1;$k<=$round;$k++){
			echo '*';
			}
			if($rating>$round){
			echo '^';
			}
			echo '<br>';
			echo '<strong>'.$result[$key]->cty.' , '.$result[$key]->st.'</strong> &nbsp;&nbsp;'.$result[$key]->promo;
			echo '</td><td>';
			
			echo 'Starting From<br>'.$result[$key]->curr.$result[$key]->fPrc;
			echo '</td><tr></table>';
	  }

?>