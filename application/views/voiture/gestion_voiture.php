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
<?php echo anchor('voiture/gestion_add_voiture', '<span>Ajouter voiture</span>', 'aligne="center" class="ka_button small_button small_coolblue" id="test"'); ?>
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
				<th >Immatriculation:</th>
				<th >Modèle:</th>
				<th >Commentaire:</th>
				<th >Service:</th>
				<th >Statut:</th>
				<th >Disponible en journée: </th>
				<th >Modifier:</th>
				<th >Supprimer:</th>
			</tr>			
		</thead>
		<?php
			if(count($results) > 0){
				foreach ($results as $r) {
					echo "
						<tr>
							<td>".$r->code_plaque."</td>
							<td>".$r->modele."</td>
							<td>".$r->commentaire."</td>
							<td>".$r->libelle."</td>";
					
					if($r->statut == 1)
					{
						echo "<td> Disponible</td>";
					}
					if($r->statut == 0)
					{
						echo "<td> Indisponible</td>";
					}
					if($r->statut == 2)
					{
						echo "<td> Toujours réservé</td>";
					}
					if($r->disponible_journee == 0 and $r->statut == 2 or $r->statut == 0)
					{
						echo "<td> non</td>";
					}
					if($r->disponible_journee == 1 or $r->statut == 1 )
					{
						echo "<td> oui</td>";
					}
					echo "	<td>".anchor('voiture/gestion_modifier_voiture/'.$r->id, '<span>Modifier</span>', 'class="ka_button small_button small_periwinkle" id="test"')."</td>
							<td>".anchor('voiture/supprimer_voiture/'.$r->id, '<span>Supprimer</span>', 'class="ka_button small_button small_coolblue" id="test"')."</td>
						</tr>";
				}
			}
		?>
	</table>
	
