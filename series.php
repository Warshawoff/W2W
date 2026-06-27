<?php 
include 'includes/header.php'; 

$view = isset($_GET['view']) ? $_GET['view'] : 'watchlist';
?>

<div class="main-container">
    <main id="main-content">
        
        <div class="sub-nav">
            <a href="series.php?view=watchlist" class="sub-nav-item <?php echo ($view === 'watchlist') ? 'active' : ''; ?>">À Voir</a>
            <a href="series.php?view=tofollow" class="sub-nav-item <?php echo ($view === 'tofollow') ? 'active' : ''; ?>">À Venir</a>
        </div>

        <?php 
        if ($view === 'watchlist') {
            include 'views/series_watchlist.php';
        } else {
            include 'views/series_tofollow.php';
        }
        ?>

    </main>
</div>

<?php 
include 'includes/footer.php'; 
?>