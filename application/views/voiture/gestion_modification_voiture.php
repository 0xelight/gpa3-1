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
                        echo form_open('voiture/gestion_modifier_voiture/'.$result[0]->id , $attributes);
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
                                    <label for="immat">Immatriculation :</label>
                                    <?php echo form_error('immat','<span class="error">','</span>');?>
                                    <?php echo "<input id='id' name='id' value=".$result[0]->id.">";?>
                                    <div class="input-wrapper name-input-wrapper">
                                        <?php echo "<input class='name-element' id='immat' type='text' name='immat' value=".$result[0]->code_plaque.">";?>
                                    </div>
                                </div>
                                <!-- End Name element -->
                                <!-- Begin Prenom element -->
                                <div class="element-wrapper name-element-wrapper clearfix">
                                    <label for="modele">Modèle :</label>
                                    <?php echo form_error('modele','<span class="error">','</span>');?>
                                <div class="input-wrapper name-input-wrapper">
                                    <?php echo'<input class="name-element" id="modele" type="text" name="modele" value='.$result[0]->modele.'>';?>
                                </div>
                            </div>
                            <!-- End Prenom element -->
                            <!-- Begin commentaire element -->
                            <div class="element-wrapper name-element-wrapper clearfix">
                                <label for="commentaire">Commentaire :</label>
                                <?php echo form_error('commentaire','<span class="error">','</span>');?>
                                <div class="input-wrapper name-input-wrapper">
                                    <?php echo'<textarea class="name-element" id="commentaire" type="text" name="commentaire" >'.$result[0]->commentaire.'</textarea>';?>
                                </div>
                            </div>
                            <!-- End commentaire element -->
                            <!-- Begin Statut element -->
                            <div class="element-wrapper single_select-element-wrapper clearfix">
                                <label for="statut">Statut :</label>
                                <div class="input-wrapper single_select-input-wrapper clearfix">
                                    <select class="iphorm-tooltip" id="statut" name="statut" title="Selectionner votre statut">
                                        <?php 
                                            if($result[0]->statut=='0')
                                            {
                                                echo '  <option value="0">Indisponible</option>
                                                        <option value="1">Disponible</option>
                                                        <option value="2">Toujours réserver</option>';
                                            }
                                            if($result[0]->statut=='1')
                                            {
                                                echo '  <option value="1">Disponible</option>
                                                        <option value="0">Indisponible</option>
                                                        <option value="2">Toujours réserver</option>';
                                            }
                                            if($result[0]->statut=='2')
                                            {
                                                echo '  <option value="2">Toujours réserver</option>
                                                        <option value="1">Disponible</option>
                                                        <option value="0">Indisponible</option>
                                                        ';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- End Statut element -->
                            <!-- Begin Service element -->
                            <div class="element-wrapper single_select-element-wrapper clearfix">
                                <label for="service">Service :</label>
                                <div class="input-wrapper single_select-input-wrapper clearfix">
                                    <select class="iphorm-tooltip" id="service" name="service" title="Selectionner votre service">
                                    <?php if(isset($results)){
                                        echo "<option value=".$result[0] ->fk_service.">".$result[0] -> libelle."</option>" ;
                                            if($results != null){
                                                foreach($results as $r){
                                                    echo "<option value=".$r -> id.">".$r -> libelle."</option>" ;
                                                }
                                            }
                                        }?>
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