<?php ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">FilmSQL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
	  
        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            CREER
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="index.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 1 </span> Créer table film</a></li>
            <li><a class="dropdown-item" href="creer_table2.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 2 </span> Créer table acteur</a></li>
            <li><a class="dropdown-item" href="creer_table3.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 6 </span> Clef étrangère et création de la table</a></li>
			   <li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="creer_table4.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> ? </span> Créer table réalisateur</a></li>   

          </ul>
        </li>
		
		<li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            INSERER
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="data1.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 3 </span>Insérer des données : methode 1</a></li>
			<li><a class="dropdown-item" href="data2.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 4 </span>Insérer des données : methode 2</a></li>
            <li><a class="dropdown-item" href="data3.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 7 </span>Insérer des données avec clef étrangère</a></li>
          </ul>
        </li>
		
		<li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            MODIFIER
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="update.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 9 </span> Mettre à jour des données</a></li>
            <li><a class="dropdown-item" href="delete.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 10 </span>Supprimer des données</a></li>
			 <li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="alter.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 11 </span> Modifier table</a></li> 
			
          </ul>
        </li>
		
		<li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            CHERCHER
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="select1.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 5 </span> SELECT </a></li>
            <li><a class="dropdown-item" href="join.php"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> 8 </span> Recherche avec des jointures</a></li>
          </ul>
        </li>
		
		<li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            XXXXXX
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> X </span>xxxxxxxxxx</a></li>
            <li><a class="dropdown-item" href="#"><span class='d-inline-block bg-infom-sql text-white px-2 py-1'> X </span>xxxxxxxxxxxxxx</a></li>
          </ul>
        </li>

		
      </ul>
    </div>
  </div>
  <button class="btn btn-outline-success" type="submit"><?php echo $_SESSION['login']?></button>
  <a class="btn btn-danger" href="logout.php" role="button" title="Déconnexion"></a>
</nav>
<?php ?>