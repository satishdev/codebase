<script type="text/javascript" src="<?php echo base_url('js/jquery.lavalamp.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.easing.min.js') ?>"></script>
<script type="text/javascript">
	var active_tab = <?php echo $active_tab; ?>;
	$(function(){
		$('#main_menu > li:eq('+active_tab+')').addClass('active');
	});
</script>
<!--<script type="text/javascript">
	$(document).ready(function(){
		$("a#search_filter_type").click(function(){
			$("#user_type_selector_options").toggle();
		});
	});
</script>-->

<!--<div id="menu_wrap">
    <div class="menu_bar"> -->
<div class="menu-bg">
	<div class="menu ca">
        <!-- Admin SET -->
        <?php if(isset($this->userType) && $this->userType==1){ ?>
            <div class="menu_item fl">
                <a class="menu_link" href="<?php echo site_url('cp'); ?>">Home</a>
            </div>
        <?php } if(isset($this->userType) && $this->userType==2){ ?>



				<div class="menu_left">
					<ul>
						<li><a class="item" href="<?php echo site_url('players'); ?>">Home456</a></li>
						<li><a class="item" href="<?php echo site_url('players/profile'); ?>">Profile</a>
							<ul>
								<li><a class="item" href="<?php echo site_url('players/profile'); ?>">Manage Profile</a></li>
							   <!-- <li><a class="item" href="#">sRanking</a></li>
								<li><a class="item" href="#">Vote For Me</a></li>
								<li><a class="item" href="#">Recommendation</a></li>-->
							</ul>
						</li>

						<li><a class="item" href="<?php echo site_url('cb/allclubs'); ?>">Golf Courses</a>
							<ul>
								<!--<li><a class="item" href="<?php echo site_url('cb/allclubs'); ?>">Join Golf Courses</a></li>-->
								<li><a class="item" href="<?=base_url()?>teetime_golfcourse/golf_course/">Golf Courses</a></li>
							</ul>
						</li>
						<li><a class="item" href="#">Tee Times</a>
							<ul>
								<li><a class="item" href="<?=base_url()?>search_golfcourse/teetimes/">Available Tee Times</a></li>
								<li><a class="item" href="<?=base_url()?>reserve_golfcourse/my_booking_history">My Booking History</a></li>
							</ul>
						</li>
         			</ul>





				</div>






        <?php } if(isset($this->userType) && $this->userType==3){ ?>

		<div class="menu_left">
			<ul>
				<li><a class="item" href="<?php echo site_url('clubs'); ?>">Home</a></li>
				<li><a class="item" href="<?php echo site_url('clubs/add_courts'); ?>">Tee Times</a>
					<ul class='children'>
						<li><a class="item" href="<?php echo site_url('clubs/add_courts'); ?>">Add Tee Times</a></li>
						<li><a class="item" href="<?php echo site_url('clubs/list_courts'); ?>">View Tee Times</a></li>
					</ul>
				</li>
				<li><a class="item" href="<?php echo site_url('clubs/club_users'); ?>">Golf Courses</a>
					<ul class='children'>
						<li><a class="item" href="<?php echo site_url('clubs/club_users'); ?>">Golf Courses Users</a></li>
					</ul>
				</li>
			</ul>
			<div class="clr"></div>
		</div>




        <?php } if(!isset($this->userType) || empty($this->userType)){ ?>
        <div class="menu_left">
			<ul>
				<li><a class="active" href="<?php echo site_url('home'); ?>">Home</a></li>
				<li><a href="<?php echo site_url('login'); ?>">Sign In</a></li>
			</ul>
			<div class="clr"></div>
		</div>

        <?php } ?>

        <!--        MENU-BAR LINKS END      -->


        <?php if(isset($this->userType) || !empty($this->userType)){ ?>



        <div id="search_menu">

        <div class="menu_item fr">

		<?php


		/*if($this->uri->segment(1,0)=='teams')

				$url='teams/advanceteams';

				else

				$url='players/advanceplayers';*/

		?>
<?php // echo site_url($url);?>
            <a href="#." onclick="check_adv_redirect()" class="menu_link adv_search">Advanced</a>



        </div>

        <div class="menu_item fr">

		<?php

		if($this->uri->segment(1,0)=='teams'){

			$form_url=site_url('teams/allteams');

			$form_key=3;

		}else if($this->uri->segment(1,0)=='cb'){

			$form_url=site_url('cb/allclubs');

			$form_key=1;

		}else{

			$form_url=site_url('players/allplayers');

			$form_key=0;

		}

		    $form_url='';
			$form_key='';
		    $user_drop=array('Golf Courses','Tee Times');
			/*if(strcmp($this->uri->segment(2,0),'allplayers')==0 || strcmp($this->uri->segment(2,0),'advanceplayers')==0)
			{
			$form_key=0;
			$form_url=base_url().'players/allplayers';
			} */
			if(strcmp($this->uri->segment(2,0),'searchgolfcourse')==0 || strcmp($this->uri->segment(2,0),'advgolfcourses')==0 )
			{
			$form_key=0;
			$form_url=base_url().'players/searchgolfcourse';
			}
			else if(strcmp($this->uri->segment(2,0),'advteetimes')==0 || $this->uri->segment(2,0)==0 || strcmp($this->uri->segment(2,0),'searchteetimes')==0)
			{
			$form_key=1;
			$form_url=base_url().'players/searchteetimes';
			}
			/*else
			{
			$form_key=3;
			$form_url=base_url().'teams/allteams';
			}*/

		?>

<style type="text/css">

#results {
	border: 1px solid #BFBFBF;
	display: none;
	background-color:#FFFFFF;
    height: auto;
    margin-top: 24px;
    min-height: 101px;
    width: 212px;
    z-index: 1000;
	position: absolute;
}

