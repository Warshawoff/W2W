<?php 
include 'includes/header.php'; 
?>

<div class="main-container">
    
    <main id="main-content">

        <!-- 1. SECTION BIENVENUE / ACCUEIL -->
        <section class="welcome-hero">
            <h1>Bienvenue sur What2Watch</h1>
            <p>Découvre, note et planifie tes prochains films et séries. Suis ton avancée et ne rate aucune sortie.</p>
        </section>

        <!-- 2. SECTION APERÇU : MA LISTE -->
        <section class="content-section">
            <div class="section-header">
                <h2>Ma liste à voir (Aperçu)</h2>
                <a href="profile.php" class="btn-link">Voir tout mon profil →</a>
            </div>
            
            <div class="films-grid">
                <div class="film-card">
                    <div class="fake-poster">Affiche</div>
                    <h3>Inception</h3>
                    <p class="rating">⭐ 8.8/10</p>
                </div>
                <div class="film-card">
                    <div class="fake-poster">Affiche</div>
                    <h3>Interstellar</h3>
                    <p class="rating">⭐ 8.6/10</p>
                </div>
            </div>
        </section>

        <hr class="section-divider">

        <!-- 3. SECTION TENDANCES DU MOMENT -->
        <section class="content-section">
            <div class="section-header">
                <h2>Les tendances cette semaine</h2>
                <div class="shortcuts">
                    <a href="films.php" class="btn-link">Découvrir les films</a>
                    <a href="series.php" class="btn-link">Découvrir les séries</a>
                </div>
            </div>

            <div class="films-grid">
                <div class="film-card">
                    <div class="fake-poster">Affiche</div>
                    <h3>Breaking Bad</h3>
                    <p class="rating">⭐ 9.5/10</p>
                </div>
                <div class="film-card">
                    <div class="fake-poster">Affiche</div>
                    <h3>Stranger Things</h3>
                    <p class="rating">⭐ 8.7/10</p>
                </div>
                <div class="film-card">
                    <div class="fake-poster">Affiche</div>
                    <h3>The Dark Knight</h3>
                    <p class="rating">⭐ 9.0/10</p>
                </div>
            </div>
        </section>

    </main>

</div>

<?php 
// On inclut le bas de page
include 'includes/footer.php'; 
?>