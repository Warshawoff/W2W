<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Logo W2W</title>
    <style>
        body { background: #121212; color: white; font-family: sans-serif; display: flex; padding: 50px; gap: 50px; }
        .controls { display: flex; flex-direction: column; gap: 15px; background: #222; padding: 20px; border-radius: 8px; }
        .preview-area { flex-grow: 1; display: flex; justify-content: center; align-items: center; border: 2px dashed #444; }
    </style>
</head>
<body>

<div class="controls">
    <h3>Paramètres du Logo</h3>
    <label>Fond : <input type="color" id="bgPicker" value="#ffcc00"></label>
    <label>Texte : <input type="color" id="textPicker" value="#000000"></label>
    <label>Échelle (Scale) : <input type="range" id="scaleRange" min="0.5" max="3" step="0.1" value="1"></label>
    <button onclick="resetParams()">Reset</button>
</div>

<div class="preview-area">
    <div id="logo-container">
        <?php include '../assets/logo_icon.php'; ?>
    </div>
</div>

<script>
    const bgPicker = document.getElementById('bgPicker');
    const textPicker = document.getElementById('textPicker');
    const scaleRange = document.getElementById('scaleRange');
    const logo = document.querySelector('.logo-w2w');

    function updateLogo() {
        logo.style.backgroundColor = bgPicker.value;
        logo.style.color = textPicker.value;
        logo.style.transform = `scale(${scaleRange.value})`;
    }

    [bgPicker, textPicker, scaleRange].forEach(el => el.addEventListener('input', updateLogo));

    function resetParams() {
        bgPicker.value = '#ffcc00'; textPicker.value = '#000000'; scaleRange.value = 1;
        updateLogo();
    }
</script>
</body>
</html>