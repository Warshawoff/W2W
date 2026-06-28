<?php
session_start();

// 1. Charger le registre
$registry = json_decode(file_get_contents('registry.json'), true);
$selected = $_GET['comp'] ?? array_key_first($registry);
$config = $registry[$selected];

// 2. Inclure le fichier du composant pour définir la fonction
require_once $config['file'];

// 3. Analyser la fonction via Reflection
$functionName = $config['function'];
if (!function_exists($functionName)) {
    die("La fonction '$functionName' n'existe pas dans le fichier '{$config['file']}'.");
}

$reflection = new ReflectionFunction($functionName);
$params = $reflection->getParameters();
$paramDefs = [];
foreach ($params as $param) {
    $name = $param->getName();
    $default = null;
    if ($param->isOptional()) {
        $default = $param->getDefaultValue();
    }
    $paramDefs[$name] = [
        'default' => $default,
        'optional' => $param->isOptional(),
    ];
}

// 4. Initialisation de la session
if (!isset($_SESSION['current_comp']) || $_SESSION['current_comp'] !== $selected) {
    $_SESSION['params'] = [];
    foreach ($paramDefs as $name => $def) {
        $_SESSION['params'][$name] = $def['default'];
    }
    $_SESSION['current_comp'] = $selected;
}

// 5. Mise à jour par validation du formulaire
if (isset($_GET['action']) && $_GET['action'] === 'valider') {
    foreach ($paramDefs as $name => $def) {
        if (isset($_GET[$name])) {
            $_SESSION['params'][$name] = $_GET[$name];
        }
    }
}

// 6. Reset individuel
if (isset($_GET['reset']) && array_key_exists($_GET['reset'], $paramDefs)) {
    $_SESSION['params'][$_GET['reset']] = $paramDefs[$_GET['reset']]['default'];
}

$currentParams = $_SESSION['params'] ?? [];

// 7. Déterminer le type de contrôle pour chaque paramètre
function guessControlType($defaultValue) {
    if (is_string($defaultValue) && preg_match('/^#[0-9a-fA-F]{6}$|^#[0-9a-fA-F]{3}$/', $defaultValue)) {
        return 'color';
    }
    if (is_numeric($defaultValue)) {
        return 'number';
    }
    return 'text';
}

// Pour chaque paramètre, on stocke le type et des bornes par défaut pour les nombres
$controls = [];
foreach ($paramDefs as $name => $def) {
    $type = guessControlType($def['default']);
    $control = [
        'type' => $type,
        'default' => $def['default'],
        'optional' => $def['optional'],
    ];
    if ($type === 'number') {
        $val = (float)$def['default'];
        $control['min'] = max(0, $val - 10);
        $control['max'] = $val + 10;
        if ($control['min'] == $control['max']) {
            $control['min'] = 0;
            $control['max'] = 100;
        }
    }
    $controls[$name] = $control;
}

