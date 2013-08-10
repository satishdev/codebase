<div id='content_header'>
	<div class='hdr-text'>View Message</div>
    <?php echo smallButton(array('label'=>'Back', 'href'=>site_url('inbox'))); ?>
</div>

<div id="content_wrapper" class='pad contacts'>
    <ol>
        <li>From: <?php echo $i_details->first_name."(".$i_details->email.")";?></li>
		<li>Subject: <?php echo $i_details->subject;?></li>
		<li>Body: <?php echo $i_details->message;?></li>
		<li>Message recieved on: <?php echo date('d-m-Y H:i:s',strtotime($i_details->create_date));?></li>
    </ol>
</div>