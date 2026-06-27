<?php
// --- CHARGEMENT DU FICHIER .ENV (Alternative native sans Composer) ---
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignore les commentaires
        if (strpos(trim($line), '#') === 0) continue;
        
        // Sépare la clé et la valeur
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
} else {
    die("Erreur : Le fichier .env est introuvable.");
}

// --- CONFIGURATION DES ACCÈS VIA LES VARIABLES D'ENVIRONNEMENT ---
$host     = $_ENV['DB_HOST'];
$dbname   = $_ENV['DB_NAME'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];

try {
    // Connexion à PostgreSQL avec PDO
    $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;";
    
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les erreurs claires
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retourne les données sous forme de tableau associatif
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    // Si la connexion plante, on affiche l'erreur proprement
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}