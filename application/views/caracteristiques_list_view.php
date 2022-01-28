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

        <a  class="btn btn-block btn-primary pull-right btn-success" id="btn-bitbucket" href="<?php echo base_url()?>Caracteristiques/index_add/">
          <i class="fa fa-plus"></i> Ajouter un nouveau caractéristique
        </a>

      </div>
      <br><br>

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Liste de caractéristiques</h3>

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


<script type="text/javascript">

    $(document).ready(function () {

        $(".editbuttonPropriet").click(function (e) {

            e.preventDefault(e);

            //jQuery.noConflict();

            var iid = $(this).attr('data-id');

            //alert(iid);
            //jQuery.noConflict();
            $('#Modal_liste_proprietaire_mes_comptes').modal('show');



            $.ajax({

                url: '<?=base_url()?>Caracteristiques/list_caracteristiques/', 

                type: 'post',

                data: '',

                dataType: 'json',

                data:{iid:iid},
            }).success(function(response) {



                $('.body_liste_proprietaire_mes_comptes').empty();

                var empRow='';

                if (response.length) {

                    for(emp in response){



                        empRow ='<tr>';

                        empRow += '<th scope="row">'+response[emp].caracteristique+'</th>';

                        empRow += '<th scope="row">'+response[emp].placeholder+'</th>';

                        empRow += '<td>'+response[emp].option+'</td>';
                        empRow += '</tr>';
 
                        $('.body_liste_proprietaire_mes_comptes').append(empRow);



                    }



                }



            });

        });

    });

</script>