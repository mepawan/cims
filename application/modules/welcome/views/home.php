<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('head'); ?>
<body>
	<div class="contain_wrapper">
		<?php $this->load->view('header', $menus); ?>
		
		<?php print_r($page[0]['content']); ?>
  
		
		
		<?php $this->load->view('footer'); ?>
	</div>


</body>
</html>
