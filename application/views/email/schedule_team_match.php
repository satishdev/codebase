<style>body{margin: 0; padding: 0;}</style>
<table cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-size:12px;font-family: Helvetica,Arial, sans-serif;min-width:320px; width: 100%;">
		<tr><td colspan="3" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #dedede;"></td></tr>
    	 <tr style='height: 45px; background: #f0f2f5;'>
            <td align="left" style="padding: 19px 0 13px 12px;"><span style='color:#686a6e;font-size:18px;font-weight:bold;font-family:Helvetica,Arial, sans-serif;'> Friend Request</span></td>
           <td align="right" style="padding-right:10px; padding-top: 6px;"><img src="<?php echo base_url();?>css/images/logo.png" alt="WESport" style="display:block;"/></td>
         </tr>
          <tr><td colspan="3" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #dbdbdb;"></td></tr>
         <tr style='height: 52px;'>
         	<td colspan="3" style="padding: 23px 10px 13px 12px;"><span style='color:#454545;font-size:13px;font-family:Helvetica,Arial,sans-serif;'><?php echo $t_details->name;?>  Team match Request from <?php echo $this->userFname.' '.$this->userLname;?> to you. <a href="<?php echo site_url('invitation');?>" target="_blank" style="text-decoration:none;color:#005ac9;font-size:14px;font-family: Helvetica,Arial, sans-serif;">Accept</a> or <a href="<?php echo site_url('invitation');?>" target="_blank" style="text-decoration:none;color:#005ac9;font-size:14px;font-family: Helvetica,Arial, sans-serif;">Decline</a></span></td>
            <td></td>
         </tr>
        
        
        <tr><td colspan="3" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #bdbdbd;"></td></tr>
        <tr><td colspan="3" cellpadding="0" cellspacing="0"  style="border-bottom: 1px solid #ffffff;"></td></tr>
         <tr style='height: 80px;'>
             <td style="background-color:#e8ebef;padding:0 10px 0 12px;" colspan="3">
             	<table align="left" border="0" cellpadding="0" cellspacing="0" style="font-family: Helvetica,Arial, sans-serif;">
                	<tr>
                	  <td align="left" style="padding:6px 0 8px 0;font-size:13px;font-family: Helvetica,Arial, sans-serif;"><a href="<?php echo site_url('login');?>" target="_blank" style="text-decoration:none;color:#005ac9;font-size:14px;">Login to WESport</a></td></tr>
                    <tr>
                      <td align="left"><span style="color:#929292;font-size:11px;font-family: Helvetica,Arial, sans-serif;">Please do not reply to this automated system message. You have received it as a registered user in WESport.</span></td></tr>
                    <tr><td style="padding-bottom:22px;"><span style="color:#929292;font-size:11px;font-family: Helvetica,Arial, sans-serif;">Delivered by WESport.</span></td></tr>
                </table>
             </td>
         </tr>
     </table>
