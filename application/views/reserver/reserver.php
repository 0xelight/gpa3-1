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
                $attributes=array('class' => 'iphorm', 'id'=>'myForm') ;
                echo form_open('reserver/reserver' , $attributes);
            ?>      
            <div class="iphorm-wrapper">
                <div class="iphorm-inner">
                    <div class="iphorm-message"></div>
                    <div class="iphorm-container clearfix">
                    <!-- Begin dte_debut element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <?php 
                                if(isset($error))
                                {
                                    echo '<div class="error"><h3>'.$error.'</h3></div>';
                                }
                            ?>
                            <label for="dte_debut">Date début :</label>
                            <?php echo form_error('Date début','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="dte_debut" type="text" name="dte_debut" />
                                <select name="hdebut" id="hdebut" class="col_9">
                                    <?php
                                        for ($i = 0; $i <=23; $i++){
                                            echo "<option value=".$i.">".$i."H</option>";
                                        }
                                    ?>
                                </select>
                                <select name="mindebut" id="mindebut" class="col_9">
                                    <option value="00">00</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                        </div>
                    <!-- End dte_debut element -->
                    <!-- Begin dte_fin element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="dte_fin">Date fin :</label>
                            <?php echo form_error('nom','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input class="name-element" id="dte_fin" type="text" name="dte_fin" />
                                <select name="hfin" id="hfin" class="col_9">
                                    <?php
                                        for ($i = 0; $i <=23; $i++){
                                            echo "<option value=".$i.">".$i."H</option>";
                                        }
                                    ?>
                                </select>
                                <select name="minfin" id="minfin" class="col_9">
                                    <option value="00">00</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                        </div>
                    <!-- End dte_fin element -->
                    <!-- Begin voiture element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="listeVoitureId">Voiture :</label>
                            <?php echo form_error('voiture','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <select name="listeVoitureId" id="listeVoitureId" class="col_9">
                                    <?php
                                        if(classe()->voiture_attribue != null){
                                            echo "<option value=".$voiture[0]->id.">".$voiture[0]->code_plaque."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    <!-- End voiture element -->
                    <!-- Begin destination element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="destination">Destination :</label>
                            <?php echo form_error('destination','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input name="destination" class="col_9" type="text" />
                            </div>
                        </div>
                    <!-- End destination element -->
                    <!-- Begin motif element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="motif">Motif :</label>
                            <?php echo form_error('motif','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input name="motif" class="col_9" type="text" />
                            </div>
                        </div>
                    <!-- End motif element -->
                    <!-- Begin distance element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="distance">Distance :</label>
                            <?php echo form_error('distance','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input name="distance" class="col_9" type="text" /> KM total
                            </div>
                        </div>
                    <!-- End distance element -->
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
        </div><!-- end one_third -->
    </div><!-- end content -->
    <!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->


<script type="text/javascript">
    jQuery(document).ready(function ($){
    //Action lors du changement des input
        $("#dte_debut , #hdebut , #dte_fin , #hfin").change(function(){
            //déclaration des variable à envoyez au controller
            var form_data = {
                leDebut: $("#dte_debut").val(),
                HDebut: $("#hdebut").val(),
                minDebut: $("#mindebut").val(),
                laFin: $("#dte_fin").val(),
                HFin : $("#hfin").val(),
                minFin: $("#minfin").val()
                }
            //envoi au controller
            $.ajax({
                url: "<?php echo site_url('reserver/chercher_voiture');?>",
                async : false,
                type: 'POST',
                data: form_data,   
                success: function(data)
                {   
                    var options = "";
                    var responseData = JSON.parse(data);
                    if (responseData != null) 
                    {                                        
                        for (var i = 0; i < responseData.length; i++)
                        {
                            options += '<option value="' + responseData[i]['value'] + '">' + responseData[i]['label'] + '</option>';                                
                        }
                    }
                    //envoyer le resultat dans le select
                    $("#listeVoitureId").html(options);
                    //si le resultat n'est pas vide
                    //activer le select
                    if (options != "") 
                    {
                        $("#listeVoitureId").attr("disabled", false);
                    }
                }
            });
        });
    });                                
</script>