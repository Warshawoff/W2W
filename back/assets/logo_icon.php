<?php
// Paramètres avec valeurs par défaut
$bg_color = isset($bg_color) ? $bg_color : '#ffcc00';
$text_color = isset($text_color) ? $text_color : '#000000';
$scale = isset($scale) ? $scale : '1';
// Nouvelle option pour la police
$font_family = isset($font_family) ? $font_family : 'Arial, Helvetica, sans-serif';
?>

<div class="logo-w2w" style="display: inline-flex; align-items: center; justify-content: center; 
    padding: 0.1em 0.4em; border-radius: 0.25em; font-family: sans-serif; 
    font-weight: 800; font-size: 0.8em; line-height: 1; width: fit-content; 
    transform-origin: center; transform: scale(<?php echo $scale; ?>);
    background-color: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>;">
    <span>W2W</span>
</div>

<style>
    .logo-w2w {
        display: inline-flex; 
        align-items: center; 
        justify-content: center;
        padding: 0.1em 0.4em; 
        border-radius: 0.25em; 
        font-weight: 800; /* Plus gras pour un meilleur rendu de logo */
        font-size: 0.8em; 
        line-height: 1;
        width: fit-content; 
        transform-origin: center;
        /* Amélioration du rendu du texte */
        letter-spacing: -0.02em; 
    }
</style>