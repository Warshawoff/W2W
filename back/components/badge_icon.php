<?php
/**
 * Paramètres :
 * - $type: 'date', 'watch' ou 'time'
 * - $text: La date ou le texte
 * - $bgColor: Couleur de fond
 * - $color: Couleur du texte, de l'icône et de la bordure
 * - $borderWidth: Épaisseur de la bordure
 */
$type        = isset($type)        ? $type        : 'date';
$text        = isset($text)        ? $text        : 'N/A';
$bgColor     = isset($bgColor)     ? $bgColor     : 'rgba(20, 20, 20, 0.8)';
$color       = isset($color)       ? $color       : '#ffffff';
$borderWidth = isset($borderWidth) ? $borderWidth : '1px';

// Sélection de l'icône selon le type
switch ($type) {
    case 'watch':
        $icon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
        break;
    case 'time':
        $icon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>';
        break;
    case 'date':
    default:
        $icon = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>';
        break;
}
?>

<div class="badge-icon-custom" style="
    background-color: <?php echo $bgColor; ?>; 
    color: <?php echo $color; ?>; 
    border: <?php echo $borderWidth; ?> solid <?php echo $color; ?>;
">
    <span class="icon-wrapper"><?php echo $icon; ?></span>
    <span class="text-wrapper"><?php echo htmlspecialchars($text); ?></span>
</div>

<style>
    .badge-icon-custom {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 20px;
        font-family: sans-serif;
        font-size: 14px;
        font-weight: bold;
        width: fit-content;
    }

    .icon-wrapper {
        display: flex;
        margin-right: 8px;
    }

    .icon-wrapper svg {
        width: 16px;
        height: 16px;
        stroke: currentColor;
    }
</style>