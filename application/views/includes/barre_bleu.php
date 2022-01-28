<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>G</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Mados</b> Group</span> 
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav"> 
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="<?php echo base_url()?>uploads/utilisateurs/<?= $this->session->userdata('PHOTO_UTILISATEUR') ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $this->session->userdata('NOM_UTILISATEUR') ?> <?= $this->session->userdata('PRENOM_UTILISATEUR') ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url()?>uploads/utilisateurs/<?= $this->session->userdata('PHOTO_UTILISATEUR') ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->userdata('NOM_UTILISATEUR') ?> <?= $this->session->userdata('PRENOM_UTILISATEUR') ?>
                  <small><?= $this->session->userdata('NOM_PROFIL') ?></small>
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url()?>Change_password/" class="btn btn-default btn-flat">Change password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()?>Login/do_logout" class="btn btn-default btn-flat">Déconnexion</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>