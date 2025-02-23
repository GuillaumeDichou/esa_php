<x-app-layout>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Modifier un Poney</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                margin: 0;
                padding: 20px;
            }
            h1 {
                margin-top: 20px;
            }
            h1, h2 {
                color: #333;
            }
            .form-container {
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-top: 20px;
                margin-bottom: 20px;
                display: inline-block;
                width: 100%;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-group label {
                display: inline-block;
                width: 150px;
                font-weight: bold;
            }
            .form-group input, .form-group select {
                width: calc(100% - 160px);
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            .form-group button {
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                background-color: #28a745;
                color: white;
                cursor: pointer;
            }
            .form-group button:hover {
                background-color: #218838;
            }
        </style>
    </head>
    <body>
        <h1>Modifier un Poney</h1>
    
        <!-- Formulaire pour modifier un poney -->
        <div class="form-container">
            <form action="{{ route('horses.update', $horse->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nom du poney</label>
                    <input type="text" id="name" name="name" value="{{ $horse->name }}" required>
                </div>
                <div class="form-group">
                    <label for="max_working_hours">Heures de travail max</label>
                    <input type="number" id="max_working_hours" name="max_working_hours" value="{{ $horse->max_working_hours }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Statut</label>
                    <select id="status" name="status" required>
                        <option value="disponible" {{ $horse->status == 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="indisponible" {{ $horse->status == 'indisponible' ? 'selected' : '' }}>Indisponible</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Mettre à jour</button>
                </div>
            </form>
        </div>
    </body>
    </html>
    </x-app-layout>
    