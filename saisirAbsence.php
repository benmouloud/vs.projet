<?php
include('connexion.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Saisir Absence</title>
  
    <div class="container">
      <?php
        if (isset($_POST['ajouter'])) {
          $dateAbs = trim($_POST['deb']);
          $classe = trim($_POST['classe']);
          $module = trim($_POST['module']);
          $type = trim($_POST['type']);
          $nom= trim($_POST['nom']);
          $sql = "INSERT INTO absence (nomEtd, classe, module, dateAbs, typeAbs) values (:nomEtd, :classe, :module, :dateAbs, :typeAbs)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([
            ':dateAbs' => $dateAbs,
            ':classe' => $classe,
            ':module' => $module,
            ':typeAbs' => $type,
            ':nomEtd' => $nom,
          ]);
          $erreur = "Ajout effectué";
        }
      
      ?> 
      <div class="container">
        <form action="saisirAbsence.php" method="POST" id="myForm">
          <div class="form-group">
            <label for="deb">Selectionner la date d'absence:</label><br>
            <input type="date" id="deb" name="deb" value="2022-05-01" min="1980-01-01" max="2022-12-31">
          </div>
          <div class="form-group">
          <label for="module">Selectionner un module:</label><br>
            
            <select id="module" name="module"  class="custom-select custom-select-sm custom-select-lg">
               <option value="Tech.Web">Tech. Web</option>
               <option value="SGBD">SGBD</option>
               <option value="Struct.Don">Struct.Don</option>
               <option value="Anl.Num">Anl.Num</option>
               <option value="Stat">Stat</option>
               <option value="POO">POO</option>
               <option value="TP.POO">TP.POO</option>
               <option value="Ang">Ang</option>
               <option value="Fr">Fr</option>
            </select>
            <label for="classe">Selectionner la Classe:</label>
            <select name="classe" id="classe" class="custom-select custom-select-sm custom-select-lg">
              <?php
              $sql0 = "SELECT * FROM classe";
              $stmt0 = $pdo->prepare($sql0);
              $stmt0->execute();
              while ($cats = $stmt0->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $cats['name_classe']; ?>">
                  <?php echo $cats['name_classe']; ?>
                </option>
              <?php }
              ?>
            </select>
            <label for="nom">Choisir  l'étudiant:</label><br>
            <select id="nom" name="nom" class="custom-select custom-select-sm custom-select-lg" type="text" placeholder="Nom de l'étudiant">
              <?php
              $sql1 = "SELECT * FROM etudiant";
              $stmt1 = $pdo->prepare($sql1);
              $stmt1->execute();
              while ($cat = $stmt1->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $cat['nom']; ?>">
                  <?php echo $cat['nom']; ?>
                </option>
              <?php }
              ?>
            </select>


            <label for="type">Selectionner le type d'absence:</label><br>
            <select id="type" name="type"  class="custom-select custom-select-sm custom-select-lg">
               <option value="Justifieé">Justifièe</option>
               <option value="NoNJustifieé">NoN Justifièe</option>
              </select>
          </div>
          <button type="submit" name="ajouter" value="ajouter" class="btn btn-primary btn-block">Valider</button>
        </form>
      </div>
    </div>
  </main>


<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>