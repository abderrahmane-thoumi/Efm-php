<?php 
require_once 'config.php';

session_start();

$sql = "SELECT * FROM filiere;";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['dateNaissance']) && isset($_FILES['photoProfil']) && isset($_POST['filiere'])) {
  
        try {

            $sql = "INSERT INTO stagiaire (nom, prenom, dateNaissance, idFiliere) VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);

            $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['dateNaissance'], $_POST['filiere']]);

            header("Location: espaceprivee.php");
    
        } catch(PDOException $e) {
             echo $sql . "<br>" . $e->getMessage();
        }
    } else {
            $_SESSION['error'] = 'svp saisir tout les champs';
            header("Location: InsererStagiaire.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouveau stagiaire </title>
</head>
<body>
    <a href="espaceprivee.php">Retour</a>
    <form action="InsererStagiaire.php" method="post">
        <fieldset>
            <h2>Ajouter un stagiaire</h2>
            <p>veullier remplir tous les champs</p>

            <label for="nom">Nom</label><br>
            <input type="text" name="nom" id="nom"><br><br>

            <label for="prenom">PRENOM</label><br>
            <input type="text" name="prenom" id="prenom"><br>

            <label for="dateNaissance">DATE E NAISSANCE</label><br><br>
            <input type="date" name="dateNaissance" id="dateNaissance"><br>

            <label for="photoProfil">PHOTO PROFIL</label><br><br>
            <input type="file" name="photoProfil" id="photoProfil"><br><br>

            <label for="filiere">Filiere</label><br>
            <select name="filiere" id="filiere">

                <?php foreach($result as $filiere):?>
                    <option value="<?=$filiere['idFiliere']?>"><?=$filiere['intitule']?></option>
                <?php endforeach; ?>

            </select><br>
            <input type="submit" value="Ajouter">
        </fieldset>
    </form>
    <p>
        <?= isset($_SESSION['error']) ? $_SESSION['error'] : '' ?>
        <?php unset($_SESSION['error']); ?>
    </p>
</body>
</html>