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
<?php echo anchor('utilisateur/gestion_add_user', '<span>Ajouter utilisateur</span>', 'aligne="center" class="ka_button small_button small_coolblue" id="test"'); ?>
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
				<th >Nom :</th>
				<th >Prénom :</th>
				<th>Login :</th>
				<th >Service :</th>
				<th >Compte :</th>
				<th >Changement de niveau</th>
				<th >Modifier :</th>
				<th >Supprimer :</th>
			</tr>
		</thead>
		<?php
			if(count($results) > 0)
			{
				foreach ($results as $r) 
				{
					echo "
						<tr>
							<td>".$r->nom."</td>
							<td>".$r->prenom."</td>
							<td>".$r->login."</td>
							<td>".$r->libelle."</td>";
					if($r->compte == 1)
					{
						echo "<td>utilisateur</td>";
						echo "<td>".anchor('utilisateur/admin_compte/'.$r->id, '<span>Administrateur</span>', 'class="ka_button small_button small_coolblue"')."</td>";
					}
					if($r->compte == 2 OR $r->compte == 3)
					{
						echo "<td>administrateur</td>";
						echo "<td>".anchor('utilisateur/activer_compte/'.$r->id, '<span>Utilisateur</span>', 'class="ka_button small_button small_coolblue"')."</td>";
					}					
					echo"	<td>".anchor('utilisateur/modifier_compte/'.$r->id, '<span>Modifier</span>', 'class="ka_button small_button small_periwinkle"')."</td>
							<td>".anchor('utilisateur/supprimer_compte/'.$r->id, '<span>Supprimer</span>', 'class="ka_button small_button small_coolblue"')."</td>
						</tr>";
				}
			}
		?>
	</table>
<!--</div>-->
<!--</div>-->
<!-- ***************** - END content - ***************** -->
<!--</div> end main-holder -->
	
