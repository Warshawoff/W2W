<?php
/**
 * Service pour la gestion des épisodes
 */
include_once '../db.php'; 

// Fonction 1 : Récupère tous les épisodes d'une saison donnée
function getEpisodesBySeason($seasonId) {
    $pdo = getDbConnection();
    // Correction ici : remplacement de season_id par id_season
    $stmt = $pdo->prepare("SELECT id FROM episodes WHERE id_season = :id_season ORDER BY episode_number ASC");
    $stmt->execute(['id_season' => $seasonId]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

// Fonction 2 : Récupère les détails d'un épisode spécifique
function getEpisodeDetails($episodeId) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT title, episode_number, duration, release_date FROM episodes WHERE id = :id");
    $stmt->execute(['id' => $episodeId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>