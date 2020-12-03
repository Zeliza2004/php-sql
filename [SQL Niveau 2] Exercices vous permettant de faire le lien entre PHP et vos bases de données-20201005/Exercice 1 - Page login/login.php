<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>SQL niveau 2</title>
</head>
<body>
<div id="container">
    <!-- zone de connexion -->
    <form action="login.php" method="POST">
        <h1>Connection</h1>
            <p>
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required pattern="^[A-Za-z '-]+$" maxlength="20">
            </p>
            <p>
                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
            </p>
            <p>
                <input type="submit" id='submit' value='ENVOYER' >
            </p>

    </form>
</div>
<?php
$result = "";
//Si l'action de validation a été faite
if(isset($_POST["login"]) && isset($_POST['password']))
{
    // connexion à la base de donnée avec PDO
    try {
        $db = new PDO('mysql:host=localhost;dbname=niveau2', 'root', '');
    } catch (PDOException $e) {
        // en cas d'erreur on print cette erreur
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    // initialisation des variable à entrer en DB

    $login = htmlspecialchars($_POST["login"]);
    $password = htmlspecialchars($_POST["password"]);
    date_default_timezone_set('Europe/Paris');
    $date = strftime('%Y-%m-%d %H:%M:%S');
    echo date("d m Y, H:i:s");

    // On récupère les valeurs du formulaire

    if(isset($_POST["login"]) && !empty($_POST["login"])){
        $login = htmlspecialchars($_POST["login"]);
    }
    if(isset($_POST["password"]) && !empty($_POST["password"])){
        $password = htmlspecialchars($_POST["password"]);
    }

    if(!$login){
        $result = "invalid Login param";
    }

    if(!$password){
        $result = "invalid password param";
    }
    $q = $db->prepare("INSERT INTO connexions (login, password, date) VALUES ('$login','$password','$date')");
    $q->bindValue(1,$login,PDO::PARAM_STR);
    $q->bindValue(2,$password,PDO::PARAM_STR);
    $q->bindValue(3,$date,PDO::PARAM_STR);

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
