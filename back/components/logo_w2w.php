<?php
/**
 * Fonction pour afficher le logo W2W personnalisé.
 * @param string $bgColor      Couleur de fond (ex: '#ffcc00')
 * @param string $textColor    Couleur du texte (ex: '#000000')
 * @param string $fontFamily   Famille de police (ex: 'Arial, sans-serif')
 * @param float  $scale        Facteur de mise à l'échelle
 */
function renderLogoW2W(
    $bgColor = '#ffcc00',
    $textColor = '#000000',
    $fontFamily = 'Arial, Helvetica, sans-serif',
    $scale = 1.0
) {
    ?>
    <div class="logo-w2w-custom" style="
        background: <?php echo htmlspecialchars($bgColor); ?>; /* UTILISE 'background' ICI */
        color: <?php echo htmlspecialchars($textColor); ?>;
        font-family: <?php echo htmlspecialchars($fontFamily); ?>;
        transform: scale(<?php echo (float)$scale; ?>);">
        <span>W2W</span>
    </div>

    <style>
        .logo-w2w-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.1em 0.4em;
            border-radius: 0.25em;
            font-weight: 800;
            font-size: 0.8em;
            line-height: 1;
            width: fit-content;
            letter-spacing: -0.02em;
            transform-origin: center center;
            transition: transform 0.2s ease;
        }
    </style>
    <?php
}
?>