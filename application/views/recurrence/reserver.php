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
                echo form_open('recurrence' , $attributes);
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
                            <label for="dte_debut">Date début de la première réservation :</label>
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
                            <label for="dte_fin">Date fin de la première réservation :</label>
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
                    <!-- Begin recurrence element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="recurrence">Récurrence :</label>
                            <?php echo form_error('recurrence','<span class="error">','</span>');?><br/>
                                <input name="recurrence" class="col_9" type="radio" value="P1D"/>Quotidienne<br/> 
                                <input name="recurrence" class="col_9" type="radio" value="P7D"/>Hebdomadaire <br/>
                                <input name="recurrence" class="col_9" type="radio" value="P1M"/>Mensuelle <br/>
                                <input name="recurrence" class="col_9" type="radio" value="P1Y"/>Annuelle <br/>
                        </div>
                    <!-- End recurrence element -->
                    <!-- Begin nbrecurrence element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="nbrecurrence">Nombre de récurrence :</label>
                            <?php echo form_error('nbrecurrence','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <input name="nbrecurrence" class="col_9" type="text" />
                            </div>
                        </div>
                    <!-- End nbrecurrence element -->
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
