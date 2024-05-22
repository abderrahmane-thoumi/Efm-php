<?php
require_once 'config.php';

session_start();

if(empty($_SESSION['auth'])) {
    header('Location: authentifier.php');
    exit;
}

try {
    $sql = "SELECT nom, prenom FROM compteadministateur WHERE loginAdmin = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION['auth']]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo 'error :' . $e->getMessage();
}

$sql = "SELECT stagiaire.*, filiere.intitule FROM stagiaire
INNER JOIN filiere ON stagiaire.idFiliere = filiere.idFiliere;";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace privee</title>
</head>
<body>
    <header>
        <h3>Espace privé</h1>
        <a href="deconnecter.php">Se déconnecter</a>
    </header>

    <h1>
        <?php 
            if(date('H') >= 6 AND date('H') < 18 ) {
                echo 'Bonjour ';
            } elseif(date('H') >= 18 AND date('H') < 6) {
                echo 'Bonsoir ';
            }
            
        ?>
        <span style="color:orange">
            <?= $admin['nom'] . ' ' . $admin['prenom']; ?>
        </span>
    </h1>

    <a href="InsererStagiaire.php">Ajouter</a>
    <br><br>
    <hr>
    <table border='1'>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Preom</th>
                <th>Date de Naissance</th>
                <th>Photo de profil</th>
                <th>Filiere</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($result as $stagiaire): ?>
                <tr>
                    <td> <?= $stagiaire['nom'] ?> </td>
                    <td> <?= $stagiaire['prenom'] ?> </td>
                    <td> <?= $stagiaire['dateNaissance'] ?> </td>
                    <td> <?= $stagiaire['photoProfil'] ?> </td>
                    <td> <?= $stagiaire['intitule'] ?> </td>
                    <td>
                        <a href="">Modifier</a>
                    </td>
                    <td>
                        <a href="" onclick="return confirm('voulez vraiment supprimer cette stagiaire ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>