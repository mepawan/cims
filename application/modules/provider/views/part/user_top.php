<?php 
$user = $this->ciauth->get_user();
$provider_profile = $this->Util_model->read('provider_profile',array('where' => array('uid'=>$this->ciauth->get_user_id())));
$profile = ($provider_profile)?$provider_profile[0]:'';
?>

<h3><?php echo $user['first_name']." ".$user['last_name']; ?>( <?php echo $profile['years_of_experience']; ?> Year Experience)</h3>
<div class="services">
<?php if($profile) { $area_of_experience = explode(',', $profile['area_of_experience']); 
	
	foreach($area_of_experience as $area_of_experience){
			echo "<span>".str_replace("_", " ", $area_of_experience)."</span>";
		}
	
	} ?>
</div>
