<?php
function renderBadgeIcon(
    $type = 'date',
    $text = 'N/A',
    $scale = 1.0,
    $bgColor = '#252529',
    $textColor = '#ffffff',
    $borderColor = '#ffffff',
    $borderWidth = '0px',
    $boxShadow = '0 4px 6px rgba(0,0,0,0.3)',
    $fontSize = '14px',
    $fontWeight = 'bold'
) {
    // Sélection de l'icône
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

    $transformStyle = ($scale != 1) ? "transform: scale(" . (float)$scale . "); transform-origin: center center;" : "";
    ?>
    <div class="badge-icon-custom" style="
        background-color: <?php echo htmlspecialchars($bgColor); ?>;
        color: <?php echo htmlspecialchars($textColor); ?>;
        border: <?php echo htmlspecialchars($borderWidth); ?> solid <?php echo htmlspecialchars($borderColor); ?>;
        box-shadow: <?php echo htmlspecialchars($boxShadow); ?>;
        font-size: <?php echo htmlspecialchars($fontSize); ?>;
        font-weight: <?php echo htmlspecialchars($fontWeight); ?>;
        <?php echo $transformStyle; ?>
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
            /* Les styles de taille, couleur, etc. sont appliqués en ligne */
            width: fit-content;
            transition: all 0.3s ease;
        }
        .icon-wrapper {
            display: flex;
            margin-right: 8px;
        }
        .icon-wrapper svg {
            width: 16px;
            height: 16px;
            stroke: currentColor; /* Utilise la couleur du texte */
        }
    </style>
    <?php
}
?>