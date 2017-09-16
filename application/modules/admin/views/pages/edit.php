<?php $this->load->view('part/head');?>
<body class="theme-dark">
		<?php $this->load->view('/part/left_menu'); ?>
		<?php $this->load->view('/part/top_menu'); ?>
		
		<section class="page-content">
			<div class="page-content-inner">
				<section class="panel panel-with-borders">
					<div class="panel-heading">
						<div class="heading-buttons pull-right">
							<a href="<?php echo ci_base_url();?>preview/<?php echo $page[0]['alias']; ?>" class="btn btn-success margin-inline">Preview</a>
							<a href="<?php echo ci_base_url();?>pages/add" class="btn btn-success margin-inline update-button">Update</a>
						</div>
						<h3 class="messaging-title"><i class="left-menu-link-icon <?php echo $icon;?>"></i> <?php echo $heading;?></h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<form>
								<div class="col-lg-12">
									<div class="form-group">
										<label for="title"><h4>Page Title</h4></label>
										<input required type="text" name="title" id="title" class="form-control" placeholder="Page Title" value="<?php echo $page[0]['title']; ?>" /> 
									</div>
									<div class="form-group page-content-wrap">
										<label for="gjs"><h4>Page Content</h4></label>
										<div id="gjs" style="height:0px; overflow:hidden; margin-top:30px;"> <?php echo $page[0]['content']; ?>
											<style><?php echo $page[0]['content_css']; ?></style>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>

			</div>
		</section>
		<?php $this->load->view('part/js'); ?>
		
  </body>
</html>
