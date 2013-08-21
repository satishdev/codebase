<style>

    .cart_system {

        float: left;

        font-weight: bold;

        line-height: 38px;

        padding-left: 90px;

    }

</style>

<script type="text/javascript" src="<?php echo base_url('js/jquery.lavalamp.js') ?>"></script>

<script type="text/javascript" src="<?php echo base_url('js/jquery.easing.min.js') ?>"></script>

<script type="text/javascript">

    var active_tab = <?php echo $active_tab; ?>;

    $(function () {

        $('#main_menu > li:eq(' + active_tab + ')').addClass('active');

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

<?php if (isset($this->userType) && $this->userType == 1) { ?>

    <div class="menu_item fl">

        <a class="menu_link" href="<?php echo site_url('cp'); ?>">Home</a>

    </div>

    <div class="item fl">

        <a class="menu_link" href="<?php echo site_url('cp/players_accounts'); ?>"> Players </a>

    </div>

    <div class="item fl">

        <a class="menu_link" href="<?php echo site_url('cp/players_accounts'); ?>"> Club Users </a>

    </div>

<?php

}

if (isset($this->userType) && $this->userType == 2) {

    ?>

    <div class="menu_left">

        <ul>

            <li><a class="item" href="<?php echo site_url('players'); ?>">Home</a></li>

            <li><a class="item" href="<?php echo site_url('players/profile'); ?>">Profile</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('players/profile'); ?>">Manage Profile</a></li>

                    <!-- <li><a class="item" href="#">sRanking</a></li>

                     <li><a class="item" href="#">Vote For Me</a></li>

                     <li><a class="item" href="#">Recommendation</a></li>-->

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('players/friends'); ?>">Contacts</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('players/friends'); ?>">My Sports Friends</a></li>

                    <li><a class="item" href="<?php echo site_url('players/allplayers'); ?>">Add/Search sFriends</a>

                    </li>

                    <li><a class="item schedule_match" rel="1">Schedule Match</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('sports/add_sports'); ?>">Sports</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('sports/add_sports'); ?>">Add Sport</a></li>

                    <!--<li><a class="item" href="<?php echo site_url('sports/allsports'); ?>">Available Sports</a></li>-->

                    <li><a class="item" href="<?php echo site_url('sports/mysports'); ?>">My Sports</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('teams/add_teams'); ?>">Teams</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('teams/add_teams'); ?>">Create Team</a></li>

                    <!--<li><a class="item" href="<?php echo site_url('teams/allteams'); ?>">Available Teams</a></li>-->

                    <li><a class="item" href="<?php echo site_url('teams/myteams'); ?>">My Teams</a></li>

                    <li><a class="item schedule_match" rel="2">Schedule Match</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('inbox/'); ?>">Messages </a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('inbox/'); ?>">Inbox</a></li>

                    <li><a class="item" href="<?php echo site_url('inbox/sent'); ?>">Sent</a></li>

                    <li><a class="item" href="<?php echo site_url('inbox/compose'); ?>">Compose</a></li>

                    <!--<li><a class="item" href="<?php //echo site_url('players/gallery'); ?>">Gallery</a></li>-->

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('cb/allclubs'); ?>">Golf Courses</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('cb/allclubs'); ?>">Join Golf Courses</a></li>

                    <li><a class="item" href="<?= base_url() ?>teetime_golfcourse/golf_course/">My Golf Courses</a></li>

                </ul>

            </li>

            <li><a class="item" href="#">Tee Times</a>

                <ul>

                    <li><a class="item" href="<?= base_url() ?>search_golfcourse/teetimes/">Available Tee Times</a></li>

                    <li><a class="item" href="<?= base_url() ?>reserve_golfcourse/my_booking_history">My Booking

                            History</a></li>

                </ul>

            </li>



            <!--   <li><a class="item" href="#">sWorld</a>

                   <ul class='children'>

                       <li><a class="item" href="#">Voting</a></li>

                       <li><a class="item" href="#">Ranking</a></li>

                       <li><a class="item" href="#">Credits</a></li>

                       <li><a class="item" href="#">Recommendations</a></li>

                       <li><a class="item" href="#">Polls</a></li>

                       <li><a class="item" href="#">News</a></li>

                       <li><a class="item" href="#">Forums</a></li>

                       <li><a class="item" href="#">Photos</a></li>

                       <li><a class="item" href="#">Videos</a></li>

                   </ul>

               </li>

               -->





        </ul>

    </div>

<?php

}

if (isset($this->userType) && $this->userType == 3) {

    ?>

    <div class="menu_left">

        <ul>

            <li><a class="item" href="<?php echo site_url('clubs'); ?>">Home</a></li>

            <li><a class="item" href="<?php echo site_url('sports/add_sports'); ?>">Sports</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('sports/add_sports'); ?>">Add Club Sport</a></li>

                    <!--<li><a class="item" href="<?php echo site_url('clubs/add_sports'); ?>">View Sports</a></li>-->

                    <li><a class="item" href="<?php echo site_url('sports/mysports'); ?>">Club Sports</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('teams/add_teams'); ?>">Teams</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('teams/add_teams'); ?>">Add Team</a></li>

                    <!-- <li><a class="item" href="<?php echo site_url('clubs/add_teams'); ?>">View Teams</a></li>-->

                    <li><a class="item" href="<?php echo site_url('teams/myteams'); ?>">Club Teams</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('inbox/'); ?>">Messages</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('inbox/'); ?>">Inbox</a></li>

                    <li><a class="item" href="<?php echo site_url('inbox/sent'); ?>">Sent</a></li>

                    <li><a class="item" href="<?php echo site_url('inbox/compose'); ?>">Compose</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('clubs/add_facilities'); ?>">Facilities</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('clubs/add_facilities'); ?>">Add facility</a></li>

                    <li><a class="item" href="<?php echo site_url('clubs/list_facilities'); ?>">View facilities</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('clubs/add_holidays'); ?>">Holidays</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('clubs/add_holidays'); ?>">Add Holiday</a></li>

                    <li><a class="item" href="<?php echo site_url('clubs/list_holidays'); ?>">View Holidays</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('clubs/add_news'); ?>">News</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('clubs/add_news'); ?>">Add News</a></li>

                    <li><a class="item" href="<?php echo site_url('clubs/list_news'); ?>">View News</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('clubs/add_courts'); ?>">Tee Times</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('clubs/add_courts'); ?>">Add Tee Times</a></li>

                    <li><a class="item" href="<?php echo site_url('clubs/list_courts'); ?>">View Tee Times</a></li>

                </ul>

            </li>

            <li><a class="item" href="<?php echo site_url('clubs/club_users'); ?>">Golf Courses</a>

                <ul>

                    <li><a class="item" href="<?php echo site_url('clubs/club_users'); ?>">Golf Courses Users</a></li>

                </ul>

            </li>

        </ul>

    </div>

<?php

}

if (!isset($this->userType) || empty($this->userType)) {

    ?>

    <div class="menu_left">

        <ul>

            <li><a <? if (@$my_select == 'home'){ ?>class="active"<? } ?>

                   href="<?php echo site_url('home'); ?>">Home</a></li>

            <?php /*?><li><a <? if (@$my_select == 'signin'){ ?>class="active"<? } ?> href="<?php echo site_url('login'); ?>">Sign In</a></li><?php */?>

        </ul>

    </div>

<?php } ?>

<!--        MENU-BAR LINKS END      -->

<?php

if ($this->db_session->userdata('user_object') != '') {

    if (isset($this->userType) || !empty($this->userType)) {

        ?>

        <div id="search_menu">

            <div class="item fr">

                <?php

                /*if($this->uri->segment(1,0)=='teams')



                        $url='teams/advanceteams';



                        else



                        $url='players/advanceplayers';*/



                ?>

                <?php // echo site_url($url);?>

                <a href="#." onclick="check_adv_redirect()" class="menu_link adv_search">Advanced</a>





            </div>



            <div class="item fr">



                <?php

                /*

                last change start

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

                last change end

                */

                $form_url = '';

                $form_key = '';

                $user_drop = array('Players', 'Golf Courses', 'Tee Times', 'Teams');

                if (strcmp($this->uri->segment(2, 0), 'allplayers') == 0 || strcmp($this->uri->segment(2, 0), 'advanceplayers') == 0) {

                    $form_key = 0;

                    $form_url = base_url() . 'players/allplayers';

                } else if (strcmp($this->uri->segment(2, 0), 'searchgolfcourse') == 0 || strcmp($this->uri->segment(2, 0), 'advgolfcourses') == 0) {

                    $form_key = 1;

                    $form_url = base_url() . 'players/searchgolfcourse';

                } else if (strcmp($this->uri->segment(2, 0), 'advteetimes') == 0 || strcmp($this->uri->segment(2, 0), 'searchteetimes') == 0) {

                    $form_key = 2;

                    $form_url = base_url() . 'players/searchteetimes';

                } else {

                    $form_key = 3;

                    $form_url = base_url() . 'teams/allteams';

                }



                ?>



                <style type="text/css">



                    #results {

                        border: 1px solid #BFBFBF;

                        display: none;

                        background-color: #FFFFFF;

                        height: auto;

                        margin-top: 24px;

                        min-height: 101px;

                        width: 212px;

                        z-index: 1000;

                        position: absolute;

                    }



                    #results li:hover {

                        background-color: #999999;

                    }



                </style>





                <!--<form name="srch" id="srch" action="<?php  //echo $form_url;?>" method="post">-->

                <form name="srch" id="srch" action="<?= $form_url ?>" method="post">



                    <a class="menu_link">

                        <!--<input type="text" id="serchKey" placeholder="Search..." class="menu_search text"

                               name="serchKey" onkeyup="auto_complete()"

                               value="<?php /*if ($this->db_session->userdata('pserchKey')) echo $this->db_session->userdata('pserchKey'); else echo @$serchKey; */?>"/>-->

                        <input type="text" id="serchKey" placeholder="Search..." class="menu_search text"

                               name="serchKey" onkeyup="auto_complete()" autocomplete="off"

                               value="<?php if ($this->db_session->userdata('pserchKey')) echo $this->db_session->userdata('pserchKey'); else echo @$serchKey; ?>"/>

                        <input type="submit" value="" class="search_button"/></a>



                    <div id="results"></div>

                </form>



            </div>



            <div class="item fr men_left">

                <?php //$user_drop=array('Players','Sponsors','Trainers','Tournaments','Golf Courses','Tee Times','Teams');?>

                <a id="search_filter_type" class="menu_link" href="#">

                    <div class='u_type_wrap'>

                        <div class="user_type_selector"><?php echo $user_drop[$form_key]; ?></div>

                    </div>

                </a>

                <!--<input type="hidden" value="1" name="search_type_id" id="search_type_id" />-->

                <div id="user_type_selector_options" class="sub_menu_bar small_sub_menu">



                    <?php foreach ($user_drop as $k => $v) { ?>



                        <div class="item"><a class="menu_link" onclick="check_adv(<?php echo $k ?>)"

                                             rel="<?php echo $k; ?>"><?php echo $v; ?></a></div>



                    <?php } ?>



                    <div class="clear"></div>



                </div>



            </div>



        </div>



    <?php

    }

}

