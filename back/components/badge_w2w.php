<?php
/**
 * Fonction pour afficher le badge W2W avec contraintes de sécurité.
 */
if (!function_exists('renderBadgeW2W')) {
    function renderBadgeW2W(
        $text = '0.0', 
        $scale = 1.0, 
        $bgColor = 'rgba(20, 20, 20, 0.8)', 
        $fillColor = '#ffcc00',
        $borderWidth = '1px'
    ) {
        // --- SÉCURITÉS ---
        $numericScore = (float)str_replace(',', '.', $text);
        $numericScore = round($numericScore, 1);
        $safeScore = max(0.0, min(10.0, $numericScore));
        
        // --- AFFICHAGE ---
        ?>
        <div class="custom-badge-w2w" style="
            --bg-main: <?php echo htmlspecialchars($bgColor); ?>;
            --fill-main: <?php echo htmlspecialchars($fillColor); ?>;
            --border-w: <?php echo htmlspecialchars($borderWidth); ?>;
            transform: scale(<?php echo (float)$scale; ?>);">

            <div class="badge-star-wrapper">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            </div>
            <span class="badge-score"><?php echo number_format($safeScore, 1, '.', ''); ?></span>
            <div class="badge-logo-wrapper">
                <?php include_once '../components/logo_w2w.php'; renderLogoW2W(bgColor: $fillColor, textColor: $bgColor, scale: 1.0); ?>
            </div>
        </div>

        <style>
            .custom-badge-w2w {
                display: inline-flex; 
                align-items: center; 
                justify-content: center; 
                gap: 0.5em; 
                padding: 0.3em 0.5em;
                border: var(--border-w) solid var(--fill-main); 
                border-radius: 0.5em; 
                background: var(--bg-main);
                cursor: pointer; 
                transition: all 0.3s ease; 
                transform-origin: center center;
                box-sizing: border-box;
                line-height: 1;
            }

            .custom-badge-w2w:hover { 
                background: var(--fill-main); 
                border-color: var(--fill-main);
            }

            .custom-badge-w2w .badge-score { 
                color: #ffffff; 
                font-family: sans-serif; 
                font-weight: bold; 
                margin-top: 2px;
                transition: color 0.3s;
            }

            .custom-badge-w2w .badge-star-wrapper { display: flex; align-items: center; }
            .custom-badge-w2w .badge-star-wrapper svg { 
                width: 1em; height: 1em; 
                fill: var(--fill-main); 
                transition: fill 0.3s; 
            }

            .custom-badge-w2w:hover .badge-score { color: var(--bg-main); }
            .custom-badge-w2w:hover .badge-star-wrapper svg { fill: var(--bg-main); }
            
            .custom-badge-w2w:hover .logo-w2w-custom {
                background-color: var(--bg-main) !important;
                color: var(--fill-main) !important;
            }
        </style>
        <?php
    }
}
?>