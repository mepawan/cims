<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->view('part/head'); ?>
<body>
	<div class="contain_wrapper">
		<?php $this->load->view('part/header', $menus); ?>
		
		<div class="dynamic-content">
			<?php print_r($page[0]['content']); ?>
		</div>
		
		
		<?php $this->load->view('part/footer'); ?>
	</div>

<style><?php print_r($page[0]['content_css']); ?></style>
</body>
</html>
