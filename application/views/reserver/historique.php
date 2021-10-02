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
<!-- ***************** - START Content - ***************** -->
<script>$(document).ready(function() {
	$('#example').dataTable();} );
</script>
<div class="CSSTableGenerator" >
	<table class="table" id="example">
		<thead>
			<tr>
				<th >Date début :</th>
				<th >Date fin :</th>
				<th >utilisateur :</th>
				<th >Voiture :</th>
				<th >Statut</th>
				<th >Destination :</th>
				<th >Annuler :</th>
			</tr>
		</thead>
		<?php
		if(count($results) > 0){
			foreach ($results as $r) {
				echo "
					<tr>
						<td>".$r->dte_debut."</td>
						<td>".$r->dte_fin."</td>
						<td>".$r->nom." ".$r->prenom."</td>
						<td>".$r->code_plaque."_".$r->modele."</td>";
				if($r->statut == 1)
				{
					echo "<td> en cours </td>";
				}
				else
				{
					echo "<td> terminer </td>";
				}
				echo "<td>".$r->destination."</td>
						<td>
						".anchor('reserver/annuler_reservation/'.$r->id, '<span>Annuler</span>', 'class="ka_button small_button small_fire"')
						."</td>
					</tr>";
			}
		}
		
		?>
	</table>
	
