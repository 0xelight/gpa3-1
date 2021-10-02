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
    <?php echo anchor('blog/add_article', '<span>Ajouter article</span>', 'aligne="center" class="ka_button small_button small_coolblue"'); ?>
     <div class="CSSTableGenerator" >
        <table class="table" id="example">
            <thead>
                <tr>
                    <th >Titre : </th>
                    <th >Date rédaction :</th>
                    <th >Modifier :</th>
                    <th >Supprimer :</th>
                </tr>
            </thead>
            <?php if(count($results) > 0){
                foreach ($results as $r) {
                    echo "
                        <tr>
                            <td>".$r->titre."</td>
                            <td>".$r->dte_redaction."</td>
                            <td>".anchor('blog/modifier/'.$r->id, '<span>Modifier</span>', 'class="ka_button small_button small_coolblue" target="_blank"')."</td>
                            <td>".anchor('blog/supprimer/'.$r->id, '<span>Supprimer</span>', 'class="ka_button small_button small_coolblue"')."</td>
                        </tr>";
                    }
                }?>
        </table>
    </div><!-- end content -->
    <!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->
    