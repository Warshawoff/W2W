<?php include '../includes/header.php'; ?>

<div class="details-container">
    <div class="content-wrapper">
        <div class="hero-section">
            <img src="https://image.tmdb.org/t/p/original/6MRSikknRfOfKJYeWfl9nsEiO9L.jpg">
            <div class="overlay"></div>

            <div class="hero-top-actions">
                <a href="javascript:history.back()" class="back-btn">
                    <?php include '../components/btn_backarrow.php'; renderBtnBackArrow(); ?>
                </a>
                <?php include '../components/btn_add.php'; renderBtnAdd(); ?>
            </div>

            <div class="hero-content">
                <div class="text-col">
                    <h1 class="show-title">Death's Game</h1>
                    <p class="show-meta">1 saison - Terminée</p>
                </div>
                <div class="badges-row">
                    <div class="badge-item"><?php include_once '../components/badge_imdb.php'; renderBadgeImdb(text: '0.0'); ?></div>
                    <div class="badge-item"><?php include_once '../components/badge_w2w.php'; renderBadgeW2W(text: '0.0'); ?></div>
                </div>
            </div>

            <div class="progress-container">
                <div id="pb-container">
                    <?php include '../components/bar_progress.php'; renderBarProgress(percent: '89')?>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="top-badges">
                <?php include '../components/badge_icon.php'; 
                    renderBadgeIcon(type: 'date', text: '5 janv. 2024 - 25 janv. 2024');
                    renderBadgeIcon(type: 'time', text: '52 min');
                ?>
            </div>

            <p class="description">
                Dans ce drama tournant autour de la réincarnation, Yee-jae doit vivre douze vies et douze morts supplémentaires pour éviter l'enfer.
            </p>

            <div class="director-row">
                <span class="label">Réalisation</span>
                <span class="name">Lee Wonsik</span>
            </div>

            <div class="tags-row">
                <?php include '../components/btn_genre.php'; 
                    renderButtonGenre('Coréen');
                    renderButtonGenre('Drame Coréen');
                    renderButtonGenre('Drame');
                    renderButtonGenre('Fantastique');
                ?>
            </div>
            
            <?php
                $seriesId = 1;
                include_once '../services/SeasonService.php';
                include_once '../components/card_season.php';

                // Supposons que $seriesId soit récupéré depuis l'URL
                $seasonIds = getSeasonsBySeries($seriesId);

                foreach ($seasonIds as $id) {
                    $season = getSeasonDetails($id);
                    
                    renderCardSeason(
                        seasonId:   $id,
                        seasonNum:  $season['season_number'],
                        ratingImdb: $season['rating_imdb'],
                        ratingW2W:  $season['rating_w2w']
                    );
                }
                ?>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>