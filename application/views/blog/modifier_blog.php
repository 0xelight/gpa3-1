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
                        echo form_open('blog/modifier/'.$result[0]->id , $attributes);
                    ?>
                    <div class="iphorm-wrapper">
                        <div class="iphorm-inner">
                            <div class="iphorm-message"></div>
                            <div class="iphorm-container clearfix">
                                <!-- Begin titre element -->
                                <div class="element-wrapper name-element-wrapper clearfix">
                                    <?php 
                                        if(isset($error))
                                        {
                                            echo '<div class="error"><h3>'.$error.'</h3></div>';
                                        }
                                    ?>
                                    <label for="titre">Titre :</label>
                                    <?php echo form_error('titre','<span class="error">','</span>');?>
                                    <?php echo "<input id='id' name='id' value=".$result[0]->id.">";?>
                                    <div class="input-wrapper name-input-wrapper">
                                        <?php echo "<input class='name-element' id='titre' type='text' name='titre' value=".$result[0]->titre.">";?>
                                    </div>
                                </div>
                                <!-- End titre element -->
                            <!-- Begin article element -->
                            <div class="element-wrapper name-element-wrapper clearfix">
                                <label for="article">Article :</label>
                                <?php echo form_error('article','<span class="error">','</span>');?>
                                <div class="input-wrapper name-input-wrapper">
                                    <?php echo'<textarea class="name-element" id="article" type="text" name="article" >'.$result[0]->article.'</textarea>';?>
                                </div>
                            </div>
                            <!-- End article element -->
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