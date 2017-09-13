<?php $this->load->view('part/head');?>

<body class="theme-dark">
<?php $this->load->view('/part/left_menu'); ?>
<?php $this->load->view('/part/top_menu'); ?>
<section class="page-content">
	<div class="page-content-inner">
		<section class="panel panel-with-sidebar sidebar-large panel-with-right-sidebar panel-with-borders">
			<div class="panel-sidebar">
				<h6>Setting Groups</h6>
				<ul class="list-unstyled app-calendar-list">
					<li>
						<a href="#"> Basic Setting </a>
					</li>
					<li>
						<a href="#"> Basic Setting </a>
					</li>
					<li>
						<a href="#"> Basic Setting </a>
					</li>
					<li>
						<a href="#"> Basic Setting </a>
					</li>
				</ul>
				
			</div>
			<div class="panel-heading">
				<div class="pull-right">
					
				</div>
				<h3 class="messaging-title"><i class="left-menu-link-icon <?php echo $icon;?>"></i> <?php echo $heading;?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<h3 id="basic_setting_h"> Basic Setting </h3>
						<form method="post" enctype="multipart/form-data" >
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="site_name">Site Name</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="Site Name" name="site_name" id="site_name" value="<?php if(isset($ettings['site_name'])){ echo $ettings['site_name'];}?>" >
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="site_email">Site Email</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="Site Email" name="site_email" id="site_email" value="<?php if(isset($ettings['site_email'])){ echo $ettings['site_email'];}?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="logo">Primary Logo</label>
								</div>
								<div class="col-md-9">
									<input type="file" class="" name="logo" id="logo">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="logo2">Secondary Logo</label>
								</div>
								<div class="col-md-9">
									<input type="file" class="" name="logo2" id="logo2">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="favicon">Favicon </label>
								</div>
								<div class="col-md-9">
									<input type="file" class="" name="favicon" id="favicon">
								</div>
							</div>
						</form>
						<h3 id="email_setting_h"> Email Setting </h3>
						 <form method="post" enctype="multipart/form-data" >
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="email_protocol"> Protocol </label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="email_protocol">
										<option  value="mail"> Mail </option>
										<option value="smtp"> SMTP </option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="smtp_host">SMTP Host</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="SMTP User" name="smtp_host" id="smtp_host" value="<?php if(isset($ettings['smtp_host'])){ echo $ettings['smtp_host'];}?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="smtp_user">SMTP User</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="SMTP Host" name="smtp_user" id="smtp_user" value="<?php if(isset($ettings['smtp_user'])){ echo $ettings['smtp_user'];}?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="smtp_password">SMTP Password</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="SMTP Password" name="smtp_password" id="smtp_password" value="<?php if(isset($ettings['smtp_password'])){ echo $ettings['smtp_password'];}?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="smtp_port">SMTP Port</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" placeholder="SMTP Port" name="smtp_port" id="smtp_port" value="<?php if(isset($ettings['smtp_port'])){ echo $ettings['smtp_port'];}?>">
								</div>
							</div>
							
							
							<div class="form-group row">
								<div class="col-md-3">
									<label class="form-control-label" for="smtp_port">SMTP Encryption</label>
								</div>
								<div class="col-md-9">
									<select class="form-control" name="email_protocol">
										<option value="" > None </option>
										<option <?php if(isset($ettings) & isset($ettings['smtp_crypto']) && $ettings['smtp_crypto'] == 'ssl'){ echo ' selected="selected" '; } ?> value="ssl"> ssl </option>
										<option <?php if(isset($ettings) & isset($ettings['smtp_crypto']) && $ettings['smtp_crypto'] == 'tls'){ echo ' selected="selected" '; } ?> value="tls"> tls </option>
									</select>
								</div>
							</div>
							
							
							
							
						</form>
					</div>
				</div>
			</div>
		</section>

	</div> <!-- end .page-content-inner -->
<?php $this->load->view('part/js'); ?>

<!-- Page Scripts -->
<script>
   
</script>
</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>