<ul>
   
        <!-- Admin SET -->
		<?php if($this->userType==1){ ?>
        <li><a href="<?php echo site_url('cp'); ?>">Home</a></li>
        <li>
            <label for="website"><a href="<?php echo site_url('cp/players_accounts'); ?>"> Players </a></label>
        </li>
        <li>
            <label for="website"><a href="<?php echo site_url('cp/players_accounts'); ?>"> Club Users </a></label>
        </li>
        

        <!-- Admin SET -->

   <?php } if($this->userType==2){ ?>
        <li><a href="<?php echo site_url('players'); ?>">Home</a></li>
        <li>
            <label for="website"><a href="<?php //echo site_url('players/'); ?>"> Messages </a></label>
        </li>
        <li>
            <label for="website"><a href="<?php echo site_url('players/scheduler'); ?>"> Scheduler </a></label>
        </li>
        <li>
            <label for="website"><a href="<?php //echo site_url('players/'); ?>"> News </a></label>
        </li>
         <li>
            <label for="website"><a href="<?php echo site_url('inbox/'); ?>"> Inbox </a></label>
        </li>
		 <li>
            <label for="website"><a href="<?php echo site_url('inbox/sent'); ?>"> Sent Messages </a></label>
        </li>
         <li>
            <label for="website"><a href="<?php echo site_url('inbox/compose'); ?>"> Compose Message </a></label>
        </li>
        <!-- Admin SET -->

   <?php } if($this->userType==3){ ?>
        <li><a href="<?php echo site_url('clubs'); ?>">Home</a></li>
        <li>
            <label for="website"><a href="<?php //echo site_url('clubs'); ?>"> Messages </a></label>
        </li>
        <li>
            <label for="website"><a href="<?php //echo site_url('clubs/'); ?>"> News </a></label>
        </li>
        

        <!-- Admin SET -->

   <?php }?>
    <li>
            <label for="website"><a href="<?php echo site_url('players/allplayers'); ?>"> Find Friends </a></label>
        </li>
 <li>
            <label for="website"><a href="<?php echo site_url('sports/mysports'); ?>"> My Sports </a></label>
        </li>
		 <li>
            <label for="website"><a href="<?php echo site_url('sports/allsports'); ?>"> Sports </a></label>
        </li>
		 <li>
            <label for="website"><a href="<?php echo site_url('teams/myteams'); ?>"> My Teams </a></label>
        </li>
		 <li>
            <label for="website"><a href="<?php echo site_url('teams/allteams'); ?>"> Teams </a></label>
        </li>
 <li>
            <label for="website"><a href="<?php echo site_url('sports/add_sports'); ?>"> Add Sports </a></label>
        </li>
		 <li>
            <label for="website"><a href="<?php echo site_url('teams/add_teams'); ?>"> Add Teams </a></label>
        </li>

</ul>