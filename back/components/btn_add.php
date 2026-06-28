<?php
/**
 * Fonction pour afficher le bouton d'ajout
 */
if (!function_exists('renderBtnAdd')) {
    function renderBtnAdd(
        $bgColor = 'rgba(20, 20, 20, 0.8)',
        $iconColor = '#ffcc00',
        $size = '40px',
        $radius = '0 15px 0 15px',
        $borderWidth = '2px'
    ) {
        ?>
        <button class="add-btn-custom" style="
            --bg-color: <?php echo htmlspecialchars($bgColor); ?>;
            --icon-color: <?php echo htmlspecialchars($iconColor); ?>;
            width: <?php echo htmlspecialchars($size); ?>; 
            height: <?php echo htmlspecialchars($size); ?>; 
            background-color: var(--bg-color);
            border-radius: <?php echo htmlspecialchars($radius); ?>;
            border: <?php echo htmlspecialchars($borderWidth); ?> solid #ffcc00;">
            <svg viewBox="0 0 24 24" fill="none" stroke="var(--icon-color)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </button>

        <style>
            .add-btn-custom {
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                padding: 0;
                box-sizing: border-box;
            }

            .add-btn-custom:hover {
                background-color: var(--icon-color) !important;
            }

            .add-btn-custom:hover svg {
                stroke: var(--bg-color) !important;
            }

            .add-btn-custom svg {
                width: 65%;
                height: 65%;
                transition: stroke 0.3s ease;
            }
        </style>
        <?php
    }
}
?>