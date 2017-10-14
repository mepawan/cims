<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	//echo "<pre>"; print_r($users); die;
?>
<?php $this->load->view('part/head'); ?>
<body>
	<div class="contain_wrapper">
		<?php $this->load->view('part/header'); ?>
		
		<?php print_r($page[0]['content']); ?>
  
		<div class="wrapper">
			<main class="background_container">
				<section class="general-message ands_work">
					<div class="container">
						<div class="row">
							
							<section id="content" >
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
												<?php if(isset($status) && $status == 'fail'){   ?>
														<div class="error">
															<?php echo $msg; ?>
														</div>
												<?php } ?>
												
												<?php if(isset($status) && $status == 'success'){   ?>
														<div class="success">
															<?php echo $msg; ?>
														</div>
												<?php }  ?> 
												
												<div class="">
													<a class="btn btn-warning pull-right" href="<?php echo ci_base_url();?>customer/create_contract"> Create Contract </a>
													<div class="clearfix"></div>
												</div>
												<div class="col-sm-1"></div>
												<div class="all_contracts col-sm-10">
													<table class="contracts-tbl" >
														<tr>
															<th>Date</th>
															<th>Contract </th>
															<th>Area of Experience</th>
															<th>Years of Experience</th>
														</tr>
													<?php foreach($contracts as $contract){ ?>
														<tr>
															<td><?php echo  date('M d, Y', strtotime($contract['created_date'])); ?></td>
															<td><a href="<?php echo ci_base_url();?>customer/contracts/<?php echo $contract['id']; ?>"><?php echo  $contract['title']; ?></a></td>
															<td><?php echo ucwords(str_replace("_"," ",$contract['area_of_experience']));?></td>
															<td><?php echo $contract['years_of_experience'];?> years</td>
														</tr>
													<?php } ?>
													</table>
												</div>
												<div class="col-sm-1"></div>
												<div class="clearfix"></div>

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
