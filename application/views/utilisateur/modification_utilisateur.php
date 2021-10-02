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
		<style>
		  #id{display:none;}
		</style>
		<div class="iphorm-outer">
			<?php 
                $attributes=array('class' => 'iphorm') ;
				echo form_open('utilisateur/modifier_compte/'.$result[0]->id , $attributes);
            ?>
            <div class="iphorm-wrapper">
                <div class="iphorm-inner">
                    <div class="iphorm-message"></div>
                    <div class="iphorm-container clearfix">
                        <!-- Begin Name element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <?php 
                                if(isset($error))
                                {
                                    echo '<div class="error"><h3>'.$error.'</h3></div>';
                                }
                            ?>
                            <label for="nom">Nom :</label>
                            <?php echo form_error('nom','<span class="error">','</span>');?>
                            <?php echo "<input id='id' name='id' value=".$result[0]->id.">";?>
                            <div class="input-wrapper name-input-wrapper">
                                <?php echo "<input class='name-element' id='nom' type='text' name='nom' value=".$result[0]->nom.">";?>
                            </div>
                        </div>
                        <!-- End Name element -->
                        <!-- Begin Prenom element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="prenom">Prénom :</label>
                            <?php echo form_error('prenom','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <?php echo'<input class="name-element" id="prenom" type="text" name="prenom" value='.$result[0]->prenom.'>';?>
                            </div>
                        </div>
                        <!-- End Prenom element -->
                        <!-- Begin pseudo element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="pseudo">Pseudo :</label>
                            <?php echo form_error('pseudo','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <?php echo'<input class="name-element" id="pseudo" type="text" name="pseudo" value='.$result[0]->login.'>';?>
                            </div>
                        </div>
                        <!-- End pseudo element -->
                        <!-- Begin Email element -->
                        <div class="element-wrapper email-element-wrapper clearfix">
                            <label for="email">Email :</label>
                            <?php echo form_error('email','<span class="error">','</span>');?>
                            <div class="input-wrapper email-input-wrapper">
                                <?php echo'<input class="email-element" id="email" type="text" name="email" value='.$result[0]->mail.'>';?>
                            </div>
                        </div>
                        <!-- End Email element -->

                        <!-- Begin Téléphone element -->
                        <div class="element-wrapper telephone-element-wrapper clearfix">
                            <label for="telephone">Téléphone :</label>
                            <?php echo form_error('telephone','<span class="error">','</span>');?>
                            <div class="input-wrapper telephone-input-wrapper">
                                <?php echo'<input class="telephone-element" id="telephone" type="text" name="telephone" value='.$result[0]->telephone.'>';?>
                            </div>
                        </div>
                        <!-- End Téléphone element -->
                        <!-- Begin Adresse element -->
                        <div class="element-wrapper adresse-element-wrapper clearfix">
                            <label for="adresse">Adresse :</label>
                            <?php echo form_error('adresse','<span class="error">','</span>');?>
                            <div class="input-wrapper adresse-input-wrapper">
                                <?php echo'<textarea class="name-element" id="adresse" type="text" name="adresse" >'.$result[0]->adresse.'</textarea>';?>
                            </div>
                        </div>
                        <!-- End Adresse element -->
                        <!-- Begin Ville element -->
                        <div class="element-wrapper ville-element-wrapper clearfix">
                            <label for="ville">Ville :</label>
                            <?php echo form_error('ville','<span class="error">','</span>');?>
                            <div class="input-wrapper ville-input-wrapper">
                                <?php echo'<input class="ville-element" id="ville" type="text" name="ville" value='.$result[0]->ville.'>';?>
                            </div>
                        </div>
                        <!-- End Ville element -->
                        <!-- Begin Code Postale element -->
                        <div class="element-wrapper CP-element-wrapper clearfix">
                            <label for="CP">Code Postale :</label>
                            <?php echo form_error('CP','<span class="error">','</span>');?>
                            <div class="input-wrapper CP-input-wrapper">
                                <?php echo'<input class="CP-element" id="CP" type="text" name="CP" value='.$result[0]->CP.'>';?>
                            </div>
                        </div>
                        <!-- End Code Postale element -->
                        <!-- Begin Distance travail/domicile element -->
                        <div class="element-wrapper distance-element-wrapper clearfix">
                            <label for="distance">Distance travail/domicile :</label>
                            <?php echo form_error('distance','<span class="error">','</span>');?>
                            <div class="input-wrapper distance-input-wrapper">
                                <?php echo'<input class="distance-element" id="distance" type="text" name="distance" value='.$result[0]->distance_domicile.'>';?>
                            </div>
                        </div>
                        <!-- End Distance travail/domicile element -->
                        <!-- Begin Service element -->
                        <div class="element-wrapper single_select-element-wrapper clearfix">
                            <label for="service">Service :</label>
                            <div class="input-wrapper single_select-input-wrapper clearfix">
                                <select class="iphorm-tooltip" id="service" name="service" title="Selectionner votre service">
                                   <?php if(isset($results)):
                                   echo "<option value=".$result[0] ->service.">".$result[0] ->libelle."</option>";
										if($results != null):
											foreach($results as $r){
												echo "<option value=".$r ->id.">".$r ->libelle."</option>" ;
											}
										endif;
									endif;?>
                                </select>
                            </div>
                        </div>
                        <!-- End Service element -->
                        <!-- Begin Véhicule attribué element -->
                        <div class="element-wrapper single_select-element-wrapper clearfix">
                            <label for="vehicule_attribuer">Véhicule attribué :</label>
                            <div class="input-wrapper single_select-input-wrapper clearfix">
                                <select class="iphorm-tooltip" id="vehicule_attribuer" name="vehicule_attribuer" title="Selectionner votre vehicule_attribuer">
                                   <?php if(isset($voiture)):
                                   if($result[0]->voiture_attribue != null)
                                    {
                                        echo "<option value=".$result[0] ->voiture_attribue.">".$result[0] ->code_plaque."</option>";
                                    }
                                    else
                                    {
                                        echo "<option value=".null."> </option>";
                                    }
                                    echo "<option value=".null."> </option>";
                                        if($voiture != null):
                                            foreach($voiture as $r){
                                                echo "<option value=".$r ->id.">".$r ->code_plaque."</option>" ;
                                            }
                                        endif;
                                    endif;?>
                                </select>
                            </div>
                        </div>
                        <!-- End Véhicule attribué element -->
                        <!-- Begin Supérieur Hériachique element -->
                        <div class="element-wrapper single_select-element-wrapper clearfix">
                            <label for="superieur">Supérieur Hiérarchique :</label>
                            <div class="input-wrapper single_select-input-wrapper clearfix">
                                <select class="iphorm-tooltip" id="superieur" name="superieur" title="Selectionner votre superieur">
                                <?php if(isset($superieur)):
                                    echo "<option value=".$result[0]->superieur.">".$result[0]->nomsupp." ".$result[0]->prenomsupp."</option>" ;
                                        if($superieur != null):
                                            foreach($superieur as $r){
                                                echo "<option value=".$r ->id.">".$r ->nom." ".$r->prenom."</option>" ;
                                            }
                                        endif;
                                    endif;?>
                                </select>
                            </div>
                        </div>
                        <!-- End Supérieur Hériachique element -->
                        <!-- Begin Submit button -->
                        <div class="button-wrapper submit-button-wrapper clearfix">
                            <div class="loading-wrapper"><span class="loading">Please wait...</span></div>
                            <div class="button-input-wrapper submit-button-input-wrapper">
                                <input class="ka-form-submit" type="submit" name="contact" value="Valider" /><br/>
                            </div>
                        </div>
                        <!-- End Submit button -->
                        <?php echo form_close();
                        //var_dump($result);?>
	               </div>
	           </div>
		   </div>
		</form>
	</div>
</div>
</div>
<!-- end content -->
<!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->
</div><!-- main-area -->
</div>
</div>