<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Badge W2W</title>
    <style>
        body { background: #121212; color: white; font-family: sans-serif; display: flex; padding: 50px; gap: 50px; }
        .controls { display: flex; flex-direction: column; gap: 15px; background: #222; padding: 20px; border-radius: 8px; }
        .preview-area { flex-grow: 1; display: flex; justify-content: center; align-items: center; border: 2px dashed #444; }
    </style>
</head>
<body>

<div class="controls">
    <h3>Paramètres du Badge</h3>
    <label>Note : <input type="number" id="ratingInput" step="0.1" value="8.8"></label>
    <label>Scale : <input type="range" id="scaleRange" min="0.5" max="2" step="0.1" value="1"></label>
    <button onclick="location.reload()">Reset</button>
</div>

<div class="preview-area">
    <div id="badge-container">
        <?php 
            $rating = '8.8'; 
            $scale = '1'; 
            include '../components/w2w_badge.php'; 
        ?>
    </div>
</div>

<script>
    const ratingInput = document.getElementById('ratingInput');
    const scaleRange = document.getElementById('scaleRange');
    const badge = document.querySelector('.custom-badge-container');
    const scoreText = document.querySelector('.badge-score');

    ratingInput.addEventListener('input', () => { scoreText.textContent = ratingInput.value; });
    scaleRange.addEventListener('input', () => { badge.style.transform = `scale(${scaleRange.value})`; });
</script>
</body>
</html>