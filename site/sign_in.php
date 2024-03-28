<?php
session_start();
 
include_once 'include/config.php';


$host='mysql:host='.HOST.';port=3306;dbname='.DATABASE.'';
$bdd = new PDO($host,USER,PASSWORD);

 
 
if(isset($_POST['formconnexion'])) {
   $login = strtolower(htmlspecialchars($_POST['login']));
   $mdpconnect = strtolower($_POST['mdpconnect']);// sha1($_POST['mdpconnect']);
   if(!empty($login) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM user
	  WHERE login = ? AND password = ?");
      $requser->execute(array($login, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id_user'];
		 $_SESSION['login']=$userinfo['login'];
         $_SESSION['nom'] = $userinfo['non'];
         $_SESSION['mail'] = $userinfo['mail'];
		 $_SESSION['profile']=$userinfo['statut'];
		 if ($_SESSION['profile']=='P' ){
			 header("Location: index.php?id=".$_SESSION['id']);
		 }
		if ($_SESSION['profile']=='E'){
			 header("Location: index.php?id=".$_SESSION['id']);
		 }
         
      } else {
         $erreur = "Login ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Martial Ouvrard">
    <meta name="generator" content="Hugo 0.80.0">
    <title>FilmSql · V1.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<form class="form-signin"  method="POST" action="">
  <img class="mb-4" src="images/logo/avatar_essb.jpg" alt="" width="150" >
  <h1 class="h3 mb-3 font-weight-normal">FilmSQL</h1>

  <input type="text" id="inputEmail" name="login" class="form-control" placeholder="Login" required autofocus>

  <input type="password" id="inputPassword" name="mdpconnect" class="form-control" placeholder="Mot de passe" required>
  <div class="checkbox mb-3">
    
      <input type="checkbox" value="remember-me"> se souvenir
    
  </div>
  <input class="btn btn-lg btn-primary btn-block" name="formconnexion" type="submit" value="Valider" />
  <p class="mt-5 mb-3 text-muted">&copy; 2023-202<a href="https://phpmyadmin.cluster024.hosting.ovh.net/">4</a></p>
</form>
 <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>

    
  </body>
</html>
