<?php
/**
 * Service pour la gestion des saisons
 */
include_once '../db.php'; 

// Fonction 1 : Récupère tous les IDs des saisons pour une série donnée
function getSeasonsBySeries($seriesId) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT id FROM seasons WHERE id_series = :id_series ORDER BY season_number ASC");
    $stmt->execute(['id_series' => $seriesId]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Fonction 2 : Récupère les détails d'une saison spécifique
function getSeasonDetails($seasonId) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT season_number, episode_count, rating_imdb, rating_w2w FROM seasons WHERE id = :id");
    $stmt->execute(['id' => $seasonId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>