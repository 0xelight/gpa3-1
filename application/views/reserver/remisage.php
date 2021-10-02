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
        <div class="CSSTableGenerator" >
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th >Date création :</th>
                        <th >Statut :</th>
                        <th >PDF :</th>
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
                                <td>".$r->date_creation."</td>
                                <td>".$statut."</td>
                                <td>".anchor('reserver/remisage_pdf/'.$r->id, '<span>PDF</span>', 'class="ka_button small_button small_coolblue" id="test" target="_blank"')
                                ."</td>";
                        
                        echo "</tr>";
                    }
                }?>
            </table>
        </div><!-- end CSSTableGenerator -->
    </div><!-- end content -->
    <!-- ***************** - END content - ***************** -->
</div><!-- end main-holder -->