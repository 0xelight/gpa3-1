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
		<div id="content" class="content_full_width">
		</div>
		<div class="CSSTableGenerator" >
			<table>
				<thead>
					<tr>
						<th >Date Début :</th>
						<th >Date Fin :</th>
						<th>Utilisateur :</th>
						<th >Voiture :</th>
						<th >Supprimer :</th>
					</tr>
				</thead>
				<?php
					if(count($result) > 0)
					{
						foreach ($result as $r) 
						{
							echo "
								<tr>
									<td>".$r->dte_debut."</td>
									<td>".$r->dte_fin."</td>
									<td>".$r->login."</td>
									<td>".$r->code_plaque." ".$r->modele."</td>
									<td>
									".anchor('reserver/annuler_reservation/'.$r->id, '<span>Supprimer</span>', 'class="ka_button small_button small_cherry" id="test"')
									."</td>
								</tr>";
						}
					}
				?>
			</table>
		</div>
	</div><!-- end content -->
	<!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->
