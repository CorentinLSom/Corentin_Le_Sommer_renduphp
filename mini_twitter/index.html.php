<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Twitter</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <nav>
            <h2>Mini Twitter</h2>
            <ul>
                <li class="home"><a href="#">Accueil</a></li>
                <li><a href="#">Explorer</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Messages</a></li>
                <li><a href="#">Listes</a></li>
                <li><a href="#">Signets</a></li>
                <li><a href="#">Communautés</a></li>
                <li><a href="#">Prenium</a></li>
                <li><a href="#">Profil</a></li>
                <li><a href="#">Plus</a></li>
            </ul>
        </nav>
        <section class="feed">
            <div class=feed-nav>
                <h4 class="home">Pour vous</h4>
                <h4>Abonnements</h4>
            </div>
            <?php if(!empty($user)): ?>
                <h1>Connecté en tant que <?= $user ?></h3>
            <?php endif; ?>
            <form id="tweetForm" action="action.php" method="POST">
                <?php if(!empty($user)): ?>
                    <input type="hidden" name="user" value="<?= $user ?>">
                <?php endif; ?>
                <textarea placeholder="Quoi de neuf ?!" name="message"></textarea>
                <button type="submit">Poster</button>
            </form>
            <div class="tweets">
                <!-- Les tweets seront ajoutés ici -->
                <?php foreach ($tweets as $tweet) : ?>
                    <div class="tweet">
                        <h3><?= $tweet["pseudo"] ?></h3>
                        <p><?= $tweet["message"] ?></p>
                        <?php if($user == $tweet["pseudo"]) : ?>
                            <form action="delete.php" method="POST">
                                <?php if(!empty($user)): ?>
                                    <input type="hidden" name="user" value="<?= $user ?>">
                                <?php endif; ?>
                                <input type="hidden" name="tweetId" value="<?= $tweet["id"] ?>">
                                <button class="delete-button" type="submit">Supprimer</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach ?>
            </div>
        </section>
        <nav></nav>
    </div>
</body>
</html>
