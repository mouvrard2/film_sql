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
	<title> Etape 5- SELECTIONNER</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	
	<link href="css/style.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
	<style type="text/css">
</style>
</head>

<body>
<div class="container">
<?php include "menu.php";?>
<div class="card">
	<div class="card-header">
		<h4><span class='d-inline-block bg-info-sql text-white px-2 py-1'>5</span>SELECT SQL</h4>
	</div>

<div class="card-body">
	<p>L’utilisation la plus courante de SQL consiste à lire des données issues de la base de données</p>

<div class="mb-3">
		<span class='d-inline-block bg-info-sql-l text-white px-2 py-1'>A</span> <strong>SELECT</strong> </br>
	La commande SELECT retourne des enregistrements dans un tableau de résultat. Cette commande peut sélectionner une ou plusieurs colonnes d’une table.
	
</div>

	<div class="row">
          <div class="col-md-12 mb-3">
		  L’utilisation basique de cette commande s’effectue de la manière suivante un * la place de nom_du_champ permet de selectionner toutes les colonnes du tableau:
			<pre class="pre_sql">
		SELECT nom_du_champ FROM nom_du_tableau
			</pre>

          </div>
	<!----	  <p id="data1" >
         /!\ avec cette méthode remplir  <strong>toutes les données </strong>  en respectant l'ordre sinon il peut y avoir des valeurs  misent dans la mauvaise colonne colonne
		 </p> -->
		   <div class="accordion-item">
    <h2 class="accordion-header">
	<form >
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
        Déterminer les noms des actrices ou acteurs de notre table :	
<a type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#Modal2"><img src="images/icon/h.png" width="20px"> </a>		
      </button>
	  </form>
    </h2>
<?php if("a"=="a"){?>	
    <div id="flush-collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample" >
      <div class="accordion-body">
			<pre class="pre_sql">
			SELECT nom FROM acteur;
			</pre>
	  </div>
    </div>
<?php } ?>	
  </div>
		 
        </div>

<form method="post" action="" id="myForm1">
	<div class="row">    
         <div class="col-md-6 mb-3" style="height:150px"> 
			<input name="req_sql1" type="text" hidden id="text_create">
			<div  id="editor" ></div>
          </div>
		  <div class="col-md-6 mb-3 " >
				
			<div class="btn-group-vertical">
	
				<button type="submit" class="btn btn-success"name="execute_req1" value="execute_req1">Exécuter la requête de recherche de données</button>
							
			</form>
			<?php if (isset($_GET['er'])){  $message = $films->message($_GET['er']); ?>
				<button  type="button"class="btn btn-outline-danger " disabled> </button>
			<?php } ?>	
			<?php 
					if(isset($_POST['execute_req1'])){
									$rep = $films-> select($_POST['req_sql1']);
					}
					?>
		
			</div>
	
		</div>

</div>
</div>
<div class="card-body">
	<div class="mb-3 " >
			<span class='d-inline-block bg-info-sql-l text-white px-2 py-1'>b</span> Résultat de la requète
	</div>
	<div>
     <?php if (isset($rep)){
         foreach($rep as $reps){
             echo $reps['nom']."<br />";
                }
     }?>
    </div>
	<div >
	<a class="btn btn-primary" href="creer_table3.php" role="button">Activité suivante : clef étrangère --> </a>
	
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
	
	document.getElementById("myForm1").onsubmit = function() {
		document.getElementById("text_create").value = editor.getValue();
    }
	
	</script>
<!----------------------------------->
</html>	
<?php 
} 
else {
	header("Location: sign_in.php");
}
?>