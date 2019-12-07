<nav class="navbar navbar-expand-lg fixed-top position-sticky">
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
          Alaplap</a>
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

      <!-- RAM legördüló menü kezdete  -->
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="" src="<?php echo ICONROOT?>/ownIcons/ram-memory.png">
          Memória</a>
          <div class="dropdown-menu">
            <!-- INTELEK --> 
            <a href="<?php echo URLROOT.'/rams/ddr3' ?>" class="dropdown-item" data-toggle="tooltip" data-placement="right" title="DDR3 RAM-ok">DDR3</a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo URLROOT.'/rams/ddr4' ?>" class="dropdown-item" data-toggle="tooltip" data-placement="right" title="DDR4 RAM-ok">DDR4</a>

          </div>
      </li>
      <!-- RAM legördüló menü VÉGE -->

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
          <a class="dropdown-item" id="logOut" href="<?php echo URLROOT.'/users/logout' ?>">Kijelentkezés</a>
          <a class="dropdown-item" href="<?php echo URLROOT.'/users/data' ?>">Saját adatok</a>

          <!-- Ha valaki adminként/eladó jelentkezik be akkor éri el ezeket a menüket --> 
          <?php if(bothAdminSeller($_SESSION["jog"])) : ?>   
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-primary" href="<?php echo URLROOT.'/admins/userHandler' ?>">Felhasználók kezelése</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Termékek bevitele</h6>
            <a class="dropdown-item text-warning" href="<?php echo URLROOT.'/admins/cpu_input' ?>">CPU bevitele</a>
            <a class="dropdown-item text-warning" href="<?php echo URLROOT.'/admins/mb_input' ?>">Alaplap bevitele</a>
            <a class="dropdown-item text-warning" href="<?php echo URLROOT.'/admins/ram_input' ?>">RAM bevitele</a>
            <div class="dropdown-divider"></div>        
          <?php endif; ?>
        </div>        
        <?php endif; ?>

      </li>

      <!-- Cart MODAL -->
      <li class="nav-item">
        <button class="btn btn-secondary mr-3" data-target="#cartModal" data-toggle="modal" type="button" id="cartBTN" aria-labelledby="cartModal">Kosár</button>
      </li>

      <!-- CART MODAL END -->

      <!-- Search MODAL!!! -->
      <li class="nav-item">
        <button class="btn btn-success my-2 my-sm-0" data-target="#searchModal" data-toggle="modal" type="button" id="searchModalBTN" aria-labelledby="searchModal">Keresés</button>
      </li>
    </ul>

    <!-- CART MODAL -->

    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
            <h4 class="modal-title"><?php echo (!isset($_SESSION["jog"]) ? 'Az Ön' : $_SESSION["username"]) ?> kosara</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <h4><?php echo (!isset($_SESSION["jog"]) ? 'A vásárláshoz be kell jelentkezni' : 'Ez a funkció jelenleg fejlesztés alatt áll!') ?></h4>
            <!-- MODAL OUTPUT -->
            <div class="pt-3 pb-4" id="modalCartOutput">

            </div>
          <div class="modal-footer">            
            <button type="button" class="btn btn-danger" data-dismiss="modal">Bezárás</button>
            <button type="button" class="btn btn-success" data-dismiss="modal">Tovább az összesítéshez</button>
        </div>
        </div>
      </div>
    </div>
  </div> <!-- MODAL CART FADE OVER -->

    <!-- CART MODAL END -->

      <!-- SEARCH MODAL -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content text-dark">
          <div class="modal-header">
            <h4 class="modal-title">Keresés a weboldalon!</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </div>
          <div class="modal-body">
            <form class="p-3" method="GET">
              <label for="category">Kategória: </label>
              <select class="form-control" name="category" id="category">
                <option value="cpu">CPU</option>
                <option value="motherboard">Alaplap</option>
                <option value="ram">RAM</option>
              </select>
              <label for="manufacturer">Gyártó: </label>
              <select class="form-control" name="manufacture" id="manufacture">
                <option value="" selected>Nincs megadva</option>
                <option value="intel">Intel</option>
                <option value="amd">AMD</option>
              </select>
              <label for="modalInput">Termék típus </label>
              <input class="form-control" type="text" name="modalInput" id="modalInput">
              <!-- <input type="submit" class="btn btn-danger" value="Bezárás"> -->
            </form>
            <!-- MODAL OUTPUT -->
            <div class="pt-3 pb-4" id="modalOutput">

            </div>
          <div class="modal-footer">            
            <button type="button" class="btn btn-warning" data-dismiss="modal">Bezárás</button>
        </div>
        </div>
      </div>
    </div>
  </div> <!-- MODAL SEARCH FADE OVER -->
  </div>  <!-- collapse navbar-collapse OVER -->
</nav>