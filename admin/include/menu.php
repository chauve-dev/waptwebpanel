	<div class="sidenav">
  <a href="index.php">Accueil</a>
  <button class="dropdown-btn">Salles
    <i class="fa-caret-down">&#x25BC;</i>
  </button>
  <div class="dropdown-container">
    <a href="voirsalle.php">Voir</a>
    <a href="creersalle.php">Créer</a>
    <a href="limodifsalle.php">Modifier</a>
    <a href="lisupprsalle.php">Supprimer</a>
  </div>

  <button class="dropdown-btn">PC
    <i class="fa-caret-down">&#x25BC;</i>
  </button>
  <div class="dropdown-container">
    <a href="voirpc.php">Voir</a>
    <a href="creerpc.php">Créer</a>
    <a href="limodifpc.php">Modifier</a>
    <a href="lisupprpc.php">Supprimer</a>
  </div>

  <button class="dropdown-btn">Utilisateurs
    <i class="fa-caret-down">&#x25BC;</i>
  </button>
  <div class="dropdown-container">
    <a href="voiruti.php">Voir</a>
    <a href="creeruti.php">Créer</a>
    <a href="liacces.php">Gérer les accès</a>
   	<a href="modifuti.php">Modifier</a>
    <a href="lisuppruti.php">Supprimer</a>
  </div>
  <a href="../index.php">Retour au site</a>
</div>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>