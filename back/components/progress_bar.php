<?php
// On définit les valeurs par défaut globales si elles ne sont pas déjà définies
$percent = isset($percent) ? (float)$percent : 10;
$height = isset($height) ? $height : '10px';
$fillColor = isset($fillColor) ? $fillColor : '#ffcc00';
$fillCompleteColor = isset($fillCompleteColor) ? $fillCompleteColor : '#1d8f38';
$bgColor = isset($bgColor) ? $bgColor : '#676767';

// Sécurisation
$percent = max(0, min(100, $percent));
$currentColor = ($percent >= 100) ? $fillCompleteColor : $fillColor;
?>

<div class="custom-progress-wrapper" style="height: <?php echo htmlspecialchars($height); ?>; background-color: <?php echo htmlspecialchars($bgColor); ?>;">
    <div class="custom-progress-fill" style="width: <?php echo $percent; ?>%; background-color: <?php echo htmlspecialchars($currentColor); ?>;"></div>
</div>

<style>
    .custom-progress-wrapper { width: 100%; overflow: hidden; display: flex; }
    .custom-progress-fill { height: 100%; transition: width 0.5s ease-in-out, background-color 0.3s ease; }
</style>