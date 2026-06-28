<?php
/**
 * Fonction pour afficher un bouton personnalisé.
 * @param string $text        Texte du bouton
 * @param string $bgColor     Couleur de fond
 * @param string $textColor   Couleur du texte
 * @param string $borderColor Couleur de la bordure
 * @param string $borderWidth Épaisseur de la bordure
 * @param string $boxShadow   Effet d'ombre CSS
 * @param string $fontSize    Taille de la police (ex: 14px)
 * @param string $fontWeight  Épaisseur du texte (ex: bold, 700)
 * @param float  $scale       Multiplicateur de taille globale
 */
function renderButtonGenre(
    $text = 'Bouton', 
    $bgColor = '#1a1a1e', 
    $textColor = '#ffffff', 
    $borderColor = '#ffffff', 
    $borderWidth = '0px', 
    $boxShadow = '0 4px 6px rgba(0,0,0,0.3)', 
    $fontSize = '14px', 
    $fontWeight = 'bold', 
    $scale = 1.0
) {
    // Si aucune bordure n'est précisée, on utilise la couleur du texte
    if ($borderColor === null) {
        $borderColor = $textColor;
    }
    
    $transformStyle = ($scale != 1) ? "transform: scale(" . (float)$scale . "); transform-origin: center center;" : "";
    ?>
    <button type="button" class="text-btn-custom" style="
        --bg-color: <?php echo htmlspecialchars($bgColor); ?>;
        --text-color: <?php echo htmlspecialchars($textColor); ?>;
        background-color: var(--bg-color);
        color: var(--text-color);
        border-color: <?php echo htmlspecialchars($borderColor); ?>;
        border-style: solid;
        border-width: <?php echo htmlspecialchars($borderWidth); ?>;
        box-shadow: <?php echo htmlspecialchars($boxShadow); ?>;
        font-size: <?php echo htmlspecialchars($fontSize); ?>;
        font-weight: <?php echo htmlspecialchars($fontWeight); ?>;
        <?php echo $transformStyle; ?>
    ">
        <?php echo htmlspecialchars($text); ?>
    </button>

   <style>
        .text-btn-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 18px;
            border-radius: 20px;
            font-family: sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .text-btn-custom:hover {
            transform: scale(<?php echo (float)$scale; ?>) translateY(-2px);
            box-shadow: 0 6px 8px rgba(0,0,0,0.15);
            /* Inversion forcée des couleurs */
            background-color: var(--text-color) !important;
            color: var(--bg-color) !important;
            border-color: var(--bg-color) !important;
        }
    </style>
    
    <?php
}
?>