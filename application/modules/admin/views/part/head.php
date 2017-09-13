<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php if(isset($ci_settings) && isset($ci_settings['site_name']) && $ci_settings['site_name']){ echo $ci_settings['site_name'];} else {  echo title(); }?></title>
    <meta name="keywords" content="<?php if(isset($meta_keywords)){ echo $meta_keywords; }?>"/>
    <meta name="description" content="<?php if(isset($meta_description)){ echo $meta_description; }?>">
    <meta name="author" content="<?php if(isset($meta_author)){ echo $meta_author; }?>">

    <link href="<?php echo ci_public('admin');?>img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="<?php echo ci_public('admin');?>img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="<?php echo ci_public('admin');?>img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="<?php echo ci_public('admin');?>img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="<?php echo ci_public('admin');?>img/favicon.png" rel="icon" type="image/png">
    <link href="favicon.ico" rel="shortcut icon">

    <!-- HTML5 shim and Respond.js for < IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Vendors Styles -->
    <!-- v1.0.0 -->
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/jscrollpane/style/jquery.jscrollpane.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/ladda/dist/ladda-themeless.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/cleanhtmlaudioplayer/src/player.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/cleanhtmlvideoplayer/src/player.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/bootstrap-sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/summernote/dist/summernote.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/ionrangeslider/css/ion.rangeSlider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/datatables/media/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>vendors/c3/c3.min.css">
    <link rel="stylesheet" type="text/css" href=".<?php echo ci_public('admin');?>vendors/chartist/dist/chartist.min.css">

    <!-- Clean UI Styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo ci_public('admin');?>css/source/main.css">
	<?php
		if(isset($add_recaptcha_js) && $add_recaptcha_js){
			echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
		}
	?>
	<script type="text/javascript">
		var ci_base_url = '<?php echo ci_base_url();?>';
	</script>
	</div>
    
</head>