<?php
/**
 * Paramètres :
 * - $text: Le texte du bouton
 * - $bgColor: Couleur de fond
 * - $color: Couleur du texte et de la bordure
 * - $borderWidth: Épaisseur de la bordure
 */
$text        = isset($text)        ? $text        : 'Bouton';
$bgColor     = isset($bgColor)     ? $bgColor     : 'rgba(20, 20, 20, 0.8)';
$color       = isset($color)       ? $color       : '#ffffff';
$borderWidth = isset($borderWidth) ? $borderWidth : '1px';
?>

<button type="button" class="text-btn-custom" style="
    background-color: <?php echo $bgColor; ?>; 
    color: <?php echo $color; ?>; 
    border: <?php echo $borderWidth; ?> solid <?php echo $color; ?>;
">
    <?php echo htmlspecialchars($text); ?>
</button>

<style>
    .text-btn-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 15px;
        border-radius: 20px;
        font-family: sans-serif;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        border: solid; /* La bordure est gérée en inline */
    }

    .text-btn-custom:hover {
        opacity: 0.8;
        transform: scale(1.02);
    }
</style>