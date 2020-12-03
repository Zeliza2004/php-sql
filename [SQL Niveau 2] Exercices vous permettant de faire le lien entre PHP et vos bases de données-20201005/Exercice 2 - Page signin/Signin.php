<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>SQL niveau 2</title>
</head>
<body>
<div id="container">
    <!-- zone de connexion -->
    <form action="Signin.php" method="POST">
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
            <input type="text" placeholder="Entrez votre mail" name="mail" maxlength="100"></label>
        <br>
        <br>
        <label><b>Mot de passe</b>
            <input type="password" placeholder="Entrez votre mot de passe" name="mot_de_passe" required></label>
        <br>
        <br>
        <label><b>Mot de passe</b>
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
$result = " ";
//Si l'action de validation a été faite
if(isset($_POST["submit"]))
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=niveau2', 'root', ' ');
    } catch (PDOException $e) {
        // en cas d'erreur on print cette erreur
        print "Erreur !: " . $e->getMessage() . "</br>";
        die();
    }
    // initialisation des variable à entrer en DB


    // On récupère les valeurs du formulaire et on les vérifies
    if(isset($_POST["nom"]) && !empty($_POST["nom"])){
        $nom = htmlspecialchars($_POST['nom']);
    }

    if(isset($_POST["prenom"]) && !empty($_POST["prenom"])){
        $prenom = htmlspecialchars($_POST['prenom']);
    }

    if(isset($_POST["mot_de_passe"]) && !empty($_POST["mot_de_passe"])){
        $mot_de_passe = ($_POST['mot_de_passe']);
    }
    if(isset($_POST["mot_de_passe_confirm"]) && !empty($_POST["mot_de_passe_confirm"])){
        $mot_de_passe = ($_POST['mot_de_passe']);
    }
    if ( $_POST['confirm_pass'] != $_POST['pass'] )
    {
        echo "Les 2 mots de passe sont différents";

    }
    if(isset($_POST["mail"]) && !empty($_POST["mail"])){
        $mail = htmlspecialchars($_POST['mail']);
    }
    function verif_mail($mail)
    {
        $syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
        if(preg_match($syntaxe,$mail)) {
            return true;
        }else{
            return false;
    }}

    if (!verif_mail($_POST['mail'])) {
        $message = "Email invalide";

        echo $message;
    }
    if(isset($_POST["cgu"]) && !empty($_POST["cgu"])){
        $cgu = ($_POST['cgu']);
    }
    if(isset($_POST["pro_part"]) && !empty($_POST["pro_part"])){
        $pro_part = $_POST['pro_part'];
    }


    $q = $db->prepare("INSERT INTO utilisateurs (nom, prenom, mot_de_passe, email, statut_utilisateur) VALUES ('$nom','$prenom','$mail','$mot_de_passe','$pro_part')");
    $q->bindValue(1,$nom,PDO::PARAM_STR);
    $q->bindValue(2,$prenom,PDO::PARAM_STR);
    $q->bindValue(1,$mail,PDO::PARAM_STR);
    $q->bindValue(2,$mot_de_passe,PDO::PARAM_STR);
    $q->bindValue(2,$pro_part,PDO::PARAM_STR);

    if($q->execute()){
        $result = 'SUCCESS';
    }else{
        $result = 'ECHEC DE L\'INSERTION';
    }
    echo $result;
}

?>

</body>
</html>