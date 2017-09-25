<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<header id="header" class="background_header">
	<section class="header_top">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="top_login"> 
						<a href="#">Login</a>
						<div class="log_form">
							<form id="frm-top-login" action="#">
								<input required name="loginkey" type="text" placeholder="Username/Email/Phone" />
								<input required name="password" type="password" placeholder="Password" />
								<p>
									<input name="remember" id="remember" class="hb-remember-checkbox" type="checkbox" />
									Remember me?
								</p>
								<input name="submit" type="submit" value="login">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
  <!--header_top-->
  
  <section class="header_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="logo"><a href="<?php echo ci_base_url();?>"><img src="<?php echo ci_public('front'); ?>images/logo.png"></a></div>
          <nav id="nav-primary">
            <div class="small_logo"><img src="<?php echo ci_public('front/images'); ?>logo.png"></div>
            <div class="togglebutton">
              <button class="btn-open">&nbsp;</button>
            </div>
            
            <?php $this->load->view('menu', $menus); ?>
            
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--header_bottom--> 
</header>
