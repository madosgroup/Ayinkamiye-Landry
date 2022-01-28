<?php

 include 'includes/header.php';

?>
<div class="wrapper">

  <?php

    include 'includes/barre_bleu.php';

  ?>
  
  <?php
    
    $parametrage='active';
    $type_propriete='';
    $caracteristiques_proprietes='active';

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

        <a  class="btn btn-block btn-primary pull-right btn-success" id="btn-bitbucket" href="<?php echo base_url()?>Caracteristiques/">
          <i class="fa fa-plus"></i> Liste de caractéristiques
        </a>

      </div>
      <br><br>

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Ajouter un nouveau caractéristique </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          
          <form method="post" action="<?php echo base_url()?>Caracteristiques/add/" id="myform">

            

            <div class="form-group"> 
              <label for="exampleInputEmail1">Type de propriété</label>

              <select name="type_propriete" class="form-control select2 ">
                <option value="">-- Selectionner un type de propriété --</option>
                <?php foreach($list_type_propriete as $type_prop):?>
                  <option value="<?php echo $type_prop['CODE_TYPE_PROPRIETE']?>" <?php echo set_select('type_propriete',$type_prop['CODE_TYPE_PROPRIETE']); ?>><?php echo $type_prop['TYPE_PROPRIETE'] ?></option>
                <?php endforeach;?>
              </select>

              <?php echo form_error('type_propriete', '<span class="text-center text-danger">', '</span>'); ?>

            </div>

                

            <div class="form-group"> 
              <label for="exampleInputEmail1">Caractéristiques</label> 

              <table class="table table-bordered" >

                <thead>
                  <tr>
                    <th>Caractéristique</th> 
                    <th>Placeholder</th>
                    <th >Options</th>
                  </tr>
                </thead>

                <tbody id="dynamic_part_priv">
                  <tr>

                    <td>
                      <input type="text" name="nom_caracterique[]" class="form-control input-sm" placeholder="Caractéristique" >
                    </td>

                    <td>
                      <input type="text" name="placeholder_caracterique[]" class="form-control input-sm" placeholder="Placeholder">
                    </td>

                    
                    <td><button type="button" id="add_part_priv" class="btn btn-success glyphicon glyphicon-plus add_part_priv"></button></td>
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

    $(document).ready(function() {


      $(".select2").select2();
    });

</script>

<script type="text/javascript">
  $(document).ready(function(){
        var i=1; 
        $('#add_part_priv').click(function(){

         
          i++;
          $('#dynamic_part_priv').append('<tr id="row'+i+'"><td><input type="text" name="nom_caracterique[]" class="form-control input-sm" placeholder="Caractéristique"></td><td><input type="text" name="placeholder_caracterique[]" class="form-control input-sm" placeholder="Placeholder"></td><td><button type="button"  id="add_part_priv" class="btn btn-success btn_add_eq btn_add_part_priv glyphicon glyphicon-plus"></button><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_part glyphicon glyphicon-remove" style="margin-left:5px"></button></td></tr>');
        });

        $(document).on('click', '.btn_add_eq', function(){

          $('#dynamic_part_priv').append('<tr id="row'+i+'"><td><input type="text" name="nom_caracterique[]" class="form-control input-sm" placeholder="Caractéristique"></td><td><input type="text" name="placeholder_caracterique[]" class="form-control input-sm" placeholder="Placeholder"></td><td><button type="button"  id="add_part_priv" class="btn btn-success btn_add_eq btn_add_part_priv glyphicon glyphicon-plus"></button><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_part glyphicon glyphicon-remove" style="margin-left:5px"></button></td></tr>');

        });

       $(document).on('click', '.btn_remove_part', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();

      }); 

        

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){

      $(".btn_save").click(function(){

          var form = $("#myform");
          form.validate({

              errorElement: 'span',

              errorClass: 'help-block',

              highlight: function(element, errorClass, validClass) {

                  $(element).closest('.form-group').addClass("has-error");

              },

              unhighlight: function(element, errorClass, validClass) {

                  $(element).closest('.form-group').removeClass("has-error");

              },
              rules: {

                  type_propriete: {

                    required: true,

                  },

                  'nom_caracterique[]': {

                    required: true,

                  }

              },
              messages: {

                  type_propriete: {

                    required: "Ce champ est requis",

                  },

                  'nom_caracterique[]': {

                    required: "Ce champ est requis",

                  }

              }
          });
          if (form.valid() === true){

            form.submit();

          }
      });
  });
</script>


