<?php
include_once 'config.php';

class films{
	
	function __construct(){
		try{
			$host='mysql:host='.HOST.';port='.PORT.';dbname='.DATABASE.'';
			$this-> pdo = new PDO($host,USER,PASSWORD);
		} 
		catch (PDOexception $e){
			print "Erreur !:".$e->getMessage()."<br/>";
			die();	
		}	
	}
	
	function affich_resu($reponse) {
		echo " <div class='table-responsive'>";
		echo "<table class='table table-striped table-sm'>";
		$r =TRUE;
		 foreach($reponse as $column => $value) {
			$col = array_keys($value);
			$i=0; 
			if ($r) { 
			echo "	<thead>";
				 for($t=0; $t<count($col);$t++) { 
					echo "<th>  $col[$t]  </th>";
				 }
				echo "<thead>";
				echo "<tbody>";
			$tb=TRUE;
			$r = FALSE;}
			 echo "<tr>";
				foreach($value as $val){
					echo "<td> " . $val . "  </td>";
					$i++;} 
			echo "</tr>";
		 }
		if($tb){echo "</tbody>";}
		echo "</table>";
		echo "</div>";
		}
		
		
	function ajout_col_table($req,$page,$loc,$id){
		$resu =  preg_split("/[(\s,)]+/", $req);
		
		if($resu[0]=="ALTER" and $resu[1]== "TABLE" and $resu[3]=='ADD' ) {

			if ($resu[2]=='acteur' || $resu[2]=='jouer' || $resu[2]=='film' ){
				$resu[2]= $id ."_".$resu[2];
				$new_test = implode(" ",$resu);
				echo $new_test;
				$requete =$this -> pdo -> prepare($new_test);
				$requete -> execute();
				$erreur = $requete->errorInfo();
				
				if($erreur[0]=='00000' || $erreur[0]=='42000'){
								echo $erreur[0].'????';
					echo "<script language='Javascript'>document.location='$page.php?er=$erreur[0]&#$loc'</script>";
					return($resu[2]);}
				else {
					echo $erreur[2];
					echo "<script language='Javascript'>document.location='$page.php?er=$erreur[1]&#$loc'</script>";
				}
			}else {
				echo "<script language='Javascript'>document.location='$page.php?er=colf&#$loc'</script>";
			}
		}
		else {
			echo "<script language='Javascript'>document.location='$page.php?er=col&#$loc'</script>";
		}
	}	
	
	
	function clef($table){
        $base=DATABASE;
		$f_k =$this -> pdo -> prepare("SELECT CONSTRAINT_NAME,TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
			FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE  WHERE TABLE_NAME='$table' AND table_schema='$base'
			ORDER BY `KEY_COLUMN_USAGE`.`TABLE_NAME` ASC;");
		$f_k-> execute();	
		$rep = $f_k -> fetchAll(PDO::FETCH_ASSOC);
		return($rep);
         }
		 
	function create_table($test,$id){
		$resu =  preg_split("/[\s]+/", $test);//preg_split("/[(\s,)]+/", $test);
		if($resu[0]=="CREATE" and $resu[1]== "TABLE") {
			if ($resu[2]=="film("){
				$resu[2]= $id ."_".$resu[2];
				$new_test = implode(" ",$resu);
				$requete =$this -> pdo -> prepare($new_test);
				$requete ->execute();
				//$requete2 = $this -> pdo ->
				$existe =$this-> erreur($requete,"table1","index");
			}else {
				echo "<script language='Javascript'>document.location='index.php?er=film&#table1'</script>";
			}
		}
		else {
			echo "<script language='Javascript'>document.location='index.php?er=table&#table1'</script>";
		}
	}
	
	
	function complet_acteur($table){
		$requete = $this ->pdo->prepare("TRUNCATE TABLE $table");
		$requete-> execute();
		$liste = $this->select_all("acteur");
		foreach($liste as $act){
			$val_1 = $act['id_acteur'];
			$val_2 = $act['nom'];
			$val_3 = $act['prenom'];
			$requete2 = $this -> pdo-> prepare("INSERT INTO $table VALUES ('$val_1','$val_2','$val_3')");
			$requete2 -> execute();
		}
	}
	
	
	function complet_film($table){
		$requete = $this ->pdo->prepare("TRUNCATE TABLE $table");
		$requete-> execute();
		$liste = $this->select_all("film");
		foreach($liste as $act){
			$val_1 = $act['id_film'];
			$val_2 = $act['titre'];
			$val_3 = $act['annee'];
			$requete2 = $this -> pdo-> prepare("INSERT INTO $table VALUES ('$val_1','$val_2','$val_3')");
			$requete2 -> execute();
		}
	}
	
	function create_table2($test,$table,$id){
		$resu =  preg_split("/[\s]+/", $test);
		if($resu[0]=="CREATE" and $resu[1]== "TABLE") {
			if ($resu[2]==$table."("){
				$resu[2]= $id ."_".$resu[2];
				$new_test = implode(" ",$resu);
				$requete =$this -> pdo -> prepare($new_test);
				$requete ->execute();
				$existe =$this-> erreur($requete,$table,"creer_table2");
			}else {
				echo "<script language='Javascript'>document.location='creer_table2.php?er=film&#$table'</script>";
			}
		}
		else {
			echo "<script language='Javascript'>document.location='creer_table2.php?er=table&#$table'</script>";
		}
	}

	function create_table3($test,$table,$id){
		$resu =  preg_split("/[\s]+/", $test);
		$j= $resu[2];
        $i=0;
		$ref = 0;
		foreach ($resu as $res){
			if ($res == "REFERENCES") {
				if ($ref == 0){
					$c1=$resu[$i+1];
					$ind1= $i+1;
					$ref=1;
				}
				else {
					$c2= $resu[$i+1];	
					$ind2= $i+1;
				}
			}
			$i++;
		}
		$resu[$ind1]=$id ."_".$resu[$ind1];
		$resu[$ind2]=$id ."_".$resu[$ind2];
		$resu[2]= $id ."_".$resu[2];
		
		if($resu[0]=="CREATE" and $resu[1]== "TABLE") {
			if ($j==$table){
				
				$new_test = implode(" ",$resu);
				echo $new_test;
				$requete =$this -> pdo -> prepare($new_test);
				$requete ->execute();
				$existe =$this-> erreur($requete,$table,"creer_table3");
			}else {
				echo "<script language='Javascript'>document.location='creer_table3.php?er=acteur&#$table'</script>";
			}
		}
		else {
			echo "yoooo";
			echo "<script language='Javascript'>document.location='creer_table3.php?er=table&#$table'</script>";
		}
	}
	
	function delete_d($req,$page,$loc){
			$resu =  preg_split("/[(\s,)]+/", $req);
			$requete = $this ->pdo -> prepare($req);
			$requete -> execute();
			$erreur = $requete->errorInfo();
			if($erreur[0]=='00000'){
				$resultat = $this->select_all($resu[2]);
				return($resultat);}
			else {
				echo $erreur[2];
				echo "<script language='Javascript'>document.location='$page.php?er=$erreur[1]&#$loc'</script>";
			}
	
	 }
	
	function erreur($toto,$loc,$page){
		$erreur =$toto->errorInfo();
		if ($erreur[0]=='00000'){//enregistrement ok
			echo "<script language='Javascript'>document.location='$page.php#$loc'</script>";
		}
		else {
			echo "<script language='Javascript'>document.location='$page.php?er=$erreur[1]&#$loc'</script>";
		}	
	}
	
	function exo_table($table){
		$tables_exo =[
			'acteur'	=> ['n_c' => ['id_acteur','nom','prenom'],
							'id_acteur' => ['COLUMN_TYPE' => 'int(11)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => 'auto_increment',
											'COLUMN_KEY' =>'PRI'],
							'nom' 		=> ['COLUMN_TYPE' => 'varchar(60)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => '',
											'COLUMN_KEY' =>''],
							'prenom' 		=> ['COLUMN_TYPE' => 'varchar(60)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => '',
											'COLUMN_KEY' =>''],				
								],
			'film'	=> ['n_c' => ['id_film','titre','annee','duree'],
							'id_film' => ['COLUMN_TYPE' => 'int(11)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => 'auto_increment',
											'COLUMN_KEY' =>'PRI'],
							'titre' 		=> ['COLUMN_TYPE' => 'varchar(60)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => '',
											'COLUMN_KEY' =>''],
							'annee' 		=> ['COLUMN_TYPE' => 'int(11)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'0',
											'EXTRA' => '',
											'COLUMN_KEY' =>''],
							'duree' 		=> ['COLUMN_TYPE' => 'time',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => '',
											'COLUMN_KEY' =>''],				
                                                                ],
            'jouer' => ['n_c' => ['id_jouer','role','id_film','id_act'],
							'id_jouer' => ['COLUMN_TYPE' => 'int(11)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => 'auto_increment',
											'COLUMN_KEY' =>'PRI'],
							'role' 		=> ['COLUMN_TYPE' => 'varchar(60)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => '',
											'COLUMN_KEY' =>''],
							'id_act' 		=> ['COLUMN_TYPE' => 'int(11)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => '',
											'COLUMN_KEY' =>'MUL'],
							'id_film' 		=> ['COLUMN_TYPE' => 'int(11)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => '',
											'COLUMN_KEY' =>'MUL']					
								],
			'realisateur'	=> ['n_c' => ['id_rea','nom','prenom','age'],
							'id_rea' => ['COLUMN_TYPE' => 'int(11)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => 'auto_increment',
											'COLUMN_KEY' =>'PRI'],
							'nom' 		=> ['COLUMN_TYPE' => 'varchar(60)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => '',
											'COLUMN_KEY' =>''],
							'prenom' 		=> ['COLUMN_TYPE' => 'varchar(60)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'',
											'EXTRA' => '',
											'COLUMN_KEY' =>''],	
							'age' 		=> ['COLUMN_TYPE' => 'int(11)',
											'IS_NULLABLE' => 'NO',
											'COLUMN_DEFAULT'=>'0',
											'EXTRA' => '',
											'COLUMN_KEY' =>''],											
								],
 
			];
		return ($tables_exo[$table]);	
	}
	
	function join1($test,$loc,$page){
		$resu =  preg_split("/[(\s,)]+/", $test);
		if($resu[0]=="SELECT" and $resu[2]== "FROM" and $resu[4]=="JOIN") {
			$requete =$this -> pdo -> prepare($test);
			$requete ->execute();
			$erreur =$requete->errorInfo();
			if ($erreur[0]=='00000'){//enregistrement ok
				$resultat= $requete -> fetchAll(PDO::FETCH_ASSOC);
				return($resultat);
			}else {
				$existe =$this-> erreur($requete,$loc,$page);
			}
		}
		else {
			echo "<script language='Javascript'>document.location='$page.php?er=join&#$loc'</script>";
		}
	}
	
	function insert_table($test,$loc,$page,$id){
		$resu =  preg_split("/[\s]+/", $test);
		if($resu[0]=="INSERT" and $resu[1]== "INTO") {
			if ($resu[2]=='acteur' || $resu[2]=='film' || $resu[2]=='jouer' && ($resu[3]=='VALUES' ||$resu[3]=='VALUES(' )){
				$resu[2] = $id.'_'.$resu[2];
				$new_test = implode(" ", $resu);
				$requete =$this -> pdo -> prepare($new_test);
				$requete ->execute();
				$existe =$this-> erreur($requete,$loc,$page);
			}else {
				echo "<script language='Javascript'>document.location='$page.php?er=acteur&#$loc'</script>";
			}
		}
		else {
			echo "<script language='Javascript'>document.location='$page.php?er=insert&#$loc'</script>";
		}
	}
	
	function liste_tables(){
		$base=DATABASE;
		$requete=$this->pdo->prepare("SELECT TABLE_NAME
									FROM   INFORMATION_SCHEMA.TABLES
									WHERE Table_Type='BASE TABLE' AND table_schema='$base';");
		$requete-> execute();
		$resultats = $requete ->fetchAll(PDO::FETCH_ASSOC);
		return($resultats);
	}
		
	function message($num){
		$message =[
			'col'=> "Ce n'est pas un ajout de colonne",
			'insert'=> "Ce n'est pas une insertion de données",
			'join'  => "ce n'est pas un join",
			'table'	=> "Ce n'est pas une création de table",
			'film'	=> "Ce n'est pas le bon nom de table",
			'sup' 	=> 'La table est supprimée',
			'1050'  => "La table existe déja",
			'1051'  => "La table n'existe existe pas",
			'1054'	=> "Un des champs n'existe pas",
			'1060'	=> "Un champ existe déja",
			'1062'	=> "Clef primaire existante",
			'1064'  => "Erreur de syntaxe",
			'1136'  => "Un champ n'est pas renseigné",
			'1146'  => "La table n'existe pas",
			'1366'  => "Une valeur de champ est mal typée",
			'1451'	=> "il y a une clef étrangère dans une autre table",
			];
		return ($message[$num]);	
	}
	
	function pass($pass,$page,$loc){
		if ($pass =="a"){
			echo "<script language='Javascript'>document.location='$page.php?mp=$pass&#$loc'</script>";
		} else {
			echo "<script language='Javascript'>document.location='$page.php'</script>";
		}
	}
	function schema($table){
		$base=DATABASE;		
		$requete =$this->pdo->prepare("SELECT COLUMN_NAME,COLUMN_TYPE, IS_NULLABLE, COLUMN_DEFAULT, COLUMN_KEY, EXTRA 
										FROM INFORMATION_SCHEMA.COLUMNS
										WHERE TABLE_NAME='$table' AND table_schema ='$base';");
		$requete -> execute();
		$resultats = $requete ->fetchAll(PDO::FETCH_ASSOC);
		return($resultats);		
	}
	
	function select_all($table){		
		$requete = $this ->pdo -> prepare("SELECT * FROM $table ");
		$requete -> execute();
		$resultat= $requete -> fetchAll(PDO::FETCH_ASSOC);
		return($resultat);
	}
	
	function select_lim($table,$id,$min,$max){		
		$requete = $this ->pdo -> prepare("SELECT * FROM $table WHERE $id >= $min AND $id <=$max");
		$requete -> execute();
		$resultat= $requete -> fetchAll(PDO::FETCH_ASSOC);
		return($resultat);
	}
	
	function select($req){
		$resu =  preg_split("/[(\s,)]+/", $req);
		if($resu[0]=="SELECT") {
			$val_1 = $resu[1];
			$val_2 = $resu[2];
			$val_3 = $resu[3];
			$val_4 = $resu[4];
			$requete = $this ->pdo -> prepare($req);
			$requete -> execute();
			$erreur = $requete->errorInfo();
			if($erreur[0]='0000'){
				$resultat= $requete -> fetchAll(PDO::FETCH_ASSOC);
                echo $resultat;
				return($resultat);}
			else {
				echo $erreur[1];
			}
		}
		
	}

	function sup_col($table,$col, $page){
		$requete = $this -> pdo ->prepare("ALTER TABLE $table DROP $col");
		$requete -> execute();
		$erreur = $requete->errorInfo();
		echo "<script language='Javascript'>document.location='$page.php'</script>";	
	}

	function sup_corbeille($table,$id,$page){
		$requete = $this->pdo->prepare("DELETE FROM $table WHERE $table.id_acteur = $id");
		$requete ->execute();
		$erreur = $requete->errorInfo();
		echo "<script language='Javascript'>document.location='$page.php'</script>";
	}
	
	function sup_table($table,$id,$page){
		$sup = $id."_".$table;
		$requete = $this->pdo->prepare("DROP TABLE $sup");
		if ($requete ->execute()){
			echo "<script language='Javascript'>document.location='$page.php?er=sup&#table1'</script>";
		}else{
			$existe =$this-> erreur($requete,"table1","index");
		}
	}
	
	function sup_table2($table){
		$requete = $this->pdo->prepare("DROP TABLE $table");
		if ($requete ->execute()){
			echo "<script language='Javascript'>document.location='creer_table2.php?er=sup&#$table'</script>";
		}else{
			$existe =$this-> erreur($requete,$table,'creer_table2');
		}
	}
	 function update($req,$page,$loc){
		 $resu =  preg_split("/[(\s,)]+/", $req);
		if($resu[0]=="UPDATE") {
			$requete = $this ->pdo -> prepare($req);
			$requete -> execute();
			$erreur = $requete->errorInfo();
			if($erreur[0]='0000'){
				$resultat = $this->select_all($resu[1]);
				return($resultat);}// retourne le nom de la table
			else {
				echo $erreur[1];
			}
		} 
	 }
	 
	 
	function verif_schema($table,$a){
		$t =$this ->exo_table($table);
		if ($a == $t['n_c'][0] || $a == $t['n_c'][1]|| $a == $t['n_c'][2] || $a==$t['n_c'][3]) {
			return TRUE;
		}else {
			return FALSE;
		}
		
	}
        
    function verif_schema2($table,$colname,$type,$data){
		$vf = $this -> exo_table($table);
		if ($data == $vf[$colname][$type]) {
			return TRUE;
		}else {
			return FALSE;
		}
	}
	

}
?>		