<?php
   session_start();
   @$login=$_POST["login"];
   @$pass=md5($_POST["pass"]);
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      include("connexion.php");
      $sel=$pdo->prepare("select * from enseignant where login=? and pass=? limit 1");
      $sel->execute(array($login,$pass));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
         " ".strtoupper($tab[0]["nom"]);
         $_SESSION["autoriser"]="oui";
         header("location:index.php");
      }
      else
         $erreur="Mauvais login ou mot de passe!";
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Se Connecter</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   </head>
   <body onLoad="document.fo.login.focus()">
   <section class="header">
   <div class="login-box">
   <h2>Veuillez vous connecter</h2>
   <div class="erreur"><?php echo $erreur ?></div> 
   <form name="fo" method="post" action="">
         <div class="user-box">
                <input type="text" name="login" placeholder="Login" required="">
                <label >Login</label>
         </div>
         <div class="user-box">
                <input type="password" name="pass"  placeholder="Mot de passe"  required="">
                <label>Mot de passe</label>
         </div>
         <input class="test" type="submit" name="valider" value="S'authentifier" />
         <br><a href="inscription.php"> Créer un Compte</a>
         <p class="mt-5 mb-3 text-muted">&copy; SCO-Enicar 2021-2022</p>
</form>
</div>
</section>
   </body>
</html>