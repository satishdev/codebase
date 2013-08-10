<div id='content_header'>
	<div class='hdr-text'>Sent Message</div>
    <?php echo smallButton(array('label'=>'Back', 'href'=>site_url('inbox/sent'))); ?>
</div>

<div id="content_wrapper" class='contacts pad'>
    <ol>
        <li>To: <?php echo $i_details->reciep;?></li>
        <li>Subject: <?php echo $i_details->subject;?></li>
        <li>Body: <?php echo $i_details->message;?></li>
        <li>Message sent on: <?php echo date('d-m-Y H:i:s',strtotime($i_details->create_date));?></li>
    </ol>
</div>
