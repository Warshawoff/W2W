<section class="content-section">
    <h2>My Watchlist</h2>
    <div class="films-grid">

        <div class="film-card">
            <div class="film-poster">
                Poster
                <div class="film-progress-track">
                    <div class="film-progress-fill" style="width: 65%;"></div>
                </div>
            </div>

            <button type="button" class="watched-btn" title="Marquer comme vu" data-film-id="inception" onclick="toggleWatched(this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </button>

            <h3 class="film-title">Inception</h3>
            <div class="film-meta">
                <span class="badge rating">⭐ 8.8</span>
                <span class="badge genre">Sci-Fi</span>
            </div>
        </div>

    </div>
</section>

<script>
// Toggle visuel "vu / pas vu" — pas encore connecté à une sauvegarde en base de données.
function toggleWatched(btn) {
    btn.classList.toggle('is-watched');
}
</script>