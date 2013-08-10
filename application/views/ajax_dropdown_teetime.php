<?php 
$country_id=$this->session->userdata('country_id');
$state_id=$this->session->userdata('state_id');
$area_id=$this->session->userdata('area_id');
$course_id=$this->session->userdata('course_id');
?>
		
			<div id="menu22" class="navigation_right">
            <ul class="menu">
			
			<?php //country's state listing?>
			<?php if($country_id!=''){?>
			<li class="eur1">
            <a href="<?=base_url()?>" class="parent"><span><?php echo $country_id?></span></a>
				
				<ul>
				<?php 
				//$first=$response->AreasResult->Countries->Country->Regions->Region;	
				$first=$response;
				$total=count($first);
				for($i=0;$i<$total;$i++)
				{?>
					<li><a href="<?php echo base_url()?>teetime_golfcourse/state/teetime/<?php echo $country_id?>/<?php echo $first[$i]->id;?>" class="parent"><span><?php echo $first[$i]->nm;?></span></a>
					<? 
					//$second=$first[$i]->Areas->Area;
					$second=$this->common_model->select_where('id,nm','gama_area',array('s_id'=>$first[$i]->id));
					$second=$second->result();
					$total2=count($second);
					if($total2==1)
					{?>
						<ul>
						<li><a href="<?php echo base_url()?>teetime_golfcourse/area/teetime/<?php echo $country_id?>/<?php echo $first[$i]->id;?>/<?php echo $second[0]->id;?>" ><span><?php echo $second[0]->nm;?></span></a></li>
						</ul>	
					<?php
					}
					else if($total2>1)
					{	?>
						<ul>
						<?php
						for($k=0;$k<$total2;$k++)
						{ ?>
						<li><a href="<?php echo base_url()?>teetime_golfcourse/area/teetime/<?php echo $country_id?>/<?php echo $first[$i]->id;?>/<?php echo $second[$k]->id;?>" ><span><?php echo $second[$k]->nm;?></span></a></li>
						<?php 
						}?>
						</ul>
					<?php 
					}?>
					</li>
		  <?php 
		  }?>
				</ul>
		  </li>
		<?php }//end country's state listing ?>
		
		
		<?php //state Area's listing?>
		<?php if($country_id!='' && $state_id!=''){?>
		<li class="eur2">
		<a href="<?php echo base_url()?>teetime_golfcourse/state/teetime/<?php echo $country_id?>/<?php echo $state_id;?>" class="parent"><span><?php echo $state_id.' Golf Courses' ;?></span></a>
		
		<?php 
		//$first=$response->AreasResult->Countries->Country->Regions->Region;
		$first=$this->common_model->select_where('id,nm','gama_area',array('s_id'=>$state_id));
		$first=$first->result();
		
		//for($u=0;$u<count($first);$u++)
		//{
			/*if($first[$u]->id==$state_id)
			{
			   $second=$first[$u]->Areas->Area;
			}else{
			continue;
			}*/?>
			<ul>
			<?php 
			
			$count=count($first);
			
			//if record is single
			if($count==1)
			{?>
			<li>
			<a href="<?php echo base_url()?>teetime_golfcourse/area/teetime/<?php echo $country_id?>/<?php echo $state_id;?>/<?php echo $first[0]->id; ?>"><span><?php echo $first[0]->nm;?></span></a></li>
		<?  }//end if record is single
			
			//if record is more than single
			if($count>1)
			{
				for($s=0;$s<$count;$s++)
				{?>
				<li>
				<a href="<?php echo base_url()?>teetime_golfcourse/area/teetime/<?php echo $country_id?>/<?php echo $state_id;?>/<?php echo $first[$s]->id; ?>"><span><?php echo $first[$s]->nm;?></span></a>
					<!--work on it-->
					<!--<ul>
					<li><a href="#">Hard Drives</a></li>
					<li><a href="#">Monitors</a></li>
					<li><a href="#">Speakers</a></li>
					<li><a href="#">Random Equipment</a></li>
					</ul>-->
				</li>
				<?php 
				 }
			}//end if record is more than single 
		 //}?>
			</ul>
        </li>
		<? }//end state Area's listing?>
		 
		 
		 
		 <?php //area's golf courses listing?>
		 <?php if($country_id!='' && $state_id!='' && $area_id!=''){?>
		 <li class="eur3">
		 <a href="<?php echo base_url()?>teetime_golfcourse/area/teetime/<?php echo $country_id?>/<?php echo $state_id;?>/<?php echo  $area_id; ?>" class="parent"><span><?php echo  $area_id.' Golf Courses' ;?></span></a>
			
			<?php if($response1->CourseListResult->RetCd==0){?>
			<ul>
				<?php
				$golf=$response1->CourseListResult->Courses->clCourse;
				
				$if_golf=count($golf);
				
				//if record is single
				if($if_golf==1)
				{?>
				<li><a href="<?php echo base_url()?>search_golfcourse/search_teetimes_two/<?php echo $golf->id?>"><span><?php echo $golf->nm ?></span></a></li>
			<?	}//end if record is single
				
				//if records is more than single
				if($if_golf>1)
				{
					for($m=0;$m<count($golf);$m++)
					{?>
					   <li><a href="<?php echo base_url()?>search_golfcourse/search_teetimes_two/<?php echo $golf[$m]->id?>"><span><?php echo substr($golf[$m]->nm,0,25);  ?></span></a></li>
					<?php 
					}
				}//end if records is more than single
				?>
			</ul>
			<?php }else{} ?>
		</li>
		<?php }//end area's golf courses listing?>
		
		
		<?php //golf course name?>
		<?php if($course_id!=''){?>
		<li class="eur4">
			<?php 
			$course=$response2->CourseInfoResult->Course;
			$name=$course->nm;
			$id=$course->id;
			?>
			<a href="<?php echo base_url()?>search_golfcourse/search_teetimes_two/<?php echo $id?>" class="parent"><span><?php echo  substr($name,0,25) ;?></span></a>
		</li>
		<?php }//end golf course name?>
		
		
		</ul>
		</div>
      <div id="copyright"><a href="http://apycom.com/"></a></div>	 