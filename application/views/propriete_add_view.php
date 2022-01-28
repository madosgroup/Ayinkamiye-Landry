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
    $nouvelle_proprietes='active';
    $liste_proprietes='';

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

        <a  class="btn btn-block btn-primary pull-right btn-success" id="btn-bitbucket" href="<?php echo base_url()?>Propriete/">
          <i class="fa fa-plus"></i> Liste de  propriétés
        </a>

      </div>
      <br><br>

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Ajouter une nouvelle propriété</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
          
          <form method="post" action="<?php echo base_url()?>Propriete/add/" id="myform" enctype="multipart/form-data">

            

            <div class="col-lg-12 col-md-12 sm-12 xs-12 form-group">
              <label for="basicInput">Type de propriété <span style="color: red;">*</span></label>
              <select class="select2 form-control select2" id="type_propriete" name="type_propriete">
                <option value="">-- Sélectionnez le type de propriété  --</option>
                <?php foreach($liste_type_propriete as $cato):?>
                <option value="<?php echo $cato['CODE_TYPE_PROPRIETE']?>"><?php echo $cato['TYPE_PROPRIETE']?></option>
                <?php endforeach;?>
                  
              </select>
            </div>

            <div class="col-lg-12 col-md-12 sm-12 xs-12 form-group">
              <label for="basicInput">Nom de la propriété  <span style="color: red;">*</span></label>
              <input type="text" name="nom_propriete" class="form-control"  placeholder="Nom de la propriété">
            </div> 

            <div class="col-lg-12 col-md-12 sm-12 xs-12 form-group">
              <label for="basicInput">Prix de la propriété  <span style="color: red;">*</span></label>
              <input type="number" class="form-control" name="prix_propriete" placeholder="Prix de la propriété" id="prix_propriete">
            </div>

            <div id="section_caracteristique">
                                    
            </div>

            <div class="col-lg-12 col-md-12 sm-12 xs-12 form-group">  

                <div class="">

                    <label class="control-label">Photo principale </label>
                    <?php if(isset($error)):?>
                      <?php echo $error;?>
                    <?php endif;?>        

                    <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">

                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">

                        </div>

                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>

                        <div>

                            <span class="btn btn-white btn-file">

                                <span class="btn btn-success fileupload-new" style="b"><i class="fa fa-paper-clip"></i> Sélectionner une image</span>

                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>

                                <input type="file" class="default" name="image_principale" accept=".png, .jpg,.jpeg,.tiff,.bmp,.gif">

                            </span>

                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>

                        </div>

                    </div>
                    
                </div>

            </div>

            <div class="col-lg-12 col-md-12 sm-12 xs-12 form-group">  

                <label for="basicInput">Description de la propriété  <span style="color: red;">*</span></label>
                <textarea name="desc_propriete" class="form-control" rows="8" placeholder="Description de la propriété"></textarea>

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

    $(document).ready(function() {


      $(".select2").select2();
    });

</script>

<script type="text/javascript">

  $(document).ready(function(){

        jQuery.browser = {};

(function () {

    jQuery.browser.msie = false;

    jQuery.browser.version = 0;

    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {

        jQuery.browser.msie = true;

        jQuery.browser.version = RegExp.$1;

    }

})();

  });

</script>

<script>
    $(document).ready(function(){ 

      $('#type_propriete').change(function(){

          var CODE_TYPE_PROPRIETE = $('#type_propriete').val();

          

          if(CODE_TYPE_PROPRIETE != ''){

              

              $.ajax({

                  url:"<?php echo base_url(); ?>Propriete/list_caracteristiques_propriete",

                  method:"POST",

                  data:{CODE_TYPE_PROPRIETE:CODE_TYPE_PROPRIETE},

                  success:function(data){

                      $('#section_caracteristique').html(data);
                      $(".select2").select2();

                      //$('#city').html('<option value="">Select City</option>');

                  }

              });

          }
          else{

              $('#section_caracteristique').html('');

          }
      });
    });
</script>


