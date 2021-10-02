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
        <div>
            <?php 
            echo $results[0]->contenu;
            //var_dump($results);
            ?>

            <?php 
            $id = $results[0]->id;
            echo anchor('registre/signer_registre/'.$id, '<span>Signer le registre</span>', 'class="ka_button small_button small_coolblue" id="test"');
            echo anchor('registre/registre_pdf/'.$id, '<span>PDF</span>', 'class="ka_button small_button small_coolblue" id="test" target="_blank"');
                ?>
                </form>
        </div><!-- end one_third -->
    </div><!-- end content -->
</div><!-- end main-holder -->
