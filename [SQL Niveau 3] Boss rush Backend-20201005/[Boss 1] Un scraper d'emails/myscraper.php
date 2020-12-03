<?php
include 'email_scraper.php';
include_once 'medoo.php';
include 'database.php';
use Medoo\Medoo;

if (isset($_POST['envoi'])) {

    $url = $_POST['url'];
    $emails = scrape_email($url);
    foreach ($emails as $email) {
        $database->insert('emails', [
            'email' => $email,
        ]);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Scraper</title>
</head>
<body>
<form action="myscraper.php" method="post">
    <label for="url">Votre site à scrapper : </label>
    <input type="text" id='url' name='url' placeholder='www.votresiteàscrapper'>
    <input type="submit" id="envoi" name="envoi">

    <h2>Vos emails récoltés :</h2>
<?php
echo implode($emails, '<br>');
?>

</form>
</body>
</html>
