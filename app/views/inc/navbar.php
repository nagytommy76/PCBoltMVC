<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top position-sticky">
  <a title="Vissza a főoldalra" class="navbar-brand" href="<?php echo URLROOT ?>" >
  <img class="" src="<?php echo ICONROOT?>/ownIcons/supermarket.png">
  Főoldal</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">      
      <!-- CPU-k legördülő menű --> 
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="" src="<?php echo ICONROOT?>/ownIcons/cpu.png">
          CPU</a>
          <div class="dropdown-menu">
            <!-- INTELEK --> 
            <a href="<?php echo URLROOT.'/cpus/intel/intel' ?>" class="dropdown-item" data-toggle="tooltip" data-placement="right" title="Az összes INTEL Processzorunk">INTEL</a>
            <div class="dropdown-divider"></div>
              <a href="<?php echo URLROOT.'/cpus/intel/LGA1151v2'?>" class="dropdown-item">LGA 1151</a>
              <a href="<?php echo URLROOT.'/cpus/intel/LGA2011'?>" class="dropdown-item">LGA 2011</a>
              <a href="<?php echo URLROOT.'/cpus/intel/LGA2066'?>" class="dropdown-item">LGA 2066</a>
              <div class="dropdown-divider"></div>
                <!-- AMD-k --> 
              <a href="<?php echo URLROOT.'/cpus/amd/amd'?>" class="dropdown-item">AMD</a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo URLROOT.'/cpus/amd/am4'?>" class="dropdown-item">AM4</a>
              <a href="<?php echo URLROOT.'/cpus/amd/am3+'?>" class="dropdown-item">AM3+</a>
              <a href="<?php echo URLROOT.'/cpus/amd/tr4'?>" class="dropdown-item">TR4</a>
              <a href="<?php echo URLROOT.'/cpus/amd/sp3'?>" class="dropdown-item">SP3</a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo URLROOT.'/cpus/allCPU'?>" class="dropdown-item">Összes</a>     
          </div>
      </li>
      <!-- CPU-k legördülő menű VÉGE ------------------------------------------------------- --> 

      <!-- ALAPLAP legördülő menű --> 
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="" src="<?php echo ICONROOT?>/ownIcons/motherboard.png">
          Alaplapok</a>
          <div class="dropdown-menu">
            <!-- INTELEK --> 
            <a href="<?php echo URLROOT.'/mbs/intelMb/intel' ?>" class="dropdown-item" data-toggle="tooltip" data-placement="right" title="Az összes INTEL Alaplapunk">INTEL</a>
            <div class="dropdown-divider"></div>
              <a href="<?php echo URLROOT.'/mbs/intelMb/LGA1151v2'?>" class="dropdown-item">LGA 1151</a>
              <a href="<?php echo URLROOT.'/mbs/intelMb/LGA2011'?>" class="dropdown-item">LGA 2011</a>
              <a href="<?php echo URLROOT.'/mbs/intelMb/LGA2066'?>" class="dropdown-item">LGA 2066</a>
              <div class="dropdown-divider"></div>
                <!-- AMD-k --> 
              <a href="<?php echo URLROOT.'/mbs/amdMb/amd'?>" class="dropdown-item">AMD</a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo URLROOT.'/mbs/amdMb/am4'?>" class="dropdown-item">AM4</a>
              <a href="<?php echo URLROOT.'/mbs/amdMb/am3+'?>" class="dropdown-item">AM3+</a>
              <a href="<?php echo URLROOT.'/mbs/amdMb/tr4'?>" class="dropdown-item">TR4</a>
              <a href="<?php echo URLROOT.'/mbs/amdMb/sp3'?>" class="dropdown-item">SP3</a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo URLROOT.'/mbs/allMb'?>" class="dropdown-item">Összes</a>
          </div>
      </li>
      <!-- ALAPLAP legördülő menű VÉGE ------------------------------------------------------- --> 

      <!-- Felhasználói fiók műveletek --> 
      <li class="nav-item dropdown">       
        <!-- Ha nincs bejelentkezve senki sem --> 
        <?php if(!isset($_SESSION['email'])) : ?>       
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="" src="<?php echo ICONROOT?>/ownIcons/user.png">
          Felhasználók <span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo URLROOT.'/users/login' ?>">Bejelentkezés</a>
          <a class="dropdown-item" href="<?php echo URLROOT.'/users/register'; ?>">Regisztráció</a>          
        </div>
          <!-- Ha be vanjelentkezve valaki --> 
        <?php else :  ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="" src="<?php echo ICONROOT?>/ownIcons/man.png"> <?php echo $_SESSION['username']; ?> <span class="sr-only">(current)</span>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?php echo URLROOT.'/users/logout' ?>">Kijelentkezés</a>
          <a class="dropdown-item" href="<?php echo URLROOT.'/users/data' ?>">Saját adatok</a>

          <!-- Ha valaki adminként jelentkezik be akkor éri el ezeket a menüket --> 
          <?php if($_SESSION['jog'] == 'eladó' || $_SESSION['jog'] == 'admin') : ?>   
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-primary" href="<?php echo URLROOT.'/admins/userHandler' ?>">Felhasználók kezelése</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Termékek bevitele</h6>
            <a class="dropdown-item text-warning" href="<?php echo URLROOT.'/admins/cpu_input' ?>">CPU bevitele</a>
            <a class="dropdown-item text-warning" href="<?php echo URLROOT.'/admins/mb_input' ?>">Alaplap bevitele</a>
            <div class="dropdown-divider"></div>        
          <?php endif; ?>
        </div>        
        <?php endif; ?>

        
        
      </li>
    </ul>
  </div>
</nav>