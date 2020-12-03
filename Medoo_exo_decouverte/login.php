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
                <label for="Email">E-Mail</label>
                <input type="text" id="email" name="email" value="<?php echo isset($email) ? $email : "" ?>">
            </p>
            <p>
                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
            </p>
            <p>
                <input type="submit" id='submit' name='submit' value='ENVOYER' >
            </p>

    </form>
</div>
<?php
include 'database.php';
$result = "";

if(isset($_POST["submit"])){

    $Email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    date_default_timezone_set('Europe/Paris');
    $date = strftime('%Y-%m-%d %H:%M:%S');


    if(isset($_POST["email"]) && !empty($_POST["email"])){
        $login = htmlspecialchars($_POST["login"]);
    }
    if(isset($_POST["password"]) && !empty($_POST["password"])){
        $password = htmlspecialchars($_POST["password"]);
    }

    if(!$Email){
        $result = "invalid email param";
    }

    if(!$password){
        $result = "invalid password param";
    }
    $database -> insert ("connexions" , [
            "login" => $login,
            "password" => $password,
            "date" => $date,
        ]);
}
?>
</body>
</html>

