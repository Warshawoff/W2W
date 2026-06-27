<?php
$rating = isset($_GET['rating']) ? htmlspecialchars($_GET['rating']) : '0.0';
?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 105 32" width="100%" height="100%">
    <defs>
        <style>
            .badge-clickable { cursor: pointer; }
            .badge-bg {
                fill: rgba(20, 20, 20, 0.8);
                stroke: #ffcc00;
                stroke-width: 1.5;
                transition: fill 0.2s ease, stroke 0.2s ease;
            }
            .star-icon {
                fill: #ffcc00;
                transition: fill 0.2s ease;
            }
            .rating-text {
                fill: #ffffff;
                font-family: Arial, sans-serif;
                font-size: 13px;
                font-weight: bold;
                transition: fill 0.2s ease;
            }

            /* Effet au survol (Hover) */
            .badge-clickable:hover .badge-bg {
                fill: #ffcc00;
                stroke: #ffcc00;
            }
            .badge-clickable:hover .star-icon {
                fill: #141414;
            }
            .badge-clickable:hover .rating-text {
                fill: #141414;
            }
            /* Adaptation des couleurs du logo au survol */
            .badge-clickable:hover rect {
                fill: #141414;
            }
            .badge-clickable:hover text {
                fill: #ffcc00;
            }
        </style>
    </defs>

    <g class="badge-clickable">
        <rect class="badge-bg" x="1" y="1" width="103" height="30" rx="8" />
        
        <path class="star-icon" d="M16 7.5 l1.96 4.02 4.43.64-3.21 3.14.76 4.41-3.94-2.07-3.94 2.07.76-4.41-3.21-3.14 4.43-.64z" />
        
        <text class="rating-text" x="28" y="20"><?= $rating ?></text>
        
        <!-- Inclusion du logo centralisé -->
        <g transform="translate(58, 7)">
            <?php include '../components/logo.svg'; ?>
        </g>
    </g>
</svg>