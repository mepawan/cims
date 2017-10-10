<div class="profile-menu">
	<ul>
		<li class="menu-link<?php if(isset($entity) && $entity == 'dashboard'){ echo '-active'; } ?>"><a href="<?php echo ci_base_url();?>customer">Dashboard</a></li>
		<li class="menu-link<?php if(isset($entity) && $entity == 'contracts'){ echo '-active'; } ?>"><a href="<?php echo ci_base_url();?>customer/contracts">Contracts</a></li>
		<li class="menu-link<?php if(isset($entity) && $entity == 'contract'){ echo '-active'; } ?>"><a href="<?php echo ci_base_url();?>customer/create-contract">Create Contracts</a></li>
		<li class="menu-link<?php if(isset($entity) && $entity == 'email_pref'){ echo '-active'; } ?>"><a href="<?php echo ci_base_url();?>customer/email-pref">Email Preferences </a></li>
		<li class="menu-link<?php if(isset($entity) && $entity == 'setting'){ echo '-active'; } ?>"><a href="<?php echo ci_base_url();?>customer/setting">Setting</a></li>
		<li class="menu-link"><a href="<?php echo ci_base_url();?>auth/logout_user">Logout</a></li>
	</ul>
</div>
