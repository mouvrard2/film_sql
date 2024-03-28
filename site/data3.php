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
	<title> Etape 5- INSERRER</title>
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
		<h4><span class='d-inline-block bg-info-sql text-white px-2 py-1'>5</span>Insérer des données</h4>
	</div>

<div class="card-body">
	<p>Les tables sont créées mais il n'y a pas de données</p>

<div class="mb-3">
		<span class='d-inline-block bg-info-sql-l text-white px-2 py-1'>A</span> <strong>INSERT INTO</strong> </br>
	L’insertion de données dans une table s’effectue à l’aide de la commande INSERT INTO.
	
</div>
	<div class="mb-3">
		<span class='d-inline-block bg-info-sql-2 text-white px-2 py-1'>a-1</span> <strong>Insérer une ligne en spécifiant les valeurs pour toutes les colonnes</strong> </br>
	L’insertion de données dans une table s’effectue à l’aide de la commande INSERT INTO.
	
</div>
	<div class="row">
          <div class="col-md-12 mb-3">
		  La syntaxe pour insérer des données en es valeurs pour toutes les colonnes :
			<pre class="pre_sql">
		INSERT INTO table VALUES ('valeur_1', 'valeur_2', ....)
			</pre>

          </div>
		  <p id="data1" >
         /!\ avec cette méthode remplir  <strong>toutes les données </strong>  en respectant l'ordre sinon il peut y avoir des valeurs  misent dans la mauvaise colonne colonne
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
	
				<button type="submit" class="btn btn-success"name="execute_req1" value="execute_req1">Exécuter la requête d'insertion de données</button>
					
		
				<button type="submit" class="btn btn-warning"name="execute_req2" value="execute_req2">Insérer les données </button>
		
				<button type="submit" class="btn btn-danger"name="execute_req3" value="execute_req3">Supprimer la données</button>
				
			</form>
			<?php if (isset($_GET['er'])){  $message = $films->message($_GET['er']); ?>
				<button  type="button"class="btn btn-outline-danger " disabled> <?php echo $message;?></button>
			<?php } ?>	
			<?php 
					if(isset($_POST['execute_req1'])){
									$exec = $films-> insert_table($_POST['req_sql1'],'data1','data1');
					}
					elseif (isset($_POST['execute_req3'])){
						
						//$exec = $films-> sup_table2('jouer');
					}
					?>
		
			</div>
	
		</div>

</div>
</div>
<div class="card-body">
	<div class="mb-3 " >
			<span class='d-inline-block bg-info-sql-l text-white px-2 py-1'>b</span>Liste de données des tables
	</div>
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
							<th>id_act</th>
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
	<a class="btn btn-primary" href="creer_table3.php" role="button">Activité suivante : insérer des données --> </a>
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