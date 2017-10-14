<div class="profile-menu">
	<ul>
		<li><a class="<?php if(!isset($entity) || $entity == 'dashboard') { echo 'active'; } ?>" href="<?php echo ci_base_url();?>provider">Dashboard</a></li>
		<li><a class="<?php if(isset($entity) && $entity == 'preferences') { echo 'active'; } ?>" href="<?php echo ci_base_url();?>provider/preferences">Preferences </a></li>
		<li><a class="<?php if(isset($entity) && $entity == 'setting') { echo 'active'; } ?>" href="<?php echo ci_base_url();?>provider/setting">Setting</a></li>
		<li><a class="<?php if(isset($entity) && $entity == 'logout') { echo 'active'; } ?>" href="<?php echo ci_base_url();?>auth/logout_user">Logout</a></li>
	</ul>
</div>
