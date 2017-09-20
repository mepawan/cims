
<?php $this->load->view('part/head');?>

<body class="theme-dark">

<section class="page-content">
<div class="page-content-inner" style="background-image: url(<?php echo ci_public('admin');?>img/temp/login/4.jpg)">

    <!-- Login Page -->
    <div class="single-page-block-header">
        <div class="row">
            <div class="col-lg-4">
                <div class="logo">
                    <a href="javascript: history.back();">
                        <img src="<?php echo ci_public('admin');?>img/logo.png" alt="<?php echo $ci_settings['site_name']; ?>" />
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="single-page-block-header-menu">
                    <ul class="list-unstyled list-inline">
                        <li><a href="javascript: void(0);">&larr; Back</a></li> <!-- history.back() -->
                        <li class="active"><a href="javascript: void(0);">Login</a></li>
                        <li><a href="javascript: void(0);">About</a></li>
                        <li><a href="javascript: void(0);">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="single-page-block">
		<div class="msg-wrap">
			<div class="error">
				<?php 	echo $this->ciauth->get_auth_error();
						echo form_error('email'); 
						echo form_error('g-recaptcha-response');
						if(isset($recaptcha_error) && $recaptcha_error){ echo $recaptcha_error; }
						if(isset($error) && $recaptcha_error){ echo $error; }
						echo $this->session->flashdata('error');
				 ?>
			</div>
			<div class="success">
				<?php  
					if(isset($success) && $success){ echo $success; }
					echo $this->session->flashdata('success');
				 ?>
			</div>
		</div>
        <div class="single-page-block-inner effect-3d-element">
            <div class="blur-placeholder"><!-- --></div>
            <div class="single-page-block-form">
                <h3 class="text-center">
                    <i class="icmn-lock3 margin-right-10"></i>
                    Forget Password
                </h3>
                <br />
                <form id="login-form" name="form-validation" method="POST">
                    <div class="form-group">
                        <input id="validation-email"
                               class="form-control"
                               placeholder="Email/Username/Phone"
                               name="loginkey"
                               type="text"
							   autocomplete="off"
                               data-validation="[MIXED, L>3]"
							   data-validation-message="Enter valid email/username/phone">
                    </div>
                    
					<div class="form-group">
                        <?php echo recaptcha_form();?>
                    </div>
                    <div class="form-group">
                        <a href="<?php echo ci_base_url();?>admin/auth" class="pull-right">Want to login?</a>
                        <div class="clearfix clear"></div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary width-150">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="single-page-block-footer text-center">
        <ul class="list-unstyled list-inline">
            <li><a href="javascript: void(0);">Terms of Use</a></li>
            <li class="active"><a href="javascript: void(0);">Compliance</a></li>
            <li><a href="javascript: void(0);">Confidential Information</a></li>
            <li><a href="javascript: void(0);">Support</a></li>
            <li><a href="javascript: void(0);">Contacts</a></li>
        </ul>
    </div>
    <!-- End Login Page -->

</div>


<?php $this->load->view('part/js'); ?>

<!-- Page Scripts -->
<script>
    $(function() {
		
        
		$('#login-form').submit(function(e){
			e.preventDefault();
			jQuery.post(ci_base_url+'admin/auth/login',jQuery(this).serialize(),function(resp){
				
			},'json');
			return false;
		});
		
		// Form Validation
        $('#login-form').validate({
            submit: {
                settings: {
                    inputContainer: '.form-group',
                    errorListClass: 'form-control-error',
                    errorClass: 'has-danger'
                }
            }
        });

        // Show/Hide Password
        $('.password').password({
            eyeClass: '',
            eyeOpenClass: 'icmn-eye',
            eyeCloseClass: 'icmn-eye-blocked'
        });

        // Add class to body for change layout settings
        $('body').addClass('single-page single-page-inverse');

        // Set Background Image for Form Block
        function setImage() {
            var imgUrl = $('.page-content-inner').css('background-image');

            $('.blur-placeholder').css('background-image', imgUrl);
        };

        function changeImgPositon() {
            var width = $(window).width(),
                    height = $(window).height(),
                    left = - (width - $('.single-page-block-inner').outerWidth()) / 2,
                    top = - (height - $('.single-page-block-inner').outerHeight()) / 2;


            $('.blur-placeholder').css({
                width: width,
                height: height,
                left: left,
                top: top
            });
        };

        setImage();
        changeImgPositon();

        $(window).on('resize', function(){
            changeImgPositon();
        });

        // Mouse Move 3d Effect
        var rotation = function(e){
            var perX = (e.clientX/$(window).width())-0.5;
            var perY = (e.clientY/$(window).height())-0.5;
            TweenMax.to(".effect-3d-element", 0.4, { rotationY:15*perX, rotationX:15*perY,  ease:Linear.easeNone, transformPerspective:1000, transformOrigin:"center" })
        };

        if (!cleanUI.hasTouch) {
            $('body').mousemove(rotation);
        }

    });
</script>
<!-- End Page Scripts -->
</section>

<div class="main-backdrop"><!-- --></div>

</body>
</html>