?>

<div class="clr"></div>

<div class="clr"></div>

</div>

</div>

<input type="hidden" value="<?= @$form_key ?>" id="adv_submit"/>

<script type="text/javascript">

    function check_adv_redirect() {

        var para = $('#adv_submit').val();

        if (para == 0) {

            window.location = "<?=base_url()?>players/advanceplayers";

        }

        if (para == 1) {

            window.location = "<?=base_url()?>players/advgolfcourses";

        }

        if (para == 2) {

            window.location = "<?=base_url()?>players/advteetimes";

        }

        if (para == 3) {

            window.location = "<?=base_url()?>teams/advanceteams";

        }



    }



    function check_adv(para) {

        $('#adv_submit').val(para);



        if (para == 0) {

            $("#srch").attr('action', '<?=base_url()?>players/allplayers');

        }

        if (para == 1) {

            $("#srch").attr('action', '<?=base_url()?>players/searchgolfcourse');

        }

        if (para == 2) {

            $("#srch").attr('action', '<?=base_url()?>players/searchteetimes');

        }

        if (para == 3) {

            $("#srch").attr('action', '<?=base_url()?>teams/allteams');

        }

    }





    function auto_complete() {

        var search_me = $('#serchKey').val();

        $.ajax({

            type: 'post',

            data: 'search_me=' + search_me,

            url: '<?=base_url()?>players/golfcourses_name_auto_complete',

            success: function (data) {

                $('#results').html(data);

                $('#results').show();

                $('#results').mouseleave(function(){

                    $(this).hide();

                });

            }

        });

    }





    function go_text(val) {

        $('#serchKey').val(val);

        $('#results').hide();

    }

</script>

<!--  </div>

</div>-->

