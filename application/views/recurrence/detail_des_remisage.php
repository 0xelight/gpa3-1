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
		<div>
			<?php 
			foreach($results as $r)
			{
				echo $r->contenu;
				$id[] = $r->id;
				echo anchor('reserver/remisage_pdf/'.$r->id, '<span>PDF</span>', 'class="ka_button small_button small_coolblue" id="test" target="_blank"');
				//$date_creation = $r->date_creation;
			}
			//var_dump($results);
			
            echo "<br/>".anchor('recurrence/valider_remisage/'.$results[0]->date_creation, '<span>Signer les bons</span>', 'class="ka_button small_button small_coolblue" id="test"');
            
            ?>
		</div><!-- end one_third -->
	</div><!-- end content -->
</div><!-- end main-holder -->
