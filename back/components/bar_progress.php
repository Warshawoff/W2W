<?php
/**
 * Fonction pour afficher une barre de progression personnalisée
 */
if (!function_exists('renderBarProgress')) {
    function renderBarProgress(
        $percent = 10,
        $height = '10px',
        $fillColor = '#ffcc00',
        $fillCompleteColor = '#1d8f38',
        $bgColor = '#676767'
    ) {
        // --- SÉCURITÉS ---
        $safePercent = max(0, min(100, (float)$percent));
        $currentColor = ($safePercent >= 100) ? $fillCompleteColor : $fillColor;
        
        ?>
        <div class="custom-progress-wrapper" style="
            height: <?php echo htmlspecialchars($height); ?>; 
            background-color: <?php echo htmlspecialchars($bgColor); ?>;
        ">
            <div class="custom-progress-fill" style="
                width: <?php echo $safePercent; ?>%; 
                background-color: <?php echo htmlspecialchars($currentColor); ?>;
            "></div>
        </div>

        <style>
            .custom-progress-wrapper { width: 100%; overflow: hidden; display: flex; }
            .custom-progress-fill { height: 100%; transition: width 0.5s ease-in-out, background-color 0.3s ease; }
        </style>
        <?php
    }
}
?>