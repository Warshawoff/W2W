<?php 
require_once '../db.php'; 
require_once '../components/search_card.php';
require_once '../components/search_bar.php';

// 2. Récupération de la chaîne de recherche si elle existe
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';
$search_results = [];

try {
    // Si l'utilisateur fait une recherche, on filtre la table 'series'
    if (!empty($search_query)) {
        $stmt_search = $pdo->prepare("SELECT * FROM series WHERE title ILIKE :q ORDER BY title ASC");
        $stmt_search->execute(['q' => "%$search_query%"]);
        $search_results = $stmt_search->fetchAll();
    }

    // Requête principale : On récupère TOUTES les séries de la table
    $stmt_series = $pdo->query("SELECT * FROM series ORDER BY title ASC");
    $all_series = $stmt_series->fetchAll();

    // Pour l'instant, pas de table ou de données de films
    $all_movies = [];

} catch (PDOException $e) {
    die("Erreur lors de la récupération des données : " . $e->getMessage());
}

include '../components/header.php'; 
?>

<div class="main-container">
    <main id="main-content">
        
        <!-- Barre de recherche -->
        <?php renderSearchBar($search_query); ?>

        <div class="view-content-wrapper">

            <!-- SECTION : RÉSULTATS DE RECHERCHE (Apparaît uniquement en cas de recherche) -->
            <?php if (!empty($search_query)): ?>
                <section class="content-section search-results-section">
                    <h3 class="section-title">Résultats pour "<?= htmlspecialchars($search_query) ?>"</h3>
                    <div class="series-grid">
                        <?php if (empty($search_results)): ?>
                            <p class="empty-message">Aucun résultat trouvé pour cette recherche.</p>
                        <?php else: ?>
                            <?php foreach ($search_results as $show): ?>
                                <?php renderCard($show, 'series'); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>

            <!-- SECTION : SÉRIES (Affiche toutes les séries existantes) -->
            <section class="content-section">
                <h3 class="section-title">TV Séries</h3>
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

            <!-- SECTION : FILMS (Affichage forcé en vide pour l'instant) -->
            <section class="content-section">
                <h3 class="section-title">Films</h3>
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

<?php include '../components/footer.php'; ?>