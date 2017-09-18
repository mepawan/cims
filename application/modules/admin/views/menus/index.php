<?php $this->load->view('part/head');?>

<body class="theme-dark">
<?php $this->load->view('/part/left_menu'); ?>
<?php $this->load->view('/part/top_menu'); ?>
<section class="page-content">
	<div class="page-content-inner">
		<section class="panel panel-with-borders">
			<div class="panel-heading">
				<div class="heading-buttons pull-right">
					<?php $this->pvngen->render_buttons();?>
				</div>
				<h3 class="messaging-title"><i class="left-menu-link-icon <?php echo $icon;?>"></i> <?php echo $heading;?></h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<table class="table table-striped table-hover" id="dt_<?php echo $entity;?>" cellspacing="0" width="100%">
						<thead>
							<tr>
								<?php $this->pvngen->render_tds();?>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</section>
		<?php
			if($this->pvngen->config['form_style'] != 'new_window'){
				$this->pvngen->rendar_forms_all();
			}
		?>
	</div> <!-- end .page-content-inner -->
<?php $this->load->view('part/js'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo ci_public();?>pvngen.css">
<!-- Page Scripts -->
<script type="text/javascript">
		var oTable;
		var entity = '<?php echo $this->pvngen->config['entity'];?>';
		var row_selection = '<?php echo isset($this->pvngen->config['row_selection'])? $this->pvngen->config['row_selection']:'yes';?>';
		jQuery(document).ready(function() {
			oTable = jQuery('#dt_'+entity).DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": ci_base_url + 'admin/' + entity +"/listdt",
				"columns": [
							<?php 
							
								foreach($this->pvngen->config['aColumns'] as  $f){  
									
									$visbl = '';
									if(isset($this->pvngen->config['fields'][$f]['invisible']) && $this->pvngen->config['fields'][$f]['invisible']){
										$visbl = ' ,"visible":false';
									}
									$render = '';
									if(isset($this->pvngen->config['fields'][$f]['dt_render_func']) && $this->pvngen->config['fields'][$f]['dt_render_func']){
										$render = ' ,"render":'.$this->pvngen->config['fields'][$f]['dt_render_func'];
									}
							?>
								{ "data": "<?php echo $f;?>" <?php echo $visbl;?> <?php echo $render; ?> },
							<?php } ?>
							<?php foreach(array_keys($this->pvngen->config['joins_keys']) as  $f){  ?>
								{ "data": "<?php echo $f;?>","visible": false},
							<?php } ?>
							
							{"data":null,  "orderable": false, "defaultContent":"<a href='#' class='menu-items'>Items</a>"}
						],
				"order": [[0, 'asc']],
				"initComplete": function(settings, json) {
						//jQuery.fn.dt_loaded();
						//alert('init');
					},
				"fnDrawCallback": function( oSettings ) {
						jQuery.fn.dt_loaded();
					}
			});
		});
</script>
<script src="<?php echo ci_public();?>pvngen.js"></script>
</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>




