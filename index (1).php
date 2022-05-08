<?php

include("connexion.php");
   session_start();
   @$classe=$_POST["classe"];
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
         include("connexion.php");
         $sel=$pdo->prepare("SELECT * FROM etudiant WHERE classe = :classe");
         $name = '111';
         $sel->bindValue(':classe', $classe);
         $sel->execute(); 
      }
   
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et Bienvenue ".
      $_SESSION["prenomNom"].
     
      "  dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR</title>
    <link rel="stylesheet" href="styleindex.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/jumbotron.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

</head>

<body>
    <section class="header">
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
        <p> veuillez cliquer sur "mes groupes" pour afficher les groupes</p> 
            <a href="AfficherEtudiantsParClasse.php" class="hero-btn" role="button">Mes Groupes &raquo;</a>
        </div>

      </section> 


      
       <!-------------- js for toggle menu ------------ -->
<script> 
    var Navlinks= document.getElementById("navlinks");
    function showMenu(){ Navlinks.style.right="0";}
    function hideMenu(){ Navlinks.style.right="-200px";}

        $('.btn').click(function() {
            $(this).toggleClass("click");
            $('.sidebar').toggleClass("show");
        });
        $('.feat-btn').click(function() {
            $('nav ul .feat-show').toggleClass("show");
            $('nav ul .first').toggleClass("rotate");
        });
        $('.serv-btn').click(function() {
            $('nav ul .serv-show').toggleClass("show1");
            $('nav ul .second').toggleClass("rotate");
        });
        $('nav ul li').click(function() {
            $(this).addClass("active").siblings().removeClass("active");
        });
    </script>



<
      <section style="width:80%; margin:auto; text-align: center; padding-top: 50px; ">
      <h1 style="font-size: 36px;
  font-weight: 600;"> Our Facilities</h1>
<p style="
  color: #777;
  font-size: 14px;
  font-weight: 300;
  line-height: 22px;
  padding: 10px;">********</p>
  <div class="row">
    <div class="campus-col" style="
  
  flex-basis: 31%;
  border-radius: 10px;
  margin-bottom:5%;
  text-align:left;">
       <img src="library.png" style="width: 100%; border-radius:10px;">
    <div class="layer " style=" background: rgba(226,0,0,0.7); height:100% ; position: absolute; top=0 ; left=0;"></div>
      <h3 style=" margin-top: 16px;
  margin-bottom: 15px;
  text-align: left;">Library</h3>
  </div>
  <div class="campus-col" style="
  flex-basis: 31%;
  border-radius: 10px;
  margin-bottom:5%;
  text-align:left;
">
       <img src="basketball.png" style="width: 100%; border-radius:10px;">
    <div class="layer " style=" background: rgba(226,0,0,0.7); height:100% ; position: absolute; top=0 ; left=0;"></div>
      <h3 style=" margin-top: 16px;
  margin-bottom: 15px;
  text-align: left;">Largest Play Ground</h3>
  </div>
  <div class="campus-col" style="

flex-basis: 31%;
  border-radius: 10px;
  margin-bottom:5%;
  text-align:left;">
       <img src="cafeteria.png" style="width: 100%; border-radius:10px;">
    <div class="layer " style=" background: rgba(226,0,0,0.7); height:100% ; position: absolute; top=0 ; left=0;"></div>
      <h3 style=" margin-top: 16px;
  margin-bottom: 15px;
  text-align: left;">Tasty and Healthy Food</h3>
  </div>
  </div>
      </section>
<footer class="container">
  <p>&copy; ENICAR 2021-2022</p>
</footer>


   
      
 

</body>
</html>


























