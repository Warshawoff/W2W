<?php
/**
 * Affiche la barre de recherche dynamique (Loupe / Croix)
 * @param string $search_query Le texte actuellement recherché
 */
function renderSearchBar($search_query = '') {
    ?>
    <div class="search-header-zone">
        <form action="/pages/search.php" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <input type="text" name="q" id="search-input" value="<?= htmlspecialchars($search_query) ?>" placeholder="Chercher une série..." autocomplete="off">
                <button type="submit" style="display: none;"></button>
                <button type="reset" class="btn-search-action" onclick="document.getElementById('search-input').value=''; if('<?= $search_query ?>' !== '') { window.location.href='/pages/search.php'; }"></button>
            </div>
        </form>
    </div>
    <?php
}
?>