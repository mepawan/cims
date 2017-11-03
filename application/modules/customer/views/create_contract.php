<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 
	//echo "<pre>"; print_r($category); die;
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
											<div class="col-sm-2"></div>
											<div class="create_contract col-sm-8">
											<?php 
												if($step == 1){
											?>
													<h3>Select a Category Below to Get Started</h3>
													<div class="cats-list">
														<ul>
														<?php foreach($categories as $category){ ?>
															<li>
																<a href="<?php echo ci_base_url();?>customer/create_contract/<?php echo $category['id']; ?>"><?php echo $category['title']; ?></a>
															</li>
														<?php } ?>
														</ul>
													</div>
											<?php 
												} else  if($step == 2){
											?>
													<h3>Get Matched to Top-Rated <?php echo $parent['title'] ?></h3>
													<div class="cats-list">
														<ul>
															<?php foreach($categories as $category){ ?>
																<li>
																	<a href="<?php echo ci_base_url();?>customer/create_contract/<?php echo $parent['id'];?>/<?php echo $category['id']; ?>"><?php echo $category['title']; ?></a>
																</li>
															<?php } ?>
														</ul>
													</div>
											<?php } else  if($step == 3){ ?>
													<div class="cat-hierarchy">
														<ul>
															<li><a href="<?php echo ci_base_url();?>customer/create_contract"> Start Here</a></li> 
															<li class="devider"> &gt;&gt;</li>
															<li><a href="<?php echo ci_base_url();?>customer/create_contract/<?php echo $parent['id'];?>"> <?php echo $parent['title'];?> </a></li>
															<?php 
																if(isset($sub_category) && $sub_category){
															?>
																<li class="devider"> &gt;&gt;</li>
																<li><a href="<?php echo ci_base_url();?>customer/create_contract/<?php echo $parent['id'];?>/<?php echo $sub_category['id'];?>"> <?php echo $sub_category['title'];?> </a></li>
															<?php } ?>
															<li class="clearfix"></li>
														</ul>
													</div>
											
													<?php if(isset($status) && $status == 'fail'){   ?>
															<div class="error"> <?php echo $msg; ?> </div>
													<?php 
														} 
														if(isset($status) && $status == 'success'){   ?>
															<div class="success"> <?php echo $msg; ?> </div>
													<?php }  ?> 
													
													
													<form method="post" name="form-validation" id="frm-create-contract" enctype="multipart/form-data">
														<input type="hidden" name="category" value="<?php if(isset($sub_category) && $sub_category) { echo $sub_category['id']; } else { echo $parent['id'];}?>" />
														
														<div class="form-group">
															<label for="area_of_experience" class="form-label col-sm-4">Title</label>
															<div  class="col-sm-8">
																<input required type="text"  name="title" placeholder="Title" />
															</div>
														</div>
														<div class="form-group">
															<label for="area_of_experience" class="form-label col-sm-4">Area of Experience</label>
															<div  class="col-sm-8">
																<select name="area_of_experience" >
																  <option value="ability_to_work_under_pressure" >Ability to work under pressure</option>
																  <option value="adaptability" >Adaptability</option>
																  <option value="administering_medication">Administering medication</option>
																  <option value="advising_people" >Advising people</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label for="years_of_experience" class="form-label col-sm-4">Number of Years of Experience</label>
															<div class="col-sm-8">
																<select name="years_of_experience" >
																  <option value="0-5" >0-5</option>
																  <option value="5-10" >5-10</option>
																  <option value="10-15">10-15</option>
																  <option value="15-20" >15-20</option>
																</select>
															</div>
														</div>
														<div class="form-actions text-center col-md-12">
															<button class="btn btn-primary width-150" type="submit">Create Contract</button>
														</div>
													</form>
											<?php }?>
											</div>
											
											<div class="col-sm-2"></div>
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
