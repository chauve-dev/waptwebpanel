<div id="navbar" class="navbar">
  <a href="index.php">Accueil</a>
  <span>|</span>
  <a href="salles.php">Mes salles</a>
  <span>|</span>
  <div class="dropdown">
    <button class="dropbtn">Mon compte
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="mesinfo.php">Mes informations</a>
      <a href="deconnexion.php">Deconnexion</a>
    </div>
  </div>
  <?php if(isset($_SESSION['uti_statut'])){if ($_SESSION['uti_statut']>0){ ?>
  <a href="admin/index.php" style="float: right;">Panel administrateur</a>
  <?php }} ?>
</div>