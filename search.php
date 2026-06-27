<?php 
// 1. Connexion à la base de données
require_once 'db.php'; 

// 2. On récupère la recherche si l'utilisateur a tapé quelque chose
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

try {
    if (!empty($search_query)) {
        // RECHERCHE : on cherche dans les séries (et éventuellement films si tu as une table)
        $stmt_search = $pdo->prepare("SELECT * FROM series WHERE title ILIKE :q ORDER BY total_views DESC");
        $stmt_search->execute(['q' => "%$search_query%"]);
        $search_results = $stmt_search->fetchAll();
    }

    // SÉRIES : les 6 dernières ajoutées
    $stmt_series = $pdo->query("SELECT * FROM series ORDER BY id DESC LIMIT 6");
    $all_series = $stmt_series->fetchAll();

    // FILMS : on simule avec les séries pour l'exemple (si tu as une table movies, remplace)
    // ICI j'utilise les séries en attendant que tu crées la table movies
    $stmt_movies = $pdo->query("SELECT * FROM series ORDER BY id DESC LIMIT 6");
    $all_movies = $stmt_movies->fetchAll();

    // POPULAIRES : top 6 séries les plus vues
    $stmt_popular = $pdo->query("SELECT * FROM series ORDER BY total_views DESC LIMIT 6");
    $popular_series = $stmt_popular->fetchAll();

} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}

include 'includes/header.php'; 
?>

<div class="main-container">
    <main id="main-content">
        
        <!-- ========== ZONE DE RECHERCHE ========== -->
        <div class="search-header-zone">
            <form action="search.php" method="GET" class="search-form">
                <div class="search-input-wrapper">
                    <input type="text" name="q" value="<?= htmlspecialchars($search_query) ?>" placeholder="Chercher un film, une série..." autocomplete="off">
                    <button type="submit" class="btn-search">🔍</button>
                </div>
            </form>
        </div>

        <div class="view-content-wrapper">

            <!-- ========== RÉSULTATS DE RECHERCHE ========== -->
            <?php if (!empty($search_query)): ?>
                <section class="content-section search-results-section">
                    <h3 class="section-title">Résultats pour "<?= htmlspecialchars($search_query) ?>"</h3>
                    <div class="series-grid">
                        <?php if (empty($search_results)): ?>
                            <p class="empty-message">Aucun résultat trouvé.</p>
                        <?php else: ?>
                            <?php foreach ($search_results as $show): ?>
                                <div class="series-card">
                                    <div class="series-poster" style="background-image: url('<?= htmlspecialchars($show['poster_url'] ?: 'default-poster.jpg') ?>');">
                                        <span class="badge-rating">⭐ <?= htmlspecialchars($show['rating_imdb']) ?></span>
                                    </div>
                                    <div class="series-info">
                                        <h3><?= htmlspecialchars($show['title']) ?></h3>
                                        <p class="synopsis"><?= htmlspecialchars(substr($show['description'], 0, 80)) ?>...</p>
                                        <a href="details.php?id=<?= $show['id'] ?>&type=series" class="btn-details">Voir plus →</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- ========== LES PLUS POPULAIRES ========== -->
            <section class="content-section">
                <h3 class="section-title">🔥 Les plus populaires</h3>
                <div class="series-grid">
                    <?php if (empty($popular_series)): ?>
                        <p class="empty-message">Aucun contenu populaire.</p>
                    <?php else: ?>
                        <?php foreach ($popular_series as $show): ?>
                            <div class="series-card">
                                <div class="series-poster" style="background-image: url('<?= htmlspecialchars($show['poster_url'] ?: 'default-poster.jpg') ?>');">
                                    <span class="badge-rating">⭐ <?= htmlspecialchars($show['rating_imdb']) ?></span>
                                </div>
                                <div class="series-info">
                                    <h3><?= htmlspecialchars($show['title']) ?></h3>
                                    <div class="series-stats">
                                        <span>👀 <?= htmlspecialchars($show['total_views']) ?> vues</span>
                                    </div>
                                    <a href="details.php?id=<?= $show['id'] ?>&type=series" class="btn-details">Voir plus →</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>

            <!-- ========== RECOMMANDATIONS ========== -->
            <section class="content-section">
                <h3 class="section-title">🎯 Recommandations pour vous</h3>
                <div class="series-grid">
                    <?php foreach ($popular_series as $show): ?>
                        <div class="series-card">
                            <div class="series-poster" style="background-image: url('<?= htmlspecialchars($show['poster_url'] ?: 'default-poster.jpg') ?>');">
                                <span class="badge-rating">⭐ <?= htmlspecialchars($show['rating_imdb']) ?></span>
                            </div>
                            <div class="series-info">
                                <h3><?= htmlspecialchars($show['title']) ?></h3>
                                <a href="details.php?id=<?= $show['id'] ?>&type=series" class="btn-details">Voir plus →</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- ========== SÉRIES ========== -->
            <section class="content-section">
                <h3 class="section-title">📺 Séries</h3>
                <div class="series-grid">
                    <?php if (empty($all_series)): ?>
                        <p class="empty-message">Aucune série disponible.</p>
                    <?php else: ?>
                        <?php foreach ($all_series as $show): ?>
                            <div class="series-card">
                                <div class="series-poster" style="background-image: url('<?= htmlspecialchars($show['poster_url'] ?: 'default-poster.jpg') ?>');">
                                    <span class="badge-rating">⭐ <?= htmlspecialchars($show['rating_imdb']) ?></span>
                                </div>
                                <div class="series-info">
                                    <h3><?= htmlspecialchars($show['title']) ?></h3>
                                    <p class="director">Saisons: <?= htmlspecialchars($show['season_count']) ?></p>
                                    <a href="details.php?id=<?= $show['id'] ?>&type=series" class="btn-details">Voir plus →</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>

            <!-- ========== FILMS ========== -->
            <section class="content-section">
                <h3 class="section-title">🎬 Films</h3>
                <div class="series-grid">
                    <?php if (empty($all_movies)): ?>
                        <p class="empty-message">Aucun film disponible.</p>
                    <?php else: ?>
                        <?php foreach ($all_movies as $movie): ?>
                            <div class="series-card">
                                <div class="series-poster" style="background-image: url('<?= htmlspecialchars($movie['poster_url'] ?: 'default-poster.jpg') ?>');">
                                    <span class="badge-rating">⭐ <?= htmlspecialchars($movie['rating_imdb']) ?></span>
                                </div>
                                <div class="series-info">
                                    <h3><?= htmlspecialchars($movie['title']) ?></h3>
                                    <?php if (isset($movie['duration'])): ?>
                                        <p class="director">⏱️ <?= htmlspecialchars($movie['duration']) ?> min</p>
                                    <?php endif; ?>
                                    <a href="details.php?id=<?= $movie['id'] ?>&type=movie" class="btn-details">Voir plus →</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>

        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>