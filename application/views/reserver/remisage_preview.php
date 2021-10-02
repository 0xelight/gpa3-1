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
            echo $results[0]->signature_agent."<br/>";
            //var_dump($results);
            ?>

            <?php 
            $id = $results[0]->id;
            echo anchor('reserver/signer_remisage/'.$id, '<span>Signer le bon</span>', 'class="ka_button small_button small_coolblue" id="test"');
            echo anchor('reserver/remisage_pdf/'.$id, '<span>PDF</span>', 'class="ka_button small_button small_coolblue" id="test" target="_blank"');
                ?>
                </form>
        </div><!-- end one_third -->
    </div><!-- end content -->
</div><!-- end main-holder -->
