<?php
/**
 * Affiche la barre de recherche avec gestion de la loupe et de la croix
 * @param string $search_query Le texte actuellement recherché
 */
function renderSearchBar($search_query = '') {
    ?>
    <div class="search-header-zone">
        <form action="/pages/search.php" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <input type="text" name="q" id="search-input" value="<?= htmlspecialchars($search_query) ?>" placeholder="Chercher une série..." autocomplete="off">
                
                <?php if (!empty($search_query)): ?>
                    <button type="button" class="btn-search-action" onclick="window.location.href='/pages/search.php';">❌</button>
                <?php else: ?>
                    <button type="submit" class="btn-search-action">🔍</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <?php
}
?>