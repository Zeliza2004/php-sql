<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>SQL niveau 2</title>
</head>
<body>
<div id="container">
    <!-- zone de connexion -->
    <form action="connection.php" method="POST">
        <h1>Connection</h1>
        <label><b>Nom d'utilisateur</b>
            <input type="text" placeholder="Entrez votre nom" name="nom" required pattern="^[A-Za-z '-]+$" maxlength="20"></label>
        <br>
        <br>
        <label><b>Prénom d'utilisateur</b>
            <input type="text" placeholder="Entrez votre prénom" name="prenom" required pattern="^[A-Za-z '-]+$" maxlength="20"></label>
        <br>
        <br>
        <label><b>Mail utilisateur</b>
            <input type="text" placeholder="Entrez votre mail" name="email" maxlength="100"></label>
        <br>
        <br>
        <label><b>Mot de passe</b>
            <input type="password" placeholder="Entrez votre mot de passe" name="mot_de_passe" required></label>
        <br>
        <br>
        <label><b>Confirmez votre mot de passe</b>
            <input type="password" placeholder="Confirmez votre mot de passe" name="mot_de_passe_confirm" required></label>
        <br>
        <br>
        <label>
            <input type="radio" name="pro_part" value="part" checked >Particulier
            <input type="radio" name="pro_part" value="pro">Profesionnel<br><br>
        </label>
        <label>
            <input type="checkbox" name="cgu" value="cgu">Je reconnais avoir pris connaissance des conditions d'utilisation et y adhère totalement<br><br>
        </label>
        <p>
            <input type="submit" id='submit' name='submit' value='ENVOYER' >
        </p>
    </form>
</div>
<?php
include 'database.php';
$result = "";

if(isset($_POST["submit"])) {

    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
    $mot_de_passe_confirm = htmlspecialchars($_POST['mot_de_passe_confirm']);
    $email = htmlspecialchars($_POST['email']);
    $cgu = $_POST['cgu'];
    $pro_part = $_POST['pro_part'];

    $valid = true;

    if (empty($pro_part) || empty($cgu)) {
        $valid = false;
        echo '<p>Vous devez cocher toutes les cases </br></p>';
    }

    if (!preg_match('@[A-Z]@', $mot_de_passe) && !preg_match('@[a-z]@', $mot_de_passe) && !preg_match('@[0-9]@', $mot_de_passe) && (strlen($mot_de_passe) >= 8)) {
        $valid = false;
        echo '<p>Votre mot de passe doit être composé de 8 caractères, d\'au moins un chiffre et de lettres majuscules et minuscules</br></p>';
    } else {
        $mdp = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    }

    if ($mot_de_passe != $mot_de_passe_confirm) {
        $valid = false;
        echo '<p>Vos mots de passe ne correspondent pas!</br></p>';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        echo '<p>Votre adresse mail n\'est pas valide</br></p>';
    }

    if ($valid = true) {
        $database-> insert ("utilisateurs", [
            "nom" => $nom,
            "prenom" => $prenom,
            "email" => $email,
            "mot_de_passe" => $mdp,
            "statut_utilisateur" => $pro_part,
        ]);
    }
}
?>
</body>
</html>
