<div>
    <h3 style="padding-left:30px;">Sign in to WESport</h3>
    <div class="login_form_wrap" id="login_form_wrap">
        <form id="login_frm" name="login_frm" action="<?php echo site_url('login'); ?>" method="POST">
        <div class="form_row" style="padding-top:85px;">
            <label class="fl" for="username">Email Address:  </label>
            <span class="row_field fl"><input type="text" class="text" name="uname" id="uname"/></span>
            <div class="clear"></div>
        </div>
        <div class="form_row">
            <label class="fl" for="password">Password:  </label>
            <span class="row_field fl" style="width: 190px;"><input type="password" class="text" name="psw" id="psw"/></span>
            <span class="forgot_link fl" style="width: 110px; padding-top:2px; "><a onclick="document.getElementById('psw_wrap').style.display='block';document.getElementById('login_form_wrap').style.display='none'; " href="javascript:void(0)" >Forgot Password? </a></span>
            <div class="clear"></div>
        </div>
        <div class="form_row">
            <label class="fl" for="password">&nbsp;  </label>
            <span class="row_field fl"><input type="submit" name="submit" value="Sign In" class="button_img"/> <a style="color: #4C4C4C;" href="<?php echo site_url('home'); ?>">or Join WESports</a></span>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        </form>
    </div>
    <div class="login_form_wrap" id="psw_wrap" style="display:none;">
        <form id="forgot_frm" name="forgot_frm" action="<?php echo site_url('login/forgot'); ?>" method="POST">
        <div class="form_row" style="padding-top:85px;">
            <label class="fl" for="username">Email Address:  </label>
            <span class="row_field fl"><input type="text" value="" name="uname" id="uname"/></span>
            <div class="clear"></div>
        </div>
        <div class="form_row">
            <label class="fl" for="password">&nbsp;  </label>
            <span class="row_field fl"><input type="submit" name="submit" value="Submit" id="login_btn" class="button_img"/> <a onclick="document.getElementById('login_form_wrap').style.display='block';document.getElementById('psw_wrap').style.display='none'; " href="javascript:void(0)" style="">Back to Login?</a></span>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        </form>
    </div>
<div class="clear"></div>
</div>
<script type="text/javascript" rel="javascript">
    $(function(){
       $('[name=uname]:visible').focus();
    });
</script>
<script type="text/javascript" rel="javascript">
$(document).ready(function() {
        $("#login_frm").validate({
            rules: {
                uname: {
                    required: true,
                    email: true
                },
                psw: {
                    required: true
                }
            },
            messages: {
                uname:{
                    required: "enter email address"
                },
                psw: {
                    required: "enter password"
                }
            }
        });
         $("#forgot_frm").validate({
            rules: {
                uname: {
                    required: true,
                    email: true
                }
            },
            messages: {
                uname: {
                    required: "enter a valid email",
                    email: "enter a valid email"
                }


            }
	});
});
</script>