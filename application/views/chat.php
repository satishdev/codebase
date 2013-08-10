<?php // session_start(); echo '<pre>';print_r($_SESSION); die;// echo '<pre>'; print_r($users); echo '</pre>'; ; ?>
<h2>Online users.</h2>
<br/>
<div>
<?php if(count($users)){ foreach($users as $k=>$v){ ?>
    <a href="javascript:void(0)" class="online_icon" onclick="javascript:chatWith('<?php echo str_replace(' ', '_', $v['user_type']).'-'.str_replace(' ', '_', $v['username']); ?>')">Chat With:  <?php echo $v['user_type'].'-'.$v['username']; ?></a>
<?php }}else{ ?>
<p>No users online.</p>
<?php } ?>
</div>