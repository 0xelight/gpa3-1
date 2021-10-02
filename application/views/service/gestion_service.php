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
				<th >Statut :</th>
				<th >REGATE :</th>
				<th >Option registre :</th>
				<th >Modifier :</th>
				<th >Désactiver/ Activer :</th>
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
							<td>".anchor('service/modifier_service/'.$r->id, '<span>Modifier</span>', 'class="ka_button small_button small_periwinkle"')."</td>";
					if($r->statut == 1){
						echo"<td>".anchor('service/desactiver/'.$r->id, '<span>Désactiver</span>', 'class="ka_button small_button small_coolblue"')."</td>";
					}
					if($r->statut ==0){
						echo"<td>".anchor('service/activer/'.$r->id, '<span>Activer</span>', 'class="ka_button small_button small_coolblue"')."</td>";
					}
					"</tr>";
				}
			}
		?>
	</table>
<!--</div>-->
<!--</div>-->
<!-- ***************** - END content - ***************** -->
<!--</div> end main-holder -->
	
