<?php
/**
 * Composant Carte (Série / Film) avec double notation
 * @param array $item Les données de l'élément (série ou film)
 * @param string $type Le type d'élément ('series' ou 'movie')
 */

function renderCard($item, $type = 'series') {
    $poster = !empty($item['poster_url']) ? htmlspecialchars($item['poster_url']) : 'default-poster.jpg';
    $rating = !empty($item['rating_imdb']) ? htmlspecialchars($item['rating_imdb']) : '0.0';
    $title = htmlspecialchars($item['title']);
    $id = intval($item['id']);
    
    $extra_info = '';
    if ($type === 'movie' && isset($item['duration'])) {
        $extra_info = '<p class="card-meta">⏱️ ' . htmlspecialchars($item['duration']) . ' min</p>';
    }
    ?>
    
    <div class="media-card">
        <div class="media-poster" style="background-image: url('<?= $poster ?>');">
            <div class="hero-add-btn-holder">
                <?php include '../components/btn_add.php'; renderBtnAdd(); ?>
            </div>
            
        </div>

        <div class="media-info">
            <h3><?= $title ?></h3>
            
            <div class="ratings-container">
                <?php include_once '../components/badge_imdb.php'; renderBadgeImdb(text: '0.0'); ?>
                <?php include_once '../components/badge_w2w.php'; renderBadgeW2W(text: '0.0'); ?>
            </div>
            
            <?= $extra_info ?>
        </div>

        <a href="../pages/shows.php?id=<?= $id ?>&type=<?= $type ?>" class="main-card-link" aria-label="Voir les détails de <?= $title ?>"></a>
    </div>
    <?php
}
?>