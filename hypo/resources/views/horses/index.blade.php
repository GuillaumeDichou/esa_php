<x-app-layout>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Gestion des Poneys</title>
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
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            table, th, td {
                border: 1px solid #ddd;
            }
            th, td {
                padding: 12px;
                text-align: left;
            }
            th {
                background-color: #28a745;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #ddd;
            }
            .action-buttons {
                display: flex;
                gap: 10px;
            }
            .action-buttons button, .action-buttons a {
                padding: 5px 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .action-buttons button {
                background-color: #dc3545;
                color: white;
            }
            .action-buttons button:hover {
                background-color: #c82333;
            }
            .action-buttons a {
                background-color: #007bff;
                color: white;
                text-decoration: none;
            }
            .action-buttons a:hover {
                background-color: #0056b3;
            }
            th.name, td.name {
                width: 40%;
            }
            th.hours, td.hours {
                width: 15%;
            }
        </style>
    </head>
    <body>
        <h1>Ajouter un nouveau poney</h1>
    
        <!-- Formulaire pour ajouter un nouveau poney -->
        <div class="form-container">
            <form action="{{ route('horses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nom du poney</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="max_working_hours">Heures de travail max</label>
                    <input type="number" id="max_working_hours" name="max_working_hours" required>
                </div>
                <div class="form-group">
                    <label for="status">Statut</label>
                    <select id="status" name="status" required>
                        <option value="disponible">Disponible</option>
                        <option value="indisponible">Indisponible</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Ajouter</button>
                </div>
            </form>
        </div>
    
        <!-- Liste des poneys -->
        <h2>Liste des Poneys</h2>
        <table>
            <tr>
                <th class="name">Nom</th>
                <th class="hours">Heures de travail</th>
                <th class="hours">Heures de travail max</th>
                <th class="hours">Statut</th>
                <th>Actions</th>
            </tr>
            @foreach($horses as $horse)
                <tr>
                    <td class="name">{{ $horse->name }}</td>
                    <td class="hours">{{ $horse->work_hours }}</td>
                    <td class="hours">{{ $horse->max_working_hours }}</td>
                    <td class="hours">{{ $horse->status }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('horses.edit', $horse->id) }}">Modifier</a>
                        <form action="{{ route('horses.destroy', $horse->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </body>
    </html>
    </x-app-layout>
    