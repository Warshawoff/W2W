<?php 
$rating = isset($rating) ? $rating : '0.0'; 
$scale = isset($scale) ? $scale : '1';
$bgColor = isset($bgColor) ? $bgColor : 'rgba(20, 20, 20, 0.8)';
?>

<button class="custom-badge-container imdb" style="transform: scale(<?php echo $scale; ?>); --bg-main: <?php echo $bgColor; ?>;">
    <div class="badge-star-wrapper"><?php include '../assets/star_icon.svg'; ?></div>
    <span class="badge-score"><?php echo $rating; ?></span>
    <div class="badge-logo-wrapper">
        <span class="logo-imdb-text">IMDb</span>
    </div>
</button>

<style>
    .custom-badge-container {
        --border-main: #ffcc00; --text-main: #ffffff; --star-color: #ffcc00;
        display: inline-flex; align-items: center; justify-content: center; gap: 0.5em; padding: 0.25em 0.6em;
        border: 0.10em solid var(--border-main); border-radius: 0.5em; 
        background-color: var(--bg-main);
        cursor: pointer; height: 1.8em; transition: all 0.3s ease; transform-origin: left center;
    }

    .custom-badge-container:hover { 
        --bg-main: #ffcc00 !important; 
        --border-main: #ffcc00; 
        --text-main: #000000; 
        --star-color: #000000; 
    }

    .custom-badge-container .badge-score { color: var(--text-main); font-family: sans-serif; font-size: 0.8em; font-weight: bold; margin-top: 0.7px; }
    .custom-badge-container .badge-star-wrapper { display: flex; align-items: center; }
    .custom-badge-container .badge-star-wrapper svg { width: 0.85em; height: 0.85em; fill: var(--star-color); transition: fill 0.3s; }
    
    /* Spécifique IMDb */
    .logo-imdb-text {
        background-color: #ffcc00;
        color: #000000;
        font-family: Arial, sans-serif;
        font-weight: 900;
        font-size: 0.7em;
        padding: 0.1em 0.3em;
        border-radius: 0.2em;
        transition: all 0.3s ease;
    }
    .custom-badge-container:hover .logo-imdb-text {
        background-color: #000000 !important;
        color: #ffcc00 !important;
    }
    .custom-badge-container .badge-logo-wrapper { display: flex; align-items: center; height: 100%; }
</style>