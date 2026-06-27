<?php 
include 'includes/header.php'; 

$view = isset($_GET['view']) ? $_GET['view'] : 'watchlist';
?>

<div class="main-container">
    <main id="main-content">
        
        <div class="sub-nav">
            <a href="films.php?view=watchlist" class="sub-nav-item <?php echo ($view === 'watchlist') ? 'active' : ''; ?>">Watchlist</a>
            <a href="films.php?view=tofollow" class="sub-nav-item <?php echo ($view === 'tofollow') ? 'active' : ''; ?>">To Follow</a>
        </div>

        <?php 
        if ($view === 'watchlist') {
            include 'views/films_watchlist.php';
        } else {
            include 'views/films_tofollow.php';
        }
        ?>

    </main>
</div>

<?php 
include 'includes/footer.php'; 
?>