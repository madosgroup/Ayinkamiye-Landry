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
  
  <!--modal add province-->
  <div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">  
              <h4 class="modal-title">Ajouter une nouvelle site</h4>
            </div>
            <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label>Site</label>
                    <input type="text" name="" class="form-control" id="nom_site" placeholder="Site">
                  </div>
                  
                  
                </form>
            </div>
            <div class="modal-footer">
              <a class="btn  btn-primary btn-md" href="" id="btn_add_site">Enregistrer</a>

              <button class="btn  btn-md" class="close" data-dismiss="modal" id="btn_annuler">Fermer</button>
            </div>
        </div>
    </div>
  </div>
  <!--modal add province-->

  <!--modal update province--> 
  <div id="myModalUpdate" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button> 
                <h4 class="modal-title">Modifier le site</h4>
            </div>
            <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label>Site</label>
                    <input type="text" name="" class="form-control" id="nom_site_update" placeholder="Site">
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="" class="form-control" id="id_site_update">
                  </div>
                  
                  
                </form>
            </div>
            <div class="modal-footer">
              <a class="btn  btn-success btn-md" href="" id="btn_update_site">Modifier</a>

              <button class="btn  btn-md" class="close" data-dismiss="modal" id="btn_annuler">Fermer</button>
            </div>
        </div>
    </div>
  </div>
  <!--modal update province-->

  <!--success modal-->
  <div id="myModalApprouver" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header" style="background-color:  white;"> 
            <div class="icon-box">
                <i class="material-icons">&#xE876;</i>
            </div>              
            <h4 class="modal-title" style="color:  black;">Succès!</h4>   
        </div>
        <div class="modal-body">
            <p class="text-center" id="text_success"></p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success btn-block" data-dismiss="modal" id="btn_success_approuver">OK</button>
        </div>
      </div>
    </div>
  </div>
  <!--success modal-->

  <!--success modal update-->
  <div id="myModalApprouverUpdate" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header" style="background-color:  white;"> 
            <div class="icon-box">
                <i class="material-icons">&#xE876;</i>
            </div>              
            <h4 class="modal-title" style="color:  black;">Succès!</h4>   
        </div>
        <div class="modal-body">
            <p class="text-center" id="text_success_update">La vente a été enregistrée avec succès.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success btn-block" data-dismiss="modal" id="btn_success_approuver_update">OK</button>
        </div>
      </div>
    </div>
  </div>
  <!--success modal update-->
  
  <!--error modal-->
  <div id="myModalError" class="modal fade" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-error">
      <div class="modal-content">
        <div class="modal-header">
          <div class="icon-box">
            <i class="material-icons"></i>
          </div>        
          <h4 class="modal-title w-100">Sorry!</h4> 
        </div>
        <div class="modal-body">
          <p class="text-center" id="text_error">Your transaction has failed. Please go back and try again.</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger btn-block" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>
  <!--error modal-->
 

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

<script>
  $(document).ready(function() {

    $("#btn-bitbucket").click( function(){

      $('#myModal').modal('toggle');
    });

  });
</script>

<script>
  $(document).ready(function() {  

    $('#btn_add_site').click(function(e){

      e.preventDefault();

      var nom_site=$('#nom_site').val();


      if (nom_site != '') {

        $.ajax({

          url:"<?php echo base_url(); ?>Sites/addSite/",

          method:"POST",

          dataType: 'json',

          data:{nom_site:nom_site},

          success:function(data){

            console.log(data);



            if (data.status==1) {

              

              
              $("#text_success").text(data.message);
              $('#myModalApprouver').modal('toggle');
              $('#nom_site').val('');


            }
            else{

              $("#text_error").text(data.message);
              $('#myModalError').modal('toggle');
            }


          }

        });

      } 
      else{

        alert("Site est un champ obligatoire.");

      }


    });

  });
</script>

<script>

   $(document).ready(function() {

      $('#btn_annuler').click(function(){

        location.reload();


      });
   });

</script>

<script>

   $(document).ready(function() {

      $('#btn_success_approuver_update').click(function(){

        location.reload();


      });
   });

</script>

<script type="text/javascript">

  $(document).ready(function () {

    $(".editbuttonSite").click(function (e) { 

      var site_id = $(this).attr('data-id');

      //debut
      $.ajax({

        url:"<?php echo base_url(); ?>Sites/site_index_update/",

        method:"POST",

        dataType: 'json',

        data:{site_id:site_id},

        success:function(data){

          $('#id_site_update').val(data.id_site);        
          $('#nom_site_update').val(data.nom_site);        
          $('#myModalUpdate').modal('show');


        }

      });
      //fin

      

    });

  });

</script>

<script>
  $(document).ready(function() {  

    $('#btn_update_site').click(function(e){

      e.preventDefault();

      var id_site=$('#id_site_update').val();
      var nom_site=$('#nom_site_update').val();


      if (nom_site != '' && id_site != '' ) {

        $.ajax({

          url:"<?php echo base_url(); ?>Sites/site_update",

          method:"POST",

          dataType: 'json',

          data:{nom_site:nom_site,id_site:id_site},

          success:function(data){

            if (data.status==1) {
              
              $('#myModalUpdate').modal('hide');
              $("#text_success_update").text(data.message); 
              $('#myModalApprouverUpdate').modal('toggle');


            }
            else{

              $("#text_error").text(data.message);
              $('#myModalError').modal('toggle');
            }


          }

        });

      } 
      else{

        alert("Province est un champ obligatoire.");

      }


    });

  });
</script>

<script type="text/javascript">

  $(document).ready(function () {

    

    $(document).on('click', '.supprimerbuttonSite', function(e){  

      var site_id = $(this).attr('data-id');

      //debut
      $.ajax({

        url:"<?php echo base_url(); ?>Sites/delete/",

        method:"POST",

        dataType: 'json',

        data:{site_id:site_id},

        success:function(data){

          if (data.status==1) {
              
            $('#mydelete'+site_id).modal('hide');
            $("#text_success_update").text(data.message); 
            $('#myModalApprouverUpdate').modal('toggle');


          }
          else{

            $("#text_error").text(data.message);
            $('#myModalError').modal('toggle');
          }


        }

      });
      //fin

      

    });

  });

</script>
