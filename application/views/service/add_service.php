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
				echo form_open('service/add_service/'.classe()->id , $attributes);
            ?>
            <div class="iphorm-wrapper">
                <div class="iphorm-inner">
                    <div class="iphorm-message"></div>
                    <div class="iphorm-container clearfix">
                        <!-- Begin libelle element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <?php 
                                if(isset($error))
                                {
                                    echo '<div class="error"><h3>'.$error.'</h3></div>';
                                }
                            ?>
                            <label for="libelle">Libellé :</label>
                            <?php echo form_error('libelle','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <?php echo "<input class='name-element' id='libelle' type='text' name='libelle'>";?>
                            </div>
                        </div>
                        <!-- End libelle element -->
                        <!-- Begin REGATE element -->
                        <div class="element-wrapper name-element-wrapper clearfix">
                            <label for="regate">REGATE :</label>
                            <?php echo form_error('regate','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <?php echo'<input class="name-element" id="regate" type="text" name="regate">';?>
                            </div>
                        </div>
                        <!-- End REGATE element -->
                        <!-- Begin Distance vehicule attribue element -->
                        <div class="element-wrapper disponible-element-wrapper clearfix">
                            <label for="option_registre">Option registre :</label>';
                            <?php echo form_error('option_registre','<span class="error">','</span>');?>
                            <div class="input-wrapper name-input-wrapper">
                                <?php echo'<input class="option_registre-element" id="option_registre" type="checkbox" name="option_registre" value="1">';?>
                            </div>
                        </div>
                            
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