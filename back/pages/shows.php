<?php include '../includes/header.php'; ?>

<div class="details-container">
    <div class="content-wrapper">
        <div class="hero-section">
            <img src="https://image.tmdb.org/t/p/original/6MRSikknRfOfKJYeWfl9nsEiO9L.jpg">
            <div class="overlay"></div>

            <div class="hero-top-actions">
                <a href="javascript:history.back()" class="back-btn">
                    <?php include '../components/back_arrow.svg'; ?>
                </a>
                <div class="add-btn"><?php include '../components/add_btn.svg'; ?></div>
            </div>

            <div class="hero-content">
                <div class="text-col">
                    <h1 class="show-title">Death's Game</h1>
                    <p class="show-meta">1 saison - Terminée</p>
                </div>
                <div class="badges-row">
                    <div class="badge-item"><?php $rating = 8.8; include '../components/badge_imdb.php'; ?></div>
                    <div class="badge-item"><?php include '../components/badge_w2w.php'; ?></div>
                </div>
            </div>

            <div class="progress-container">
                <div id="pb-container">
                    <?php include '../components/progress_bar.svg'; ?>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="top-badges">
                <div class="badge-box">
                    <?php include '../components/calendar_icon.svg'; ?>
                    <span>5 janv. 2024 - 25 janv. 2024</span>
                </div>
                <div class="badge-box">
                    <?php include '../components/clock_icon.svg'; ?>
                    <span>52 min</span>
                </div>
            </div>

            <p class="description">
                Dans ce drama tournant autour de la réincarnation, Yee-jae doit vivre douze vies et douze morts supplémentaires pour éviter l'enfer.
            </p>

            <div class="director-row">
                <span class="label">Réalisation</span>
                <span class="name">Lee Wonsik</span>
            </div>

            <div class="tags-row">
                <span class="tag">Coréen</span>
                <span class="tag">Drame Coréen</span>
                <span class="tag">Drame</span>
                <span class="tag">Fantastique</span>
            </div>

            <?php include '../components/season_control.php'; ?>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>