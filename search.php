<?php 
// 1. Connexion à la base de données
require_once 'db.php'; 

// Inclusion du composant de la carte (assure-toi que le chemin est correct)
require_once 'components/search_card.php';

// 2. On récupère la recherche si l'utilisateur a tapé quelque chose
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

try {
    if (!empty($search_query)) {
        // RECHERCHE : on cherche dans les séries
        $stmt_search = $pdo->prepare("SELECT * FROM series WHERE title ILIKE :q ORDER BY total_views DESC");
        $stmt_search->execute(['q' => "%$search_query%"]);
        $search_results = $stmt_search->fetchAll();
    }

    // SÉRIES : les 6 dernières ajoutées
    $stmt_series = $pdo->query("SELECT * FROM series ORDER BY id DESC LIMIT 6");
    $all_series = $stmt_series->fetchAll();

    // FILMS : simulation avec les séries (à remplacer par ta table 'movies' plus tard)
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
        
        <div class="search-header-zone">
            <form action="search.php" method="GET" class="search-form">
                <div class="search-input-wrapper">
                    <input type="text" name="q" value="<?= htmlspecialchars($search_query) ?>" placeholder="Chercher un film, une série..." autocomplete="off">
                    <button type="submit" class="btn-search">🔍</button>
                </div>
            </form>
        </div>

        <div class="view-content-wrapper">

            <?php if (!empty($search_query)): ?>
                <section class="content-section search-results-section">
                    <h3 class="section-title">Résultats pour "<?= htmlspecialchars($search_query) ?>"</h3>
                    <div class="series-grid">
                        <?php if (empty($search_results)): ?>
                            <p class="empty-message">Aucun résultat trouvé.</p>
                        <?php else: ?>
                            <?php foreach ($search_results as $show): ?>
                                <?php renderCard($show, 'series'); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>

            <section class="content-section">
                <h3 class="section-title">🔥 Les plus populaires</h3>
                <div class="series-grid">
                    <?php if (empty($popular_series)): ?>
                        <p class="empty-message">Aucun contenu populaire.</p>
                    <?php else: ?>
                        <?php foreach ($popular_series as $show): ?>
                            <?php renderCard($show, 'series'); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>

            <section class="content-section">
                <h3 class="section-title">🎯 Recommandations pour vous</h3>
                <div class="series-grid">
                    <?php foreach ($popular_series as $show): ?>
                        <?php renderCard($show, 'series'); ?>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="content-section">
                <h3 class="section-title">📺 Séries</h3>
                <div class="series-grid">
                    <?php if (empty($all_series)): ?>
                        <p class="empty-message">Aucune série disponible.</p>
                    <?php else: ?>
                        <?php foreach ($all_series as $show): ?>
                            <?php renderCard($show, 'series'); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>

            <section class="content-section">
                <h3 class="section-title">🎬 Films</h3>
                <div class="series-grid">
                    <?php if (empty($all_movies)): ?>
                        <p class="empty-message">Aucun film disponible.</p>
                    <?php else: ?>
                        <?php foreach ($all_movies as $movie): ?>
                            <?php renderCard($movie, 'movie'); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>

        </div>
    </main>
</div>

<?php include 'includes/footer.php'; ?>