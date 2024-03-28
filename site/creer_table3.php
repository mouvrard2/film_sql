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
	<title> Etape 6 - Table jouer et clef étrangère</title>
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
		<h4><span class='d-inline-block bg-info-sql text-white px-2 py-1'>6</span> Créer table "jouer"</h4>
	</div>

<div class="card-body">
	<p>On souhaite connaitre le role et le nom des acteurs qui ont joué dans un film.</p>

<div class="mb-3">
		<span class='d-inline-block bg-info-sql-l text-white px-2 py-1'>A</span> <strong>Comment créer une telle table</strong> </br>

</div>
	
		<h6 id="acteur">Créer la table "jouer" :</h6>
		
			avec  :	
		<ul>
		<li><strong>id_jouer:</strong> identifiant unique qui est utilisé comme clé primaire et qui n’est pas nulle et (peut être auto incrémentée à chaque nouvel enregistrement).
		(on pourrait utiliser les 2 clefs étrangères comme clef primaire. Pour faciliter les requètes des exercices à suivre, on cré une clef primaire auto_incrémenté)</li>
		<li><strong>role :</strong> role de l'acteur type de donnée à déterminer</li>
		<li><strong>id_act :</strong> id_acteur  type de donnée à déterminer, clef étrangère</li>
		<li><strong>id_film :</strong> id_film  type de donnée à déterminer, clef étrangère</li>
		</ul>	
		
		 <div class="row">
          <div class="col-md-12 mb-3">
		  La syntaxe générale pour créer une table avec une clef étrangère est la suivante :
			<pre class="pre_sql">
CREATE TABLE nom_de_la_table
(
 colonne1 type_donnees,
 colonne2 type_donnees,
 FOREIGN KEY (colonne2) REFERENCES table(la_clef_étrangère)*
)
			</pre>
			*la requète de création d'une clef étrangère n'est pas demandée pour le Bac mais comprendre sa logique.
          </div>
         
        </div>
		
		
		
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
	<form class="row">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
        Créer une table pour connaitre les rôles et acteur en fonction du film la table "jouer":	
<a type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#Modal2"><img src="images/icon/h.png" width="20px"> </a>		
      </button>
	  </form>
    </h2>
