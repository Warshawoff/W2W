<?php include '../includes/header.php'; ?>

<div class="details-container">
    <div class="content-wrapper">
        <div class="hero-section">
            <img src="https://image.tmdb.org/t/p/original/6MRSikknRfOfKJYeWfl9nsEiO9L.jpg">
            <div class="overlay"></div>

            <div class="hero-top-actions">
                <a href="javascript:history.back()" class="back-btn">
                    <?php $bgColor = 'rgba(20, 20, 20, 0.8)'; $iconColor = '#ffcc00'; $borderWidth = '2px'; include '../components/btn_backarrow.php'; ?>
                </a>
                <?php $bgColor = 'rgba(20, 20, 20, 0.8)'; $iconColor = '#ffcc00'; $radius = '0 15px 0 15px'; $borderWidth = '2px'; include '../components/btn_add.php'; ?>
            </div>

            <div class="hero-content">
                <div class="text-col">
                    <h1 class="show-title">Death's Game</h1>
                    <p class="show-meta">1 saison - Terminée</p>
                </div>
                <div class="badges-row">
                    <div class="badge-item"><?php $bgColor = 'rgba(20, 20, 20, 0.8)'; include '../components/badge_imdb.php'; ?></div>
                    <div class="badge-item"><?php $bgColor = 'rgba(20, 20, 20, 0.8)'; include '../components/badge_w2w.php'; ?></div>
                </div>
            </div>

            <div class="progress-container">
                <div id="pb-container">
                    <?php $percent = 78; $height = '10px'; $fillColor = '#ffcc00'; $fillCompleteColor = '#1d8f38'; $bgColor = '#676767'; include '../components/progress_bar.php'; ?>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="top-badges">
                <?php $type = 'date'; $text = '5 janv. 2024 - 25 janv. 2024'; $bgColor = 'rgba(20, 20, 20, 0.8)'; $color = '#ffffff'; $borderWidth = '1px'; include '../components/badge_icon.php'; ?>
                <?php $type = 'time'; $text = '52 min'; $bgColor = 'rgba(20, 20, 20, 0.8)'; $color = '#ffffff'; $borderWidth = '1px'; include '../components/badge_icon.php'; ?>
            </div>

            <p class="description">
                Dans ce drama tournant autour de la réincarnation, Yee-jae doit vivre douze vies et douze morts supplémentaires pour éviter l'enfer.
            </p>

            <div class="director-row">
                <span class="label">Réalisation</span>
                <span class="name">Lee Wonsik</span>
            </div>

            <div class="tags-row">
                <?php $text = 'Coréen'; $bgColor = 'rgba(20, 20, 20, 0.8)'; $color = '#ffffff'; $borderWidth = '1px'; include '../components/btn_genre.php'; ?>
                <?php $text = 'Drame Coréen'; $bgColor = 'rgba(20, 20, 20, 0.8)'; $color = '#ffffff'; $borderWidth = '1px'; include '../components/btn_genre.php'; ?>
                <?php $text = 'Drame'; $bgColor = 'rgba(20, 20, 20, 0.8)'; $color = '#ffffff'; $borderWidth = '1px'; include '../components/btn_genre.php'; ?>
                <?php $text = 'Fantastique'; $bgColor = 'rgba(20, 20, 20, 0.8)'; $color = '#ffffff'; $borderWidth = '1px'; include '../components/btn_genre.php'; ?>
            </div>

        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>