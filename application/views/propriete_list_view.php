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

      <div class="col-md-3 row pull-left" style="padding-right: 0px;">

        <a  class="btn btn-block btn-primary pull-right btn-success" id="btn-bitbucket" href="<?php echo base_url()?>Propriete/index_add/">
          <i class="fa fa-plus"></i> Ajouter une nouvelle propriété
        </a>

      </div>
      <br><br>

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Liste de propriétés</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          
          <?php echo $this->table->generate($list);?>

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


