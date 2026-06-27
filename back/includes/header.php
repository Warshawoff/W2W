<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What2Watch</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<header id="header">
    <div class="header-container">
        <div class="header-left">
            <a class="logo" href="/index.php">
                <?php $scale = '1.4'; include $_SERVER['DOCUMENT_ROOT'] . '/assets/logo_icon.php'; ?>
            </a>
        </div>
        <div class="header-right">
            <nav class="nav-header">
                <a href="/pages/series.php">Séries</a>
                <a href="/pages/films.php">Films</a>
                <a href="/pages/search.php">Rechercher</a>
                <a href="/pages/profil.php">Mon Profil</a>
            </nav>
        </div>
    </div>
</header>