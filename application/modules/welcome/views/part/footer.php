<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer id="footer-Primary">


  <section class="ftr_mid">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h4>Privacy Policy</h4>
        </div>
      </div>
    </div>
  </section>
  <!--ftr_mid-->
  
  
  <section class="ftr_bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p>© 2016 · Hands across Hands, LLC. </p>
        <ul>
          <li><a href="">Privacy Policy</a></li>
          <li><a href="">Terms and Conditions</a></li>
          <li><a href="">Refund Policy</a></li>
          <li><a href="">Pricing</a></li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!--ftr_bottom-->
  

  <div class="contact_page_btn"> <a id="to-top" class="hb-pop-class"><i class="hb-moon-arrow-up-4"></i></a>
  <a id="contact-button" class=""><i class="hb-moon-envelop"></i></a>
    <aside id="contact-panel" >
      <h4 class="hb-focus-color">Contact Us</h4>
      <p>We're currently offline. Send us an email and we'll get back to you, asap.</p>
      <form id="contact-panel-form" novalidate>
        <span>
          <input placeholder="Name" name="hb_contact_name" id="hb_contact_name_id" class="required requiredField error" tabindex="33" type="text">
        </span>
        <span>
          <input placeholder="Email" name="hb_contact_email" id="hb_contact_email_id" class="required requiredField error" tabindex="34" type="email">
        </span>
        <span>
          <input placeholder="Subject" name="hb_contact_subject" id="hb_contact_subject_id" type="text">
        </span>
        <span>
          <textarea placeholder="Your message..." name="hb_contact_message" id="hb_contact_message_id" class="required requiredField error" tabindex="35"></textarea>
          
        </span>
       
       <span class="send_btn"><input name="" type="submit" value="Send Message"></span>

      </form>
    </aside>
    </div>
    
</footer>
<script src="<?php echo ci_public('front'); ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo ci_public('front'); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo ci_public('front'); ?>js/script.js"></script>
<script src="<?php echo ci_public('front'); ?>js/respond.min.js"></script>

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

