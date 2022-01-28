<?php

 include 'includes/header.php';

?>
<div class="wrapper">

  <?php

    include 'includes/barre_bleu.php';

  ?>
  
  <?php
    
    $parametrage='';
    $type_propriete='';
    $caracteristiques_proprietes='';

    $gestion_proprietes='active';
    $nouvelle_proprietes='';
    $liste_proprietes='active';

    include 'includes/menu.php';

  ?>

  
  <div class="content-wrapper">
    <!-- Content Header (Page header) --> 

    <section class="content-header">
      <h1>Gestion des propriétés</h1>

      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-md-6">
          <div class="box box-primary">

            <div class="box-header with-border">

              <h3 class="box-title">Informations sur le propriété</h3>  

            </div>

            <!-- /.box-header -->

            <!-- form start -->

            <div class="box-body content-block">

              <table class="table">
                <tbody>

                  <tr>
                    <th>Nom de la propriété</th>
                    <td><?php echo $get_propriete['NOM_PROPRIETE']?></td>
                  </tr>
                  
                  
                  <tr>
                    <th>Type de la propriété</th>
                    <td><?php echo $le_type_propriete['TYPE_PROPRIETE']?></td>
                  </tr>
                  <tr>
                    <th>Prix de la propriété</th>
                    <td><?php echo number_format($get_propriete['PRIX_PROPRIETE'], 0, ',', ' ').' '.'FBU'?></td>
                  </tr>

                </tbody>
              </table>
              <br>
              <?php if(!empty($caracteristiques_list)):?>
                <h4><strong>Caractéristiques de la propriété </strong></h4>
                <table class="table">
                  <tbody>
                    <?php foreach($caracteristiques_list as $caract):?>
                    <tr>
                      <th><?php echo $caract['NOM_CARACTERISTIQUE']?></th>
                      <td><?php echo $caract['VALEUR_CARACTERISTIQUE']?></td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
                <?php endif;?> 


                

                <?php if($get_propriete['DESCRIPTION_PROPRIETE'] !=='' ):?> 
                  <h4><strong>Description de la propriété </strong></h4>
                  <p >
                    <?php echo $get_propriete['DESCRIPTION_PROPRIETE'];?>
                  </p>
                <?php endif;?>

              
            </div>

              <!-- /.box-body -->

          </div>
        </div>

        <div class="col-md-6">

          <!-- general form elements -->

          <div class="box box-primary">

            <div class="box-header with-border">

              <h3 class="box-title">Images de la propriété</h3>

            </div>

            <!-- /.box-header -->

            <!-- form start -->

              <div class="box-body">
                <div class="row">
                  <div class="col-sm-12" style="padding: 10px;">
                  <img class="img-thumbnail img-responsive" src="<?php echo base_url()?>/uploads/photo_principale/<?php echo $get_propriete['PHOTO_PRINCIPALE_PROPRIETE']?>" alt="Card image cap">
                  
                </div>
                
                
                </div>
                

              </div>

              <!-- /.box-body -->

          </div>

          <!-- /.box -->

        </div>
      </div>

      

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



    $('#table_id').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,

    })

  });
</script>


