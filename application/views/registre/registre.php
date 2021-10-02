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
            <?php 
                $attributes=array('class' => 'iphorm') ;
                echo form_open('registre/generer_registre' , $attributes);
            ?>
            <div class="iphorm-wrapper">
                <div class="iphorm-inner">
                    <div class="iphorm-message"></div>
                    <div class="iphorm-container clearfix">
                        <!-- Begin dte_debut element -->
                       <div class="element-wrapper name-element-wrapper clearfix">
                            <?php if(isset($error)):?>
                            <div class="error"><?php echo $error;?></div>
                            <?php endif;?>
                            <label for="dte_debut">Date début :</label>
                            <?php echo form_error('Date début','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="dte_debut" type="text" name="dte_debut" />

                            </div>
                        </div>
                        <!-- End dte_debut element -->
                        <!-- Begin dte_fin element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <?php if(isset($error)):?>
                            <div class="error"><?php echo $error;?></div>
                            <?php endif;?>
                            <label for="dte_fin">Date fin :</label>
                            <?php echo form_error('Date fin','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="dte_fin" type="text" name="dte_fin" />
                            </div>
                        </div>
                        <!-- End dte_fin element -->
                        <!-- Begin identifiant element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <?php if(isset($error)):?>
                            <div class="error"><?php echo $error;?></div>
                            <?php endif;?>
                            <label for="identifiant">Identifiant RH :</label>
                            <?php echo form_error('identifiant','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="identifiant" type="text" name="identifiant" />
                            </div>
                        </div>
                        <!-- End identifiant element -->
                        <!-- Begin direction element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <?php if(isset($error)):?>
                            <div class="error"><?php echo $error;?></div>
                            <?php endif;?>
                            <label for="direction">Direction :</label>
                            <?php echo form_error('direction','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="direction" type="text" name="direction" />
                            </div>
                        </div>
                        <!-- End direction element -->
                        <!-- Begin service element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <?php if(isset($error)):?>
                            <div class="error"><?php echo $error;?></div>
                            <?php endif;?>
                            <label for="service">Service / Code Régate :</label>
                            <?php echo form_error('service','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="service" type="text" name="service" />
                            </div>
                        </div>
                        <!-- End service element -->
                        <!-- Begin Submit button -->
                        <div class="button-wrapper submit-button-wrapper clearfix">
                            <div class="loading-wrapper"><span class="loading">Please wait...</span></div>
                            <div class="button-input-wrapper submit-button-input-wrapper">
                                <input class="ka-form-submit" type="submit" name="contact" value="Valider" />
                            </div>
                        </div>
                        <!-- End Submit button -->
                    </div>
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
    <div id="content" class="content_full_width">
        <div class="CSSTableGenerator" >
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th >Date début :</th>
                        <th >Date fin :</th>
                        <th >Statut :</th>
                        <th >PDF :</th>
                        <th >Supprimer registre :</th>
                    </tr>
                </thead>
                <?php if(count($results) > 0){
                    foreach ($results as $r) {
                        if($r->statut == 0)
                        {
                            $statut = "Non signé";
                        }
                        if($r->statut == 1)
                        {
                            $statut = "Signé par l'agent";
                        }
                        if($r->statut == 2)
                        {
                            $statut = "Signé par l'agent et le supérieur";
                        }
                        echo "
                            <tr>
                                <td>".$r->dte_debut."</td>
                                <td>".$r->dte_fin."</td>
                                <td>".$statut."</td>
                                <td>".anchor('registre/registre_pdf/'.$r->id, '<span>PDF</span>', 'class="ka_button small_button small_coolblue" id="test" target="_blank"')
                                ."</td>";
                        if ($r->statut == '0') {
                            echo "<td>".anchor('registre/supprimer_registre/'.$r->id, '<span>Supprimer</span>', 'class="ka_button small_button small_fire" id="test"')."</td>";
                        }
                        else{
                            echo "<td></td>";
                        }
                        echo "</tr>";
                    }
                }?>
            </table>
        </div><!-- end CSSTableGenerator -->
    </div><!-- end content -->
    <!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->
    