<?php
// Paramètres
$bgColor     = isset($bgColor)     ? $bgColor     : 'rgba(20, 20, 20, 0.8)';
$iconColor   = isset($iconColor)   ? $iconColor   : '#ffcc00';
$size        = isset($size)        ? $size        : '40px';
$radius      = isset($radius)      ? $radius      : '0 15px 0 15px';
$borderWidth = isset($borderWidth) ? $borderWidth : '2px';
?>

<button class="add-btn-custom" style="
    --bg-color: <?php echo $bgColor; ?>;
    --icon-color: <?php echo $iconColor; ?>;
    width: <?php echo $size; ?>; 
    height: <?php echo $size; ?>; 
    background-color: var(--bg-color);
    border-radius: <?php echo $radius; ?>;
    /* Bordure fixe en jaune (#ffcc00) */
    border: <?php echo $borderWidth; ?> solid #ffcc00; 
">
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

    /* Effet Hover : Fond et Icône s'inversent, mais la bordure reste jaune */
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