<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style><?php print_r($page[0]['content_css']); ?></style>
<?php $this->load->view('head'); ?>
<body>
	<div class="contain_wrapper">
		<?php $this->load->view('header'); ?>
		
		<div class="wrapper">
		  <main class="background_container">
			<section class="banner_inner">
			  <div class="container">
				<div class="row">
				  <div class="col-md-12">
					<h2> <?php print_r($page[0]['title']); ?> </h2>
				  </div>
				</div>
			  </div>
			</section><!--banner_inner-->

			<section class="inner_con">
			  <div class="container">
				<div class="row">
			<div class="col-md-4 col-sm-4">
				<div class="left_bar">
				<h4>Categories</h4>
					<ul>
							<li class="cat-item cat-item-3"><a href="http://handsacrosshands.com/index.php/category/design/">Design</a>
						</li>
							<li class="cat-item cat-item-4"><a href="http://handsacrosshands.com/index.php/category/lifestyle/">Lifestyle</a>
						</li>
							<li class="cat-item cat-item-5"><a href="http://handsacrosshands.com/index.php/category/modern/">Modern</a>
						</li>
							<li class="cat-item cat-item-6"><a href="http://handsacrosshands.com/index.php/category/nature/">Nature</a>
						</li>
							<li class="cat-item cat-item-7"><a href="http://handsacrosshands.com/index.php/category/photography/">Photography</a>
						</li>
							<li class="cat-item cat-item-8"><a href="http://handsacrosshands.com/index.php/category/technology/">Technology</a>
						</li>
							<li class="cat-item cat-item-9"><a href="http://handsacrosshands.com/index.php/category/travel/">Travel</a>
						</li>
							<li class="cat-item cat-item-1"><a href="http://handsacrosshands.com/index.php/category/uncategorized/">Uncategorized</a>
						</li>
					</ul>
				</div>

			</div>

			<div class="col-md-8 col-sm-8 right_bar">
					<?php print_r($page[0]['content']); ?>
			</div>


				</div>
			  </div>
			</section><!--inner_con-->
		
		<h2></h2>
		<p></p>
		<?php //echo "<pre>"; print_r($page); die; ?>
		
		
		<?php $this->load->view('footer'); ?>
	</div>


</body>
</html>
