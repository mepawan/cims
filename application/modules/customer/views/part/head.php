<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head lang="en">
<?php 
	global $ci_settings;
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php if(isset($ci_settings) && isset($ci_settings['site_name']) && $ci_settings['site_name']){ echo $ci_settings['site_name'];} else {  echo title(); }?></title>
    <meta name="keywords" content="<?php if(isset($meta_keywords)){ echo $meta_keywords; }?>"/>
    <meta name="description" content="<?php if(isset($meta_description)){ echo $meta_description; }?>">
    <meta name="author" content="<?php if(isset($meta_author)){ echo $meta_author; }?>">
	<link href="<?php echo ci_base_url();?>favicon.ico" rel="shortcut icon">
	
	<link href="<?php echo ci_public('front'); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo ci_public('front'); ?>css/style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo ci_public('front'); ?>css/responsive.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="<?php echo ci_public('front'); ?>css/font-awesome.min.css">
	<?php /*<script src="<?php echo ci_public('front'); ?>js/jquery-1.12.4.min.js"></script>*/ ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<script type="text/javascript">
		var ci_base_url = '<?php echo ci_base_url();?>';
	</script>
<?php
	if(isset($head_views)){
			array_walk($head_views, function($hv){
				$this->load->view($hv); 
			});
		}
		if(isset($head_styles)){
			array_walk($head_styles, function($hs){
				echo '<link rel="stylesheet" type="text/css" href="'.$hs.'">';
			});
		}
		if(isset($datatable) && $datatable){
			echo '<link rel="stylesheet" type="text/css" href="'.ci_public("admin").'vendors/datatables/media/css/dataTables.bootstrap4.min.css" >';
		}
		if(isset($add_recaptcha_js) && $add_recaptcha_js){
			echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
		}

?>


<!-- Bootstrap core CSS -->
<!-- Custom styles for this template -->

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="<?php echo ci_public('front'); ?>js/html5shiv.js"></script>
        <script src="<?php echo ci_public('front'); ?>js/respond.min.js"></script>
    <![endif]-->
</head>
