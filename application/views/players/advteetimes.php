<div id='content_header'>
    <div class='hdr-text'>Advance Tee Times Search</div>
</div>
<div id="content_wrapper" class="contacts">
<div class="opt_box_wrapper">
<!--for left script start-->
<!--<link href="<?/*=base_url()*/?>asserts/css/site_css/stylesheet2.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php /*echo base_url()*/?>asserts/css/themes/jquery.ui.all.css">
	<script  src="<?php /*echo base_url()*/?>asserts/js/jquery-1.8.1.js"></script>
	<script src="<?php /*echo base_url()*/?>asserts/js/ui/jquery.ui.core.js"></script>
	<script src="<?php /*echo base_url()*/?>asserts/js/ui/jquery.ui.widget.js"></script>
	<script src="<?php /*echo base_url()*/?>asserts/js/ui/jquery-ui-1.8.23.custom.js"></script>
	<script src="<?php /*echo base_url()*/?>asserts/js/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="<?php /*echo base_url()*/?>asserts/css/demos.css">-->
<?php
/*
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
									"Req"=>array("CountryId"=>"",
													"RegionId"=>"")));



	$countryArr = $response->AreasResult->Countries->Country;*/
//print_r($countryArr);
//echo "<pre>";
?>
Destination
<script type="text/javascript">

    $(document).ready(function () {
        <?
        $country_id=$this->session->userdata('country_id');
        $state_id=$this->session->userdata('state_id');

        if($country_id=='' || $state_id=='')
        {
            $country_id='USA';
            $state_id='AZ';
            $this->session->set_userdata('country_id',$country_id);
            $this->session->set_userdata('state_id',$state_id);
        }


        ?>
        country_change('<? echo $country_id;?>', 1);
        state_change('<? echo $state_id;?>');

        <? if($this->session->userdata('area_id')!=''){?>
        area_change('<?=$this->session->userdata('area_id')?>');
        <? }?>
    })

    function country_change(country_id, state_set_unset) {
        $('.state_class').removeClass('region');
        $('#state_div').html('<img src="<?=base_url()?>asserts/images/ajax-loader2.gif">');

        $('#country_id_hid').val(country_id);
        $.ajax({
            type: 'post',
            data: 'country_id=' + country_id + '&state_set_unset=' + state_set_unset,
            async: false,
            url: '<?php echo base_url()?>search_golfcourse/country_change',

            success: function (data) {

                $('.state_class').addClass('region');
                $('#state_div').html(data);

                $('#area_div').html('<select name="area_id" id="area_id"><option value="">--Any Area--</option></select>');

                $('#course_div').html('<select name="course_id" id="course_id"><option value="">--Any Course--</option></select>');
            }

        });
    }

    function state_change(state_id) {
        $('.area_class').removeClass('region');
        $('#area_div').html('<img src="<?=base_url()?>asserts/images/ajax-loader2.gif">');

        $('#state_id_hid').val(state_id);
        var country_id = $('#country_id_hid').val();

        if (state_id != '') {
            $.ajax({
                type: 'post',
                data: 'state_id=' + state_id + '&country_id=' + country_id,
                //data: "jewellerId=" + filter+ "&locale=" +  locale,
                url: '<?php echo base_url()?>search_golfcourse/state_change',
                success: function (data) {

                    $('.area_class').addClass('region');
                    $('#area_div').html(data);

                    $('#course_div').html('<select name="course_id" id="course_id"><option value="">--Any Course--</option></select>');
                }

            });
        }
        else {
            $('.area_class').addClass('region');
            $('#area_div').html('<select name="area_id" id="area_id"><option value="">--Any Area--</option></select>');
        }

    }

    function area_change(area_id) {
        $('.course_class').removeClass('region');
        $('#course_div').html('<img src="<?=base_url()?>asserts/images/ajax-loader2.gif">');

        $('#area_id_hid').val(area_id);
        var country_id = $('#country_id_hid').val();
        var state_id = $('#state_id').val();
        if (area_id != '') {
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: 'state_id=' + state_id + '&country_id=' + country_id + '&area_id=' + area_id,
                url: '<?php echo base_url()?>search_golfcourse/area_change',
                success: function (data) {

                    if (data.RetCd == 0) {//if every data is ok from api
                        $('#error').html('');
                        $('.course_class').addClass('region');
                        $('#course_div').html(data.mydata);
                    }
                    else {//if every data is not ok from api
                        $('#error').html(data.RetMsg);
                        $('.course_class').addClass('region');
                        $('#course_div').html('<select name="course_id" id="course_id"><option value="">--Any Course--</option></select>');
                    }

                }
            });
        }
        else {
            $('.course_class').addClass('region');
            $('#course_div').html('<select name="course_id" id="course_id"><option value="">--Any Course--</option></select>');
        }
    }

