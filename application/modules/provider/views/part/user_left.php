<?php $user = $this->ciauth->get_user();  ?>

<div class="profile_img"><img src="<?php echo ci_public('upload'); ?><?php echo $user['profile_pic']; ?>" height="140px" width="250px"></div>
<button>update</button>
<div class="profile-menu">
	<ul>
		<li><a href="<?php echo ci_base_url();?>provider">Dashboard</a></li>
		<li><a href="<?php echo ci_base_url();?>provider/profile">Edit Profile</a></li>
		<li><a href="<?php echo ci_base_url();?>provider/payment">Payment</a></li>
		<li><a href="<?php echo ci_base_url();?>auth/logout_user">Logout</a></li>
		
		
	</ul>
</div>
