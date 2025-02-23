<x-app-layout>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Gestion des Réservations</title>
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
            th.client, td.client {
                width: 20%;
            }
            th.details, td.details {
                width: 15%;
            }
            th.personne, td.personne {
                width: 10%;
            }
            th.heure, td.heure {
                width: 10%;
            }
            th.date, td.date {
                width: 10%;
            }
            .checkbox-container {
                display: flex;
                align-items: center;
                margin-bottom: 5px;
            }
            .checkbox-container input[type="checkbox"] {
                width: 15px;
                height: 15px;
                margin-right: 5px;
                cursor: pointer;
            }
            .checkbox-container label {
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <h1>Ajouter une nouvelle réservation</h1>
    
        <!-- Formulaire pour ajouter une nouvelle réservation -->
        <div class="form-container">
            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="client_id">Nom du client</label>
                    <select id="client_id" name="client_id" required>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="number_of_people">Nombre de personnes</label>
                    <input type="number" id="number_of_people" name="number_of_people" required min="1" style="width: 100px;">
                </div>
                <div class="form-group">
                    <label for="start_time">Heure de début</label>
                    <input type="time" id="start_time" name="start_time" required style="width: 100px;">
                </div>
                <div class="form-group">
                    <label for="end_time">Heure de fin</label>
                    <input type="time" id="end_time" name="end_time" required style="width: 100px;">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="total_price">Prix total</label>
                    <input type="number" step="0.01" id="total_price" name="total_price" required>
                </div>
                <div class="form-group">
                    <label for="status">Statut</label>
                    <select id="status" name="status" required>
                        <option value="confirmé">Confirmé</option>
                        <option value="annulé">Annulé</option>
                    </select>
                </div>
                <!-- Cases à cocher pour les poneys -->
                <div class="form-group">
                    <label>Poneys disponibles</label>
                    @foreach($horses as $horse)
                        @if($horse->status === 'disponible')
                            <div class="checkbox-container"> 
                                <input type="checkbox" id="horse_{{ $horse->id }}" name="horses[]" value="{{ $horse->id }}">
                                <label for="horse_{{ $horse->id }}">{{ $horse->name }}</label>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="form-group">
                    <button type="submit">Ajouter</button>
                </div>
            </form>                       
        </div>
    
        <!-- Liste des réservations -->
        <h2>Liste des Réservations</h2>
        <table>
            <tr>
                <th class="client">Nom du client</th>
                <th class="personne">Nombre de personnes</th>
                <th class="heure">Heure de début</th>
                <th class="heure">Heure de fin</th>
                <th class="date">Date</th>
                <th class="details">Prix total</th>
                <th class="details">Poneys utilisés</th>
                <th class="details">Statut</th>
                <th>Actions</th>
            </tr>
            @foreach($reservations as $reservation)
                <tr>
                    <td class="client">{{ $reservation->client->name }}</td>
                    <td class="personne">{{ $reservation->number_of_people }}</td>
                    <td class="heure">{{ $reservation->start_time }}</td>
                    <td class="heure">{{ $reservation->end_time }}</td>
                    <td class="date">{{ $reservation->date }}</td>
                    <td class="details">{{ $reservation->total_price }}</td>
                    <td class="details">
                        @foreach($reservation->horses as $horse)
                            {{ $horse->name }}<br>
                        @endforeach
                    </td>
                    <td class="details">{{ $reservation->status }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('reservations.edit', $reservation->id) }}">Modifier</a>
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
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
    