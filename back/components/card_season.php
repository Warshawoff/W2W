<?php
/**
 * Composant : Carte de saison avec mécanisme d'extension fluide et synchronisation des checks
 */
if (!function_exists('renderCardSeason')) {
    function renderCardSeason(
        $seasonId   = 1,
        $seasonNum  = 1,
        $ratingImdb = '0.0',
        $ratingW2W  = '0.0',
        $isWatched  = false
    ) {
        ?>
        <div class="season-accordion-wrapper" data-season-id="<?php echo (int)$seasonId; ?>">
            <div class="season-header" onclick="toggleSeason(this)">
                <div class="season-row-content">
                    <div class="col-season-title">
                        Saison <?php echo (int)$seasonNum; ?>
                    </div>

                    <!-- Remplacer col-season-badges par col-ratings -->
                    <div class="season-col-ratings" onclick="event.stopPropagation()">
                        <?php 
                            include_once '../components/badge_imdb.php'; renderBadgeImdb(text: $ratingImdb, scale: 0.8); 
                            include_once '../components/badge_w2w.php'; renderBadgeW2W(text: $ratingW2W, scale: 0.8); 
                        ?>
                    </div>

                    <div class="col-season-check" onclick="event.stopPropagation()">
                        <?php 
                            include_once '../components/btn_check.php'; echo '<div class="btn-season-trigger">';
                            renderBtnCheck(size: '35px', isChecked: $isWatched); echo '</div>';
                        ?>
                    </div>
                </div>
            </div>

            <div class="season-expandable-content">
                <?php 
                    include_once '../services/EpisodeService.php';
                    include_once '../components/card_episode.php';
                    $episodeIds = getEpisodesBySeason($seasonId);
                    foreach ($episodeIds as $id) {
                        $ep = getEpisodeDetails($id);
                        renderCardEpisode(
                            title:      $ep['title'],
                            seasonNum:  $seasonNum,
                            episodeNum: $ep['episode_number'],
                            duration: $ep['duration'],
                            releaseDate:  $ep['release_date'],
                            isWatched:  false
                        );
                    }
                ?>
            </div>
        </div>

        <style>
            .season-accordion-wrapper {
                background: #1a1a1e;
                border-radius: 12px;
                margin-bottom: 10px;
                width: 100%;
                box-sizing: border-box;
                overflow: hidden;
            }

            .season-header {
                padding: 15px 25px;
                cursor: pointer;
            }

            .season-row-content {
                display: grid;
                grid-template-columns: 1fr auto auto;
                align-items: center;
                gap: 0px;
            }

            .col-season-title { color: white; font-weight: bold; font-size: 1.1em; }

            .season-expandable-content {
                border-top: 1px solid #333;
                background: #121215;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.4s ease-out, padding 0.4s ease;
            }

            .season-expandable-content.open {
                max-height: 2000px;
                padding: 10px 0px;
            }

            .season-col-ratings {
                display: flex;
                align-items: center;
                gap: 0;
                margin-right: 20px; /* Espacement identique à l'épisode */
            }

            /* Le chevauchement des badges */
            .season-col-ratings > * {
                margin-right: -10px;
            }

            /* Style du bouton d'action pour correspondre à col-action */
            .season-col-action {
                display: flex;
                justify-content: center;
                align-items: center;
                padding-right: 25px; /* Padding identique à col-action */
                margin: 0;
            }
        </style>

        <script>
            function toggleSeason(headerElement) {
                const wrapper = headerElement.closest('.season-accordion-wrapper');
                const content = wrapper.querySelector('.season-expandable-content');
                content.classList.toggle('open');
            }

            document.addEventListener('DOMContentLoaded', () => {
                const wrappers = document.querySelectorAll('.season-accordion-wrapper');

                wrappers.forEach(wrapper => {
                    const seasonBtn = wrapper.querySelector('.btn-season-trigger .check-btn-custom');
                    const episodeBtns = wrapper.querySelectorAll('.season-expandable-content .check-btn-custom');

                    // Saison -> Épisodes
                    seasonBtn.addEventListener('click', function() {
                        const isActive = this.classList.contains('active');
                        episodeBtns.forEach(epBtn => {
                            if (isActive) epBtn.classList.add('active');
                            else epBtn.classList.remove('active');
                        });
                    });

                    // Épisodes -> Saison
                    episodeBtns.forEach(epBtn => {
                        epBtn.addEventListener('click', function() {
                            setTimeout(() => {
                                const allChecked = Array.from(episodeBtns).every(btn => btn.classList.contains('active'));
                                const isSeasonActive = seasonBtn.classList.contains('active');

                                if (allChecked && !isSeasonActive) seasonBtn.classList.add('active');
                                else if (!allChecked && isSeasonActive) seasonBtn.classList.remove('active');
                            }, 50);
                        });
                    });
                });
            });
        </script>
        <?php
    }
}
?>