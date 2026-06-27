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
            <a href="#" class="btn-add-playlist" title="Ajouter à ma liste">
                <span class="plus-icon">+</span>
            </a>
        </div>

        <div class="media-info">
            <h3><?= $title ?></h3>
            
            <div class="ratings-container">
                <div class="rating-badge-item">
                    <span class="star-icon">★</span>
                    <span class="rating-value"><?= $rating ?></span>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/IMDB_Logo_2016.svg/960px-IMDB_Logo_2016.svg.png" alt="IMDb" class="badge-logo-img">
                </div>

                <div class="rating-badge-item">
                    <span class="star-icon">★</span>
                    <span class="rating-value"><?= $rating ?></span>
                    <div class="badge-logo-html">
                        <?php include '../logo.html'; ?>
                    </div>
                </div>
            </div>

            <?= $extra_info ?>
        </div>

        <a href="details.php?id=<?= $id ?>&type=<?= $type ?>" class="main-card-link"></a>
    </div>

    <?php
}
?>