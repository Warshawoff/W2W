<?php
$bgColor     = isset($bgColor)     ? $bgColor     : 'rgba(20, 20, 20, 0.8)';
$iconColor   = isset($iconColor)   ? $iconColor   : '#ffcc00';
$size        = isset($size)        ? $size        : '40px';
$borderWidth = isset($borderWidth) ? $borderWidth : '2px';
?>

<button type="button" class="arrow-btn-custom" style="
    --bg-color: <?php echo $bgColor; ?>;
    --icon-color: <?php echo $iconColor; ?>;
    width: <?php echo $size; ?>; 
    height: <?php echo $size; ?>; 
    background-color: var(--bg-color);
    border: <?php echo $borderWidth; ?> solid var(--icon-color);
">
    <svg viewBox="0 0 24 24" fill="none" stroke="var(--icon-color)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="transform: rotate(180deg);">
        <path d="M5 12h14M12 5l7 7-7 7"/>
    </svg>
</button>

<style>
    .arrow-btn-custom {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
        box-sizing: border-box;
    }

    .arrow-btn-custom:hover {
        background-color: var(--icon-color) !important;
    }

    .arrow-btn-custom:hover svg {
        stroke: var(--bg-color) !important;
    }

    .arrow-btn-custom svg {
        /* Augmentation de la taille de l'icône à 65% pour qu'elle soit plus visible */
        width: 65%;
        height: 65%;
        transition: stroke 0.3s ease;
    }
</style>