<?php if($_GET['mp']=="a"){?>	
    <div id="flush-collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample" >
      <div class="accordion-body">
	  <pre class="pre_sql">
		CREATE TABLE jouer
	(
    id_jouer int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    role varchar(60) NOT NULL,
    id_act int(11) NOT NULL ,
    id_film int(11) NOT NULL,
    FOREIGN KEY (id_act) REFERENCES acteur(id_acteur),
    FOREIGN KEY (id_film) REFERENCES film(id_film)
	)
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
	
				<button type="submit" class="btn btn-success"name="execute_req1" value="execute_req1">Exécuter la requête de création de table</button>
					
		
				<button type="submit" class="btn btn-warning"name="execute_req2" value="execute_req2">Créer la table</button>
		
				<button type="submit" class="btn btn-danger"name="execute_req3" value="execute_req3">Supprimer la table</button>
				
			</form>
			<?php if (isset($_GET['er'])){  $message = $films->message($_GET['er']); ?>
				<button  type="button"class="btn btn-outline-danger " disabled> <?php echo $message;?></button>
			<?php } ?>	
			<?php 
					if(isset($_POST['execute_req1'])){
									$exec = $films-> create_table3($_POST['req_sql1'],'jouer(',$_SESSION["id"]);
					}
					elseif (isset($_POST['execute_req3'])){
						
						$exec = $films-> sup_table2('jouer');
					}
					?>
		
			</div>
	
		</div>

</div>
</div>

<div class="card-body">
	<div class="mb-3 " >
			<span class='d-inline-block bg-info-sql-l text-white px-2 py-1'>b</span>Tables et schéma de notre base de données
	</div>
	<div class="col">
		<?php $tables = $films->liste_tables();	
		$valid =0;		
		?>
		<?php foreach ($tables as $table ) {
			$a = explode("_",$table['TABLE_NAME']);
			if ( $a[0]==$_SESSION["id"]){
			
				echo 'TABLE : ',$a[1]; 
				$_tables = $films-> schema($table['TABLE_NAME']);
				$refaire= FALSE;
				?>
				
				<table class="table table-bordered">
			  <thead>
				<tr>
				  <td></td>	
				  <th scope="col">Nom</th>
				  <th></th>
				  <th scope="col">Type</th>
				  <th></th>
				  <th scope="col">Null</th>
				  <th></th>
				   <th scope="col">Valeur par défaut</th>
				   <th></th>
				  <th scope="col">Extra</th>
				  <th></th>
				  <th scope="col">Key</th>
				  
				</tr>
				
			  </thead>
			  <tbody>
			  
			  <?php 
			  
			  foreach ($_tables as $_table){?>
					<tr>	
						<td><?php 
						$val = $films -> verif_schema($a[1],$_table['COLUMN_NAME']);
						 if ($val) {?><img src="images/icon/v.JPG" width="20px"> <?php $valid++;} else {?>
                                                              <img src="images/icon/f.JPG" width="20px"><?php $refaire= TRUE; }?></td>
						<th><?php echo $_table['COLUMN_NAME'];?></th>
						<td><?php 
						$val = $films -> verif_schema2($a[1],$_table['COLUMN_NAME'],'COLUMN_TYPE',$_table['COLUMN_TYPE']);
                                                if ($val) {?><img src="images/icon/v.JPG" width="20px"> <?php $valid++; } else {?>
                 
							<img  src="images/icon/f.JPG" width="20px"><?php $refaire= TRUE; }?>
					 	 </td>
						<td><?php echo $_table['COLUMN_TYPE'];?></td>
						<td><?php 
						$val = $films -> verif_schema2($a[1],$_table['COLUMN_NAME'],'IS_NULLABLE',$_table['IS_NULLABLE']);
                                                if ($val) {?><img src="images/icon/v.JPG" width="20px"> <?php $valid++;} else {?>
                                                              <img src="images/icon/f.JPG" width="20px"><?php $refaire= TRUE;}?></td>
						<td><?php echo $_table['IS_NULLABLE'];?></td>
						<td><?php 
						$val = $films -> verif_schema2($a[1],$_table['COLUMN_NAME'],'COLUMN_DEFAULT',$_table['COLUMN_DEFAULT']);
                                                if ($val) {?><img src="images/icon/v.JPG" width="20px"> <?php $valid++; } else {?>
                                                              <img src="images/icon/f.JPG" width="20px"><?php $refaire= TRUE;}?></td>
						<td><?php echo $_table['COLUMN_DEFAULT'];?></td>
						<td><?php 
						$val = $films -> verif_schema2($a[1],$_table['COLUMN_NAME'],'EXTRA',$_table['EXTRA']);
                                                if ($val) {?><img src="images/icon/v.JPG" width="20px"> <?php $valid++;} else {?>
                                                              <img src="images/icon/f.JPG" width="20px"><?php $refaire= TRUE; }?></td>
						<td><?php echo $_table['EXTRA'];?></td>
						<td><?php 
						$val = $films -> verif_schema2($a[1],$_table['COLUMN_NAME'],'COLUMN_KEY',$_table['COLUMN_KEY']);
                                                if ($val) {?><img src="images/icon/v.JPG" width="20px"> <?php $valid++;} else {?>
                                                              <img src="images/icon/f.JPG" width="20px"><?php $refaire= TRUE;}?></td>
						<td><?php echo $_table['COLUMN_KEY'];?></td>
					</tr>	
				<?php }
					if ($refaire) {	?>
					<tr>
						<td colspan="12"><button type="submit" class="btn btn-danger"name="execute_req3" value="execute_req3">La table ne correspond pas à l'exercice supprimer la table et recommencer</button></td>
					</tr>
					<?php }?>

			  </tbody>
			</table>
			
			
		<?php } }
		if ( $valid >= 36 ){
		?>
	<a class="btn btn-primary" href="data1.php" role="button">Activité suivante : insérer des données --> </a>
		<?php }?>
	</div>
</div>



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
		  $pass = $films ->pass($_POST["mp"],'creer_table3','flush-collapse2');
	  }
	  
	  ?>
    </div>
  </div>
</div>







</body>
<!-------pour l'utilisation de l'editeur--------------------->
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