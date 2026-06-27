<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test Flèche Retour</title>
    <style>
        body { background-color: #1a1a1a; padding: 50px; font-family: sans-serif; }

        /* Style de la flèche */
        .back-arrow {
            cursor: pointer;
            width: 50px; /* Taille réglable ici */
            transition: transform 0.2s ease;
        }

        .arrow-path {
            transition: stroke 0.2s ease;
        }

        /* Effet Hover */
        .back-arrow:hover {
            transform: translateX(-5px);
        }

        .back-arrow:hover .arrow-path {
            stroke: #ffffff; /* La flèche devient blanche */
        }
    </style>
</head>
<body>

    <h2 style="color: white;">Test du bouton retour</h2>
    
    <div id="back-btn" onclick="triggerAction()">
        <?php include '../components/back_arrow.svg'; ?>
    </div>

    <p id="feedback" style="color: #ffcc00; margin-top: 20px;"></p>

    <script>
        function triggerAction() {
            document.getElementById('feedback').innerText = "Action déclenchée : retour vers la page précédente !";
            console.log("Clic détecté sur la flèche");
        }
    </script>
</body>
</html>