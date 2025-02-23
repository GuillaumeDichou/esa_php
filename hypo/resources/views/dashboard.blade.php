<x-app-layout>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenue</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #74ebd5, #acb6e5);
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .container {
                background: white;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                text-align: center;
                max-width: 100%;
                margin-top: 20px;
            }

            h1 {
                color: #333;
                font-size: 2.5em;
                margin-bottom: 10px;
            }

            p {
                color: #666;
                font-size: 1.2em;
                margin-bottom: 20px;
            }

            .features {
                margin-top: 30px;
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
            }

            .feature {
                background: #f4f4f4;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                width: 45%;
                margin-bottom: 10px;
            }

            .feature h3 {
                margin-bottom: 10px;
                color: #333;
            }

            .feature p {
                color: #666;
                font-size: 1em;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Bienvenue !</h1>
            <p>Gérez facilement les réservations, poneys et factures du centre d'hypothérapie.</p>

            <div class="features">
                <div class="feature">
                    <h3>Gestion simplifiée</h3>
                    <p>Accédez rapidement aux clients et réservations.</p>
                </div>
                <div class="feature">
                    <h3>Facturation automatique</h3>
                    <p>Générez facilement des factures pour chaque réservation.</p>
                </div>
                <div class="feature">
                    <h3>Suivi des poneys</h3>
                    <p>Visualisez leur disponibilité en temps réel.</p>
                </div>
                <div class="feature">
                    <h3>Sécurisé et rapide</h3>
                    <p>Connexion sécurisée avec authentification.</p>
                </div>
            </div>
        </div>
    </body>
    </html>
</x-app-layout>

