<?php
include("connexion.php");
session_start();
if ($_SESSION["autoriser"] != "oui") {
    header("location:login.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>INFO1-E</title> <!--******************-->
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

<body onload="refresh()">
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

<?php
            
            @$valide = $_POST["valider"];
            @$cin = $_POST["classe"];
            if (isset($valide)) {

                $sel = $pdo->prepare("select * from etudiant where Classe=? ");
                $sel->execute(array($cin));
                $results = $sel->fetchAll();
                if(count($results)>0){
                    echo '<div class="table-responsive"> 
                    <table class="table table-striped table-hover" style="align:center;">
                    <tr>
    <th>
        CIN
    </th>
    <th>
        Nom
    </th>
    <th>
        Prénom
    </th>
    <th>
        Email
    </th>
    <th>
        Adresse
    </th>
    <th>
        Classe
    </th>
    </tr>';
                        foreach ($results as $row) {
                            $cin = htmlentities($row['cin']);
                            $nom = htmlentities($row['nom']);
                            $prenom = htmlentities($row['prenom']);
                            $email = htmlentities($row['email']);
                            $adresse = htmlentities($row['adresse']);
                            $classe = htmlentities($row['Classe']);
        
                            echo "<tr><td>$cin</td><td>$nom</td><td>$prenom</td><td>$email</td><td>$adresse</td><td>$classe</td></tr>";
                        }
                        echo '</table>
                        </div>';
                }else{
                    echo " Groupe non disponible ou Le nom de Groupe non correcte";
                }
            }
            ?>
            </div>
            <script>
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
    </body>
    </html>