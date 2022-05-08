<?php
   session_start();
   @$nom=$_POST["nom"];
   @$prenom=$_POST["prenom"];
   @$login=$_POST["login"];
   @$pass=$_POST["pass"];
   @$repass=$_POST["repass"];
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      if(empty($nom)) $erreur="Nom laissé vide!";
      elseif(empty($prenom)) $erreur="Prénom laissé vide!";
      elseif(empty($prenom)) $erreur="Prénom laissé vide!";
      elseif(empty($login)) $erreur="Login laissé vide!";
      elseif(empty($pass)) $erreur="Mot de passe laissé vide!";
      elseif($pass!=$repass) $erreur="Mots de passe non identiques!";
      else{
         include("connexion.php");
         $sel=$pdo->prepare("select id from enseignant where login=? limit 1");
         $sel->execute(array($login));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="Login existe déjà!";
         else{
            $ins=$pdo->prepare("insert into enseignant(nom,prenom,login,pass) values(?,?,?,?)");
            if($ins->execute(array($nom,$prenom,$login,md5($pass))))
               header("location:login.php");
         }   
      }
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
   <body>
      
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="">

      <div class="header">
       
          <div class="login-box">
            <h2>Inscription</h2>
            <div class="erreur"><?php  echo $erreur ?></div>
            <form action="index.php" method="post" action="index.php">
              <div class="user-box">
                <input type="text" name="nom"   value="<?php echo $nom?>" required="">
                <label >nom</label>
              </div>
              <div class="user-box">
                <input type="text" name="prenom"  value="<?php echo $prenom?>" required="">
                <label >prenom</label>
              </div>
              <div class="user-box">
                <input type="text" name="login" value="<?php echo $login?>" required="">
                <label >login</label>
              </div>
              <div class="user-box">
                <input type="password" name="pass" required="">
                <label>Mot de passe</label>
              </div>
              <div class="user-box">
                <input type="password" name="repass" required="">
                <label>Confirmer Mot de passe</label>
              </div>
             <!-- <a  href="#">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Se Connecter
              </a> -->
              <input class="test" type="submit" name="valider" value="S'inscrire" />
              <br><a href="login.php"> t'as deja un Compte?</a>
              <p class="mt-5 mb-3 text-muted">&copy; SCO-Enicar 2021-2022</p>
            </form>
          </div>


</div>
   </body>
</html>