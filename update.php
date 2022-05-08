<?php
include("connexion.php");
session_start();
if($_SESSION["autoriser"]!="oui"){
   header("location:login.php");
   exit();
}
if(date("H")<18)
   $bienvenue="Bonjour et bienvenue ".
   $_SESSION["prenomNom"].
   " dans votre espace personnel";
else
   $bienvenue="Bonsoir et bienvenue ".
   $_SESSION["prenomNom"].
   " dans votre espace personnel";

 
/* verifier la valeur id dans le post pour la mise à jour */
if(isset($_POST["cin"]) && !empty($_POST["cin"])){
    /* recuperation du champ caché */
    $cin = $_POST["cin"];
    
    /* Validate name */
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "Veillez entrez un nom.";
    } elseif(!filter_var($input_nom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nom_err = "Veillez entrez a valid name.";
    } else{
        $nom = $input_nom;
    }
     /* Validate prenom */
     $input_prenom = trim($_POST["prenom"]);
     if(empty($input_prenom)){
         $prenom_err = "Veillez entrez un prenom.";
     } elseif(!filter_var($input_prenom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
         $prenom_err = "Veillez entrez a valid name.";
     } else{
         $prenom = $input_prenom;
     }
    
    /* Validate classe  */
    $input_classe = trim($_POST["classe"]);
    if(empty($input_classe)){
        $classe_err = "Veillez entrez une eclasse.";     
    } else{
        $classe = $input_classe;
    }
    
    
    
    /* verifier les erreurs avant modification */
    if(empty($nom_err) && empty($prenom_err) && empty($classe_err)){
        
        $sql = "UPDATE students SET  nom=?, prenom=?, classe=? WHERE cin=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssi", $param_nom, $param_prenom, $param_classe, $param_cin);
            
           
            $param_nom = $nom;
            $param_prenom = $prenom;
            $param_classe= $classe;
            $param_cin = $cin;
            
            
            if(mysqli_stmt_execute($stmt)){
                /* enregistremnt modifié, retourne */
                header("location: index.php");
                exit();
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    /* si il existe un paramettre id */
    if(isset($_GET["cin"]) && !empty(trim($_GET["cin"]))){
        
        $id =  trim($_GET["cin"]);
        
       
        $sql = "SELECT * FROM etudiant WHERE cin = ?";


        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_cin);
            
            
            $param_cin = $cin;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* recupere l'enregistremnt */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    /* recupere les champs */
                    $cin = $row["cin"];
                    $nom = $row["nom"];
                    $prenom= $row["prenom"];
                    $classe = $row["classe"];
                } else{
                    
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! une erreur est survenue.";
            }
        }
        
        /* Close statement */
        mysqli_stmt_close($stmt);
        
        /* Close connection */
        mysqli_close($link);
    }  else{
        /* pas de id parametter valid, retourne erreur */
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'enregistremnt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Mise à jour de l'enregistremnt</h2>
                    <p>Modifier les champs et enregistrer</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                   
                    
                    <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="nom" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nom; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>prenom</label>
                            <input type="text" name="prenom" class="form-control <?php echo (!empty($prenom_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
                            <span class="invalid-feedback"><?php echo $prenom_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>classe</label>
                            <textarea name="classe" class="form-control <?php echo (!empty($classe_err)) ? 'is-invalid' : ''; ?>"><?php echo $ecole; ?></textarea>
                            <span class="invalid-feedback"><?php echo $classe_err;?></span>
                        </div>
                        
                        <input type="hidden" name="cin" value="<?php echo $cin; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
 