</script>

<script>
    $(function () {
        $("#datepicker").datepicker({ minDate: 0, maxDate: "+3M +0D" });
    });
</script>


<!--for left script end-->
<!--kuch b our left new-->
<div id="home_content_left" style=" padding:0px; padding-left:10px; float:none;">

    <div id="error" style="color:#FF0000;margin-left: 11px;"></div>
    <div class="search">
        <form id="advance_form" method="post" name="" action="<?php echo base_url() ?>search_golfcourse/search_teetimes"
              style="float:none!important;" onsubmit="hide_show()">
            <div class="search_top">
                <h3>Search for Tee Times</h3>

                <div class="united">
                    <? $countryArr = $this->common_model->select_all('*', 'gama_country');
                    $countryArr = $countryArr->result();
                    ?>
                    <select name="country_id" id="country_id" onChange="country_change(this.value,2)">
                        <option value="0">Select Country</option>
						<? for ($i = 0; $i < count($countryArr); $i++) {
                            $select = 0;
                            $country_id = $this->session->userdata('country_id');
                            if ($country_id == $countryArr[$i]->id) {
                                $select = 1;

                            }?>
                            <option <? if ($select == 1) { ?> selected="selected" <? } ?>
                                value="<?php echo $countryArr[$i]->id ?>"><?php echo $countryArr[$i]->nm ?></option>
                        <? } ?>
                    </select>
                    <input type="hidden" value="" id="country_id_hid">
                </div>
            </div>
            <div class="search_rpt">
                <div class="search_mid">
                    <ul>
                        <li>
                            <label>Region:</label>

                            <div class="region state_class">


                                <div id="state_div">
                                    <select name="state_id" id="state_id">
                                        <option value="">--Any State--</option>
                                    </select>
                                </div>
                                <input type="hidden" id="state_id_hid" value="">


                            </div>
                        </li>
                        <li class="spacr">
                            <label>Area:</label>

                            <div class="region area_class">


                                <div id="area_div">
                                    <select name="area_id" id="area_id">
                                        <option value="">--Any Area--</option>
                                    </select>
                                </div>
                                <input type="hidden" id="area_id_hid" value="">

                            </div>
                        </li>
                        <li>
                            <label>Course:</label>

                            <div class="region course_class">

                                <div id="course_div">
                                    <select name="course_id" id="course_id">
                                        <option value="">--Any Course--</option>
                                    </select>
                                </div>

                            </div>
                        </li>
                        <li class="spacr">
                            <label>Date:</label>

                            <div class="region">
                                <?
                                $sess_date = $this->session->userdata('fin_date');
                                if ($sess_date == '') {
                                    $sess_date = time();
                                    $this->session->set_userdata('fin_date', $sess_date);
                                }
                                //$sess_date = date('m/d/Y', $sess_date);
								$sess_date = date('m/d/Y');
                                ?>

                                <input type="text" name="datepicker" id="datepicker" value="<?= @$sess_date ?>"
                                       style="position:relative; z-index:1; width:165px;">
                                <a href="#." style="margin-left:-17px;"><img
                                        src="<?= base_url() ?>asserts/images/lander.png" alt="#"/></a>

                            </div>
                        </li>
                        <li>
                            <label>Time:</label>

                            <div class="region">


                                <select name="times" id="times">
                                    <option value="500">5AM</option>
                                    <option value="600">6AM</option>
                                    <option value="700">7AM</option>
                                    <option value="800">8AM</option>
                                    <option value="900">9AM</option>
                                    <option value="1000">10AM</option>
                                    <option value="1100">11AM</option>
                                    <option value="1200">12AM</option>
                                    <option value="1300">1PM</option>
                                    <option value="1400">2PM</option>
                                    <option value="1500">3PM</option>
                                    <option value="1600">4PM</option>
                                    <option value="1700">5PM</option>
                                </select>
                                <!--<a href="#"><img src="<?=base_url()?>images/lander2.png" alt="#" /></a>-->
                            </div>
                        </li>
                        <li class="spacr">
                            <label>Players:</label>

                            <div class="region2">
                                <select name="players" id="players">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <!--<input type="radio" id="players" name="players" value="1">1
                                <input type="radio" id="players" name="players" value="2">2
                                <input type="radio" id="players" name="players" value="3">3
                                <input type="radio" id="players" name="players" value="4">4-->
                            </div>
                        </li>
                        <li>
                            <label>Promo Code:</label>

                            <div class="region3_outer">
                                <div class="region3">
                                    <input type="text" value=""/>
                                </div>
                                <a href="#"><img src="<?= base_url() ?>asserts/images/lander3.png" alt="#"/></a></div>
                        </li>
                        <li class="spacr">
                            <div class="region4">
                                <input type="hidden" name="my_submit" value="TRUE">
                                <input type="submit" style="cursor:pointer" name="submit" value="Search Tee Times">
                            </div>
                        </li>
                    </ul>
                    <div class="clr"></div>
                </div>
                <div class="clr"></div>
            </div>

        </form>

        <div class="search_bottom">
            <ul>
                <li class="first_li"><a href="#">Additional Search Options </a></li>
                <li>
                    <input type="checkbox"/>
                    <label>Show redemption times only </label>
                </li>
                <li>
                    <input type="checkbox"/>
                    <label>Show tee time specials only </label>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
