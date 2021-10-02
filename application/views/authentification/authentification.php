<!-- ***************** - START Title Bar - ***************** -->
<div class="tools">
	<div class="holder">
		<div class="frame">
			<h1><?php echo $titre ;?></h1>
		</div><!-- end frame -->
	</div><!-- end holder -->
</div><!-- end tools -->
<!-- ***************** - END Title Bar - ***************** -->
<div class="main-holder">
<!-- ***************** - START Content - ***************** -->
	<div id="content" class="content_full_width">
		<div class="one_third"></div>
		<div class="one_third">
			<?php 
				if(isset($error))
				{
      				echo '<div class="error">'.$error.'</div>';
     			}
				$attributes = array('class'=>'ka-form', 'id'=>'identification');
				echo form_open('authentification' , $attributes);
			?>							
			<p class="comment-input-wrap">
				<label for="pseudo" class="comment-form">Identifiant :</label><br/>
				<?php echo form_error('pseudo','<span class="error">','</span>');?>
				<input type="text" class="comment-input"  id="pseudo" name="pseudo"><br/>

				<label for="pass" class="comment-form">Mot de passe :</label><br/>
				<?php echo form_error('pass','<span class="error">','</span>');?>
				<input type="password" class="comment-input comment-password" id="pass" name="pass" ><br/>
			</p><br/>
			<input type="submit"   id="ka-submit" value="Connexion">
			<?php echo form_close(); ?>						
		</div><!-- end one_third -->
		<br class="clear" />
		<div class="one_fourth"></div>
		<div class="one_fourth">
			<?php
				$attributes = array('class' => 'ka_button small_button small_golden', 'style' =>'opacity: 1;');
				echo anchor('authentification/inscription','<span>M\'inscrire</span>',$attributes)."<br/>" ;
				?>
		</div>
		<div class="one_fourth">
			<?php
			$attributes = array('class' => 'ka_button small_button small_golden', 'style' =>'opacity: 1;');
			echo anchor('authentification/oublie','<span>Mot de passe oublié?</span>',$attributes) ;?>
		</div>
		<?php echo anchor('demande','<span>Demande de création de service</span>',$attributes)."<br/>" ;?>
	</div><!-- end content -->
	<!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->
	
