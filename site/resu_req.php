<!-- Resultat des requêtes en tableau-->
 
 <?php 
echo " <div class='table-responsive'>";
echo "<table class='table table-striped table-sm'>";
$r =TRUE;
 foreach($results as $column => $value) {
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
?>
<!-- -->

