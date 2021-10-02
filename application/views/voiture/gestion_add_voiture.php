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
			<div class="iphorm-outer">
				<?php 
                    $attributes=array('class' => 'iphorm') ;
    			    echo form_open('voiture/gestion_add_voiture' , $attributes);
                ?>
	            <div class="iphorm-wrapper">
                    <div class="iphorm-inner">
                        <div class="iphorm-message"></div>
                        <div class="iphorm-container clearfix">
                            <!-- Begin immatriculation element -->
                            <div class="element-wrapper name-element-wrapper clearfix">
                                <?php 
                                    if(isset($error))
                                    {
                                        echo '<div class="error"><h3>'.$error.'</h3></div>';
                                    }
                                ?>
                                <label for="code_plaque">Immatriculation :</label>
                                <?php echo form_error('code_plaque','<span class="error">','</span>');?>
                                <div class="input-wrapper name-input-wrapper">
                                    <?php echo "<input class='name-element' id='code_plaque' type='text' name='code_plaque' >";?>
                                </div>
                            </div>
                            <!-- End immatriculation element -->
                            <!-- Begin modèle element -->
                            <div class="element-wrapper name-element-wrapper clearfix">
                                <label for="modele">Modèle :</label>
                                <?php echo form_error('modele','<span class="error">','</span>');?>
                                <div class="input-wrapper name-input-wrapper">
                                    <?php echo'<input class="name-element" id="modele" type="text" name="modele" >';?>
                                </div>
                            </div>
                            <!-- End modèle element -->
                            <!-- Begin commentaire element -->
                            <div class="element-wrapper name-element-wrapper clearfix">
                                <label for="commentaire">Commentaire :</label>
                                <?php echo form_error('commentaire','<span class="error">','</span>');?>
                                <div class="input-wrapper name-input-wrapper">
                                    <?php echo'<textarea class="name-element" id="commentaire" type="text" name="commentaire" ></textarea>';?>
                                </div>
                            </div>
                            <!-- End commentaire element -->
                            <!-- Begin Statut element -->
                            <div class="element-wrapper single_select-element-wrapper clearfix">
                                <label for="statut">Statut :</label>
                                <div class="input-wrapper single_select-input-wrapper clearfix">
                                    <select class="iphorm-tooltip" id="statut" name="statut" title="Selectionner votre statut">
                                       <option value="0">Indisponible</option>
                                       <option value="1">Disponible</option>
                                       <option value="2">Toujours réserver</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Statut element -->
                            <!-- Begin Service element -->
                            <div class="element-wrapper single_select-element-wrapper clearfix">
                                <label for="service">Service :</label>
                                <div class="input-wrapper single_select-input-wrapper clearfix">
                                    <select class="iphorm-tooltip" id="service" name="service" title="Selectionner votre service">
                                    <?php if(isset($results)):
                                            if($results != null):
                                                foreach($results as $r){
                                                    echo "<option value=".$r -> id.">".$r -> libelle."</option>" ;
                                                }
                                            endif;
                                        endif;?>
                                    </select>
                                </div>
                            </div>
                            <!-- End Service element -->
                            <!-- Begin Submit button -->
                            <div class="button-wrapper submit-button-wrapper clearfix">
                                <div class="loading-wrapper"><span class="loading">Please wait...</span></div>
                                <div class="button-input-wrapper submit-button-input-wrapper">
                                    <input class="ka-form-submit" type="submit" name="contact" value="Valider" /><br/>
                                </div>
                            </div>
                            <!-- End Submit button -->
                        </div>
	                </div>
	            </div>
                <?php echo form_close();?>
	            </form>
	        </div>
	   </div>
	</div><!-- end content -->
	<!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->
</div><!-- main-area -->