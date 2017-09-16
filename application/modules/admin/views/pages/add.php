<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>GrapesJS Demo - Open Source Website Page Builder</title>
    <link rel="stylesheet" href="<?php echo ci_public('admin');?>grapesjs/css/toastr.min.css">
    <link rel="stylesheet" href="<?php echo ci_public('admin');?>grapesjs/css/grapes.min.css?v0.10.2">
    <link rel="stylesheet" href="<?php echo ci_public('admin');?>grapesjs/css/grapesjs-preset-webpage.css">
    <link rel="stylesheet" href="<?php echo ci_public('admin');?>grapesjs/css/tooltip.css">
    <link rel="stylesheet" href="<?php echo ci_public('admin');?>grapesjs/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?php echo ci_public('admin');?>grapesjs/css/grapesjs-plugin-filestack.css">
    <link rel="stylesheet" href="<?php echo ci_public('admin');?>grapesjs/css/custom.css">
      
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>css/source/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>css/source/main.css">
	<?php
		if(isset($add_recaptcha_js) && $add_recaptcha_js){
			echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
		}
	?>
	<script type="text/javascript">
		var ci_base_url = '<?php echo ci_base_url();?>';
	</script>
 </head>
  
	<body class="theme-dark">
		<?php $this->load->view('/part/left_menu'); ?>
		<?php $this->load->view('/part/top_menu'); ?>
		
		<section class="page-content">
			<div class="page-content-inner">
				<section class="panel panel-with-borders">
					<div class="panel-heading">
						<div class="heading-buttons pull-right">
							<a href="<?php echo ci_base_url();?>pages/add" class="btn btn-success margin-inline save-button">Save</a>
						</div>
						<h3 class="messaging-title"><i class="left-menu-link-icon <?php echo $icon;?>"></i> <?php echo $heading;?></h3>
					</div>
					<div class="panel-body">
						<div class="row">
														
							<label class="form-control-label">Page Title</label>  
							<input type="text" name="title" id="title" class="form-control" placeholder="Title">  
							  
							<div id="gjs" style="height:0px; overflow:hidden; margin-top:30px;"></div>
							
						</div>
					</div>
				</section>

			</div>
		</section>
	<?php $this->load->view('part/js'); ?>


  
   

  </body>
</html>
