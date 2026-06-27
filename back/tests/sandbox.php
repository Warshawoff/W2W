<?php
session_start();
$registry = json_decode(file_get_contents('registry.json'), true);
$selected = $_GET['comp'] ?? array_key_first($registry);
$config = $registry[$selected];

// 1. Validation : Mise à jour immédiate des paramètres en session
if (isset($_GET['action']) && $_GET['action'] == 'valider') {
    foreach ($config['params'] as $param => $paramData) {
        if (isset($_GET[$param])) {
            $_SESSION['params'][$param] = $_GET[$param];
        }
    }
}

// 2. Gestion session : Initialisation au changement de composant
if (!isset($_SESSION['current_comp']) || $_SESSION['current_comp'] !== $selected) {
    $_SESSION['params'] = [];
    foreach ($config['params'] as $param => $paramData) {
        $_SESSION['params'][$param] = $paramData['default'];
    }
    $_SESSION['current_comp'] = $selected;
}

// 3. Reset individuel : Recharge la valeur par défaut
if (isset($_GET['reset']) && isset($config['params'][$_GET['reset']])) {
    $_SESSION['params'][$_GET['reset']] = $config['params'][$_GET['reset']]['default'];
}

$currentParams = $_SESSION['params'] ?? [];
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
        }
        #component-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
            /* Le transform-origin est implicite car on centre avec flex */
        }
        /* Pour que le composant inclus ne s'étire pas, on peut lui laisser son comportement natif */
        #component-container > * {
            /* Si le composant est un bloc, il garde sa largeur/hauteur naturelle */
            flex-shrink: 0;
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <form method="GET" id="mainForm">
        <input type="hidden" name="comp" value="<?=$selected?>">
        <input type="hidden" name="action" value="valider">
        
        <select name="comp" onchange="this.form.submit()" style="width:100%; padding:10px; margin-bottom:20px;">
            <?php foreach(array_keys($registry) as $name): ?>
                <option value="<?=$name?>" <?=$selected==$name?'selected':''?>><?=$name?></option>
            <?php endforeach; ?>
        </select>

        <div class="control-block">
            <strong>Zoom Global</strong>
            <input type="range" id="zoomRange" min="0.5" max="3" step="0.1" value="1" 
                   oninput="document.getElementById('component-container').style.transform = 'scale(' + this.value + ')'">
        </div>

        <?php foreach($config['params'] as $param => $paramData): 
            $type = $paramData['type'];
        ?>
            <div class="control-block">
                <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
                    <strong><?= ucfirst($param) ?></strong>
                    <button type="button" onclick="window.location.href='?comp=<?=$selected?>&reset=<?=$param?>'">Reset</button>
                </div>
                
                <?php if ($type === 'range'): ?>
                    <div class="limits-row">
                        <label>Min <input type="number" value="0.1" id="min_<?=$param?>" onchange="updateSliderBounds('<?=$param?>')"></label>
                        <label>Max <input type="number" value="10.0" id="max_<?=$param?>" onchange="updateSliderBounds('<?=$param?>')"></label>
                        <label>Valeur <input type="number" id="val_<?=$param?>" name="<?=$param?>" value="<?= $currentParams[$param] ?>" step="0.1" oninput="syncManualToSlider('<?=$param?>')"></label>
                    </div>
                    <div class="slider-row">
                        <input type="range" id="range_<?=$param?>" value="<?= $currentParams[$param] ?>" min="0.1" max="10" step="0.1" oninput="syncSliderToManual('<?=$param?>', this.value)">
                    </div>
                <?php elseif ($type === 'color'): ?>
                    <input type="color" name="<?=$param?>" value="<?= $currentParams[$param] ?>" style="width:100%; height:40px; cursor:pointer;">
                <?php elseif ($type === 'number'): ?>
                    <input type="number" name="<?=$param?>" value="<?= $currentParams[$param] ?>">
                <?php else: ?>
                    <input type="text" name="<?=$param?>" value="<?= $currentParams[$param] ?>">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="submit-all">VALIDER ET RECHARGER</button>
    </form>
</aside>

<main>
    <div id="render">
        <div id="component-container">
            <?php extract($currentParams); include $config['file']; ?>
        </div>
    </div>
</main>

<script>
function updateSliderBounds(id) {
    let range = document.getElementById('range_'+id);
    let minVal = parseFloat(document.getElementById('min_'+id).value);
    let maxVal = parseFloat(document.getElementById('max_'+id).value);
    range.min = minVal;
    range.max = maxVal;
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
    
    if (val > parseFloat(maxInput.value)) { maxInput.value = val; range.max = val; }
    if (val < parseFloat(minInput.value)) { minInput.value = val; range.min = val; }
    range.value = val;
}
</script>
</body>
</html>