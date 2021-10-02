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
     <div class="CSSTableGenerator" >
        <table class="table" id="example">
            <thead>
                <tr>
                    <th >Agent : </th>
                    <th >Date début :</th>
                    <th >Date fin :</th>
                    <th >Statut :</th>
                    <th >PDF :</th>
                    <th >Signer :</th>
                </tr>
            </thead>
            <?php if(count($results) > 0){
                foreach ($results as $r) {
                    echo "
                        <tr>
                            <td>".$r->prenom." ".$r->nom."</td>
                            <td>".$r->dte_debut."</td>
                            <td>".$r->dte_fin."</td>";
                    if($r->statut == 1)
                    {
                        echo "<td> signer par l'agent</td>";
                    }
                    else
                    {
                        echo "<td> signer par l'agent et le supérieur</td>";
                    }
                    echo "
                            <td>".anchor('registre/registre_pdf/'.$r->id, '<span>PDF</span>', 'class="ka_button small_button small_coolblue" id="test" target="_blank"')
                            ."</td>
                            <td>
                                ".anchor('registre/detail_registre_agent/'.$r->id, '<span>Signer</span>', 'class="ka_button small_button small_coolblue" id="test"')
                            ."</td>
                        </tr>";
                    }
                }?>
        </table>
    </div><!-- end content -->
    <!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->
    