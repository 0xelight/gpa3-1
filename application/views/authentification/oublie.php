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
					    echo form_open('authentification/oublie' , $attributes);
                    ?>
		            <div class="iphorm-wrapper">
	                    <div class="iphorm-inner">
                            <div class="iphorm-message"></div>
	                        <div class="iphorm-container clearfix">
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
                                <!-- Begin re-password element -->
                                <div class="element-wrapper name-element-wrapper clearfix">
                                    <label for="re-pass">Répéter mot de passe :</label>
                                    <?php echo form_error('re-pass','<span class="error">','</span>');?>
                                    <div class="input-wrapper name-input-wrapper">
                                        <input class="name-element" id="re-pass" type="password" name="re-pass" />
                                    </div>
                                </div>
                                <!-- End re-password element -->
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
                                <!-- Begin reponse element -->
                                <div class="element-wrapper email-element-wrapper clearfix">
                                    <label for="reponse">Reponse :</label>
                                    <?php echo form_error('reponse','<span class="error">','</span>');?>
                                    <div class="input-wrapper name-input-wrapper">
                                        <input class="email-element" id="reponse" type="text" name="reponse" />
                                    </div>
                                </div>
                                <!-- End reponse element -->
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
                <?php echo form_close();?>
	           </div>
			</div>
		</div><!-- end content -->
		<!-- ***************** - END content - ***************** -->
	</div><!-- end main-holder -->