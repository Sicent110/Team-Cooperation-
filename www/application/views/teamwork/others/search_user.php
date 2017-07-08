


<?php foreach ($users as $user_info): ?>

        <a href="<?=site_url('project/add_member?projectid='.$projectid.'&userid='.$user_info['id'])?>">

            <img src="<?php echo base_url();?>static/img/avatar/<?=$user_info['avatar']?>" alt='user_avatar' height="30" width="30"border="0" align="left"/>
            <?=$user_info['username']?>
        </a>
        <br><br>

<?php endforeach; ?>
