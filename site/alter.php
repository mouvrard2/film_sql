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
	<title> Etape 11- Modifier Table</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	
	<link href="css/style.css" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
<div class="container">
<?php include "menu.php";?>
<div class="card">
	<div class="card-header">
		<h4><span class='d-inline-block bg-info-sql text-white px-2 py-1'> 11 </span> ALTER (modifier une table)</h4>
	</div>

<div class="card-body">
	<p>Avant de procéder à une mise à jour, il est important de comprendre la structure de la table concernée. Vous devez connaître 
	<button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#myModal"> le nom de la table, les noms des colonnes et les types de données associés.</button></p>

<div class="mb-3">
		<span class='d-inline-block bg-info-sql-l text-white px-2 py-1'>A</span> <strong>Comment faire ?</strong> </br>
	


</div>
<div class="mb-3">
		<span class='d-inline-block bg-info-sql-2 text-white px-2 py-1'>a-1</span> <strong>Syntaxe de base pour l'altération</strong> </br>
	
<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        La syntaxe de base pour effectuer des modifications sur une table existante est la suivante :
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
			<pre class="pre_sql">
			ALTER TABLE nom_de_la_table action;
			</pre>
	  </div>
    </div>
  </div>
</div>
</div>
<ul>
<li>"nom_de_la_table" est le nom de la table que vous souhaitez modifier.</li>
<li>"action" est la commande spécifique que vous souhaitez exécuter, par exemple, ADD (ajouter une colonne), MODIFY (modifier une colonne existante) ou DROP (supprimer une colonne).</li>
</ul>


<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
        La syntaxe pour ajouter une nouvelle colonne à la table film, une colonne "duree" qui representera la durée du film de type TIME :
      </button>
    </h2>
    <div id="flush-collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
			<pre class="pre_sql">
			ALTER TABLE film 
			ADD duree TIME NOT NULL 
			</pre>
	  </div>
    </div>
  </div>
</div>
	<div class="row">
		  <p id="data1" >
         Analyser et mettre à jour la table
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
									$resus = $films-> ajout_col_table($_POST['req_sql1'],'alter','data1',$_SESSION['id']);
					}
					?>			
			</div>
		</div>
</div>



<div class="card-body">
	<div class="mb-3 " >
			<span class='d-inline-block bg-info-sql-l text-white px-2 py-1'>b</span>Tables et schéma de notre base de données
	</div>
	<form method="post" action="" id="myForm2">
	<div class="col">
		<?php $tables = $films->liste_tables();			
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
			  $valid =0;
			  foreach ($_tables as $_table){?>
					<tr id="<?php echo $_table['COLUMN_NAME'];?>" >	
						<td ><?php 
						$val = $films -> verif_schema($a[1],$_table['COLUMN_NAME']);
						 if ($val) {?><img src="images/icon/v.JPG" width="20px"> <?php $valid++;} else {?>
                                                              <button type="button" class="btn btn-danger remove" ><?php  ico('ben');?></button><?php $refaire= TRUE; }?></td>
						<th ><?php echo $_table['COLUMN_NAME'];?></th>
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
		if ( $valid >=18 ){
		?>
	<a class="btn btn-primary" href="creer_table2.php" role="button">Activité suivante : recommencer avec la table acteur --> </a>
		<?php } ?>
	</div>
	</form>
</div>







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

	
	document.getElementById("myForm1").onsubmit = function() {
		document.getElementById("text_create").value = editor.getValue();
    }
	
	
	const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
  myInput.focus()
})



$(".remove").click(function(){
		var id_session = <?php echo json_encode($_SESSION['id']); ?>;
		var id = $(this).parents("tr").attr("id");
		var colonne =document.getElementById(id).getElementsByTagName('th')[0].innerHTML;

        if(confirm("Voulez vous supprimer la colonne ? \n "+colonne))
        {
			document.location='execute.php?col='+colonne+'&table='+id_session+'_film'+'&p=alter';
        }

    });
	


	</script>
<!----------------------------------->
</html>		
<?php 
} 
else {
	header("Location: sign_in.php");
}
?>