// --- NOUVEAU : gestion du zoom et de la couleur de fond ---
$zoom = isset($_GET['zoom']) ? (float)$_GET['zoom'] : 1.0;
$bgcolor = isset($_GET['bgcolor']) ? $_GET['bgcolor'] : '#121212';
// On s'assure que le zoom est dans une plage raisonnable
if ($zoom < 0.1) $zoom = 0.1;
if ($zoom > 5) $zoom = 5;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sandbox Contrôle</title>
    <style>
        body { display: flex; height: 100vh; margin: 0; background: #121212; color: #fff; font-family: sans-serif; overflow: hidden; }
        .sidebar { 
            width: 600px; padding: 20px; background: #1e1e1e; border-right: 1px solid #333; 
            overflow-y: auto; z-index: 9999; position: relative;
        }
        .control-block { margin-bottom: 25px; padding: 15px; border: 1px solid #444; border-radius: 8px; background: #252525; }
        .limits-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 10px; }
        input[type="number"], input[type="text"] { width: 100%; padding: 5px; background: #333; color: #fff; border: 1px solid #555; box-sizing: border-box; }
        .slider-row { margin: 15px 0; }
        input[type="range"] { width: 100%; height: 20px; cursor: pointer; }
        .submit-all { width: 100%; padding: 15px; background: #ffcc00; border: none; font-weight: bold; cursor: pointer; color: #000; }
        
        main { 
            flex: 1; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            overflow: auto; 
            background: #121212; 
        }
        #render {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: <?= htmlspecialchars($bgcolor) ?>;
        }
        #component-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
            transform: scale(<?= $zoom ?>);
        }
        #component-container > * {
            flex-shrink: 0;
        }
        .reset-btn {
            background: #ff4444;
            color: #fff;
            border: none;
            padding: 4px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .reset-btn:hover { background: #cc0000; }
        .color-picker-block { margin-top: 10px; }
        .color-picker-block input[type="color"] { width: 100%; height: 40px; cursor: pointer; background: transparent; border: none; }
    </style>
</head>
<body>

<aside class="sidebar">
    <form method="GET" id="mainForm">
        <input type="hidden" name="comp" value="<?= htmlspecialchars($selected) ?>">
        <input type="hidden" name="action" value="valider">
        <!-- Champs cachés pour la persistance du zoom et de la couleur -->
        <input type="hidden" name="zoom" id="zoomHidden" value="<?= htmlspecialchars($zoom) ?>">
        <input type="hidden" name="bgcolor" id="bgcolorHidden" value="<?= htmlspecialchars($bgcolor) ?>">
        
        <select name="comp" onchange="this.form.submit()" style="width:100%; padding:10px; margin-bottom:20px;">
            <?php foreach(array_keys($registry) as $name): ?>
                <option value="<?= htmlspecialchars($name) ?>" <?= $selected == $name ? 'selected' : '' ?>><?= htmlspecialchars($name) ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Zoom -->
        <div class="control-block">
            <strong>Zoom Global</strong>
            <input type="range" id="zoomRange" min="0.1" max="5" step="0.05" value="<?= $zoom ?>" 
                   oninput="updateZoom(this.value)">
            <span style="display:inline-block; margin-left:10px;" id="zoomDisplay"><?= number_format($zoom, 2) ?></span>
        </div>

        <!-- Couleur de fond -->
        <div class="control-block color-picker-block">
            <strong>Couleur de fond de la zone de test</strong>
            <input type="color" id="bgColorPicker" value="<?= htmlspecialchars($bgcolor) ?>" 
                   oninput="updateBgColor(this.value)">
        </div>

        <?php foreach ($controls as $param => $ctrl): ?>
            <div class="control-block">
                <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <strong><?= ucfirst(htmlspecialchars($param)) ?></strong>
                    <button type="button" class="reset-btn" onclick="window.location.href='?comp=<?= urlencode($selected) ?>&reset=<?= urlencode($param) ?>&zoom=<?= urlencode($zoom) ?>&bgcolor=<?= urlencode($bgcolor) ?>'">Reset</button>
                </div>
                
                <?php if ($ctrl['type'] === 'number'): ?>
                    <div class="limits-row">
                        <label>Min <input type="number" value="<?= $ctrl['min'] ?>" id="min_<?= $param ?>" onchange="updateSliderBounds('<?= $param ?>')"></label>
                        <label>Max <input type="number" value="<?= $ctrl['max'] ?>" id="max_<?= $param ?>" onchange="updateSliderBounds('<?= $param ?>')"></label>
                        <label>Valeur <input type="number" id="val_<?= $param ?>" name="<?= $param ?>" value="<?= htmlspecialchars($currentParams[$param] ?? $ctrl['default']) ?>" step="any" oninput="syncManualToSlider('<?= $param ?>')"></label>
                    </div>
                    <div class="slider-row">
                        <input type="range" id="range_<?= $param ?>" value="<?= htmlspecialchars($currentParams[$param] ?? $ctrl['default']) ?>" min="<?= $ctrl['min'] ?>" max="<?= $ctrl['max'] ?>" step="any" oninput="syncSliderToManual('<?= $param ?>', this.value)">
                    </div>
                <?php elseif ($ctrl['type'] === 'color'): ?>
                    <input type="color" name="<?= $param ?>" value="<?= htmlspecialchars($currentParams[$param] ?? $ctrl['default']) ?>" style="width:100%; height:40px; cursor:pointer;">
                <?php else: ?>
                    <input type="text" name="<?= $param ?>" value="<?= htmlspecialchars($currentParams[$param] ?? $ctrl['default']) ?>" style="width:100%;">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="submit-all">VALIDER ET RECHARGER</button>
    </form>
</aside>

<main>
    <div id="render">
        <div id="component-container">
            <?php
            // Appel de la fonction avec les paramètres actuels dans l'ordre défini par la signature
            $args = [];
            foreach ($params as $param) {
                $name = $param->getName();
                $args[] = $currentParams[$name] ?? $paramDefs[$name]['default'];
            }
            call_user_func_array($functionName, $args);
            ?>
        </div>
    </div>
</main>

<script>
// Fonctions pour le zoom et la couleur
function updateZoom(val) {
    document.getElementById('zoomHidden').value = val;
    document.getElementById('zoomDisplay').textContent = parseFloat(val).toFixed(2);
    document.getElementById('component-container').style.transform = 'scale(' + val + ')';
}

function updateBgColor(color) {
    document.getElementById('bgcolorHidden').value = color;
    document.getElementById('render').style.backgroundColor = color;
}

// Fonctions existantes pour les sliders numériques
function updateSliderBounds(id) {
    let range = document.getElementById('range_'+id);
    let minVal = parseFloat(document.getElementById('min_'+id).value);
    let maxVal = parseFloat(document.getElementById('max_'+id).value);
    range.min = minVal;
    range.max = maxVal;
    let current = parseFloat(range.value);
    if (current < minVal) range.value = minVal;
    if (current > maxVal) range.value = maxVal;
    document.getElementById('val_'+id).value = range.value;
}

function syncSliderToManual(id, val) {
    document.getElementById('val_'+id).value = val;
}

function syncManualToSlider(id) {
    let valInput = document.getElementById('val_'+id);
    let range = document.getElementById('range_'+id);
    let maxInput = document.getElementById('max_'+id);
    let minInput = document.getElementById('min_'+id);
    let val = parseFloat(valInput.value);
    if (isNaN(val)) return;
    
    if (val > parseFloat(maxInput.value)) { maxInput.value = val; range.max = val; }
    if (val < parseFloat(minInput.value)) { minInput.value = val; range.min = val; }
    range.value = val;
}

// Initialiser les bornes affichées pour correspondre aux attributs du slider
document.addEventListener('DOMContentLoaded', function() {
    <?php foreach ($controls as $param => $ctrl): if ($ctrl['type'] === 'number'): ?>
        let range = document.getElementById('range_<?= $param ?>');
        document.getElementById('min_<?= $param ?>').value = range.min;
        document.getElementById('max_<?= $param ?>').value = range.max;
    <?php endif; endforeach; ?>
});
</script>
</body>
</html>