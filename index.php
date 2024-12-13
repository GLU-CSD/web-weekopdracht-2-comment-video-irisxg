<?php
//session_start(); // Start de sessie//
include("config.php");
include("reactions.php");

$getReactions = Reactions::getReactions();
$getVideos = Reactions::getVideos();
$result  = '';

// Verwerk het formulier
if (!empty($_POST)) {
    // Dit is een voorbeeld array. Deze waardes moeten erin staan.
    $postArray = [
        'id' => $_POST['video_id'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'message' => $_POST['message']
    ];

    $setReaction = Reactions::setReaction($postArray);

    if (isset($setReaction['error']) && $setReaction['error'] != '') {
        $_SESSION['result'] = 'Sorry! Er is iets misgegaan tijdens het versturen van jouw bericht.';
    } else {
        $_SESSION['result'] = $setReaction['succes'];
    }

    // Redirect naar dezelfde pagina om POST-gegevens te vermijden
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Haal de sessiemelding op, als deze bestaat
if (isset($_SESSION['result'])) {
    $result = $_SESSION['result'];
    unset($_SESSION['result']); // Verwijder de melding na het tonen
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youtube remake</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Video iframe -->
    <iframe width="100%" height="auto" src="<?php echo htmlspecialchars($getVideos[2]['url']); ?>" 
            title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
    </iframe>

    <h3>Schrijf een reactie</h3>
    <!-- Reactieformulier -->
    <form action="" method="POST">
        <label for="name">Naam
            <input type="text" name="name" value="" required>
        </label>
        <br>
        <label for="email">Email
            <input type="email" name="email" value="" required>
        </label>
        <br>
        <label for="message">Bericht
            <textarea rows="5" cols="30" name="message" required></textarea>
        </label>
        <br>
        <input type="hidden" name="video_id" value="<?php echo htmlspecialchars($getVideos[2]['id']); ?>">
        <input type="submit" value="Verstuur">
    </form>

    <!-- Resultaatmelding -->
    <?php if (!empty($result)): ?>
        <p><?php echo htmlspecialchars($result); ?></p>
    <?php endif; ?>

    <h2>Hieronder komen reacties</h2>
    <!-- Reacties weergeven -->
    <?php foreach ($getReactions as $reaction): ?>
        <p>
            <strong><?php echo htmlspecialchars($reaction['name']); ?></strong> 
            (<?php echo htmlspecialchars($reaction['email']); ?>): 
            <?php echo htmlspecialchars($reaction['message']); ?>
        </p>
    <?php endforeach; ?>

</body>
</html>

<?php
$con->close();
?>
