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
				echo form_open('utilisateur/mon_compte/'.classe()->id , $attributes);
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
                            <?php echo "<input id='id' name='id' value=".classe()->id.">";?>
                            <div class="input-wrapper name-input-wrapper">
                                <?php echo "<input class='name-element' id='nom' type='text' name='nom' value=".classe()->nom.">";?>
                            </div>
                        </div>
                        <!-- End Name element -->
                        <!-- Begin Prenom element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="prenom">Prénom :</label>
                            <?php echo form_error('prenom','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <?php echo'<input class="name-element" id="prenom" type="text" name="prenom" value='.classe()->prenom.'>';?>
                            </div>
                        </div>
                        <!-- End Prenom element -->
                        <!-- Begin pseudo element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="pseudo">Pseudo :</label>
                            <?php echo form_error('pseudo','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <?php echo'<input class="name-element" id="pseudo" type="text" name="pseudo" value='.classe()->log.'>';?>
                            </div>
                        </div>
                        <!-- End pseudo element -->
                        <!-- Begin Email element -->
                        <div class="element-wrapper email-element-wrapper clearfix">
                            <label for="email">Email :</label>
                            <?php echo form_error('email','<span class="error">','</span>');?>
                            <div class="input-wrapper email-input-wrapper">
                                <?php echo'<input class="email-element" id="email" type="text" name="email" value='.classe()->mail.'>';?>
                            </div>
                        </div>
                        <!-- End Email element -->

                        <!-- Begin Téléphone element -->
                        <div class="element-wrapper telephone-element-wrapper clearfix">
                            <label for="telephone">Téléphone :</label>
                            <?php echo form_error('telephone','<span class="error">','</span>');?>
                            <div class="input-wrapper telephone-input-wrapper">
                                <?php echo'<input class="telephone-element" id="telephone" type="text" name="telephone" value='.classe()->telephone.'>';?>
                            </div>
                        </div>
                        <!-- End Téléphone element -->
                        <!-- Begin Adresse element -->
                        <div class="element-wrapper adresse-element-wrapper clearfix">
                            <label for="adresse">Adresse :</label>
                            <?php echo form_error('adresse','<span class="error">','</span>');?>
                            <div class="input-wrapper adresse-input-wrapper">
                                <?php echo'<textarea class="name-element" id="adresse" type="text" name="adresse" >'.classe()->adresse.'</textarea>';?>
                            </div>
                        </div>
                        <!-- End Adresse element -->
                        <!-- Begin Ville element -->
                        <div class="element-wrapper ville-element-wrapper clearfix">
                            <label for="ville">Ville :</label>
                            <?php echo form_error('ville','<span class="error">','</span>');?>
                            <div class="input-wrapper ville-input-wrapper">
                                <?php echo'<input class="ville-element" id="ville" type="text" name="ville" value='.classe()->ville.'>';?>
                            </div>
                        </div>
                        <!-- End Ville element -->
                        <!-- Begin Code Postale element -->
                        <div class="element-wrapper CP-element-wrapper clearfix">
                            <label for="CP">Code Postale :</label>
                            <?php echo form_error('CP','<span class="error">','</span>');?>
                            <div class="input-wrapper CP-input-wrapper">
                                <?php echo'<input class="CP-element" id="CP" type="text" name="CP" value='.classe()->CP.'>';?>
                            </div>
                        </div>
                        <!-- End Code Postale element -->
                        <!-- Begin Distance travail/domicile element -->
                        <div class="element-wrapper distance-element-wrapper clearfix">
                            <label for="distance">Distance travail/domicile :</label>
                            <?php echo form_error('distance','<span class="error">','</span>');?>
                            <div class="input-wrapper distance-input-wrapper">
                                <?php echo'<input class="distance-element" id="distance" type="text" name="distance" value='.classe()->distance_domicile.'>';?>
                            </div>
                        </div>
                        <!-- End Distance travail/domicile element -->
                        <!-- Begin Distance vehicule attribue element -->
                        <?php
                        if(classe()->voiture_attribue != null)
                        {
                            echo '<div class="element-wrapper disponible-element-wrapper clearfix">
                            <p>Vous avez la voiture '.$result[0]->code_plaque.'</p>
                                <label for="disponible">rendre le vehicule attribué disponible :</label>';
                                if($result[0]->disponible_journee == true){
                                    echo'<input class="disponible-element" id="disponible" type="checkbox" name="disponible" value="1" checked>';
                                }
                                else{

                                    echo'<input class="disponible-element" id="disponible" type="checkbox" name="disponible" value="1">';
                                }
                            echo"</div>";
                            }
                        ?>
                        <!-- End Distance vehicule attribue element -->
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