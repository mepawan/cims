<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php $this->load->view('part/head'); ?>
<body>
	<div class="contain_wrapper">
		<?php $this->load->view('part/header'); ?>
		<div class="wrapper">
			<main class="background_container">
				<section class="general-message ands_work">
					<div class="container">
						<div class="row">

							<section id="content">
								<div class="col-md-2 left-section ">
									<?php $this->load->view('part/user_left'); ?>
								</div>
								<div class="col-md-10 content-section">
										<?php if(isset($heading) && $heading){ ?>
											<span id="mm_title">
												<h2 class="title_s"> <?php echo $heading; ?></h2>
											</span>
										<?php } ?>
										<div class="content-wrap">
											<?php
												//print_r($conversation);
												
												if($conversation){
													$active_convs = '';
													$pending_convs = '';
													array_walk($conversation, function($conv) use(&$active_convs,&$pending_convs){
														//print_r($conv);
														if($conv['status'] == 'pending'){
															$pending_convs .= '<li><span class="pending-conv"> '.$conv['first_name'] . ' ' . $conv['last_name'].'</span>';
															$pending_convs .= '<a class="btn btn-danger deny-conv" href="'.ci_base_url().'customer/messages/cancel/'.$conv['id'].'">Cancel</a></li>';
														} else if($conv['status'] == 'active'){
															$active_convs .= '<li><a class="active-conv" href="#">'.$conv['first_name'] . ' ' . $conv['last_name'].'</a></li>';
														} 
													});
											?>
													<div class="active-conv-list-wrap">
														<h3> Active Conversations</h3>
														<?php
															if($active_convs){
																echo '<ul>';
																echo $active_convs;
																echo '</ul>';
															} else {
																echo 'There is no active conversations';
															}
														?>
													</div>
													<div class="active-conv-list-wrap">
														<h3> Conversation Pending Requests</h3>
														<?php
															if($pending_convs){
																echo '<ul>';
																echo $pending_convs;
																echo '</ul>';
															} else {
																echo 'There is no conversation requests';
															}
														?>
													</div>
											<?php
													if($active_convs){
														
													}
												} else {
													
												}
											?>
										</div>
								</div>
							</section>
							
						</div>
					</div>
				</section>
			</main>
		</div>
		<?php $this->load->view('part/footer'); ?>
	</div>


</body>
</html>
