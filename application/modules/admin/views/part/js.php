<script  src="<?php echo ci_public('admin');?>vendors/tether/dist/js/tether.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/jscrollpane/script/jquery.jscrollpane.min.js"></script>

<?php 
	if(isset($foot_views)){
		array_walk($foot_views, function($fv){
			$this->load->view($fv); 
		});
	}
	if(isset($foot_scripts)){
		array_walk($foot_scripts, function($fs){
			echo '<script type="text/javascript"  src="'.$fs.'"></script>';
		});
	}
		if(isset($datatable) && $datatable){
			echo '<script type="text/javascript"  src="'.ci_public("admin").'vendors/datatables/media/js/jquery.dataTables.min.js" ></script>';
			echo '<script type="text/javascript"  src="'.ci_public("admin").'vendors/datatables/media/js/dataTables.bootstrap4.min.js" ></script>';
			echo '<script type="text/javascript"  src="'.ci_public("admin").'vendors/datatables-fixedcolumns/js/dataTables.fixedColumns.js" ></script>';
			echo '<script type="text/javascript"  src="'.ci_public("admin").'vendors/datatables-responsive/js/dataTables.responsive.js" ></script>';
		}
?>

<script  src="<?php echo ci_public('admin');?>js/common.js"></script>



<?php /*
<!-- Vendors Scripts -->
<script  src="<?php echo ci_public('admin');?>vendors/tether/dist/js/tether.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/jquery-mousewheel/jquery.mousewheel.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/jscrollpane/script/jquery.jscrollpane.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/spin.js/spin.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/ladda/dist/ladda.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/select2/dist/js/select2.full.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/html5-form-validation/dist/jquery.validation.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/jquery-typeahead/dist/jquery.typeahead.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/autosize/dist/autosize.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/bootstrap-show-password/bootstrap-show-password.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/moment/min/moment.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/fullcalendar/dist/fullcalendar.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/cleanhtmlaudioplayer/src/jquery.cleanaudioplayer.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/cleanhtmlvideoplayer/src/jquery.cleanvideoplayer.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/summernote/dist/summernote.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/owl.carousel/dist/owl.carousel.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/ionrangeslider/js/ion.rangeSlider.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/nestable/jquery.nestable.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/datatables/media/js/jquery.dataTables.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/datatables/media/js/dataTables.bootstrap4.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/datatables-fixedcolumns/js/dataTables.fixedColumns.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/datatables-responsive/js/dataTables.responsive.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/editable-table/mindmup-editabletable.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/d3/d3.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/c3/c3.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/chartist/dist/chartist.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/peity/jquery.peity.min.js"></script>
<!-- v1.0.1 -->
<script  src="<?php echo ci_public('admin');?>vendors/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js"></script>
<!-- v1.1.1 -->
<script  src="<?php echo ci_public('admin');?>vendors/gsap/src/minified/TweenMax.min.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/hackertyper/hackertyper.js"></script>
<script  src="<?php echo ci_public('admin');?>vendors/jquery-countTo/jquery.countTo.js"></script>

<!-- Clean UI Scripts -->
<script  src="<?php echo ci_public('admin');?>js/common.js"></script>
<script  src="<?php echo ci_public('admin');?>js/demo.temp.js"></script>

*/ ?>