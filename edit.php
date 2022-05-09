<?php session_start();

require_once("connexion.php");
@$cin=$_POST['cin'];
@$nom=$_POST['nom'];
@$prenom=$_POST['prenom'];
@$classe=$_POST['classe'];
@$email=$_POST['email'];
@$adresse=$_POST['adresse'];
@$pwd=$_POST['pwd'];
@$cpwd=$_POST['cpwd'];
@$valider=$_POST['valider'];
$erreur="";
$con=mysqli_connect("localhost","root","","gestion_etudiant");
$req="select * from etudiant where cin='$cin'";
$rs=mysqli_query($con,$req) or die(mysqli_error($con));
$et=mysqli_fetch_assoc($rs);
if(date("H")<18){
$bienvenue="Bonjour et bienvenue ".
$_SESSION["prenomNom"].
" dans votre espace personnel, veuillez modifer l'etudiant que vous voulez a partir de son cin";}
else{
$bienvenue="Bonsoir et bienvenue ".
$_SESSION["prenomNom"].
" dans votre espace personnel, veuillez modifer l'etudiant que vous voulez a partir de son cin";}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Modifier Etudiant</title>
    <link rel="stylesheet" href="styleindex.css">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/jumbotron.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<div class="header">
<nav class="navbar navbar-default navbar-fixed-top" >
          <a href="index.php"><img src="logo.png"></a>
          <a class="navbar-brand" id="logo" href="index.php">SCO-Enicar</a>
          <div class="nav-links" id="Navlinks">
            <i class="fa fa-times" onclick="hideMenu()" ></i>
              <ul  >
                <li><a href="index.php">HOME</a></li>
                <li class="nav-item dropdown">
                   
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>       
                  <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="AfficherEtudiants.php">Lister tous les étudiants</a>
                    <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                    <a class="dropdown-item" href="supprimergroupe.php">Supprimer Groupe</a>
                    <!--<a class="dropdown-item" href="#">Ajouter Groupe</a>
                    <a class="dropdown-item" href="#">Modifier Groupe</a>-->
                    
                  </div>
                    
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="AjouterEtudiant.php">Ajouter Etudiant</a>
                    <a class="dropdown-item" href="chercherEtudiant.php">Chercher Etudiant</a>
                    <a class="dropdown-item" href="modifierEtudiant.php">Modifier Etudiant</a>
                    <a class="dropdown-item" href="supprimerEtudiant.php">Supprimer Etudiant</a>
                </li>
               
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
                    <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
                  </div>
                </li>
          
                <li class="nav-item active">
                  <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
                </li> 
          
              </ul>
              

          </div>
          <i class="fa fa-bars" onclick="showMenu()" ></i>
        </nav>
 
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        
  <div class="text-box">
        <h2><?php echo $bienvenue?></h2>
        </div>
</div>
<div class="header">
<main role="main">
<div class="text-box">
           

    <div class="erreur"><?php echo $erreur ?></div>
   <form name="fo" method="post" action="modifierEtudiant.php">

      <div >
   
          <div class="login-box">
              
            <h2>Modifier Etudiant</h2>
            <form action="index.php" method="post" action="modifierEtudiant.php">
            <div class="user-box">
                <input type="number" id="cin" name="cin" value="<?php echo($et["cin"])?>" />
                <label>CIN</label>
              </div>
            <div class="user-box">
                <input type="text" id="nom" name="nom" value="<?php echo( $et["nom"] )?>" />
                <label >nom</label>
              </div>
              <div class="user-box">
                <input type="text" id="prenom" name="prenom" value="<?php echo( $et["prenom"] )?>" />
                <label >prenom</label>
                
              </div>
              
              <div class="user-box">
                <input type="password" id="pwd" name="pwd" value="<?php echo($et['pwd'])?>"/>
                <label>Mot de passe</label>
              </div>
              
              <div class="user-box">
                <input type="email" id="email" name="email" value="<?php echo( $et["email"] )?>"/>
                <label>Email</label>
              </div>
             
             
              <div class="user-box">
         
                <label style="  top: -20px;
    left: 0;
    color: #03e9f4;
    font-size: 12px;" >Classe</label>
                <select id="classe" name="classe" value="<?php echo($et['classe'])?>"  class="custom-select custom-select-sm custom-select-lg">
    <option value="1-INFOA">1-INFOA</option>
    <option value="1-INFOB">1-INFOB</option>
    <option value="1-INFOC">1-INFOC</option>
    <option value="1-INFOD">1-INFOD</option>
    <option value="1-INFOE">1-INFOE</option>
 </select>
              </div>

              

<br>
<br>

<div class="user-box">
                <input  type="text" id="adresse" value="<?php echo($et['adresse'])?>" name="adresse"/>
                <label> Adresse </label>
 </div>

            
           
              <input  class="test"  type="submit"  name="valider" value="valider" />
             
              <p class="mt-5 mb-3 text-muted">&copy; SCO-Enicar 2021-2022</p>
            </form>
          </div>




</div>
</main>
</div>
<div id="demo"></div>

</body>
</html>