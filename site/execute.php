<?php 
session_start();


include_once 'include/fonctions.php';

$films = new films();

if(isset($_GET['id_act'])){
     $sup = $films->sup_corbeille($_GET['table'],$_GET['id_act'],$_GET['p']);
}
if(isset($_GET['col'])){
     $sup = $films->sup_col($_GET['table'],$_GET['col'],$_GET['p']);
}

?>