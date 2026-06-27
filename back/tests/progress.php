<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Barre de Progression</title>
    <style>
        .progress-bar { width: 300px; height: 20px; border: 1px solid #ccc; }
        .progress-bg { fill: #333; }
        .progress-fill { fill: #ffcc00; transition: width 0.3s ease, fill 0.3s ease; }
        .progress-bar.complete .progress-fill { fill: #2ecc71; }
    </style>
</head>
<body>

    <h3>Test Barre de Progression</h3>
    <div id="pb-container">
        <?php include '../components/progress_bar.svg'; ?>
    </div>

    <p>Valeur : <span id="valeur">0</span>%</p>
    <button onclick="update(10)">+10%</button>
    <button onclick="update(-10)">-10%</button>

    <script>
        let pourcent = 0;
        function update(delta) {
            pourcent = Math.min(100, Math.max(0, pourcent + delta));
            document.getElementById('valeur').innerText = pourcent;
            
            // Mise à jour visuelle du SVG
            const fill = document.querySelector('.progress-fill');
            fill.setAttribute('width', (pourcent * 2)); // 200 étant la base du viewBox
            
            // Gestion de la classe CSS pour la couleur
            const svg = document.querySelector('.progress-bar');
            if (pourcent >= 100) { svg.classList.add('complete'); } 
            else { svg.classList.remove('complete'); }
        }
    </script>
</body>
</html>