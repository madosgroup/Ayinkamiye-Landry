<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less --> 
    <section class="sidebar"> 
      <!-- Sidebar user panel -->
      <div class="user-panel">
        
        <div class="pull-left image">
          <img src="<?php echo base_url()?>assets/dist/img/default-doctor-avatar.png" class="user-image" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Ayinkamiye Landry</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div> 
      </form> 
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree"> 

        <li class="treeview <?= $parametrage ?>"> 
          <a href="#">

            <i class="fa fa-cogs"></i>  

            <span>Paramétrage </span>    

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i> 

            </span> 

          </a>  

          <ul class="treeview-menu"> 

            <li class="<?= $type_propriete?>"><a href="<?php echo base_url()?>TypePropriete/"><i class="fa fa-circle-o"></i> Types de propriétés </a></li>

            <li class="<?= $caracteristiques_proprietes?>"><a href="<?php echo base_url()?>Caracteristiques/"><i class="fa fa-circle-o"></i> Caractéristiques des propriétés  </a></li>  

          </ul> 
        </li>
        
        
        
        <li class="treeview <?= $gestion_proprietes ?>">
          <a href="#">

            <i class="fa fa-cogs"></i> 

            <span>Gestion des propriétés </span>   

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i> 

            </span> 

          </a>  

          <ul class="treeview-menu">  
            
            <li class="<?= $nouvelle_proprietes?>"><a href="<?php echo base_url()?>Propriete/index_add/"><i class="fa fa-circle-o"></i> Ajouter une nouvelle propriétés </a></li>

            <li class="<?= $liste_proprietes?>"><a href="<?php echo base_url()?>Propriete/"><i class="fa fa-circle-o"></i> Liste de propriétés </a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">

            <i class="fa fa-cogs"></i> 

            <span>Gestion des clients </span>   

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i> 

            </span> 

          </a>  

          <ul class="treeview-menu">
            <li class=""><a href="<?php echo base_url()?>Propriete/"><i class="fa fa-circle-o"></i> Liste de clients </a></li>

          </ul>
        </li>

        <li class="treeview ">
          <a href="#">

            <i class="fa fa-cogs"></i> 

            <span>Gestion des paiements </span>   

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i> 

            </span> 

          </a>  

          <ul class="treeview-menu">  
            
            

            <li ><a href=""><i class="fa fa-circle-o"></i> Liste de paiements </a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">

            <i class="fa fa-cogs"></i> 

            <span>Gestion des utilisateurs </span>   

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i> 

            </span> 

          </a>  

          <ul class="treeview-menu">  
            
            <li class=""><a href="<?php echo base_url()?>Propriete/index_add/"><i class="fa fa-circle-o"></i> Ajouter un nouveau utilisateur </a></li>

            <li class=""><a href="<?php echo base_url()?>Propriete/"><i class="fa fa-circle-o"></i> Liste des utilisateurs </a></li>

          </ul>
        </li>

        <li class="treeview">
          <a href="#">

            <i class="fa fa-cogs"></i> 

            <span>Admnistration </span>   

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i> 

            </span> 

          </a>  

          <ul class="treeview-menu">  
            
            <li class=""><a href=""><i class="fa fa-circle-o"></i> Ajouter un nouveau profil </a></li>

            <li class=""><a href=""><i class="fa fa-circle-o"></i> Liste des profils </a></li>

          </ul>
        </li>


        
        
        

        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>