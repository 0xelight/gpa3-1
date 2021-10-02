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
<?php 
    $attributes=array('class' => 'iphorm') ;
    echo form_open('utilisateur/add_user' , $attributes);
?>
    <div id="content" class="content_full_width">
        <div class="one_fourth"></div>
        <div class="one_fourth">
            <div class="iphorm-outer">
                
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
                                <?php 
                                    echo form_error('nom','<span class="error">','</span>');
                                ?>
                                <div class="input-wrapper name-input-wrapper">
                                    <input class="name-element" id="nom" type="text" name="nom" />
                                </div>
                            </div>
                            <!-- End Name element -->
                            
                            <!-- Begin pseudo element -->
                            <div class="element-wrapper name-element-wrapper clearfix">
                                <label for="pseudo">Pseudo :</label>
                                <?php echo form_error('pseudo','<span class="error">','</span>');?>
                                <div class="input-wrapper name-input-wrapper">
                                    <input class="name-element" id="pseudo" type="text" name="pseudo" />
                                </div>
                            </div>
                            <!-- End pseudo element -->
                            <!-- Begin password element -->
                            <div class="element-wrapper name-element-wrapper clearfix">
                                <label for="pass">Mot de passe :</label>
                                <?php echo form_error('pass','<span class="error">','</span>');?>
                                <div class="input-wrapper name-input-wrapper">
                                    <input class="name-element" id="pass" type="password" name="pass" />
                                </div>
                            </div>
                            <!-- End password element -->
                            
                            
                            <!-- Begin telephone element -->
                            <div class="element-wrapper telephone-element-wrapper clearfix">
                                <label for="telephone">Téléphone :</label>
                                <?php echo form_error('telephone','<span class="error">','</span>');?>
                                <div class="input-wrapper email-input-wrapper">
                                    <input class="telephone-element" id="telephone" type="text" name="telephone" />
                                </div>
                            </div>
                            <!-- End telephone element -->
                            
                            <!-- Begin ville element -->
                            <div class="element-wrapper ville-element-wrapper clearfix">
                                <label for="ville">Ville :</label>
                                <?php echo form_error('ville','<span class="error">','</span>');?>
                                <div class="input-wrapper email-input-wrapper">
                                    <input class="ville-element" id="ville" type="text" name="ville" />
                                </div>
                            </div>
                            <!-- End ville element -->
                            
                            <!-- Begin distance element -->
                            <div class="element-wrapper distance-element-wrapper clearfix">
                                <label for="distance">Distance travail/domicile :</label>
                                <?php echo form_error('distance','<span class="error">','</span>');?>
                                <div class="input-wrapper email-input-wrapper">
                                    <input class="distance-element" id="distance" type="text" name="distance" />
                                </div>
                            </div>
                            <!-- End distance element -->
                            
                            <!-- Begin Single select element -->
                            <div class="element-wrapper single_select-element-wrapper clearfix">
                                <label for="service">Question secrète :</label>
                                <div class="input-wrapper single_select-input-wrapper clearfix">
                                    <select class="iphorm-tooltip" id="single_select" name="single_select" title="Question pour protéger vôtre compte">
                                        <option value="nom">Le nom de jeune fille de votre mère </option>
                                       <option value="ville"> Votre ville de naissance </option>
                                    </select>
                                </div>
                            </div>
                            <!-- End Single select element -->
                            
                            
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
            </form>
        </div>
    <!-- end one_fourth -->  
    </div>
    <div class="one_fourth">
        <div class="iphorm-outer">
            <div class="iphorm-wrapper">
                <div class="iphorm-inner">
                    <div class="iphorm-message"></div>
                    <div class="iphorm-container clearfix">
                        <!-- Begin Prenom element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="prenom">Prénom :</label>
                            <?php 
                                echo form_error('prenom','<span class="error">','</span>');
                            ?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="prenom" type="text" name="prenom" />
                            </div>
                        </div>
                        <!-- End Prenom element -->
                        <!-- Begin Email element -->
                        <div class="element-wrapper email-element-wrapper clearfix">
                            <label for="email">Email :</label>
                            <?php echo form_error('email','<span class="error">','</span>');?>
                            <div class="input-wrapper email-input-wrapper">
                                <input class="email-element" id="email" type="text" name="email" />
                            </div>
                        </div>
                        <!-- End Email element -->
                        <!-- Begin re-password element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="re-pass">Répéter mot de passe :</label>
                            <?php echo form_error('re-pass','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="re-pass" type="password" name="re-pass" />
                            </div>
                        </div>
                        <!-- End re-password element -->
                        <!-- Begin adresse element -->
                        <div class="element-wrapper adresse-element-wrapper clearfix">
                            <label for="adresse">Adresse :</label>
                            <?php echo form_error('adresse','<span class="error">','</span>');?>
                            <div class="input-wrapper email-input-wrapper">
                                <input class="adresse-element" id="adresse" type="text" name="adresse" />
                            </div>
                        </div>
                        <!-- End adresse element -->
                        <!-- Begin cp element -->
                        <div class="element-wrapper cp-element-wrapper clearfix">
                            <label for="cp">Code Postale :</label>
                            <?php echo form_error('cp','<span class="error">','</span>');?>
                            <div class="input-wrapper email-input-wrapper">
                                <input class="cp-element" id="cp" type="text" name="cp" />
                            </div>
                        </div>
                        <!-- End cp element -->
                        <!-- Begin Supérieur Hériachique element -->
                            <div class="element-wrapper single_select-element-wrapper clearfix">
                                <label for="superieur">Supérieur Hiérarchique :</label>
                                <div class="input-wrapper single_select-input-wrapper clearfix">
                                    <select class="iphorm-tooltip" id="superieur" name="superieur" title="Selectionner votre superieur">
                                    <?php if(isset($superieur)):
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
                        <!-- Begin reponse element -->
                        <div class="element-wrapper email-element-wrapper clearfix">
                            <label for="reponse">Reponse :</label>
                            <?php echo form_error('reponse','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="email-element" id="reponse" type="text" name="reponse" />
                            </div>
                        </div>
                        <!-- End reponse element -->
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php echo form_close();?>
</div><!-- end content -->
<!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->
</div><!-- main-area -->
</div>
</div>