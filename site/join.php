<?php 
session_start();

if(isset($_SESSION['id']) AND $_SESSION['profile']=='P' ) {
include_once 'include/fonctions.php';
include_once 'images/icon/ico.php';
$films = new films();
?>
<html>
<head>
	<meta charset ="utf-8">
	<title> Etape 8- JOINTURE</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	
	<link href="css/style.css" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<div class="container">
<?php include "menu.php";?>
<div class="card">
	<div class="card-header">
		<h4><span class='d-inline-block bg-info-sql text-white px-2 py-1'> 8 </span> JOINTURE</h4>
	</div>

<div class="card-body">
	

<div class="mb-3">
		<span class='d-inline-block bg-info-sql-l text-white px-2 py-1'>A</span> <strong>Comment faire ?</strong> </br>
	En observant <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#myModal">
  les tables
</button>, déterminer dans quels films joue l'acteur Omar SY ? Quelle démarche faites vous ?


</div>
<div class="mb-3">
		<span class='d-inline-block bg-info-sql-2 text-white px-2 py-1'>a-1</span> <strong>Requête SQL sur 2 tables </strong> </br>
	<div class="row">
	<p>Les jointures en SQL permettent d’associer plusieurs tables dans une même requête. Pour obtenir les données de plusieurs table.En général, les jointures consistent à associer des lignes de 2 tables. Elles permettent d'établir un lien entre 2 tables. Qui dit lien entre 2 tables dit souvent clé étrangère et clé primaire.</p>
</div>	
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        La requête SQL fournissant les "id_film" des films  dans lequel joue Omar SY :
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
			<pre class="pre_sql">
			SELECT id_film FROM jouer
			JOIN acteur ON id_acteur = id_act
			WHERE (nom, prenom) = ("Sy","Omar");
			</pre>
	  </div>
    </div>
  </div>
</div>
</div>
<ul>
<li>Quels sont les rôles joués par Audrey Tautou ?</li>
<li>En quelles années sont sortis les film dont un rôle est Samuel ?</li>
<li>Quels sont les titres de films réalisés par Jean-Pierre Jeunet ?</li>
</ul>
	<div class="row">
		  <p id="data1" >
         Analyser et exécuter la requète précédente
		 </p>
        </div>




<form method="post" action="" id="myForm1">
	<div class="row">    
         <div class="col-md-6 mb-3" style="height:150px"> 
			<input name="req_sql1" type="text" hidden id="text_create">
			<div  id="editor" ></div>
          </div>
		  <div class="col-md-6 mb-3 " >		
			<div class="btn-group-vertical">
				<button type="submit" class="btn btn-success"name="execute_req1" value="execute_req1">Exécuter la requête</button>	
			</form>
			<?php if (isset($_GET['er'])){  $message = $films->message($_GET['er']); ?>
				<button  type="button"class="btn btn-outline-danger " disabled> <?php echo $message;?></button>
			<?php } ?>	
			<?php if(isset($_POST['execute_req1'])){
									$resus = $films-> join1($_POST['req_sql1'],'join','join');
					}
					?>	
			</div>
		</div>
</div>

<?php $affichage = $films ->affich_resu($resus);?>

</div>



<div class="card-body">
	

<div class="mb-3">
		<span class='d-inline-block bg-info-sql-2 text-white px-2 py-1' id ="a2" >a-2</span> <strong>Requête SQL sur 3 tables </strong>
		 </br>
	<p> </p>
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
	<form class="row">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
        Déterminer les titres des films en fonction des actrices ou acteurs :	
<a type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#Modal2"><img src="images/icon/h.png" width="20px"> </a>		
      </button>
	  </form>
    </h2>
<?php if($_GET['mp']=="a"){?>	
    <div id="flush-collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample" >
      <div class="accordion-body">
			<pre class="pre_sql">
			SELECT titre FROM film 
			JOIN jouer ON film.id_film=jouer.id_film 
			JOIN acteur ON id_act=id_acteur 
			WHERE (nom,prenom) =("Sy","Omar");
			</pre>
	  </div>
    </div>
<?php } ?>	
  </div>
</div>
<ul>
<li>Quels sont les acteurs qui ont joué dans "Intouchables" ?</li>
<li>Dans quels films jouent des actrices prénommées Audrey ?</li>
<li>En quelles années Charlotte Gainsbourg a-t-elle tourné des films ?</li>
<li>Quels sont les titres de films dans lesquels un acteur porte le même nom que le réalisateur  ?</li>
</ul>
</div>
	<div class="row">
		  <p id="data1" >
         Essayer vos requêtes :
		 </p>
        </div>




<form method="post" action="" id="myForm2">
	<div class="row">    
         <div class="col-md-6 mb-3" style="height:150px"> 
			<input name="req_sql2" type="text" hidden id="text_create2">
			<div  id="editor2" ></div>
          </div>
		  <div class="col-md-6 mb-3 " >
			<div class="btn-group-vertical">
				<button type="submit" class="btn btn-success"name="execute_req2" value="execute_req2">Exécuter la requête</button>	
			</form>
			<?php if (isset($_GET['er'])){  $message = $films->message($_GET['er']); ?>
				<button  type="button"class="btn btn-outline-danger " disabled> <?php echo $message;?></button>
			<?php } ?>	
			<?php 
					if(isset($_POST['execute_req2'])){
						$test=$_POST['req_sql2'];
									$results = $films-> select($_POST['req_sql2']);
					}
					?>
			</div>
		</div>

</div>

<?php $affichage = $films ->affich_resu($results);?>

</div>


<!-- boite de dialogue liste des tables -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Liste des tables</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

	
	<div class="col">
		<nav class="nav nav-tabs nav-tabs-card">
			<a class="nav-item nav-link active " href="#acteur" data-toggle="tab">acteur :</a>
			<a class="nav-item nav-link " href="#film" data-toggle="tab">film :</a>
			<a class="nav-item nav-link " href="#jouer" data-toggle="tab">jouer :</a>
		</nav>
		<div class="tab-content">
			<div class="tab-pane active" id="acteur">
				 <div class="table-responsive">
					<table class="table table-striped table-sm">
						<thead>
							<th>id_acteur</th>
							<th>nom</th>
							<th>prenom</th>
						</thead>
						<tbody>
						
						<?php $data_film= $films->select_all('acteur') ;
						$row=0;
							foreach($data_film AS $film){
								$row++;
						?>
							<tr>
							  <td><?php echo $film['id_acteur'];?></td>
							  <td><?php echo $film['nom'];?></td>
							  <td><?php echo $film['prenom'];?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>	  		  
			 </div>
			 
			 <div class="tab-pane " id="film">
				 <div class="table-responsive">
					<table class="table table-striped table-sm">
						<thead>
							<th>id_film</th>
							<th>titre</th>
							<th>annee</th>
						</thead>
						<tbody>
						<?php $data_film= $films->select_all('film') ;
							foreach($data_film AS $film){
						?>
							<tr>
							  <td><?php echo $film['id_film'];?></td>
							  <td><?php echo $film['titre'];?></td>
							  <td><?php echo $film['annee'];?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>	  		  
			 </div>
			  
			 <div class="tab-pane " id="jouer">
				 <div class="table-responsive">
					<table class="table table-striped table-sm">
						<thead>
							<th>role</th>
							<th>id_acteur</th>
							<th>id_film</th>
						</thead>
						<tbody>
						<?php $data_film= $films->select_all('jouer') ;
							foreach($data_film AS $film){
						?>
							<tr>
							  <td><?php echo $film['role'];?></td>
							  <td><?php echo $film['id_act'];?></td>
							  <td><?php echo $film['id_film'];?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>	  		  
			 </div>
			 
		</div>

	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div><!-- -->
	
<!-- boite de dialogue mot de passe -->
<div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">AIDE</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form id="form_pass" method="post">
      <div class="modal-body">
		<input class="form-control form-control-lg" type="text" placeholder="Entrer le code" aria-label="Entrer le code" name="mp">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">FERMER</button>
        <button type="submit" class="btn btn-primary">Valider</button>
      </div>
	  </form>
	  <?php if (isset($_POST["mp"])){
		  $pass = $films ->pass($_POST["mp"],'join','a2');
	  }
	  
	  ?>
    </div>
  </div>
</div>




</body>
<!-------pour l'utilisation de l'editeur--------------------->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
	  <script src="js/bootstrap.bundle.js"></script>
	<script src="src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
	<script>


var editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/sql");

var editor2 = ace.edit("editor2");
    editor2.setTheme("ace/theme/twilight");
    editor2.session.setMode("ace/mode/sql");
	
	document.getElementById("myForm1").onsubmit = function() {
		document.getElementById("text_create").value = editor.getValue();
    }
	
	document.getElementById("myForm2").onsubmit = function() {
		document.getElementById("text_create2").value = editor2.getValue();
    }
	
	
	const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})

	


	</script>
<!----------------------------------->
</html>
<?php 
} 
else {
	header("Location: sign_in.php");
}
?>