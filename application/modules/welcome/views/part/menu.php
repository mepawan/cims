<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<ul class="menu">
  <?php 
	$menus = get_menu_items('main_menu');
	foreach($menus as $menu){ 
		//echo "<pre>"; print_r($menu); die; 
		echo ' <li><a href="'.ci_base_url().$menu['url'].'"><span>'.$menu['title'].'</span></a></li>';
		} 
	 ?>
  <li><a class="srh_icon" href="#">search</a></li>
  <li><a class="tog_icon" href="#">dropdown</a></li>
</ul>

  <div class="side_navigation">
      <a class="tog_icon_cross" href="#">X</a>
      <h4>menu</h4>
      <ul>
      	<li class="selected"><a href="">How It Works</a></li>
      	<li><a href="">Sign Up</a></li>
      	<li><a href="">Our Story</a></li>
      	<li><a href="">Contact</a></li>
      	<li><a href="">Sign In</a></li>
      	<li><a href="">Customer Sign In</a></li>
      	<li><a href="">Provider Sign In</a></li>
      	<li><a href="">404 Page</a></li>
      </ul>

      </div>
