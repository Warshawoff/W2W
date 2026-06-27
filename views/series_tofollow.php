<?php
// 1. On appelle le fichier de connexion que tu as créé
require_once 'db.php';

try {
    // 2. On exécute la requête pour récupérer les séries de la base de données
    $stmt = $pdo->query("SELECT * FROM series ORDER BY total_views DESC");
    $series = $stmt->fetchAll();
} catch (PDOException $e) {
    // En cas d'erreur de requête, on l'affiche pour comprendre le problème
    die("Erreur lors de la récupération des séries : " . $e->getMessage());
}
?>

<section class="content-section">
    <h2>Upcoming Releases</h2>
    <div class="series-grid">
        <?php if (empty($series)): ?>
            <p>Aucune série disponible pour le moment.</p>
        <?php else: ?>
            <?php foreach ($series as $show): ?>
                <div class="series-card">
                    <div class="series-poster" style="background-image: url('<?= htmlspecialchars($show['poster_url']) ?>');">
                        <span class="badge-rating">⭐ <?= htmlspecialchars($show['rating_imdb']) ?></span>
                    </div>
                    
                    <div class="series-info">
                        <h3><?= htmlspecialchars($show['title']) ?></h3>
                        <p class="director">Par <?= htmlspecialchars($show['director']) ?></p>
                        <p class="synopsis"><?= htmlspecialchars($show['description']) ?></p>
                        
                        <div class="series-stats">
                            <span>Saisons: <?= htmlspecialchars($show['season_count']) ?></span>
                            <span>Vues: <?= htmlspecialchars($show['total_views']) ?> 👀</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>