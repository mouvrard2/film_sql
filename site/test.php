<?php 
$id=3;
$test ="CREATE TABLE 3_film( id_film int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT, titre varchar(60) NOT NULL, annee int NOT NULL DEFAULT 0)";
$test ="SELECT nom, prenom FROM acteur WHere toto";
$resu= preg_split("/[(\,s)]+/", $test);
$i=1;
$t ="FROM";
while( $mot != "FROM"){
	$mot = $resu[$i];
	echo $mot;
	$i++;
	
}
echo $resu;
//$resu[2]= $id ."_".$resu[2];

//echo implode(' ',$resu);
?>

	<!--------  Boite modal pour validation        
	<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Supprimer la donnée</h5>
      </div>
      <div class="modal-body">
	  <?php ?>
       --------------------------------- </br>
	

      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-warning remove" name="sup_donnee">Valider la suppresion de la donnée</button>
      </div>
    </div>
  </div>
</div>  
	<!----------------------------------------------->