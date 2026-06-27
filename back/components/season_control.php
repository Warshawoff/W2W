<?php
// Simulation des données (à remplacer par tes variables réelles)
$total = 8;
$vu = 0; 
$pourcentage = ($vu / $total) * 100;
$is_complete = ($vu == $total);
?>

<div class="season-control-container" id="season-1" data-total="<?php echo $total; ?>">
    <div class="season-progress">
        <div class="progress-fill <?php echo $is_complete ? 'is-complete' : ''; ?>" 
             style="width: <?php echo $pourcentage; ?>%;">
        </div>
    </div>

    <div class="season-content">
        <span class="season-label">Saison 1</span>
        
        <div class="badges-row">
            <div class="badge-item2"><?php include '../components/badge_imdb.php'; ?></div>
            <div class="badge-item2"><?php include '../components/badge_w2w.php'; ?></div>
        </div>

        <div class="episode-actions">
            <span class="episode-count" id="count-text"><?php echo $vu . '/' . $total; ?></span>
            <button class="check-btn" onclick="toggleSeason(this)">
                <?php include '../components/check_icon.svg'; ?>
            </button>
        </div>
    </div>
</div>

<style>
    .season-control-container { 
        background-color: #1a1a1a; border-radius: 12px; overflow: hidden; 
        margin: 15px 0; font-family: system-ui, -apple-system, sans-serif; 
    }
    .season-progress { width: 100%; height: 8px; background: #333; }
    .progress-fill { height: 100%; background: #ffcc00; transition: width 0.3s ease; }
    .progress-fill.is-complete { background: #2ecc71; }
    
    .season-content { padding: 0px 20px; display: flex; align-items: center; gap: 30px; color: #fff; }
    
    .season-label { font-size: 1.4rem; font-weight: 400; letter-spacing: -0.5px; }
    
    /* Correction de l'espace : gap à 10px et largeur auto pour coller les badges */
    .badges-row { display: flex; gap: 10px; }
    .badge-item2 { width: 110px; height: 60px; display: flex; }
    
    .episode-actions { margin-left: auto; display: flex; align-items: center; gap: 25px; }
    
    .episode-count { font-size: 1.2rem; font-weight: 400; color: #ffffff; }
    
    .check-btn { background: none; border: none; cursor: pointer; padding: 0; display: flex; }
    .check-btn svg { width: 40px; height: 40px; } 
    .check-btn .svg-circle { color: #333; }
    .check-btn .svg-check { stroke: #fff; stroke-width: 2; }
    .check-btn.is-active svg { stroke: #2ecc71 !important; }
    .check-btn.is-active .svg-circle { color: #2ecc71 !important; }
</style>

<script>
function toggleSeason(button) {
    const container = button.closest('.season-control-container');
    const total = parseInt(container.getAttribute('data-total'));
    const countText = container.querySelector('#count-text');
    const progressFill = container.querySelector('.progress-fill');
    
    // Toggle de la classe sur le bouton lui-même
    button.classList.toggle('is-active');

    if (progressFill.style.width === '100%') {
        countText.innerText = '0/' + total;
        progressFill.style.width = '0%';
        progressFill.classList.remove('is-complete');
    } else {
        countText.innerText = total + '/' + total;
        progressFill.style.width = '100%';
        progressFill.classList.add('is-complete');
    }
}
</script>