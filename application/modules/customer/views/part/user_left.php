<?php $user = $this->ciauth->get_user();  ?>

<div class="profile_img"><img src="<?php echo ci_public('upload'); ?><?php if($user['profile_pic']){ echo $user['profile_pic']; } else { echo 'default_profile_pic.png'; } ?>" height="140px" width="250px"></div>
<button>update</button>
<div class="profile-menu">
	<ul>
		<li><a href="<?php echo ci_base_url();?>customer">Dashboard</a></li>
		<li><a href="<?php echo ci_base_url();?>customer/profile">Edit Profile</a></li>
		<li><a href="<?php echo ci_base_url();?>customer/payment">Payment</a></li>
		<li><a href="<?php echo ci_base_url();?>customer/create-contract">Create Contract</a></li>
		<li><a href="<?php echo ci_base_url();?>auth/logout_user">Logout</a></li>
		
		
	</ul>
</div>
