<?php
/**
 * Paramètres :
 * - $bgColor: Couleur de fond initiale
 * - $activeBgColor: Couleur quand activé (vert)
 * - $iconColor: Couleur de l'icône
 * - $size: Taille
 */
$bgColor       = isset($bgColor)       ? $bgColor       : 'rgba(20, 20, 20, 0.8)';
$activeBgColor = isset($activeBgColor) ? $activeBgColor : '#1d8f38';
$iconColor     = isset($iconColor)     ? $iconColor     : '#ffffff';
$size          = isset($size)          ? $size          : '40px';
?>

<button type="button" class="check-btn-custom" 
    onclick="this.classList.toggle('active')"
    style="
    width: <?php echo $size; ?>; 
    height: <?php echo $size; ?>; 
    --bg-default: <?php echo $bgColor; ?>;
    --bg-active: <?php echo $activeBgColor; ?>;
    background-color: var(--bg-default);
">
    <svg viewBox="0 0 24 24" fill="none" stroke="<?php echo $iconColor; ?>" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
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
        padding: 0; /* Important pour centrer l'icône */
    }

    /* Changement de couleur au clic */
    .check-btn-custom.active {
        background-color: var(--bg-active) !important;
    }

    .check-btn-custom svg {
        width: 60%;
        height: 60%;
        display: block; /* Évite les espaces indésirables */
    }
</style>