</div>
</div>
<div class="adv_search_results notifications">

    <?php
    if (!empty($sports_data)) {
        foreach ($sports_data['records'] as $row) {
            ?>

            <div class="msg_item player">

                <img class="u_icn"
                     src="<?php echo base_url(); ?><?php if ($row->image != '') echo 'images/th_' . $row->image; else echo $row->gender == 'm' ? "css/images/empty_image.png" : "css/images/female_image.png"; ?>">

                <div class="msg_data">

                    <div class="u_name"><?php echo $row->pname; ?></div>

                    <div class="u_msg"><?php echo $row->cname; ?></div>

                    <div class="msg_actions" rel='<?php echo $row->pid; ?>'>

                        <div class='n_actions'>

                            <?php

                            $txt = 'Add';

                            $status = 'a';

                            if ($row->is_approved != '') {

                                if ($row->is_approved == '0') {

                                    $txt = 'Waiting for Approval';

                                    $status = 'w';

                                } else if ($row->is_approved == '1') {

                                    $txt = 'Waiting for Approval';

                                    $status = 'r';

                                }

                            }

                            ?>

                            <div class='act_wrap'><a class='n_act btn act-status' rel='<?php echo $row->pid; ?>'
                                                     status='<?php echo $status; ?>'><?php echo $txt; ?></a></div>

                            <div class='clear'></div>

                        </div>

                    </div>

                    <div class='more'><a href="<?php echo site_url('profile/view/' . $row->pid); ?>">More..</a></div>

                </div>

            </div>
        <?php } ?>
    <?php } ?>

    <div class="clear"></div>

</div>

<div class="clear"></div>

<div id="pager_wrap">

    <div class="pager fr">

        <!--<div id="pager_prev" class="page_box fl">&nbsp;</div>-->

        <!--<div class="page_box fl">1</div>-->

        <?php echo $this->pagination->create_links(); ?>

        <!--<div id="pager_next" class="page_box fl">&nbsp;</div>-->

    </div>

</div>

</div>
