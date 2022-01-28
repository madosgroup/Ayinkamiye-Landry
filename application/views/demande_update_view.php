<?php

 include 'includes/header.php';

?>
<div class="wrapper">

  <?php

    include 'includes/barre_bleu.php';

  ?>
  
  <?php
    
    $parametrage='active';
    $the_site='active';
    $the_documents='';

    $gestion_demandes='';
    $nouvelle_demande='';
    $liste_demandes='';

    include 'includes/menu.php';

  ?>

  
  <div class="content-wrapper">
    <!-- Content Header (Page header) --> 

    <section class="content-header">
      <h1>Paramètrage</h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="col-md-2 row pull-left" style="padding-right: 0px;">

        <a  class="btn btn-block btn-primary pull-right btn-success" id="btn-bitbucket">
          <i class="fa fa-plus"></i> Ajouter une site 
        </a>

      </div>
      <br><br>

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Liste de sites</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          
          <form method="post" action="<?php echo base_url()?>Demande/add/" id="myform">

            

            <div class="col-md-12 form-group">
              <label>Site</label>
              
              <select class="form-control select2 select2-hidden-accessible"  style="width: 100%;" tabindex="-1" aria-hidden="true"  name="nom_site" id="proprietaire_compte">

                <option value="<?php echo $site['ID_SITE']?>"><?php echo $site['NOM_SITE']?></option>
                <?php foreach($liste_des_sites as $site):?> 
                  <option value="<?php echo $site['ID_SITE']?>"><?php echo $site['NOM_SITE']?></option>
                <?php endforeach;?>
              </select>
            </div>
            <br>

            <div class="col-md-12 form-group">

              <label>Documents a demander</label>

              <table class="table table-bordered">

                <thead>
                  <tr>
                    <th>Nom du document</th> 
                    <th>Quantité demandé</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody id="dynamic_part_priv">

                  
                  <tr>
                    <td>
                      <select class="form-control "  style="width: 100%;" tabindex="-1" aria-hidden="true"  name="nom_document[]" id="proprietaire_compte">

                        <option value="">--- Sélectionner un document ---</option>
                        <?php foreach($liste_des_documents as $doc):?> 
                          <option value="<?php echo $doc['ID_DOCUMENT']?>"><?php echo $doc['NOM_DOCUMENT']?></option>
                        <?php endforeach;?>
                      </select>
                    </td>

                    <td>
                      <input type="number" name="quantite_demande[]" class="form-control" placeholder="Quantité demandé">
                    </td>

                    
                    <td><button type="button"  id="add_part_priv" class="btn btn-success glyphicon glyphicon-plus add_part_priv"></button></td>

                  </tr>
                  
                    
                  
                  
                </tbody>

              </table>
            </div>

            


           

            <div class="col-md-12 form-group">
              <input type="submit" name="submit" class="submit btn btn-primary btn_save" value="Enregistrer"/>
            </div>
            
          </form>

        </div>
        <!-- /.box-body -->
        <div class="box-footer"> 
         
        </div>
      </div>
      <!-- /.box -->

      

    </section>
    <!-- /.content -->
  </div>
  
 
 

  <?php

    include 'includes/pied.php';

  ?> 

 
  <div class="control-sidebar-bg"></div>
</div>


<?php

 include 'includes/footer.php';

?>

<script type="text/javascript">
  $(document).ready(function(){



    $(".select2").select2();

  });
</script>

<!--Dynamic parties privatives-->
<script type="text/javascript">
  $(document).ready(function(){
        var i=1; 
        $('.add_part_priv').click(function(){ 

          i++;
          $('#dynamic_part_priv').append('<tr><td><select class="form-control "  style="width: 100%;" tabindex="-1" aria-hidden="true"  name="nom_document[]" id="proprietaire_compte"><option value="">--- Sélectionner un document ---</option><?php foreach($liste_des_documents as $doc):?><option value="<?php echo $doc['ID_DOCUMENT']?>"><?php echo $doc['NOM_DOCUMENT']?></option><?php endforeach;?></select></td><td><input type="number" name="quantite_demande[]" class="form-control" placeholder="Quantité demandé"></td><td><button type="button"  id="add_part_priv" class="btn btn-success glyphicon glyphicon-plus btn_add_part_priv"></button><button type="button" style="margin-left: 10px;" name="remove" id="'+i+'" class="btn btn-danger btn_remove_part glyphicon glyphicon-remove"></button></td></tr>');
        });

        $(document).on('click', '.btn_add_part_priv', function(){ 
           
           $('#dynamic_part_priv').append('<tr><td><select class="form-control "  style="width: 100%;" tabindex="-1" aria-hidden="true"  name="nom_document[]" id="proprietaire_compte"><option value="">--- Sélectionner un document ---</option><?php foreach($liste_des_documents as $doc):?><option value="<?php echo $doc['ID_DOCUMENT']?>"><?php echo $doc['NOM_DOCUMENT']?></option><?php endforeach;?></select></td><td><input type="number" name="quantite_demande[]" class="form-control" placeholder="Quantité demandé"></td><td><button type="button"  id="add_part_priv" class="btn btn-success glyphicon glyphicon-plus btn_add_part_priv"></button><button type="button" style="margin-left: 10px;" name="remove" id="'+i+'" class="btn btn-danger btn_remove_part glyphicon glyphicon-remove"></button></td></tr>');
        });
        $(document).on('click', '.btn_remove_part', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();

        });
        $(document).on('click', '.btn_remove_part', function(){
       
          $(this).closest('tr').remove();
        }); 

  });
</script>