#results li:hover{ background-color:#999999;}

</style>


<!--<form name="srch" id="srch" action="<?php  //echo $form_url;?>" method="post">-->
      <form name="srch" id="srch" action="<?=$form_url?>" method="post">

            <a class="menu_link">
			<input type="text" id="serchKey" placeholder="Search..." class="menu_search text" name="serchKey" onkeyup="auto_complete()" value="<?php if($this->db_session->userdata('pserchKey'))echo $this->db_session->userdata('pserchKey');else echo @$serchKey;?>"/>
			<input type="submit" value="" class="search_button"/></a>
            <div id="results"></div>
			</form>

        </div>

        <div class="menu_item fr men_left">

        	<?php //$user_drop=array('Players','Sponsors','Trainers','Tournaments','Golf Courses','Tee Times','Teams');


			 ?>

            <a id="search_filter_type" class="menu_link" href="#"><div class='u_type_wrap'><div class="user_type_selector"><?php echo $user_drop[$form_key]; ?></div></div></a>

           	<!--<input type="hidden" value="1" name="search_type_id" id="search_type_id" />-->



            <div id="user_type_selector_options" class="sub_menu_bar small_sub_menu">

                <?php foreach($user_drop as $k=>$v){ ?>

                	<div class="menu_item"><a  class="menu_link" onclick="check_adv('<?php echo $k?>')" rel="<?php echo $k; ?>"><?php echo $v; ?></a></div>

                <?php } ?>

                <div class="clear"></div>

            </div>

        </div>

        </div>

        <?php } ?>




		<div class="clr"></div>
	</div>
</div>
		<input type="hidden" value="<?=@$form_key?>" id="adv_submit" />
		<script type="text/javascript">
		function check_adv_redirect()
		{
			var para=$('#adv_submit').val();
			/*if(para==0)
			{
			   window.location = "<?=base_url()?>players/advanceplayers";
			}*/
			if(para==0)
			{
			   window.location = "<?=base_url()?>players/advgolfcourses";
			}
			if(para==1)
			{
			   window.location = "<?=base_url()?>players/advteetimes";
			}

		}

		function check_adv(para)
		{
		   $('#adv_submit').val(para);

			if(para==0)
			{
			   $("#srch").attr('action','<?=base_url()?>players/searchgolfcourse');
			}
			if(para==1)
			{
			   $("#srch").attr('action','<?=base_url()?>players/searchteetimes');
			}

		}





		function auto_complete()
		{
		  var search_me=$('#serchKey').val();
		  $.ajax({
		  type:'post',
		  data:'search_me='+search_me,
		  url:'<?=base_url()?>players/golfcourses_name_auto_complete',
		  success:function(data)
		  {
		     $('#results').html(data);
			 $('#results').show();
		  }
		  });
		}


		function go_text(val)
		{
			$('#serchKey').val(val);
			$('#results').hide();
		}


		</script>



  <!--  </div>
</div>-->
