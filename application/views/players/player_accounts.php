<div>
    <h2 align="center"><span> <?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Players Details </span></h2>
    <div class="clr"></div>
    <div class="clr"></div>
    <div id="users_content_wrap">
        <!--<div>
            <ol class="fr"><li><input type="button" value="Add user" id="add_user_btn" class="send button"/></li></ol>
            <div class="clr"></div>
        </div>-->
        <div id="filter_wrap" style="padding-bottom: 5px;">
            <label for="user_type">User Type: </label>
            <select name="users_type" id="users_type" class="text">
                <?php foreach($user_types as $k=>$v){ ?>
                <option value="<?php echo $v['id']; ?>"> <?php echo $v['name']; ?> </option>
                <?php } ?>
            </select>
            <label for="status">Active/Inactive: </label>
            <select name="status" id="status" class="text">
                <option value="1">Active</option>
                <option value="0">In Active</option>
            </select>
        </div>
        <div class="jqgrid_wrap">
            <table id="grid_table"></table>
            <div id="grid_pager"></div>
        </div>

        <script type="text/javascript" rel="javascript">
            users_grid();
        </script>
    </div>
</div>
