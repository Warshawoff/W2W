<?php
/**
 * Composant : Élément d'épisode dans une liste
 */
if (!function_exists('renderCardEpisode')) {
    function renderCardEpisode(
        $title      = 'Titre de l\'épisode', 
        $seasonNum  = 1, 
        $episodeNum = 1, 
        $duration = '0', 
        $releaseDate  = '0', 
        $thumbUrl   = 'https://images.prestigeonline.com/wp-content/uploads/sites/5/2024/12/10213456/squid-game-season-1-shocking-scenes-Red-Light-Green-Light-main-image-1600x900.jpg',
        $linkUrl    = '../pages/search.php',
        $isWatched  = false
    ) {
        $formattedDuration = (int)$duration . ' min';
        $formattedDate = (!empty($releaseDate)) ? date('d M Y', strtotime($releaseDate)) : 'Date inconnue';

        ?>
        <div class="episode-item-container" onclick="window.location.href='<?php echo htmlspecialchars($linkUrl); ?>'">
            <div class="col-thumb">
                <div class="episode-thumb" style="background-image: url('<?php echo htmlspecialchars($thumbUrl); ?>');"></div>
            </div>

            <div class="col-info">
                <div class="row-meta">
                    <span class="text-meta">S<?php echo str_pad($seasonNum, 2, '0', STR_PAD_LEFT); ?></span>
                    <span class="text-meta">E<?php echo str_pad($episodeNum, 2, '0', STR_PAD_LEFT); ?></span>
                </div>
                <div class="row-title">
                    <?php echo htmlspecialchars($title); ?>
                </div>
            </div>

            <div class="col-ratings" onclick="event.stopPropagation()">
                <?php 
                    include_once '../components/badge_icon.php'; 
                    renderBadgeIcon(type: 'time', text: $formattedDuration, scale: '0.9'); 
                    renderBadgeIcon(type: 'date', text: $formattedDate, scale: '0.9');
                ?>
            </div>

            <div class="col-action" onclick="event.stopPropagation()">
                <?php 
                    include_once '../components/btn_check.php'; 
                    renderBtnCheck(size: '35px', isChecked: $isWatched); 
                ?>
            </div>
        </div>

        <style>
            .episode-item-container {
                display: grid;
                grid-template-columns: 120px 1fr auto auto;
                align-items: center;
                gap: 12px;
                background: #1a1a1e;
                padding: 0;
                margin-bottom: 10px;
                width: 100%;
                box-sizing: border-box;
                cursor: pointer;
                overflow: hidden;
            }

            .col-thumb {
                width: 120px;
                height: 100%;
                /* Ajout de l'ombre fine sur le bord droit */
                box-shadow: 0.5px 0 0 0 rgb(255, 255, 255);
            }

            .episode-thumb {
                width: 100%;
                height: 100%;
                min-height: 68px;
                background-size: cover;
                background-position: center;
            }

            .col-info {
                display: flex;
                flex-direction: column;
                overflow: hidden;
                gap: 4px;
                padding: 10px 0;
            }

            .row-meta {
                display: flex;
                gap: 8px;
            }

            .text-meta {
                color: #aaa;
                font-size: 0.9em;
                font-weight: bold;
            }

            .row-title {
                color: white;
                font-weight: 500;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .col-ratings {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-right: 10px;
            }

            .col-ratings > * {
                margin-right: -10px;
            }

            .col-action {
                display: flex;
                justify-content: center;
                align-items: center;
                padding-right: 25px;
                margin: 0;
            }
        </style>
        <?php
    }
}
?>