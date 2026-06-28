<?php
/**
 * Fonction pour afficher le bouton de validation (check)
 */
if (!function_exists('renderBtnCheck')) {
    function renderBtnCheck(
        $bgColor = 'rgba(20, 20, 20, 0.8)',
        $activeBgColor = '#1d8f38',
        $iconColor = '#ffffff',
        $size = '40px',
        $isChecked = false
    ) {
        // Détermine si la classe 'active' doit être ajoutée
        $activeClass = $isChecked ? 'active' : '';
        ?>
        <button type="button" class="check-btn-custom <?php echo $activeClass; ?>" 
            onclick="this.classList.toggle('active')"
            style="
            width: <?php echo htmlspecialchars($size); ?>; 
            height: <?php echo htmlspecialchars($size); ?>; 
            --bg-default: <?php echo htmlspecialchars($bgColor); ?>;
            --bg-active: <?php echo htmlspecialchars($activeBgColor); ?>;
            background-color: var(--bg-default);
        ">
            <svg viewBox="0 0 24 24" fill="none" stroke="<?php echo htmlspecialchars($iconColor); ?>" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </button>

        <style>
            .check-btn-custom {
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                border: none;
                cursor: pointer;
                box-sizing: border-box;
                transition: background-color 0.3s ease;
                padding: 0;
            }

            .check-btn-custom.active {
                background-color: var(--bg-active) !important;
            }

            .check-btn-custom svg {
                width: 60%;
                height: 60%;
                display: block;
            }
        </style>
        <?php
    }
}
?>