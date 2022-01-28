<?php

 include 'includes/header.php';

?>
<div class="wrapper">

  <?php

    include 'includes/barre_bleu.php';

  ?>
  
  <?php
    
    $parametrage='active';
    $type_propriete='active';
    $caracteristiques_proprietes='';

    $gestion_proprietes='';
    $nouvelle_proprietes='';
    $liste_proprietes='';

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

      <div class="col-md-3 row pull-left" style="padding-right: 0px;">

        <a  class="btn btn-block btn-primary pull-right btn-success" id="btn-bitbucket">
          <i class="fa fa-plus" href="<?php echo base_url()?>TypePropriete/"></i> Liste de types propriété
        </a>

      </div>
      <br><br>

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Ajouter un nouveau type de propriete</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          
          <form method="post" action="<?php echo base_url()?>TypePropriete/add/" id="myform">

            

            <div class="col-md-6 sm-12 xs-12 form-group"> 

              <label for="exampleInputEmail1">Type de propriété</label>

              <input type="text" class="form-control"  placeholder="Type de propriété" name="type_propriete" >
              <?php echo form_error('type_propriete', '<span class="text-center text-danger">', '</span>'); ?>

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


