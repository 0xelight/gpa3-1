<!--<div class="main-area">-->
<!-- ***************** - START Title Bar - ***************** -->
<div class="tools">
	<div class="holder">
		<div class="frame">
			<h1><?php echo $titre ;?></h1>
		</div><!-- end frame -->
	</div><!-- end holder -->
</div><!-- end tools -->
</div>
<!-- ***************** - END Title Bar - ***************** -->
<!--<div class="main-holder">-->
<!-- ***************** - START Content - ***************** -->
<!--<div id="content" class="content_full_width">-->
<?php echo anchor('service/add_service', '<span>Ajouter service</span>', 'aligne="center" class="ka_button small_button small_coolblue" id="test"'); ?>
<script>
	$(document).ready(function() {
		$('#example').dataTable();
	});
</script>
<?php 
    if(isset($error))
    {
        echo '<div class="error"><h3>'.$error.'</h3></div>';
    }
?>
<div class="CSSTableGenerator" >
	<table class="table" id="example">
		<thead>
			<tr>
				<th >Libelle :</th>
				<th >statut :</th>
				<th >REGATE :</th>
				<th >Option registre :</th>
				<th >Nom :</th>
				<th >Prenom :</th>
				<th >Identifiant :</th>
				<th >Mail :</th>
				<th >Valider :</th>
			</tr>
		</thead>
		<?php
			if(count($results) > 0)
			{
				foreach ($results as $r) 
				{
					echo "
						<tr>
							<td>".$r->libelle."</td>
							<td>".$r->statut."</td>
							<td>".$r->REGATE."</td>
							<td>".$r->option_registre."</td>
							<td>".$r->nom."</td>
							<td>".$r->prenom."</td>
							<td>".$r->login."</td>
							<td>".$r->mail."</td>
							<td>".anchor('demande/valider/'.$r->id, '<span>Valider</span>', 'class="ka_button small_button small_periwinkle"')."</td>
						</tr>";
				}
			}
		?>
	</table>
<!--</div>-->
<!--</div>-->
<!-- ***************** - END content - ***************** -->
<!--</div> end main-holder -->
	
